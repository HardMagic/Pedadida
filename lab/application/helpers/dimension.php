<?php

function render_member_selectors($content_object_type_id, $genid = null, $selected_member_ids = null, $options = array(), $skipped_dimensions = null, $simulate_required = null) {
	
	if (is_numeric($content_object_type_id)) {
		if (is_null($genid)) $genid = gen_id();
		$user_dimensions  = get_user_dimensions_ids(); // User allowed dimensions
		$dimensions = array();
		
		// Diemsions for this content type
		if ( $all_dimensions = Dimensions::getAllowedDimensions($content_object_type_id) ) {
			foreach ($all_dimensions as $dimension){
				if ( isset($user_dimensions[$dimension['dimension_id']] ) ){
					if( $dimension_options = json_decode($dimension['dimension_options'])){
						if (isset($dimension_options->useLangs) && $dimension_options->useLangs ) {
							$dimension['dimension_name'] = lang($dimension['dimension_code']);
						}
					}
					$dimensions[] = $dimension;
				}
			}
		}
		
		if ($dimensions != null && count($dimensions)) {
			if (is_null($selected_member_ids) && array_var($options, 'select_current_context')) {
				$context = active_context();
				$selected_member_ids = array();
				foreach ($context as $selection) {
					if ($selection instanceof Member) $selected_member_ids[] = $selection->getId(); 
				}
			}
			
			if (is_null($selected_member_ids)) $selected_member_ids = array();
			
			// Set view variables
			$selected_members = count($selected_member_ids) > 0 ? Members::findAll(array('conditions' => 'id IN ('.implode(',', $selected_member_ids).')')) : array();
			$selected_members_json = "[".implode(',', $selected_member_ids)."]";
			$component_id = "$genid-member-selectors-panel-$content_object_type_id";
			$object_is_new = is_null($selected_members);
			
			$listeners = array_var($options, 'listeners', array());
			$allowed_member_type_ids = array_var($options, 'allowedMemberTypes', null);
			
			
			$initial_selected_members = $selected_members;
			if (count($initial_selected_members) == 0) {
				$selected_context_member_ids = active_context_members(false);
				if (count($selected_context_member_ids) > 0) {
					$initial_selected_members = Members::findAll(array('conditions' => 'id IN ('.implode(',', $selected_context_member_ids).')'));
				}
			}
			
			$tmp = array();
			foreach ($initial_selected_members as $ism) {
				if ($ism->getDimension()->getIsManageable()) $tmp[] = $ism;
			}
			$initial_selected_members = $tmp;
			
			
			// Render view
			include get_template_path("components/multiple_dimension_selector", "dimension");
			
		}
	}
}


function render_single_member_selector(Dimension $dimension, $genid = null, $selected_member_ids = null, $options = array()) {
	if (is_null($genid)) $genid = gen_id();
	
	$dimension_options = $dimension->getOptions(true);
	$dim_info = array(
		'dimension_id' => $dimension->getId(),
		'dimension_code' => $dimension->getCode(),
		'dimension_options' => $dimension_options,
		'is_manageable' => $dimension->getIsManageable(),
		'is_required' => array_var($options, 'is_required'),
		'is_multiple' => array_var($options, 'is_multiple'),
	);
	if($dimension_options && isset($dimension_options->useLangs) && $dimension_options->useLangs ) {
		$dim_info['dimension_name'] = lang($dimension->getCode());
	}
	
	$dimensions = array($dim_info);
	
	
	if (is_null($selected_member_ids)) $selected_member_ids = array();
			
	// Set view variables
	$selected_members = count($selected_member_ids) > 0 ? Members::findAll(array('conditions' => 'id IN ('.implode(',', $selected_member_ids).')')) : array();
	$selected_members_json = "[".implode(',', $selected_member_ids)."]";
	$component_id = "$genid-member-selectors-panel-$content_object_type_id";
	
	$listeners = array_var($options, 'listeners', array());
	$allowed_member_type_ids = array_var($options, 'allowedMemberTypes', null);
	
	// Render view
	include get_template_path("components/multiple_dimension_selector", "dimension");
}
