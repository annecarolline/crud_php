<?php
require_once "../../mysql/define.php";

require_once "../menu/header.php";
require_once "../../mysql/funcoes_novo.php";
?>
<style type="text/css">
  
/*@media (min-width: 576px)*/
.modal-dialog {
    max-width: 75% !important;
    margin: 1.75rem auto;
}

</style>


<div class="content-wrapper text-sm" style="background:   #FFFFFF">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row align-items-center  justify-content-between mb-2">
        <div class="col-12 col-lg-4 col-xl-4 text-center text-lg-left text-xl-left mt-3">
          <h1>Cadastro de Reservas </h1>
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

            <table id="datatable" class="table table-hover responsive table-lg px-3 font-small-custom">
            </table>
        </div>
      </div>

      <!-- aba formulario -->
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
        <div class="row">

            <div   class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form method="POST" id="form">
                      <input type="hidden" name="id" value="0" id="id" />
                      <input type="hidden" name="acao" value="inserir" id="acao"/>

                          <div class="row align-items-end">
                            <div class="col-12 col-lg-6 col-xl-12  mb-3  ">
                              <label class="float-label">Nome do Passageiro</label>
                               <input type="text" placeholder="Nome"  class="form-control clear" name="nome_passageiro"  id="editnome_passageiro"  />
                            </div> 

                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">Telefone</label>
                               <input type="text" placeholder="Telefone"  class="form-control TELCEL clear" name="telefone"  id="edittelefone"  />
                            </div> 

                            <div class="col-12 col-lg-6 col-xl-6  mb-3  ">
                              <label class="float-label">E-mail</label>
                               <input type="email" placeholder="E-mail"  class="form-control clear" name="email"  id="editemail"  />
                            </div> 

                            <div class="col-12 col-lg-4 col-xl-4  mb-3  ">
                              <label>Tipo de venda</label>
                              <select name="id_tipovenda" required placeholder="Tipo de venda" id="edittipovenda" class="form-control select2 clear">
                              </select>
                            </div> 

                            <div class="col-12 col-lg-4 col-xl-4  mb-3  ">
                              <label>Operador</label>
                              <select name="id_operador" required placeholder="Operador" id="editoperador" class="form-control select2 clear">
                              </select>
                            </div> 

                            <div class="col-12 col-lg-4 col-xl-4  mb-3  ">
                              <label>Origem</label>
                              <select name="id_origem" required placeholder="Origem" id="editorigem" class="form-control select2 clear">
                              </select>
                            </div> 
                            
                            <div class="col-12 col-lg-3 col-xl-3  mb-3  ">
                              <label class="float-label">Quantidade Pessoas</label>
                              <input type="number" placeholder="Quantidade Pessoas"  class="form-control clear" name="qtde_pessoas"  id="editqtde_pessoas"  />
                              </div> 

                            <div class="col-12 col-lg-3 col-xl-3  mb-3  ">
                              <label class="float-label">Quantidade ADT</label>
                              <input type="number" placeholder="Quantidade ADT"  class="form-control clear" name="qtde_adt"  id="editqtde_adt"  />
                              </div> 

                            <div class="col-12 col-lg-3 col-xl-3 mb-3  ">
                              <label class="float-label">Quantidade CHD</label>
                              <input type="number" placeholder="Quantidade CHD"  class="form-control clear" name="qtde_chd"  id="editqtde_chd"  />
                              </div> 

                            <div class="col-12 col-lg-3 col-xl-3 mb-3  ">
                              <label class="float-label">Quantidade Free</label>
                              <input type="number" placeholder="Quantidade Free"  class="form-control clear" name="qtde_free"  id="editqtde_free"  />
                              </div>  
                            
                            <!--div class="col-12 col-lg-6 col-xl-3  mb-3  ">
                              <label class="float-label">Valor Total</label>
                               <input type="text" placeholder="Valor Total"  class="form-control clear money" name="valor_total"  id="editvalor_total"  />
                            </div-->

                            <div class="col-12 col-lg-6 col-xl-12  mb-3  ">
                              <label class="float-label">Observação</label>
                               <input type="text" placeholder="Observação"  class="form-control clear" name="observacao"  id="editobservacao"  />
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
<script type="text/javascript" src="cadreserva.js"></script>

<div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Serviços da Reserva <span id="num_reserva"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" id="formServico">
        <input type="hidden" name="idServico" value="0" id="idServico" />
        <input type="hidden" name="id_reserva" value="0" id="id_reserva" />
        <input type="hidden" name="acaoServico" value="inserir" id="acaoServico"/>

        <div class="modal-body">

            <div class="col-md-12">
              <div class="row">

                <div class="col-12 col-lg-4 col-xl-3  mb-3  ">
                  <label>Tipo</label>
                  <select name="tipo" placeholder="Tipo" id="edittipo" class="form-control select2 clear">
                    <option value=""> - </option>
                    <option value="A">Aeroporto</option>
                    <option value="H">Hotel</option>
                  </select>
                </div> 

                <div class="col-12 col-lg-4 col-xl-3  mb-3  ">
                  <label>Tipo de Serviço</label>
                  <select name="id_tiposervico" required placeholder="Tipo de Serviço" id="edittiposervico" class="form-control select2 clear">
                  </select>
                </div> 

                <div class="col-12 col-lg-3 col-xl-3  mb-3  ">
                    <label class="float-label">Data do Serviço</label>
                   <input type="date" placeholder="Data do Serviço"  class="form-control clear" name="dt_servico"  id="editdt_servico"  />
                  </div> 

                <div class="col-12 col-lg-3 col-xl-3  mb-3  ">
                    <label class="float-label">Hora do Serviço</label>
                   <input type="time" placeholder="Hora do Serviço"  class="form-control clear" name="hr_servico"  id="edithr_servico"  />
                </div> 

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label>Aeroporto</label>
                  <select name="id_aeroporto" placeholder="Aeroporto" id="editaeroporto" class="form-control select2 clear">
                  </select>
                </div>

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label class="float-label">Observação do Vôo</label>
                  <input type="text" placeholder="Observação do Vôo"  class="form-control clear" name="observacao_voo"  id="editobservacao_voo"  />
                </div>   

                <div class="col-12 col-lg-4 col-xl-4  mb-3  ">
                  <label class="float-label">Número do Vôo</label>
                  <input type="text" placeholder="Número do Vôo"  class="form-control clear" name="nro_voo"  id="editnro_voo"  />
                </div>

                <div class="col-12 col-lg-3 col-xl-4  mb-3  ">
                    <label class="float-label">Data do Vôo</label>
                   <input type="date" placeholder="Data do Vôo"  class="form-control clear" name="dt_voo"  id="editdt_voo"  />
                  </div> 

                <div class="col-12 col-lg-3 col-xl-4  mb-3  ">
                    <label class="float-label">Hora do Vôo</label>
                   <input type="time" placeholder="Hora do Vôo"  class="form-control clear" name="hr_voo"  id="edithr_voo"  />
                </div> 

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label>Hotel</label>
                  <select name="id_hotel" placeholder="Hotel" id="edithotel" class="form-control select2 clear">
                  </select>
                </div> 

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label class="float-label">Observação do Hotel</label>
                  <input type="text" placeholder="Observação do Hotel"  class="form-control clear" name="observacao_hotel"  id="editobservacao_hotel"  />
                </div>

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label class="float-label">Valor serviço</label>
                  <input type="text" placeholder="Valor serviço"  class="form-control clear money" name="valor_servico"  id="editvalor_servico"  />
                </div>  

                <div class="col-12 col-lg-4 col-xl-6  mb-3  ">
                  <label class="float-label">Valor adicional</label>
                  <input type="text" placeholder="Valor adicional"  class="form-control clear money" name="valor_adicional"  id="editvalor_adicional"  />
                </div>
            
              </div>
            </div>

            <!-- aba do datatable-->
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="datatableServico" class="table table-striped table-hover responsive table-lg px-3 font-small-custom"></table>
                </div>
              </div>
            </div>
        </div> <!-- modal body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="backServico()" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" onclick="salvarServico()">Salvar</button>
        </div>

    </form>
  </div>
</div>
</div>

</body>