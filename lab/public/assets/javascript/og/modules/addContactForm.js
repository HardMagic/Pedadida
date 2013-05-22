og.reloadCompanies = function ( context, genid ){
	Ext.Ajax.request({
		url: og.getUrl('contact', 'list_companies', { 'ajax':true, 'context': Ext.util.JSON.encode(context) }),
		success:  function(result, request) {
			var jsonData = Ext.util.JSON.decode(result.responseText);
			var companies = jsonData.companies ;
			
			var combo = document.getElementById(genid+"profileFormCompany");
			firstOption = combo.options[0];
			combo.innerHTML = '';
			
			combo.appendChild(firstOption);
			for (var i = 0 ; i < companies.length ; i++ ) {
				var option = document.createElement('option') ;
				option.innerHTML = companies[i].name ;
				option.value = companies[i].value ;
				combo.appendChild(option);
			}
			
			
		}
	});
}


og.addNewCompany = function(genid){
	var show = document.getElementById(genid + 'new_company').style.display == 'none';
	document.getElementById(genid + 'new_company').style.display = show ? 'block':'none';
	document.getElementById(genid + 'existing_company').style.display = show? 'none': 'block';
	document.getElementById(genid + 'hfIsNewCompany').value = show;
	document.getElementById(genid + 'duplicateCompanyName').style.display = 'none';
	document.getElementById(genid + 'profileFormNewCompanyName').value = '';
	if (show) document.getElementById(genid + 'profileFormNewCompanyName').focus();
	Ext.get(genid + 'submit1').dom.disabled = false;
	Ext.get(genid + 'submit2').dom.disabled = false;
};

og.checkNewCompanyName = function(genid) {
	var fff = document.getElementById(genid + 'profileFormNewCompanyName');
	var name = fff.value.toUpperCase();
	document.getElementById(genid + 'duplicateCompanyName').style.display = 'none';
	document.getElementById(genid + 'duplicateCompanyName').innerHTML = '';
	
	var select = document.getElementById(genid + 'profileFormCompany');
	for (var i = 1; i < select.options.length; i++){
		if (select.options[i].text.toUpperCase() == name){
			document.getElementById(genid + 'duplicateCompanyName').innerHTML = lang('duplicate company name', select.options[i].text, genid, i);
			document.getElementById(genid + 'companyInfo').style.display="none";
			document.getElementById(genid + 'duplicateCompanyName').style.display = 'block';
			Ext.get(genid + 'submit1').dom.disabled = true;
			Ext.get(genid + 'submit2').dom.disabled = true;
			document.getElementById(genid + 'duplicateCompanyName').focus();
			return;
		}
	}		
	Ext.get(genid + 'submit1').dom.disabled = false;
	Ext.get(genid + 'submit2').dom.disabled = false;
	document.getElementById(genid + 'companyInfo').style.display="block";
		
};

og.selectCompany = function(genid, index) {
	var select = document.getElementById(genid + 'profileFormCompany');
	select.selectedIndex = index;
	og.addNewCompany(genid);
	og.companySelectedIndexChanged(genid);
};

og.companySelectedIndexChanged = function(genid,data_js){
	select = document.getElementById(genid + 'profileFormCompany');
	Ext.get(genid + 'submit1').dom.disabled = true;
	Ext.get(genid + 'submit2').dom.disabled = true;
	
    og.openLink(og.getUrl('contact','get_company_data', {id: select.options[select.selectedIndex].value}), {
    	caller:this,
    	callback: function(success, data) {
    		if (success) {
				Ext.get(genid + 'submit1').dom.disabled = false;
				Ext.get(genid + 'submit2').dom.disabled = false;
				
    			if (data.id > 0){
	    			document.getElementById(genid + 'profileFormWAddress').value = data_js['adress'] ? data_js['adress'] :  data.address;
	    			document.getElementById(genid + 'profileFormWCity').value = data_js['city'] ? data_js['city'] : data.city;
	    			document.getElementById(genid + 'profileFormWState').value = data_js['state'] ? data_js['state'] : data.state;
					var list = document.getElementById(genid + 'profileFormWCountry');
					for (var i = 0; i < list.options.length; i++)
						if (list.options[i].value == data.country){
							list.selectedIndex = i;
							break;
						}
	    			document.getElementById(genid + 'profileFormWZipcode').value = data_js['zipCode'] ? data_js['zipCode'] : data.zipcode;
	    			document.getElementById(genid + 'profileFormWWebPage').value = data_js['web'] ? data_js['web'] : data.webpage;
	    			document.getElementById(genid + 'profileFormWPhoneNumber').value = data_js['phone'] ? data_js['phone'] : data.phoneNumber;
	    			document.getElementById(genid + 'profileFormWFaxNumber').value = data_js['fax'] ? data_js['fax'] : data.faxNumber;
	    			
	    		}else{
	    			var text = "";
	    			document.getElementById(genid + 'profileFormWAddress').value = data_js['adress'] ? data_js['adress'] :  text;
	    			document.getElementById(genid + 'profileFormWCity').value = data_js['city'] ? data_js['city'] : text;
	    			document.getElementById(genid + 'profileFormWState').value = data_js['state'] ? data_js['state'] : text;
	    			document.getElementById(genid + 'profileFormWZipcode').value = data_js['zipCode'] ? data_js['zipCode'] : text;
	    			document.getElementById(genid + 'profileFormWWebPage').value = data_js['web'] ? data_js['web'] : text;
	    			document.getElementById(genid + 'profileFormWPhoneNumber').value = data_js['phone'] ? data_js['phone'] : text;
	    			document.getElementById(genid + 'profileFormWFaxNumber').value = data_js['fax'] ? data_js['fax'] : text;
	    		}
    		}
    	}
    });
}

