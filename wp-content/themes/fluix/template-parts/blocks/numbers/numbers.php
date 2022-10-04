<?php

/**
 * Numbers Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'numbers-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-numbers';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

// Load values
$title 						= get_field('title');

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/numbers.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo esc_attr($className); ?>">

		<div class="row">
			<div class="col-9 col-s-12">
				<?php if ($title <> '') : ?>
					<h2 class="fls-title-l2">
						<?php echo $title; ?>
					</h2>
				<?php endif; ?>
			</div>
		</div>

		<?php // Check rows existexists.
		if (have_rows('numbers')) :

			/* 
			 * It's counting the number of rows in the repeater field and 
			 * then setting the column width based on the number of rows. 
			 */
			$count  = count(get_field('numbers'));
			if ($count > 4) $count = 4;
			$col = 12 / $count;
		?>
			<div class="fls-numbers__block grid-col-<?php echo $col; ?>">
				<?php // Check rows existexists.
				while (have_rows('numbers')) : the_row();
					$before_text	 	= get_sub_field('before_text');
					$value	 				= get_sub_field('number_value');
					$description 		= get_sub_field('description');
				?>
					<div class="fls-numbers__item">
						<?php if ($before_text <> '') : ?>
							<div class="fls-numbers__item-before-text">
								<?php echo $before_text; ?>
							</div>
						<?php endif; ?>
						<?php if ($value <> '') : ?>
							<div class="fls-numbers__item-value ">
								<?php echo $value; ?>
							</div>
						<?php endif; ?>
						<?php if ($description <> '') : ?>
							<div class="fls-numbers__item-description">
								<?php echo $description; ?>
							</div>
						<?php endif; ?>
					</div>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

	</section>

<?php endif; ?>