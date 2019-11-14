<?php
	include("share/login-secure.php");

    $linkHome = $menu->getPageNumber('home/welcome.php');

    $lista1 = $acesso->select("id={$user_id}");
    $lista1 = (object) $lista1[0];
    $acesso->setId($lista1->id);

    $lista2 = $contato->select("id={$contact_id}");
    
    $lista2 = (object) $lista2[0];
    $contato->setId($lista2->id);
    $contato->setUserId($lista2->user_id);
    $contato->setAddressId($lista2->address_id);

    $lista3 = $endereco->select("id={$lista2->address_id}");
    $id = 0;    
    if(count($lista3)> 0){
        $lista3 = (object) $lista3[0];
        $id = $lista3->id;
    }
    $endereco->setId($id);

    $number_focus = 0;
    
?>

<div class="breadcrumb-holder">
   <div class="container-fluid">
      <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Usuário > Editar Dados</a></li>
      </ul>
   </div>
</div>


<div class="container-fluid ">
    <div class="card border-0">
        <div class="card-body">

        <?php
            
            if(isset($_POST['update'])) {

                // Update Dados Cadastrais

                if( isset($_POST['name']) ){
                    $contato->setName($_POST['name']);
                    $lista2->name = $_POST['name'];
                }

                if( isset($_POST['gender']) ){
                    $contato->setGender($_POST['gender']);
                    $lista2->gender = $_POST['gender'];
                }

                if( isset($_POST['birthdate']) ){
                    $dia = substr($_POST['birthdate'],6,4)."-".substr($_POST['birthdate'],3,2)."-".substr($_POST['birthdate'],0,2);
                    $contato->setBirthdate($dia);
                    $lista2->birthdate = substr($_POST['birthdate'],6,4)."-".substr($_POST['birthdate'],3,2)."-".substr($_POST['birthdate'],0,2);
                }

                if( isset($_POST['cpf']) ){
                    $contato->setCpf($_POST['cpf']);
                    $lista2->cpf = $_POST['cpf'];
                }

                if( isset($_POST['rg']) ){
                    $contato->setRg($_POST['rg']);
                    $lista2->rg = $_POST['rg'];
                }
                
                if( isset($_POST['emissor']) ){
                    $contato->setRGEmissor($_POST['emissor']);
                    $lista2->rg_emissor = $_POST['emissor'];
                }

                if( isset($_POST['phone']) ){
                    $contato->setPhone($_POST['phone']);
                    $lista2->phone = $_POST['phone'];
                }

                if( isset($_POST['mobile']) ){
                    $contato->setMobile($_POST['mobile']);
                    $lista2->mobile = $_POST['mobile'];
                }

                if( isset($_POST['email']) ){
                    $contato->setEmail($_POST['email']);
                    $lista2->email = $_POST['email'];
                }

                // Update Endereço

                if( isset($_POST['inPostalCode']) ){
                    $endereco->setPostalCode($_POST['inPostalCode']);
                    $lista3->postal_code = $_POST['inPostalCode'];
                }

                if( isset($_POST['inAddress']) ){
                    $endereco->setName($_POST['inAddress']);
                    $lista3->name = $_POST['inAddress'];
                }

                if( isset($_POST['inNeighborhood']) ){
                    $endereco->setNeighborhood($_POST['inNeighborhood']);
                    $lista3->neighborhood = $_POST['inNeighborhood'];
                }

                if( isset($_POST['inNumber']) ){
                    $contato->setAddressNumber($_POST['inNumber']);
                    $lista2->address_number = $_POST['inNumber'];
                }

                if( isset($_POST['inComplement']) ){
                    $contato->setAddressComplement($_POST['inComplement']);
                    $lista2->address_complement = $_POST['inComplement'];
                }

                if( isset($_POST['inCity']) ){
                    $endereco->setCity($_POST['inCity']);
                    $lista3->city = $_POST['inCity'];
                }

                if( isset($_POST['inStateCode']) ){
                    $endereco->setState($_POST['inStateCode']);
                    $lista3->state = $_POST['inStateCode'];
                }

                if( isset($_POST['inCountry']) ){
                    $endereco->setCountry($_POST['inCountry']);
                    $lista3->country = $_POST['inCountry'];
                }

                if($contato->cpfCheck($_POST['cpf'])){
                
                    if($contato->update() && $endereco->update()){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "<h6>Cadastro atualizado com sucesso!</h6>";
                        echo '</div>';                            
                    }else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo "<h6>Erro na atualização, por favor tente novamente.</h6>";
                        echo '</div>';                            
                    }

                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo "<h6>CPF inválido! Por favor preencha com um número válido.</h6>";
                    echo '</div>';
                }

                $number_focus = 0;

                unset($_POST['update']);
                
            }

            if( isset($_POST['searchCEP']) ){

                $lista = $endereco->searchPostalCode($_POST['inCEP']);
                $lista3 = (object) $lista[0];
                $id = 1;
                $number_focus = 1;

                unset($_POST['inCEP']);
                unset($_POST['searchCEP']);
            }

        ?>

            <form class="form-signin"  method="post" action="">
                <h4 class="text-center">ENDEREÇO</h4><br>
                <div class="row" id="div_view">
                    <div class=" form-group col-sm-4">
                        <div class="input-group mb-2">
                            <label class="form-control-label col-form-label col-12 pl-0 ">CEP</label>
                            <input name="inPostalCode" type="text" data-mask="99999-999" class="custom-select custom-select-sm " placeholder="" data-msg="Número do CEP" aria-label="Default" aria-describedby="basic-addon2"  value="<?php if($id > 0) echo $lista3->postal_code; ?>" required readonly>
                            <div class="input-group-append">
                                <!--<button class="btn btn-sm btn-success" name="buscarCEP" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para encontrar um logradouro usando seu CEP"><i class="fa fa-search" aria-hidden="true"></i></button>-->
                                <span title="Pesquisar CEP para encontrar um logradouro" data-toggle="tooltip" data-placement="top"><button type="button" class="btn btn-sm btn-info " aria-hidden="true" data-toggle="modal" data-target="#cepModal" ><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</button></span>
                            </div>
                        </div>
                    </div>

                    <div class=" form-group col-sm-8">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Endereço</label>
                        <input name="inAddress" type="text" placeholder="" data-msg="Nome do logradouro" class="form-control form-control-sm " aria-label="Default" style="text-transform:uppercase" value="<?php if($id > 0) echo $lista3->name; ?>" required >
                    </div>

                    <div class=" form-group col-sm-6 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Bairro</label>
                        <input name="inNeighborhood" type="text" placeholder="" data-msg="Bairro" class="form-control form-control-sm " aria-label="Default" style="text-transform:uppercase" value="<?php if($id > 0) echo $lista3->neighborhood;?>" required >
                    </div>

                    <div class=" form-group col-sm-2 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Número</label>
                        <input name="inNumber" type="text" placeholder="" data-msg="Número" class="form-control form-control-sm " aria-label="Default" value="<?php if($id > 0) echo $lista2->address_number; ?>" <?php if($number_focus == 1) echo ' autofocus ';?> required>
                    </div>

                    <div class=" form-group col-sm-4 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Complemento</label>
                        <input name="inComplement" type="text" placeholder="Complemento (EX. APTO 71)" class="form-control form-control-sm " aria-label="Default" style="text-transform:uppercase" value="<?php if($id > 0) echo $lista2->address_complement; ?>">
                    </div>

                    <div class=" form-group col-sm-8 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Cidade</label>
                        <input name="inCity" type="text" placeholder="" data-msg="Informe a Cidade" class="form-control form-control-sm " aria-label="Default" style="text-transform:uppercase" value="<?php if($id > 0) echo $lista3->city;?>" required >
                    </div>

                    <div class=" form-group col-sm-4 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">Estado</label>
                        <select name="inStateCode" class="form-control form-control-sm " data-msg="Escolha o Estado" aria-label="Default" required >
                            <option value=''></option>
                            <option value='AL' <?php if($id > 0) if($lista3->state == 'AL') echo 'selected'; ?> >ALAGOAS</option>
                            <option value='AM' <?php if($id > 0) if($lista3->state == 'AM') echo 'selected'; ?> >AMAZONAS</option>
                            <option value='AP' <?php if($id > 0) if($lista3->state == 'AP') echo 'selected'; ?> >AMAPÁ</option>
                            <option value='AC' <?php if($id > 0) if($lista3->state == 'AC') echo 'selected'; ?> >ACRE</option>
                            <option value='BA' <?php if($id > 0) if($lista3->state == 'BA') echo 'selected'; ?> >BAHIA</option>
                            <option value='CE' <?php if($id > 0) if($lista3->state == 'CE') echo 'selected'; ?> >CEARÁ</option>
                            <option value='DF' <?php if($id > 0) if($lista3->state == 'DF') echo 'selected'; ?> >DISTRITO FEDERAL</option>
                            <option value='ES' <?php if($id > 0) if($lista3->state == 'ES') echo 'selected'; ?> >ESPÍRITO SANTO</option>
                            <option value='GO' <?php if($id > 0) if($lista3->state == 'GO') echo 'selected'; ?> >GOIÁS</option>
                            <option value='MA' <?php if($id > 0) if($lista3->state == 'MA') echo 'selected'; ?> >MARANHÃO</option>
                            <option value='MG' <?php if($id > 0) if($lista3->state == 'MG') echo 'selected'; ?> >MINAS GERAIS</option>
                            <option value='MS' <?php if($id > 0) if($lista3->state == 'MS') echo 'selected'; ?> >MATO GROSSO DO SUL</option>
                            <option value='MT' <?php if($id > 0) if($lista3->state == 'MT') echo 'selected'; ?> >MATO GROSSO</option>
                            <option value='PA' <?php if($id > 0) if($lista3->state == 'PA') echo 'selected'; ?> >PARÁ</option>
                            <option value='PB' <?php if($id > 0) if($lista3->state == 'PB') echo 'selected'; ?> >PARAIBA</option>
                            <option value='PE' <?php if($id > 0) if($lista3->state == 'PE') echo 'selected'; ?> >PERNAMBUCO</option>
                            <option value='PI' <?php if($id > 0) if($lista3->state == 'PI') echo 'selected'; ?> >PIAUÍ</option>
                            <option value='PR' <?php if($id > 0) if($lista3->state == 'PR') echo 'selected'; ?> >PARANÁ</option>
                            <option value='RJ' <?php if($id > 0) if($lista3->state == 'RJ') echo 'selected'; ?> >RIO DE JANEIRO</option>
                            <option value='RN' <?php if($id > 0) if($lista3->state == 'RN') echo 'selected'; ?> >RIO GRANDE DO NORTE</option>
                            <option value='RO' <?php if($id > 0) if($lista3->state == 'RO') echo 'selected'; ?> >RONDÔNIA</option>
                            <option value='RR' <?php if($id > 0) if($lista3->state == 'RR') echo 'selected'; ?> >RORAIMA</option>
                            <option value='RS' <?php if($id > 0) if($lista3->state == 'RS') echo 'selected'; ?> >RIO GRANDE DO SUL</option>
                            <option value='SC' <?php if($id > 0) if($lista3->state == 'SC') echo 'selected'; ?> >SANTA CATARINA</option>
                            <option value='SE' <?php if($id > 0) if($lista3->state == 'SE') echo 'selected'; ?> >SERGIPE</option>
                            <option value='SP' <?php if($id > 0) if($lista3->state == 'SP') echo 'selected'; ?> >SÃO PAULO</option>
                            <option value='TO' <?php if($id > 0) if($lista3->state == 'TO') echo 'selected'; ?> >TOCANTINS</option>
                            <option value='NA' <?php if($id > 0) if($lista3->state == 'NA') echo 'selected'; ?> >OUTRO</option>
                        </select>
                    </div>

                    <div class=" form-group col-sm-4 ">
                        <label class="form-control-label col-form-label col-12 pl-0 ">País</label>
                        <input name="inCountry" type="text" placeholder="" data-msg="Informe o País" class="form-control form-control-sm " aria-label="Default" style="text-transform:uppercase" value="<?php if($id > 0) echo $lista3->country;?>" required >
                    </div>
                </div>

                <div class="my-3">
                    <div class="text-center">
                        <h4>DADOS CADASTRAIS</h4><br>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 ">
                            
                            <div class="row">

                                <div class="form-group col-sm-2">
                                    <label class="col-form-label" for="inputDefault">ID</label>
                                    <input required type="text" name="id" class="form-control" placeholder="" id="inputDefault" value="<?php echo $lista2->id; ?>" disabled>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label class="col-form-label" for="inputDefault2">Nome Completo</label>
                                    <input required type="text" name="name" class="form-control" placeholder="Nome do completo" id="inputDefault2" value="<?php echo $lista2->name; ?>">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="exampleSelect2">Sexo</label>
                                    <select name="gender" class="form-control" id="exampleSelect2" required>
                                    <option value ="">Escolha ...</option>
                                    <option value='F' <?php if($lista2->gender == 'F'){ echo 'selected';} ?> >Feminino</option>
                                    <option value='M'<?php if($lista2->gender == 'M'){ echo 'selected';} ?> >Masculino</option>

                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="selectDisciplina">Data de Nascimento</label><br>
                                    <div class="input-group" >
                                        <input required name="birthdate" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" id="pickyDate2" value="<?php echo substr($lista2->birthdate, 8,2).'/'.substr($lista2->birthdate, 5,2).'/'.substr($lista2->birthdate, 0,4); 
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="inputDefault6">CPF</label>
                                    <input required type="text" name="cpf" id="cpf" data-mask="999.999.999-99" class="cpf form-control" placeholder="" value="<?php echo $lista2->cpf;?>">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="inputDefault4">RG</label>
                                    <input required type="text" name="rg" class="form-control" placeholder="" id="inputDefault4" value="<?php echo $lista2->rg; ?>">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="inputDefault5">Emissor do RG</label>
                                    <input required type="text" name="emissor" class="form-control" placeholder="" id="inputDefault5" value="<?php echo $lista2->rg_emissor; ?>">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="inputDefault8">Telefone</label>
                                    <input type="text" name="phone" id="celphones" data-mask="(99) 9999-9999" class="celphones form-control" placeholder="" id="inputDefault8" value="<?php echo $lista2->phone; ?>">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="inputDefault7">Celular</label>
                                    <input required type="text" data-mask="(99) 9 9999-9999" name="mobile" id="celphones" class="celphones form-control" placeholder="" id="inputDefault7" value="<?php echo $lista2->mobile; ?>">
                                </div>

                                <div class="form-group col-sm-8">
                                    <label class="col-form-label" for="inputDefault3">E-mail</label>
                                    <input required type="email" name="email" class="form-control" placeholder="" id="inputDefault3" value="<?php echo $lista2->email; ?>">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                
                <div class="text-center">
                    <button class="btn btn-success ml-3 md-3 " name="update" type="submit"><i class="fas fa-check"></i> Salvar</button>
                </div>
        
        
            </form>
        </div>
    </div>
</div> <!-- /container -->

 <!-- Modal Adicionar Faixa -->
 <div  class="modal fade text-left" id="cepModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document" >
      <div class="modal-content">

         <form class="form form-validate"  method="post" action="#div_view">

            <div class="modal-header">
               <h4 class="modal-title">Pesquisar Endereço</h4>
               <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
               <div class="row">

                   <div class=" form-group col-sm-8 offset-sm-2">
                        <div class="input-group mb-2">
                            <label class="form-control-label col-12 pl-0 ">CEP</label>
                            <input name="inCEP" type="text" data-mask="99999-999" class="custom-select custom-select-sm " placeholder="" data-msg="Número do CEP" aria-label="Default" aria-describedby="basic-addon2"  value="" required>
                        </div>
                    </div>

               </div>
            </div>

            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
               <button name="searchCEP" type="submit" class="btn btn-primary ml-3 md-3" value="pesquisar" ><i class="fa fa-check" aria-hidden="true"></i> Pesquisar</button>
            </div>

         </form>
      </div>
   </div>
</div>