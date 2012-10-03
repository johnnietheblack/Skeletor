<?php
/*
* 1. Include main Skeletor files
*/
include 'library/php/skeletor.php';
$skeletor_init = array(
	'facebook_application_id' => '1234567890',
	'use_less' => false
);

/*
* 2. Skeletor Functions
*/
require_once 'library/php/functions.php';

/*
* 3. library/custom-post-type.php
* - an example custom post type
* - example custom taxonomy (like categories)
* - example custom taxonomy (like tags)
*/
require_once('library/php/custom_post_types.php'); // you can disable this if you like

/*
* 4. Custom image sizes
*/
require_once('library/php/custom_image_sizes.php'); // optional