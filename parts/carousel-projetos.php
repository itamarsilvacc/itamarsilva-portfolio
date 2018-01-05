<div id="projetos-carousel" class="carousel slide" data-ride="carousel">
	<a class="carousel-control-prev" href="#projetos-carousel" role="button" data-slide="prev">
	    <i class="fa fa-angle-left"></i>
	    <span class="sr-only">Anterior</span>
	</a>
	<a class="carousel-control-next" href="#projetos-carousel" role="button" data-slide="next">
	    <i class="fa fa-angle-right"></i>
	    <span class="sr-only">Próximo</span>
	</a>

	<div class="lista-projetos carousel-inner">
		<?php
			$count_posts = 0;
			$args = array('post_type' => 'isp_projetos', 'posts_per_page' => -1);
			$query = new WP_Query($args);

			if($query->have_posts()) :
				while($query->have_posts()) : $query->the_post();
					$imagem_proj_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		?>
		<div class="col-md-12 carousel-item <?php if($count_posts == 0) { echo 'active'; } ?>">
			<article class="projeto-item">
				<img src="<?php echo esc_url($imagem_proj_url[0]); ?>" alt="<?php echo the_title(); ?>">
				<div class="overlay">
					<h3><?php the_title(); ?></h3>
					<p><?php echo get_post_meta($post->ID, 'descricao-projeto', true); ?></p>
					<p class="projeto-link"><a href="<?php echo get_post_meta($post->ID, 'link-projeto', true); ?>" title="Visitar projeto" target="_blank"><i class="fa fa-external-link"></i></a></p>
				</div>
			</article>
		</div>
		<?php
				$count_posts++;
				endwhile;
				wp_reset_postdata();
			endif;
		?>							
	</div>
</div>