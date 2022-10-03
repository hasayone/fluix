<?php
get_header();
the_post();
?>

<div id="content-blocks">
	<div class="wrapper">

		<?php the_content(); 	?>

	</div>
</div>

<?php get_footer(); ?>