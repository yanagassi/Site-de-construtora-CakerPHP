                            <h3>Dados da Empresa / Profissional</h3>
                            <form data-toggle="validator" novalidate="true" method="post" action="/admin/anuncios/editar/<?php echo $result['Advertisement']['id'] ?>">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Título do Anúncio (Ex.: Construfácil Reformas em Geral) *</span></label>
                                                <input type="text" maxlength="50" rel="Advertisement" name="titulo_anuncio" data-error="Por favor, informe um título" id="titulo_anuncio" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Advertisement']['titulo_anuncio']) ? $result['Advertisement']['titulo_anuncio'] : "" ) ?>" data-role="advertisements" data-value="<?php echo ( !empty($result['Advertisement']['titulo_anuncio']) ? $result['Advertisement']['titulo_anuncio'] : "" ) ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
<!--                                            <Button type="submit" class="btn btn-success">Salvar</button>-->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Email</span></label>
                                                <input type="text" rel="Advertisement" id="email" name="email" class="form-control ajaxSave" value="<?php echo ( !empty($result['Advertisement']['email']) ? $result['Advertisement']['email'] : "" ) ?>" data-value="<?php echo ( !empty($result['Advertisement']['email']) ? $result['Advertisement']['email'] : "" ) ?>">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <?php if ($result['Advertisement']['tipo'] == 'FÍSICA') { ?>
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">CPF *</span></label>
                                                <input type="text" rel="Advertisement" id="cpf" name="cpf" required class="form-control inputmask ajaxSave" value="<?php echo ( !empty($result['Advertisement']['cpf']) ? $result['Advertisement']['cpf'] : "" ) ?>" data-value="<?php echo ( !empty($result['Advertisement']['cpf']) ? $result['Advertisement']['cpf'] : "" ) ?>" data-error="Forneça um CPF válido!">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">CNPJ *</span></label>
                                                <input type="text" rel="Advertisement" id="cnpj" name="cnpj" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Advertisement']['cnpj']) ? $result['Advertisement']['cnpj'] : "" ) ?>" data-value="<?php echo ( !empty($result['Advertisement']['cnpj']) ? $result['Advertisement']['cnpj'] : "" ) ?>" data-error="Forneça um CNPJ válido!">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Descrição da Empresa/Profissional * (Máximo de 540 caracteres)</span></label>
                                                <textarea onkeyup="countChar(this)" id="quem_somos" maxlength="540" rel="Advertisement" name="quem_somos" class="form-control ajaxSave countChar" required rows="5" data-error="Forneça uma descrição da Empresa/Profissional" data-value="<?php echo ( !empty($result['Advertisement']['quem_somos']) ? $result['Advertisement']['quem_somos'] : "" ) ?>"><?php echo ( !empty($result['Advertisement']['quem_somos']) ? $result['Advertisement']['quem_somos'] : "" ) ?></textarea>
                                                <div class="help-block with-errors"></div>
                                                <script>
                                                    function countChar(val)
                                                    {
                                                        var len   = val.value.length;
                                                        var limit = $('.countChar').attr('maxlength');

                                                        if (len > limit)
                                                        {
                                                            val.value = val.value.substring(0, limit);
                                                        }
                                                        else
                                                        {
                                                            $('#charNum').text(limit - len);
                                                        }
                                                    };
                                                </script>
                                                <div id="charNum"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="m-b-40">

                                <h3>Seu Endereço na Construlista</h3>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Ex: https://construlista.com.br/<strong>seu-anuncio</strong></span></label>
                                                <input onkeyup="countCharSlug(this)" id="slug" maxlength="90" rel="Advertisement" data-value="<?php echo ( !empty($result['Advertisement']['slug']) ? $result['Advertisement']['slug'] : "" ) ?>" name="slug" class="form-control ajaxSaveSlug countCharSlug" value="<?php echo ( !empty($result['Advertisement']['slug']) ? $result['Advertisement']['slug'] : "" ) ?>" />
                                                <script>
                                                    function countCharSlug(val)
                                                    {
                                                        var len   = val.value.length;
                                                        var limit = $('.countCharSlug').attr('maxlength');

                                                        if (len > limit)
                                                        {
                                                            val.value = val.value.substring(0, limit);
                                                        }
                                                        else
                                                        {
                                                            $('#charNumSlug').text(limit - len);
                                                        }
                                                    };
                                                </script>
                                                <div id="charNumSlug"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group text-center" style="margin-top:27px">
                                                <a href="javascript:void(0)" id="bt_check_slug" class="btn btn-success">Salvar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="m-b-40">

                                <h3>Endereço</h3>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">CEP *</span> | <a href="http://www.consultaenderecos.com.br/" target="_blank">Não sei o CEP</a></label>
                                                <input type="text" name="cep" id="cep" required class="form-control ajaxSaveCep" value="<?php echo ( !empty($result['Address']['cep']) ? $result['Address']['cep'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['cep']) ? $result['Address']['cep'] : "" ) ?>" data-error="Informe um CEP válido">
                                                <div class="help-block with-errors"></div>
                                                <input type="hidden" name="id" value="<?php echo ( !empty($result['Address']['id']) ? $result['Address']['id'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <?php if ( AuthComponent::user('role') == 'admin' ) { ?>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Latitude</span></label>
                                                <input type="text" name="lat"  class="form-control readonly" readonly value="<?php echo ( !empty($result['Address']['lat']) ? $result['Address']['lat'] : "" ) ?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Longitude</span></label>
                                                <input type="text" name="long" class="form-control readonly" readonly value="<?php echo ( !empty($result['Address']['long']) ? $result['Address']['long'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Endereço *</span></label>
                                                <input type="text" rel="Address" name="endereco" id="endereco" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['endereco']) ? $result['Address']['endereco'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['endereco']) ? $result['Address']['endereco'] : "" ) ?>" data-error="Informe um endereço válido">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Número *</span></label>
                                                <input maxlength="45" type="text" rel="Address" name="numero" id="numero" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['numero']) ? $result['Address']['numero'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['numero']) ? $result['Address']['numero'] : "" ) ?>" data-error="Informe um número">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Complemento</span></label>
                                                <input maxlength="45" type="text" rel="Address" name="complemento" id="complemento" class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['complemento']) ? $result['Address']['complemento'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['complemento']) ? $result['Address']['complemento'] : "" ) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Bairro *</span></label>
                                                <input maxlength="245" rel="Address" type="text" name="bairro" id="bairro" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['bairro']) ? $result['Address']['bairro'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['bairro']) ? $result['Address']['bairro'] : "" ) ?>" data-error="Informe um bairro válido">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Cidade *</span></label>
                                                <input maxlength="45" rel="Address" rel="Address" type="text" name="cidade" id="cidade" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['cidade']) ? $result['Address']['cidade'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['cidade']) ? $result['Address']['cidade'] : "" ) ?>" data-error="Informe uma cidade válida">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">UF *</span></label>
                                                <input maxlength="2" rel="Address" type="text" name="estado" id="uf" required class="form-control ajaxSave" value="<?php echo ( !empty($result['Address']['estado']) ? $result['Address']['estado'] : "" ) ?>" data-value="<?php echo ( !empty($result['Address']['estado']) ? $result['Address']['estado'] : "" ) ?>" data-error="Informe um estado válido">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="m-b-40">

                                <h3>Telefones</h3>
                                <p class="text-muted">Adicionar Novo Telefone (máximo de 4)</p>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-md-12">Tipo</label>
                                            <select class="form-control" required name="data[Phone][0][tipo]" id="select_type">
                                                <option value="Celular" selected="selected">Celular</option>
                                                <option value="Whatsapp">WhatsApp</option>
                                                <option value="Fixo">Fixo</option>
                                            </select>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">Número</label>
                                            <input name="data[DigitalSignatureUser][0][name]" id="add_tel" type="text" class="form-control " placeholder="" required data-error="Este campo é obrigatório">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group text-center" style="margin-top:27px">
                                            <a href="javascript:void(0)" id="bt_add_dest" class="btn btn-primary btn-info">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" id="bt_msg_limit" style="display:none" class="btn btn-primary btn-danger">Você atingiu o número máximo de disponível!</a>
                                <a href="javascript:void(0)" id="bt_msg_tel_empty" style="display:none" class="btn btn-primary btn-danger">Número do telefone não pode estar em branco!</a>

                                <hr class="m-b-40">

                                <div class="form-body">
                                    <table class="table-bordered table-hover table tablesaw-swipe">
                                        <thead>
                                        <tr>
                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" class="col-md-6 tablesaw-cell-persist">Números Salvos</th>
                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col="" data-tablesaw-priority="3" class="col-md-5">Tipo</th>
                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="col-md-1 text-center">Ação</th>
                                        </tr>
                                        </thead>
                                        <tbody id="row_bt_add_dest">
                                        <?php foreach ($result['Phone'] as $item): ?>
                                            <tr id="<?php echo $item['id'] ?>" class="nlines">
                                                <td><?php echo $this->Custom->phoneMask($item['telefone']) ?></td>
                                                <td><?php echo $item['tipo'] ?></td>
                                                <td class="text-center"><a href=javascript:confirmDeleteItem(<?php echo $item['id'] ?>,'phones') class="bt_del_dest" rel=""><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            <script type="text/javascript">
                                jQuery(document).ready(function() {
                                    $('.phone').mask('(99) 9999-9999');
                                    $('.cellphone').mask('(99) 99999-9999');
                                    $('#cpf').mask('999.999.999-99');
                                    $('#cnpj').mask('99.999.999/9999-99');
                                    $('#birthday').mask('99/99/9999');
                                    $('#cep').mask('99.999-999');

                                    $('#add_tel').mask('(99) 99999-9999'); // default cell
                                    $( "#select_type" ).change(function() {
                                        var type = $( this ).val();
                                        if ( type == "Celular" || type == "Whatsapp" )
                                        {
                                            $('#add_tel').mask('(99) 99999-9999');
                                        }
                                        else
                                        {
                                            $('#add_tel').mask('(99) 9999-9999');
                                        }
                                    });

                                    /* Add more phones */
                                    $("#bt_add_dest").on("click",function() {

                                        if ( $('.nlines').length > 3 )
                                        {
                                            $("#bt_msg_limit").show(1000);

                                            var sec = 3500;
                                            setTimeout(function()
                                            {
                                                $("#bt_msg_limit").hide('blind');
                                            }, sec);

                                            return false;
                                        }
                                        else
                                        {
                                            var new_phone = $("#add_tel").val();
                                            var new_type  = $("#select_type").val();
                                            var html 	  = "";
                                            var index     = "";

                                            if ( new_phone != "" )
                                            {
                                                //jQuery('.preloader').show(); // showing process
                                                $('#preloader222').show();

                                                // Data Ajax to Save New Phone
                                                var formDataPhone =
                                                {
                                                    "Phone" :
                                                    {
                                                        "anuncio_id" : <?php echo $result['Advertisement']['id'] ?>,
                                                        "telefone"   : new_phone,
                                                        "tipo"	     : new_type
                                                    }
                                                }

                                                // add by ajax new phone number to table
                                                $.ajax({
                                                    type: "POST",
                                                    dataType: "json",
                                                    url: "/phones/ajax_add_phone",
                                                    data: formDataPhone,
                                                    success: function (result)
                                                    {
                                                        if ( result.status )
                                                        {
                                                            $('.preloader').hide(); // showing process
                                                            $('#flash-ajax-success').text(result.msg);
                                                            $('#flash-ajax-success').show("slow").delay(2000);
                                                            $("#flash-ajax-success").hide('blind');
                                                            index = result.id;

                                                            // insert new phone to table
                                                            html =
                                                                '<tr class="nlines" id="'+index+'">' +
                                                                '<td>'+new_phone+'</td>' +
                                                                '<td>'+new_type+'</td>' +
                                                                '<td class="text-center"><a href=javascript:confirmDeleteItem('+index+',"phones") class="bt_del_dest" rel="'+index+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>' +
                                                                '</tr>';

                                                            $( "#row_bt_add_dest" ).prepend( html );
                                                        }
                                                        else
                                                        {
                                                            $('.preloader').hide(); // showing process
                                                            $('#flash-ajax-error').text(result.msg);
                                                            $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                                                        }
                                                    }
                                                });

                                                // cleanning old inputed number
                                                $("#add_tel").val("");
                                            }
                                            else
                                            {
                                                $("#bt_msg_tel_empty").show(1000);

                                                var sec = 3500;
                                                setTimeout(function()
                                                {
                                                    $("#bt_msg_tel_empty").hide('blind');
                                                }, sec);

                                                return false;
                                            }

                                            $('.preloader').hide(); // showing process
                                        }

                                        $(".bt_del_dest").click(function() {
                                            id = $(this).attr('rel');
                                            $( "#" + id ).remove();
                                            $("#bt_msg_limit").hide(1000);
                                        });

                                        $("#bt_msg_limit").click(function() {
                                            $("#bt_msg_limit").hide(1000);
                                        });

                                        $("#bt_msg_tel_empty").click(function() {
                                            $("#bt_msg_tel_empty").hide(1000);
                                        });

                                    });


//                                    var _old_val_cep   = ""; // get original value
//                                    $( '.ajaxSaveCep' ).click( function()
//                                    {
//                                        _old_val_cep   = $(this).val();
//                                    });

                                    var cep = "";
                                    var original_cep = "";
                                    var _old_val_cep   = $(this).val();

                                    $("#cep").blur(function ()
                                    {
                                        cep = $(this).val(); //Nova variável com valor do campo "cep".
                                        original_cep = $(this).val();

                                        if (cep != "") //Verifica se campo cep possui valor informado.
                                        {
                                            // Clear to keep just numbers
                                            cep = cep.replace(/[^0-9]/, '');

                                            //Expressão regular para validar o CEP.
                                            var validacep = /^[0-9]{5}-?[0-9]{3}$/;
                                            //Valida o formato do CEP.
                                            if (validacep.test(cep))
                                            {
                                                //Preenche os campos com "..." enquanto consulta webservice.
                                                $("#endereco").val("Carregando Rua...")
                                                $("#bairro").val("Carregando Bairro...")
                                                $("#cidade").val("Carregando Cidade..")
                                                $("#uf").val("Carregando Estado")

                                                //Consulta o webservice viacep.com.br/
                                                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados)
                                                {
                                                    if (!("erro" in dados))
                                                    {
                                                        $("#endereco").val(dados.logradouro); //Atualiza os campos com os valores da consulta.
                                                        $("#bairro").val(dados.bairro);
                                                        $("#cidade").val(dados.localidade);
                                                        $("#uf").val(dados.uf);
                                                        updateCep();
                                                    }
                                                    else
                                                    {
                                                        limpa_formulário_cep();//CEP pesquisado não foi encontrado.
                                                        //alert("CEP não encontrado.");
                                                    }
                                                });
                                            }
                                            else
                                            {
                                                limpa_formulário_cep(); //cep é inválido.
                                                alert("Formato de CEP inválido.");
                                            }
                                        }
                                        else
                                        {
                                            limpa_formulário_cep(); //cep sem valor, limpa formulário.
                                        }
                                    });

                                    function updateCep()
                                    {
                                        if ( original_cep != _old_val_cep ) // verify if original value has changed
                                        {
                                            $('.preloader').show(); // showing process

                                            var formDataCep =
                                            {
                                                "Address" :
                                                {
                                                    "cep" 			: cep,
                                                    "endereco"		: $("#endereco").val(),
                                                    "bairro"		: $("#bairro").val(),
                                                    "cidade"		: $("#cidade").val(),
                                                    "estado"		: $("#uf").val(),
                                                    "numero"		: $("#numero").val(),
                                                    "complemento" 	: $("#complemento").val(),
                                                    "anuncio_id" 	: <?php echo $result['Advertisement']['id'] ?>
                                                }
                                            }

                                            $.ajax({
                                                type: "POST",
                                                dataType: "json",
                                                url: "/advertisements/edit_ajax_multiple_fields/<?php echo ( !empty($result['Address']['id']) ? $result['Address']['id'] : 0 ) ?>",
                                                data: formDataCep,
                                                success: function (result)
                                                {
                                                    if ( result.status )
                                                    {
                                                        $('.preloader').hide(); // hidding process
                                                        $('#flash-ajax-success').text(result.msg);
                                                        $('#flash-ajax-success').show("slow").delay(2000);
                                                        $("#flash-ajax-success").hide('blind');
                                                    }
                                                    else
                                                    {
                                                        $('.preloader').hide(); // hidding process
                                                        $('#flash-ajax-error').text(result.msg);
                                                        $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                                                    }
                                                }
                                            });
                                        }
                                    }

                                    function limpa_formulário_cep() // Limpa valores do formulário de cep.
                                    {
                                        $("#endereco").val("");
                                        $("#bairro").val("");
                                        $("#cidade").val("");
                                        $("#uf").val("");
                                    }
                                });
                            </script>