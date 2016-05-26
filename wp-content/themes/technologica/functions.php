<?php
	
	add_action('after_setup_theme', 'custom_setup' );

	function custom_setup()
	{
		add_action( 'wp_enqueue_scripts', 'custom_formats' );
		
		register_nav_menus( array(
			'menu-header' => 'Menu cabeçalho',
			'menu-footer' => 'Menu rodapé',
		) );

		add_post_type_support( 'page', 'excerpt' );
		add_theme_support( 'post-thumbnails' );

	}

	/**
	 * Função que registra os scripts do site.
	*/ 
	function custom_formats()
	{
		wp_register_style('custom_fonts','http://fonts.googleapis.com/css?family=Montserrat:400,700',null, null, 'all');
		wp_register_style('bootstrap', PW_THEME_URL. 'assets/css/bootstrap.min.css',null, null, 'all');
		wp_register_style('custom_style', PW_THEME_URL. 'assets/css/style.css',null, null, 'all');

		wp_enqueue_script( 'jquery-min', PW_THEME_URL. 'assets/js/jquery.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'jquery-ui', PW_THEME_URL. 'assets/js/jquery-ui.js', array('jquery'), null, true );
		wp_enqueue_script( 'bootstrap-js', PW_THEME_URL. 'assets/js/bootstrap.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'maskedinput', PW_THEME_URL. 'assets/js/jquery.maskedinput.js', array('jquery'), null, true );


		// chamada dos arquivos css. 
		wp_enqueue_style('custom_fonts');
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('custom_style');

		//chamada dos arquivos js
		wp_enqueue_script('jquery-min');		
		wp_enqueue_script('jquery-ui');		
		wp_enqueue_script('bootstrap-js');		
		wp_enqueue_script('maskedinput');		
	}

	function modo_manutencao() { 
 
		if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) { 
			die('<p> </p>
			    <center>
			    <img src="' . PW_THEME_URL . 'assets/img/coders.jpg"/>
			    <p> </p>
			    <h2>Este site está passando por uma manutenção de rotina</h2>
			    <h3>Volte daqui a alguns minutos.</h3>
			    <h3>Obrigado!</h3></center>'
			); 
		} 
	} 
	//add_action('get_header', 'modo_manutencao');

	define( 'PW_URL', get_home_url() );
	define( 'PW_THEME_URL', get_bloginfo( 'template_url' ) . '/' );
	define( 'PW_SITE_NAME', get_bloginfo( 'name' ) );

	// Register Custom Navigation Walker
	require_once('wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');


	/*
	 * Register Taxomonies
	

	//hook into the init action and call create_minicursos_taxonomies when it fires
	add_action( 'init', 'create_minicursos_taxonomy', 0 );

	//create a custom taxonomy name it minicurso for your posts

	function create_minicursos_taxonomy() {
	
	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Minicursos', 'taxonomy general name' ),
    'singular_name' => _x( 'Minicurso', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Minicursos' ),
    'all_items' => __( 'Todos Minicursos' ),
    'parent_item' => __( 'Minicurso Pai' ),
    'parent_item_colon' => __( 'Minicurso Pai:' ),
    'edit_item' => __( 'Editar Minicurso' ), 
    'update_item' => __( 'Atualizar Minicurso' ),
    'add_new_item' => __( 'Adicionar Novo Minicurso' ),
    'new_item_name' => __( 'Novo Nome Minicurso' ),
    'menu_name' => __( 'Minicursos' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('minicursos',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'minicurso' ),
  ));

}
**/

/*
 * Custom post types
**/

	add_action('init', 'post_type_minicursos');

	function post_type_minicursos() { 
		$labels = array(
			'name' => _x('Minicursos', 'post type general name'),
			'singular_name' => _x('Minicurso', 'post type singular name'),
			'add_new' => _x('Adicionar Novo', 'Novo item'),
			'add_new_item' => __('Novo Minicurso'),
			'edit_item' => __('Editar Minicurso'),
			'new_item' => __('Novo Minicurso'),
			'view_item' => __('Ver Minicurso'),
			'search_items' => __('Procurar Minicursos'),
			'not_found' =>  __('Nenhum registro encontrado'),
			'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
			'parent_item_colon' => '',
			'menu_name' => 'Minicursos'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,			
			'query_var' => true,
			'rewrite' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail')
	    );

		register_post_type( 'minicurso' , $args );
		flush_rewrite_rules();
	}

	add_action( 'add_meta_boxes', 'num_vagas_box' );
	function num_vagas_box() {
	    add_meta_box( 
	        'mincursos_meta_box',
	        __( 'Número de vagas', 'myplugin_textdomain' ),
	        'minicurso_box_content',
	        'minicurso',
	        'normal',
	        'high'
	    );
	}

	function minicurso_box_content( $post ) {

		$metaBoxValor = get_post_meta($post->ID, 'num_vagas', true);

	  wp_nonce_field( plugin_basename( __FILE__ ), 'minicurso_box_content_nonce' );
	  echo '<div id="box-num-vagas">';
	  echo '<label for="num_vagas"></label>';
	  echo '<input type="Number" id="num_vagas" name="num_vagas" value="'.$metaBoxValor.'" placeholder="Informe o número de vagas" style="width:30%" />';
	  echo '</div>';
	}

	add_action( 'save_post', 'minicurso_box_save' );
	function minicurso_box_save( $post_id ) {

		if ( ! $_POST['num_vagas'] ) return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

		if ( !wp_verify_nonce( $_POST['minicurso_box_content_nonce'], plugin_basename( __FILE__ ) ) )
		return;

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) )
			return;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ) )
			return;
		}
		$num_vagas = filter_var($_POST['num_vagas'], FILTER_SANITIZE_NUMBER_INT);
	  	update_post_meta( $post_id, 'num_vagas', $num_vagas );
	}



	add_action('init', 'post_type_inscricao_minicursos');

	function post_type_inscricao_minicursos() { 
		$labels = array(
			'name' => _x('Inscrições', 'post type general name'),
			'singular_name' => _x('Inscrição', 'post type singular name'),
			'add_new' => _x('Adicionar Novo', 'Novo item'),
			'add_new_item' => __('Nova Inscrição'),
			'edit_item' => __('Editar Inscrição'),
			'new_item' => __('Nova Inscrição'),
			'view_item' => __('Ver Inscrição'),
			'search_items' => __('Procurar Inscrições'),
			'not_found' =>  __('Nenhum registro encontrado'),
			'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
			'parent_item_colon' => '',
			'menu_name' => 'Inscrições Minicurso'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,			
			'query_var' => true,
			'rewrite' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('custom-fields',)
	    );

		register_post_type( 'inscricao' , $args );
		flush_rewrite_rules();
	}

	add_action( 'add_meta_boxes', 'inscricao_minicurso_box' );
	function inscricao_minicurso_box() {
	    add_meta_box( 
	        'inscricao_mincursos_meta_box',
	        __( 'Nome', 'myplugin_textdomain' ),
	        'inscricao_minicurso_box_content',
	        'inscricao',
	        'normal',
	        'high'
	    );
	}

	function inscricao_minicurso_box_content( $post ) {

		//$metaBoxValor = get_post_meta($post->ID, 'num_vagas', true);

	  wp_nonce_field( plugin_basename( __FILE__ ), 'inscricao_minicurso_box_content_nonce' );
	  
	  echo '<form class="form-horizontal" id="form_minicurso">
             
             <div class="form-group">
              <label class="col-md-1 control-label" for="nome">Minicurso:</label>  
              <div class="col-md-6" style="">
                <select id="selectbasic" name="minicurso" class="form-control">
                  <option value="1">Técnicas de retrabalho com componentes SMD</option>
                  <option value="2">Glitch Art e Python</option>
                  <option value="3">Impressão 3D</option>
                  <option value="4">HTML</option>
                  <option value="5">Arduino</option>
                  <option value="6">Front-End: Construa Interfaces para Sites e Sistemas Web</option>
                  <option value="7">Pitch</option>
                </select>
                
              </div>
            </div>

            <!-- Text input -->
            <div class="form-group">
              <label class="col-md-1 control-label" for="nome">Nome:</label>  
              <div class="col-md-6">
              <input id="nome" name="nome" placeholder="Digite seu nome" class="form-control input-md" required="" type="text">
                
              </div>
            </div>


             <!-- Text input -->
            <div class="form-group">
              <label class="col-md-1 control-label" for="email">Email:</label>  
              <div class="col-md-6">
              <input id="email" name="email" placeholder="Digite seu email" class="form-control input-md" required="" type="text">
                
              </div>
            </div>


            <!-- Prepended checkbox  --> 
            <div class="form-group">
              <label class="col-md-1 control-label" for="aluno"></label>
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">     
                      <input checked="checked" name="is_aluno" type="checkbox">     
                  </span>
                  <input id="aluno" name="aluno" class="form-control" placeholder="Marque se você for aluno da UTFPR" type="text" readonly>
                </div>
                
              </div>
              <span>(preenchimento opcional)</span>
            </div>

            <!-- Text input -->
            <div class="form-group">
              <label class="col-md-1 control-label" for="rga">RGA/RG:</label>  
              <div class="col-md-3">
              <input id="rga" name="documento" placeholder="Digite seu RGA ou RG" class="form-control input-md" type="text" required="">
                
              </div>
            </div>

            <!-- Text input -->
            <div class="form-group">
              <label class="col-md-1 control-label" for="fone">Telefone:</label>  
              <div class="col-md-2">
              <input id="fone" name="fone" placeholder="Digite seu telefone" class="form-control input-md" type="text" required="">
                
              </div>
            </div>

            <input type="hidden" id="end" name="end" value="<?php echo PW_THEME_URL; ?>">
            </form> ';
	}