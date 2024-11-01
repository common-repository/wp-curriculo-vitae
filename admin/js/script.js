(function($) {

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    var countChecked = function() {

        if ($("#checkAll").attr('checked')) {

            $(".check").attr('checked', 'checked');
        } else {
            $(".check").removeAttr('checked');
        }

    };

    $("#checkAll").on("click", countChecked);

    $(document).ready(function() {
        function slideout() {
            setTimeout(function() {
                    $("#response").slideUp("slow", function() {});
                },
                2000);
        }

        $(".areaEdit").bind("click", updateText);

        var OrigText, NewText;

        $('.edit').live('keypress', function(e) {

            var tecla = (e.keyCode ? e.keyCode : e.which);

            if (tecla == 13) {

                var rel = $('.save').attr("rel");
                NewText = $(".edit").val();

                showAviso2(NewText);

                jQuery.ajax({
                    type: 'POST',
                    url: 'admin-ajax.php',
                    data: 'action=wpcvp_editArea&rel=' + rel + '&texto=' + NewText,
                    cache: true,
                    success: function(response) {
                        //alert(response);
                        hiddenAviso2();

                    }
                });


                $('.save').parent().html(NewText).removeClass("selected").bind("click", updateText);

            }
        });

        $(".save").live("click", function() {

            var rel = $(this).attr("rel");
            NewText = $(".edit").val();

            showAviso2(NewText);

            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: 'action=wpcvp_editArea&rel=' + rel + '&texto=' + NewText,
                cache: true,
                success: function(response) {
                    //alert(response);
                    hiddenAviso2();

                }
            });


            $(this).parent().html(NewText).removeClass("selected").bind("click", updateText);

        });

        $(".revert").live("click", function() {
            $(this).parent().html(OrigText).removeClass("selected").bind("click", updateText);
        });

        function updateText() {
            $('span').removeClass("areaEdit");
            //alert($(this).attr("rel"));
            OrigText = $(this).html();
            $(this).addClass("selected").html('<form ><input type="text" class="edit" value="' + OrigText + '" />&nbsp; &nbsp;</form><a href="#" class="save" rel="' + $(this).attr("rel") + '"><img src="../wp-content/plugins/wp-curriculo-vitae-premium/img/tick.png" border="0" width="16" height="16"/></a>&nbsp; &nbsp;<a href="#" class="revert"><img src="../wp-content/plugins/wp-curriculo-vitae-premium/img/cross.png" border="0" width="16" height="16"/></a>').unbind('click', updateText);
        }
    });


    //Mascara para o campo CPF
    $(document).ready(function() {
        if (($("#cpf").length || $("#wpcvpcep").length)) {
            $("#cpf").mask("999.999.999-99");
            // $("#wpcvpcep").mask("99999-999");
        }

        function str_replace(busca, subs, valor) {
            var ret = valor;
            var pos = ret.indexOf(busca);
            while (pos != -1) {
                ret = ret.substring(0, pos) + subs + ret.substring(pos + busca.length, ret.length);
                pos = ret.indexOf(busca);
            }
            return ret;
        }

        function mascara(valor, masc) {
            var res = valor,
                mas = str_replace("?", "", str_replace("9", "", masc));
            for (var i = 0; i < mas.length; i++) {
                res = str_replace(mas.charAt(i), "", res);
                mas = str_replace(mas.charAt(i), "", mas);
            }
            var ret = "";
            for (var i = 0; i < masc.length && res != ""; i++) {
                switch (masc.charAt(i)) {
                    case "?":
                        ret += res.charAt(0);
                        res = res.substring(1, res.length);
                        break;
                    case "9":
                        while (res != "" && (res.charCodeAt(0) > 57 || res.charCodeAt(0) < 48)) res = res.substring(1, res.length);
                        if (res != "") {
                            ret += res.charAt(0);
                            res = res.substring(1, res.length);
                        }
                        break;
                    default:
                        ret += masc.charAt(i);
                }
            }
            return ret;
        }

        $(".telefone").keyup(function() {
            if ($(this).val().length <= 13)
                $(this).val(mascara($(this).val(), '(99)9999-9999'));
            else
                $(this).val(mascara($(this).val(), '(99)99999-9999'));
        })
    });

    //Função que checa se já existe um cadastro com o mesmo CPF
    $(document).ready(function() {
        $('#cpf').keyup(cpf_check);
        $('#area').keyup(area_check);

        $('#cidade').keyup(function() {
            var cidade = $(this).val();
            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: 'action=wpcvp_autoCidade&cidade=' + cidade,
                cache: true,
                success: function(response) {

                    var retorno = response.substring(0, response.length - 1)
                    response = retorno;

                    $("#cidade").autocomplete({
                        source: [response],
                    });

                }
            });
        });

        $('#bairro').keyup(function() {
            var bairro = $(this).val();
            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: 'action=wpcvp_autoBairro&bairro=' + bairro,
                cache: true,
                success: function(response) {

                    //alert(response.substring(0,response.length - 1));
                    var retorno = response.substring(0, response.length - 1)
                    response = retorno;

                    $("#bairro").autocomplete({
                        source: [response],
                    });

                }
            });
        });

        /*$('#area').keyup(function() {
            var area = $(this).val();
            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: 'action=wpcvp_autoCargo&area=' + area,
                cache: true,
                success: function(response) {

                    //alert(response.substring(0,response.length - 1));
                    var retorno = response.substring(0, response.length - 1)
                    response = retorno;

                    $("#area").autocomplete({
                        source: [response],
                    });

                }
            });
        });*/

    });

    $('input#curriculo').change(function() {

        var arquivo = $('input#curriculo').val();

        //var id_registro = $('#id_registro').val();
        //var nomeUser = $('#nomeUser_'+num).html();
        $("#msgFile").fadeOut('slow');

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: 'action=wpcvp_verificarArquivo&arquivo=' + arquivo,
            cache: true,
            success: function(response) {

                //alert(response.substring(0,response.length - 1));
                var retorno = response.substring(0, response.length - 1)
                response = retorno;
                $("#ext").html(response);
                if (response == "pdf" || response == "doc" || response == "docx" || response == "jpeg" || response == "jpg" || response == "png") {
                    //alert("correto");
                } else {
                    //alert("errado");
                    $("#msgFile").fadeIn('slow');
                }
            }
        });

    });

    $(document).ready(function() {

        $('#tipo_envio').change(function() {

            var tipoEnvio = $("select#tipo_envio option:selected").val();

            if (tipoEnvio == '1') {

                $('#personalizarSMTP').fadeIn('slow');

            } else {

                $('#personalizarSMTP').fadeOut('slow');

            }
        }).trigger('change');


    });

    function cpf_check() {
        var cpf = $('#wpcvpcpf').val();
        if (cpf == '' || cpf.length < 14) {
            $('#wpcvpcpf').closest('.input-group').find('.input-group-append').remove();
            $('#wpcvpcpf').closest('.input-group').find('.valid-feedback').remove();
            $('#wpcvpcpf').removeClass('is-valid');

            $('#wpcvpcpf').closest('.input-group').append('<div class="input-group-append"><span class="input-group-text text-success" id="basic-addon2"><span class="glyphicon glyphicon-ok cpfglysuce" aria-hidden="true"></span></span></div>');
            $('#wpcvpcpf').closest('.input-group').append('<div class="valid-feedback">CPF aprovado!</div>');
            $('#wpcvpcpf').addClass('is-valid');
        } else {
            jQuery.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: 'action=wpcvp_checkCpf&cpf=' + cpf,
                cache: false,
                success: function(response) {

                    var retorno = response.substring(0, response.length - 1)
                    response = retorno;

                    $('#wpcvpcpf').closest('.input-group').find('.input-group-append').remove();
                    $('#wpcvpcpf').closest('.input-group').find('.valid-feedback').remove();
                    $('#wpcvpcpf').closest('.input-group').find('.invalid-feedback').remove();
                    $('#wpcvpcpf').removeClass('is-valid');
                    $('#wpcvpcpf').removeClass('is-invalid');

                    if (response == "achou") {

                        $('#wpcvpcpf').closest('.input-group').append(' <div class="input-group-append"><span class="input-group-text text-danger" id="basic-addon2"><span class="glyphicon glyphicon-remove cpfglyerror" aria-hidden="true"></span></span></div>');
                        $('#wpcvpcpf').closest('.input-group').append('<div class="invalid-feedback">CPF já cadastrado!</div>');
                        $('#wpcvpcpf').addClass('is-invalid');

                        $('.tbCadastrarSite').prop("disabled", true);

                    } else {

                        $('#wpcvpcpf').closest('.input-group').append('<div class="input-group-append"><span class="input-group-text text-success" id="basic-addon2"><span class="glyphicon glyphicon-ok cpfglysuce" aria-hidden="true"></span></span></div>');
                        $('#wpcvpcpf').closest('.input-group').append('<div class="valid-feedback">CPF aprovado!</div>');
                        $('#wpcvpcpf').addClass('is-valid');

                        $('.tbCadastrarSite').prop("disabled", false);

                    }
                }
            });
        }

    }

    $(document).on('change', '#foto', function() {
        var nameFile = $(this).val().replace("C:\\fakepath\\", "");
        //var file = $(this).val();
        readFotoCurriculo(this);
        if (nameFile != "") {
            $(this).closest('.custom-file').find('.custom-file-label').html(nameFile);
        } else {
            $(this).closest('.custom-file').find('.custom-file-label').html("Selecione sua foto");
        }


    });

    $(document).on('change', '#curriculo', function() {
        var nameFile = $(this).val().replace("C:\\fakepath\\", "");
        if (nameFile != "") {
            $(this).closest('.custom-file').find('.custom-file-label').html(nameFile);
        } else {
            $(this).closest('.custom-file').find('.custom-file-label').html("Selecione sua foto");
        }
    });

    function readFotoCurriculo(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#fotoCurriculo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function area_check() {
        var area = $('#area').val();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'wpcvp_checkArea',
                area: area,
            },
            cache: false,
            success: function(response) {

                var retorno = response.substring(0, response.length - 1)
                response = retorno;

                $('#area').closest('.input-group').find('.input-group-append').remove();
                $('#area').closest('.input-group').find('.valid-feedback').remove();
                $('#area').closest('.input-group').find('.invalid-feedback').remove();
                $('#area').removeClass('is-valid');
                $('#area').removeClass('is-invalid');

                if (response == "achou") {

                    $('#area').closest('.input-group').append(' <div class="input-group-append"><span class="input-group-text text-danger" id="basic-addon2"><span class="glyphicon glyphicon-remove cpfglyerror" aria-hidden="true"></span></span></div>');
                    $('#area').closest('.input-group').append('<div class="invalid-feedback">Área já cadastrado!</div>');
                    $('#area').addClass('is-invalid');

                    $('.tbCadastrarSite').prop("disabled", true);

                } else {

                    $('#area').closest('.input-group').append('<div class="input-group-append"><span class="input-group-text text-success" id="basic-addon2"><span class="glyphicon glyphicon-ok cpfglysuce" aria-hidden="true"></span></span></div>');
                    $('#area').closest('.input-group').append('<div class="valid-feedback">Área aprovado!</div>');
                    $('#area').addClass('is-valid');

                    $('.tbCadastrarSite').prop("disabled", false);
                }
            }
        });

    }

    //Preenche o o endereço com o cep preenchido
    $(document).ready(function() {
        $('#wpcvpcep').keyup(getEndereco);
    });

    function getEndereco() {
        // Se o campo CEP não estiver vazio
        if ($.trim($("#wpcvpcep").val()) != "") {
            /*
            Para conectar no serviço e executar o json, precisamos usar a função
            getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
            dataTypes não possibilitam esta interação entre domínios diferentes
            Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
            http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#wpcvpcep").val()
            */
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + $("#wpcvpcep").val(), function() {
                // o getScript dá um eval no script, então é só ler!
                //Se o resultado for igual a 1
                if (resultadoCEP["tipo_logradouro"] != '') {
                    if (resultadoCEP["resultado"]) {
                        // troca o valor dos elementos
                        $("#rua").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                        $("#bairro").val(unescape(resultadoCEP["bairro"]));
                        $("#cidade").val(unescape(resultadoCEP["cidade"]));
                        $("#estado").val(unescape(resultadoCEP["uf"]));
                        $("#numero").focus();
                    }
                }
            });
        }
    }

    //carregar o bairro baseando na cidade que foi escolhida
    $(document).ready(function() {
        $('#estado').change(carregar_cidade);
        $('#cidade').change(carregar_bairro);
    });

    function carregar_cidade() {
        var estado = $('#estado option:selected').val();
        //alert(estado);
        $('#cidade').html("<option value=\"\">Carregando...</option>");
        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: 'action=wpcvp_carregar_cidade&estado=' + estado,
            cache: false,
            success: function(response) {
                //alert(response);
                $('#cidade').removeAttr('disabled');
                $('#cidade').html(response);
            }
        });
    }

    function carregar_bairro() {
        var estado = $('#estado option:selected').val();
        var cidade = $('#cidade option:selected').val();
        $('#bairro').html("<option value=\"\">Carregando...</option>");
        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: 'action=wpcvp_carregar_bairro&estado=' + estado + '&cidade=' + cidade,
            cache: false,
            success: function(response) {
                //alert(response);
                $('#bairro').removeAttr('disabled');
                $('#bairro').html(response);
            }
        });
    }

    function dirname(path) {
        // http://kevin.vanzonneveld.net
        // +   original by: Ozh
        // +   improved by: XoraX (http://www.xorax.info)
        // *     example 1: dirname('/etc/passwd');
        // *     returns 1: '/etc'
        // *     example 2: dirname('c:/Temp/x');
        // *     returns 2: 'c:/Temp'
        // *     example 3: dirname('/dir/test/');
        // *     returns 3: '/dir'
        return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?$/, '');
    }

    $("a.abrirDescricao").click(function() {

        var rel = $(this).attr('rel');
        var id = $('#id_registro_' + rel).val();
        var nome = $(this).closest('tr').find('td:first-child').html();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: 'action=wpcvp_lightBoxCurAdmin&id=' + id,
            //data: 'action=wpcvp_carregar_bairro&estado=' + estado + '&cidade=' + cidade,
            cache: false,
            success: function(response) {
                //alert(response);
                var retorno = response.substring(0, response.length - 1);
                response = retorno;

                $("#ModalDCurriculo .modal-title").html('Currículo:');
                $("#ModalDCurriculo .modal-body").html(response);
                $('#ModalDCurriculo').modal('toggle');
            }
        });


    });

    $(function() {
        function removeCampo(btn, item) {
            $(btn).unbind("click");
            $(btn).bind("click", function(event) {
                event.preventDefault();
                i = 0;

                $("div" + item).each(function() {
                    i++;
                });

                if (i > 1) {
                    $(this).closest(item).fadeOut('slow', function() { $(this).remove(); });
                }
            });
        }

        removeCampo('.removerFormacao', '.formacaoAcademica');

        $(".adicionarNovaFormacao").click(function() {
            novoCampo = $("div.formacaoAcademica:last").clone();
            novoCampo.find("input").val("");
            novoCampo.find("textarea").val("");
            novoCampo.find("select").val("");
            novoCampo.find('.removerFormacao').removeClass('d-none');
            novoCampo.fadeIn('slow').insertAfter("div.formacaoAcademica:last");
            removeCampo('.removerFormacao', '.formacaoAcademica');
        });

        removeCampo('.removerExperiencia', '.experienciaprofissional');

        $(".adicionarNovaExperiencia").click(function() {
            novoCampo = $("div.experienciaprofissional:last").clone();
            novoCampo.find("input").val("");
            novoCampo.find("textarea").val("");
            novoCampo.find("select").val("");
            novoCampo.find('.removerExperiencia').removeClass('d-none');
            novoCampo.fadeIn('slow').insertAfter("div.experienciaprofissional:last");
            removeCampo('.removerExperiencia', '.experienciaprofissional');
        });

        removeCampo('.removerCursoPalestra', '.cursospalestras');

        $(".adicionarNovaCursoPalestra").click(function() {
            novoCampo = $("div.cursospalestras:last").clone();
            novoCampo.find("input").val("");
            novoCampo.find("textarea").val("");
            novoCampo.find("select").val("");
            novoCampo.find('.removerCursoPalestra').removeClass('d-none');
            novoCampo.fadeIn('slow').insertAfter("div.cursospalestras:last");
            removeCampo('.removerCursoPalestra', '.cursospalestras');
        });

        removeCampo('.removerIdioma', '.idiomas');

        $(".adicionarNovaIdioma").click(function() {
            novoCampo = $("div.idiomas:last").clone();
            novoCampo.find("input").val("");
            novoCampo.find("textarea").val("");
            novoCampo.find("select").val("");
            novoCampo.find('.removerIdioma').removeClass('d-none');
            novoCampo.fadeIn('slow').insertAfter("div.idiomas:last");
            removeCampo('.removerIdioma', '.idiomas');
        });

        removeCampo('.removerConhecimentoTecnico', '.conhecimentotecnico');

        $(".adicionarNovaConhecimentoTecnico").click(function() {
            novoCampo = $("div.conhecimentotecnico:last").clone();
            novoCampo.find("input").val("");
            novoCampo.find("textarea").val("");
            novoCampo.find("select").val("");
            novoCampo.find('.removerConhecimentoTecnico').removeClass('d-none');
            novoCampo.fadeIn('slow').insertAfter("div.conhecimentotecnico:last");
            removeCampo('.removerConhecimentoTecnico', '.conhecimentotecnico');
        });
    });

    /*Botões próximos das etapas*/
    $(document).on('click', '.btn-proximo', function(event) {
        event.preventDefault();
        abaCategorias($(this));
    });


    function abaCategorias(objeto) {
        var aba = objeto.attr('href');

        $('a[role^=tab]').removeClass('active').removeClass('show');
        $('div[role^=tabpanel]').removeClass('show').removeClass('active');
        $(aba + "-tab").attr('aria-selected', 'true').addClass('active').addClass('show');
        $(aba).addClass('show').addClass('active');

    }

    /*$('#autenticacao').click(function() {
        if ($("#autenticacao").is(':checked')) {
            $('#usuarioSenha').fadeIn('slow');
        } else {
            $('#usuarioSenha').fadeOut('slow');
        }
    });*/

}(jQuery));
