<?php
$total = 5;
$genid = gen_id();

$ws_dimension = Dimensions::findByCode('workspaces');
$dim_controller = new DimensionController();

$selected_ws = '0';
$allowed_members = array();
$add_ctx_members = true;
$context = active_context();
if(isset($context)){
	foreach ($context as $selection) {
		if ($selection instanceof Dimension && $selection->getCode() == 'workspaces') {
			$add_ctx_members = false;
		} else if ($selection instanceof Member && $selection->getObjectTypeId() == Workspaces::instance()->getObjectTypeId()) {
			$allowed_members[] = $selection->getId();
			$selected_ws = $selection->getId();
		}
	}	
}

$extra_conditions = " AND parent_member_id " . ($add_ctx_members && count($allowed_members) > 0 ? "IN (". implode(",", $allowed_members) .")" : "=0");

$workspaces = $dim_controller->initial_list_dimension_members($ws_dimension->getId(), null, null, false, $extra_conditions, $total, true);

$parent = null;
$context = active_context();
foreach ($context as $selection) {
	if ($selection instanceof Member && $selection->getDimensionId() == $ws_dimension->getId()) {
		$parent = $selection;
		break;
	}
}

if ((is_array($workspaces) && count($workspaces) > 0) || can_manage_dimension_members(logged_user())) {
	$data_ws = $workspaces;
	include_once 'template.php';
}
