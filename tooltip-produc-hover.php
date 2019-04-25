<?php 
/* 
Plugin Name: 	Display products info tooltips for woocommerce
Plugin URI: 	https://longvietweb.com/plugins/
Description: 	Woocommerce Product Hover
Tags: 			Woocommerce Product Hover
Author URI: 	https://longvietweb.com/
Author: 		LongViet
Version: 		1.0.1
License: 		GPL2
*/

defined( 'ABSPATH' ) or die( 'Nope :v' );
//register assets
add_action( 'wp_enqueue_scripts' , function(){
    wp_enqueue_script('wph_mainjs' , plugin_dir_url(__FILE__) . 'asset/main.js' , 'jquery' , '' , true );
    wp_enqueue_style('wph_maincss' , plugin_dir_url(__FILE__) . 'asset/main.css' );
});

// Display
add_action('woocommerce_after_shop_loop_item', 'display_front_ends');
function display_front_ends() {
    // Show on
    ?>
	<a class="wph_tooltip_box" href="<?php echo the_permalink(); ?>">
		<div class="wph_tooltip tooltip" >
			<strong class="wph_tooltip_title"><?php the_title();?></strong>
			<?php echo get_the_excerpt(); ?>
		</div>
	</a>
	<?php
}
/////////////////////////////////////////////
jQuery(document).ready(function($) {
  
	var $parent,
		windowWidth,
		windowHeight;
	  
	//get actual window size
	function winSize() {
		windowWidth = $(window).width(),
			windowHeight = $(window).height();
	}
	winSize();
	$(window).resize(winSize);
	//tooltip fadeIn and fadeOut on hover  
	$('.tooltip').each(function() {
	   
		$(this).parent().hover(function() {
		  $(this).find('.tooltip').fadeIn('fast');
		}, function() {
		   $(this).find('.tooltip').fadeOut('fast');
		});
	 
	});
  
  
	//tooltip position
	$(document).mousemove(function(e) {
		var mouseY = e.clientY,
			mouseX = e.clientX,
			tooltipHeight,
			tooltipWidth;
		
		$('.tooltip').each(function() {
		    var $tooltip = $(this);
		    tooltipHeight = $tooltip.outerHeight();
		    tooltipWidth = $tooltip.width();
		    $parent = $tooltip.parent();
		 
		    $tooltip.css({
			    'left':mouseX+0,
			    'top':mouseY+20
		    });
		  
		    //reposition
		    if (tooltipWidth + mouseX+ 20> windowWidth) {
		        $tooltip.css({
			        'left':mouseX-tooltipWidth-20
		        });
		    }
		
		    if (tooltipHeight + mouseY +20 > windowHeight) {
			    $tooltip.css({
			        'top':mouseY-20-tooltipHeight
		        }); 
		    }
		});
	});		
});//end ready

/* Css prevent blacked out text on the site */
body{
	 -webkit-touch-callout: none;
	 -webkit-user-select: none; 
	 -moz-user-select: none;    
	 -ms-user-select: none;     
	 -o-user-select: none;
	 user-select: none;
}
.wph_tooltip_box {
    overflow: hidden;
    margin-bottom: 10px;
    position: absolute;
    top: 0;
    left: 0;
    height: 80%;
    width: 100%;
}
.wph_tooltip_box ul {
    list-style:none;
    padding:0px;
    margin: 5px 0;
    border-top: 1px solid #e5e5e5;
}

.wph_tooltip_box strong{
    display: block;
}

.wph_tooltip * {
    height:initial !important;
}
.wph_tooltip {
    display:none;
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    font-size: 11px;
    width: 250px;
    height: auto;
    padding: 5px;
    border-radius: 3px;
    box-shadow: 0 1px 2px #666;
    background: #fff;
    color: #000 !important;
}

.wph_tooltip_box ul li{
    margin:2px;
}

.wph_tooltip .wph_tooltip_title {
    background-color:red;
    color: #fff;
    margin: -5px;
    margin-bottom: 3px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    padding: 5px;
}
.wph_tooltip img{
    display:none!important;
}

/*hide on small screen / mobile*/
@media (max-width: 600px) {
    .wph_tooltip{
        display:none!important;
    }
}
