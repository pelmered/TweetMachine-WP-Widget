<?php

if(!class_exists('baseWidgetClass'))
    require_once('BaseWidget.class.php');

class TweetMachine_widget extends baseWidgetClass
{
    var $name = 'TweetMachine Widget';
   
   /* constructor */
   
   function __construct() 
   {
      parent::__construct( $this->name );
   }
   

   /** @see WP_Widget::widget */
   function widget($args, $instance)
   {
      $this->set_args( $args, $instance );
      $this->before_content();
      
      extract($args);
      $title = apply_filters('widget_title', $instance['title']);
      $content = $instance['content'];
      
      //Create content and put it in the $content variable
      
      $args['title'] = $title;
      $args['content'] = $content;
      ?>
    <div id="" class="tweets tweetmachine-feed"><img  class="twitter-placeholder" src="<?php echo TWEETMACHINE_BASE_URL; ?>img/ajax-loader.gif" /></div>
<?php
      
      $this->after_content();
   }

   /** @see WP_Widget::form */
   function form($instance)
   {
      $instance = wp_parse_args((array) $instance, array('title' => ''));
      $content = esc_attr($instance['content']);
      
      $alt_color = $instance['alt_color'];
      
      $this->before_form($instance);
      ?>
      
   <?php
      $this->after_form($instance);
         
         
   }

}

add_action('widgets_init', create_function('', 'return register_widget("TweetMachine_widget");'));
?>
