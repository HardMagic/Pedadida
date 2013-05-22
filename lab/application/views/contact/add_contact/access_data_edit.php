<?php
	$permission_groups = array(); 
	$groups = PermissionGroups::getNonPersonalSameLevelPermissionsGroups('id');
	foreach($groups as $group){
    	$permission_groups[] = array($group->getId(), lang($group->getName()));
    }
    $genid = gen_id();
    $jqid = "#$genid";
?>
<script>
	$(function(){
		
		function passwordError(message) {
			$("<?php echo $jqid ?> .password input,<?php echo $jqid ?> .repeat input").addClass("field-error").val("");
			$("<?php echo $jqid ?> .password input").addClass("field-error").focus().val('');
			
			$("<?php echo $jqid ?> .field-error-msg").remove();
			$("<?php echo $jqid ?> .password").append("<div class='field-error-msg'>"+message+"</div>");		
		}

		function passwordOk(){
			$("<?php echo $jqid ?> .field-error-msg").remove();
			$("<?php echo $jqid ?> .password input, <?php echo $jqid ?> .repeat input").removeClass("field-error");
		}

		$("<?php echo $jqid ?>.access-data #create-user").click(function(){
			if ($(this).is(":checked")) {
				$("<?php echo $jqid ?>.access-data .user-data").slideDown();
				$("<?php echo $jqid ?> .password input").focus();
				$("<?php echo "#$orig_genid" ?>add_contact_select_context_div").slideUp();
				$("<?php echo "#$orig_genid" ?>related_to_link").hide();
			} else {
				$("<?php echo $jqid ?>.access-data .user-data").slideUp();
				$("<?php echo "#$orig_genid" ?>add_contact_select_context_div").slideDown();
				$("<?php echo "#$orig_genid" ?>related_to_link").show();
			}
		});
                
		
		$("<?php echo $jqid ?>.access-data #create-password").click(function(){
			if ($(this).is(":checked")) {
				$("<?php echo $jqid ?>.access-data .user-data-password").slideDown();
				$("<?php echo $jqid ?> .password input").focus();
			} else {
				$("<?php echo $jqid ?>.access-data .user-data-password").slideUp();
			}
		});


		$("<?php echo $jqid ?> .repeat input").blur(function(){
			if ( $(this).val() != $("<?php echo $jqid ?> .password input").val() ) { 
				passwordError(lang("passwords dont match")); 
			}else{
				passwordOk();
			}	
		});
		$("<?php echo $jqid ?> .password input").blur(function(){
			if($("<?php echo $jqid ?>.access-data #create-password").is(":checked")){
				if ($(this).val() == '') {
					passwordError(lang("password value missing"));
				}else if ( $("<?php echo $jqid ?> .repeat input").val() &&  $(this).val() != $("<?php echo $jqid ?> .repeat input").val() ) {
					passwordError(lang("passwords dont match"));
				}else{
					passwordOk();
				}
			}
		});


		$("#<?php echo $genid ?>specify-username").click(function(){
			if ($(this).is(":checked")) {
				$("#<?php echo $genid ?>profileFormUsername").show();
			} else {
				$("#<?php echo $genid ?>profileFormUsername").hide();
			}
		});

		$("<?php echo $jqid ?>.access-data #notify-user").click(function(){
			if ($(this).is(":checked")) {
				$("<?php echo $jqid ?>.access-data #create-password").attr("disabled", false);
				$("<?php echo $jqid ?>.access-data #create-password").attr("checked", true);
			} else {
				$("<?php echo $jqid ?>.access-data #create-password").attr("checked", true);
				$("<?php echo $jqid ?>.access-data #create-password").attr("disabled", true);
				
				$("<?php echo $jqid ?>.access-data .user-data-password").slideDown();
				$("<?php echo $jqid ?> .password input").focus();
			}
		});
		
	});

</script>

<div id = "<?php echo $genid ?>" class="access-data"> 
	<label class="checkbox" ><?php echo lang("will this person use feng office?") ?></label><input class="checkbox" type="checkbox" name="contact[user][create-user]" <?php if(!$contact_mail){echo "checked";}?> id="create-user"></input>
	<div class="clear"></div>

	<div class="user-data" <?php if($contact_mail){echo "style='display:none'";}?>>
		
			<label class="checkbox"><?php echo lang('send task assigned to notification') ?></label>
			<input class="checkbox" type="checkbox" name="notify-user" <?php if(user_config_option("sendEmailNotification",1,logged_user()->getId())){echo "checked";}?> id="notify-user"></input>
	
		<div class="clear"></div>
		<label class="checkbox" ><?php echo lang("specify password?") ?></label><input class="checkbox" type="checkbox" name="contact[user][create-password]" id="create-password"  <?php if(!user_config_option("sendEmailNotification",1,logged_user()->getId())){echo "disabled";}?>></input>
		<div class="clear"></div>
		<div class="user-data-password" style="display:<?php if(user_config_option("sendEmailNotification",1,logged_user()->getId())){echo "none";}?>;">
			<div class="field password">
				<label><?php echo lang("password")?>:</label><input name="contact[user][password]" type="password"></input>
			</div>
			<div class="field repeat">
				<label><?php echo lang("password again")?>:</label><input type="password" name="contact[user][password_a]"></input>
			</div>
		</div>          
		<div class="clear"></div>
		<div class="field role">
			<label><?php echo lang("user type")?>:</label><?php  echo simple_select_box('contact[user][type]', $permission_groups,4)?>
		</div>
	<?php if(isset($new_contact) && $new_contact){?>
		<div class="field role" style="margin-top:8px;">
			<label class="checkbox"><?php echo lang("specify username?")?></label>
			<input class="checkbox" type="checkbox" name="contact[specify_username]" id="<?php echo $genid ?>specify-username"/>
			<input id="<?php echo $genid ?>profileFormUsername" type="text" value="<?php echo array_var($contact_data, 'username')?>" name="contact[user][username]" maxlength="50" style="display: none; margin-left:5px;"/>
		</div>
		
			
	<?php }?>
	</div>	
</div>

<div class="clear"></div>
