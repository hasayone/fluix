<?php

/**
 * CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-cta';
if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$className .= ' align' . $block['align'];
}

// Load values
$title 						= get_field('title');
$description			= get_field('description');
$btn							= get_field('cta');
$btn_description	= get_field('cta_description');
$options					= get_field('options');
$background				= $options["background"];
$cta_style				= $options["cta_style"];

/* This is a conditional statement that checks if the background is not equal to default. If it is not
equal to default, it adds the class fls-cta--background-blue to the className variable. */
$wrapper = 'fls-cta__wrapper wrapper';
if ($background != 'default') $wrapper .= ' fls-cta--background-blue';

/* This is a conditional statement that checks if the background is not equal to default. If it is not
equal to default, it adds the class fls-cta--background-blue to the className variable. */
$ctaStyle = ' ';
if ($cta_style != 'default') $ctaStyle = ' fls-btn--with-arrow fls-btn--with-arrow--simple-dark-orange';

if (get_field('is_example')) :
	/* Render screenshot for example */ ?>

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/cta.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">


		<div class="<?php echo $wrapper; ?>">
			<div class="row">
				<div class="col-12 center">
					<?php if ($title <> '') : ?>
						<h2 class="fls-title-l2 fls-cta__title">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>
					<?php if ($description <> '') : ?>
						<div class="fls-cta__description">
							<?php echo $description; ?>
						</div>
					<?php endif; ?>
					<div class="fls-cta__button">
						<?php if ($btn <> '') : ?>
							<a href="<?php echo $btn['url']; ?>" class="fls-btn fls-btn--new fls-btn--new--primary <?php echo $ctaStyle; ?>" target="<?php echo $btn['target']; ?>"><?php echo $btn['title']; ?></a>
						<?php endif; ?>
						<?php if ($btn_description <> '') : ?>
							<div class="fls-cta__button-description">
								<?php echo $btn_description; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

	</section>

<?php endif; ?>