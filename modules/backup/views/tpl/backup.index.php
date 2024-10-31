<div id="bupBackupWrapper">
	<table id="bupAdminStorageTable" style="width: 100%;">
		<?php foreach ($backups as $id => $backup): ?>
		<tr class="bupTblRow" style="display: table-row">
			<td class="name">
				<div class="backupBlock">
					<fieldset>
						<legend style="text-align: right;">#<?php echo $id; ?> / <?php echo (isset($backup['zip']) ? $backup['zip']['date'] : $backup['sql']['date'])?></legend>
						<div align="left" id="MSG_EL_ID_<?php echo $id; ?>"></div>

                        <!-- Hides "Send to" button if the PRO version isn't activated -->
                        <?php if (null !== frameBup::_()->getModule('license')): ?>
                        <div style="text-align: right; margin-right: 10px;">
							<a href="#" onclick="return false;" class="bupSendTo" style="font-size:.9em">Send to &rarr;</a>
						</div>
						<?php endif; ?>

                        <div class="bupSendToProviders" style="text-align: right; display: none; font-size:.9em;">
							<?php foreach ($providers as $provider): ?>
							<a 
								href="#"
								id="<?php echo $id; ?>"
								class="bupSendToBtn"
								onclick="return false;" 
								data-provider="<?php echo $provider['provider']; ?>"
								data-action="<?php echo $provider['action']; ?>"
								title="Send backup to <?php echo $provider['label']; ?>"
								<?php foreach ($backup as $data): $backupfiles[] = $data['name']; endforeach;?>
								data-files="<?php echo implode(',', $backupfiles); ?><?php unset($backupfiles); ?>"
							><?php echo $provider['label']; ?></a>&nbsp;
							<?php endforeach; ?>
						</div>
						<table>
							<tbody>
								<?php foreach ($backup as $type => $data): ?>
	
								<tr class="tabStr" id="<?php echo $data['name']; ?>">
									<td align="right" style="width:160px !important; height:20px !important; margin:0px !important; padding:0px !important;"><?php echo ($type == 'zip' ? 'Filesystem' : 'Database'); ?></td>
									<td width="162">
										<!-- restoreButton -->
										<button 
											class="button button-primary button-small bupRestore"
											data-id="<?php echo $id; ?>"
											data-filename="<?php echo $data['name']; ?>"
										>
											<?php langBup::_e('Restore'); ?>
										</button>
										<!-- /restoreButton -->
										
										<!-- downloadButton -->
										<button 
											class="button button-primary button-small bupDownload"
											data-filename="<?php echo $data['name']; ?>"
										>
											<?php langBup::_e('Download'); ?>
										</button>
										<!-- /downloadButton -->
										
										<!-- deleteButton -->
										<a href="#" class="delBackup bupDelete" title="<?php langBup::_e('Delete'); ?>" data-id="<?php echo $id; ?>" data-filename="<?php echo $data['name']; ?>"></a>
										<!-- /deleteButton -->
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>		
					</fieldset>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	
	<p><a href="#" onclick="jQuery('#bupAdminStorageTable2').toggle(); return false;">Show old backups;</a> (version &le; 0.3.2)</p>
	<table id="bupAdminStorageTable2" style="width: 100%;display: none;">
		<?php foreach ($old as $backup): $uniqid = uniqid($backup['id']); ?>
		<tr class="bupTblRow" style="display: table-row">
			<td class="name">
				<div class="backupBlock">
					<fieldset>
						<legend style="text-align: right;">#<?php echo $backup['id']; ?> / <?php echo $backup['date']; ?></legend>
						<div align="left" id="MSG_EL_ID_<?php echo $uniqid; ?>"></div>
						<table>
							<tbody>
								<tr class="tabStr" id="<?php echo $backup['name']; ?>">
									<td align="right" style="width:160px !important; height:20px !important; margin:0px !important; padding:0px !important;"><?php echo ucfirst($backup['type']) . ' (' . $backup['ext'] . ')'; ?></td>
									<td width="162">
										<!-- restoreButton -->
										<button 
											class="button button-primary button-small bupRestore"
											data-id="<?php echo $uniqid; ?>"
											data-filename="<?php echo $backup['name']; ?>"
										>
											<?php langBup::_e('Restore'); ?>
										</button>
										<!-- /restoreButton -->
										
										<!-- downloadButton -->
										<button 
											class="button button-primary button-small bupDownload"
											data-filename="<?php echo $backup['name']; ?>"
										>
											<?php langBup::_e('Download'); ?>
										</button>
										<!-- /downloadButton -->
										
										<!-- deleteButton -->
										<a href="#" class="delBackup bupDelete" title="<?php langBup::_e('Delete'); ?>" data-id="<?php echo $uniqid; ?>" data-filename="<?php echo $data['name']; ?>"></a>
										<!-- /deleteButton -->
									</td>
								</tr>
							</tbody>
						</table>		
					</fieldset>
				</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>