<?php
class adminmenuViewBup extends viewBup {
    protected $_file = '';

    public function init() {
        $this->_file = 'ready-backup-and-restore';
        add_action('admin_menu', array($this, 'initMenu'), 9);
        parent::init();
    }
    public function initMenu() {
		$accessCap = 'manage_options';
		$firstTimeLookedToPlugin = installerBup::isUsed();
				
		if($firstTimeLookedToPlugin) {
        	add_menu_page(langBup::_('Ready! Backup'), langBup::_('Ready! Backup'), $accessCap, $this->_file, array(frameBup::_()->getModule('options')->getView(), 'getAdminPage'));
		} else {
			if ( frameBup::_()->getModule('promo_ready') ){
				add_menu_page(langBup::_('Ready! Backup'), langBup::_('Ready! Backup'), $accessCap, $this->_file, array(frameBup::_()->getModule('promo_ready')->getView(), 'showWelcomePage'));
			} else { // if not install module "promo_ready"
				installerBup::setUsed();
				add_menu_page(langBup::_('Ready! Backup'), langBup::_('Ready! Backup'), $accessCap, $this->_file, array(frameBup::_()->getModule('options')->getView(), 'getAdminPage'));
			}
		}
    }
    public function getFile() {
        return $this->_file;
    }
}