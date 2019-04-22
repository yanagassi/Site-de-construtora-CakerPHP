                                    <form method="post" action="javascript:void(0)">
                                        <h3>Formas de Pagamento</h3>
                                        <p class="text-muted">Adicionar Meio de Pagamento (máximo de 9)</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-12">Forma de Pagamento (Ex.: Cartão de Crédito, Boleto Bancário, Transf. Bancária)</label>
                                                    <input name="" id="add_payment_method_name" type="text" class="form-control " placeholder="" maxlength="45" required data-error="Este campo é obrigatório">
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group text-center" style="margin-top:27px">
                                                    <a href="javascript:void(0)" id="bt_add_payment_methods" class="btn btn-primary btn-info">Adicionar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" id="bt_msg_limit_payment_methods" style="display:none" class="btn btn-primary btn-danger">Você atingiu o número máximo de disponível!</a>
                                        <a href="javascript:void(0)" id="bt_msg_empty_payment_methods" style="display:none" class="btn btn-primary btn-danger">Campos com * devem ser preenchidos</a>

                                        <hr class="m-b-40">

                                        <div class="form-body">
                                            <table class="table-bordered table-hover table tablesaw-swipe">
                                                <thead>
                                                <tr>
                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" class="col-md-6 tablesaw-cell-persist">Nome</th>
                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="col-md-1 text-center">Ação</th>
                                                </tr>
                                                </thead>
                                                <tbody id="row_bt_add_payment_method">
                                                <?php foreach ($result['PaymentMethod'] as $item): ?>
                                                    <tr id="<?php echo $item['id'] ?>" class="nlines_payment_methods">
                                                        <td><?php echo $item['nome'] ?></td>
                                                        <td class="text-center"><a href=javascript:confirmDeleteItem(<?php echo $item['id'] ?>,'payment_methods') class="bt_del_payment_method" rel=""><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function()
                                            {
                                                /* Add more payment methods */
                                                $("#bt_add_payment_methods").on("click",function() {

                                                    if ( $('.nlines_payment_methods').length > 8 )
                                                    {
                                                        $("#bt_msg_limit_payment_methods").show(1000);

                                                        var sec = 3500;
                                                        setTimeout(function()
                                                        {
                                                            $("#bt_msg_limit_payment_methods").hide('blind');
                                                        }, sec);

                                                        return false;
                                                    }
                                                    else
                                                    {
                                                        var new_payment_method_name = $("#add_payment_method_name").val();
                                                        var html_payment_method     = "";
                                                        var index_payment_method    = "";

                                                        if ( new_payment_method_name != "" )
                                                        {
                                                            $('.preloader').show(); // show loading process

                                                            // Data Ajax to Save New Phone
                                                            var formDataPaymentMethod =
                                                            {
                                                                "PaymentMethod" :
                                                                {
                                                                    "anuncio_id" : <?php echo $result['Advertisement']['id'] ?>,
                                                                    "nome"       : new_payment_method_name
                                                                }
                                                            }

                                                            // add by ajax new phone number to table
                                                            $.ajax({
                                                                type: "POST",
                                                                dataType: "json",
                                                                url: "/payment_methods/ajax_add",
                                                                data: formDataPaymentMethod,
                                                                success: function (result)
                                                                {
                                                                    if ( result.status )
                                                                    {
                                                                        $('.preloader').hide(); // hidding process
                                                                        $('#flash-ajax-success').text(result.msg);
                                                                        $('#flash-ajax-success').show("slow").delay(2000);
                                                                        $("#flash-ajax-success").hide('blind');
                                                                        index_payment_method = result.id;

                                                                        // insert new phone to table
                                                                        html_payment_method =
                                                                            '<tr class="nlines_payment_methods" id="'+index_payment_method+'">' +
                                                                            '<td>'+new_payment_method_name+'</td>' +
                                                                            '<td class="text-center"><a href=javascript:confirmDeleteItem('+index_payment_method+',"payment_methods") class="bt_del_payment_method" rel="'+index_payment_method+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>' +
                                                                            '</tr>';

                                                                        $( "#row_bt_add_payment_method" ).prepend( html_payment_method );
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
                                                            $("#add_payment_method_name").val("");
                                                        }
                                                        else
                                                        {
                                                            $("#bt_msg_empty_payment_methods").show(1000);

                                                            var sec = 3500;
                                                            setTimeout(function()
                                                            {
                                                                $("#bt_msg_empty_payment_methods").hide('blind');
                                                            }, sec);

                                                            return false;
                                                        }
                                                    }

                                                    $(".bt_del_payment_method").click(function() {
                                                        id = $(this).attr('rel');
                                                        $( "#" + id ).remove();
                                                        $("#bt_msg_limit_payment_methods").hide(1000);
                                                    });

                                                    $("#bt_msg_limit_payment_methods").click(function() {
                                                        $("#bt_msg_limit_payment_methods").hide(1000);
                                                    });

                                                    $("#bt_msg_empty_payment_methods").click(function() {
                                                        $("#bt_msg_empty_payment_methods").hide(1000);
                                                    });
                                                });
                                            });
                                        </script>
                                    </form>
                                    <br>
                                    <hr class="m-b-40">