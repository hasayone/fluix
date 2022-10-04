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
$id = 'features-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'features';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

// Load values and handle defaults.
$title 						= get_field('title') ?: 'Your title here...';

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/img/features.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<?php /* section HTML here */ ?>

	</section>

<?php endif; ?>