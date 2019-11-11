<?php
   include("share/login-secure.php");

   $username = $_SESSION['ulogin'];
   $password = $_SESSION['upaswd'];
   $user_id = $_SESSION['user_id'];
   $profile_id = $_SESSION['profile_id'];
   $email = $_SESSION['email'];

   $linkHome = $menu->getPageNumber('home/welcome.php');

  
?>

<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
   <div class="container-fluid">
      <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="index.php"> Home</a></li>
      </ul>
   </div>
</div>

<div class="container-fluid">
   <div class="row d-flex align-items-md-stretch">

   <div class="col-sm-8">
         <div class="card">
            <div class="card-header d-flex align-items-center">
               <h4>Instituto Alpha Lumen - Plataforma Clube do Livro</h4>
               </div>               
            <div class="card-body">
               <h5 class="card-title">Seja Bem-vindo!</h5>
               <p class="text-justify ">Pai/Responsável, você poderá cadastrar um ou mais filho através do <b>botão "Cadastrar Candidato"</b>. Só assim você verá as etapas do processo seletivo para seu filho conforme o ano/série atual.</b></p>
               <p>Para ver o detalhe do processo clique no <b>botão "Verificar Status"</b> e em seguida no nome do candidato.</p>

               <p class="text-justify">Qualquer dúvida sobre o processo você pode enviar um email para seja.alpha@alphalumen.org.br</p>

               <p>Atenciosamente,</p>

               <p><strong>Equipe Alpha</strong></p>

            </div>
         </div>
         <!--
         <div class="card">
            <div class="card-header d-flex align-items-center">
               <h4>Disponibilidade de Vagas</h4>
            </div>               
            <div class="card-body">
               <p class="text-justify">Segue abaixo a disponibilidade de vagas por Ano/Série.</p>
               <p class="text-justify">A família pode optar por entrar na <b>lista de espera</b>. Há possibilidade de abrir vaga por desistência no processo de rematrícula ou quando o aprendiz sai da escola por motivo de mudança de cidade. Esta escolha pode ser feita na <i>Etapa Entrevista de Matrícula</i> pela família.</p>

               <div class="table-responsive">
                  <table id="simpleTable" class="table table-striped table-bordered" style="width: 100%;">
                     <thead class="thead-dark" style="width: 100%;">
                        <tr>
                           <th class="text-center">Col 1</th>
                           <th class="text-center">Col 2</th>
                           <th class="text-center">Col 3</th>
                        </tr>
                     </thead>
                     <tbody style="width: 100%;">
                        <?php
                        ?>
                     </tbody>
                  </table>
               </div>

            </div>
         </div>
         -->
      </div>

      <div class="col-sm-4">

         <div class="row">
            <div class="card">
               <div class="card-header d-flex align-items-center">
                  <h4>Cadastro de Candidato</h4>
               </div>               
               <div class="card-body">

                  <a href="index.php?link=" class="btn btn-info mt-2 pl-4 pr-4 ml-3 md-3" role="button" aria-pressed="true"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Cadastrar Candidato</a>

                  <a href="index.php?link=" class="btn btn-warning mt-2 pl-4 pr-4 ml-3 md-3" role="button" aria-pressed="true"><i class="fa fa-search" aria-hidden="true"></i> &nbsp; Verificar Status</a>
                  
               </div>
            </div>
         </div>

         <div class="row">
            <div class="card">
               <div class="card-header d-flex align-items-center">
                  <h4>Acões dos Pais/Responsáveis</h4>
               </div>               
               <div class="card-body">

                  <a href="index.php?link=" class="btn btn-success pl-4 pr-4 ml-3 md-3" role="button" aria-pressed="true"><i class="fa fa-film" aria-hidden="true"></i> &nbsp; Assistir Vídeos</a>

                  <a href="index.php?link=" class="btn btn-success mt-2 pl-4 pr-4 ml-3 md-3" role="button" aria-pressed="true"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Responder Formulário</a>

               </div>
            </div>
         </div>

      </div>


   </div>
</div>

