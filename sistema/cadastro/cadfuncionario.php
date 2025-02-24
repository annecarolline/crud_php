<?php
require_once "../../mysql/define.php";

require_once "../menu/header.php";
require_once "../../mysql/funcoes_novo.php";
?>
<div class="content-wrapper text-sm" style="background:   #FFFFFF">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row align-items-center  justify-content-between mb-2">
        <div class="col-12 col-lg-4 col-xl-4 text-center text-lg-left text-xl-left mt-3">
          <h1>Cadastro de Funcionário </h1>
        </div>
        <div class="col-12 col-lg-3 col-xl-3 text-right ml-auto">
            <div class="btn-group dropleft   mt-3">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Exportar
                </button>
                <div class="dropdown-menu">
                    <div class="d-flex">
                        <div id="btnAcoes" class="d-flex justify-content-center text-center"></div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6 mt-3 d-flex justify-content-center justify-content-lg-end justify-content-xl-end"  style="display: none !important;">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active px-3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="limpar()">Tabela</a>
              <a class="nav-item nav-link px-3" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Novo</a>
              
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Main content -->
<div class="content" style="background: #FFFFFF">
  <div class="container">
     
    
    <div class="tab-content" id="nav-tabContent">

      <!-- aba do datatable-->
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card shadow py-2">

              <div class="row mt-2 px-3 mb-3">
                  <div class="col-12 col-lg-3 col-xl-3">
                    <div class="input-group">
                      <input type="search" id="filtro" class="form-control " name="filtro" placeholder="Pesquisar">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-3 col-xl-3 ml-auto text-right">
                      <div class="btn px-4  btn-alt-color" onclick="calTab()">Novo</div>
                  </div>
              </div>

            <table id="datatable" class="table table-hover responsive table-lg px-3 font-small-custom"></table>
        </div>
      </div>

      <!-- aba formulario -->
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
        <div class="row">

            <div   class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form method="POST" id="form">
                          <div class="row align-items-end">

                                <input type="hidden" name="id" value="0" id="id" />
                                <input type="hidden" name="acao" value="inserir" id="acao"/>
                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Nome</label>
                               <input type="text" placeholder="Nome"  class="form-control clear" name="nome"  id="editnome"  />
                            </div> 
                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Data de Nascimento</label>
                               <input type="date" placeholder="Data de Nascimento"  class="form-control clear" name="dtnascimento"  id="editdtnascimento"  />
                            </div>
                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Salário</label>
                               <input type="text" placeholder="Salário"  class="form-control clear" name="salario"  id="editsalario"  />
                            </div>
                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Usuário</label>
                               <input type="text" placeholder="Usuário"  class="form-control clear" name="usuario"  id="editusuario"  />
                            </div>
                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Senha</label>
                               <input type="password" placeholder="Senha"  class="form-control clear" name="senha"  id="editsenha"  />
                            </div> 
                            <div class="col-12 col-lg-3 col-xl-3  mb-3 ml-auto ">
                                <div class="custom-control custom-switch text-right mb-2">
                                    <input type="checkbox" class="custom-control-input" checked name="ativo" id="editativo" value="S"  />
                                    <label class="custom-control-label" for="editativo">Ativo</label>
                                </div>
                            </div>  
                          </div>
                    </form>
                  </div>
                  <div class="card-footer border-top mt-2">
                        <div class="d-flex justify-content-between">
                            
                          <div class="btn btn-default" data-dismiss="modal" onclick="back()">Voltar</div>
                          <button class="btn btn-alt-color crud align-right mr-2 text-cl-white" onclick="salvar()"><i class="fa fa-save mr-1"></i> Salvar</button>
                            
                        </div>
                  </div>
                </div>
            </div>

           

        </div>


      </div>
    </div>

  </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php require_once "../menu/footer.php"; ?>
<script type="text/javascript" src="cadfuncionario.js"></script>

</body>