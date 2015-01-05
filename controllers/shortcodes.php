<?php
class WPHostelShortcodes {
	public static $shortcode_ids;
	
	// displays and processes the booking form
	static function booking($shortcode_id = null) {
		global $wpdb, $post;
		if(empty($shortcode_id)) $shortcode_id = self :: get_id();
		ob_start();
		$booking_mode = get_option('wphostel_booking_mode');
		if($booking_mode == 'none') return __('Online booking is not enabled.', 'wphostel');
		
			
		// when coming from the list of rooms we have dates in GET
		$from_date = empty($_GET['from_date']) ? date("Y-m-d", strtotime("tomorrow")) : $_GET['from_date'];
		$to_date = empty($_GET['to_date']) ? date("Y-m-d", strtotime("+2 days")) : $_GET['to_date'];			
			
		// select all rooms		
		$rooms = $wpdb->get_results( "SELECT * FROM ".WPHOSTEL_ROOMS." ORDER BY title" );
		
		$dateformat = get_option('date_format');
			
		// display the booking form
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		include(WPHOSTEL_PATH."/views/booking-form.html.php");
				
		$content = ob_get_clean();
		return $content;
	} // end booking
	
	// list all rooms along with availability dropdown
	// will show cells for every date selected
	static function list_rooms($atts) {
		global $wpdb, $post;
		$shortcode_id = self :: get_id();	
		
		$dateformat = get_option('date_format');
		$booking_mode = get_option('wphostel_booking_mode');
		$min_stay = get_option('wphostel_min_stay');
		$default_dateto_diff = $min_stay ? strtotime("+ ".(intval($min_stay)+1)." days") : strtotime("+ 2 days");
		$max_days = empty($atts['max_days']) ? 5 : intval($atts['max_days']);
				
		// the dropdown defaults to "from tomorrow to 1 day after"
		$datefrom = empty($_POST['wphostel_from']) ? date("Y-m-d", strtotime("tomorrow")) : $_POST['wphostel_from'];
		$dateto = empty($_POST['wphostel_to']) ? date("Y-m-d", $default_dateto_diff) : $_POST['wphostel_to'];
		
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		
		include(WPHOSTEL_PATH."/views/list-rooms.html.php");
		$content = ob_get_clean();
		return $content;
	} // end list_rooms();	
	
	// displays a Book! button
	static function book($atts) {		
		global $post;
		$room_id = $atts[0];
		$shortcode_id = self :: get_id();
		
		// this if will be removed when bookiing by ajax is done 
		if(!empty($_GET['in_booking_mode']) and $_GET['room_id']==$room_id) {
			return self :: booking();
		}
		
		$text = empty($atts[1]) ? __('Book', 'wphostel') : $atts[1];
		
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		
		return '<div id="wphostelBookForm'.$shortcode_id.'">
		<form method="post">
		<input type="hidden" name="from_date" value="'.date("Y-m-d", strtotime('tomorrow')).'">
				<input type="hidden" name="to_date" value="'.date("Y-m-d", strtotime('+2 days')).'">
				<input type="hidden" name="room_id" value="'.$room_id.'">				
				<input type="hidden" name="action" value="wphostel_ajax">
				<input type="hidden" name="type" value="load_booking_form">
				<input type="hidden" name="in_booking_mode" value="1">		
		<input type="button"  onclick="WPHostelLoadBooking(this.form, '."'wphostelBookForm".$shortcode_id."'".');" value="'.$text.'">
		</form></div>';
	}
	
	// create unique ID for each shortcode on the page so at any time we know which shortcode we are working with
	// this is very important in case multiple shortcodes are used on a page
	static function get_id() {
		if( empty( self :: $shortcode_ids )) self :: $shortcode_ids = array();
		$current_id = sizeof(self :: $shortcode_ids);
		$current_id++;
		self :: $shortcode_ids[] = $current_id;
		return $current_id;
	}
}