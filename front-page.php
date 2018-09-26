<?php
/*
*
* Template Name: Home
*
*/
?>
<?php get_header(); ?>
<main class="col-md-8 main">
	<section id="sobre" class="sobre principal" data-scroll-index="0">
		<div class="content">
			<header class="header-section">
				<h1><?php echo get_post_meta($post->ID, 'titulo-sobre-mb', true); ?></h1>
				<h2><?php echo get_post_meta($post->ID, 'subtitulo-sobre-mb', true); ?></h2>
			</header>

			<?php echo get_post_meta($post->ID, 'conteudo-sobre-mb', true); ?>

			<footer class="footer-section">
				<a class="next-previous-section" href="#" data-scroll-nav="1" title="Projetos"><i class="fa fa-angle-down"></i></a>
			</footer>
		</div>
	</section>
	<section id="area-atuacao" class="area-atuacao principal" data-scroll-index="1">
		<div class="content">
			<header class="header-section">
				<h1>Atuação</h1>
			</header>

			<p>Codificação front-end e back-end, configuração do ambiente, otimização de performance, otimização SEO On Page e segurança, de sites institucionais, blogs, ecommerce e outras aplicações web simples e intermediárias, tendo como base o WordPress. Projetos do início ao fim, e manuntenção e/ou desenvolvimento de novas funcionalidades em projetos já em produção.</p>

			<h2>Linguagens, frameworks, ferramentas...</h2>

			<ul class="icones-lff">
				<li><i class="icone-wordpress" title="WordPress"></i></li>
				<li><i class="icone-html5" title="HTML5"></i></li>
				<li><i class="icone-css3" title="CSS3"></i></li>
				<li><i class="icone-javascript" title="JavaScript"></i></li>
				<li><i class="icone-php" title="PHP"></i></li>
				<li><i class="icone-mysql" title="MySQL"></i></li>
				<!--<li><i class="icone-git" title="Git"></i></li>-->
			</ul>

			<footer class="footer-section">
				<a class="next-previous-section" href="#" data-scroll-nav="0" title="Sobre"><i class="fa fa-angle-up"></i></a>
				<a class="next-previous-section" href="#" data-scroll-nav="2" title="Contatos"><i class="fa fa-angle-down"></i></a>
			</footer>
		</div>
	</section>
	<section id="projetos" class="projetos principal" data-scroll-index="2">
		<div class="content">
			<header class="header-section">
				<h1><?php echo get_post_meta($post->ID, 'titulo-projetos-mb', true); ?></h1>
				<h4><?php echo get_post_meta($post->ID, 'subtitulo-projetos-mb', true); ?></h4>
			</header>

			<?php get_template_part('parts/carousel', 'projetos'); ?>

			<footer class="footer-section">
				<a class="next-previous-section" href="#" data-scroll-nav="1" title="Sobre"><i class="fa fa-angle-up"></i></a>
				<a class="next-previous-section" href="#" data-scroll-nav="3" title="Contatos"><i class="fa fa-angle-down"></i></a>
			</footer>
		</div>
	</section>
	<section id="contatos" class="contatos principal" data-scroll-index="3">
		<div class="content">
			<header class="header-section">
				<h1><?php echo get_post_meta($post->ID, 'titulo-contatos-mb', true); ?></h1>
			</header>

			<?php echo get_post_meta($post->ID, 'conteudo-contatos-mb', true); ?>

			<?php get_template_part('parts/formulario', 'contato'); ?>

			<footer class="footer-section">
				<a class="next-previous-section" href="#" data-scroll-nav="2" title="Projetos"><i class="fa fa-angle-up"></i></a>
			</footer>
		</div>
	</section>
</main>
<?php get_footer(); ?>
