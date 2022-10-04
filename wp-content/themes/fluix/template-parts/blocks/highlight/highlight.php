<?php

/**
 * Highlight Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'highlight-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-highlight';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

// Load values
$title 						= get_field('title');
$images						= get_field('images');
$image_desktop		= $images["desktop"];
$image_mobile			= $images["mobile"];

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/highlight.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<div class="wrapper">
			<div class="row">
				<div class="col-12 center">
					<?php if ($title <> '') : ?>
						<h2 class="fls-title-l2 fls-highlight__title">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>
				</div>
				<div class="row center">
					<div class="col-12">
						<?php if ($image_desktop <> '') : ?>
							<img class="fls-highlight__logos s-hide" src="<?php echo $image_desktop['url']; ?>" width="<?php echo $image_desktop['width']; ?>" alt="<?php echo $image_desktop['title']; ?>">
						<?php endif; ?>
						<?php if ($image_mobile <> '') : ?>
							<img class="fls-highlight__logos l-hide" src="<?php echo $image_mobile['url']; ?>" width="<?php echo $image_mobile['width']; ?>" alt="<?php echo $image_mobile['title']; ?>">
						<?php endif; ?>
					</div>
				</div>
			</div>

	</section>

<?php endif; ?>