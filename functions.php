<?php
//Definição de constantes...
define( 'THEME_URL', get_bloginfo( 'template_url' ) . '/' );
define( 'SITE_NAME', get_bloginfo( 'name' ) );
define( 'SITE_DESCRIPTION', get_bloginfo( 'description' ) );
define( 'SITE_URL',  get_bloginfo( 'url' ) );

//Após a ativação do tema...
if (!function_exists('isp_ativacao_tema')) :
	function isp_ativacao_tema(){

		//Permitindo que o WordPress gerencie o título do documento...
		add_theme_support('title-tag');

		//Adicionando suporte do WordPress à logo do tema...
		add_theme_support('custom-logo');

		//Adicionando o suporte à imagem destacada ou thumbnail
		add_theme_support( 'post-thumbnails' );

		//Registrando menu de navegação...
		register_nav_menus(array(
			'menu_principal' => 'Menu Principal'
		));

		//Adicionando envio de formulário de contato...
		add_action( 'init', 'isp_form_envio' );
	}
endif;
add_action('after_setup_theme', 'isp_ativacao_tema');

//Estilos e Scripts
function isp_estilos_scripts_tema(){

	//bootstrap css
	wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

	//style e bootstrap
	$isp_tema = wp_get_theme();
	$deps = array('bootstrap');
	wp_enqueue_style('isp-style', get_stylesheet_uri(), $deps, $isp_tema->get('Version'));

	//google fonts
	wp_enqueue_style('font-josefinsans', '//fonts.googleapis.com/css?family=Josefin+Sans:400,700');
	wp_enqueue_style('font-spacemono', '//fonts.googleapis.com/css?family=Space+Mono:400,700');

	//fontawesome
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');


	//popper
	wp_enqueue_script('popper', get_template_directory_uri().'/assets/js/popper.min.js', array('jquery'), '', true );

	//bootstrap js
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );

	//scrollIt
	wp_enqueue_script('scrollIt', get_template_directory_uri().'/assets/js/scrollIt.min.js', array('jquery'), '', true );

	//scripts
	wp_enqueue_script('scripts', get_template_directory_uri().'/assets/js/scripts.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'isp_estilos_scripts_tema' );

//Adicionando novos campos e seções no Customize Wordpress
function isp_personalizacao_custome($wp_customize){
	//Adicionando campos em Identidade do Site
	//Imagem de Perfil
		$wp_customize->add_setting('isp_imagem_perfil', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_spports' => '',
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => '',
			'sanitize_js_callback' => ''
			));
		$wp_customize->add_control(new WP_Customize_Image_control(
			$wp_customize,
			'isp_imagem_perfil',
			array(
			'priority' => 1,
			'label' => 'Imagem de Perfil',
			'section' => 'title_tagline',			
			'settings' => 'isp_imagem_perfil'
			)));
	//Textarea para preenchimento da breve apresentação...
		$wp_customize->add_setting('isp_breve_apresentacao', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_spports' => '',
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => '',
			'sanitize_js_callback' => ''
			));
		$wp_customize->add_control('isp_breve_apresentacao', array(
			'type' => 'textarea',
			'priority' => 10,
			'section' => 'title_tagline',
			'label' => __('Breve Apresentação'),
			'description' => 'Insira a breve apresentação para o cabeçalho:'
			));

		//Seção e campos para o rodapé...
	    $wp_customize->add_section( 'isp_customize_secao_rodape' , array( 'title' => 'Rodapé', 'priority' => 195, 'description' => '', ) );
	    
	    $wp_customize->add_setting('isp_customize_secao_rodape_msg', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_spports' => '',
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => '',
			'sanitize_js_callback' => ''
		));
	    $wp_customize->add_control('isp_customize_secao_rodape_msg', array( 
            'label' => 'Mensagem do Rodapé', 
            'section' => 'isp_customize_secao_rodape',
            'type' => 'textarea', 
            'description' => ''
	    ));

	    //Campo para mensagem no menu...
		/*$wp_customize->add_setting('isp_menu_msg', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_spports' => '',
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => '',
			'sanitize_js_callback' => ''
			));
		$wp_customize->add_control('isp_menu_msg', array(
			'type' => 'textarea',
			'priority' => 1000,
			'section' => 'nav_menu[2]',
			'label' => __('Mensagem no menu:'),
			'description' => 'Digite a mensagem a ser exibida no rodapé do menu:'
			));*/
}
add_action('customize_register', 'isp_personalizacao_custome');

//Removendo Editor de Conteúdo na Home...
function isp_esconder_editor_pagina(){	
	if(!empty($_GET['post']) || !empty($_POST['post_ID'])){
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

		if(!isset($post_id)) return;

		$template = get_post_meta($post_id, '_wp_page_template', true);

		if ($template == 'front-page.php') {
			remove_post_type_support('page', 'editor');		
		}
	}
}
add_action('admin_init', 'isp_esconder_editor_pagina');

//Adicionando Meta Box para Home
function isp_home_meta_box(){
	global $post;

	$template = get_post_meta($post->ID, '_wp_page_template', true);

	if ($template == 'front-page.php') {
		add_meta_box('isp_home_meta_box_sobre', 'Sobre', 'isp_home_meta_box_sobre_callback', 'page');

		add_meta_box('isp_home_meta_box_projetos', 'Projetos', 'isp_home_meta_box_projetos_callback', 'page');
		
		add_meta_box('isp_home_meta_box_contatos', 'Contatos', 'isp_home_meta_box_contatos_callback', 'page');
	}
}
function isp_home_mb_get_meta($value) {
	global $post;
 
	$field = get_post_meta($post->ID, $value, true);
	if ( ! empty($field)) {
		return is_array($field) ? stripslashes_deep($field) : stripslashes(wp_kses_decode_entities($field));
	} else {
		return false;
	}
}

function isp_home_meta_box_sobre_callback($post){
	$valores_isph_meta_box = get_post_meta($post->ID);
?>
<div class="content">
	<h4>História</h4>
	<div class="form-group">
		<label for="titulo-sobre-mb"><h6>Título</h6></label>			
		<input class="form-control" type="text" id="titulo-sobre-mb" name="titulo-sobre-mb" value="<?php if(isset($valores_isph_meta_box['titulo-sobre-mb']) && !empty($valores_isph_meta_box['titulo-sobre-mb'])){ echo $valores_isph_meta_box['titulo-sobre-mb'][0]; } ?>">
	</div>
	<div class="form-group">
		<label for="subtitulo-sobre-mb"><h6>Subtítulo</h6></label>
		<input class="form-control" type="text"  id="subtitulo-sobre-mb" name="subtitulo-sobre-mb" value="<?php if(isset($valores_isph_meta_box['subtitulo-sobre-mb']) && !empty($valores_isph_meta_box['subtitulo-sobre-mb'])){ echo $valores_isph_meta_box['subtitulo-sobre-mb'][0]; } ?>">
	</div>
	<div class="form-group">
		<label for="conteudo-sobre-mb"><h6>Conteúdo</h6></label>
			<?php
                $valores_isph_meta_box = wpautop( isp_home_mb_get_meta( 'conteudo-sobre-mb' ),true);
                wp_editor($valores_isph_meta_box, 'conteudo-sobre-mb', array(
                        'wpautop'               =>  true,
                        'media_buttons' =>      false,
                        'textarea_name' =>      'conteudo-sobre-mb',
                        'textarea_rows' =>      10,
                        'teeny'                 =>  true,
                ));
	        ?>
	</div>
</div>
<?php
}

function isp_home_meta_box_projetos_callback($post){
	$valores_isph_meta_box = get_post_meta($post->ID);
?>
<div class="content">
	<div class="form-group">
		<label for="titulo-projetos-mb"><h6>Título</h6></label>			
		<input class="form-control" type="text" id="titulo-projetos-mb" name="titulo-projetos-mb" value="<?php if(isset($valores_isph_meta_box['titulo-projetos-mb']) && !empty($valores_isph_meta_box['titulo-projetos-mb'])){ echo $valores_isph_meta_box['titulo-projetos-mb'][0]; } ?>">
	</div>
	<div class="form-group">
		<label for="subtitulo-projetos-mb"><h6>Subtítulo</h6></label>
		<input class="form-control" type="text"  id="subtitulo-projetos-mb" name="subtitulo-projetos-mb" value="<?php if(isset($valores_isph_meta_box['subtitulo-projetos-mb']) && !empty($valores_isph_meta_box['subtitulo-projetos-mb'])){ echo $valores_isph_meta_box['subtitulo-projetos-mb'][0]; } ?>">
	</div>
</div>
<?php
}

function isp_home_meta_box_contatos_callback($post){
	$valores_isph_meta_box = get_post_meta($post->ID);
?>
<div class="content">
	<div class="form-group">
		<label for="titulo-contatos-mb"><h6>Título</h6></label>			
		<input class="form-control" type="text" id="titulo-contatos-mb" name="titulo-contatos-mb" value="<?php if(isset($valores_isph_meta_box['titulo-contatos-mb']) && !empty($valores_isph_meta_box['titulo-contatos-mb'])){ echo $valores_isph_meta_box['titulo-contatos-mb'][0]; } ?>">
	</div>
	
	<div class="form-group">
		<label for="conteudo-contatos-mb"><h6>Conteúdo</h6></label>
			<?php
                $valores_isph_meta_box = wpautop( isp_home_mb_get_meta( 'conteudo-contatos-mb' ),true);
                wp_editor($valores_isph_meta_box, 'conteudo-contatos-mb', array(
                        'wpautop'               =>  true,
                        'media_buttons' =>      false,
                        'textarea_name' =>      'conteudo-contatos-mb',
                        'textarea_rows' =>      10,
                        'teeny'                 =>  true
                ));
	        ?>
	</div>
</div>
<?php
}
add_action('add_meta_boxes', 'isp_home_meta_box');

//Salvando Meta Box Home...
function isp_home_save_meta_box($post_id){
	if(array_key_exists('titulo-sobre-mb', $_POST)){
		update_post_meta($post_id, 'titulo-sobre-mb', $_POST['titulo-sobre-mb']);
	}
	if(array_key_exists('subtitulo-sobre-mb', $_POST)){
		update_post_meta($post_id, 'subtitulo-sobre-mb', $_POST['subtitulo-sobre-mb']);
	}
	if(array_key_exists('conteudo-sobre-mb', $_POST)){
		update_post_meta($post_id, 'conteudo-sobre-mb', $_POST['conteudo-sobre-mb']);
	}

	if(array_key_exists('titulo-projetos-mb', $_POST)){
		update_post_meta($post_id, 'titulo-projetos-mb', $_POST['titulo-projetos-mb']);
	}
	if(array_key_exists('subtitulo-projetos-mb', $_POST)){
		update_post_meta($post_id, 'subtitulo-projetos-mb', $_POST['subtitulo-projetos-mb']);
	}

	if(array_key_exists('titulo-contatos-mb', $_POST)){
		update_post_meta($post_id, 'titulo-contatos-mb', $_POST['titulo-contatos-mb']);
	}
	if(array_key_exists('conteudo-contatos-mb', $_POST)){
		update_post_meta($post_id, 'conteudo-contatos-mb', $_POST['conteudo-contatos-mb']);
	}
}
add_action('save_post', 'isp_home_save_meta_box');

//Registrando post_type Projetos...
function isp_projeto_post_type(){
	register_post_type('isp_projetos', array(
		'labels' => array(
				'name' => 'Projetos',
				'singular_name' => 'Projeto'
				),
			'menu_icon' => 'dashicons-welcome-add-page',
			'menu_position' => 20,
			'exclude_from_search' => true,
			'public' => true,
			'has_archive' => false,
			'supports' => array(
				'title',
				'thumbnail'
				),
			'rewrite' => false
	));	
}
add_action('init', 'isp_projeto_post_type');

//Adicionando meta_box Detalhes do Projeto ao post_type Projetos...
function isp_projetos_meta_box(){
		add_meta_box('isp_projetos_meta_box_dp', 'Detalhes do Projeto', 'isp_projetos_meta_box_callback', 'isp_projetos');
	}
function isp_projetos_meta_box_callback($post){
	$valores_ispp_meta_box = get_post_meta($post->ID);
?>
	<table class="isp-projetos-dp">
		<tbody>
			<tr>
				<td style="padding: 10px;">
					<label for="descricao-projeto">Descrição</label><br>
					<textarea name="descricao-projeto" id="descricao-projeto" rows="5" cols="20"><?php if(isset($valores_ispp_meta_box['descricao-projeto']) && !empty($valores_ispp_meta_box['descricao-projeto'])){ echo $valores_ispp_meta_box['descricao-projeto'][0]; } ?></textarea>
				</td>
				<td style="padding: 10px;">
					<label for="link-projeto">Link</label><br>
					<input type="text" name="link-projeto" id="link-projeto" value="<?php if(isset($valores_ispp_meta_box['link-projeto']) && !empty($valores_ispp_meta_box['link-projeto'])){ echo $valores_ispp_meta_box['link-projeto'][0]; } ?>">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}
add_action('add_meta_boxes', 'isp_projetos_meta_box');

function isp_projetos_save_meta_box($post_id){
	if(array_key_exists('descricao-projeto', $_POST)){
		update_post_meta($post_id, 'descricao-projeto', $_POST['descricao-projeto']);
	}
	if(array_key_exists('link-projeto', $_POST)){
		update_post_meta($post_id, 'link-projeto', $_POST['link-projeto']);
	}
}
add_action('save_post', 'isp_projetos_save_meta_box');

function isp_projetos_sample_permalink_remove( $return ) {
	global $post;
	if($post->post_type == 'isp_projeto_post_type'){
	    $return = '';
		return $return;
	}
	else{
		return $return;
	}
}
add_filter( 'get_sample_permalink_html', 'isp_projetos_sample_permalink_remove' );

//Adicionando estilos e scripts em determinadas páginas do painel admin...
function isp_add_estilos_scripts_admin(){
	//bootstrap css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

	//bootstrap js
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
}
add_action('admin_enqueue_scripts', 'isp_add_estilos_scripts_admin');

//Enviando formulário de contato...
function isp_form_envio(){
	global $erro_contato;
	if ( isset( $_POST[ 'contato' ] ) ) {
		$values = array();
		$fields = array( 'nome', 'email', 'assunto', 'mensagem' );
		foreach ( $fields as $f ) {
			$v = sanitize_text_field( $_POST[ $f ] );
			if ( !$v ) {
				$erro_contato = 'Preencha todos os campos...';
				break;
			}
			$values[ $f ] = $v;
		}

		if ( !$erro_contato ) {
			$to = 'contato@itamarsilva.eti.br';
			$subject = 'Mensagem do site';
			$message = sprintf(
				'Nome: %s' . PHP_EOL .
				'Assunto: %s' . PHP_EOL .
				'Email: %s' . PHP_EOL .
				'Mensagem: %s',
				$values[ 'nome' ],
				$values[ 'assunto' ],
				$values[ 'email' ],
				$values[ 'mensagem' ]
			);
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: Itamar Silva <contato@itamarsilva.eti.br>';
			if ( !wp_mail( $to, $subject, $message, $headers ) )
				$erro_contato = 'Não foi possível enviar a mensagem...';
			else
				$erro_contato = 'Mensagem enviada com sucesso!';
		}
	}
}

//Testando debug
error_log('testing if error log is working')