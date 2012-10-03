<?php get_header(); ?>

<div id="main">
	<?php 
	// IF POST EXISTS
	if(have_posts()) { while(have_posts()) { the_post(); ?>
	<!-- SINGLE STRUCTURE -->
	
	<?php 
	// IF NO POST
	}else{ ?>

		<article id="post-not-found" class="hentry clearfix">
    		<header class="article-header">
    			<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
    		</header>
    		<section class="post-content">
    			<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
    		</section>
    		<footer class="article-footer">
    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
    		</footer>
		</article>

	<?php } ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>