<?php
 class Facebook_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display your social profile on your front page', 'sydney') );
		parent::__construct( 'facebook_widget', __('Facebook Page Plugin Widget', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		// default facebook page 
		$facebook = "https://www.facebook.com/plattsburghsa/?__mref=message_bubble";

		$mapping = [
			"studentassociation" => $facebook,
			"vnation" => "https://www.facebook.com/vnationpsu/",
			"dancecorp" => "https://www.facebook.com/SUNYPlattsburghDanceCorps/",
			"owe" => "https://www.facebook.com/groups/24127702851/",
			"autism" => "https://m.facebook.com/asusunyplattsburgh",
			"alarab" => "https://www.facebook.com/Club-Al-Arabiyya-1390613177876835/",
			"afa" => "https://www.facebook.com/AFAPlattsburgh",
			"investmentfund" => "https://www.facebook.com/groups/637399729730119/",
			"wqke" => "https://www.facebook.com/groups/24127702851/",
			"foodgroup" => "https://facebook.com/SUNYPlattsburghFoodGroup",
			"pava" => "https://www.facebook.com/groups/sunypava/",
			"ski" => "https://www.facebook.com/psuskiandsnowboard/",
			"acapella" => "https://www.facebook.com/MinorAdjustmentsMusic",
			"cec" => "https://www.facebook.com/groups/1496443317333226/",
			"southasian" => "https://www.facebook.com/SUNYPlattsburghSASA/"
			
		];

		foreach (get_the_category() as $category) {
			$cat_name = strtolower($category->cat_name);

			if (array_key_exists($cat_name, $mapping)) {
				$facebook = $mapping[$cat_name];

				// break the loop right after find the right page
				break;
			}
		}


		echo $args['before_widget'];
		
		if ( !empty($instance['title']) )
			echo $args['before_title'] . '<span class="wow bounce">' . $instance['title'] . '</span>' . $args['after_title'];
		?>

		<!-- facebook plugin --> 
		<div class="fb-page"
		  data-href="<?php echo $facebook; ?>" 
		  data-width="340"
		  data-hide-cover="false"
		  data-show-facepile="true"></div>
		
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'west') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php
	}
}