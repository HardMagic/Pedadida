<div class="page tab-manager adminMainBlock">
	<h1><?php echo lang("tabs")?></h1>
	<form method = "POST" action="<?php echo get_url("administration" , "tabs_submit" )?>" >
		<table style="border: 1px solid #D7E5F5;">
			<tr>
				<th><?php echo lang("title")?></th>
				<th style="text-align:right;"><?php echo lang("order")?></th>
				<th style="text-align:center;"><?php echo lang("enabled")?></th>
			</tr>
			<?php $altRow = 'altRow'; 
			foreach ( $tabs as $tab ) : /* @var $tab TabPanel */
				$altRow = $altRow == '' ? 'altRow' : ''; 
			?>
			<tr class="<?php echo ($tab->getEnabled()?'enabled':'disabled')." $altRow"?>">
				<!-- <td><input type="text" class="disabled" readonly="readonly" required name="tabs[<?php echo $tab->getId()?>][title]" value="<?php echo $tab->getTitle()?>"></td>
				 -->
				<td><?php echo lang($tab->getTitle())?>
					<input type="hidden" class="disabled" readonly="readonly" required name="tabs[<?php echo $tab->getId()?>][title]" value="<?php echo $tab->getTitle()?>">
				</td>
				<td style="text-align:right;">
					<input type="number" name="tabs[<?php echo $tab->getId()?>][ordering]" value="<?php echo $tab->getOrdering()?>" style="width:60px;text-align:right;"></input>
				</td>
				<td style="text-align:center;">
					<input type="checkbox" name="tabs[<?php echo $tab->getId()?>][enabled]" <?php echo ( $tab->getEnabled() ) ? "checked='checked'" : "" ?>/>
				</td>
			</tr>
			<?php endforeach;?>
		</table>
		<?php echo submit_button(lang('save'))?>
	</form>
</div>