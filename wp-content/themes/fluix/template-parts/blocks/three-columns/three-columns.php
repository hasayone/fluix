<?php

/**
 * Three Columns Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'three-columns-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-three-columns';
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

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/three-columns.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
		<div class="wrapper">
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
			if (have_rows('cards')) : ?>
				<div class="fls-three-columns__block">
					<?php // Check rows existexists.
					while (have_rows('cards')) : the_row();
						$image	 = get_sub_field('image');
						$title	 = get_sub_field('title');
						$content = get_sub_field('content');
					?>
						<div class="fls-three-columns__item">
							<?php if ($image <> '') : ?>
								<div class="fls-three-columns__item-image">
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" width="48">
								</div>
							<?php endif; ?>
							<?php if ($title <> '') : ?>
								<div class="fls-three-columns__item-title ">
									<h4 class="fls-title-l4"><?php echo $title; ?></h4>
								</div>
							<?php endif; ?>
							<?php if ($content <> '') : ?>
								<div class="fls-three-columns__item-content">
									<?php echo $content; ?>
								</div>
							<?php endif; ?>
						</div>

					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

<?php endif; ?>