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
                { responsivePriority: 2, targets: -1 }
            ],
            language: {
                "paginate": {
                "previous": "<i class='fas fa-long-arrow-alt-left'></i>",
                "next": "<i class='fas fa-long-arrow-alt-right'></i>"
                },
                "emptyTable": "Sem dados disponíveis na tabela"
            },
            ajax: {
                url: "Veiculocategoria_acoes.php",
                type: "POST",
                dataType: "json",
                async: false,
                data: {
                    "acao": "listar",
                }
            },
            columns: [
                { title: "ID", data: "id_categoria", width: "5%" },
                { title: "Descrição", data: "descricao", width: "10%" },
                { title: "Ativo", data: "ativo", width: "10%",
                    createdCell: function (td, cellData, rowData, row, col) {
                        let res = rowData.ativo == "S" ? "<span class='badge bg-success'>SIM</span>" : "<span class='badge bg-danger'>NÃO</span>";
                               
                        $(td).html(res);
                    },
                },
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

                    
                        <a class="dropdown-item" onclick="clique('${rowData.id_categoria}')">
                            <i class="fas fa-edit text-success"></i> Editar 
                        </a>
                        <a class="dropdown-item"  onclick="excluir('${rowData.id_categoria}')" > 
                            <i class="fas fa-trash-alt text-danger mr-1"></i> Deletar
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
    }

    function back(){
        limpar();
        $("#nav-home-tab").click();
    }


    function clique(id) {
    

        $("#nav-profile-tab").text("Edição").click();

        $.ajax({
            type: "POST",
            url: "Veiculocategoria_acoes.php",
            dataType: "json",
            data: {
                "id": id,
                "acao": "editar"
            },
            success: function (data) {
                data = data.data[0];
            

                $("#id").val(id);
                $("#acao").val("update");
                
                $("#editdescricao").val(data["descricao"]);
                data["ativo"] == "S" ? $("#editativo").prop("checked", true) : $("#editativo").prop("checked", false);
            }
        });
    }

    function salvar() {

        let campos = $("#form").serialize();$.ajax({
            type: "POST",
            url: "veiculocategoria_acoes.php",
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
            text: "Esse item será excluido permanentemente!",
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
                    url: "veiculocategoria_acoes.php",
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