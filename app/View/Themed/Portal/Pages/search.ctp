<?php echo $this->element('Page/search'); ?>

<div class="container">
    <?php if ( count($anuncios) > 0 ) { ?>
        <h1 class="mb-4">Resultados encontrados para: "<?php echo (!empty($this->request->query['termo']) ? $this->request->query['termo'] : ''); ?>" <span style="display:none">Quantidade: <?php echo count($anuncios); ?></span></h1>
    <?php } ?>

    <?php if ( count($anuncios) < 1 ) { ?>
        <h3>Nenhum resultado foi encontrado para: "<?php echo (!empty($this->request->query['termo']) ? $this->request->query['termo'] : ''); ?>"</h3>
        <p>Por favor, verifique se você digitou corretamente os termos de pesquisa e tente novamente.</p>
        <?php //echo ( !empty($avg) ? " | Preço Médio: R$ " . $avg : "" ) ?>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <?php
            //$sum += $result[0]['final_price'];}
            foreach ($anuncios as $anuncio) :

            ?>
            <div class="card mb-1">
                <table class="table table-responsive table-no-border vertical-center">
                    <tbody>
                    <tr>
                        <td class="" style="<?php echo ( isset($is_mobile) && $is_mobile ) ? "width:14%" : "width:14%"  ?>">
                            <a title="Ver mais" href="/<?php echo ( !empty($anuncio['Advertisement']['slug']) ? $anuncio['Advertisement']['slug'] : strtolower(Inflector::slug($anuncio['Advertisement']['titulo_anuncio'], '-')) . '-' . $anuncio['Advertisement']['id'] ) ; ?>" class="img-thumbnail_ withripple_ add_advertisement_click" data-id="<?php echo $anuncio['Advertisement']['id'] ?>" style="margin-bottom:0px">
                                <div class="thumbnail-container">
                                    <?php
                                    $logo = "";

                                    if ( $anuncio["Advertisement"]['logo'] != null && file_exists( WWW_ROOT . "/uploads/anuncio/logo/" . $anuncio["Advertisement"]['id'] . '/' . $anuncio["Advertisement"]['logo'] ) )
                                    {
                                        $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/logo/' . $anuncio["Advertisement"]['id'] . '/' . $anuncio["Advertisement"]['logo'];
                                    }
                                    else
                                    {
                                        $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/img/imagem_nao_encontrada_logo.png';
                                    }
                                    ?>
                                    <img src="<?php echo $logo ?>" alt="..." class="img-fluid_ img-avatar-circle" style="transform:none!important;<?php echo ( isset($is_mobile) && $is_mobile ) ? "width:70px!important;height:70px!important" : "width:94px;;height:94px!important;margin-left:0px;margin-right:-18px;"  ?>">
                                </div>
                                <div class="ripple-container"></div>
                            </a>

                            <?php if ( isset($is_mobile) && $is_mobile ) { ?>
<!--                                <a href="javascript:void(0)" class="btn-circle btn-circle-info">-->
<!--                                    <i class="zmdi zmdi-phone"></i>-->
<!--                                </a>-->
<!--                                <a href="javascript:void(0)" class="btn-circle btn-circle-default">-->
<!--                                    <i class="fas fa-plus-circle color-warning"></i>-->
<!--                                </a>-->
                            <?php } ?>

                        </td>
                        <td class="" width="70%">
                            <<?php echo ( isset($is_mobile) && $is_mobile ) ? "h5" : "h4"  ?> class="" style="margin-bottom:0px;margin-top:0px;vertical-align:top;font-weight:normal">
                                <a class="add_advertisement_click" data-id="<?php echo $anuncio['Advertisement']['id'] ?>" style="color:#000000;" href="/<?php echo ( !empty($anuncio['Advertisement']['slug']) ? $anuncio['Advertisement']['slug'] : strtolower(Inflector::slug($anuncio['Advertisement']['titulo_anuncio'], '-')) . '-' . $anuncio['Advertisement']['id'] ) ; ?>">
                                    <?php if ( !isset($is_mobile) ) { ?>
                                        <?php echo $anuncio['Advertisement']['titulo_anuncio']; ?>
                                    <?php }else{  ?>
                                        <?php $max=32; echo substr_replace($anuncio['Advertisement']['titulo_anuncio'], (strlen($anuncio['Advertisement']['titulo_anuncio']) > $max ? '...' : ''), $max) ?>
                                    <?php } ?>
                                </a>
                                <?php
                                $avg       = '';
                                if ( isset($anuncio['Rating']) && count($anuncio['Rating']) )
                                {
                                    $avg_preco = array();
                                    $avg_prazo = array();
                                    $avg_qa    = array();

                                    // ToDo: To Refactoring this function

                                    foreach ($anuncio['Rating'] as $rating)
                                    {
                                        $avg_preco[] = $rating['preco'];
                                        $avg_prazo[] = $rating['prazo'];
                                        $avg_qa[]    = $rating['qualidade'];
                                    }

                                    $avg_preco = array_sum($avg_preco);
                                    $avg_prazo = array_sum($avg_prazo);
                                    $avg_qa    = array_sum($avg_qa);

                                    $_cc = count($anuncio['Rating']);

                                    $divisor = ( count($anuncio['Rating']) > 0 ? count($anuncio['Rating']) : 1 );

                                    $avg_1 = $avg_preco / $divisor;
                                    $avg_2 = $avg_prazo / $divisor;
                                    $avg_3 = $avg_qa    / $divisor;

                                    $avg = $avg_1 + $avg_2 + $avg_3;

                                    $avg = $avg / 3;

                                    if ( $avg > 5 )
                                    {
                                        $avg = 5;
                                    }
                                ?>

                                    <a href="#" class="color-warning" style="float:right">
                                        <i class="mr-1 zmdi zmdi-star zmdi-hc-fw" style="margin-right:-1px!important;"></i>
                                        <span><?php echo number_format($avg, 1, ',', ''); ?></span>
                                    </a>

                                <?php } ?>

                            </<?php echo ( isset($is_mobile) && $is_mobile ) ? "h5" : "h4"  ?>>

                            <p style="<?php echo ( isset($is_mobile) && $is_mobile ) ? "font-size:12px" : ""  ?>">
                                <?php
                                if ( !empty($anuncio['Address']['endereco']) )
                                {
                                    echo $anuncio['Address']['endereco'] . ' ' . $anuncio['Address']['numero'];
                                    echo (!isset($is_mobile) && !empty($anuncio['Address']['endereco']) && !empty($anuncio['Address']['complemento']) ? ' - ' . $anuncio['Address']['complemento'] : '' );
                                    echo ' - '. $anuncio['Address']['cidade'] . '/' . $anuncio['Address']['estado'];
                                }
                                else
                                {
                                    echo "Endereço não informado.";
                                }
                                ?>
                                <br>
                                <script type="text/javascript">
                                $( document ).ready(function() {
                                    $('.btn_text').click(function() {
                                        $(this).text( $(this).data('value') );
                                    });
                                });
                                </script>

                                <?php if ( isset($is_mobile) && $is_mobile ) {  ?>
                                <a href="javascript:void(0)" class="btn btn-raised btn-xs btn-warning btn_change add_phone_click" data-id="<?php echo $anuncio['Advertisement']['id'] ?>" style="margin:0px"><i class="zmdi zmdi-phone"></i> <span class="btn_text" data-value="<?php echo (!empty($anuncio['Phone'][0]['telefone']) ? $this->Custom->phoneMask($anuncio['Phone'][0]['telefone']) : "Não Possui"); ?>">Ver Telefone</span><div class="ripple-container"></div></a>
                                <?php } ?>
                            </p>
                        </td>

                        <?php if ( !isset($is_mobile) ) {  ?>
                        <td width="16%">
                            <div class="ms-footer-col ms-footer-text-right">
                                <script type="text/javascript">
                                $( document ).ready(function() {
                                    $('.btn_text').click(function() {
                                        $(this).text( $(this).data('value') );
                                    });
                                });
                                </script>
                                <a class="btn btn-raised btn-primary btn_change add_phone_click" data-id="<?php echo $anuncio['Advertisement']['id'] ?>" href="javascript:void(0)" style="margin:0px"><i class="zmdi zmdi-phone"></i> <span class="btn_text" data-value="<?php echo (!empty($anuncio['Phone'][0]['telefone']) ? $this->Custom->phoneMask($anuncio['Phone'][0]['telefone']) : "Não Possui"); ?>">&nbsp;Ver Telefone</span><div class="ripple-container"></div></a>
                                <br>
                                <a class="btn btn-raised btn-default add_advertisement_click" data-id="<?php echo $anuncio['Advertisement']['id'] ?>" href="/<?php echo ( !empty($anuncio['Advertisement']['slug']) ? $anuncio['Advertisement']['slug'] : strtolower(Inflector::slug($anuncio['Advertisement']['titulo_anuncio'], '-')) . '-' . $anuncio['Advertisement']['id'] ) ; ?>"><i class="fas fa-plus-circle color-warning"></i> informações<div class="ripple-container"></div></a>
                            </div>
                        </td>
                        <?php } ?>

                        <td width="4%">&nbsp;</td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript">
    $( document ).ready(function(){
        $(".add_phone_click").on("click",function () {
            var formDataPhone =
            {
                "Report" :
                {
                    "advertisement_id" : $(this).data('id')
                }
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/dashboards/add_phone_click",
                data: formDataPhone,
                success: function (result)
                {
                    if ( result.status )
                    {
                        console.log('phone_registered');
                    }
                    else
                    {
                        console.log('phone_not_registered');
                    }
                }
            });
        });

        $(".add_advertisement_click").on("click",function () {
            var formDataPhone =
            {
                "Report" :
                {
                    "advertisement_id" : $(this).data('id')
                }
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/dashboards/add_advertisement_click",
                data: formDataPhone,
                success: function (result)
                {
                    if ( result.status )
                    {
                        console.log('advertisement_clicked_registered');
                    }
                    else
                    {
                        console.log('advertisement_clicked_not_registered');
                    }
                }
            });
        });
    });
    </script>

    <?php echo $this->element('Page/pagination'); ?>

</div>