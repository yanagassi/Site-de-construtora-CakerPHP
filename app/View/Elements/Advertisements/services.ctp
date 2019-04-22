                                    <form method="post" action="javascript:void(0)" data-toggle="validator" novalidate="true">
                                        <h3>Serviços</h3>
                                        <p class="text-muted">Informe todos os seus serviços de forma detalhada. Utilize um campo para cada serviço. Ex.: Reboco Interno, Pintura, Administração de Obras, Projeto Elétrico, Demolição, Terraplanagem, Reforma, etc.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-12">Serviço</label>
                                                    <input name="" id="add_service_name" type="text" class="form-control " placeholder="" maxlength="45" required data-error="Este campo é obrigatório. Mínimo de 3 caracteres" data-minlength="3">
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group text-center" style="margin-top:27px">
                                                    <a href="javascript:void(0)" id="bt_add_services" class="btn btn-primary btn-info">Adicionar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted">Adicionar Serviço (máximo de 50)</p>
                                        <a href="javascript:void(0)" id="bt_msg_limit_services" style="display:none" class="btn btn-primary btn-danger">Você atingiu o número máximo de disponível!</a>
                                        <a href="javascript:void(0)" id="bt_msg_empty_services" style="display:none" class="btn btn-primary btn-danger">Campos com * devem ser preenchidos</a>

                                        <hr>
                                        <br>

                                        <div class="form-body">
                                            <table class="table-bordered table-hover table tablesaw-swipe">
                                                <thead>
                                                <tr>
                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" class="col-md-6 tablesaw-cell-persist">Serviço Cadastrado</th>
                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="col-md-1 text-center">Ação</th>
                                                </tr>
                                                </thead>
                                                <tbody id="row_bt_add_service">
                                                <?php foreach ($result['Service'] as $item): ?>
                                                    <tr id="<?php echo $item['id'] ?>" class="nlines_services">
                                                        <td><?php echo $item['nome'] ?></td>
                                                        <td class="text-center"><a href=javascript:confirmDeleteItem(<?php echo $item['id'] ?>,'services') class="bt_del_service" rel=""><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function()
                                            {
                                                /* Add more services */
                                                $("#bt_add_services").on("click",function() {

                                                    if ( $('.nlines_services').length > 49 )
                                                    {
                                                        $("#bt_msg_limit_services").show(1000);

                                                        var sec = 3500;
                                                        setTimeout(function()
                                                        {
                                                            $("#bt_msg_limit_services").hide('blind');
                                                        }, sec);

                                                        return false;
                                                    }
                                                    else
                                                    {
                                                        var new_service_name = $("#add_service_name").val();
                                                        var html_service     = "";
                                                        var index_service    = "";

                                                        if ( new_service_name != "" )
                                                        {
                                                            $('.preloader').show(); // show loading process

                                                            // Data Ajax to Save New Phone
                                                            var formDataService =
                                                            {
                                                                "Service" :
                                                                {
                                                                    "anuncio_id" : <?php echo $result['Advertisement']['id'] ?>,
                                                                    "nome"       : new_service_name
                                                                }
                                                            }

                                                            if ( $( "#add_service_name").val().length < 3 )
                                                            {
                                                                return;
                                                            }

                                                            // add by ajax new phone number to table
                                                            $.ajax({
                                                                type: "POST",
                                                                dataType: "json",
                                                                url: "/services/ajax_add",
                                                                data: formDataService,
                                                                success: function (result)
                                                                {
                                                                    if ( result.status )
                                                                    {
                                                                        $('.preloader').hide(); // hidding process
                                                                        $('#flash-ajax-success').text(result.msg);
                                                                        $('#flash-ajax-success').show("slow").delay(2000);
                                                                        $("#flash-ajax-success").hide('blind');
                                                                        index_service = result.id;

                                                                        // insert new phone to table
                                                                        html_service =
                                                                            '<tr class="nlines_services" id="'+index_service+'">' +
                                                                            '<td>'+new_service_name+'</td>' +
                                                                            '<td class="text-center"><a href=javascript:confirmDeleteItem('+index_service+',"services") class="bt_del_service" rel="'+index_service+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>' +
                                                                            '</tr>';

                                                                        $( "#row_bt_add_service" ).prepend( html_service );
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
                                                            $("#add_service_name").val("");
                                                        }
                                                    }

                                                    $(".bt_del_service").click(function() {
                                                        id = $(this).attr('rel');
                                                        $( "#" + id ).remove();
                                                        $("#bt_msg_limit_services").hide(1000);
                                                    });

                                                    $("#bt_msg_limit_services").click(function() {
                                                        $("#bt_msg_limit_services").hide(1000);
                                                    });

                                                    $("#bt_msg_empty_services").click(function() {
                                                        $("#bt_msg_empty_services").hide(1000);
                                                    });
                                                });
                                            });
                                        </script>
                                    </form>