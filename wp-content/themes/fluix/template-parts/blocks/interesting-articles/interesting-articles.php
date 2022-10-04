<?php

/**
 * Learn more links Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'interesting-articles-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-interesting-articles';
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

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/interesting-articles.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

		<div class="wrapper">
			<div class="row">
				<div class="col-7 col-m-10 col-s-10">
					<?php if ($title <> '') : ?>
						<h2 class="fls-title-l2">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>
				</div>
			</div>
			<div class="fls-interesting-articles__items">
				<div class="row center">

					<?php // Check rows existexists.
					if (have_rows('interesting_articles')) : ?>
						<?php // Check rows existexists.
						while (have_rows('interesting_articles')) : the_row();
							$title	= get_sub_field('title');
							$link 	= get_sub_field('link_label');
							$url 		= get_sub_field('url');
						?>

							<div class="col-4 col-s-12">
								<div class="fls-interesting-articles__item-container">
									<a href="<?php echo $url; ?>" class="fls-interesting-articles__item">
										<span class="fls-interesting-articles__title"><?php echo $title; ?></span>
										<span class="fls-interesting-articles__link">
											<span class="fls-link fls-link--small-arrow"><?php echo $link; ?></span>
										</span>
									</a>
								</div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>


	</section>

<?php endif; ?>