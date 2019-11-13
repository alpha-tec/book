<?php
	include("share/login-secure.php");

  $menu = new Menu( $_SESSION['profileId'] );
  $linkHome = $menu->getPageNumber('sponsors/welcome.php');

?>
<ol class="breadcrumb p-0 mb-0">
	<li class="breadcrumb-item "><small>Usuário / Novo</small></li>
</ol>
<div class="container-fluid pt-1">
  <form class="form-signin"  method="post" action="">

    <div class="text-left">
        <a href="index.php" class="btn btn-sm btn-warning font-weight-bold" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="top" title="Voltar para tela anterior"><i class="fas fa-times"></i>&nbsp;CANCELAR</a> 
        <button class="btn btn-sm btn-success pl-3 pr-3 ml-3 md-3 font-weight-bold" name="criar" type="submit" data-toggle="tooltip" data-placement="top" title="Salvar as alterações"><i class="fas fa-check"></i> &nbsp; SALVAR</button>
    </div>

    <hr class="my-2">
    <div class="row">
      <div class="col-md-12 ">
        <div class="row">
          <div class="col-12">
            <?php
              $contact = new Contacts($_SESSION['userId']);
              $contactMae = new Contacts($_SESSION['userId']);
              $contactPai = new Contacts($_SESSION['userId']);
              $address = new Address($_SESSION['userId']);
              $erro = '';
              $salvar = true;
              $focusInputCEP = 0;
              $focusInputCPF = 0;
              if(isset($_POST['name']))
                $contact->setName($_POST['name']);
              if(isset($_POST['perfil']))
                $contact->setProfileId($_POST['perfil']);
              if(isset($_POST['cpf']))
                $contact->setCpf($_POST['cpf']);
              if(isset($_POST['rg']))
                $contact->setRg($_POST['rg']);
              if(isset($_POST['emissor']))
                $contact->setEmissor($_POST['emissor']);
              if(isset($_POST['data_emissao']))
                $contact->setDataEmissao($_POST['data_emissao']);
              if(isset($_POST['rm']))
                $contact->setRm($_POST['rm']);
              if(isset($_POST['birthdate']))
                $contact->setBirthdate($_POST['birthdate']);
              if(isset($_POST['gender']))
                $contact->setGender($_POST['gender']);
              if(isset($_POST['phone']))
                $contact->setPhone($_POST['phone']);
              if(isset($_POST['mobile']))
                $contact->setMobile($_POST['mobile']);
             //if(isset($_POST['escola']))
                $contact->setSchoolId(1);
              if(isset($_POST['unidade']))
                $contact->setUnitId($_POST['unidade']);
              if(isset($_POST['anoId']))
                $contact->setAnoId($_POST['anoId']);
              if(isset($_POST['sala']))
                $contact->setSala($_POST['sala']);
              if(isset($_POST['turma']))
                $contact->setTurma($_POST['turma']);
              if(isset($_POST['email']))
                $contact->setEmail($_POST['email']);
              if(isset($_POST['cep']))
                $address->setCEP($_POST['cep']);
              if(isset($_POST['logradouro']))
                $address->setLogradouro($_POST['logradouro']);
              if(isset($_POST['numero']))
                $address->setNumero($_POST['numero']);
              if(isset($_POST['complemento']))
                $address->setComplemento($_POST['complemento']);
              if(isset($_POST['bairro']))
                $address->setBairro($_POST['bairro']);
              if(isset($_POST['cidade']))
                $address->setCidade($_POST['cidade']);
              if(isset($_POST['uf']))
                $address->setUF($_POST['uf']);
              if(isset($_POST['comentarios']))
                $address->setComentarios($_POST['comentarios']);

              if(isset($_POST['respfin']))
                $contact->setRespFin($_POST['respfin']);
              if(isset($_POST['respped']))
                $contact->setRespPed($_POST['respped']);

              if(isset($_POST['criar'])) {
                $contact->setName($_POST['name']);
                $contact->setProfileId($_POST['perfil']);
                //VALIDAÇÃO CPF
                //if($contact->checkCpf($_POST['cpf'])){
                //  if(!$contact->setCpf($_POST['cpf'])){
                //    $focusInputCPF = 1;
                //    $erro = 'CPF inválido, por favor insira um número válido. ';
                //    $salvar = false;
                //  }
                //}else{
                //  $focusInputCPF = 1;
                //  $erro = 'Já existe um usuário com este CPF, por favor insira outro número. ';
                //  $salvar = false;
                //}
                $contact->setRg($_POST['rg']);
                $contact->setEmissor($_POST['emissor']);
                $contact->setDataEmissao($_POST['data_emissao']);
                $contact->setRm($_POST['rm']);
                $contact->setBirthdate($_POST['birthdate']);
                $contact->setGender($_POST['gender']);
                $contact->setPhone($_POST['phone']);
                $contact->setMobile($_POST['mobile']);
                $contact->setSchoolId($_POST['escola']);
                $contact->setUnitId($_POST['unidade']);
                $contact->setAnoId($_POST['anoId']);
                $contact->setSala($_POST['sala']);
                $contact->setTurma($_POST['turma']);
                $contact->setEmail($_POST['email']);

                $address->setCEP($_POST['cep']);
                $address->setLogradouro($_POST['logradouro']);
                $address->setNumero($_POST['numero']);
                $address->setComplemento($_POST['complemento']);
                $address->setBairro($_POST['bairro']);
                $address->setCidade($_POST['cidade']);
                $address->setUF($_POST['uf']);
                $address->setComentarios($_POST['comentarios']);

                if($salvar){
                  if(!$contact->createContact()){
                    $erro .= "Erro na criação do contato. Revise os valores dos campos de contato. ";
                  }else{
                    $address->setContactId($contact->getContactId());
                  }
                  if(!$address->save()){
                    $erro .= "Erro na criação do endereço. Revise os valores dos campos de endereço. ";
                  }
                }
                if(strlen($erro)){
                  echo '<div class="alert alert-dismissible alert-danger">';
                  echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                  echo '<strong>'.$erro.'</strong>';
                  echo '</div>';
                }else{
                  echo '<div class="alert alert-dismissible alert-success">';
                  echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                  echo '<strong>"'.$contact->getName().'" foi cadastrado com sucesso!</strong>';
                  echo '</div>';
                }
              }
              if( isset($_POST['buscarCEP']) ){
                if( isset($_POST['cep']) ){
                  $address_resultado = $address->busca_cep($_POST['cep']);
                  unset($_POST['buscarCEP']);
                }
                $focusInputCEP = 1;
              }
            ?>
          </div>
        </div>
        <h5 class="text-left font-weight-bold">CONTATO</h5>
        <div class="row">
          <div class="col-lg-4">
          </div>  
          <div class="col-lg-3">
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend" >
                <span class="input-group-text " id="inputGroup-nome">NOME COMPLETO</span>
              </div>
              <input required type="text" name="name"  placeholder="Nome completo" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nome" style="text-transform:uppercase" value="<?php echo $contact->getName(); ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-perfil">PERFIL</span>
              </div>
              <select name="perfil" required class="custom-select " id="inputGroup-perfil" aria-label="Default" aria-describedby="inputGroup-perfil" >
              <option value=''>-- ESCOLHA --</option>
                <?php 
                  $lista = array();
                  $registro = array();
                  $k = $contact->loadProfileList(1);
                  if($k > 0){
                    $lista = $contact->getProfileList();
                    $i = 0;
                    while($k){
                      $registro = $lista[$i];
                      //echo "<br>";
                      echo "<option value='".$lista[$i]['id']."' ";
                      if($contact->getProfileId() == $lista[$i]['id'])
                        echo " selected ";

                      echo "> ".$lista[$i]['profile']." </option>";
                      $k -= 1;
                      $i += 1;
                    }
                  }
                ?>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-cpf">CPF</span>
              </div>
              <input type="text" name="cpf" id="cpf" required placeholder="Digite o seu CPF" class="cpf custom-select " aria-label="Default" aria-describedby="inputGroup-cpf" style="text-transform:uppercase" value="<?php echo $contact->getCpf(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-rg">RG</span>
              </div>
              <input type="text" name="rg" required placeholder="Seu RG" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rg" style="text-transform:uppercase" value="<?php echo $contact->getRg(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-rgemissort">EMISSOR DO RG</span>
              </div>
              <input type="text" name="emissor" required placeholder="Emissor (ex: 'SSP/SP')" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgemissor" style="text-transform:uppercase" value="<?php echo $contact->getEmissor(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-rgdata">EMISSÃO DO RG</span>
              </div>
              <input type="date" name="data_emissao" placeholder="Data de emissão do RG" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgdata" style="text-transform:uppercase" value="<?php echo $contact->getDataEmissao(); ?>">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-nome">RM GALILEU</span>
              </div>
              <input type="text" name="rm" placeholder="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nome" style="text-transform:uppercase" value="<?php echo $contact->getRm(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-nascimento">NASCIMENTO</span>
              </div>
              <input type="date" name="birthdate" required placeholder="Data de nascimento" pattern="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nascimento" style="text-transform:uppercase" value="<?php echo $contact->getBirthdate(); ?>">
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-sexo">SEXO</span>
              </div>
              <select name="gender" required class="custom-select " id="inputGroup-sexo" aria-label="Default" aria-describedby="inputGroup-sexo" >
                <option value='' selected>-- ESCOLHA --</option>
                <option value='F' <?php if($contact->getGender() == 'F'){ echo 'selected';} ?> >FEMININO</option>
                <option value='M' <?php if($contact->getGender() == 'M'){ echo 'selected';} ?> >MASCULINO</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-telefone">TELEFONE</span>
              </div>
              <input type="text" name="phone" placeholder=" (XX) XXXX-XXXX" id="celphones" class="celphones " aria-label="Default" aria-describedby="inputGroup-telefone" value="<?php echo $contact->getPhone(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-cel1">&nbsp;&nbsp; CELULAR</span>
              </div>
              <input type="tel" name="mobile" placeholder=" (XX) 9XXXX-XXXX" id="celphones" class="celphones " required pattern=".{15,}" minlenght="15" aria-label="Default" aria-describedby="inputGroup-cel1" title="Inclua o DDD e o número do celular" value="<?php echo $contact->getMobile(); ?>">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroupSelect04">ESCOLA</span>
              </div>
              <select name="escola" class="custom-select " id="inputGroupSelect04">
                <option value selected ="1" <?php //if($contact->getUnitId() == 1) echo 'selected'; ?> >ALPHA LUMEN</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroupSelectUnidade">UNIDADE</span>
              </div>
              <select name="unidade" required class="custom-select " id="inputGroupSelectUnidade">
                <option  >-- ESCOLHA --</option>
                <option value=1 <?php if($contact->getUnitId() == 1) echo 'selected'; ?> >ALPHÃO</option>
                <option value=2 <?php if($contact->getUnitId() == 2) echo 'selected'; ?> >ALPHINHA</option>
                <option value=999 <?php if($contact->getUnitId() == 999) echo 'selected'; ?>>N/A (Não se Aplica)</option>
              </select>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <label class="input-group-text " for="inputGroupSelect01">ANO/SÉRIE</label>
              </div>
              <select name="anoId" class="custom-select " id="inputGroupSelect01">
                <option value="0" >-- ESCOLHA --</option>
                <?php 
                  $lista = array();
                  $k = $contact->loadAnoList(1);
                  if($k > 0){
                    $lista = $contact->getAnoList();
                    $i = 0;
                    $year =  $contact->getAnoId();
                    while($k){
                      echo "<option value=".$lista[$i]['id'];
                      if($lista[$i]['id'] == $year)
                        echo " selected ";
                      echo ">".$lista[$i]['ano']."</option>";
                      $k -= 1;
                      $i += 1;
                    }
                  }
                ?>
              </select>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                  <span class="input-group-text  pl-4 pr-4 " id="inputGroupSelect02">SALA</span>
              </div>
              <select name="sala" class="custom-select " id="inputGroupSelect02">
                <option value="0" >-- ESCOLHA --</option>
                <option value="1" <?php if($contact->getSala() == '1') echo "selected"; ?>  >SALA 1</option>
                <option value="2" <?php if($contact->getSala() == '2') echo "selected"; ?>  >SALA 2</option>
                <option value="3" <?php if($contact->getSala() == '3') echo "selected"; ?>  >SALA 3</option>
                <option value="4" <?php if($contact->getSala() == '4') echo "selected"; ?>  >SALA 4</option>
                <option value="5" <?php if($contact->getSala() == '5') echo "selected"; ?>  >SALA 5</option>
                <option value="6" <?php if($contact->getSala() == '6') echo "selected"; ?>  >SALA 6</option>
                <option value="7" <?php if($contact->getSala() == '7') echo "selected"; ?>  >SALA 7</option>
                <option value="8" <?php if($contact->getSala() == '8') echo "selected"; ?>  >SALA 8</option>
                <option value="9" <?php if($contact->getSala() == '9') echo "selected"; ?>  >SALA 9</option>
                <option value="10" <?php if($contact->getSala() == '10') echo "selected"; ?>  >SALA 10</option>
                <option value="11" <?php if($contact->getSala() == '11') echo "selected"; ?>  >SALA 11</option>
                <option value="12" <?php if($contact->getSala() == '12') echo "selected"; ?>  >SALA 12</option>
                <option value="99" <?php if($contact->getSala() == '99') echo "selected"; ?>  >N/A - (NÃO SE APLICA)</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  pl-4 pr-4 " id="inputGroupSelect03">TURMA</span>
              </div>
              <select name="turma" class="custom-select " id="inputGroupSelect03">
                <option value="0" >-- ESCOLHA --</option>
                <option value="A" <?php if($contact->getTurma() == 'A') echo "selected"; ?> >TURMA A</option>
                <option value="B" <?php if($contact->getTurma() == 'B') echo "selected"; ?> >TURMA B</option>
                <option value="C" <?php if($contact->getTurma() == 'C') echo "selected"; ?> >TURMA C</option>
                <option value="D" <?php if($contact->getTurma() == 'D') echo "selected"; ?> >TURMA D</option>
                <option value="E" <?php if($contact->getTurma() == 'E') echo "selected"; ?> >TURMA E</option>
                <option value="F" <?php if($contact->getTurma() == 'F') echo "selected"; ?> >TURMA F</option>
                <option value="G" <?php if($contact->getTurma() == 'G') echo "selected"; ?> >TURMA G</option>
                <option value="N" <?php if($contact->getTurma() == 'N') echo "selected"; ?> >N/A (Não se Aplica)</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-email1">E-MAIL</span>
              </div>
              <input type="email" name="email" required placeholder="Seu endereço de e-mail" class="custom-select border " aria-label="Default" aria-describedby="inputGroup-email1" style="text-transform:uppercase" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Insira um endereço válido" value="<?php echo $contact->getEmail(); ?>">
            </div>
            <p>___ : Preencimento obrigatório.</p>
          </div>
        </div>
        <hr class="my-4">
        <h5 class="text-left font-weight-bold">ENDEREÇO</h5>
        <form class="form-signin"  method="post" action="">
        <div class="row">
          <div class="col-lg-3">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-sizing-sm">CEP</span>
              </div>
              <input type="text" name="cep" class="custom-select " placeholder="Seu CEP" aria-label="Default" aria-describedby="basic-addon2" style="text-transform:uppercase" value="<?php echo $address->getCep(); ?>">
              <div class="input-group-append">
              <button class="btn btn-success" name="buscarCEP" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para encontrar um endereço usando seu CEP"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-logradouro">LOGRADOURO</span>
              </div>
              <input type="text" name="logradouro" placeholder="Endereço" class="custom-select " aria-label="Default" aria-describedby="inputGroup-logradouro" style="text-transform:uppercase" value="<?php echo $address->getLogradouro(); ?>">
              </div>
          </div>
          <div class="col-lg-3">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="inputGroup-numero">NÚMERO</span>
                </div>
                <input type="text" name="numero" placeholder="Número" class="custom-select " aria-label="Default" aria-describedby="inputGroup-numero" style="text-transform:uppercase" value="<?php echo $address->getNumero(); ?>">
              </div>
          </div>
          <div class="col-lg-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="inputGroup-complemento">COMPLEMENTO</span>
                </div>
                <input type="text" name="complemento" placeholder="Complemento (EX. APTO 71)" class="custom-select " aria-label="Default" aria-describedby="inputGroup-complemento" style="text-transform:uppercase" value="<?php echo $address->getComplemento(); ?>">
              </div>
          </div>
          <div class="col-lg-8">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="inputGroup-bairro">BAIRRO</span>
                </div>
                <input type="text" name="bairro" placeholder="Bairro" class="custom-select " aria-label="Default" aria-describedby="inputGroup-bairro" style="text-transform:uppercase" value="<?php       echo $address->getBairro();?>">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text " idr="inputGroup-cidade">CIDADE</span>
                </div>
                <input type="text" name="cidade" placeholder="Cidade" class="custom-select " aria-label="Default" aria-describedby="inputGroup-cidade" style="text-transform:uppercase" value="<?php echo $address->getCidade();?>">
              </div>
          </div>
          <div class="col-lg-4">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="inputGroup-uf">UF</span>
                </div>
                <select name="uf" class="custom-select " id="inputGroup-uf" aria-label="Default" aria-describedby="inputGroup-uf" >
                  <option value=''>-- ESCOLHA --</option>
                  <option value='AC' <?php if($address->getUF() == 'AC') echo 'selected'; ?> >ACRE</option>
                  <option value='AL' <?php if($address->getUF() == 'AL') echo 'selected'; ?> >ALAGOAS</option>
                  <option value='AM' <?php if($address->getUF() == 'AM') echo 'selected'; ?> >AMAZONAS</option>
                  <option value='AP' <?php if($address->getUF() == 'AP') echo 'selected'; ?> >AMAPÁ</option>
                  <option value='BA' <?php if($address->getUF() == 'BA') echo 'selected'; ?> >BAHIA</option>
                  <option value='CE' <?php if($address->getUF() == 'CE') echo 'selected'; ?> >CEARÁ</option>
                  <option value='DF' <?php if($address->getUF() == 'DF') echo 'selected'; ?> >DISTRITO FEDERAL</option>
                  <option value='ES' <?php if($address->getUF() == 'ES') echo 'selected'; ?> >ESPÍRITO SANTO</option>
                  <option value='GO' <?php if($address->getUF() == 'GO') echo 'selected'; ?> >GOIÁS</option>
                  <option value='MA' <?php if($address->getUF() == 'MA') echo 'selected'; ?> >MARANHÃO</option>
                  <option value='MG' <?php if($address->getUF() == 'MG') echo 'selected'; ?> >MINAS GERAIS</option>
                  <option value='MS' <?php if($address->getUF() == 'MS') echo 'selected'; ?> >MATO GROSSO DO SUL</option>
                  <option value='MT' <?php if($address->getUF() == 'MT') echo 'selected'; ?> >MATO GROSSO</option>
                  <option value='PA' <?php if($address->getUF() == 'PA') echo 'selected'; ?> >PARÁ</option>
                  <option value='PB' <?php if($address->getUF() == 'PB') echo 'selected'; ?> >PARAIBA</option>
                  <option value='PE' <?php if($address->getUF() == 'PE') echo 'selected'; ?> >PERNAMBUCO</option>
                  <option value='PI' <?php if($address->getUF() == 'PI') echo 'selected'; ?> >PIAUÍ</option>
                  <option value='PR' <?php if($address->getUF() == 'PR') echo 'selected'; ?> >PARANÁ</option>
                  <option value='RJ' <?php if($address->getUF() == 'RJ') echo 'selected'; ?> >RIO DE JANEIRO</option>
                  <option value='RN' <?php if($address->getUF() == 'RN') echo 'selected'; ?> >RIO GRANDE DO NORTE</option>
                  <option value='RO' <?php if($address->getUF() == 'RO') echo 'selected'; ?> >RONDÔNIA</option>
                  <option value='RR' <?php if($address->getUF() == 'RR') echo 'selected'; ?> >RORAIMA</option>
                  <option value='RS' <?php if($address->getUF() == 'RS') echo 'selected'; ?> >RIO GRANDE DO SUL</option>
                  <option value='SC' <?php if($address->getUF() == 'SC') echo 'selected'; ?> >SANTA CATARINA</option>
                  <option value='SE' <?php if($address->getUF() == 'SE') echo 'selected'; ?> >SERGIPE</option>
                  <option value='SP' <?php if($address->getUF() == 'SP') echo 'selected'; ?> >SÃO PAULO</option>
                  <option value='TO' <?php if($address->getUF() == 'TO') echo 'selected'; ?> >TOCANTINS</option>
                  <option value='OO' <?php if($address->getUF() == 'NA') echo 'selected'; ?> >NÃO SE APLICA</option>
                </select>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text " style="height: 100%;" idr="inputGroup-comentario">COMENTÁRIOS</span>
                </div>
                <textarea name="comentarios" placeholder="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-comentario" style="text-transform:uppercase" ><?php echo $address->getComentarios();?></textarea>
              </div>
          </div>
        </div>
        </form>
        <?php  $address_resultado=0; ?>
        <hr class="my-4">
        <h5 class="text-left font-weight-bold">RESPONSÁVEL</h5>
        <div class="row">
          <div class="col-lg-4">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-perfil-fin">FINANCEIRO</span>
              </div>
              <select name="respfin" required class="custom-select " id="inputGroup-respfin" aria-label="Default" aria-describedby="inputGroup-respfin" >
                <option value="" >-- ESCOLHA --</option>
                <option value="M" <?php if($contact->getRespFin() == "M") echo "selected"; ?> >MÃE</option>
                <option value="P" <?php if($contact->getRespFin() == "P") echo "selected"; ?> >PAI</option>
                <option value="O" <?php if($contact->getRespFin() == "O") echo "selected"; ?> >OUTRO</option>
                <option value="A" <?php if($contact->getRespFin() == "A") echo "selected"; ?> >PRÓPRIO ALUNO</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-perfil-ped">PEDAGÓGICO</span>
              </div>
              <select name="respped" required class="custom-select " id="inputGroup-respped" aria-label="Default" aria-describedby="inputGroup-respped" >
                <option value=''>-- ESCOLHA --</option>
                <option value="M" <?php if($contact->getRespPed() == "M") echo "selected"; ?> >MÃE</option>
                <option value="P" <?php if($contact->getRespPed() == "P") echo "selected"; ?> >PAI</option>
                <option value="O" <?php if($contact->getRespPed() == "O") echo "selected"; ?> >OUTRO</option>
                <option value="A" <?php if($contact->getRespPed() == "A") echo "selected"; ?> >PRÓPRIO ALUNO</option>
              </select>
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text pl-3 pr-4" id="inputGroup-sizing-sm">MÃE</span>
              </div>
              <input type="text" class="custom-select " placeholder="" aria-label="Recipient" aria-describedby="basic-addon2" style="text-transform:uppercase">
              <div class="input-group-append">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalOutro" data-toggle="tooltip" data-placement="top" title="Pesquisar Contato "><i class="fas fa-search"></i></button>
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalMae" data-toggle="tooltip" data-placement="top" title="Adicionar Contato "><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text pl-4 pr-4 " id="inputGroup-sizing-sm">PAI</span>
              </div>
              <input type="text" class="custom-select " placeholder="" aria-label="Recipient" aria-describedby="basic-addon2" style="text-transform:uppercase">
              <div class="input-group-append">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalOutro" data-toggle="tooltip" data-placement="top" title="Pesquisar Contato "><i class="fas fa-search"></i></button>
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalPai" data-toggle="tooltip" data-placement="top" title="Adicionar Contato "><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text " id="inputGroup-sizing-sm">OUTRO</span>
              </div>
              <input type="text" class="custom-select " placeholder="" aria-label="Recipient" aria-describedby="basic-addon2" style="text-transform:uppercase">
              <div class="input-group-append">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalOutro" data-toggle="tooltip" data-placement="top" title="Pesquisar Contato "><i class="fas fa-search"></i></button>
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalOutro" data-toggle="tooltip" data-placement="top" title="Adicionar Contato "><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </form>
</div> <!-- /container -->

<!-- Modal MÃE-->
<div class="modal fade " id="modalMae" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-left">
        <h5 class="modal-title">DADOS DA MÃE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      <div class="modal-body ">

        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-sexo">PARENTESCO</span>
              </div>
              <select name="parentesco" required class="custom-select " id="inputGroup-parentesco" aria-label="Default" aria-describedby="inputGroup-parentesco" >
                <option value=0 >-- ESCOLHA --</option>
                <option value=1 selected >MÃE</option>
                <option value=2 >PAI</option>
                <option value=3 >MADRASTA</option>
                <option value=4 >PADRASTRO</option>
                <option value=5 >AVÔ(Ó)</option>
                <option value=6 >IRMÃO(Ã)</option>
                <option value=7 >TIO(A)</option>
                <option value=8 >PRIMO(A)</option>
                <option value=9 >OUTRO</option>
                <option value=10 >A MESMA PESSOA</option>
              </select>
            </div>
          </div>              
              
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-nome">NOME COMPLETO</span>
              </div>
              <input type="text" name="nameMae" required placeholder="Nome completo..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-nome" style="text-transform:uppercase" value="<?php echo $contactMae->getName(); ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-cpf">CPF</span>
              </div>
              <input type="text" name="cpf" id="cpf" required placeholder="Seu CPF..." class="cpf custom-select " aria-label="Default" aria-describedby="inputGroup-cpf" style="text-transform:uppercase" value="<?php echo $contactMae->getCpf(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rg">RG</span>
              </div>
              <input type="text" name="rg" required placeholder="Seu RG..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rg" style="text-transform:uppercase" value="<?php echo $contactMae->getRg(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rgemissort">EMISSOR DO RG</span>
              </div>
              <input type="text" name="emissor" required placeholder="Emissor (ex: 'SSP/SP')..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgemissor" style="text-transform:uppercase" value="<?php echo $contactMae->getEmissor(); ?>">
            </div>
            <div class="input-group mb-3 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rgdata">DATA EMISSÃO DO RG</span>
              </div>
              <input type="date" name="data_emissao" placeholder="Data de emissão do RG" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgdata" style="text-transform:uppercase" value="<?php echo $contactMae->getDataEmissao(); ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-sexo">SEXO</span>
              </div>
              <select name="gender" required class="custom-select " id="inputGroup-sexo" aria-label="Default" aria-describedby="inputGroup-sexo" >
                <option value='' >-- ESCOLHA --</option>
                <option value='F' selected <?php if($contactMae->getGender() == 'F'){ echo 'selected';} ?> >FEMININO</option>
                <option value='M' <?php if($contactMae->getGender() == 'M'){ echo 'selected';} ?> >MASCULINO</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-nascimento">NASCIMENTO</span>
              </div>
              <input type="date" name="birthdate" required placeholder="Data de nascimento" pattern="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nascimento" style="text-transform:uppercase" value="<?php echo $contactMae->getBirthdate(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-telefone">TELEFONE</span>
              </div>
              <input type="text" name="phone" placeholder=" (XX) XXXX-XXXX" id="celphones" class="celphones " aria-label="Default" aria-describedby="inputGroup-telefone" value="<?php echo $contactMae->getPhone(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-cel1">&nbsp;&nbsp; CELULAR</span>
              </div>
              <input type="tel" name="mobile" placeholder=" (XX) 9XXXX-XXXX" id="celphones" class="celphones " required pattern=".{15,}" minlenght="15" aria-label="Default" aria-describedby="inputGroup-cel1" title="Inclua o DDD e o número do celular" value="<?php echo $contactMae->getMobile(); ?>">
            </div>

          </div>

          <div class="col-12">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-email1">E-MAIL</span>
              </div>
              <input type="email" name="email" required placeholder="Seu endereço de e-mail..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-email1" style="text-transform:uppercase" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Insira um endereço válido" value="<?php echo $contactMae->getEmail(); ?>">
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" ><i class="fas fa-check"></i> &nbsp; SALVAR</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp; FECHAR</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal PAI-->
<div class="modal fade " id="modalPai" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-left">
        <h5 class="modal-title">DADOS DO PAI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      <div class="modal-body ">

        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-sexo">PARENTESCO</span>
              </div>
              <select name="parentesco" required class="custom-select " id="inputGroup-parentesco" aria-label="Default" aria-describedby="inputGroup-parentesco" >
                <option value=0 >-- ESCOLHA --</option>
                <option value=1 >MÃE</option>
                <option value=2 selected >PAI</option>
                <option value=3 >MADRASTA</option>
                <option value=4 >PADRASTRO</option>
                <option value=5 >AVÔ(Ó)</option>
                <option value=6 >IRMÃO(Ã)</option>
                <option value=7 >TIO(A)</option>
                <option value=8 >PRIMO(A)</option>
                <option value=9 >OUTRO</option>
                <option value=10 >A MESMA PESSOA</option>
              </select>
            </div>
          </div>              
              
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-nome">NOME COMPLETO</span>
              </div>
              <input type="text" name="namePai" required placeholder="Nome completo..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-nome" style="text-transform:uppercase" value="<?php echo $contactMae->getName(); ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-cpf">CPF</span>
              </div>
              <input type="text" name="cpf" id="cpf" required placeholder="Seu CPF..." class="cpf custom-select " aria-label="Default" aria-describedby="inputGroup-cpf" style="text-transform:uppercase" value="<?php echo $contactMae->getCpf(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rg">RG</span>
              </div>
              <input type="text" name="rg" required placeholder="Seu RG..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rg" style="text-transform:uppercase" value="<?php echo $contactMae->getRg(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rgemissort">EMISSOR DO RG</span>
              </div>
              <input type="text" name="emissor" required placeholder="Emissor (ex: 'SSP/SP')..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgemissor" style="text-transform:uppercase" value="<?php echo $contactMae->getEmissor(); ?>">
            </div>
            <div class="input-group mb-3 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-rgdata">DATA EMISSÃO DO RG</span>
              </div>
              <input type="date" name="data_emissao" placeholder="Data de emissão do RG" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgdata" style="text-transform:uppercase" value="<?php echo $contactMae->getDataEmissao(); ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-sexo">SEXO</span>
              </div>
              <select name="gender" required class="custom-select" id="inputGroup-sexo" aria-label="Default" aria-describedby="inputGroup-sexo" >
                <option value='' >-- ESCOLHA --</option>
                <option value='F'  <?php if($contactMae->getGender() == 'F'){ echo 'selected';} ?> >FEMININO</option>
                <option value='M' selected <?php if($contactMae->getGender() == 'M'){ echo 'selected';} ?> >MASCULINO</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-nascimento">NASCIMENTO</span>
              </div>
              <input type="date" name="birthdate" required placeholder="Data de nascimento" pattern="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nascimento" style="text-transform:uppercase" value="<?php echo $contactMae->getBirthdate(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-telefone">TELEFONE</span>
              </div>
              <input type="text" name="phone" placeholder=" (XX) XXXX-XXXX" id="celphones" class="celphones " aria-label="Default" aria-describedby="inputGroup-telefone" value="<?php echo $contactMae->getPhone(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-cel1">&nbsp;&nbsp; CELULAR</span>
              </div>
              <input type="tel" name="mobile" placeholder=" (XX) 9XXXX-XXXX" id="celphones" class="celphones " required pattern=".{15,}" minlenght="15" aria-label="Default" aria-describedby="inputGroup-cel1" title="Inclua o DDD e o número do celular" value="<?php echo $contactMae->getMobile(); ?>">
            </div>

          </div>

          <div class="col-12">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text font-weight-bold" id="inputGroup-email1">E-MAIL</span>
              </div>
              <input type="email" name="email" required placeholder="Seu endereço de e-mail..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-email1" style="text-transform:uppercase" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Insira um endereço válido" value="<?php echo $contactMae->getEmail(); ?>">
            </div>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" ><i class="fas fa-check"></i> &nbsp; SALVAR</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp; FECHAR</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal OUTRO-->
<div class="modal fade " id="modalOutro" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-left">
        <h5 class="modal-title">DADOS DO RESPONSÁVEL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      <div class="modal-body ">

        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-sexo">PARENTESCO</span>
              </div>
              <select name="parentesco" required class="custom-select " id="inputGroup-parentesco" aria-label="Default" aria-describedby="inputGroup-parentesco" >
                <option value=0 >-- ESCOLHA --</option>
                <option value=1 >MÃE</option>
                <option value=2 >PAI</option>
                <option value=3 >MADRASTA</option>
                <option value=4 >PADRASTRO</option>
                <option value=5 >AVÔ(Ó)</option>
                <option value=6 >IRMÃO(Ã)</option>
                <option value=7 >TIO(A)</option>
                <option value=8 >PRIMO(A)</option>
                <option value=9 >OUTRO</option>
                <option value=10 >A MESMA PESSOA</option>
              </select>
            </div>
          </div>              
              
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-nome">NOME COMPLETO</span>
              </div>
              <input type="text" name="nameResp" required placeholder="Nome completo..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-nome" style="text-transform:uppercase" value="<?php echo $contactMae->getName(); ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-cpf">CPF</span>
              </div>
              <input type="text" name="cpf" id="cpf" required placeholder="Seu CPF..." class="cpf custom-select " aria-label="Default" aria-describedby="inputGroup-cpf" style="text-transform:uppercase" value="<?php echo $contactMae->getCpf(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-rg">RG</span>
              </div>
              <input type="text" name="rg" required placeholder="Seu RG..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rg" style="text-transform:uppercase" value="<?php echo $contactMae->getRg(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-rgemissort">EMISSOR DO RG</span>
              </div>
              <input type="text" name="emissor" required placeholder="Emissor (ex: 'SSP/SP')..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgemissor" style="text-transform:uppercase" value="<?php echo $contactMae->getEmissor(); ?>">
            </div>
            <div class="input-group mb-3 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-rgdata">DATA EMISSÃO DO RG</span>
              </div>
              <input type="date" name="data_emissao" placeholder="Data de emissão do RG" class="custom-select " aria-label="Default" aria-describedby="inputGroup-rgdata" style="text-transform:uppercase" value="<?php echo $contactMae->getDataEmissao(); ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-sexo">SEXO</span>
              </div>
              <select name="gender" required class="custom-select " id="inputGroup-sexo" aria-label="Default" aria-describedby="inputGroup-sexo" >
                <option value='' >-- ESCOLHA --</option>
                <option value='F'  <?php if($contactMae->getGender() == 'F'){ echo 'selected';} ?> >FEMININO</option>
                <option value='M' selected <?php if($contactMae->getGender() == 'M'){ echo 'selected';} ?> >MASCULINO</option>
              </select>
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-nascimento">NASCIMENTO</span>
              </div>
              <input type="date" name="birthdate" required placeholder="Data de nascimento" pattern="" class="custom-select " aria-label="Default" aria-describedby="inputGroup-nascimento" style="text-transform:uppercase" value="<?php echo $contactMae->getBirthdate(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-telefone">TELEFONE</span>
              </div>
              <input type="text" name="phone" placeholder=" (XX) XXXX-XXXX" id="celphones" class="celphones " aria-label="Default" aria-describedby="inputGroup-telefone" value="<?php echo $contactMae->getPhone(); ?>">
            </div>
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-cel1">&nbsp;&nbsp; CELULAR</span>
              </div>
              <input type="tel" name="mobile" placeholder=" (XX) 9XXXX-XXXX" id="celphones" class="celphones " required pattern=".{15,}" minlenght="15" aria-label="Default" aria-describedby="inputGroup-cel1" title="Inclua o DDD e o número do celular" value="<?php echo $contactMae->getMobile(); ?>">
            </div>

          </div>

          <div class="col-12">
            <div class="input-group mb-2 ">
              <div class="input-group-prepend">
                <span class="input-group-text  font-weight-bold" id="inputGroup-email1">E-MAIL</span>
              </div>
              <input type="email" name="email" required placeholder="Seu endereço de e-mail..." class="custom-select " aria-label="Default" aria-describedby="inputGroup-email1" style="text-transform:uppercase" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Insira um endereço válido" value="<?php echo $contactMae->getEmail(); ?>">
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" ><i class="fas fa-check"></i> &nbsp; SALVAR</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp; FECHAR</button>
      </div>
    </div>
  </div>
</div>