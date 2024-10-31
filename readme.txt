=== Ready! Backup ===
Contributors: Backup Plugin Ready
Donate link: http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
Tags: backup, back up, restoration, db backup, dump, file, migrate, schedule, ready!, email, FTP, mysql backup, website backup, database backup, db backup, wordpress backup, full backup
Tested up to: 4.0
Stable tag: 0.6.7

Complete online backup + restoration. Manual or automate backup to Dropbox, FTP, Email, Amazon S3 and more. Custom backup files, database, plugins

== Description ==

Backup your wordpress website to the DropBox, FTP, Local Computer, Email, Amazon S3, Google Drive and Microsoft OneDrive. Protect your website in easy and fast way.

[WordPress Backup plugin](http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/ "WordPress backup plugin") Ready! 

Backup Features:

* Backup to FTP, Local Computer and Email
* Online website back up to the cloud services: Dropbox, Google Drive, Amazon S3 and Microsoft OneDrive
* Schedule automatic backups
* Custom: database backup and files backup
* Backup in archive
* WordPress restoration via backup
* Back up Logs
* Email back-up notifications
* Big files backup
* Website restoration via backup

[youtube http://www.youtube.com/watch?v=4c0Cg9MLqPs]

Ready! Backup plugin ensures optimal backup for your wordpress-based website. Also, the plugin features custom backups, Files and Database backup, backup in archive, WordPress restoration via backup, Website back up to Dropbox or FTP, Email back-up notifications and more. Thanks to new and advanced features incorporated in it coupled with intuitive layout, this plugin is increasingly popular among website owners and website builders. It doesn't take much education to set it up, because all adjustments are readily observable. All you need to do is tick the needed backups in the list and specify parameters. The whole procedure will take but a few minutes. View our video tutorials and do as shown in them.

This is a must-have plugin for any online business owner. Whatever kind of goods you deal in, the plugin will keep your website functional day and night. If you have purchased this plugin, you can translate it to any language by replacing a language file incorporated in it. If you have translator's skills, you can translate it into your native language yourself. Install Ready! Backup and get your business up and running!
new version
== Installation ==

1. Download the Backup and Restore WordPress Ready! plugin
2. Upload the contents of backup-and-restore-wordpress-ready.zip to the /wp-content/plugins/ directory or use WordPress' built-in plugin install tool
3. Once installed, you can access the back up plugins settings page under the new Backup menu

== Screenshots ==

1. [WordPress backup plugin](http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/ "WordPress backup plugin")

== Changelog ==
= 0.6.7 =
 * Small fixes for 2 warnings in DEBUG mode
 * Added Dutch language
 * Small issues fix

= 0.6.6 =
 * Restore backup for large databases - row-by-row method
 * Core improvements - clear errors in table object before next insert/update operations
 * Checking for ZipArchive class existence before make backup - to avoid fatal errors
 * Remove some console javascript outputs in admin area
 * Small fix of admin area view

= 0.6.5 =
 * Amazon - create sub-folder for each domain in a bucket
 * Dropbox - make backup for servers with php <= 5.2 with large files
 * Added Dutch language
 * Fix for backup large databases

= 0.6.4 =
 * Hot fix - fixed backupBup::getWarehouseTmp() method
 * Remove unused log from Amazon model - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/

= 0.6.3 =
 * Changed tempnam() function call parameters from system tmp to upready/tmp
 * Checking for symfony class loader - to avoid incompatibility
 * Minor issues fix

= 0.6.2 =
 * Do not use AJAX on Welcome page
 * Correct permissions for all controllers methods call
 * Some minor fixes
 * Change API URL
 * Code improvements

= 0.6.1 =
 * Minor fixes for options
 * Some spelling issues fix
 * Small code review

= 0.6.0 =
 * Fixed invalid folders and files in filesystem backups
 * Fix for invalid backup folder path show
 * Fix for DEBUG mode
 * Code review

= 0.5.9 =
 * Fixed unlink warning, changed temporary files destination, improved MySQL dumps in backups.
 * Some fixes for DEBUG mode - removing notices and warnings
 * Increase time limit 
 * Check zip extension availability before create backup
 * Banners and readme

= 0.5.8 =
 * Added Swedish language
 * Dropbox - do not redirect to auth if token expired - just show re-autentificate message
 * Remove unused icons and images
 * Make plugin more secure
 * Small code review

= 0.5.7 =
 * Fix issue with Google Drive access token expiration - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Updated authenticator, updated OneDrive module - implemented multisite feature
 * Multidomain Google Drive backups (at Google Drive/Ready Backup/domainName/)
 * Dropbox - corrections for autentification - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Dropbox - fix geting token for autentification
 * Dropbox - fix curl for NSS curl
 * Gdrive - do not get all root objects as it can trigger "Allowed memory limit" error

= 0.5.6 =
* Microsoft OneDrive backup option
* Added files view
* Added backup files deleting and creating features
* Minor bugs fixed

= 0.5.5 =
 * Fix for multisite usage
 * Fix for incorrect Amazon login - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Add message when trying activate PRO version without Free (Base) version - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Additional tests and small fix in DEBUG mode

= 0.5.4 =
 * Fix bug with Restore button on Main plugin tab
 * Added certificates for dropbox for PHP 5.2 - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Dropbox uploads to the Applications/Ready Backup PRO/%domainname% - http://readyshoppingcart.com/product/wordpress-backup-and-restoration-plugin/
 * Fix small issues with console object in IE
 * Added arabic lang
 * Small spelling issues fix

= 0.5.3 =
* Fixed PclZip error
* Minor bugs fixed

= 0.5.2 =
* Fixed dropbox backup
* Re-develop backup to email process
* WordPress 3.9.1 compatability

= 0.5.1 =
* Fixed 500 error
* "Send to" button, "Download" button on backup page
* Added: Schedule 3rt party storages
* Minor backup bugs fixed

= 0.4.2 =
* Fixed error message ‘PRO version is not activated’ when user trying to set FTP backup without PRO version
* Fixed error when assets does not loading

= 0.4.1 =
* Updated Backup module
* Fixed some errors in the Schedule module
* New logging system
* More informative messages when building
* New backup in UI

= 0.3.10 =
* Backup plugin update bug fixed

= 0.3.6 =
* Now Ready! backup plugin does not broke admin panel with PHP ver. 5.2.x.
* Fallback functions placed to backup module
* Changes link to the plugin website

= 0.3.2 =
* WordPress 3.8.1 compatability
* Fixed a bug where a backup is not deleted in the absence of a log file
* Fixed conditions in backup plugin modules Storage and Backup
* Rewrote part of the Backup module, now it correctly identifies the type of backup and running with it
* Rewrote part of the module Storage, partially rewritten javascript file. Added filters .
* Rewrote the Module Options, now tab in the main menu can be added through the main module file (mod.php)
* Fixed back up methods error

= 0.2.4 =
* WordPress 3.8 compatability
* Global fix promo_ready

= 0.2.3 =
* Fixed bug with update

= 0.2.2 =
* Fixed bug with Ready! Backup plugin uodate
* Fixed bug with backup error due Dropbox backup

= 0.2.1 =
* Email back-up notifications
* Backup Plugin Ready compatability with WordPress 3.7.1
* Improove and re-develope backup process
* Minor bugs fixed


= 0.1.9 =
* Fixed .wrap bug
* Fixed schedule backup bug
* Minor bugs fixed


= 0.1.8 =
* Automate backup
* Schedules backup

= 0.1.6 =
* Fixed bug with backup remove

= 0.1.5 =
* Fixed bug with backup update

= 0.1.4 =
* WordPress backup to dropbox betta version release
* Full system backup log
* Fixed minor bugs

= 0.1.3 =
* Download backup archive to the local computer
* Added option to include/exclude "Any other directories found inside /wp-content"
* Fixed "not corect arhive" bug 

= 0.1.2 =
* First version released to WordPress.org