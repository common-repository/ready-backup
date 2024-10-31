<div class="mainOpinonsBup">
	<table>
    <tr>
        <td width="120">Full backup</td>
        <td>
            <input type="checkbox" name="" id="bupFullBackup"/>
        </td>
    </tr>
    <tr>
    	<td>Database backup</td>
        <td><?php echo htmlBup::checkbox('opt_values[database]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('database') ? 'checked' : '')); ?></td>
    </tr>
    <tr>
        <td>Wordpress Core</td>
        <td><?php echo htmlBup::checkbox('opt_values[full]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('full') ? 'checked' : '' )); ?></td>
    </tr>
    <tr>
    	<td>Plugins folder</td>
        <td><?php echo htmlBup::checkbox('opt_values[plugins]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('plugins') ? 'checked' : '')); ?></td>
    </tr>
    <tr>
    	<td>Themes folder</td>
        <td><?php echo htmlBup::checkbox('opt_values[themes]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('themes') ? 'checked' : '')); ?></td>
    </tr>
    <tr>
    	<td>Uploads folder</td>
        <td><?php echo htmlBup::checkbox('opt_values[uploads]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('uploads') ? 'checked' : '')); ?></td>
    </tr>
    <tr>
    	<td>Any folder inside wp-content</td>
        <td><?php echo htmlBup::checkbox('opt_values[any_directories]', array('attrs'=>'class="bupCheckbox bupFull"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->get('any_directories') ? 'checked' : '')); ?></td>
    </tr>
	<tr>
		<td><?php langBup::_e('Safe Update'); ?></td>
		<td><?php echo htmlBup::checkbox('opt_values[safe_update]', array(
			'attrs'   => 'class="bupCheckbox"',
			'value'   => '1',
			'checked' => frameBup::_()->getModule('options')->get('safe_update') == 1 ? 'checked' : '',
		)); ?>
		</td>
	</tr>
	<tr>
		<td><?php langBup::_e('Force Update'); ?></td>
		<td><?php echo htmlBup::checkbox('opt_values[force_update]', array(
			'attrs'   => 'class="bupCheckbox"',
			'value'   => '1',
			'checked' => frameBup::_()->getModule('options')->get('force_update') == 1 ? 'checked' : '',			
		)); ?>
		</td>
	</tr>
	</table>
	
    <div class="excludeOpt">
    <?php 
		echo langBup::_('Exclude:'); 
		echo htmlBup::text( 'opt_values[exclude]', array('attrs'=>'class="excludeInput" title="If entering multiple files/directories, then separate them with commas."', 'value' => frameBup::_()->getModule('options')->get('exclude')) ); 
	?>
    </div>
  
    <div class="emailOpt">
    <table>
     <tr>
    	<td width="120"><?php echo langBup::_('Email notification:'); ?></td>
        <td><?php echo htmlBup::checkbox('opt_values[email_ch]', array('attrs'=>'class="bupCheckboxNotUnCheck"', 'value' => 1, 'checked' => frameBup::_()->getModule('options')->getValueType('email') ? 'checked' : '')); ?></td>
     </tr>
    </table>
    	<div class="emailAddress" <?php echo frameBup::_()->getModule('options')->getValueType('email') ? '' : 'style="display:none"' ?> >
        	<?php echo htmlBup::text( 'opt_values[email]', array('attrs'=>'class="excludeInput" placeholder="example@mail.com" title=""', 'value' => frameBup::_()->getModule('options')->get('email')) );  ?>
        </div>
    </div>
    
</div>
