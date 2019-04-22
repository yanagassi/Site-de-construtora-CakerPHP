                                <div class="form-body">
                                    <div class="row">
                                        <script src="/js/plentz-jquery-maskmoney-cdbeeac/dist/jquery.maskMoney.min.js" type="text/javascript"></script>
                                        <form action="/products/add_sheet" method="post" enctype="multipart/form-data" data-toggle="validator" novalidate="true">
                                            <div class="col-md-8">
                                                <h3>Categoria de Produtos/Palavras Chave</h3>
                                                <p class="text-muted m-b-30 font-13">Adicione manualmente os seus produtosa abaixo ou importe-os ao lado via planilha excel<br>
                                                    Ex.: Produto: Saco de Cimento | Unidade: Un | Valor: R$26,90 / Obs: O preço não será exibido no seu anúncio.</p>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><span class="help">Descrição do Produto (*)</span></label>
                                                            <input type="text" name="data[Product][nome]" class="form-control" required data-error="Informe uma descrição de produto. Mínimo de 3 caracteres" data-minlength="3" maxlength="45">
                                                            <span class="help-block with-errors"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><span class="help">Unidade (*)</span></label>
                                                            <input type="text" name="data[Product][unidade]" class="form-control" required data-error="Informe uma unidade de produto. Mínimo de 2 caracteres" data-minlength="2">
                                                            <span class="help-block with-errors"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><span class="help">Preço Unitário em R$ (*)</span></label>
                                                            <input type="text" name="data[Product][preco]" data-thousands="." data-decimal="," maxlength="13" id="preco" required class="form-control typeCurrency_" data-error="Informe um preço unitário. Mínimo de 3 dígitos" data-minlength="3">
                                                            <span class="help-block with-errors"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><span class="help">&nbsp;</span></label>
                                                            <a href="javascript:void(0)" id="bt_add_products" class="btn btn-primary btn-info">Adicionar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" id="bt_msg_empty_products" style="display:none" class="btn btn-primary btn-danger">Campos com * devem ser preenchidos</a>

                                                <script type="text/javascript">
                                                    jQuery(document).ready(function()
                                                    {

                                                        $("#preco").maskMoney();

                                                        /* Add more payment methods */
                                                        $("#bt_add_products").on("click",function()
                                                        {
                                                            var html_product     = "";
                                                            var index_product    = "";

                                                            var nome        = $( "input[name='data[Product][nome]']" ).val();
                                                            var unidade     = $( "input[name='data[Product][unidade]']" ).val();
                                                            var preco       = $( "input[name='data[Product][preco]']" ).val();
                                                            var is_imported = "Manual";

                                                            if ( nome != "" && unidade != "" && preco != "" && preco.length >= 3 )
                                                            {
                                                                $('.preloader').show(); // show loading process

                                                                // Data Ajax to Save New Phone
                                                                var formDataProduct =
                                                                {
                                                                    "Product" :
                                                                    {
                                                                        "anuncio_id"  : <?php echo $result['Advertisement']['id'] ?>,
                                                                        "nome"        : nome,
                                                                        "unidade"     : unidade,
                                                                        "preco"       : preco,
                                                                        "is_imported" : 0
                                                                    }
                                                                }

                                                                // add by ajax new phone number to table
                                                                $.ajax({
                                                                    type: "POST",
                                                                    dataType: "json",
                                                                    url: "/products/ajax_add",
                                                                    data: formDataProduct,
                                                                    success: function (result)
                                                                    {
                                                                        if ( result.status )
                                                                        {
                                                                            $('.preloader').hide(); // hidding process
                                                                            $('#flash-ajax-success').text(result.msg);
                                                                            $('#flash-ajax-success').show("slow").delay(2000);
                                                                            $("#flash-ajax-success").hide('blind');
                                                                            index_product = result.id;

                                                                            // insert new phone to table
                                                                            html_product =
                                                                                '<tr id="'+index_product+'">' +
                                                                                    '<td>'+nome+'</td>' +
                                                                                    '<td>'+unidade+'</td>' +
                                                                                    '<td>'+preco+'</td>' +
                                                                                    '<td>'+is_imported+'</td>' +
                                                                                    '<td class="text-center"><a href=javascript:confirmDeleteItem('+index_product+',"products") class="bt_del_product" rel="'+index_product+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>' +
                                                                                '</tr>';

                                                                            $( "#row_bt_add_product" ).prepend( html_product );
                                                                        }
                                                                        else
                                                                        {
                                                                            $('.preloader').hide(); // hidding process
                                                                            $('#flash-ajax-error').text(result.msg);
                                                                            $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                                                                        }
                                                                    }
                                                                });

                                                                // cleanning old inputed val
                                                                $( "input[name='data[Product][nome]']" ).val("");
                                                                $( "input[name='data[Product][unidade]']" ).val("");
                                                                $( "input[name='data[Product][preco]']" ).val("");
                                                            }
                                                            else
                                                            {
                                                                $("#bt_msg_empty_products").show(1000);

                                                                var sec = 3500;
                                                                setTimeout(function()
                                                                {
                                                                    $("#bt_msg_empty_products").hide('blind');
                                                                }, sec);

                                                                return false;
                                                            }

                                                            $(".bt_del_product").click(function() {
                                                                id = $(this).attr('rel');
                                                                $( "#" + id ).remove();
                                                            });

                                                            $("#bt_msg_empty_products").click(function() {
                                                                $("#bt_msg_empty_products").hide(1000);
                                                            });
                                                        });

                                                        $('.dropify').dropify({
                                                            messages: {
                                                                'default': 'Arraste um arquivo para cá',
                                                                'replace': 'Arraste um arquivo para cá ou clique para adicionar',
                                                                'remove':  'Remover',
                                                                'error':   'Ooops, houve algum erro.'
                                                            },
                                                            error: {
                                                                'fileSize': 'O tamanho do arquivo é muito grande: ({{ value }} máximo).'
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </form>

                                        <div class="col-md-4">
                                            <h3>Exporte do seu sistema todos seus produtos em estoque e importe a planilha.</h3>
                                            <p class="text-muted m-b-30 font-13">Formato CSV | <a href="/files/produtos.csv">Baixar Modelo</a></p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="/products/add_sheet" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label class="col-md-12">Arquivo</label>
                                                            <input name="data[Product][file_name]" type="file" id="input-file-max-fs" data-allowed-file-extensions="csv" class="dropify" data-max-file-size="5M" />
                                                            <input name="data[Product][anuncio_id]" type="hidden" value="<?php echo $result['Advertisement']['id'] ?>" />
                                                            <span for="input-file-max-fs" class="help-block with-errors">Apenas formato CSV permitido. Tamanho máximo: 5MB</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-info">Enviar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="m-b-40">

                                    <h3>Produtos já Cadastrados <?php //echo ( !empty($result['Product']) ? " (Total de " . count($result['Product']) . ")" : "") ?></h3>
                                    <div class="form-body">
                                        <table class="table-bordered table-hover table tablesaw-swipe">
                                            <thead>
                                            <tr>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" tablesaw-cell-persist">Descrição</th>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" tablesaw-cell-persist">UN</th>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" tablesaw-cell-persist">Preço Unitário</th>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" tablesaw-cell-persist">Origem</th>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="col-md-1 text-center">Ação</th>
                                            </tr>
                                            </thead>
                                            <tbody id="row_bt_add_product">
                                            <?php foreach ($result['Product'] as $item): ?>
                                                <tr id="<?php echo $item['id'] ?>" class="nlines_products">
                                                    <td><?php echo $item['nome'] ?></td>
                                                    <td><?php echo ucwords(strtolower($item['unidade'])) ?></td>
                                                    <td><?php echo $item['preco'] ?></td>
                                                    <td><?php echo ( $item['is_imported'] ? "Planilha" : "Manual" ) ?></td>
                                                    <td class="text-center"><a href=javascript:confirmDeleteItem(<?php echo $item['id'] ?>,'products') class="bt_del_product" rel=""><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php endforeach; unset($result['Product']); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


