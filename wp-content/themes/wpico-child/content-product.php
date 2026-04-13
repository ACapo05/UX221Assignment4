<article class="product-card" itemscope itemtype="https://schema.org/Product">
	<header>
		<?php if ( is_archive() || is_search() ) : ?>
			<a href="<?php the_permalink(); ?>" aria-label="View product: <?php the_title_attribute(); ?>">
				<h2 itemprop="name"><?php the_title(); ?></h2>
			</a>
		<?php else : ?>
			<h1 itemprop="name"><?php the_title(); ?></h1>
		<?php endif; ?>

		<?php
		$price = get_post_meta( get_the_ID(), '_price', true );
		if ( $price ) :
		?>
			<p class="product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
				<span itemprop="priceCurrency" content="USD">$</span><span itemprop="price"><?php echo esc_html( $price ); ?></span>
			</p>
		<?php endif; ?>
	</header>

	<?php if ( is_archive() || is_search() ) : ?>
		<?php the_excerpt(); ?>
	<?php else : ?>
		<div itemprop="description">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>
</article>
