
<?php
$tags = get_the_terms( null, 'news_tag' );
?>
<section class="news-footer">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 offset-lg-2">
				<div class="row">
				<?php if ( ! empty( $tags ) ) : ?>
					<div class="col-12 col-lg-6">
						<div class="news-footer__tags">
							<p class="news-footer__title"><?php esc_html_e( 'Tags', 'northeasternUniversity' ); ?></p>
						<?php
						foreach ( $tags as $key => $tag ) :
							$tag_name = $tag->name;
							$tag_id   = $tag->term_id;
							?>
							<a href="<?php echo get_term_link( $tag_id ); ?>"><?php echo esc_html( $tag_name ); ?></a>
							<?php
						endforeach;
						?>
						</div>
					</div>
					<div class="col-12 col-lg-6 news-footer__social">
						<div class="news-footer__social-wrapper">
							<p class="news-footer__title"><?php esc_html_e( 'Share post', 'northeasternUniversity' ); ?></p>
							<?php echo do_shortcode( '[addtoany]' ); ?>
						</div>
					</div>
				<?php endif; ?> 
				</div>
			</div>
		</div>
	</div>
</section>