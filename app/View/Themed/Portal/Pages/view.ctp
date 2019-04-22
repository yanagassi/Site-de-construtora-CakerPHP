<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 col-md-6_ order-md-1">
                    <div class="card animated fadeInUp animation-delay-7">
                        <?php
                        if ( $anuncios->Advertisement['foto_capa'] != null & file_exists( WWW_ROOT . "/uploads/anuncio/foto_capa/" . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['foto_capa'] ) )
                        {
                            $foto_capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/foto_capa/' . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['foto_capa'];
                            echo '<div class="property-slider no-arrows"><a href="'.$foto_capa.'" data-background-image="'.$foto_capa.'" class="item mfp-gallery"></a></div>';
                        }
                        else
                        {
                            $foto_capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/img/imagem_nao_encontrada_capa.png';
                        }
                        ?>

                        <div class="ms-hero-bg-dark ms-hero-img-coffee text-center" style="height: 192px; background-image:url(<?php echo $foto_capa; ?>)">
                            <h2 class="color-white index-1 text-center no-m pt-4" style="margin-top: -20px!important;margin-bottom:5px!important;">

                                <?php echo h($anuncios->Advertisement['titulo_anuncio']); ?>

                                <?php
                                if (count($anuncios->Rating))
                                {
                                    $avg_preco = array();
                                    $avg_prazo = array();
                                    $avg_qa    = array();

                                    // ToDo: To Refactoring this function
                                    foreach ($anuncios->Rating as $rating)
                                    {
                                        $avg_preco[] = $rating['preco'];
                                        $avg_prazo[] = $rating['prazo'];
                                        $avg_qa[]    = $rating['qualidade'];
                                    }

                                    $avg_preco = array_sum($avg_preco);
                                    $avg_prazo = array_sum($avg_prazo);
                                    $avg_qa    = array_sum($avg_qa);

                                    $divisor = ( count($anuncios->Rating) == 0 ? 1 : count($anuncios->Rating) );

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

                                    <a href="javascript:void(0)" class="color-warning" style="cursor:none">
                                        <h3><i class="fas fa-star" style="margin-right:-1px!important;"></i> <span><?php echo number_format($avg, 1, ',', ''); ?></span></h3>
                                    </a>

                                <?php } ?>


                            </h2>



                            <?php
                            if ( $anuncios->Advertisement['logo'] != null && file_exists( WWW_ROOT . "/uploads/anuncio/logo/" . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['logo'] ) )
                            {
                                $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/logo/' . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['logo'];
                            }
                            else
                            {
                                $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/img/imagem_nao_encontrada_logo.png';
                            }
                            ?>

                            <img src="<?php echo $logo ?>" alt="..." class="img-avatar-circle" style="border:solid 5px transparent!important;margin-top:<?php echo ( isset($is_mobile) && $is_mobile ) ? "-50px" : "-30px"  ?>">
                        </div>
                        <div class="card-body pt-6 text-justify">
                            <h4><?php echo h($anuncios->Advertisement['quem_somos']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <div class="text-center mb-2">
                        <!--<span class="ms-logo ms-logo-sm mr-1">M</span>-->
                        <h3 class="no-m ms-site-title">Informações <span>Gerais</span>
                        </h3>
                    </div>

                    <?php if (count($anuncios->Address)) { ?>

                        <address class="no-mb">
                            <?php $p=0; foreach ($anuncios->Phone as $telefone): if ($p < 4) { ?>
                                <h4><i aria-hidden="true" class="mr-1 <?php

                                    if ( $telefone['tipo'] == 'Whatsapp' )
                                    {
                                        $class_number = 'zmdi zmdi-whatsapp zmdi-hc-fw color-success';
                                    }
                                    elseif($telefone['tipo'] == 'Celular')
                                    {
                                        $class_number = 'zmdi zmdi-smartphone zmdi-hc-fw color-info';
                                    }
                                    else
                                    {
                                        $class_number = 'zmdi zmdi-phone zmdi-hc-fw color-warning';
                                    }
                                    echo $class_number ?>
                                    "></i> <?php echo $this->Custom->phoneMask($telefone['telefone']); ?></h4>
                            <?php } $p++; endforeach; ?>

                            <?php if ( !empty($anuncios->Address['email']) ) { ?>
                                <h4><i class="color-info-light zmdi zmdi-email mr-1"></i> <a href="mailto:<?php echo $anuncios->Address['email'] ?>"><?php echo $anuncios->Address['email'] ?></a></h4>
                            <?php } ?>

                            <?php if ( !empty($anuncios->Address['endereco']) ) { ?>
                                <h4><i class="color-danger-light zmdi zmdi-pin mr-1"></i> <a target="_blank" href="https://www.google.com.br/maps/place/<?php echo $anuncios->Address['endereco']; echo "+" . $anuncios->Address['numero']; echo '+' . $anuncios->Address['cidade']; echo "+" . $anuncios->Address['estado']; ?>"><?php echo $anuncios->Address['endereco']; echo ", " . $anuncios->Address['numero']; echo (!empty($anuncios->Address['complemento']) ? ' - ' . $anuncios->Address['complemento'] : ''); echo ' - Bairro: ' . $anuncios->Address['bairro']; echo ' - ' . $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado']; ?></a></h4>
                            <?php } ?>

                            <?php if ( !empty($anuncios->Address['cep']) ) { ?>
                                <h4><i class="color-warning-light zmdi zmdi-map mr-1"></i> Cep: <?php echo $this->Custom->cepMask($anuncios->Address['cep']); ?></h4>
                            <?php } ?>

                            <?php if ( !empty($anuncios->Advertisement['email']) ) { ?>
                                <h4><i class="color-royal mr-1 zmdi zmdi-email"></i>
                                    <a href="javascript:void(0)" id="get_hide_email" class="add_email_click" data-id="<?php echo $anuncios->Advertisement['id'] ?>">Ver email</a>
                                    <span id="bring_email"></span>
                                </h4>
                            <?php } ?>

                        </address>

                        <div class="text-center">
                            <?php if ($anuncios->SocialNetwork['linkedin']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['linkedin']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-linkedin">
                                    <i class="zmdi zmdi-linkedin"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['facebook']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['facebook']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-facebook">
                                    <i class="zmdi zmdi-facebook"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['twitter']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['twitter']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-twitter">
                                    <i class="zmdi zmdi-twitter"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['instagram']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['instagram']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-instagram">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['youtube']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['youtube']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md btn-youtube">
                                    <i class="zmdi zmdi-youtube"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['google_plus']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['google_plus']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-google btn-circle-xs mt-1 mr-1 no-mr-md">
                                    <i class="zmdi zmdi-google-plus"></i>
                                </a>
                            <?php } ?>

                            <?php if ($anuncios->SocialNetwork['site']) { ?>
                                <a href="<?php echo $anuncios->SocialNetwork['site']; ?>" target="_blank" class="btn-circle btn-circle-raised btn-circle-xs mt-1 mr-1 no-mr-md">
                                    <i class="fa fa-home color-success"></i>
                                </a>
                            <?php } ?>
                        </div>

                        <?php
//                        $endereco = str_replace(' ', '+', $anuncios->Address['endereco']) . ',' . $anuncios->Address['numero'] . ',' . str_replace(' ', '+', $anuncios->Address['bairro']);
//                        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $endereco . '&sensor=false');
//                        $output = json_decode($geocode);
//                        $lat = $output->results[0]->geometry->location->lat;
//                        $long = $output->results[0]->geometry->location->lng;
//                        $lat = str_replace(',', '.', $lat);
//                        $long = str_replace(',', '.', $long);
                        ?>



<!--                        <div id="propertyMap-container">-->
<!--                            <div id="propertyMap" data-latitude=--><?////= $lat; ?><!-- data-longitude=--><?////= $long; ?><!-->
<!--                </div>-->
<!--                            <a href="#" id="streetView">Street View</a>-->
<!---->
<!--                        </div>-->


                    <?php }else{ ?>
                        <address class="no-mb">
                            <p class="text-center">Nenhuma informação Disponível Ainda</p>
                        </address>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <br>
    <br>

    <h2 class="right-line no-mt mb-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Como Trabalhamos</h2>

    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card card-warning animated zoomInUp animation-delay-5" style="min-height:563px;">
                <div class="bg-warning">
                    <img src="/theme/Portal/assets/img/demo/partner_estab.png" alt="..." class="img-avatar-circle">
                </div>
                <div class="card-body pt-4 text-center">
                    <h4 class="color-warning">Sobre o Estabelecimento</h4>
                    <?php if (count($anuncios->AboutEstablishment)) { ?>
                        <!-- Widget -->
                        <div class="widget margin-bottom-40">
                            <?php foreach ($anuncios->AboutEstablishment as $item): ?>
                                <p><?php echo $item['name']; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-warning animated zoomInUp animation-delay-6" style="min-height:563px;">
                <div class="bg-warning"><img src="/theme/Portal/assets/img/demo/partner_hour_new.png" alt="..." class="img-avatar-circle"></div>
                <div class="card-body pt-4 text-center">
                    <h4 class="color-warning">Horários</h4>
                    <?php if (count($anuncios->OperatingHour)) { ?>
                        <!-- Widget -->
                        <div class="widget margin-bottom-40">
                            <?php foreach ($anuncios->OperatingHour as $expediente): ?>
                                <p><?php echo $expediente['dia_semana']; ?> das <?php echo $expediente['horario']; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card card-warning animated zoomInUp animation-delay-7" style="min-height:563px;">
                <div class="bg-warning"><img src="/theme/Portal/assets/img/demo/partner_payment.png" alt="..." class="img-avatar-circle"></div>
                <div class="card-body pt-4 text-center">
                    <h4 class="color-warning">Forma de Pagtos.</h4>
                    <?php if (count($anuncios->PaymentMethod)) { ?>
                        <?php foreach ($anuncios->PaymentMethod as $forma): ?>
                            <p><?php echo $forma['nome']; ?></p>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <?php if (count($anuncios->Service)) { ?>
    <br>
    <br>
    <h2 class="right-line no-mt mb-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Nossos Serviços</h2>
    <div class="row">
        <?php $x = 1; foreach ($anuncios->Service as $servico): if ($x < 16) { ?>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                <div class="ms-icon-feature wow flipInX animation-delay-4" style="visibility: visible; animation-name: flipInX;">
                    <div class="ms-icon-feature-icon">
                        <span class="ms-icon ms-icon-sm">
                            <i class="fas fa-users-cog"></i>
                        </span>
                    </div>
                    <div class="ms-icon-feature-content">
                        <h4 class="color-primary"><a href="/busca?termo=<?php echo $servico['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_services=servicos" title="Ver todos os resultados com a palavra: <?php echo $servico['nome']; ?>"><?php echo $servico['nome']; ?></a></h4>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php $x++; endforeach; ?>

        <?php if ( count($anuncios->Service) > 15 ) { ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
            <div class="ms-icon-feature wow flipInX animation-delay-4" style="visibility: visible; animation-name: flipInX;">
                <div class="ms-icon-feature-icon">
                    <span class="ms-icon ms-icon-sm">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                <div class="ms-icon-feature-content">
                    <h4 class="color-primary">
                        <a href="#" class="btnMoreServices" data-toggle="modal" data-target="#myModal6"> Ver Todos <div class="ripple-container"></div></a>
                    </h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="modal modal-warning" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg animated zoomIn animated-3x" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title color-default" id="myModalLabel">Todos os Nossos Serviços</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    $new_arr_service = array_chunk($anuncios->Service, 2);
                                    foreach ($new_arr_service as $servico): ?>
                                    <tr>
                                        <?php if ( isset($servico[0]['nome']) ) { ?>
                                        <td><a href="/busca?termo=<?php echo $servico[0]['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_services=servicos" title="Ver todos os resultados com a palavra: <?php echo $servico[0]['nome']; ?>"><?php echo $servico[0]['nome']; ?></a></td>
                                        <?php } ?>

                                        <?php if ( isset($servico[1]['nome']) ) { ?>
                                        <td><a href="/busca?termo=<?php echo $servico[1]['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_services=servicos" title="Ver todos os resultados com a palavra: <?php echo $servico[1]['nome']; ?>"><?php echo $servico[1]['nome']; ?></a></td>
                                        <?php } ?>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php } ?>

    <?php if (count($anuncios->Product)) { ?>
        <br>
        <br>
        <h2 class="right-line no-mt mb-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Nossos Produtos</h2>
        <div class="row">
            <?php $y = 1; foreach ($anuncios->Product as $produto): if ($y < 16) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                    <div class="ms-icon-feature wow flipInX animation-delay-4" style="visibility: visible; animation-name: flipInX;">
                        <div class="ms-icon-feature-icon">
                        <span class="ms-icon ms-icon-sm">
                            <i class="fas fa-box-open"></i>
                        </span>
                        </div>
                        <?php if ( ! $produto['is_imported'] ){ ?>
                        <div class="ms-icon-feature-content">
                            <h4 class="color-primary"><a href="/busca?termo=<?php echo $produto['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_product=produtos" title="Ver todos os resultados com a palavra: <?php echo $produto['nome']; ?>"><?php echo $produto['nome']; ?></a></h4>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php endif; ?>
            <?php $y++; endforeach; ?>
            <?php if ( count($anuncios->Product) > 15 ) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                    <div class="ms-icon-feature wow flipInX animation-delay-4" style="visibility: visible; animation-name: flipInX;">
                        <div class="ms-icon-feature-icon">
                    <span class="ms-icon ms-icon-sm">
                        <i class="fa fa-plus"></i>
                    </span>
                        </div>
                        <div class="ms-icon-feature-content">
                            <h4 class="color-primary">
                                <a href="#" class="btnMoreProducts" data-toggle="modal" data-target="#myModalProducts"> Ver Todos <div class="ripple-container"></div></a>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="modal modal-warning" id="myModalProducts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg animated zoomIn animated-3x" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title color-default" id="myModalLabel">Todos os Nossos Produtos</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <?php
                                        $new_arr_product = array_chunk($anuncios->Product, 2);
                                        foreach ($new_arr_product as $produto): ?>
                                            <tr>
                                                <?php if ( isset($produto[0]['nome']) ) { ?>
                                                    <td><a href="/busca?termo=<?php echo $produto[0]['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_product=produtos" title="Ver todos os resultados com a palavra: <?php echo $produto[0]['nome']; ?>"><?php echo $produto[0]['nome']; ?></a></td>
                                                <?php } ?>

                                                <?php if ( isset($produto[1]['nome']) ) { ?>
                                                    <td><a href="/busca?termo=<?php echo $produto[1]['nome']; ?>&cidade=<?php echo $anuncios->Address['cidade']; echo "/" . $anuncios->Address['estado'] ?>&type_product=produtos" title="Ver todos os resultados com a palavra: <?php echo $produto[1]['nome']; ?>"><?php echo $produto[1]['nome']; ?></a></td>
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>

    <?php if (count($anuncios->Photo)) { ?>
    <h2 class="right-line mt-6">Galeria de Fotos</h2>
    <div class="row">
        <div class="owl-dots"></div>
        <div class="owl-carousel owl-theme owl-loaded">
            <?php foreach ($anuncios->Photo as $foto):
                if ( file_exists( WWW_ROOT . "/uploads/anuncio/galeria/" . $foto['anuncio_id'] . '/' . $foto['foto'] ) ) { ?>
                <div class="card card-primary animation-delay-5">
                    <img class="owl-lazy" data-src="<?php echo Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] ?>/uploads/anuncio/galeria/<?php echo $foto['anuncio_id'] . '/' . $foto['foto'] ?>" alt="" class="img-fluid">
                </div>
                <?php }
            endforeach; ?>
        </div>
    </div>
    <br>
    <br>
    <?php } ?>

    <h2 class="right-line mt-6">Contato</h2>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="/pages/contact_partner">
                        <input type="hidden" name="data[Contato][to]" value="<?php echo $anuncios->Advertisement['email']; ?>">
                        <fieldset class="container">
                            <div class="form-group row is-empty">
                                <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Nome</label>
                                <div class="col-lg-9"><input name="data[Contato][nome]" type="text" class="form-control" placeholder="Nome" maxlength="50"></div>
                            </div>
                            <div class="form-group row is-empty">
                                <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-9"><input name="data[Contato][email]" type="email" class="form-control" placeholder="Email" maxlength="50" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$"></div>
                            </div>
                            <div class="form-group row is-empty">
                                <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Assunto</label>
                                <div class="col-lg-9"><input name="data[Contato][assunto]" type="text" class="form-control" placeholder="Assunto" maxlength="50"></div>
                            </div>
                            <div class="form-group row is-empty">
                                <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Telefone</label>
                                <div class="col-lg-9"><input name="data[Contato][telefone]" type="text" class="form-control cell" placeholder="Telefone" onkeypress="javascript:mascara(this,cell_mask)" maxlength="15"> </div>
                            </div>
                            <div class="form-group row is-empty">
                                <label for="textArea" class="col-lg-2 control-label">Menssagem</label>
                                <div class="col-lg-9"><textarea name="data[Contato][mensagem]" class="form-control" rows="9" placeholder="Mensagem..." maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-raised btn-primary">Enviar</button>
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-star"></i>Avaliar</h3>
                </div>
                <div class="card-body">
                    <div class="agent-widget">
                        <h4 style="margin: 5px 0px 6px 6px;">Preço</h4>
                        <div class="preco"></div>

                        <h4 style="margin: 13px 0px 6px 6px;">Prazo</h4>
                        <div class="prazo"></div>

                        <h4 style="margin: 13px 0px 6px 6px;">Qualidade</h4>
                        <div class="qualidade"></div>

                        <button id="enviarAvaliacao" type="submit" class="btn btn-raised btn-primary" style="margin-top:25px">Avaliar<div class="ripple-container"></div></button>
                    </div>
                </div>
            </div>

            <?php if ( $anuncios->Address['lat'] != false && $anuncios->Address['long'] ) { ?>
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-header">
                    <h3 class="card-title"><i class="zmdi zmdi-map"></i>Mapa</h3>
                </div>

                <div id="map" style="width:100%;height:300px;"></div>

                <script type="application/javascript">
                function initMap()
                {
                    var mapConfig = {lat: <?php echo $anuncios->Address['lat']; ?>, lng: <?php echo $anuncios->Address['long']; ?>};

                    var map = new google.maps.Map(document.getElementById('map'),
                        {
                            zoom: 15,
                            center: mapConfig
                        }
                    );

                    var contentString =
                        '<div id="content">'+
                            '<div id="siteNotice"></div>'+
                            '<h4><?php echo $anuncios->Advertisement["titulo_anuncio"]?></h4>'+
                            '<p><a target="_blank" href="https://www.google.com.br/maps/place/<?php echo $anuncios->Address['endereco']; echo "+" . $anuncios->Address['numero']; echo '+' . $anuncios->Address['cidade']; echo "+" . $anuncios->Address['estado']; ?>"><?php echo $anuncios->Address['endereco'] . ", " . $anuncios->Address['numero'] . ' ' . $anuncios->Address['cidade'] . "/" . $anuncios->Address['estado']; ?></a></p>'+
                        '</div>';

                    var infowindow = new google.maps.InfoWindow
                    (
                        {
                            content: contentString,
                            maxWidth : 200
                        }
                    );

                    var marker = new google.maps.Marker
                    (
                        {
                            position: mapConfig,
                            map: map,
                            title: '<?php echo $anuncios->Advertisement["titulo_anuncio"]?>'
                        }
                    );

                    marker.addListener('click', function(){
                        infowindow.open(map, marker);
                    });
                }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjyqGt52jKN4EwxsEgrTDp1s75dXdv9tM&callback=initMap"></script>
            </div>
            <?php } ?>

        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        // $("#light-slider").lightSlider();
    });

    // Register Click on Email
    $(".add_email_click").on("click",function () {
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
            url: "/dashboards/add_email_click",
            data: formDataPhone,
            success: function (result)
            {
                if ( result.status )
                {
                    console.log('email_registered');
                }
                else
                {
                    console.log('email_not_registered');
                }
            }
        });
    });

    $(".btnMoreServices").click(function(){
        $('.modalMoreServices').css('visibility','visible');
    });

    $(".btnMoreProducts").click(function(){
        $('.modalMoreProducts').css('visibility','visible');
    });


    function goBack() {
        window.history.back();
    }

    $(function () {
        $(".preco").rateYo({
            numStars: 5
        });
        $(".preco").rateYo("option", "starWidth", "20px");

        $(".prazo").rateYo({
            numStars: 5
        });
        $(".prazo").rateYo("option", "starWidth", "20px");

        $(".qualidade").rateYo({
            numStars: 5
        });

        $("a > #avaliacao").css('width','auto!important');
        $(".qualidade").rateYo("option", "starWidth", "20px");
        $("#avaliacao").rateYo("option", "starWidth", "20px");
    });

    $("#enviarAvaliacao").click(function(){
        var preco = $(".preco").rateYo("option", "rating");
        var prazo = $(".prazo").rateYo("option", "rating");
        var qualidade = $(".qualidade").rateYo("option", "rating");

        $.ajax({
            type:"POST",
            dataType: "json",
            data:{"preco":preco,"prazo":prazo,"qualidade" : qualidade, "anuncio_id":<?php echo $anuncios->Advertisement['id'] ?>,"IP":"<?php echo $_SERVER["REMOTE_ADDR"]; ?>"},
            url:"/advertisements/add_rating",
            success : function(data)
            {
                console.log(data);

                if(data.status == false)
                {
                    swal(
                        'Erro ao avaliar',
                        data.msg,
                        'error'
                    )
                }
                else
                {
                    swal(
                        'Obrigado por avaliar',
                        data.msg,
                        'success'
                    )
                }
            },
            error : function() {
                swal(
                    'Erro ao avaliar',
                    data.msg,
                    'error'
                )
            }
        });
    });

    // get hide email
    $('#get_hide_email').on('click',function() {

        $('#get_hide_email').text('carregando...');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/advertisements/get_email_advertisement/<?php echo $anuncios->Advertisement['id'] ?>",
            success: function (result)
            {
                if ( result.status )
                {
                    $('#bring_email').text(result.msg);
                    $('#get_hide_email').remove();
                }
                else
                {
                    $('#bring_email').text(result.msg);
                    $('#get_hide_email').remove();
                }
            }
        });

    });
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    function cell_mask(v) {
        v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
        v = v.replace(/(\d{0})(\d)/, "$1($2")    //Coloca ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{2})(\d)/, "$1) $2")    //Coloca ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{5})(\d)/, "$1-$2")    //Coloca ponto entre o setimo e o oitava dígitos
        return v
    }
</script>