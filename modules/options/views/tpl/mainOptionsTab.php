<?php
	$not_piad = utilsBup::checkPRO() ? '' : 'bupNotPaid';
?>
<form class="cspNiceStyle" id="bupAdminMainForm">
<div class="main-progress-bar" style="display:none;">
	<div class="progress-bar devblue shine"> <!-- -->
    	<span style="width: 0%;"></span>
	</div>
</div>
	<div id="BUP_MESS_MAIN"></div>

	<table width="100%">
    	<tr class="cspAdminOptionRow cspTblRow">
        	<td width="100">Backup site</td>
            <td>
                <?php echo htmlBup::hidden('reqType', array('value' => 'ajax'))?>
                <?php echo htmlBup::hidden('page', array('value' => 'backup'))?>
				<?php echo htmlBup::hidden('action', array('value' => 'createAction'))?>
				<?php echo htmlBup::submit('backupnow', array('value' => langBup::_('Backup Now'), 'attrs' => 'class="button button-primary button-large"'))?>
            </td>
        </tr>
    </table>
</form>
<form class="cspNiceStyle" > <!--id="bupAdminMainForm"-->
    <table width="100%">
    	<tr class="cspAdminOptionRow cspTblRow">
        	<td width="100">Restore backup</td>
            <td>
            	<?php echo htmlBup::button(array('attrs' => 'class="button button-primary button-large" id="redirStorage"', 'value' => langBup::_('Restore'))); ?>
            </td>
        </tr>
        <tr class="cspAdminOptionRow cspTblRow">
        	<td></td>
            <td></td>
        </tr>
    </table>
</form>

<div id="resBox"></div>

<div align="left">
    <a id="bup_a_maininfo" href="javascript: void (0)">Options info</a> &darr;
    <div id="BUP_MESS_INFO"></div>
    <div id="bupInfoBlock"></div>
</div>

<div class="bupDest">
    <form id="bupMainFormOptions" method="post">
        <div class="bupMsgDest"></div>
        <div style="margin-bottom:4px;" >Where to Backup:</div>
            <div class="bupMargDest">
                <?php echo htmlBup::radiobutton('dest_opt', array('attrs'=>'class=""', 'value' => 'ftp', 'checked' => frameBup::_()->getModule('options')->get('glb_dest') == 'ftp' ? 'checked' : '')); ?> FTP
			</div>
			<div class="bupMargDest">
				<?php echo htmlBup::radiobutton('dest_opt', array(
					'attrs'   => 'class="'.$not_piad.'"',
					'value'   => 'dropbox',
					'checked' => frameBup::_()->getModule('options')->get('glb_dest') == 'dropbox' ? 'checked' : '',
				)); ?> Dropbox
			</div>
			<div class="bupMargDest">
				<?php echo htmlBup::radiobutton('dest_opt', array(
					'attrs'   => 'class="'.$not_piad.'"',
					'value'   => 'googledrive',
					'checked' => frameBup::_()->getModule('options')->get('glb_dest') == 'googledrive' ? 'checked' : '',
				)); ?> Google Drive
			</div>
            <div class="bupMargDest">
                <?php echo htmlBup::radiobutton('dest_opt', array(
                    'attrs'   => 'class="'.$not_piad.'"',
                    'value'   => 'amazon',
                    'checked' => frameBup::_()->getModule('options')->get('glb_dest') == 'amazon' ? 'checked' : '',
                )); ?> Amazon S3
            </div>
			<div class="bupMargDest">
				<?php echo htmlBup::radiobutton('dest_opt', array(
					'attrs'   => 'class="'.$not_piad.'"',
					'value'   => 'onedrive',
					'checked' => frameBup::_()->getModule('options')->get('glb_dest') == 'onedrive' ? 'checked' : '',
				)); ?> Microsoft OneDrive
			</div>

            <div>
                <?php echo htmlBup::hidden('reqType', array('value' => 'ajax'))?>
                <?php echo htmlBup::hidden('page', array('value' => 'options'))?>
                <?php echo htmlBup::hidden('action', array('value' => 'saveMainFromDestGroup'))?>
                <?php echo htmlBup::submit('saveAll', array('value' => langBup::_('Save'), 'attrs' => 'class="button button-primary button-large"'))?>
            </div>
            <div id="bupMainFormOptionsMsg"></div>
    </form>
</div>
