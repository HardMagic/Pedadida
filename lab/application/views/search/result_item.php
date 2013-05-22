	<?php extract($result)?>
	<div id="result-item<?php echo $id?>"  class="result-item">
		<div class="title">
			<a href="<?php echo $url?>" ><?php echo $title ?> </a>
		</div>
		<div class="content">
			<p><?php echo $content?></p>
		</div>
		<div class="footer">
			<span class="breadcrumb"></span>
				<script>
					<?php $crumbOptions = $memPath;
					$crumbJs = " og.getCrumbHtml($crumbOptions) ";?>
					var crumbHtml = <?php echo $crumbJs;?>;
					$("#result-item<?php echo $id?> .breadcrumb").html(crumbHtml);
				</script>
			<span class="footers_links">
				<span class="created_by"><?php echo $updated_by ?></span> -
				<span class="updated_on"><?php echo $updated_on ?></span> -
				<span class="type"><?php echo lang($type) ?></span> 
			</span>
		</div>
	</div>