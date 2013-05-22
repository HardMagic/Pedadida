<?php 
$current_member = current_member();
$member = 0;
if($current_member){
   $member = $current_member->getId();
}
?>

<div class="widget-activity widget dashTableActivity">

	<div class="widget-header dashHeader">
            <div style="float: left; width: 90%;" onclick="og.dashExpand('<?php echo $genid?>');"><?php echo (isset($widget_title)) ? $widget_title : lang("activity");?></div>                
			<div class="dash-expander ico-dash-expanded" id="<?php echo $genid; ?>expander" onclick="og.dashExpand('<?php echo $genid?>');"></div>
            <div style="z-index:1; width:16px; float: right; margin-right: 5px; margin-top: 1px;" id="<?php echo $genid; ?>configFilters" onclick="og.quickForm({ type: 'configFilter', genid: '<?php echo $genid; ?>', members:'<?php echo $member ?>'});">
            	<img src="public/assets/themes/default/images/16x16/administration.png"/>
            </div>
	</div>
	
	<div class="widget-body" id="<?php echo $genid; ?>_widget_body">
		<ul>
            <table style="width:100%;" cellpadding="0" cellspacing="0" id="dashTableActivity">
			<?php 
            $c = 0;
            foreach ($acts['data'] as $k => $activity):
            $c++;
            $user = $acts['created_by'][$k];
            if ($activity instanceof Contact && $activity->isUser() || $member_deleted) {
            	$crumbOptions = "";
            } else {
            	$crumbOptions = json_encode($activity->getMembersToDisplayPath());
            }
            $crumbJs = " og.getCrumbHtml($crumbOptions) ";
            $class = "";
            $style = "";
            if($c > $total){
            	$class = "noViewActivity";
            	$style = "style='display:none'";
            }
			?>
				<tr class=" activity-row <?php echo $c % 2 == 1? '':'dashAltRow';?>  <?php echo $class?>" id="<?php echo "activity-".$c?>" <?php echo $style?>>
					<td style="width:32px">
					<?php if ($user instanceof Contact) : ?>
						<img src="<?php echo $user->getAvatarUrl() ?>" width="32px;"/>
					<?php endif; ?>
					</td><td style="padding-left:10px">
						<table cellpadding="0" cellspacing="0" style="width:100%;">
						<tr><td style="height: 17px;">
							<div><span class="breadcrumb"></span><?php echo $acts['act_data'][$k] ?></div>
						</td></tr>
						<tr><td style="padding-bottom:3px;"><div class="desc"><?php echo $acts['date'][$k] ?></div>
						</td></tr>
                        	<script>
                        	var crumbHtml = <?php echo $crumbJs?>;
                        	$("#activity-<?php echo $c?> .breadcrumb").html(crumbHtml);
                        	</script>
						</table>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php if (count($acts['data']) > $total) :?>
				<tr>
					<td colspan="2" align="right" style="padding:20px 0 5px; width: 20px; color: #003562;">
						<span onclick="og.hideActivity('<?php echo $genid?>')" id="hidelnk<?php echo $genid?>" style="cursor:pointer; display:none;" title="<?php echo lang('hide') ?>"><?php echo lang('hide') ?></span>
						<span onclick="og.showActivity('<?php echo $genid?>')" id="showlnk<?php echo $genid?>" style="cursor:pointer;" title="<?php echo lang('view more') ?>"><?php echo lang('view more') ?></span>
					</td>
				</tr>
			<?php endif;?>
			</table>
		</ul>
		<div class="x-clear"></div>
		<div class="progress-mask"></div>
	</div>	
</div>
<script>
	og.showActivity = function(id) {
		og.showHide('hidelnk' + id);
		og.showHide('showlnk' + id);
                
        $(".activity-row").each(function() {
        	if($("#" + this.id).hasClass("noViewActivity")){
            	$("#" + this.id).show("slow");
            }
        });
	}
        
    og.hideActivity = function(id) {
		og.showHide('hidelnk' + id);
		og.showHide('showlnk' + id);
	                
	    $(".activity-row").each(function() {
		    if($("#" + this.id).hasClass("noViewActivity")){
		    	$("#" + this.id).hide("slow");
		    }
	    });
	}
</script>