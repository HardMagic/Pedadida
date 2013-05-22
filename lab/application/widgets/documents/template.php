

<div class="widget-documents widget dashDocuments">

	<div class="widget-header dashHeader" onclick="og.dashExpand('<?php echo $genid?>');">
		<?php echo (isset($widget_title)) ? $widget_title : lang("documents");?>
		<div class="dash-expander ico-dash-expanded" id="<?php echo $genid; ?>expander"></div>
	</div>
	
	<div class="widget-body" id="<?php echo $genid; ?>_widget_body">
		<ul>
			<?php 
			$row_cls = "";
			foreach ($documents as $k => $document): /* @var $document ProjectFile */
				//$iconClass = $document->getIconClass();
				$iconUrl = $document->getTypeIconUrl(true, "16x16");
				$crumbOptions = json_encode($document->getMembersToDisplayPath());
				$crumbJs = " og.getCrumbHtml($crumbOptions) ";
			?>
				<li id="<?php echo "document-".$document->getId()?>" class="document-row co-row <?php echo $row_cls ?>" style="background: url(<?php echo $iconUrl?>) no-repeat left center; ">
					<span class="breadcrumb"></span>
					<a href="<?php echo $document->getViewUrl() ?>"><span class="document-title"><?php echo clean($document->getName());?></span></a>
					<script>
						var crumbHtml = <?php echo $crumbJs?> ;
						$("#document-<?php echo $document->getId()?> .breadcrumb").html(crumbHtml);
					</script>
				</li>
				<?php $row_cls = $row_cls == "" ? "dashAltRow" : ""; ?>
			<?php endforeach; ?>
		</ul>	
		<?php if (count($documents)<$total) :?>
		<div class="view-all-container">
			<a href="<?php echo get_url('files', 'init')?>" target="documents-panel"><?php echo lang("view all") ?></a>
		</div>
		<?php endif;?>
		<div class="x-clear"></div>
		<div class="progress-mask"></div>
	</div>
	
</div>

