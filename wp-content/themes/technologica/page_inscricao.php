<?php
  /* Template name: Formulário Inscrição */

   get_header();
?>
<section class="">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 title-box">
          <?php the_post(); ?>
          <div class="col-md-12 text-content">
            <h2 class="title-page"><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
          </div>  
          <p id="msg" class="col-md-12 bg-danger">As inscrições para os minicursos estão encerradas.</p> 
          <br><br>
          
          
          <form class="form-horizontal" id="form_minicurso">
             
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


            <!-- Button -->
            <div class="form-group">
              <label class="col-md-1 control-label" for="cadastrar"></label>
              <div class="col-md-2">
                <button type="button" id="cadastrar" name="cadastrar" class="btn btn-primary">Inscrever-me</button>
              </div>
            </div>
            <input type="hidden" id="end" name="end" value="<?php echo PW_THEME_URL; ?>">
            </form> 
          
        </div>
    </div>
  </div>    
</section>  
<?php get_footer(); ?>
<script type="text/javascript">
  $(document).ready(function() {

      $('#fone').focusout(function(){
          var phone, element;
          element = $(this);
          element.unmask();
          phone = element.val().replace(/\D/g, '');
          if(phone.length > 10) {
              element.mask("(99) 99999-999?9");
          } else {
              element.mask("(99) 9999-9999?9");
          }
      }).trigger('focusout');



      $("#cadastrar").on("click", function(){
        var dados = $("#form_minicurso").serialize();

        if(confirm("Você escolheu o minicurso "+ $("#selectbasic option:selected").text()+" quer confirmar sua inscrição?")){

            $.ajax({
              type: 'POST',
              dataType: 'html',
              url: $("#end").val()+'/minicurso/index.php',
              data: dados,
              success: function(response) {
                  //location.reload();
                  if (response == 1) {
                   
                    $("#msg").removeClass('bg-danger');
                    $("#msg").text('Inscrição para o Minicurso Realizada.');
                    $("#msg").addClass("bg-success");
                  }else if(response == 0){
                   
                    $("#msg").removeClass('bg-success');
                    $("#msg").text('Inscrição para o Minicurso Realizada.');
                    $("#msg").addClass("bg-danger");
                  }else{
                   var erro = response.substring(0,(response.length - 1));
                   $("#msg").removeClass('bg-success');
                   $("#msg").text(erro);
                    $("#msg").addClass("bg-danger");
                  }
              },
              error: function(e){
                var erro = e.substring(0,(e.length - 1));
                
                $("#msg").removeClass('bg-success');
                $("#msg").text(erro);
                $("#msg").addClass("bg-danger");
              }
            });
          }else{
            alert("Não confirmado.");
          }
      }) ;
  });
</script>