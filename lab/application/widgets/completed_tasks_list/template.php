<div class="completed-tasks widget">

	<div class="widget-header" onclick="og.dashExpand('<?php echo $genid?>');">
		<?php echo (isset($widget_title)) ? $widget_title : lang("completed tasks");?>
		<div class="dash-expander ico-dash-expanded" id="<?php echo $genid; ?>expander"></div>
	</div>
	
	<div class="widget-body" id="<?php echo $genid; ?>_widget_body">
		<ul>
		<?php
		$row_cls = "";
		$display = "";
		$count = 1;
		foreach ($tasks as $k => $task):
			$crumbOptions = json_encode($task->getMembersToDisplayPath());
			$crumbJs = " og.getCrumbHtml($crumbOptions) ";
		?>
			<li id="<?php echo "task-".$task->getId()?>" class="task-row <?php echo $row_cls?>" style="<?php echo $display;?>">
				<span class="completed-date"><?php echo $task->getCompletedOn() instanceof DateTimeValue ? format_datetime($task->getCompletedOn()) : '';?></span>
				<span class="db-ico ico-task" style="padding:2px 8px 0;">&nbsp;</span>
				<span class="breadcrumb"></span>
				<a href="<?php echo $task->getViewUrl() ?>">
					<span class="completed-date bold"><?php echo $task->getCompletedByName();?>: </span>
					<span class="task-title"><?php echo clean($task->getObjectName());?></span>
				</a>
				<script>
					var crumbHtml = <?php echo $crumbJs?> ;
					$("#task-<?php echo $task->getId()?> .breadcrumb").html(crumbHtml);
				</script>
			</li>
		<?php 
			$row_cls = $row_cls == "" ? "dashAltRow" : "";
			$count++;
			if ($count > $page) $display = "display:none;"; 
		endforeach; ?>
		</ul>
		
		<div class="view-all-container">
		<?php if ($count > $page) : ?>
			<a id="<?php $genid?>view-more" href="#"><?php echo lang('view more')?></a>
		<?php endif; ?>
		<?php if (count($tasks) > $total) :?>
			<a style="display:none;" id="<?php $genid?>view-all" href="#" onmousedown="og.openLink(og.getUrl('task', 'new_list_tasks'), {caller:'tasks-panel'});" onclick="Ext.getCmp('tabs-panel').activate('tasks-panel');">
				<?php echo lang('view all');?>
			</a>
		<?php endif;?>
		</div>
		<div class="x-clear"></div>
		<div class="progress-mask"></div>
	</div>
	
</div>
<script>
$(function() {
	$("#<?php $genid?>view-more").click(function(){
		$("li.task-row").show();
		$(this).hide();
		$("#<?php $genid?>view-all").show();
	});
});
</script>