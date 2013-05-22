if (!member_selector) var member_selector = {};

member_selector.init = function(genid) {

	member_selector[genid].sel_context = {};
	var selected_member_ids = Ext.util.JSON.decode(Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName)).getValue());
	for (i=0; i<selected_member_ids.length; i++) {
		var mid = selected_member_ids[i];
		var dim = member_selector[genid].members_dimension[mid];
		if (!member_selector[genid].sel_context[dim]) {
			member_selector[genid].sel_context[dim] = [];
		}
		member_selector[genid].sel_context[dim].push(mid);
	}
}

member_selector.autocomplete_select = function(dimension_id, genid, combo, record) {
	combo.setValue(record.data.name);
	combo.selected_member = record.data;

	member_selector.add_relation(dimension_id, genid);
}

member_selector.add_relation = function(dimension_id, genid) {
	var combo = Ext.getCmp(genid + 'add-member-input-dim' + dimension_id);
	var member = combo.selected_member;

	if (member == null) return;

	var selected_member_ids = Ext.util.JSON.decode(Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName)).getValue());
	var i = 0;
	while (selected_member_ids[i] != member.id && i < selected_member_ids.length) i++;
	if (i < selected_member_ids.length) {
		combo.clearValue();
		combo.selected_member = null;
		return;
	}

	if (!member_selector[genid].sel_context[dimension_id]) member_selector[genid].sel_context[dimension_id] = [];
	member_selector[genid].sel_context[dimension_id].push(member.id);
	
	var sel_members_div = Ext.get(genid + 'selected-members-dim' + dimension_id);
	var already_selected = sel_members_div.select('div.selected-member-div').elements;
	var last = already_selected.length > 0 ? Ext.fly(already_selected[already_selected.length - 1]) : null;
	var alt_cls = last==null || last.hasClass('alt-row') ? "" : " alt-row";
	
	var html = '<div class="selected-member-div'+alt_cls+'" id="'+genid+'selected-member'+member.id+'">';
	html += '<span class="coViewAction '+member.ico+'"></span>';
	if (member.path != '') {
		html += '<span class="path">'+member.path+'/ </span>';
	}
	html += '<span class="bold">'+member.name+'</span>';
	html += '<div class="selected-member-actions"><a class="coViewAction ico-delete" onclick="member_selector.remove_relation('+dimension_id+',\''+genid+'\', '+member.id+')" href="#">'+lang('remove')+'</a></div>';
	html += '</div><div class="separator"></div>';

	var sep = sel_members_div.select('div.separator').elements;
	for (x in sep) Ext.fly(sep[x]).remove();
	sel_members_div.insertHtml('beforeEnd', html);

	combo.clearValue();
	combo.selected_member = null;

	if (!member_selector[genid].properties[dimension_id].isMultiple) {
		var form = Ext.get(genid + 'add-member-form-dim' + dimension_id);
		if (form) {
			f = Ext.fly(form);
			f.enableDisplayMode();
			f.hide();
		}
	}

	// refresh member_ids input
	var member_ids_input = Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName));
	var member_ids = Ext.util.JSON.decode(member_ids_input.getValue());
	member_ids.push(member.id);
	member_ids_input.dom.value = Ext.util.JSON.encode(member_ids);

	// reload dependant selectors
	member_selector.reload_dependant_selectors(dimension_id, genid);

	// on selection change listener
	if (member_selector[genid].properties[dimension_id].listeners.on_selection_change) {
		eval(member_selector[genid].properties[dimension_id].listeners.on_selection_change);
	}
}

member_selector.remove_relation = function(dimension_id, genid, member_id, dont_reload) {
	
	var div = Ext.get(genid+'selected-member'+member_id);
	if (div) {
		div = Ext.fly(div);
		var next = div;
		while (next = next.next('div.selected-member-div')) {
			if (next.hasClass('alt-row')) next.removeClass('alt-row');
			else next.addClass('alt-row');
		}
		div.remove();
	}

	var sel_members_div = Ext.get(genid + 'selected-members-dim' + dimension_id);
	var already_selected = sel_members_div.select('div.selected-member-div').elements;
	if (already_selected.length == 0) {
		var sep = sel_members_div.select('div.separator').elements;
		for (x in sep) Ext.fly(sep[x]).remove();
	}

	// refresh member_ids input
	var member_ids_input = Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName));
	var member_ids = Ext.util.JSON.decode(member_ids_input.getValue());
	for (index in member_ids) {
		if (member_ids[index] == member_id) member_ids.splice(index, 1);
	}
	member_ids_input.dom.value = Ext.util.JSON.encode(member_ids);

	for (index in member_selector[genid].sel_context[dimension_id]) {
		if (member_selector[genid].sel_context[dimension_id][index] == member_id) {
			member_selector[genid].sel_context[dimension_id].splice(index, 1);
		}
	}

	if (member_selector[genid].properties[dimension_id].isMultiple || member_selector[genid].sel_context[dimension_id].length == 0) {
		var form = Ext.get(genid + 'add-member-form-dim' + dimension_id);
		if (form) {
			f = Ext.fly(form);
			f.enableDisplayMode();
			f.show();
		}
	}

	if (!dont_reload) {
		// reload dependant selectors
		member_selector.reload_dependant_selectors(dimension_id, genid);
	
		// on selection change listener
		if (member_selector[genid].properties[dimension_id].listeners.on_selection_change) {
			eval(member_selector[genid].properties[dimension_id].listeners.on_selection_change);
		}
	}
}

member_selector.reload_dependant_selectors = function(dimension_id, genid) {
	dimensions_to_reload = member_selector[genid].properties[dimension_id].reloadDimensions;

	for (i=0; i<dimensions_to_reload.length; i++) {
		var dim_id = dimensions_to_reload[i];
		if (member_selector[genid].properties[dim_id]) {
		
			var member_ids_input = Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName));
			var selected_members = member_ids_input.getValue();
			
			$.ajax({
				data: {
					dimension_id: dim_id,
					object_type_id: member_selector[genid].properties[dim_id].objectTypeId,
					onlyname: 1,
					selected_ids: selected_members
				},	
				url: og.makeAjaxUrl(og.getUrl('dimension', 'initial_list_dimension_members_tree')),
				dataType: "json",
				type: "POST",
				success: function(data){
					var combo = Ext.getCmp(genid + 'add-member-input-dim' + data.dimension_id);
					if (combo) {
						combo.disable();
						var store = [];
						for (x=0; x<data.dimension_members.length; x++) {
							dm = data.dimension_members[x];
							
							store[store.length] = [dm.id, dm.name, dm.path, dm.to_show, dm.ico, dm.dim];

							if(!member_selector[genid].members_dimension[dm.id]) {
								member_selector[genid].members_dimension[dm.id] = dm.dim;
							}
						}
						combo.reset();
						combo.store.removeAll();
						combo.store.loadData(store);
						combo.enable();
					}
            	}
            });
			
		}
	}
}


member_selector.remove_all_selections = function(genid) {
	for (dim_id in member_selector[genid].properties) {
		member_selector[genid].properties[dim_id];

		for (index in member_selector[genid].sel_context[dim_id]) {
			member_id = member_selector[genid].sel_context[dim_id][index];
			member_selector.remove_relation(dim_id, genid, member_id, true);
		}
		member_selector.reload_dependant_selectors(dim_id, genid);
	}
}

member_selector.set_selected = function(genid, sel_member_ids) {
	for (dim_id in member_selector[genid].properties) {
		var combo = Ext.getCmp(genid + 'add-member-input-dim' + dim_id);
		
		for (var idx=0; idx<sel_member_ids.length; idx++) {
			var sel_id = Number(sel_member_ids[idx]);
			var store = combo.store;
			
			for (i=0; i<store.data.items.length; i++) {
				if (store.data.items[i].data.id == sel_id) {
					member_selector.autocomplete_select(dim_id, genid, combo, store.data.items[i]);
					break;
				}
			}
		}
	}
	var member_ids_input = Ext.fly(Ext.get(genid + member_selector[genid].hiddenFieldName));
	member_ids_input.dom.value = Ext.util.JSON.encode(sel_member_ids);
	member_selector.init(genid);
}
