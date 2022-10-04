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
$className = 'fls-features';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/features.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo esc_attr($className); ?>">

		<?php // Check rows existexists.
		if (have_rows('features_list')) : ?>
			<?php // Check rows existexists.
			while (have_rows('features_list')) : the_row();
				$image	 = get_sub_field('image');
				$title	 = get_sub_field('title');
				$content = get_sub_field('content');
				$tags		 = get_sub_field('tags');
			?>
				<div class="row fls-features-list__item">
					<div class="col-5 col-s-12">
						<?php if ($title <> '') : ?>
							<div class="fls-title-l3">
								<?php echo $title; ?>
							</div>
						<?php endif; ?>
						<?php if ($image <> '') : ?>
							<div class="fls-features-list__image l-hide">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
							</div>
						<?php endif; ?>
						<?php if ($content <> '') : ?>
							<div class="fls-features-list__content">
								<?php echo $content; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-6 col-offset-1 s-hide">
						<?php if ($image <> '') : ?>
							<div class="fls-features-list__image">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
							</div>
						<?php endif; ?>
					</div>
					<div class="row fls-features-list">
						<div class="col-3 col-s-12 fls-features-list__text">
							<?php echo __('Commonly used features:'); ?>
						</div>
						<div class="col-9 col-s-12 fls-features-list__features">
							<?php if ($tags) : ?>
								<?php foreach ($tags as $term) : ?>
									<div class="fls-features-list__feature">
										<?php echo esc_html($term->name);	?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>

	</section>

<?php endif; ?>