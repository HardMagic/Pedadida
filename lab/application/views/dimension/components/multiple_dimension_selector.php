<?php $hidden_field_name = array_var($options, 'hidden_field_name', 'members');?>
<div id='<?php echo $component_id ?>-container' class="member-selectors-container" >
	<input id='<?php echo $genid . $hidden_field_name ?>' name='<?php echo $hidden_field_name ?>' type='hidden' value="<?php echo str_replace('"', "'", $selected_members_json); ?>"></input>

<?php

	$members_dimension = array();
	$sel_mem_ids = array();
	foreach ($dimensions as $dimension) :
	
		$dimension_id = $dimension['dimension_id'];
		if (is_array($skipped_dimensions) && in_array($dimension_id, $skipped_dimensions)) continue;
		
		if ( is_array(array_var($options, 'allowedDimensions')) && array_search($dimension_id, $options['allowedDimensions']) === false ){
			continue;	 
		}

		if (!array_var($options, 'allow_non_manageable') && !$dimension['is_manageable']) continue;
		
		$is_required = $dimension['is_required'];
		$dimension_name = $dimension['dimension_name'];
		if ($is_required) $dimension_name .= " *";
		
		if (is_array($simulate_required) && in_array($dimension_id, $simulate_required)) $is_required = true;

		$dimension_selected_members = array();
		foreach ($selected_members as $selected_member) {
			if ($selected_member->getDimensionId() == $dimension_id) $dimension_selected_members[] = $selected_member;
		}
		
		$autocomplete_options = array();
		if (!isset($dim_controller)) $dim_controller = new DimensionController();
		$members = $dim_controller->initial_list_dimension_members($dimension_id, $content_object_type_id, $allowed_member_type_ids, false, "", null, false, null, true, $initial_selected_members, ACCESS_LEVEL_WRITE);
		
		foreach ($members as $m) {
			if (can_add_to_member(logged_user(), $m, active_context(), $content_object_type_id)) {
				$autocomplete_options[] = array($m['id'], $m['name'], $m['path'], $m['to_show'], $m['ico'], $m['dim']);
				$members_dimension[$m['id']] = $m['dim'];
			}
		}
		
		$expgenid = gen_id();
?>
	
	<div id="<?php echo $genid; ?>member-seleector-dim<?php echo $dimension_id?>" class="single-dimension-selector">
		<div class="header x-accordion-hd" onclick="og.dashExpand('<?php echo $expgenid?>', 'selector-body-dim<?php echo $dimension_id ?>');">
			<?php echo $dimension_name?>
			<div id="<?php echo $expgenid; ?>expander" class="dash-expander ico-dash-expanded"></div>
		</div>
		<div class="selector-body" id="<?php echo $expgenid?>selector-body-dim<?php echo $dimension_id ?>">
			<div id="<?php echo $genid; ?>selected-members-dim<?php echo $dimension_id?>" class="selected-members">
	
	<?php
		$dimension_has_selection = false; 
		if (count($dimension_selected_members) > 0) : 
			$alt_cls = "";
			foreach ($dimension_selected_members as $selected_member) :
				$allowed_members = array_keys($members_dimension);
				if (!in_array($selected_member->getId(), $allowed_members)) continue;
				$dimension_has_selection = true;
				?>
				<div class="selected-member-div <?php echo $alt_cls?>" id="<?php echo $genid?>selected-member<?php echo $selected_member->getId()?>">
					<span class="coViewAction <?php echo $selected_member->getIconClass()?>"></span><?php
						$complete_path = $selected_member->getPath();
						$complete_path = ($complete_path == "" ? "" : '<span class="path">'.$complete_path.'/</span>') . '<span class="bold">' . $selected_member->getName() . '</span>';
						echo $complete_path;
					?><div class="selected-member-actions">
						<a href="#" class="coViewAction ico-delete" title="<?php echo lang('remove relation')?>" onclick="member_selector.remove_relation(<?php echo $dimension_id?>,'<?php echo $genid?>', <?php echo $selected_member->getId()?>)"><?php echo lang('remove')?></a>
					</div>
				</div>
	<?php 		$alt_cls = $alt_cls == "" ? "alt-row" : "";
				$sel_mem_ids[] = $selected_member->getId();
		 	endforeach; ?>
	
				<div class="separator"></div>
	<?php endif;?>
			</div>
			<?php $form_visible = $dimension['is_multiple'] || (!$dimension['is_multiple'] && !$dimension_has_selection); ?>
			<div id="<?php echo $genid; ?>add-member-form-dim<?php echo $dimension_id?>" class="add-member-form" style="display:<?php echo ($form_visible?'block':'none')?>;">
				<?php
				$combo_listeners = array(
					"select" => "function (combo, record, index) { member_selector.autocomplete_select($dimension_id, '$genid', combo, record); }",
					"blur" => "function (combo) { var rec = combo.store.getAt(0); if (combo.getValue().trim() != '' && rec) { combo.select(0, true); combo.fireEvent('select', combo, rec, 0); } }"
				);
				$empty_text = array_var($options, 'empty_text', lang('add new relation ' . $dimension['dimension_code']));
				echo autocomplete_member_combo("member_autocomplete-dim".$dimension_id, $dimension_id, $autocomplete_options, 
					$empty_text, array('class' => 'member-name-input'), true, $genid .'add-member-input-dim'. $dimension_id, $combo_listeners);
				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>

	<script>
	if (!member_selector['<?php echo $genid; ?>']) member_selector['<?php echo $genid; ?>'] = {};
	if (!member_selector['<?php echo $genid; ?>'].properties) member_selector['<?php echo $genid; ?>'].properties = {};
	member_selector['<?php echo $genid; ?>'].hiddenFieldName = '<?php echo $hidden_field_name; ?>';

	<?php
	$listeners_str = "{";
	foreach ($listeners as $event => $function) {
		$listeners_str .= $event .' : \''. escape_single_quotes($function) .'\',';
	}
	if (str_ends_with($listeners_str, ",")) $listeners_str = substr($listeners_str, 0, -1);
	$listeners_str .= "}";
	?>

	member_selector['<?php echo $genid; ?>'].properties['<?php echo $dimension_id ?>'] = {
		title: '<?php echo $dimension_name ?>',
		dimensionId: <?php echo $dimension_id ?>,
		objectTypeId: '<?php echo $content_object_type_id ?>',
		required: <?php echo $is_required ? '1' : '0'?>,
		reloadDimensions: <?php echo json_encode( DimensionMemberAssociations::instance()->getDimensionsToReload($dimension_id) ); ?>,
		isMultiple: <?php echo $dimension['is_multiple'] ? '1' : '0'?>,
		listeners: <?php echo $listeners_str ?>
	};

	if (member_selector['<?php echo $genid; ?>'].properties['<?php echo $dimension_id ?>'].listeners.after_render) {
		eval(member_selector['<?php echo $genid; ?>'].properties['<?php echo $dimension_id ?>'].listeners.after_render);
	}

	</script>
<?php endforeach; ?>
	
<?php 
	foreach ($listeners as $event => $function) {
		if ($event == 'after_render_all') {
			echo '<script>'.escape_single_quotes($function).';</script>';
		}
	}
?>
	<div class="clear"></div>
</div>
<script>

member_selector['<?php echo $genid; ?>'].members_dimension = Ext.util.JSON.decode('<?php echo json_encode($members_dimension)?>');
member_selector['<?php echo $genid; ?>'].context = og.contextManager.plainContext();

member_selector.init('<?php echo $genid; ?>');

</script>