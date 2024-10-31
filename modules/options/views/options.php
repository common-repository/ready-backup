<?php
class optionsViewBup extends viewBup {

    public function getAdminPage() {
		
		$tabsData = array(
			'bupMainOptions' => array(
                'title'   => 'Main',
                'content' => $this->getMainOptionsTab()
            ),
			'bupTemplateOptions' => array(
                'title'   => 'Options', 
                'content' => $this->getTemplateOptionsTab()
            ),
			'bupStorageOptions' => array(
                'title' => 'Backups', 
                'content' => frameBup::_()->getModule('storage')->getController()->getView()->getAdminOptions()
            ),
			'bupScheduleOptions' => array(
                'title'   => 'Schedule', 
                'content' => frameBup::_()->getModule('schedule')->getController()->getView()->getAdminOptions()
            ),
			'bupLogOptions' => array(
                'title'   => 'Log', 
                'content' => frameBup::_()->getModule('log')->getController()->getView()->getAdminOptions()
            ),
			'bupDropboxOptions' => array(
				'title' => 'Dropbox</a><small class="bupAIP">Available In PRO</small>',
				'content' => '<a href="http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/" target="_blank"><img src="'.BUP_IMG_PATH.'pro/dropbox.png" width="580" /></a>',
			),
			'bupGdriveOptions' => array(
				'title' => 'Google Drive</a><small class="bupAIP">Available In PRO</small>',
				'content' => '<a href="http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/" target="_blank"><img src="'.BUP_IMG_PATH.'pro/prev_google.png" width="580" /></a>',
			),
			'bupAmazonS3Options' => array(
				'title' => 'Amazon S3</a><small class="bupAIP">Available In PRO</small>',
				'content' => '<a href="http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/" target="_blank"><img src="'.BUP_IMG_PATH.'pro/amazon.png" width="580" /></a>',
			),
			'bupEmailOptions' => array(
				'title' => 'Email</a><small class="bupAIP">Available In PRO</small>',
				'content' => '<a href="http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/" target="_blank"><img src="'.BUP_IMG_PATH.'pro/email.png" width="580" /></a>',
			),
			'bupOneDriveOptions' => array(
				'title' => 'OneDrive</a><small class="bupAIP">Available In PRO</small>',
				'content' => '<a href="http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/" target="_blank"><img src="'.BUP_IMG_PATH.'pro/onedrive.png" width="580" /></a>',
			),
		);
		
		$tabsData = dispatcherBup::applyFilters('adminOptionsTabs', $tabsData);
		$this->assign('tabsData', $tabsData);
        parent::display('optionsAdminPage');
    }
	
	public function getMainOptionsTab() {
		//$generalOptions = $this->getModel()->getByCategories('General');
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		//$this->assign('allOptions', $generalOptions['opts']);
		return parent::getContent('mainOptionsTab');
	}
	
	public function getTemplateOptionsTab() {
		$tplOptsData = array(
			'main'	=> array('title' => 'Main',	'content' => $this->getMainOptionsHtml()),
			//'logo'=> array('title' => 'Logo',			'content' => $this->getTemplateLogoOptionsHtml()),
		);
		$tplOptsData = dispatcherBup::applyFilters('adminTemplateOptions', $tplOptsData);
		$this->assign('tplOptsData', $tplOptsData);
		return parent::getContent('templateOptionsTab');
	}
	
	public function getMainOptionsHtml() {
		if(!isset($this->optModel))
			$this->assign('optModel', $this->getModel());
		return parent::getContent('mainOptionsHtml');
	}
	
	public function displayDeactivatePage() {
        $this->assign('GET', reqBup::get('get'));
        $this->assign('POST', reqBup::get('post'));
        $this->assign('REQUEST_METHOD', strtoupper(reqBup::getVar('REQUEST_METHOD', 'server')));
        $this->assign('REQUEST_URI', basename(reqBup::getVar('REQUEST_URI', 'server')));
        parent::display('deactivatePage');
    }
}
