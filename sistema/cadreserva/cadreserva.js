$(document).ready(function () {

        table = $("#datatable").DataTable({
            "responsive": true,
            "searching": true,
            "lengthChange": false,
            "orderable": false,
            "pageLength": 50,
            "search": {regex: true},
            "autoWidth": false,
            "buttons": true,
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: -1 },
                { targets: 2, render: (data, type, row) => moment(data).format('D/MM/YYYY')},
            ],
            language: {
                "paginate": {
                    "previous": "<i class='fas fa-long-arrow-alt-left'></i>",
                    "next": "<i class='fas fa-long-arrow-alt-right'></i>"
                },
                "emptyTable": "Sem dados disponíveis na tabela."
            },
            ajax: {
                url: "cadreserva_acoes.php",
                type: "POST",
                dataType: "json",
                async: false,
                data: {
                    "acao": "listar",
                }
            },
            columns: [
                { title: "Número", data: "id_reserva", width: "5%",
                    createdCell: function (td, cellData, rowData, row, col) {
                        var nro = "RSV0"+rowData.id_reserva;
                               
                        $(td).html(nro);
                    },
                },
                { title: "Nome Passageiro", data: "nome_passageiro", width: "10%" },
                { title: "Data", data: "dt_lancamento", width: "10%" },
                { title: "Hora", data: "hr_lancamento", width: "10%" },
                { title: "Qtde Pessoas", data: "qtde_pessoas", width: "10%" },
                { title: "Tipo Venda", data: "descricao", width: "10%" },
                { title: "Valor Total", data: "valor_total", width: "10%" },
                /*{ title: "Data", data: "dt_lancamento", width: "10%",
                    createdCell: function (td, cellData, rowData, row, col) {
                        //let res = rowData.ativo == "S" ? "<span class='badge bg-success'>SIM</span>" : "<span class='badge bg-danger'>NÃO</span>";
                               
                        //$(td).html(res);
                    },
                },*/
                {
                    title: "Ações",
                    targets: -1,
                    data: null,
                    width: "5%",
                    createdCell: function (td, cellData, rowData, row, col) {
                        html = ` 
                <div class="dropdown dropleft">
                    <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <div class="dropdown-menu cursor" aria-labelledby="dropdownMenuButton">

                    
                        <a class="dropdown-item" onclick="clique('${rowData.id_reserva}')">
                            <i class="fas fa-edit text-success"></i> Editar 
                        </a>
                        <a class="dropdown-item"  onclick="excluir('${rowData.id_reserva}')" > 
                            <i class="fas fa-trash-alt text-danger mr-1"></i> Excluir
                        </a>
                        <a class="dropdown-item" onclick="abrirModal('${rowData.id_reserva}')" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">
                            <i class="fas fa-ok text-warning"></i> Adicionar Serviço 
                        </a>
                    </div>
                </div>`;
                    $(td).html(html);
                    }

                }
            ],
            "dom": "Bfrtip",
            buttons: [
            
                {
                    extend: "pdf",
                    text: "<i class='fas fa-file-pdf text-danger'></i> PDF",
                    name: "pdf",
                    footer: true,
                    orientation: "landscape",
                    //exportOptions: {
                    //    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                   // },
                },
                {
                    extend: "excel",
                    text: "<i class='fas fa-file-excel text-success'></i> Excel",
                    name: "excel",
                    footer: true,
                    //exportOptions: {
                    //    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                   // },
                }
            ],
        });

        $("#filtro").keyup(function () {
            let vall = $(this).val();
            let arr = vall.indexOf(";") != -1 ? vall.split(";") : [vall];
            let string_final = "";
            arr.forEach(item=>{

                let str = item+"|";
                string_final = string_final+str;
            });
            string_final = string_final.slice(0, -1);
            
            table.search(string_final, true, false ).draw();
        }).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        table.buttons("print:name").container().appendTo($("#btnAcoes"));
        $(".buttons-pdf").toggleClass(" btn-sm btn-default");
        $(".buttons-excel").toggleClass(" btn-sm btn-default");
        $(".flex-wrap").toggleClass("dt-buttons");

        $(".select2").select2({
            placeholder: "Escolha uma opção",
            allowClear: true
        });

    });
 
    function calTab(){
        $("#nav-profile-tab").click();
        carregarOrigem();
        carregarTipoVenda();
        carregarOperador();
    }

    function back(){
        limpar();
        $("#nav-home-tab").click();
    }

    function backServico(){
        limparItem();
    }

    function abrirModal(id){
        limparItem();
        
        $("#id_reserva").val(id);

        carregarTipoServico();
        carregarAeroporto();
        carregarHotel();

        gerarDatatableServico(id);

        $("#num_reserva").html(" RSV0"+id);

        $('#myModal').on('shown.bs.modal', function () {
          
        });
    }

    function gerarDatatableServico(id_reserva) {

        tableServico = $("#datatableServico").DataTable({
            "destroy": true,
            "responsive": true,
            "searching": true,
            "lengthChange": false,
            "orderable": false,
            "pageLength": 50,
            "autoWidth": false,
            "buttons": true,
            "search": {regex: true},
            columnDefs: [
                { responsivePriority: 2, targets: -1 },
                { targets: 1, render: (data, type, row) => moment(data).format('D/MM/YYYY')},
            ],
            language: {
                "paginate": {
                "previous": "<i class='fas fa-long-arrow-alt-left'></i>",
                "next": "<i class='fas fa-long-arrow-alt-right'></i>"
                },
                "emptyTable": "Sem dados disponíveis na tabela."
            },
            ajax: {
                url: "../cadreserva/cadreserva_acoes.php",
                type: "POST",
                dataType: "json",
                async: false,
                data: {
                    "acaoServico": "listar",
                    "id_reserva" : id_reserva
                }
            },
            columns: [
               // { title: "Requisição", data: "idrequisicao", width: "10%" },
                { title: "Tipo", data: "tipo", width: "10%" ,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var tp = "";

                        if (rowData.tipo == "H"){
                            tp = "Hotel";
                        } 
                        else if (rowData.tipo == "A"){
                            tp = "Aeroporto";
                        }
                               
                        $(td).html(tp);
                    },
                },
                { title: "Data", data: "dt_servico", width: "10%" }, 
                { title: "Hora", data: "hr_servico", width: "10%" },
                { title: "Valor ", data: "valor_servico", width: "10%" },
                { title: "Adicional ", data: "valor_adicional", width: "10%" },
                {
                    title: "Ações",
                    targets: -1,
                    data: null,
                    width: "5%",
                    createdCell: function (td, cellData, rowData, row, col) {
                        html = ` 
                <div class="dropdown dropleft">
                <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </div>
                <div class="dropdown-menu cursor" aria-labelledby="dropdownMenuButton">

                
                    <a class="dropdown-item" onclick="cliqueServico('${rowData.id_servico}')">
                        <i class="fas fa-edit text-success"></i> Editar 
                    </a>
                    <a class="dropdown-item"  onclick="excluirServico('${rowData.id_servico}')" > <i class="fas fa-trash-alt text-danger mr-1"></i> Excluir</a>
                    </div>`;
                    $(td).html(html);
                    }

                }
            ],
            "dom": "Bfrtip",
            buttons: [
            
                {
                    extend: "pdf",
                    text: "<i class='fas fa-file-pdf text-danger'></i> PDF",
                    name: "pdf",
                    footer: true,
                    orientation: "landscape",
                    //exportOptions: {
                    //    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                   // },
                },
                {
                    extend: "excel",
                    text: "<i class='fas fa-file-excel text-success'></i> Excel",
                    name: "excel",
                    footer: true,
                    //exportOptions: {
                    //    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                   // },
                }
            ],
        });
    

        $("#filtro").keyup(function () {
            let vall = $(this).val();
            let arr = vall.indexOf(";") != -1 ? vall.split(";") : [vall];
            let string_final = "";
            arr.forEach(item=>{

                let str = item+"|";
                string_final = string_final+str;
            });
            string_final = string_final.slice(0, -1);
            
            tableServico.search(string_final, true, false ).draw();
        }).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        tableServico.buttons("print:name").container().appendTo($("#btnAcoes"));
        $(".buttons-pdf").toggleClass(" btn-sm btn-default");
        $(".buttons-excel").toggleClass(" btn-sm btn-default");
        $(".flex-wrap").toggleClass("dt-buttons");

        $(".select2").select2({
            placeholder: "Escolha uma opção",
            allowClear: true
        });
    }

    function cliqueServico(idServico) {

        $.ajax({
            type: "POST",
            url: "../cadreserva/cadreserva_acoes.php",
            dataType: "json",
            data: {
                "idServico": idServico,
                "acaoServico": "editar"
            },
            success: function (data) {
                data = data.data[0];

                //console.log('idServico = '+idServico);
            
                $("#idServico").val(idServico);
                $("#acaoServico").val("update");

                $.ajax({
                    type: "POST",
                    url: "../cadreserva/cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarTipoServico"
                    },
                    success: function (dados) {
                        $("#edittiposervico").empty().append($('<option></option>').attr("value", "").text(" Selecione o item"));
                    
                        $.each(dados, function(idx, vl) {    

                            if ((data["id_tiposervico"]!=="")&&(vl.id_tiposervico == data["id_tiposervico"])){
                                var option = $('<option></option>').attr("value", vl.id_tiposervico).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_tiposervico).text(vl.descricao);
                            }
                          
                          $("#edittiposervico").append(option);
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "../cadreserva/cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarAeroporto"
                    },
                    success: function (dados) {
                        $("#editaeroporto").empty().append($('<option></option>').attr("value", "").text(" Selecione o item"));
                    
                        $.each(dados, function(idx, vl) {    

                            if ((data["id_aeroporto"]!=="")&&(vl.id_aeroporto == data["id_aeroporto"])){
                                var option = $('<option></option>').attr("value", vl.id_aeroporto).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_aeroporto).text(vl.descricao);
                            }
                          
                          $("#editaeroporto").append(option);
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarHotel"
                    },
                    success: function (data) {

                        $("#edithotel").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
                    
                        $.each(data, function(idx, vl) {    
                            if ((data["id_hotel"]!=="")&&(vl.id_hotel == data["id_hotel"])){
                                var option = $('<option></option>').attr("value", vl.id_hotel).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_hotel).text(vl.descricao);
                            }

                            $("#edithotel").append(option);
                        });
                    }
                });

                //$("edittipo").val(data["tipo"]);
                $("#edittipo option").each(function( index ) {
                    console.log( index + ": " + $( this ).val() + " = " +$(this).text() );
                    if ($(this).val() == data["tipo"]){
                        $(this).attr("selected","selected");
                    }
                });

                $("#editdt_servico").val(data["dt_servico"]);
                $("#edithr_servico").val(data["hr_servico"]);
                $("#editnro_voo").val(data["nro_voo"]);
                $("#editdt_voo").val(data["dt_voo"]);
                $("#edithr_voo").val(data["hr_voo"]);
                $("#editobservacao_voo").val(data["observacao_voo"]);
                $("#editobservacao_hotel").val(data["observacao_hotel"]);
                $("#editvalor_servico").val(data["valor_servico"]);
                $("#editvalor_adicional").val(data["valor_adicional"]);
            }
        });
    }

    function salvarServico() {

        let campos = $("#formServico").serialize();let arr = [];

            document.querySelectorAll("#formServico input[required], #formServico select[required]").forEach(item => {

                if(item.value != null && item.value != ""){
                    arr.push(item.value);
                }
            });
            
            if(arr.length == 1){
                
                    $.ajax({
                    type: "POST",
                    url: "../cadreserva/cadreserva_acoes.php",
                    dataType: "html",
                    data: campos,
                    success: function (data) {

                        data = JSON.parse(data);

                        if(data.error == ""){
                            Swal.fire({
                                title: "Salvo com Sucesso!",
                                icon: "success",
                                timer: 1400,
                                buttonsStyling: false,
                                showConfirmButton: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-success"
                                }
                            })

                            tableServico.ajax.reload();
                            $("#nav-home-tab").click();
                            $("#nav-profile-tab").text("Novo");

                        }else{

                            Swal.fire({
                                title: "Falha ao Salvar!",
                                icon: "error",
                                timer: 1400,
                                buttonsStyling: false,
                                showConfirmButton: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-danger"
                                }
                            })

                        }

                    }
                }); 
            }else{
                Swal.fire({
                    title: "Campo(s) Obrigatório(s) Não Preenchido(s)!",
                    icon: "error",
                    timer: 1400,
                    buttonsStyling: false,
                    showConfirmButton: false,
                    customClass: {
                        confirmButton: "btn text-cl-white bg-danger"
                    }
                })
            } };

    function excluirServico(idServico) {

        Swal.fire({
            title: "Tem certeza que deseja excluir?",
            text: "Esse item será excluído permanentemente!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#c90606",
            cancelButtonColor: "#b5b3b3",
            confirmButtonText: "Sim, Excluir!",
            cancelButtonText: "Não!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "../cadreserva/cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "idServico": idServico,
                        "acaoServico": "excluir"
                    },
                    success: function (data) {
                        
                        if(data.error == ""){

                            Swal.fire({
                                title: "Excluído com Sucesso!",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 1400,
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-success"
                                }
                            });
                            tableServico.ajax.reload();

                        }else{

                            Swal.fire({
                                title: "Falha ao Excluir!",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 1400,
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-success"
                                }
                            });

                        }
                    }
                })
            

            } else if (result.dismiss == "cancel") {
                console.log("cancel");
            }

        });
    }


    function clique(id) {

        $("#nav-profile-tab").text("Edição").click();

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "id": id,
                "acao": "editar"
            },
            success: function (data) {
                data = data.data[0];
            

                $("#id").val(id);
                $("#acao").val("update");
                
                $("#editnome_passageiro").val(data["nome_passageiro"]);
                $("#edittelefone").val(data["telefone"]);
                $("#editemail").val(data["email"]);
                $("#editobservacao").val(data["observacao"]);

                $("#editqtde_pessoas").val(data["qtde_pessoas"]);
                $("#editqtde_adt").val(data["qtde_adt"]);
                $("#editqtde_chd").val(data["qtde_chd"]);
                $("#editqtde_free").val(data["qtde_free"]);

                $.ajax({
                    type: "POST",
                    url: "cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarOperador"
                    },
                    success: function (dados) {
                        $("#editoperador").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
                    
                        $.each(dados, function(idx, vl) {    

                            if ((data["id_operador"]!=="")&&(vl.id_operador == data["id_operador"])){
                                var option = $('<option></option>').attr("value", vl.id_operador).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_operador).text(vl.descricao);
                            }
                          
                          $("#editoperador").append(option);
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarTipoVenda"
                    },
                    success: function (dados) {
                        $("#edittipovenda").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
                    
                        $.each(dados, function(idx, vl) {    

                            if ((data["id_tipovenda"]!=="")&&(vl.id_tipovenda == data["id_tipovenda"])){
                                var option = $('<option></option>').attr("value", vl.id_tipovenda).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_tipovenda).text(vl.descricao);
                            }
                          
                          $("#edittipovenda").append(option);
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "acao": "listarOrigem"
                    },
                    success: function (dados) {
                        $("#editorigem").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
                    
                        $.each(dados, function(idx, vl) {    

                            if ((data["id_origem"]!=="")&&(vl.id_origem == data["id_origem"])){
                                var option = $('<option></option>').attr("value", vl.id_origem).attr("selected","selected").text(vl.descricao);
                            }
                            else{
                               var option = $('<option></option>').attr("value", vl.id_origem).text(vl.descricao);
                            }
                          
                          $("#editorigem").append(option);
                        });
                    }
                });
                
            }
        });
    }

    function carregarOrigem() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarOrigem"
            },
            success: function (data) {

                $("#editorigem").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_origem).text(vl.descricao);
                  $("#editorigem").append(option);
    
                });
            }
        });
      }

      function carregarOperador() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarOperador"
            },
            success: function (data) {

                $("#editoperador").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_operador).text(vl.descricao);
                  $("#editoperador").append(option);
    
                });
            }
        });
      }

      function carregarTipoVenda() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarTipoVenda"
            },
            success: function (data) {

                $("#edittipovenda").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_tipovenda).text(vl.descricao);
                  $("#edittipovenda").append(option);
    
                });
            }
        });
      }

    function carregarTipoServico() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarTipoServico"
            },
            success: function (data) {

                $("#edittiposervico").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_tiposervico).text(vl.descricao);
                  $("#edittiposervico").append(option);
    
                });
            }
        });
      }

    function carregarAeroporto() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarAeroporto"
            },
            success: function (data) {

                $("#editaeroporto").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_aeroporto).text(vl.descricao);
                  $("#editaeroporto").append(option);
    
                });
            }
        });
      }

    function carregarHotel() {

        $.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "json",
            data: {
                "acao": "listarHotel"
            },
            success: function (data) {

                $("#edithotel").empty().append($('<option></option>').attr("value", "").text(" Selecione "));
            
                $.each(data, function(idx, vl) {    
                  var option = $('<option></option>').attr("value", vl.id_hotel).text(vl.descricao);
                  $("#edithotel").append(option);
    
                });
            }
        });
      }

    function salvar() {

        let campos = $("#form").serialize();$.ajax({
            type: "POST",
            url: "cadreserva_acoes.php",
            dataType: "html",
            data: campos,
            success: function (data) {

                data = JSON.parse(data);

                if(data.error == ""){
                
                
                    Swal.fire({
                        title: "Salvo com Sucesso!",
                        icon: "success",
                        timer: 1400,
                        buttonsStyling: false,
                        showConfirmButton: false,
                        customClass: {
                            confirmButton: "btn text-cl-white bg-success"
                        }
                    })
                    table.ajax.reload();
                    $("#nav-home-tab").click();
                    $("#nav-profile-tab").text("Novo");

                }else{

                    Swal.fire({
                        title: "Falha ao Salvar!",
                        icon: "error",
                        timer: 1400,
                        buttonsStyling: false,
                        showConfirmButton: false,
                        customClass: {
                            confirmButton: "btn text-cl-white bg-danger"
                        }
                    })

                }

            }
        });};

    function excluir(id) {

        Swal.fire({
            title: "Tem certeza que deseja excluir?",
            text: "Esse item será excluído permanentemente!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#c90606",
            cancelButtonColor: "#b5b3b3",
            confirmButtonText: "Sim, Excluir!",
            cancelButtonText: "Não!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "cadreserva_acoes.php",
                    dataType: "json",
                    data: {
                        "id": id,
                        "acao": "excluir"
                    },
                    success: function (data) {
                        
                        if(data.error == ""){

                            Swal.fire({
                                title: "Excluído com Sucesso!",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 1400,
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-success"
                                }
                            });
                            table.ajax.reload();

                        }else{

                            Swal.fire({
                                title: "Falha ao Excluir!",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 1400,
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn text-cl-white bg-success"
                                }
                            });

                        }
                    }
                })
            

            } else if (result.dismiss == "cancel") {
                console.log("cancel");
            }


        });
    }

    function limparItem() {

        $("#formServico").each(function () {
            this.reset();
        });

        $(".clear").val("");
        $("#idServico").val(0);
        $("#acaoServico").val("inserir");

        $(".select2").select2().val(null).trigger("change");
       
    }

    function limpar() {

    $("#form").each(function () {
        this.reset();
    });

    $(".clear").val("");
    $("#id").val(0);
    $("#acao").val("inserir");
    $("#nav-profile-tab").text("Novo");

    $(".select2").select2().val(null).trigger("change");
   
}