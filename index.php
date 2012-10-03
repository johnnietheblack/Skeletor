<?php get_header(); ?>

<div id="main">
	<h2>Home</h2>
	
	<?php if(have_posts()) { while(have_posts()) { the_post(); ?>
	<!-- POST STRUCTURE -->
	<?php }} ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>