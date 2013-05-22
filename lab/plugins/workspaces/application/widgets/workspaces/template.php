<?php 
$ws_dim = Dimensions::findByCode('workspaces');
$row_cls = "";
$add_button_text = count($data_ws) > 0 ? lang('add new workspace') : lang('add your first workspace');
$no_objects_text = count($data_ws) > 0 ? '' : lang('you have no workspaces yet');
?>

<div class="ws-widget widget">

	<div class="widget-header" onclick="og.dashExpand('<?php echo $genid?>');">
		<?php echo lang('workspaces')?>
		<div class="dash-expander ico-dash-expanded" id="<?php echo $genid; ?>expander"></div>
	</div>
	
	<div class="widget-body" id="<?php echo $genid; ?>_widget_body" >
	
	<?php if (isset($data_ws) && $data_ws && count($data_ws) > 0) : ?>
		<div class="project-list">
		<?php foreach($data_ws as $ws):?>
			<div class="workspace-row-container <?php echo $row_cls ?>">
				<a class="internalLink" href="javascript:void(0);" onclick="og.workspaces.onWorkspaceClick(<?php echo $ws->getId() ?>);">
					<img class="ico-color<?php echo $ws->getMemberColor() ?>" unselectable="on" src="s.gif"/>
					<?php echo $ws->getName() ?>
				</a>		
			</div>
			<div class="x-clear"></div>
			<?php $row_cls = $row_cls == "" ? "dashAltRow" : ""; ?>
		<?php endforeach;?>
		</div>
		
		<?php if ($total <= count ($workspaces)) : ?>
			<div class="view-all-container">
				<a href="javascript:og.customDashboard('member', 'init', {},true)" ><?php echo lang('view all');?></a>
			</div>
			<div class="clear"></div>
		<?php endif ;?>
		
		<div class="x-clear"></div>
		
	<?php endif; ?>
	
	<?php if (can_manage_dimension_members(logged_user())) : ?>
		<?php if (count($data_ws) > 0) : ?>
			<div class="separator"></div>
		<?php endif; ?>		
		<?php if ($no_objects_text != '') : ?><div class="no-obj-widget-msg"><?php echo $no_objects_text ?></div><?php endif; ?>
		<button title="<?php echo $add_button_text ?>" class="ws-more-details add-first-btn" style="float:right;">
			<img src="public/assets/themes/default/images/16x16/add.png"/>&nbsp;<?php echo $add_button_text ?>
		</button>
		<div class="clear"></div>
	<?php endif; ?>

	</div>
</div>


<script>
	$(function(){
		var parent_id = '<?php echo $parent instanceof Member ? $parent->getId() : 0?>';
		$(".ws-more-details").click(function(){
			og.openLink(og.getUrl('member','add'),{
				get: {
					'name': '',
					'dim_id': '<?php echo $ws_dim->getId()?>',
					'parent': parent_id
				}
			});
		});
	});
</script>
