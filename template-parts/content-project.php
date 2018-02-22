<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StanleyWP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-md-10">

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

			</div>
		</div>

		<div class="row justify-content-center text-center">
			<div class="col-md-10">
				<?php
					$hosted_name = get_post_meta( get_the_ID(), '_stanleywp_host_name', true );
					$hosted_link = get_post_meta( get_the_ID(), '_stanleywp_host_url', true );
                    $sources = get_post_meta( get_the_ID(), '_stanleywp_source_group', true );
                    if($hosted_name || $sources) echo '<div class="card float-right ml-4" style="width:30%"><div class="card-body">';
					if($hosted_name) {
						echo '<h2>Project:</h2>';
						if($hosted_link) echo '<p><a href="'.$hosted_link.'">'.$hosted_name.'</a></p>';
						else echo '<p>'.$hosted_name.'</p>';
					}
					if($sources)
						echo '<h2>Sources:</h2>';
					foreach((array)$sources as $key => $source) {
						if(isset( $source['_stanleywp_source_name'])) {
							echo '<div>';
							if(isset( $source['_stanleywp_source_url'])) {
								echo '<a href="'.$source['_stanleywp_source_url'].'">'.$source['_stanleywp_source_name'].'</a>';
							} else {
								echo $source['_stanleywp_source_name'];
							}
							if(isset( $source['_stanleywp_source_author'])) {
								echo '<br/>by '.$source['_stanleywp_source_author'];
							}
							echo '</div>';
						}
					}
                    if($hosted_name || $sources) echo '</div></div>';
				?>
            
				<div class="entry-content">
					<?php
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'stanleywp' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'stanleywp' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<?php 
					// Get the list of files
					$files = get_post_meta( get_the_ID(), '_stanleywp_images', 1 );

					// Loop through them and output an image
					foreach ( (array) $files as $attachment_id => $attachment_url ) {
                        echo '<figure class="figure mb-4">';
						echo wp_get_attachment_image($attachment_id, 'full' , ["class" => "figure-img img-fluid rounded"]);
                        echo '<figcaption class="figure-caption text-right">'.wp_get_attachment_caption($attachment_id).'</figcaption>';
						echo '</figure>';
					}
				 ?>

			</div><!--  .col-md-8 -->
		</div><!--  .row -->


		<footer class="entry-footer">
            <?php echo get_the_term_list( get_the_ID(), 'project_category', 'Type: ', ', ', ''); ?> 
			<?php stanleywp_entry_footer(); ?>
		</footer><!-- .entry-footer -->

			
	</div><!--  .container -->

</article><!-- #post-## -->
