<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div class="container-fluid">
<div class="row justify-content-end">
<header class="col-md-4 header">
	<div class="content d-flex flex-column justify-content-center align-items-center">
		<?php get_template_part('parts/header', 'perfil'); ?>
		<?php get_template_part('parts/header', 'logo'); ?>		

		<?php echo get_theme_mod( 'isp_breve_apresentacao' ); ?>

		<?php get_template_part('parts/icones', 'contatos'); ?>	
	</div>

	<nav class="navbar navbar-menu-principal">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Menu Principal">
			<span class="line-menu-one"></span>
			<span class="line-menu-two"></span>
			<span class="line-menu-three"></span>
		</button>
		<div class="collapse navbar-collapse" id="menu-principal">
			<ul class="navbar-nav">
				<li class="nav-item"><a href="#sobre" data-scroll-nav="0" title="Sobre mim">Sobre</a></li>
				<li class="nav-item"><a href="#projetos" data-scroll-nav="1" title="Alguns projetos">Projetos</a></li>
				<li class="nav-item"><a href="#contatos" data-scroll-nav="2" title="Quer falar comigo?">Contatos</a></li>
			</ul>
			<!--<p>"<?php // echo get_theme_mod( 'isp_menu_msg' ); ?>"</p>-->
			<p>"Silence is gold!"</p>
		</div>					
	</nav>
</header>