<div class="wrap">
	<h1><?php _e('Hostel for WordPress', 'wphostel')?></h1>
	
	<p><b><?php printf(__('This plugin is a light version of <a href="%s" target="_blank">Hostel PRO</a>', 'wphostel'), 'http://wp-hostel.com')?></b></p>
	
	<div class="postbox-container" style="width:73%;margin-right:2%;">
	<p><?php _e('This is a plugin for managing hostels, BNB sites, and small hotel sites. You get an area where to manage your available rooms and prices, and the bookings made by visitors. Start with the main settings page to set up your booking mode, currency etc. Then once you enter your property and room details, you can use the following shortcodes:', 'wphostel')?></p>
	
	<ol>
		<li><input type="text" value="[wphostel-list]" readonly onclick="this.select();"> <?php _e('will display a table with your available rooms. A date selector on the top lets the user choose dates of their visit and then the rooms list is updated. If you have enabled booking in your Hostel settings page, the table will also show "Book" button when appropriate. The button will automaically load the booking form', 'wphostel')?>
			<?php _e('This shorcode accepts arguments which allow you to specify whether room title should be shown in the table and the maxinimum days allowed for seletion. The argument can be set to 0 (means "do not show") and 1 (means "show"):', 'wphostel')?>
			<ol>
				<li>show_titles - <?php _e('Show / hide room titles. Defaults to 0.', 'hostelpro')?></li>
				<li>max_days - <?php _e('Specify the maximum interval of days that can be selected from the calendars. For example [wphostel-list max_days=10] will allow interval of 10 days. Default is 5.', 'wphostel')?></li>
			</ol>	
		</li>
		<li><input type="text" value="[wphostel-booking]" readonly onclick="this.select();"> <?php _e('displays a generic booking form with a drop-down selector for choosing room, and a date selector. If you use the [wphostel-list] shortcode you most probably do not need this one because the booking form is automatically generated.', 'wphostel');?></li>
	</ol>
	
	<p><?php printf(__('If you want to translate this plugin check out <a href="%s" target="_blank">this guide</a>. Our plugin textdomain is "wphostel" and you have to place your .po and .mo files in folder languages/', 'wphoistel'), 'http://blog.calendarscripts.info/how-to-translate-a-wordpress-plugin/');?></p>	
	</div>
	
	<div id="wphsotel-sidebar">
				<?php require(WPHOSTEL_PATH."/views/sidebar.html.php");?>
	</div>	
</div>