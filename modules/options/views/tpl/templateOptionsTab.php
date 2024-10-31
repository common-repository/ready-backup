<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
	postboxes.add_postbox_toggles(pagenow);
});
// -->
</script>
<!--<form id="cspAdminTemplateOptionsForm">-->
<form id="bupAdminTemplateOptionsForm">
	<div class="bupWrap">
		<div id="dashboard-widgets" class="metabox-holder">
			<div id="postbox-container-1" class="postbox-container" style="width: 100%;">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
				<?php if(!empty($this->tplOptsData)) { ?>
					<?php $i = 1;?>
					<?php foreach($this->tplOptsData as $optData) { ?>
                          <div id="id<?php echo $i;?>" class="postbox bupAdminTemplateOptRow" style="display: block;">
                              <div class="handlediv" title="<?php langBup::_e( 'Click to toggle' )?>"><br></div>
                              <h3 class="hndle"><?php langBup::_e( 'What do you want to backup:' ); ?></h3>
                              <div class="inside">
                                  <?php echo $optData['content']?>
                              </div>
                          </div>
						<?php $i++;?>
					<?php }?>
				<?php }?>
				</div>
			</div>
			<div>
				<?php echo htmlBup::hidden('reqType', array('value' => 'ajax'))?>
				<?php echo htmlBup::hidden('page', array('value' => 'options'))?>
				<?php echo htmlBup::hidden('action', array('value' => 'saveGroup'))?>
				<?php echo htmlBup::submit('saveAll', array('value' => langBup::_('Save All Changes'), 'attrs' => 'class="button button-primary button-large"'))?>
			</div>
			<div id="bupAdminTemplateOptionsMsg"></div>
		</div>
	</div>
</form>