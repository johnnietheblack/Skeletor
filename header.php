<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
<head>
<meta charset="utf-8">

<title><?php wp_title('Title of this site'); ?></title>

<!-- Google Chrome Frame for IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- mobile meta -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!-- wordpress head functions -->
<?php wp_head(); ?>
<!-- end of wordpress head -->

<!-- drop Google Analytics Here -->
<!-- end analytics -->
	
</head>

<body <?php body_class(); ?>>
	<?php skeletor_include_facebook(); ?>

	<header id="header" role="banner">
		<div class="wrapper">
			<!-- HEADER CONTENT -->
		</div>
	</header>
	
	<div id="content" class="wrapper clearfix">