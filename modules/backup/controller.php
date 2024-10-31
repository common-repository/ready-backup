<?php
/**
 * Backup Module for Ready Backup
 * @package ReadyBackup\Modules\Backup
 * @version 2.0
 * @author  Artur Kovalevsky
 */
class backupControllerBup extends controllerBup {
    public function indexAction() {
		$model     = $this->getModel();
		$backups   = $model->getBackupsList();
		$providers = array();

		$old = $model->getOldBackupsList();

		return $this->render('index', array(
			'backups'   => $backups,
			'old'       => $old,
			'providers' => dispatcherBup::applyFilters('adminSendToLinks', $providers),
		));
	}

	/**
	 * Create Action
	 * Create new backup
	 */
	public function createAction() {
        // Since version 0.3.9 we'll check for array of file stacks if filesystem backup is required

        $request = reqBup::get('post');
        $response = new responseBup();

        // We are need to check "warehouse" directory (usually: wp-content/upready)
        // If it does not exists - create it and check r/w permissions.
        if (!$this->getModel()->checkWarehouse()) {
            $response->addError($this->getModel()->getWarehouseError());

            return $response->ajaxExec();
        }

		if(!$this->_checkExtensions($response)) {
			return $response->ajaxExec();
		}
        $filename = $this->getModel()->generateFilename(array('zip', 'sql', 'txt'));

        /** @var backupLogModelBup $log */
        $log = $this->getModel('backupLog');
        $cloud = array();

        if ($this->getModel()->isFilesystemRequired()) {

            if (!isset($request['complete'])) {

                $files = $this->getModel()->getFilesList();
                $log->string(sprintf('%s files scanned.', count($files)));

                $warehouse = untrailingslashit(
                    untrailingslashit(ABSPATH)
                    . frameBup::_()->getModule('options')->get('warehouse')
                );
                $dir = $warehouse . DIRECTORY_SEPARATOR . 'tmp';

                $log->string('Clear out old temporary files');
                if (file_exists($file = $dir . '/stacks.dat')) {
                    if (@unlink($file)) {
                        $log->string(sprintf('%s successfully deleted', basename($file)));
                    } else {
                        $log->string(sprintf('Cannot delete file %s. If you notice a problem with archives - delete the file manually', $file));
                    }
                }
				$tmpDirFiles = glob($dir . '/*');
				if(!empty($tmpDirFiles) && is_array($tmpDirFiles)) {
					foreach ($tmpDirFiles as $tmp) {
						if (substr(basename($tmp), 0, 3) === 'BUP') {
							if (@unlink($tmp)) {
								$log->string(sprintf('%s successfully deleted', $tmp));
							} else {
								$log->string(sprintf('Cannot delete file %s', $tmp));
							}
						}
					}
				}

                // Defined in ./config.php
                if (!defined('BUP_FILES_PER_STACK')) {
                    define('BUP_FILES_PER_STACK', 500);
                }

                $response->addData(array(
                    'files'     => $files,
                    'per_stack' => BUP_FILES_PER_STACK,
                ));

                $log->string('Send request to generate temporary file stacks');

                return $response->ajaxExec();
            }

            $log->string(sprintf('Create a backup of the file system: %s', $filename['zip']));
            $this->getModel()->getFilesystem()->create($filename['zip']);
            $cloud[] = $filename['zip'];
        }

        if ($this->getModel()->isDatabaseRequired()) {
            $log->string(sprintf('Create a backup of the database: %s', $filename['sql']));
            $this->getModel()->getDatabase()->create($filename['sql']);
			$dbErrors = $this->getModel()->getDatabase()->getErrors();
			if(!empty($dbErrors)) {
				$log->string(sprintf('Errors during creation of database backup, errors count %d', count($dbErrors)));
				$response->addError( $dbErrors );
				return $response->ajaxExec();
			}
            $cloud[] = $filename['sql'];
        }

        $log->string('Backup complete');

        $destination = $this->getModel()->getConfig('dest');
		$handlers    = $this->getModel()->getDestinationHandlers();

		if (array_key_exists($destination, $handlers)) {

            $cloud = array_map('basename', $cloud);

            $log->string(sprintf('Upload to the <%s> required', ucfirst($destination)));
            $log->string(sprintf('Files to upload: %s', rtrim(implode(', ', $cloud), ', ')));
			$handler = $handlers[$destination];
			$result  = call_user_func_array($handler, array($cloud));
			if ($result === true || $result == 200 || $result == 201) {
				$log->string(sprintf('Successfully uploaded to the <%s>', ucfirst($destination)));
			} else {
                $log->string(sprintf('Cannot upload to the <%s>: %s', ucfirst($destination), (is_array($result) ? print_r($result, true) : $result)));
            }
		}

        $log->save($filename['txt']);
        $response->addMessage(langBup::_('Backup complete'));

        $log->clear();

        return $response->ajaxExec();
	}

    /**
     * Create Stack Action
     * Creates stacks of files with BUP_FILER_PER_STACK files limit and returns temporary file name
     */
    public function createStackAction() {
		@set_time_limit(0);
		
        $request = reqBup::get('post');
        $response = new responseBup();

        /** @var backupLogModelBup $log */
        $log = $this->getModel('backupLog');

        if (!isset($request['files'])) {
            return;
        }

        $log->string(sprintf('Trying to generate a stack of %s files', count($request['files'])));

        $filesystem = $this->getModel()->getFilesystem();
        $filename = $filesystem->getTemporaryArchive($request['files']);

        if ($filename === null) {
            $log->string('Unable to create the temporary archive');
            $response->addError(langBup::_('Unable to create the temporary archive'));
        } else {
            $log->string(sprintf('Temporary stack %s successfully generated', $filename));
            $response->addData(array('filename' => $filename));
        }

        return $response->ajaxExec();
    }

    public function writeTmpDbAction()
    {
        $request = reqBup::get('post');

        if (isset($request['tmp'])) {
            $warehouse = untrailingslashit(
                untrailingslashit(ABSPATH)
                . frameBup::_()->getModule('options')->get('warehouse')
            );
            $file = $warehouse
                . DIRECTORY_SEPARATOR
                . 'tmp'
                . DIRECTORY_SEPARATOR
                . 'stacks.dat';

            file_put_contents($file, $request['tmp'] . PHP_EOL, FILE_APPEND);
        }
    }

	/**
	 * Restore Action
	 * Restore system and/or database from backup
	 */
	public function restoreAction() {
		$request  = reqBup::get('post');
		$response = new responseBup();
		$filename = $request['filename'];
		$model    = $this->getModel();

		$result = $model->restore($filename);

		if (false === $result) {
            $errors = array_merge($model->getDatabase()->getErrors(), $model->getFilesystem()->getErrors());
            if (empty($errors)) {
                $errors = langBup::_('Unable to restore from ' . $filename);
            }
			$response->addError($errors);
		}
		else {
			$response->addData($result);
			$response->addMessage(langBup::_('Done!'));
		}

        $response->addData(array('result' => $result));
        return $response->ajaxExec();
	}

	/**
	 * Download Action
	 */
	public function downloadAction() {
		$request  = reqBup::get('get');
		$filename = $request['download'];

        $file = ABSPATH
            . frameBup::_()->getModule('options')->get('warehouse')
            . $filename;

        if (is_file($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
	}

	/**
	 * Remove Action
	 */
	public function removeAction() {
		$request  = reqBup::get('post');
		$response = new responseBup();
		$model    = $this->getModel();

		if ($model->remove($request['filename']) === true) {
			$response->addMessage(langBup::_('Backup successfully removed'));
		}
		else {
			$response->addError(langBup::_('Unable to delete backup'));
		}

		$response->ajaxExec();
	}

	/**
	 * Get model
	 * @param  string $name
	 * @return \backupModelBup
	 */
	public function getModel($name = '') {
		return parent::getModel($name);
	}

	/**
	 *
	 * @param  string $template
	 * @param  array  $data
	 * @return string
	 */
	public function render($template, $data = array()) {
		return $this->getView()->getContent('backup.' . $template, $data);
	}
	private function _checkExtensions($res) {
		if(!function_exists('gzopen')) {
			$res->addError(langBup::_('There are no zlib extension on your server. Check this link <a target="_blank" href="http://php.net/manual/en/zlib.installation.php">http://php.net/manual/en/zlib.installation.php</a>'));
			return false;
		}
		if(!class_exists('ZipArchive')) {
			$res->addError(langBup::_('There are no zib extension on your server. Check this link <a target="_blank" href="http://php.net/manual/en/book.zip.php">http://php.net/manual/en/book.zip.php</a>'));
			return false;
		}
		return true;
	}
	public function getPermissions() {
		return array(
			BUP_USERLEVELS => array(
				BUP_ADMIN => array('render', 'getModel', 'removeAction', 'downloadAction', 'restoreAction', 'writeTmpDbAction',
					'createStackAction', 'createAction', 'indexAction')
			),
		);
	}
}
