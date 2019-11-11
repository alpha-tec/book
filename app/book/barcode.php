<?php
   include("share/login-secure.php");

   $username = $_SESSION['ulogin'];
   $password = $_SESSION['upaswd'];
   $user_id = $_SESSION['user_id'];
   $profile_id = $_SESSION['profile_id'];
   $email = $_SESSION['email'];

   $linkHome = $menu->getPageNumber('home/welcome.php');
   $linkBarcode = $menu->getPageNumber('book/barcode.php');

  
?>

<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
   <div class="container-fluid">
      <ul class="breadcrumb">
         <li class="breadcrumb-item"><a href="index.php"> Livro > Barcode</a></li>
      </ul>
   </div>
</div>

<form method="post" action="" class="text-center form-validate">

   <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">

      <div class="col-sm-8 col-md-7 col-lg-6">
         <div class="card">
            <div class="card-header d-flex align-items-center">
               <h4>Icluir Código de Barra</h4>
            </div>               
            <div class="card-body">

               <div class="col-sm-12 ">
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text border border-secondary font-weight-bold" id="inputGroup-sizing-default">Código de Barra</span>
                     </div>

                     <a href="http://zxing.appspot.com/scan?ret=https://ial360.alphalumen.org.br/book/app/index.php?link=<?=$linkBarcode?>&codigo={CODE}" class="btn btn-secondary ml-2 mr-2 " role="button" aria-pressed="true"><i class="fas fa-barcode fa-2x"> </i> </a><input type="text" name="cod" placeholder="Digite o código" class="form-control border border-secondary" aria-label="Default" aria-describedby="inputGroup-sizing-default" autocomplete="off" value="<?=$_GET['codigo'] ?>">
                     <button class="btn btn-success text-center" name="salvar" type="submit"><i class="fas fa-plus fa-2x "></i> Incluir</button>

                  </div>
               </div>

            </div>
         </div>


      </div>
   </div>

</form>
