<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-xs-8">
						<h4 class="color">MAPA DO SITE</h4>
						<!-- <nav class="footer-menu">
				          <ul>
				            <li><a href="#">INÍCIO</a></li>
				            <li><a href="#">EVENTO</a></li>
				            <li><a href="#">PROGRAMAÇÃO</a></li>
				            <li><a href="#">INSCRIÇÕES</a></li>
				            <li><a href="#">PALESTRANTES</a></li>
				            <li><a href="#">TRANSMISSÃO WEB</a></li>
				            <li><a href="#">CONTATO</a></li>
				          </ul>
				        </nav> -->
				         <?php
				            	$defaults = array(
								  'theme_location'  => 'menu-footer',
								  'menu'            =>'' ,
								  'container'       => 'nav',
								  'container_class' => false,
								  'container_id'    =>'' ,
								  'menu_class'      => 'footer-menu',
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
					<div class="col-md-3 col-xs-8">
						<h4 class="color">LOCALIZAÇÃO</h4>
						<p class="">
							UTFPR CÂMPUS CURITIBA<br>
							Av. Sete de Setembro, 3165 - Bairro Rebouças - Curitiba/PR
						</p>
						<div class="localizacao">
							<a href="https://www.google.com.br/maps/place/Av.+Sete+de+Setembro,+3165+-+
								Rebou%C3%A7as,+Matriz,+Curitiba+-+PR,+80230-901/@-25.4391353,-49.269632,17z/data=!3m1!4b1!4m2!3m1!1s0x94dce46f5aaac573:0xc0d50b8e293ae5f2" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/localizacao.jpg">
							</a>	
						</div>	
					</div>
					<div class="col-md-3 col-xs-8">
						<h4 class="color">REDES</h4>
						<div class="redes">
							<a href="https://www.facebook.com/semanaInformaticaUTFPR" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/fanpage.jpg">
							</a>
						</div>
						<div class="redes">
							<a href="https://twitter.com/s_technologica" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/twitter-folow.jpg">
							</a>
						</div>
					</div>
					<div class="col-md-3 col-xs-8">
						<h4 class="color">REALIZAÇÃO</h4>
						<div class="redes">
							<a href="http://utfpr.edu.br/" target="_blank">	
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_utfpr.png">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="faixa-topo">&nbsp;</div>
			<div class="sub-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<span class="copyright">
								<!--Copyright © 2015 - Todos os direitos reservados| Semana Technológica.-->
								Copyright (c) <?php echo date( 'Y' ) . '. ' . PW_SITE_NAME; ?>. All rights reserved.
							</span>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="desenvolvido-por">
								<a href="https://www.facebook.com/codersutfpr" target="_blank">
									<img src="<?php echo PW_THEME_URL; ?>assets/img/coders.jpg">
								</a>
							</div>
						</div>		
					</div>	
				</div>
			</div>
		</footer>
    	<!-- end footer --> 
    	 <?php wp_footer(); ?>
	</body>
</html>	