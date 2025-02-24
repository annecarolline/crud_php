
    
   $(document).ready(function($) {

    ativar_mascaras();

   


      $("#callMenuMobile").on('click', function() {
        $("#menu-toggle").fadeToggle();
      });


    if ($(".callerCollapse")) {

      document.querySelectorAll(".callerCollapse").forEach(item => {

        item.addEventListener('click', () => {

          let visible = item.getAttribute("aria-expanded");
          let icon = item.querySelector("i.arrow");

          if (visible == 'false') {
            icon.classList.remove("fa-angle-down");
            icon.classList.add("fa-angle-up");
          } else {
            icon.classList.remove("fa-angle-up");
            icon.classList.add("fa-angle-down");
          }

        });

      });
    }


    $(window).resize(function(){
      if($(window).width() > 960){
        if( $("#menu-toggle").attr("style") == 'display: block;'){
          $("#menu-toggle").fadeOut();
        }
      }
    }); 


    // $.ajax({
    //   type: "POST",
    //   url: "funcoes",
    //   data: {
    //     acao: 'Aviso'
    //   },
    //   success: function (response) {
    //     $('#aviso-id').html(response.data['avisos']);
    //     $('#aviso-badge').html(response.data['avisos']);
    //   }
    // });

    $(document).on('select2:open', () => {
      document.querySelector('input.select2-search__field').focus();
    });

    $('.pusher').click(function(e) {
      $('#bodymain').prop('class', 'hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')
    });

    //texto digitado em maiusculo
    /*
    $("input[type='text'], input[type='search']").on('input', function(e) {
      var ss = e.target.selectionStart;
      var se = e.target.selectionEnd;
      e.target.value = e.target.value.toUpperCase();
      e.target.selectionStart = ss;
      e.target.selectionEnd = se;
    });
    */

    $('.money').mask('#.##0,00', {
      reverse: true,
      onKeyPress: function(valor) {
        valor = valor.replaceAll('.', '').replaceAll(',', '.');
        $(this).data('value', valor);
      },
      onChange: function(value, e) {
        e.target.value = value.replace(/(?!^)-/g, '').replace(/^(-[,.])/, '-').replace(/(\d+\.*)\.(\d{2})$/, "$1,$2");
      }
    }).addClass('text-right');
    $('.km').mask('#.##0,000', {
      reverse: true,
      onKeyPress: function(valor) {
        valor = valor.replaceAll('.', '').replaceAll(',', '.');
        $(this).data('value', valor);
      },
      onChange: function(value, e) {
        e.target.value = value.replace(/(?!^)-/g, '').replace(/^(-[,.])/, '-').replace(/(\d+\.*)\.(\d{3})$/, "$1,$3");
      }
    }).addClass('text-right');
    $(".porcent").mask("00,00", {
      reverse: true
    });
    $(".porcent2").mask("0,0000", {
      reverse: true
    });

    $('form').submit(function(e) {
      $(".money").mask("###0.00", {
        reverse: true
      });
      $(".porcent").mask("00.00", {
        reverse: true
      });
      $(".porcent2").mask("0.0000", {
        reverse: true
      });
    });
  });

  //Inibir digitação em campo de datas (apenas escolha)
  $('[type="date"]').on("keydown", function() {
    event.preventDefault();
    return false;
  });




  function converter_para_real(valor) {
    var formatado = new Number(valor).toLocaleString("pt-BR", {
      minimumFractionDigits: 2
    });
    return (valor != null) ? formatado : null;
  }




  function now() {
    let now = new Date();
    now = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toJSON().substring(0, 16);
    return now;
  }


  function alerta(title, descrip, icon = 'success') {
    Swal.fire({
      title: title,
      // success , error , warning ,info
      text: descrip,
      // Custom message flashed from your flask routes
      icon: icon,
      showConfirmButton: true
      // success , error , warning ,info
    });
  }

  function alertatoast(title, icon = 'success') {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: false,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    Toast.fire({
      icon: icon,
      // success , error , warning ,info
      title: title
      // success , error , warning ,info
    });
  }

  function mensagem(msg, descricao, icone = 'success', auto = 'sim') {
    Swal.fire({
      position: 'center',
      icon: icone,
      title: msg,
      text: descricao,
      showConfirmButton: false,
      timer: 1500
    });
  }


  function select2_full(elemento, query, tags = false, minimo = 0) {
    $(elemento + ' > option').remove();
    $(elemento).select2({
      'ajax': {
        url: '../app/CRUD_basico.php',
        type: 'GET',
        data: function(params) {
          //
          params.term = params.term == undefined ? '' : params.term;

          return {
            query: query,
            params: {
              ':termo': '%' + params.term + '%'
            }
          }

        },
        processResults: function(data) {
          return {
            results: $.map(data.data, function(obj) {
              return obj;
            })
          };
        }
      },
      'placeholder': $(elemento).attr('placeholder'),
      'minimumInputLength': minimo,
      'maximumInputLength': 100,
      'language': {
        "errorLoading": function() {
          return 'Falha ao carregar.';
        },
        "inputTooLong": function(args) {
          var overChars = args.input.length - args.maximum;
          var message = 'Por favor, remova ' + overChars + ' caracteres';
          return message;
        },
        "inputTooShort": function(args) {
          var remainingChars = args.minimum - args.input.length;

          var message = 'Por favor, insira ' + remainingChars + ' ou mais caracteres';

          return message;
        },
        "loadingMore": function() {
          return 'Carregando mais informações…';
        },
        "maximumSelected": function(args) {
          var message = 'Você pode escolher ' + args.maximum + ' elementos';
          return message;
        },
        "noResults": function() {
          return 'Nenhum resultado encontrado';
        },
        "searching": function() {
          return 'Procurando…';
        }
      },
      // para selects que criam uma nova opção:
      'tags': tags,
      'createTag': function(params) {
        var term = $.trim(params.term);
        term = term.toUpperCase();
        if (term === '') {
          return null;
        }

        return {
          id: term,
          text: '<i class="fas fa-plus text-success"></i> ' + term,
        }
      },
      'escapeMarkup': function(markup) {
        return markup;
      },
    });
  }


  // function confirmar(title, descrip, btnconf) {
  //   Swal.fire({
  //     title: title,
  //     text: descrip,
  //     icon: 'warning', // success , error , warning ,info
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: btnconf, 
  //     cancelButtonText: 'Cancelar'
  //   }).then((result) => {
  //      if (result.isConfirmed) {
  //        return true;
  //      }
  //   });
  // }

  //       if auto === 'sim' {
  //         showConfirmButton: false,
  //         timer: 1500
  //       } else {
  //        showConfirmButton: true
  //       }
  //   });
  // }        

  // function alertaconfirm(title, descrip, icon, btnconf, successmsg, successdescrip, successicon = 'success') {
  //   Swal.fire({
  //     title: title,
  //     text: descrip,
  //     icon: icon, // success , error , warning ,info
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: btnconf, 
  //     cancelButtonText: 'Cancelar'
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       Swal.fire(
  //         successmsg,
  //         successdescrip,
  //         successicon // success , error , warning ,info
  //       )
  //     }
  //   });
  // }

  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //         alert('true');
  //     } else {
  //         alert('false')
  //     });
  //   }
  // }



  function select2(elemento, acao, placeholder = ' ', minimo = 0) {
    $(elemento).select2({
      'ajax': {
        url: 'select2',
        type: 'POST',
        data: function(params) {
          //

          return {
            acao: acao,
            params: params.term
          }

        },
        processResults: function(data) {
          return {
            results: $.map(data.data, function(obj) {
              return obj;
            })
          };
        }
      },
      'placeholder': placeholder,
      'minimumInputLength': minimo,
      'maximumInputLength': 100,
      'language': {
        "errorLoading": function() {
          return 'Falha ao carregar.';
        },
        "inputTooLong": function(args) {
          var overChars = args.input.length - args.maximum;
          var message = 'Por favor, remova ' + overChars + ' caracteres';
          return message;
        },
        "inputTooShort": function(args) {
          var remainingChars = args.minimum - args.input.length;

          var message = 'Por favor, insira ' + remainingChars + ' ou mais caracteres';

          return message;
        },
        "loadingMore": function() {
          return 'Carregando mais informações…';
        },
        "maximumSelected": function(args) {
          var message = 'Você pode escolher ' + args.maximum + ' elementos';
          return message;
        },
        "noResults": function() {
          return 'Nenhum resultado encontrado';
        },
        "searching": function() {
          return 'Procurando…';
        }
      }
    })
  };


  function select2php(elemento, query, tags = false, minimo = 0) {
    $(elemento + ' > option').remove();
    $(elemento).select2({
      'ajax': {
        url: '../manutencao/select2.php',
        type: 'GET',
        data: function(params) {
          //
          params.term = params.term == undefined ? '' : params.term;

          return {
            query: query,
            params: {
              ':termo': '%' + params.term + '%'
            }
          }

        },
        processResults: function(data) {
          return {
            results: $.map(data.data, function(obj) {
              return obj;
            })
          };
        }
      },
      'placeholder': $(elemento).attr('placeholder'),
      'minimumInputLength': minimo,
      'maximumInputLength': 100,
      'language': {
        "errorLoading": function() {
          return 'Falha ao carregar.';
        },
        "inputTooLong": function(args) {
          var overChars = args.input.length - args.maximum;
          var message = 'Por favor, remova ' + overChars + ' caracteres';
          return message;
        },
        "inputTooShort": function(args) {
          var remainingChars = args.minimum - args.input.length;

          var message = 'Por favor, insira ' + remainingChars + ' ou mais caracteres';

          return message;
        },
        "loadingMore": function() {
          return 'Carregando mais informações…';
        },
        "maximumSelected": function(args) {
          var message = 'Você pode escolher ' + args.maximum + ' elementos';
          return message;
        },
        "noResults": function() {
          return 'Nenhum resultado encontrado';
        },
        "searching": function() {
          return 'Procurando…';
        }
      },
      // para selects que criam uma nova opção:
      'tags': tags,
      'createTag': function(params) {
        var term = $.trim(params.term);
        term = term.toUpperCase();
        if (term === '') {
          return null;
        }

        return {
          id: term,
          text: '<i class="fas fa-plus text-success"></i> ' + term,
        }
      },
      'escapeMarkup': function(markup) {
        return markup;
      },
    });
  }

  function ativar_mascaras() {
    //console.log('ativando mascaras');
    $('.money').mask('#.##0,00', {
      reverse: true,
      onKeyPress: function(valor) {
        valor = valor.replaceAll('.', '').replaceAll(',', '.');
        $(this).data('value', valor);
      },
      onChange: function(value, e) {
        e.target.value = value.replace(/(?!^)-/g, '').replace(/^(-[,.])/, '-').replace(/(\d+\.*)\.(\d{2})$/, "$1,$2");
      }
    }).addClass('text-right');
    $('.km').mask('#.##0,000', {
      reverse: true,
      onKeyPress: function(valor) {
        valor = valor.replaceAll('.', '').replaceAll(',', '.');
        $(this).data('value', valor);
      },
      onChange: function(value, e) {
        e.target.value = value.replace(/(?!^)-/g, '').replace(/^(-[,.])/, '-').replace(/(\d+\.*)\.(\d{3})$/, "$1,$3");
      }
    }).addClass('text-right');
    $(".porcent").mask("00,00", {
      reverse: true
    });
    $(".porcent2").mask("0,0000", {
      reverse: true
    });
    $(".TEL").mask("(00)0000-0000", {
      placeholder: '(__)____-____'
    });
    $(".CEL").mask("(00)00000-0000", {
      placeholder: '(__)_____-____'
    });
    $(".CEP").mask("00000-000", {
      placeholder: '_____-___'
    });
    $(".CNPJ").mask("00.000.000/0000-00", {
      placeholder: '__.___.___/____-__'
    });
    $(".CPF").mask("000.000.000-00", {
      placeholder: '___.___.___-__'
    });

    $(".CPFCNPJ").keydown(function() {
      try {
        $(".CPFCNPJ").unmask();
      } catch (e) {}

      var tamanho = $(".CPFCNPJ").val().length;
     // tamanho = tamanho.replace(".", '').replace("-", '').length;
       
      if (tamanho < 12) {
       $(".CPFCNPJ").mask("000.000.000-000");
        
       } else{
         $(".CPFCNPJ").mask("00.000.000/0000-00");
       } 

   


      // ajustando foco
      var elem = this;
      setTimeout(function() {
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
      }, 0);
      // reaplico o valor para mudar o foco
      var currentValue = $(this).val();
      $(this).val('');
      $(this).val(currentValue);
    });

    $(".TELCEL").keydown(function() {
      try {
        $(this).unmask();
      } catch (e) {}

      var tamanho = $(this).val().length;

      if (tamanho < 10) {
        $(this).mask("(00)0000-0000", {
          placeholder: '(__)____-____'
        });
      } else {
        $(this).mask("(00)00000-0000");
      }

      // ajustando foco
      var elem = this;
      setTimeout(function() {
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
      }, 0);
      // reaplico o valor para mudar o foco
      var currentValue = $(this).val();
      $(this).val('');
      $(this).val(currentValue);
    });

    $('input').trigger('keydown');
    $('input').trigger('input');
  }