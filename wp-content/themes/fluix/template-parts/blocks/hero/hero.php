<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

// Load values and handle defaults.
$title 						= get_field('title') ?: 'Your title here...';
$description			= get_field('description');
$button						= get_field('button');
$btn_description	= get_field('btn_description');
$hero_img					= get_field('hero_img');
$footer_images		= get_field('footer_images');
$fImage_desktop		= $footer_images["footer_image_desktop"];
$fImage_mobile		= $footer_images["footer_image_mobile"];

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/img/hero.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<div class="wrapper">
			<div class="row">
				<div class="col-6 col-s-12">
					<?php if ($title <> '') : ?>
						<h1 class="fls-title-l1 fls-text--no-text-transform">
							<strong><?php echo $title; ?></strong>
						</h1>
					<?php endif; ?>
					<?php if ($description <> '') : ?>
						<div class="fls-home-hero__description">
							<?php echo $description; ?>
						</div>
					<?php endif; ?>
					<div class="fls-home-hero__action">
						<?php if ($button <> '') : ?>
							<a href="<?php echo $button['url']; ?>" class="fls-btn fls-btn--new fls-btn--new--primary" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
						<?php endif; ?>
						<?php if ($btn_description <> '') : ?>
							<div class="fls-home-hero__action-description">
								<?php echo $btn_description; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-6 col-s-12">
					<?php if ($hero_img <> '') : ?>
						<div class="fls-home-hero__image">
							<img src="<?php echo $hero_img['url']; ?>" alt="<?php echo $hero_img['title']; ?>">
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row center">
				<div class="col-12">
					<?php if ($fImage_desktop <> '') : ?>
						<img class="fls-home-hero__logos s-hide" src="<?php echo $fImage_desktop['url']; ?>" width="<?php echo $fImage_desktop['width']; ?>" alt="<?php echo $fImage_desktop['title']; ?>">
					<?php endif; ?>
					<?php if ($fImage_mobile <> '') : ?>
						<img class="fls-home-hero__logos l-hide" src="<?php echo $fImage_mobile['url']; ?>" width="<?php echo $fImage_mobile['width']; ?>" alt="<?php echo $fImage_mobile['title']; ?>">
					<?php endif; ?>
				</div>
			</div>
		</div>

	</section>

<?php endif; ?>