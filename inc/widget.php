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
		'name'          => __('Above the nav bar', 'sydney'),
		'id'            => 'above-header',
		'description'   => '',
		'before_widget' => '<div class="above-header">',
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

		echo $args['before_widget'];
		
		if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce">' . $instance['title'] . '</span>' . $args['after_title'];
		}
		?>

		<!-- facebook plugin -->
		<div class="fb-page"
		  data-lazy-widget="facebook"
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


class Event_Preview extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display a slider of events thumbnails', 'sydney') );
		parent::__construct( 'Event_Preview', __('Events thumnnails slider', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		echo $args['before_widget'];
        ?>
        <div class="owl-carousel owl-theme">
            <?php
            $eventargs = [
            	'category_name' => 'club-events',
				'post_type' => 'post',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'post_status' => 'publish',

            ];
            $loop = new WP_Query($eventargs);
            while ($loop->have_posts()) {
                $loop->the_post();
            ?>
    		<div class="item grid-container">
        		<a class="owl-coverlink" href="<?php echo esc_url( get_permalink() ); ?>"></a>
    			<div class="grid-33">
					<?php the_post_thumbnail('sydney-extra-small-thumb'); ?>
				</div>
				<div class="grid-66">
					<h3>
					<?php
						$title = get_the_title();
						if (strlen($title) <= 20) {
							echo $title;
						} else {
							echo substr($title, 0, 20) . "...";
						}
					?>
					</h3><br>
					<?php echo the_excerpt(); ?>
				</div>
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
		return $instance;
	}

	function form( $instance ) {
		?>
		<br><br>
		<?php
	}
}

register_widget('Event_Preview');

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
        <iframe data-src="https://snapwidget.com/embed/358809" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
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

/*
class Event_Listing extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display a list of upcoming events', 'sydney') );
		parent::__construct( 'Event_Listing', __('Event widget', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
        ?>

        <?php if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce instagram-title">' . $instance['title'] . '</span>' . $args['after_title'];
		}

		$args = array(
			'category_name'    => 'club-events',
			'orderby'          => 'date',
		    'order'            => 'DESC',
		    'posts_per_page'   => 2,
			'post_type'        => 'post',
		);

		$postslist = new WP_Query($args);

		if ($postslist->have_posts()) :
	        while ($postslist->have_posts()) : 
	        	$postslist->the_post(); 
	    		get_template_part( 'page-templates/content', 'post' );
	        endwhile;
	    endif;
			
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

register_widget('Event_Listing');

class Calendar_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Display a calendar of upcoming events', 'sydney') );
		parent::__construct( 'Calendar_Widget', __('Up coming events calendar', 'sydney'), $widget_ops );
	}

	function widget($args, $instance) {
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
        ?>

        <?php if ( !empty($instance['title']) ) {
			echo $args['before_title'] . '<span class="wow bounce instagram-title">' . $instance['title'] . '</span>' . $args['after_title'];
		}?>
        <iframe src="https://calendar.google.com/calendar/embed?src=nr44hnf7rhbmkf9g6ucfmh2jec%40group.calendar.google.com&showTitle=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;ctz=America%2FNew_York" style="border-width:0" width="360" height="360" frameborder="0" scrolling="no"></iframe>
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

register_widget('Calendar_Widget');
*/
