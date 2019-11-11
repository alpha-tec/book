<?php
	include("share/login-secure.php");
  $menu = new Menu( $_SESSION['profileId'] );
  $linkEdit = $menu->getPageNumber('users/search-edit.php');
  $linkReset = $menu->getPageNumber('users/search-reset.php');


  $link = $_GET['link'];
  if(isset($_SESSION['pageActual']))
    $_SESSION['pageBack'] = $_SESSION['pageActual'];
    
  $_SESSION['pageActual'] = "?link=".$link;



?>
<ol class="breadcrumb p-0 mb-0">
  <li class="breadcrumb-item "><small>Usuários / Pesquisa</small></li>
</ol>
<div class="container-fluid pt-1">
  <form class="form-signin"  method="post" action="">  
    <div class="row align-items-center">
      <div class="col-lg-1 align-middle">
        <div class="font-weight-bold text-right">GRUPOS</div>
      </div>
      <div class="col-lg-6">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="unidadeCheckBox1" id="inlineCheck1" value="1"
          <?php  
            if( isset($_POST['unidadeCheckBox1']) ){
              if( $_POST['unidadeCheckBox1'] == 1 )
                echo 'checked';
            } 
          ?> >
          <label class="form-check-label" for="inlineChekc1">Aprendiz</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="unidadeCheckBox2" id="inlineCheck2" value="2" 
          <?php  
            if( isset($_POST['unidadeCheckBox2']) ){
              if( $_POST['unidadeCheckBox2'] == 2 )
                echo 'checked';
            }
          ?> >
          <label class="form-check-label" for="inlineCheck2">Usuários</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="unidadeCheckBox3" id="inlineCheck3" value="3"
          <?php  
            if( isset($_POST['unidadeCheckBox3']) ){
              if( $_POST['unidadeCheckBox3'] == 3 )
                echo 'checked';
            } 
          ?> >
          <label class="form-check-label" for="inlineCheck3">Mestre</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="unidadeCheckBox4" id="inlineCheck4" value="4"
          <?php  
            if( isset($_POST['unidadeCheckBox4']) ){
              if( $_POST['unidadeCheckBox4'] == 4 )
                echo 'checked';
            } 
          ?> >
          <label class="form-check-label" for="inlineCheck4">Operacional</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="unidadeCheckBox5" id="inlineCheck5" value="5"
          <?php  
            if( isset($_POST['unidadeCheckBox5']) ){
              if( $_POST['unidadeCheckBox5'] == 5 )
                echo 'checked';
            } 
          ?> >
          <label class="form-check-label" for="inlineCheck5">Processo Seletivo</label>
        </div>
      </div>
      <div class="col-lg-1">
        <button name="pesquisar" class="btn btn-success btn-sm" type="submit"><i class="fas fa-search"></i> &nbsp; PESQUISAR</button>
      </div>
    </div>
    <hr class="my-2">
    <div class="row">
      <div class="col-lg-12">   <!-- table-striped table-bordered table-hover /// thead-dark -->
        <table id="tab_full_exp" class="table table-bordered table-hover table-sm " style="width:100%">
          <thead class="thead-light">
            <tr class="text-center">
              <th>#</th>
              <th>PERFIL</th>
              <th>NOME</th>
              <th>ANO</th>
              <th>TURMA</th>
              <th>SALA</th>
              <th>UNIDADE</th>
            </tr>
          </thead>
          <tbody class="text-center align-middle">
          <?php
            $contatos = new Contacts($_SESSION['userId']);
            $perfis = "";

            if((isset($_POST['pesquisar'])) or ($contatos->countUsersLike()==0)){
              if( isset($_POST['unidadeCheckBox1']) ){
                $perfis .= "'A' ";
              }
              if( isset($_POST['unidadeCheckBox2']) ){
                if( strlen($perfis) > 0 ){
                  $perfis .= ", ";
                }
                $perfis .= "'U'";
              }
              if( isset($_POST['unidadeCheckBox3']) ){
                if( strlen($perfis) > 0 ){
                  $perfis .= ", ";
                }
                $perfis .= "'M'";
              }
              if( isset($_POST['unidadeCheckBox4']) ){
                if( strlen($perfis) > 0 ){
                  $perfis .= ", ";
                }
                $perfis .= "'X'";
              }
              if( isset($_POST['unidadeCheckBox5']) ){
                if( strlen($perfis) > 0 ){
                  $perfis .= ", ";
                }
                $perfis .= "'S'";
              }

              if( strlen($perfis) == 0 ){
                $perfis = "'A', 'U', 'M', 'O', 'S'";
              }
              
              $recordsNumber = $contatos->searchContactsLike( $perfis );
              $linha = array();
              $contador = 0; $indice = 0; 
              while ( $contador < $recordsNumber ) {
                $linha = $contatos->getContactsLike( $contador );
                $indice += 1;  
                echo '<tr>';
                echo '<td>'.$indice.'</td>';
                echo '<td>'.$linha['profile'].'</td>';
                echo '<td><a href="index.php?link='.$linkEdit.'&id='.$linha['id'].'" >'.$linha['name'].' <'.$linha['id'].'> </a></td>';
                switch ( $linha['year'] ) {
                  case 13:
                    $ano = "Infantil";
                    break;
                  case 1:
                    $ano = "1o Ano - EF 1";
                    break;
                  case 2:
                    $ano = "2o Ano - EF 1";
                    break;
                  case 3:
                    $ano = "3o Ano - EF 1";
                    break;
                  case 4:
                    $ano = "4o Ano - EF 1";
                    break;
                  case 5:
                    $ano = "5o Ano - EF 1";
                    break;
                  case 6:
                    $ano = "6o Ano - EF 2";
                    break;
                  case 7:
                    $ano = "7o Ano - EF 2";
                    break;
                  case 8:
                    $ano = "8o Ano - EF 2";
                    break;
                  case 9:
                    $ano = "9o Ano - EF 2";
                    break;
                  case 10:
                    $ano = "1a Série - EM";
                    break;
                  case 11:
                    $ano = "2a Série - EM";
                    break;
                  case 12:
                    $ano = "3a Série - EM";
                    break;
                  default:
                    $ano = "N/A (Não se Aplica)";
                    break;
                }
                echo '<td>'.$ano.'</td>';
                switch ( $linha['turma'] ) {
                  case 'N':
                    $turma = "N/A (Não se Aplica)";
                    break;
                  default:
                    $turma = $linha['turma'];
                    break;
                }
                echo '<td>'.$turma.'</td>';
                switch ( $linha['sala'] ) {
                  case 99:
                    $sala = "N/A (Não se Aplica)";
                    break;
                  default:
                    $sala = $linha['sala'];
                    break;
                }
                echo '<td>'.$sala.'</td>';
                switch ( $linha['unit'] ) {
                  case 1:
                    $unidade = "ALPHÃO";
                    break;
                  case 2:
                    $unidade = "ALPHINHA";
                    break;
                  default:
                    $unidade = "N/A (Não se Aplica)";
                    break;
                }
                echo '<td>'.$unidade.'</td>';
                //echo '<td>'.$linha['username'].'</td>';
                echo '</tr>';
                $contador += 1;
              }
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="mx-auto mb-4 mt-3">
      </div>
    </div>
  </form>
</div> <!-- /container -->

