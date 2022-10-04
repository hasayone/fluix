<?php

/**
 * First Four Blocks Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'first-four-blocks-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fls-first-four-blocks';
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

	<img src="<?php echo get_template_directory_uri() . '/assets/images/blocks/first-four-blocks.png'; ?>" alt="is_example" style="width: 100%;">

<?php else :
	/* Render HTML for block */ ?>

	<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
		<div class="wrapper">
			<div class="row">
				<div class="col-12">
					<?php if ($title <> '') : ?>
						<h2 class="fls-title-l2">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>
				</div>
			</div>

			<?php // Check rows existexists.
			if (have_rows('content')) : ?>
				<div class="fls-four-blocks">
					<?php // Check rows existexists.
					$count = 1;
					while (have_rows('content')) : the_row();
						$image	 = get_sub_field('image');
						$title	 = get_sub_field('title');
						$content = get_sub_field('content');
						$class = '';
						if ($count > 4) $class = ' hidden';
					?>
						<div class="fls-four-blocks__block<?php echo $class; ?>">
							<?php if ($image <> '') : ?>
								<div class="fls-four-blocks__image">
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" width="48">
								</div>
							<?php endif; ?>
							<?php if ($title <> '') : ?>
								<div class="fls-four-blocks__title ">
									<h4 class="fls-title-l4"><?php echo $title; ?></h4>
								</div>
							<?php endif; ?>
							<?php if ($content <> '') : ?>
								<div class="fls-four-blocks__content">
									<?php echo $content; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php $count++;
					endwhile; ?>
				</div>
				<?php
				/*
			   * Checking if the number of rows in the repeater field is greater than 4. 
			   * If it is, then it will render the button. 
			   */
				if (count(get_field('content')) > 4) : ?>
					<div class="fls-four-blocks__more">
						<button class="fls-four-blocks__more-button">
							<?php echo __('And More...'); ?>
							<svg width="9px" height="13px" viewBox="0 0 9 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="icon" transform="translate(0,0)" fill="#0061C2">
									<path d="M8.50767568,8.43566017 L4.99753979,12.0036797 C4.82644608,12.1775948 4.5990602,12.259415 4.375,12.2491403 C4.1509398,12.259415 3.92355392,12.1775948 3.75246021,12.0036797 L0.242324315,8.43566017 C-0.0807747718,8.10723305 -0.0807747718,7.57474747 0.242324315,7.24632034 C0.565423403,6.91789322 1.08927053,6.91789322 1.41236961,7.24632034 L3.5,9.36775 L3.5,0.875 C3.5,0.391750844 3.89175084,0 4.375,0 C4.85824916,0 5.25,0.391750844 5.25,0.875 L5.25,9.36775 L7.33763039,7.24632034 C7.66072947,6.91789322 8.1845766,6.91789322 8.50767568,7.24632034 C8.83077477,7.57474747 8.83077477,8.10723305 8.50767568,8.43566017 Z" id="Path"></path>
								</g>
							</svg>
						</button>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</section>

<?php endif; ?>