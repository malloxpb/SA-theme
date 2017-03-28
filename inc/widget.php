<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

add_action('widgets_init', function() {

	register_sidebar(array(
		'name'          => __('Sidebar', 'sydney'),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Under sidebar', 'sydney'),
		'id'            => 'under-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Under Home page Slider', 'sydney'),
		'id'            => 'under-slider',
		'description'   => 'Under the Home page slider',
		'before_widget' => '<div class="under-slider">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	));

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar(array(
			'name'          => __('Footer ', 'sydney') . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}
});


class Sydney_Contact_Info extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'sydney_contact_info_widget', 'description' => __( 'Display your contact info', 'sydney') );
        parent::__construct(false, $name = __('Sydney: Contact info', 'sydney'), $widget_ops);
		$this->alt_option_name = 'sydney_contact_info';	
    }
	
	function form($instance) {

		$title    = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$address  = isset( $instance['address'] ) ? esc_html( $instance['address'] ) : '';
		$phone    = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';
		$email    = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'sydney'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Enter your address', 'sydney' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Enter your phone number', 'sydney' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" size="3" /></p>

	<p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Enter your email address', 'sydney' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" size="3" /></p>	

	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['email'] = sanitize_email($new_instance['email']);

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['sydney_contact_info']) )
			delete_option('sydney_contact_info');		  
		  
		return $instance;
	}
		
	function widget($args, $instance) {
		$cache = array();
		if (! $this->is_preview()) {
			$cache = wp_cache_get( 'sydney_contact_info', 'widget' );
		}

		if (! is_array($cache)) {
			$cache = array();
		}

		if (! isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title 		= (! empty($instance['title'])) ? $instance['title'] : '';
		$title 		= apply_filters('widget_title', $title, $instance, $this->id_base);
		$address   	= isset($instance['address']) ? esc_html( $instance['address']) : '';
		$phone   	= isset($instance['phone'] ) ? esc_html( $instance['phone']) : '';
		$email   	= isset($instance['email'] ) ? antispambot(esc_html( $instance['email'])) : '';

		echo $before_widget;
		
		if ($title) echo $before_title . $title . $after_title;
		
		if ($address) {
			echo '<div class="contact-address">';
			echo '<span><i class="fa fa-home"></i></span>' . $address;
			echo '</div>';
		}
		if ($phone) {
			echo '<div class="contact-phone">';
			echo '<span><i class="fa fa-phone"></i></span>' . $phone;
			echo '</div>';
		}
		if ($email) {
			echo '<div class="contact-email">';
			echo '<span><i class="fa fa-envelope"></i></span>' . '<a href="mailto:' . $email . '">' . $email . '</a>';
			echo '</div>';
		}				

		echo $after_widget;


		if (! $this->is_preview()) {
			$cache[$args['widget_id']] = ob_get_flush();
			wp_cache_set('sydney_contact_info', $cache, 'widget');
		} else {
			ob_end_flush();
		}
	}
	
}

register_widget('Sydney_Contact_Info');


class Facebook_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display your social profile on your front page', 'sydney') );
		parent::__construct( 'facebook_widget', __('Facebook Page Plugin Widget', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

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
		
		if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce">' . $instance['title'] . '</span>' . $args['after_title'];
		}
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

register_widget('Facebook_Widget');


class Club_Preview extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display a slider of club thumbnails', 'sydney') );
		parent::__construct( 'Club_Preview', __('Club thumnnails slider', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
        ?>

        <?php if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce">' . $instance['title'] . '</span>' . $args['after_title'];
		}?>
        <div class="owl-carousel owl-theme">
            <?php
            $clubargs = [
                'posts_per_page'   => 15,
				'post_type'        => 'club',
				'meta_query' => array(array('key' => '_thumbnail_id'))
            ];
            $loop = new WP_Query($clubargs);
            while ($loop->have_posts()) {
                $loop->the_post();
            ?>
    		<div class="item">
        		<a class="owl-coverlink" href="<?php echo get_site_url() . "/clubsandorganizations"; ?>"></a>
				<?php the_post_thumbnail('sydney-medium-thumb'); ?>
			</div>

            <?php
            }
            wp_reset_query();
            ?>
        </div>
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

register_widget('Club_Preview');

class Instagram_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display a grid of instagram pictures', 'sydney') );
		parent::__construct( 'Instagram_Widget', __('Instagram latest posts', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
        ?>

        <?php if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce instagram-title">' . $instance['title'] . '</span>' . $args['after_title'];
		}?>
        <iframe src="https://snapwidget.com/embed/358809" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
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

register_widget('Instagram_Widget');