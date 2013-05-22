

<div class="widget-messages widget dashMessages">

	<div class="widget-header dashHeader" onclick="og.dashExpand('<?php echo $genid?>');">
		<?php echo (isset($widget_title)) ? $widget_title : lang("notes");?>
		<div class="dash-expander ico-dash-expanded" id="<?php echo $genid; ?>expander"></div>
	</div>
	
	<div class="widget-body" id="<?php echo $genid; ?>_widget_body">
		<ul>
			<?php 
			$row_cls = "";
			foreach ($messages as $k => $message): /* @var $message ProjectMessage */
				$crumbOptions = json_encode($message->getMembersToDisplayPath());
				$crumbJs = " og.getCrumbHtml($crumbOptions) ";
			?>
				<li id="<?php echo "message-".$message->getId()?>" class="message-row ico-message <?php echo $row_cls ?>">
					<span class="breadcrumb"></span>
					<a href="<?php echo $message->getViewUrl() ?>"><span class="message-title"><?php echo clean($message->getName());?></span></a>
					<script>
						var crumbHtml = <?php echo $crumbJs?> ;
						$("#message-<?php echo $message->getId()?> .breadcrumb").html(crumbHtml);
					</script>
				</li>
				<?php $row_cls = $row_cls == "" ? "dashAltRow" : ""; ?>
			<?php endforeach; ?>
		</ul>	
		<?php if (count($messages)<$total) :?>
		<div class="view-all-container">
			<a href="<?php echo get_url('message', 'init')?>" target="messages-panel"><?php echo lang("view all") ?></a>
		</div>
		<?php endif;?>
		<div class="x-clear"></div>
		<div class="progress-mask"></div>
	</div>
	
</div>

