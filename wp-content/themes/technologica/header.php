<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
		<title><?php echo PW_SITE_NAME; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="">
		<?php wp_head(); ?>
	</head>
	<body>
		<header>
			<nav role="navigation" class="navbar navbar-default fixed-nav trilha" id="nav">
				<div id="faixa-topo">&nbsp;</div>
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-xs-8 page-scroll">
							<?php 
								printf(
									'<a href="%1$s" title="%2$s" class="logo">
										<img src="%3$sassets/img/logo.png">
									</a>',
									PW_URL,
									PW_SITE_NAME,
									PW_THEME_URL
								);
							?>
						</div>
						<!--<div class="col-md-6 chip"><img src="assets/img/chip.jpg"></div>-->
						<div class="col-lg-8 col-md-8 col-xs-12 slogan">
							<h1>Integrando Conhecimentos</h1>
							<h4>14, 15 e 16 de setembro de 2015</h4>
						</div>
						<button type="button" class="navbar-toggle toggle-menu menu-left push-body"
						data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<i class="icon-bar"></i>
							<i class="icon-bar"></i>
							<i class="icon-bar"></i>
						</button>
					</div>
				</div>
				<div class="container">
			    	<div class="row">
			        	<div class="col-xs-12 menu-horizontal">
			                <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left no-padding">
				             <?php
				            	$defaults = array(
								  'theme_location'  => 'menu-header',
								  'menu'            =>'' ,
								  'container'       => '',
								  'container_class' => false,
								  'container_id'    =>'' ,
								  'menu_class'      => 'nav navbar-nav navbar-left',
								  'menu_id'         =>'primary_menu' ,
								  'echo'            => true,
								  'fallback_cb'     => 'wp_page_menu',
								  'before'          =>'' ,
								  'after'           =>'' ,
								  'link_before'     =>'' ,
								  'link_after'      =>'' ,
								  'depth'           => 0,
								  'walker'          => new wp_bootstrap_navwalker()
								);
				             	wp_nav_menu($defaults); 
				            ?> 
			          </div> 
			          <!-- end navbar-collapse -->
			        </div>
			        <!-- end col-12 --> 
			      </div>
			      <!-- end row --> 
			    </div>
			    <!-- end container --> 
			    <div id="faixa-topo">&nbsp;</div>
			</nav>
			<!-- end nav -->
			<!--<div tabindex="-1" id="content" class="bs-docs-header" role="banner" style="background:#5DBB45">
		    	<div class="">
		       	<!-- <h1>Components</h1>
		        	<p>Over a dozen reusable components built to provide iconography, dropdowns, input groups, navigation, alerts, and much more.</p> -->
		        	<!--<img src="<?php //echo PW_THEME_URL; ?>assets/img/slider.jpg" style="display:block; max-width:100%;height: auto; margin:0 auto">
		    	</div>
		    </div>-->
		    <?php //putRevSlider( "banner" ) ?>
		</header>
		<!-- end header -->