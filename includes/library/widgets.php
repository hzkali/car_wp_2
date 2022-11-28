<?php
/// Latest comments
class Bunch_Latest_Comments extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Latest_Comments', /* Name */esc_html__('Carshire Latest Comments','carshire'), array( 'description' => esc_html__('Show the Latest Comments', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number_of_comments = $instance['number_of_comments'];
		echo wp_kses_post($before_widget); ?>
		
		<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<?php $comments = get_comments(array('number'=>$number_of_comments));
			//carshire_printr($comments);
					foreach($comments as $key => $value):?>
			<div class="comment">
				<div class="comment-info"><a href="<?php echo esc_url(get_permalink($value->comment_post_ID).'#comments');?>"><?php echo get_comment_date("F jS, Y", $value->comment_ID);?></a> / <?php esc_html_e('by', 'carshire');?> <?php echo wp_kses_post(carshire_set($value,'comment_author')); ?> </div>
				<div class="comm-box">
					<p><a href="<?php echo esc_url(get_permalink($value->comment_post_ID).'#comments');?>"><?php echo '“'; echo wp_kses_post(carshire_bunch_trim( carshire_set( $value, 'comment_content' ), 9)); echo '”';?></a></p>
					<div class="text-right"><a href="<?php echo esc_url(get_permalink($value->comment_post_ID).'#comments');?>" class="read-more"></a></div>
				</div>
			</div>
			<?php endforeach;
				wp_reset_postdata(); 
			?>
		
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_of_comments'] = $new_instance['number_of_comments'];
		
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest Comments', 'carshire');
		$number_of_comments = ( $instance ) ? esc_attr($instance['number_of_comments']) : 2;
		?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_comments')); ?>"><?php esc_html_e('No. of Comments:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number_of_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_comments')); ?>" type="text" value="<?php echo esc_attr( $number_of_comments ); ?>" />
        </p>
       
            
		<?php 
	}
	
}
/// Recent Posts 
class Bunch_Recent_Post_With_Image extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Recent_Post_With_Image', /* Name */esc_html__('Carshire Recent Posts with image','carshire'), array( 'description' => esc_html__('Show the recent posts with images', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<!-- Latest Posts -->
		<div class="widget latest-posts">
			<h3><?php echo wp_kses_post($before_title.$title.$after_title); ?></h3>
			
			<?php $query_string = 'posts_per_page='.$instance['number'];
					if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
					query_posts( $query_string ); 
					
					$this->posts();
					wp_reset_query();
			?>
			
		</div>
		 
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recently Added', 'carshire');
		$number = ( $instance ) ? esc_attr($instance['number']) : 5;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'carshire'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'carshire'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        
           	<!-- Title -->
				<?php while( have_posts() ): the_post(); ?>
                    
                    <div class="post">
						<div class="post-thumb"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('carshire3');?></a></div>
						<h4><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php echo wp_kses_post(carshire_bunch_trim(get_the_title(), 3));?></a></h4>
						<div class="post-info"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php echo get_the_date('F d, Y');?></a>  / &nbsp;<a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments');?>"><span class="fa fa-comments"></span> &nbsp; <?php comments_number('0', '1', '%');?></a></div>
					</div>
				<?php endwhile; ?>
                
        <?php endif;
    }
}
/// Contact info 
class Bunch_Contact_Info_Sidebar extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Conatct_Info_Sidebar', /* Name */esc_html__('Carshire Contact Info Sidebar','carshire'), array( 'description' => esc_html__('Show the Contact Information', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<div class="widget cont-info">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="cont-box">
				<div class="text"><?php echo wp_kses_post($instance['text']);?></div>
				<ul class="info">
					<li><strong><?php esc_html_e('Email', 'carshire');?></strong> <a href="mailto:<?php echo sanitize_email($instance['email']);?>"><?php echo sanitize_email($instance['email']);?></a></li>
					<li><strong><?php esc_html_e('Phone', 'carshire');?></strong> <a href="#"><?php echo wp_kses_post($instance['phone']);?></a></li>
					<li><strong><?php esc_html_e('Fax', 'carshire');?></strong> <a href="#"><?php echo wp_kses_post($instance['fax']);?></a></li>
					<li><strong><?php esc_html_e('Website', 'carshire');?></strong> <a href="<?php echo esc_url($instance['website']);?>"><?php echo wp_kses_post($instance['website']);?></a></li>
				</ul>
			</div>
			
		</div>
		
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = $new_instance['text'];
		$instance['email'] = $new_instance['email'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['website'] = $new_instance['website'];
		
		
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Contact Information', 'carshire');
		$text = ( $instance ) ? esc_attr($instance['text']) : '';
		$email = ( $instance ) ? esc_attr($instance['email']) : '';
		$phone = ( $instance ) ? esc_attr($instance['phone']) : '';
		$fax = ( $instance ) ? esc_attr($instance['fax']) : '';
		$website = ( $instance ) ? esc_attr($instance['website']) : '';
		
		?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Text:', 'carshire'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php esc_html_e('Fax:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('website')); ?>"><?php esc_html_e('website:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('website')); ?>" name="<?php echo esc_attr($this->get_field_name('website')); ?>" type="text" value="<?php echo esc_attr( $website ); ?>" />
        </p>
		
		
            
		<?php 
	}
	
}
///----footer widgets---
/// Contact info 
class Bunch_Contact_Info extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Conatct_Info', /* Name */esc_html__('Carshire Contact Info','carshire'), array( 'description' => esc_html__('Show the Contact Information', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<div class="contact-widget">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="text"><?php echo wp_kses_post($instance['text']);?></div>
			<ul class="info">
				<li><strong><?php esc_html_e('Email', 'carshire');?></strong> <a href="mailto:<?php echo sanitize_email($instance['email']);?>"><?php echo sanitize_email($instance['email']);?></a></li>
				<li><strong><?php esc_html_e('Phone', 'carshire');?></strong> <a href="#"><?php echo wp_kses_post($instance['phone']);?></a></li>
				<li><strong><?php esc_html_e('Fax', 'carshire');?></strong> <a href="#"><?php echo wp_kses_post($instance['fax']);?></a></li>
				<li><strong><?php esc_html_e('Website', 'carshire');?></strong> <a href="<?php echo esc_url($instance['website']);?>"><?php echo wp_kses_post($instance['website']);?></a></li>
			</ul>
		</div>
		
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = $new_instance['text'];
		$instance['email'] = $new_instance['email'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['website'] = $new_instance['website'];
		
		
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Contact Information', 'carshire');
		$text = ( $instance ) ? esc_attr($instance['text']) : '';
		$email = ( $instance ) ? esc_attr($instance['email']) : '';
		$phone = ( $instance ) ? esc_attr($instance['phone']) : '';
		$fax = ( $instance ) ? esc_attr($instance['fax']) : '';
		$website = ( $instance ) ? esc_attr($instance['website']) : '';
		
		?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Text:', 'carshire'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php esc_html_e('Fax:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('website')); ?>"><?php esc_html_e('website:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('website')); ?>" name="<?php echo esc_attr($this->get_field_name('website')); ?>" type="text" value="<?php echo esc_attr( $website ); ?>" />
        </p>
		
		
            
		<?php 
	}
	
}
/// Services Posts 
class Bunch_Services_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Services_Posts', /* Name */esc_html__('Carshire Services Posts','carshire'), array( 'description' => esc_html__('Show the recent posts of services', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<div class="services-widget">
			
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			
			<?php 
				$args = array('post_type' => 'bunch_services', 'showposts'=>$instance['number']);
				if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'services_category','field' => 'id','terms' => (array)$instance['cat']));
				query_posts($args); 
					
					$this->posts();
					wp_reset_query();
			?>
		</div>
		
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Our Services', 'carshire');
		$number = ( $instance ) ? esc_attr($instance['number']) : 5;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'carshire'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'carshire'), 'selected'=>$cat, 'taxonomy' => 'services_category', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        
           	<!-- Title -->
				
                <ul class="links">
				
				<?php while( have_posts() ): the_post(); 
					$services_meta = _WSH()->get_meta();
				?>
				
					<li><a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>"><i class="fa fa-check-circle"></i><?php the_title();?></a></li>
					
				
				<?php endwhile; ?>
				</ul>
			
        <?php endif;
    }
}
/// FAQs Posts 
class Bunch_Faqs_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Faqs_Posts', /* Name */esc_html__('Carshire Faqs Posts','carshire'), array( 'description' => esc_html__('Show the recent posts of faqs', 'carshire' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
		<div class="services-widget">
			
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			
			<?php 
				$args = array('post_type' => 'bunch_faqs', 'showposts'=>$instance['number']);
				if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'faqs_category','field' => 'id','terms' => (array)$instance['cat']));
				query_posts($args); 
					
					$this->posts();
					wp_reset_query();
			?>
		</div>
		
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Our Support', 'carshire');
		$number = ( $instance ) ? esc_attr($instance['number']) : 5;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'carshire'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'carshire'), 'selected'=>$cat, 'taxonomy' => 'faqs_category', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        
           	<!-- Title -->
				
                <ul class="links">
				
				<?php while( have_posts() ): the_post(); 
					$services_meta = _WSH()->get_meta();
				?>
				
					<li><a href="<?php echo esc_url(carshire_set($services_meta, 'ext_url'));?>"><i class="fa fa-check-circle"></i><?php the_title();?></a></li>
					
				
				<?php endwhile; ?>
				</ul>
			
        <?php endif;
    }
}
// Contactform
class Bunch_Contactform extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Contactform', /* Name */esc_html__('Carshire Contact form','carshire'), array( 'description' => esc_html__('Carshire Contact form', 'carshire' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);
		?>
		<div class="footer-widget newsletter-widget">
			<?php echo wp_kses_post($before_title.$title.$after_title);?>
			<?php echo do_shortcode($instance['subcribe_form']);?>
			
		</div>
		
        <?php
		
		echo wp_kses_post($after_widget);
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subcribe_form'] = strip_tags($new_instance['subcribe_form']);
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Contact Form', 'carshire');
		$subcribe_form = ($instance) ? esc_attr($instance['subcribe_form']) : '';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'carshire'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('subcribe_form')); ?>"><?php esc_html_e('Contact Form Code:', 'carshire'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('subcribe_form')); ?>" name="<?php echo esc_attr($this->get_field_name('subcribe_form')); ?>" ><?php echo wp_kses_post($subcribe_form); ?></textarea>
        </p>
       	<?php 
	}
}