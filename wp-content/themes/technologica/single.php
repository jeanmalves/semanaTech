<?php get_header(); ?>
		<section class="">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 title-box text-content">
						<?php the_post(); ?>
		            	<h2 class="title-page"><?php the_title(); ?></h2>
		                <h5></h5>
		            </div>
	            	 <?php if ( has_post_thumbnail() ) : ?>
			            <div class="col-md-12">
			                <div class="img-post">
			                  <?php the_post_thumbnail( 'large', array('class'=>'img-responsive') ); ?>
			                </div>
			            </div>	
		  			<?php endif; ?>
					<div class="col-md-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div>		
		</section>	
<?php get_footer(); ?>