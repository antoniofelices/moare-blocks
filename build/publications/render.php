<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if ( ! function_exists( 'moare_publications_main_query' ) ) :

	function moare_publications_main_query() {

		$terms = get_terms( array(
			'taxonomy' => 'prefix_yearofpublication',
		) );

		if ( is_wp_error( $terms ) || empty( $terms ) ) {
			return;
		}

		if ( ! function_exists( 'get_field' ) ) {
			return;
		}

		foreach ( $terms as $term ) {

			$args = array(
				'post_type'        => 'prefix_publication',
				'posts_per_page'   => -1,
				'orderby' => array( 'meta_value' => 'ASC' ),
				'meta_key' => 'prefix_authors',
				'tax_query' => array(
					array(
						'taxonomy' => 'prefix_yearofpublication',
						'field' => 'term_id',
						'terms' => array( $term->term_id ),
						'operator' => 'IN'
					),
				)
			);

			$query_by_years = new WP_Query( $args );

			if ( $query_by_years->have_posts() ) :

				?>

				<details class="mg-details">
					<summary><?php echo esc_html( $term->name ); ?></summary>
					<ul class="container">
						<?php

						while ( $query_by_years->have_posts() ) : $query_by_years->the_post();

							$authors = esc_html( get_field( 'prefix_authors' ) );
							$year = esc_html( get_field( 'prefix_year' ) );
							$title = esc_html( get_the_title() );
							$publishingon = esc_html( get_field( 'prefix_publishing_on' ) );
							$type = esc_html( get_field( 'prefix_type' ) );
							$externallink = esc_url( get_field( 'prefix_external_link' ) );
							$textexternallink = esc_html__( 'External link', 'moare-blocks' );

							$classPublishinOn = ( strtolower( $type ) === 'book chapter' ) ? 'chapter-book' : '';
							?>
							
							<li>
								<span class="authors-publication"><?php echo $authors; ?></span>
								<span class="year-publication">(<?php echo $year; ?>)</span>
								<span class="title-publication"><?php echo $title; ?>.</span>
								<span class="publishin-on <?php echo $classPublishinOn; ?>"><?php echo $publishingon; ?></span>
								<span class="type"><?php echo $type; ?>.</span>
								<?php if ($externallink): ?>
									<span class="external-link-publication">
										<a href="<?php echo $externallink; ?>"><?php echo $textexternallink; ?></a>.
									</span>
								<?php endif; ?>
							</li>

							<?php
						endwhile;

						?>
					</ul>
				</details>

				<?php

			endif;

			$query_by_years = null;
			wp_reset_postdata();

		}

	}
	
endif;

?>

<div <?php echo get_block_wrapper_attributes(); ?>>

	<?php moare_publications_main_query(); ?>

</div>