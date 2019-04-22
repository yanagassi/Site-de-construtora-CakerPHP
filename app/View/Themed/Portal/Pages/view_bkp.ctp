<?php

//debug(json_encode($anuncio, JSON_PRETTY_PRINT));
//debug($anuncio);

//echo "<pre>";
//print_r($anuncio);
//echo "</pre>";
//
//exit();

?>
<?php //if ( count($anuncios) > 0 ) {

$sum = 0;
//foreach ( $anuncios as $result ) {

    //$sum += $result->final_price;

    ?>

    <div id="titlebar" class="property-titlebar margin-bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <a href="#" onclick="goBack()" class="back-to-listings"></a>
                    <div class="property-title">
                        <div class="col-md-3">
                            <?php

                            $logo = "";

                            if ( file_exists( WWW_ROOT . "/uploads/anuncio/logo/" . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['logo'] ) )
                            {
                                $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/logo/' . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['logo'];
                            }
                            else
                            {
                                $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/img/imagem_nao_encontrada_logo.png';
                            }
                            ?>
                            <img src="<?php echo $logo ?>" style="width: 200px" alt="">
                        </div>
                        <div class="col-md-6">
                            <h2><?php echo h($anuncios->Advertisement['titulo_anuncio']); ?></h2>
                            <span>
                            <a href="#location" class="listing-address">
                                <div id="avaliacao"></div>
                            </a>
                        </span>
                        </div>
                        <div class="col-md-1">

                        </div>
                    </div>

                    <div class="property-pricing">
                        <?php foreach ($anuncios->Phone as $telefone): ?>
                            <div><?php echo $this->Custom->phoneMask($telefone['telefone']); ?></div>

                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php if ($anuncios->Advertisement['foto_capa'] !== null) { ?>
        <div class="container">
            <div class="row margin-bottom-50">
                <div class="col-md-12">

                    <!-- Slider Container -->
                    <div class="property-slider-container">
                        <?php

                        $foto_capa = "";

                        if ( file_exists( WWW_ROOT . "/uploads/anuncio/foto_capa/" . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['foto_capa'] ) )
                        {
                            $foto_capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/foto_capa/' . $anuncios->Advertisement['id'] . '/' . $anuncios->Advertisement['foto_capa'];
                            echo '<div class="property-slider no-arrows"><a href="'.$foto_capa.'" data-background-image="'.$foto_capa.'" class="item mfp-gallery"></a></div>';
                        }
                        elseif ( $anuncios->Advertisement["file_foto_capa_binary"] != null )
                        {
                            $uniqid = 'logo';
                            define('UPLOAD_DIR', WWW_ROOT . "/uploads/anuncio/foto_capa/" . $anuncios->Advertisement['id'] . '/');
                            $image_base64 = base64_decode($anuncios->Advertisement["file_foto_capa_binary"]);
                            $file = UPLOAD_DIR . $uniqid . '.' . $anuncios->Advertisement["file_foto_capa_type"];
                            file_put_contents($file, $image_base64);
                            $foto_capa = "data:image/".$anuncios->Advertisement["file_foto_capa_type"].";base64,".$anuncios->Advertisement["file_foto_capa_binary"];
                            echo '<div class="property-slider no-arrows"><a href="'.$foto_capa.'" data-background-image="'.$foto_capa.'" class="item mfp-gallery"></a></div>';
                        }
                        else
                        {
                            $foto_capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/img/imagem_nao_encontrada_logo.png';
                        }


//                        $path           = WWW_ROOT . "uploads/anuncio/foto_capa/" . $anuncios->Advertisement['id'] . '/';
//                        $find_foto_capa = glob($path . '*.{jpg,jpeg,gif,png}', GLOB_BRACE);
//
//                        if ( $find_foto_capa && file_exists( $find_foto_capa[0] ) )
//                        {
//                            $file      = end(explode('/',$find_foto_capa[0]));
//                            $foto_capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/foto_capa/' . $anuncios->Advertisement['id'] . '/' . $file;
//                            echo '<div class="property-slider no-arrows"><a href="'.$foto_capa.'" data-background-image="'.$foto_capa.'" class="item mfp-gallery"></a></div>';
//                        }
//                        elseif ( $anuncios->Advertisement["file_foto_capa_binary"] != null )
//                        {
//                            $foto_capa = "data:image/".$anuncios->Advertisement["file_foto_capa_type"].";base64,".$anuncios->Advertisement["file_foto_capa_binary"];
//                            echo '<div class="property-slider no-arrows"><a href="'.$foto_capa.'" data-background-image="'.$foto_capa.'" class="item mfp-gallery"></a></div>';
//                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row">

            <!-- Property Description -->
            <div class="col-lg-8 col-md-7">
                <div class="property-description">
                    <?php if ($anuncios->Advertisement['quem_somos'] !== "") { ?>
                        <!-- Description -->
                        <h3 class="desc-headline"><i class="im im-icon-Bulleted-List"></i> Quem Somos</h3>
                        <div class="show-more">
                            <p>
                                <?php echo h($anuncios->Advertisement['quem_somos']); ?>
                            </p>

                            <a href="#" class="show-more-button">Leia Mais <i class="fa fa-angle-down"></i></a>
                        </div>
                    <?php } ?>

                    <?php if (count($anuncios->Photo)) { ?>
                        <h3 class="desc-headline"><i class="im im-icon-Photos"></i>Galeria</h3>
                        <ul id="light-slider">
                            <?php foreach ($anuncios->Photo as $foto):
                                if ( file_exists( WWW_ROOT . "/uploads/anuncio/galeria/" . $foto['anuncio_id'] . '/' . $foto['foto'] ) )
                                {
                                    ?>
                                    <li>
                                        <a rel="gallery-1" href="<?php echo Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] ?>/uploads/anuncio/galeria/<?php echo $foto['anuncio_id'] . '/' . $foto['foto'] ?>" class="swipebox">
                                            <img src="<?php echo Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] ?>/uploads/anuncio/galeria/<?php echo $foto['anuncio_id'] . '/' . $foto['foto'] ?>" alt="image">
                                        </a>
                                    </li>
                                <?php
                                }
                                elseif ( $foto['foto_binary'] !== null )
                                {
                                    $foto_capa = "data:image/".$foto["foto_type"].";base64,".$foto["foto_binary"];
                                    ?>
                                    <img src="<?php echo $foto_capa ?>" alt="image">
                                <?php
                                }
                            endforeach; ?>
                        </ul>
                    <?php } ?>

                    <?php if (count($anuncios->Service)) { ?>
                        <!-- Features -->
                        <h3 class="desc-headline"><i class="im im-icon-Engineering"></i> Serviços</h3>
                        <ul class="property-features checkboxes margin-top-0">
                            <?php foreach ($anuncios->Service as $servico): ?>
                                <li><?php echo $servico['nome']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                    <?php
                    if (count($anuncios->Product)) { ?>
                        <h3 class="desc-headline"><i class="im im-icon-Shopping-Cart"></i> Produtos</h3>
                        <ul class="property-features checkboxes margin-top-0">

                            <?php foreach ($anuncios->Product as $produto):
                                if ( ! $produto['is_imported'] ){
                                ?>
                                <li><?php echo $produto['nome']; ?></li>

                            <?php } endforeach; ?>
                        </ul>

                    <?php } ?>

                    <?php if (count($anuncios->Address)) { ?>
                        <!-- Location -->
                        <h3 class="desc-headline no-border" id="location"><i class="im im-icon-Map2" aria-hidden="true"></i>
                            Localização</h3>


                        Cep: <?php echo $anuncios->Address['cep']; ?> |
                        Endereço: <?php echo $anuncios->Address['endereco']; ?>, <?php echo $anuncios->Address['numero']; ?> |
                        Bairro: <?php echo $anuncios->Address['bairro']; ?> |
                        <?php echo $anuncios->Address['cidade']; ?>/<?php echo $anuncios->Address['estado']; ?>

                        <?php
                        $endereco = str_replace(' ', '+', $anuncios->Address['endereco']) . ',' . $anuncios->Address['numero'] . ',' . str_replace(' ', '+', $anuncios->Address['bairro']);
                        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $endereco . '&sensor=false');
                        $output = json_decode($geocode);
                        $lat = $output->results[0]->geometry->location->lat;
                        $long = $output->results[0]->geometry->location->lng;
                        $lat = str_replace(',', '.', $lat);
                        $long = str_replace(',', '.', $long);
                        ?>



                        <div id="propertyMap-container">
                            <div id="propertyMap" data-latitude=<?= $lat; ?> data-longitude=<?= $long; ?>></div>
                            <a href="#" id="streetView">Street View</a>

                        </div>
                        <br>
                    <?php } ?>

                </div>
            </div>
            <!-- Property Description / End -->


            <!-- Sidebar -->
            <div class="col-lg-4 col-md-5">
                <div class="sidebar sticky right">

                    <!-- Widget -->
                    <div class="widget margin-bottom-35">
                        <!--                    <button class="widget-button"><i class="sl sl-icon-printer"></i> Imprimir</button>-->

                    </div>
                    <!-- Widget / End -->

                    <div class="widget margin-bottom-40">
                            <div class="row">
                                <?php if ($anuncios->SocialNetwork['facebook']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['facebook']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></h3></div>
                                <?php } ?>

                                <?php if ($anuncios->SocialNetwork['twitter']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['twitter']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></h3>
                                    </div>
                                <?php } ?>

                                <?php if ($anuncios->SocialNetwork['instagram']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['instagram']; ?>" target="_blank"><i class="fa fa-instagram " aria-hidden="true"></i></a></h3></div>
                                <?php } ?>

                                <?php if ($anuncios->SocialNetwork['youtube']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['youtube']; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></h3></div>
                                <?php } ?>

                                <?php if ($anuncios->SocialNetwork['google_plus']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['google_plus']; ?>" target="_blank"><i class="fa fa-google-plus " aria-hidden="true"></i> </a></h3></div>
                                <?php } ?>

                                <?php if ($anuncios->SocialNetwork['site']) { ?>
                                    <div class="col-md-2 col-sm-3"><h3><a href="<?php echo $anuncios->SocialNetwork['site']; ?>" target="_blank"><i class="fa fa-home" aria-hidden="true"></i></a></h3></div>
                                <?php } ?>
                            </div>
                    </div>

                    <?php if (count($anuncios->OperatingHour)) { ?>
                        <!-- Widget -->
                        <div class="widget margin-bottom-40">
                            <h3 class="margin-top-0 margin-bottom-35"><i class="im im-icon-Over-Time"aria-hidden="true"></i> Horário de Funcionamento</h3>
                            <?php foreach ($anuncios->OperatingHour as $expediente): ?>
                                <p><?php echo $expediente['dia_semana']; ?> das <?php echo $expediente['horario']; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>


                    <?php if (count($anuncios->PaymentMethod)) { ?>
                        <div class="widget margin-bottom-40">
                            <h3 class="margin-top-0 margin-bottom-35"><i class="im im-icon-Money-2" aria-hidden="true"></i>
                                Formas de Pagamento</h3>
                            <p>    <?php foreach ($anuncios->PaymentMethod as $forma): ?>
                                    <?php echo $forma['nome']; ?>
                                <?php endforeach; ?></p>
                        </div>
                    <?php } ?>

                    <div class="agent-widget">
                        <div class="agent-title" style="margin-bottom:-15px;top: -20px;">
                            <h3><i class="sl sl-icon-star" aria-hidden="true"></i> Avaliar</h3>
                            <div class="clearfix"></div>
                        </div>

                        <p style="margin: 13px 0px 6px;">Preço</p>
                        <div class="preco"></div>

                        <p style="margin: 13px 0px 6px;">Prazo</>
                        <div class="prazo"></div>

                        <p style="margin: 13px 0px 6px;">Qualidade</p>
                        <div class="qualidade"></div>

                        <button id="enviarAvaliacao" class="button fullwidth margin-top-5" style="top: 15px;">Avaliar</button>
                    </div>


                    <!-- Agent Widget -->
                    <div class="agent-widget">
                        <div class="agent-title">
                            <h4><a href="#">Entre em Contato</a></h4>
                            <div class="clearfix"></div>
                        </div>

                        <input type="text" placeholder="Email"
                               pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
                        <input type="text" placeholder="Telefone">
                        <textarea>Mensagem</textarea>
                        <button class="button fullwidth margin-top-5">Enviar</button>
                    </div>
                    <!-- Agent Widget / End -->


                    <!-- Widget / End -->

                </div>
            </div>
            <!-- Sidebar / End -->

        </div>
    </div>


<script>
    $(document).ready(function () {
        // $("#light-slider").lightSlider();
    });

    function goBack() {
        window.history.back();
    }

    (function ($) {

        $('.swipebox').swipebox();
        $("#light-slider").lightSlider({
            item: 3,
            loop: true,
            // gallery: true,
            controls: true
            // nextHtml : '<i class="im im-icon-Arrow-RighttinCircle"></i>',
            // prevHtml: '<i class="im im-icon-Photos"></i>'

        });

    })(jQuery);

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

        <?php
        $avg_preco = array();
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

        $avg = ($avg_preco + $avg_prazo + $avg_qa) / 3;

        if ( $avg > 5 )
        {
            $avg = 5;
        }

        ?>

        $("#avaliacao").rateYo({
            rating: "<?php echo empty($avg) ?  0 : $avg ?>",
            readOnly: true
        });

        $(".qualidade").rateYo("option", "starWidth", "20px");
        $("#avaliacao").rateYo("option", "starWidth", "20px");
    });

    $("#enviarAvaliacao").click(function(){
        var preco = $(".preco").rateYo("option", "rating");
        var prazo = $(".prazo").rateYo("option", "rating");
        var qualidade = $(".qualidade").rateYo("option", "rating");

        $.ajax({
            type:"POST",
            data:{"preco":preco,"prazo":prazo,"qualidade" : qualidade, "anuncio_id":<?php echo $anuncios->Advertisement['id'] ?>,"IP":"<?php echo $_SERVER["REMOTE_ADDR"]; ?>"},
            url:"/advertisements/add_rating",
            success : function(data)
            {
                console.log(data);

                if(data)
                {
                    swal(
                        'Obrigado por avaliar',
                        'Sua avaliação e muito importante, principalmente para que outros usuários possam analisar as melhores empresas, produtos e serviços',
                        'success'
                    )
                }
                else
                {
                    swal(
                        'Erro ao avaliar',
                        'Você já avaliou este anúncio.',
                        'error'
                    )
                }
            },
            error : function() {
                swal(
                    'Erro ao avaliar',
                    'Ocorreu um erro ao tentar avaliar este anúncio. Por favor tente mais tarde.',
                    'error'
                )
            }
        });
    });
</script>