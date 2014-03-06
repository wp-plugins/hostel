<div class="wrap">
	<h1><?php _e("Hostel Options", 'wphostel')?></h1>
	
	<form method="post" class="wphostel-form">
		<div class="postbox wphostel-box">
			<div><label><?php _e("Currency:", 'wphostel');?></label>
				<select name="currency">
				<?php foreach($currencies as $key=>$val):
	            if($key==$currency) $selected='selected';
	            else $selected='';?>
	        		<option <?php echo $selected?> value='<?php echo $key?>'><?php echo $val?></option>
	         <?php endforeach; ?>
				</select></div>
			<div><label><?php _e('Booking mode:', 'wphostel')?></label> <select name="booking_mode" onchange="changeBookingMode(this.value);">
				<option value="none" <?php if($booking_mode == 'none') echo 'selected'?>><?php _e('No booking', 'wphotel')?></option>		
				<option value="manual" <?php if($booking_mode == 'manual') echo 'selected'?>><?php _e('Manual / No Payment', 'wphotel')?></option>
				<option value="paypal" <?php if($booking_mode == 'paypal') echo 'selected'?>><?php _e('Paypal', 'wphotel')?></option>
				</select>
				<div class="wphostel-help">
					<p><strong><?php _e('No booking', 'wphostel')?></strong> <?php _e('- In this mode your site will only show the information for the rooms and will not let the visitors book rooms', 'wphostel')?></p>
					
					<p><strong><?php _e('Manual / No Payment', 'wphotel')?></strong> <?php _e('- In this mode your visitors will be able to request booking by clicking on button and filling their information in the booking form. You as admin will approve or reject the booking manually in the admin panel.', 'wphostel')?></p>
					<p><strong><?php _e('Paypal', 'wphotel')?></strong> <?php _e('- In this mode your visitors will be able to book and get their bookings activated instantly by paying by Paypal', 'wphostel')?></p>
				</div>		
			</div>	
			
			<div id="wphostelBookingEnabled" style="display:<?php echo ($booking_mode!='none')?'block':'none'?>">
				<label><?php _e('Booking form URL:', 'wphostel')?></label> <input type="text" name="booking_url" value="<?php echo get_option('wphostel_booking_url');?>" size="40"> <?php printf(__('This is the URL of the post or page where you have published the <a href="%s" target="_blank">booking form shortcode</a>', 'wphostel'), "admin.php?page=wphostel_help");?>
			</div>
			
			<div id="wphostelPaypal" style="display:<?php echo ($booking_mode=='paypal')?'block':'none'?>">
				<label><?php _e('Your Paypal Email:', 'wphostel')?></label> <input type="text" name="paypal" value="<?php echo @$paypal?>">
			</div>
			
				<div><input type="checkbox" name="do_email_admin" value="1" <?php if(!empty($email_options['do_email_admin'])) echo 'checked'?> onclick="jQuery('#emailAdminOptions').toggle();"> <?php _e('Send me email with booking details when someone makes or requests a booking','wphostel')?> </div>
			
			<div id="emailAdminOptions" style="display:<?php echo empty($email_options['do_email_admin'])? 'none' : 'block'?>;margin-left:100px;">
					<div><label><?php _e('Email address to receive the notice:', 'wphostel')?></label> <input type="text" name="admin_email" value="<?php echo empty($email_options['admin_email']) ? get_option('admin_email') : $email_options['admin_email']?>"></div>		
					<div><label><?php _e('Email subject:', 'wphostel')?></label> <input type="text" name="email_admin_subject" value="<?php echo $email_options['email_admin_subject']?>" size="40"></div>
					<div><label><?php _e('Email message:', 'wphostel')?></label> <?php echo wp_editor(stripslashes(@$email_options['email_admin_message']), 'email_admin_message')?></div>
					<p><?php _e('You can use the following variables:', 'wphostel')?> <b>{{from-date}}</b>, <b>{{to-date}}</b>, <b>{{url}}</b> <?php _e('(The URL to see the booking details in admin)','wphostel')?>, <b>{{contact-name}}</b>, <b>{{contact-email}}</b>, <b>{{contact-phone}}</b>, <b>{{timestamp}}</b> <?php _e('(Date/time when reservation is made)','wphostel')?></p>
			</div>
			
			<div><input type="checkbox" name="do_email_user" value="1" <?php if(!empty($email_options['do_email_user'])) echo 'checked'?> onclick="jQuery('#emailUserOptions').toggle();"> <?php _e('Send confirmation email to user when booking is made','wphostel')?> </div>
			
				
			<div id="emailUserOptions" style="display:<?php echo empty($email_options['do_email_user'])? 'none' : 'block'?>;margin-left:100px;">					
					<div><label><?php _e('Email subject:', 'wphostel')?></label> <input type="text" name="email_user_subject" value="<?php echo $email_options['email_user_subject']?>" size="40"></div>
					<div><label><?php _e('Email message:', 'wphostel')?></label> <?php echo wp_editor(stripslashes(@$email_options['email_user_message']), 'email_user_message')?></div>
					<p><?php _e('You can use the following variables:', 'wphostel')?> <b>{{from-date}}</b>, <b>{{to-date}}</b>, <b>{{amount-paid}}</b>, 
					<b>{{amount-due}}</b>, <b>{{room-type}}</b>, <b>{{num-beds}}</b>, <b>{{timestamp}}</b> <?php _e('(Date/time when reservation is made)','wphostel')?></p>
			</div>
			
			<p><input type="submit" value="<?php _e('Save Options', 'wphostel')?>"></p>
			<input type="hidden" name="ok" value="1">
		</div>
	</form>
	
		<p><?php printf(__('Your feedback is most welcome! Please <a href="%s" target="_blank">let us know</a> what features and improvements you would like to see in the plugin.', 'wphostel'), 'http://wordpress.org/support/plugin/hostel')?></p>
</div>	

<script type="text/javascript" >
function changeBookingMode(val) {
	if(val=='paypal') jQuery('#wphostelPaypal').show();
	else jQuery('#wphostelPaypal').hide();
	
	if(val!='none') jQuery('#wphostelBookingEnabled').show();
	else jQuery('#wphostelBookingEnabled').hide();
}
</script>