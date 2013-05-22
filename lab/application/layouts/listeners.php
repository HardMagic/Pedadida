<script>

og.eventManager.addListener('reload member restrictions', 
 	function (genid){ 
		App.modules.addMemberForm.drawDimensionRestrictions(genid, document.getElementById(genid + 'dimension_id').value);
 	}
);

og.eventManager.addListener('reload tab panel', 
 	function (name){
 		if (name) {
			Ext.getCmp(name).reload();
  		}
 	}
);

og.eventManager.addListener('reload member properties', 
 	function (genid){
 		App.modules.addMemberForm.drawDimensionProperties(genid, document.getElementById(genid + 'dimension_id').value);
 	}
);

og.eventManager.addListener('reload dimension tree',
	function (data){
		if (!og.reloadingDimensions){
			og.reloadingDimensions = {};
		}
		if (!og.reloadingDimensions[data.dim_id]){
			og.reloadingDimensions[data.dim_id] = true;
			setTimeout(function(){
				og.reloadingDimensions[data.dim_id] = false;
			}, 1000);

			var tree = Ext.getCmp("dimension-panel-" + data.dim_id);
			if (tree) {
				var selection = tree.getSelectionModel().getSelectedNode();

				tree.suspendEvents();
				var expanded = [];
				tree.root.cascade(function(){
					if (this.isExpanded()) expanded.push(this.id);
				});
				tree.loader.load(tree.getRootNode(), function() {
					og.reloadingDimensions[data.dim_id] = false;
					tree.expanded_once = false;
					og.expandCollapseDimensionTree(tree, expanded, selection ? selection.id : null);
					if(selection){
						og.Breadcrumbs.refresh(selection);
						og.contextManager.addActiveMember(selection.id, data.dim_id, selection.id);
					}
					if (data.node) {
						var treenode = tree.getNodeById(data.node);
						if (treenode) {
							treenode.fireEvent('click', treenode);
						}
						og.Breadcrumbs.refresh(treenode);
					}
				});
				tree.resumeEvents();
			}
		}
	}
);

og.eventManager.addListener('reset dimension tree', 
 	function (dim_id){
 		if (!og.reloadingDimensions){ 
 			og.reloadingDimensions = {} ;
 		}
 		if (!og.reloadingDimensions[dim_id]){
	 		og.reloadingDimensions[dim_id] = true ;
	 		var tree = Ext.getCmp("dimension-panel-" + dim_id);
	 		if (tree) {
		 		tree.suspendEvents();
 				tree.loader = tree.initialLoader;
		 		tree.loader.load(tree.getRootNode(),function(){
			 		tree.resumeEvents(); 
			 		og.Breadcrumbs.refresh(tree.getRootNode());
			 	});
		 		tree.expandAll();
	 		}
 		}
 	}
);

og.eventManager.addListener('select dimension member', 
	function (data){
		if (og.reloadingDimensions[data.dim_id]) {
		//	og.select_member_after_reload = data;
		} else {
			og.selectDimensionTreeMember(data);
		}
	}
);

og.eventManager.addListener('company added', 
 	function (company) {
 		var elems = document.getElementsByName("contact[company_id]");
 		for (var i=0; i < elems.length; i++) {
 			if (elems[i].tagName == 'SELECT') {
	 			var opt = document.createElement('option');
	        	opt.value = company.id;
		        opt.innerHTML = company.name;
	 			elems[i].appendChild(opt);
 			}
 		}
 	}
);

og.eventManager.addListener('contact added from mail', 
	function (obj) {
		var hf_contacts = document.getElementById(obj.hf_contacts);
		if (hf_contacts) hf_contacts.value += (hf_contacts != '' ? "," : "") + obj.combo_val;
		var div = Ext.get(obj.div_id);
 		if (div) div.remove();
 	}
);

og.eventManager.addListener('draft mail autosaved', 
	function (obj) {
		var hf_id = document.getElementById(obj.hf_id);
		if (hf_id) hf_id.value = obj.id;
 	}
);

og.eventManager.addListener('popup',
	function (args) {
		og.msg(args.title, args.message, 0, args.type, args.sound);
	}
);

og.eventManager.addListener('user preference changed',
	function(option) {
		switch (option.name) {
			case 'localization':
				window.location.reload();
				break;
			default: 
				og.preferences[option.name] = option.value;
				break;
		}
	}
);

og.eventManager.addListener('download document',
	function(args) {
		if(args.reloadDocs){
			//og.openLink(og.getUrl('files', 'list_files'));
			og.panels.documents.reload();
		}	
		location.href = og.getUrl('files', 'download_file', {id: args.id, validate:0});
	}
);

og.eventManager.addListener('config option changed',
	function(option) {
		og.config[option.name] = option.value;
	}
);

og.eventManager.addListener('tabs changed',
	function(option) {
		window.location.href = '<?php echo ROOT_URL?>';
	}
);
og.eventManager.addListener('logo changed',
	function(option) {
		window.location.href = '<?php echo ROOT_URL?>';
	}
);
og.eventManager.addListener('expand menu panel',
	function(options) {
		var animate = options.animate ? options.animate : true;
		if (options.expand) Ext.getCmp('menu-panel').expand(animate);
		else if (options.collapse) Ext.getCmp('menu-panel').collapse(animate);
	}
);

og.eventManager.addListener('after member save', 
	function (member){
		if (og.dimensions[member.dimension_id]){
			if (!og.dimensions[member.dimension_id][member.member_id]) {
				og.dimensions[member.dimension_id][member.member_id] = {};
				og.dimensions[member.dimension_id][member.member_id].id = member.member_id ;
			}
			og.dimensions[member.dimension_id][member.member_id].name=member.name; 
			og.dimensions[member.dimension_id][member.member_id].ot=member.object_type_id;
		}
	}
);

og.eventManager.addListener('ask to select member',
	function (member){
		
			if (og.preferences.access_member_after_add_remember == '1') {
	
				if (og.preferences.access_member_after_add) {
					var tree = Ext.getCmp("dimension-panel-" + member.dimension_id);
					if (tree) {
						setTimeout(function () {
							var treenode = tree.getNodeById(member.id);
							if (treenode) {
								treenode.fireEvent('click', treenode);
								og.Breadcrumbs.refresh(treenode);
							}
						}, 500);
					}
				}
				
			} else {
	
				var selected_member_name = member.sel_mem != '' ? member.sel_mem : lang('general view');
				
				var old_yes_text = Ext.MessageBox.buttonText.yes;
				var old_no_text = Ext.MessageBox.buttonText.no;
				Ext.MessageBox.buttonText.yes = lang('access member', '<span class="bold">'+ member.name +'</span>');
				Ext.MessageBox.buttonText.no = lang('stay at', '<span class="bold">'+ selected_member_name +'</span>');
	
				var html = lang('new member added popup msg', '<span class="bold">' + member.type + '</span>', '<span class="bold">' + member.name + '</span>') + '<br />';
				html += lang('what would you like to do next') + '<br /><br />';
				html += '<input type="checkbox" name="remember_after_member_add" id="remember_after_member_add">&nbsp;';
				html += '<label for="remember_after_member_add" style="cursor:pointer;display:inline;font-weight:normal;font-size:100%;margin:0;">' + 
					lang('remember my choice and do not ask again in the future') + '</label><br />';
				html += '<span class="bold">'+ lang('message') +': </span>' + lang('this user option can be changed');
	
				Ext.Msg.show({
					title: lang('new member added popup title', member.type, member.name),
					msg: html,
					buttons: Ext.Msg.YESNO,
					fn: function(button, text){
	
						if (button == 'yes') {
							var tree = Ext.getCmp("dimension-panel-" + member.dimension_id);
							if (tree) {
								var treenode = tree.getNodeById(member.id);
								if (treenode) {
									treenode.fireEvent('click', treenode);
									og.Breadcrumbs.refresh(treenode);
								}
							}
						}
					
						var remember = document.getElementById("remember_after_member_add").checked;
						if (remember) {
							og.openLink(og.getUrl('account', 'update_user_preference', {name:'access_member_after_add_remember', value:'1'}));
							og.openLink(og.getUrl('account', 'update_user_preference', {name:'access_member_after_add', value: button == 'yes' ? '1' : '0'}));
						}
					
					},
					icon: Ext.MessageBox.QUESTION
				});
	
				Ext.MessageBox.buttonText.yes = old_yes_text;
				Ext.MessageBox.buttonText.no = old_no_text;			
			}
	}
);

og.eventManager.addListener('new document add save as button',
	function (data){
		var button = Ext.getCmp(data.genid + 'save_new_name');
		if (button) button.show();
		var button2 = Ext.getCmp(data.genid + 'save_as_name');
		if (button2) button2.setText(lang('save as', '<b>'+data.name+'</b>'));
	}
);
</script>