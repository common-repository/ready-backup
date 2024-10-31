<?php

class logModelBup extends modelBup {
	
	/**
	 * Returns all finded log files
	 * @return array
	 */
	public function getFilesList() {
		$options = frameBup::_()->getModule('options');
		$path    = realpath(ABSPATH) . $options->get('warehouse');
		$files   = array();
		$matches = array();
		
		$nodes = @scandir($path);

        if (!is_array($nodes) || empty($nodes)) {
            return $files;
        }

		foreach ($nodes as $node) {
			if (preg_match('/([\d]+).txt/', $node, $matches)) {
				
				$content = file_get_contents($path . $node);
				$linesArray = preg_split('/\n|\r/', $content);
				$lines = count($linesArray);
				
				$files[] = array(
					'filepath'  => $path . $node,
					'filename'  => $node,
					'backup_id' => $matches[1],
					'lines'     => $lines,
					'content'   => $content,
				);
			}
		}
		krsort($files);
		return $files;
	}
	
}