<?php

/**
 * Backup Module for Ready Backup plugin
 * @package ReadyBackup\Modules\Backup
 * @version 2.0
 * @author  Artur Kovalevsky
 */
class backupBup extends moduleBup {
	
	/**
	 * Path to libraries
	 * @var string
	 */
	private $_librariesPath = 'classes';
	
	/**
	 * Libraries list
	 * @var array
	 */
	private $_libraries = array(

        /* uses for creating archives */
		'zip' => array(
            'filename'  => 'Zip.php',
            'classname' => 'Zip',
        ),

        /* uses for unpacking archives */
        'pcl' => array(
            'filename'  => 'pclzip.lib.php',
            'classname' => 'PclZip',
        ),
	);
	
	/**
	 * Menu tab configuration
	 * @var array
	 */
	private $tab = array(
		'key'    => 'bupStorageOptions',
		'title'  => 'Backups',
		'action' => 'indexAction',
	);
	
	/**
	 * Plugin initialization
	 */
	public function init() {
		parent::init();

        /* Register tab */
		dispatcherBup::addFilter('adminOptionsTabs', array($this, 'registerModuleTab'));

        /* Load assets */
        $this->loadModuleScripts();

        $this->loadLibrary('pcl');

		/* Force run download action if $_GET param setted */
		if (isset($_GET['download']) && !empty($_GET['download'])) {
			$this->run('downloadAction');
		}
	}
	
	/**
	 * Loading dependencies and module classes
     * @param string $handle
	 */
	public function loadLibrary($handle)
    {
        if (isset($this->_libraries[$handle])) {
            $library = $this->_libraries[$handle];

            if ('pcl' === strtolower($handle)) {
                $this->loadPcl();
                return;
            }

            if (!class_exists($library['classname'])) {
                require_once realpath($this->getModDir()) . '/classes/' . $library['filename'];
            }
        }
	}

    protected function loadPcl()
    {
        if (is_file($file = ABSPATH . 'wp-admin/includes/class-pclzip.php')) {
            require_once $file;
            return;
        }

        require_once realpath($this->getModDir()) . '/classes/pclzip.lib.php';
    }

	/**
	 * Load javascript & css files
	 */
	public function loadModuleScripts() {
		if (is_admin() && frameBup::_()->isPluginAdminPage()) {
			frameBup::_()->addScript('adminBackupOptionsV2', $this->getModPath() . 'js/admin.backup.v2.js');
		}
	}
	
	/**
	 * Add tab to the menu
	 */
	public function registerModuleTab($tabs) {
		$tabs[$this->tab['key']] = array(
			'title'   => $this->tab['title'],
			'content' => $this->run($this->tab['action']),
		);
		
		return $tabs;
	}
	
    /**
     * Run controller's action
     * @param string $action
     * @return mixed
     */
    public function run($action) {
        $controller = $this->getController();
        if(method_exists($controller, $action)) {
            return $controller->{$action}();
        }
    }

    /**
     * Returns path to the temporary folder.
     *
     * @return string
     */
    public function getWarehouseTmp()
    {
        /** @var optionsBup $options */
        $options  = frameBup::_()->getModule('options');
        $basepath = rtrim(ABSPATH, DIRECTORY_SEPARATOR)
            . $options->get('warehouse');

        return $basepath . DIRECTORY_SEPARATOR . 'tmp';
    }
}