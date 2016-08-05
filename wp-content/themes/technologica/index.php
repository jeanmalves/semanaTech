<?php get_header(); ?>
		<?php putRevSlider( "banner" ) ?>
		<section class="">
			<div class="container">
				<div class="row">
					<div class="col-md-6 conteudo">
						<a href="http://seminfo.dainf.ct.utfpr.edu.br/Cadastro/Participante" target="_blank">
							<img src="<?php echo PW_THEME_URL; ?>assets/img/inscricao.jpg" style="display:block; max-width:100%;height: auto;" 
							 alt="Garanta sua participação na semana technológica agora mesmo.">
						</a>	
					</div>
					<div class="col-md-6 conteudo">
						<a href="<?php echo PW_URL; ?>/?page_id=10">
							<img src="<?php echo PW_THEME_URL; ?>assets/img/agenda.jpg" style="display:block; max-width:100%;height: auto; "
							 alt="Conheça a programação completa da semana technológica">
						</a>	
					</div>
				</div>
			</div>		
		</section>	
		<section class="">
			<div class="container">
				<div class="row">
					<div class="col-md-6 conteudo">
            			<ul class="lista-destaques">
							<?php
								/**
								* get_posts()
								* Query que realiza a busca dos posts limitando a lista em 5 posts.
								* @param arrray
								* @return objeto post
								*/
							?>
							<?php $args = array( 'number_posts'=>5, 'order'=>'DESC' ); ?>
							<?php while (have_posts($args)) { ?>
							<?php 	the_post(); ?>
									<li>
										<a href="<?php echo get_permalink(); ?>">
											<?php echo get_the_title(); ?>
										</a>
									</li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-md-6 conteudo">
						<a href="<?php echo PW_URL; ?>/?page_id=15">
							<img src="<?php echo PW_THEME_URL; ?>assets/img/palestrantes.jpg" style="display:block; max-width:100%;height: auto; "
							 alt="Profissionais da área de eletrônica e informática. Conheça as palestras confirmadas.">
						</a>	
					</div>
				</div>
			</div>		
		</section>
		<section class="conteudo">
			<div class="container">
				<h4 class="titulo-org">Organização:</h4>
				<div class="row">
					<ul class="logos-org">
						<li>
							<a href="http://www.dainf.ct.utfpr.edu.br/" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_dainf.png"
								 alt="Dainf - Departamento de Informática UTFPR">
							</a>
						</li>
						<li>
							<a href="www.daeln.ct.utfpr.edu.br" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_daeln.png"
								 alt="Daeln - Departamento de Eletrônica UTFPR">
							</a>	
						</li>
						<li>
							<a href="https://www.facebook.com/codersutfpr" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_coders.png" alt="Coders - Grupo de Programação UTFPR">
							</a>
						</li>
						<li>
							<a href="http://www.dainf.ct.utfpr.edu.br/petcoce/" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_petcoce.png" alt="Pet-CoCe UTFPR">
							</a>
						</li>
						<li>
							<a href="https://www.facebook.com/dascutfpr" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_dasc.png"
								 alt="Dasc - Diretório de Sistemas de Informação e Engenharia da Computação UTFPR">
							</a>
						</li>
						<li>
							<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_pet_ee.png" alt="Pet Engenharia Eletrônica">
						</li>
						<li>
							<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_compute.png" alt="Compute Você Mesmo">
						</li>
					</ul>
				</div>
			</div>
		</section>
		<section class="conteudo">
			<div class="container">
				<h4 class="titulo-org">Apoio:</h4>
				<div class="row">
					<ul class="logos-org">
						<li>
							<a href="http://www.wises.com.br/" target="_blank">
								<img src="<?php echo PW_THEME_URL; ?>assets/img/logo_WiseSystems.png"
								 alt="Wise Systems - Fábrica de Software">
							</a>
						</li>
					</ul>
				</div>
			</div>
		</section>		
		<?php get_footer(); ?>
    	<!-- Jquery Files -->
    	<script>
    		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
    	</script>