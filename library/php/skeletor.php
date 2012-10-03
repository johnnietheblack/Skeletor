<?php

// kick it off
add_action('after_setup_theme','skeletor_in_the_house', 15);
function skeletor_in_the_house($options=array()) {
	global $skeletor_init;
	
	// Facebook Application ID
	if(isset($skeletor_init['facebook_application_id']) && $skeletor_init['facebook_application_id']) {
		define('SKELETOR_FACEBOOK_APPLICATION_ID',$skeletor_init['facebook_application_id']);
	}
	
    // launching operation cleanup
	if(!isset($skeletor_init['clean_header']) || $skeletor_init['clean_header'])
    	add_action('init', 'skeletor_clean_header');

    // remove WP version from RSS
	if(!isset($skeletor_init['remove_RSS']) || $skeletor_init['remove_RSS'])
    	add_filter('the_generator', 'skeletor_rss_version');

    // remove pesky injected css for recent comments widget
	if(!isset($skeletor_init['clean_comment_styles']) || $skeletor_init['clean_comment_styles']) {
    	add_filter( 'wp_head', 'skeletor_remove_wp_widget_recent_comments_style', 1 );

    	// clean up comment styles in the head
    	add_action('wp_head', 'skeletor_remove_recent_comments_style', 1);
	}
	
    // clean up gallery output in wp
    if(!isset($skeletor_init['clean_gallery_styles']) || $skeletor_init['clean_gallery_styles'])
		add_filter('gallery_style', 'skeletor_gallery_style');

	// load less
    if(!isset($skeletor_init['use_less']) || $skeletor_init['use_less']) {
		add_action( 'wp_head', 'skeletor_load_less' );
		
	// enqueue base css and styles
	}else{
		
	    add_action('wp_enqueue_scripts', 'skeletor_load_css', 999);
		
    	// ie conditional wrapper
    	add_filter( 'style_loader_tag', 'skeletor_ie_conditional', 10, 2 );
	}
	
	// add javascriptses
	add_action('wp_enqueue_scripts', 'skeletor_load_javascripts', 999);
    
    // launching this stuff after theme setup
    add_action('after_setup_theme','skeletor_theme_support');
    
    // cleaning up random code around images
	if(!isset($skeletor_init['clean_images']) || $skeletor_init['clean_images'])
	    add_filter('the_content', 'skeletor_filter_ptags_on_images');

    // cleaning up excerpt
	if(!isset($skeletor_init['clean_excerpt']) || $skeletor_init['clean_excerpt'])
    	add_filter('excerpt_more', 'skeletor_excerpt_more');
    
}

/*
* Clean up the extra crap in the WP header
*/
function skeletor_clean_header() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );                    
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );                          
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );                               
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );                       
	// index link
	remove_action( 'wp_head', 'index_rel_link' );                         
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
	// WP version
	remove_action( 'wp_head', 'wp_generator' );                           	
}

// remove WP version from RSS
function skeletor_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function skeletor_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
	
// remove injected CSS from recent comments widget
function skeletor_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function skeletor_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*
* SCRIPTING
*/

function skeletor_load_javascripts() {
	if (!is_admin()) {
    
    	// comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
	      wp_enqueue_script( 'comment-reply' );
	    }
    
	    // adding scripts file in the footer
	    wp_register_script( 'skeletor-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
	    wp_enqueue_script( 'skeletor-js' );

	} // END ! is_admin() 
}

function skeletor_load_css() {
	if (!is_admin()) {
		
	    // register main stylesheet
	    wp_register_style( 'skeletor-stylesheet',get_stylesheet_directory_uri().'/library/css/style.css',array(),'','all' );
	    wp_enqueue_style( 'skeletor-stylesheet' ); 
	
	    // ie-only style sheet
	    wp_register_style( 'skeletor-ie-only',get_stylesheet_directory_uri().'/library/css/ie.css',array(),'');
	    wp_enqueue_style( 'skeletor-ie-only' );
	}
}

function skeletor_load_less() {

	// Setting paths to the resources we will need later, js and styles
	$path_to_js 	= get_stylesheet_directory_uri() . '/library/js/';
	$path_to_less = get_stylesheet_directory_uri() . '/library/less/';

	// Actually printing the lines we need to load LESS in the HEAD
	echo "\n<!-- Loading LESS styles and js -->\n";
	echo "<link rel='stylesheet/less' id='style-less-css'  href='" . $path_to_less."style.less' type='text/css' media='screen, projection' />\n";
	echo "<script type='text/javascript' src='" . $path_to_js . "less-1.3.0.min.js'></script>\n\n";
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function skeletor_ie_conditional( $tag, $handle ) {
	if ( 'skeletor-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************
THEME SUPPORT
*********************/
	
// Adding WP 3+ Functions & Theme Support
function skeletor_theme_support() {
	
	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');   
	
	// default thumb size   
	set_post_thumbnail_size(125, 125, true);        
	
	// rss thingy           
	add_theme_support('automatic-feed-links'); 
	
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
	
	// adding post format support
	add_theme_support( 'post-formats',  
		array( 
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video 
			'audio',             // audio
			'chat'               // chat transcript 
		)
	);	
}

/*********************
RELATED POSTS FUNCTION
*********************/	
	
// Related Posts Function (call using skeletor_related_posts(); )
function skeletor_related_posts($tpl=null) {
	if(is_null($tpl)) {
		echo '<ul id="skeletor-related-posts">';
	}
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
        	'tag' => $tag_arr,
        	'numberposts' => 5, /* you can change this to show more */
        	'post__not_in' => array($post->ID)
     	);
        $related_posts = get_posts($args);
        if($related_posts) {
			if(is_null($tpl)) {
	        	foreach ($related_posts as $post) {
		 			setup_postdata($post); ?>
		           	<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
		        <?php } 
			}else{
				foreach ($related_posts as $post) {
		 			setup_postdata($post);
					get_template_part(ltrim($tpl,'/'));
				}
			}
		} else { ?>
            <?php echo '<li class="no_related_post">No Related Posts Yet!</li>'; ?>
		<?php }
	}
	wp_reset_query();
	if(is_null($tpl)) {
		echo '</ul>';
	}
}


/*********************
RANDOM CLEANUP ITEMS
*********************/	

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function skeletor_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function skeletor_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}