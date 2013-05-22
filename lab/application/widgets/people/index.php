<?php

	$limit = 5;

	$current_member = current_member();
	
	$active_members = array();
	$context = active_context();
	foreach ($context as $selection) {
		if ($selection instanceof Member) $active_members[] = $selection;
	}
	
	if (count($active_members) > 0) {
		$mnames = array();
		$allowed_contact_ids = array();
		foreach ($active_members as $member) {
			$allowed_contact_ids[] = $member->getAllowedContactIds();
			$mnames[] = clean($member->getName());
		}
		$intersection = $allowed_contact_ids[0];
		if (count($allowed_contact_ids) > 1) {
			for ($i = 1; $i < count($allowed_contact_ids); $i++) {
				$intersection = array_intersect($intersection, $allowed_contact_ids[$i]);
			}
		}
		
		$contacts = Contacts::findAll(array(
			'conditions' => 'object_id IN ('.implode(',',$intersection).') AND `is_company` = 0 AND disabled = 0',
			'limit' => $limit,
			'order' => 'last_activity, updated_on',
			'order_dir' => 'desc',
		));
		$total = count($contacts);
		
		$widget_title = lang("people in", implode(", ", $mnames));
	
	} else {
		
		$result = Contacts::instance()->listing(array(
			"order" => "last_activity, updated_on",
			"order_dir" => "desc",
			"extra_conditions" => " AND `is_company` = 0 AND disabled = 0 AND user_type > 0",
			"start" => 0,
			"limit" => $limit
		));
		$total = $result->total ;
		$contacts = $result->objects;
	}
	
	$render_add = can_manage_security(logged_user());
	$genid = gen_id();
	
	if ($total > 0 || $render_add) {
		include_once 'template.php';
	}