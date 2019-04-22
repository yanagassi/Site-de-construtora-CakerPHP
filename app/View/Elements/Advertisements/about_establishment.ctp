                                    <form method="post" action="javascript:void(0)">
                                        <hr class="m-b-40">
                                        <h3>Características do Estabelecimento</h3>
                                        <p class="text-muted">Adicionar Característica do Estabelecimento (máximo de 9)</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-12">Característica (Ex.: Aceitamos Todos os Cartões, Atendemos Pessoas Físicas e Jurídicas, etc.)</label>
                                                    <input name="" id="add_about_establishments_name" type="text" class="form-control " placeholder="" maxlength="45" required data-error="Este campo é obrigatório">
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group text-center" style="margin-top:27px">
                                                    <a href="javascript:void(0)" id="bt_add_about_establishments" class="btn btn-primary btn-info">Adicionar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" id="bt_msg_limit_about_establishments" style="display:none" class="btn btn-primary btn-danger">Você atingiu o número máximo de disponível!</a>
                                        <a href="javascript:void(0)" id="bt_msg_empty_about_establishments" style="display:none" class="btn btn-primary btn-danger">Campos com * devem ser preenchidos</a>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function()
                                            {
                                                /* Add more */
                                                $("#bt_add_about_establishments").on("click",function() {

                                                    if ( $('.nlines_about_establishments').length > 8 )
                                                    {
                                                        $("#bt_msg_limit_about_establishments").show(1000);

                                                        var sec = 3500;
                                                        setTimeout(function()
                                                        {
                                                            $("#bt_msg_limit_about_establishments").hide('blind');
                                                        }, sec);

                                                        return false;
                                                    }
                                                    else
                                                    {
                                                        var new_about_establishment_name = $("#add_about_establishments_name").val();
                                                        var html_about_establishments     = "";
                                                        var index_about_establishments    = "";

                                                        if ( new_about_establishment_name != "" )
                                                        {
                                                            $('.preloader').show(); // show loading process

                                                            // Data Ajax to Save New Phone
                                                            var formDataAboutEstablishment =
                                                            {
                                                                "AboutEstablishment" :
                                                                {
                                                                    "anuncio_id" : <?php echo $result['Advertisement']['id'] ?>,
                                                                    "name"       : new_about_establishment_name
                                                                }
                                                            }

                                                            // add by ajax new phone number to table
                                                            $.ajax({
                                                                type: "POST",
                                                                dataType: "json",
                                                                url: "/about_establishments/ajax_add",
                                                                data: formDataAboutEstablishment,
                                                                success: function (result)
                                                                {
                                                                    if ( result.status )
                                                                    {
                                                                        $('.preloader').hide(); // hidding process
                                                                        $('#flash-ajax-success').text(result.msg);
                                                                        $('#flash-ajax-success').show("slow").delay(2000);
                                                                        $("#flash-ajax-success").hide('blind');
                                                                        index_about_establishments = result.id;

                                                                        // insert new phone to table
                                                                        html_about_establishments =
                                                                            '<tr class="nlines_about_establishments" id="'+index_about_establishments+'">' +
                                                                            '<td>'+new_about_establishment_name+'</td>' +
                                                                            '<td class="text-center"><a href=javascript:confirmDeleteItem('+index_about_establishments+',"about_establishments") class="bt_del_about_establishments" rel="'+index_about_establishments+'"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>' +
                                                                            '</tr>';

                                                                        $( "#row_bt_add_about_establishments" ).prepend( html_about_establishments );
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
                                                            $("#add_about_establishments_name").val("");
                                                        }
                                                        else
                                                        {
                                                            $("#bt_msg_empty_about_establishments").show(1000);

                                                            var sec = 3500;
                                                            setTimeout(function()
                                                            {
                                                                $("#bt_msg_empty_about_establishments").hide('blind');
                                                            }, sec);

                                                            return false;
                                                        }
                                                    }

                                                    $(".bt_del_about_establishments").click(function() {
                                                        id = $(this).attr('rel');
                                                        $( "#" + id ).remove();
                                                        $("#bt_msg_limit_about_establishments").hide(1000);
                                                    });

                                                    $("#bt_msg_limit_about_establishments").click(function() {
                                                        $("#bt_msg_limit_about_establishments").hide(1000);
                                                    });

                                                    $("#bt_msg_empty_about_establishments").click(function() {
                                                        $("#bt_msg_empty_about_establishments").hide(1000);
                                                    });
                                                });
                                            });
                                        </script>
                                    </form>

                                    <hr class="m-b-40">

                                    <div class="form-body">
                                        <table class="table-bordered table-hover table tablesaw-swipe">
                                            <thead>
                                            <tr>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" class="col-md-6 tablesaw-cell-persist">Nome</th>
                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="col-md-1 text-center">Ação</th>
                                            </tr>
                                            </thead>
                                            <tbody id="row_bt_add_about_establishments">
                                            <?php foreach ($result['AboutEstablishment'] as $item): ?>
                                                <tr id="<?php echo $item['id'] ?>" class="nlines_about_establishments">
                                                    <td><?php echo $item['name'] ?></td>
                                                    <td class="text-center"><a href=javascript:confirmDeleteItem(<?php echo $item['id'] ?>,'about_establishments') class="bt_del_about_establishments" rel=""><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <br>
                                    <hr class="m-b-40">