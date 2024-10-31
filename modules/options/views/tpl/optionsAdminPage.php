<div id="bupAdminOptionsTabs">
    <h1>
        <?php langBup::_e('Ready! Backup')?>
        <?php //langBup::_e('version')?>
        <!--[<?php //echo BUP_VERSION?>]-->
    </h1>
	<ul>
		<?php foreach($this->tabsData as $tId => $tData) { ?>
		<li class="<?php echo $tId?>"><a href="#<?php echo $tId?>"><?php langBup::_e($tData['title'])?></a></li>
		<?php }?>
	</ul>
	<?php foreach($this->tabsData as $tId => $tData) { ?>
	<div id="<?php echo $tId?>"><?php echo $tData['content']?></div>
	<?php }?>
</div>
<div id="cspAdminTemplatesSelection"><?php echo $this->presetTemplatesHtml?></div>
