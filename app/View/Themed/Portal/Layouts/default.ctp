<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <meta name="google-site-verification" content="60Hy4elgHLeHrBo54tW9afhsZEenDp7XiWBGDiKlseI" />

    <title><?php echo Configure::read('BRAND') ." - ". Configure::read('BRAND_SLOGAN') ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo Configure::read('BRAND_SLOGAN') ?>. Vejas algumas vantagens de se utilizar a construlista. Faça uma busca. Tudo para sua obra, reforma ou manutenção. Todas as empresas e profissionais em um só local. Faça uma busca. Ganhe tempo.">

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/theme/portal/assets/css/preload.min.css">
    <link rel="stylesheet" href="/theme/portal/assets/css/plugins.min.css">
    <link rel="stylesheet" href="/theme/portal/assets/css/style.orange-500.min.css">
    <link rel="stylesheet" href="/theme/portal/assets/css/construlista.css">
    <link rel="stylesheet" href="/theme/portal/assets/css/width-boxed.min.css" id="ms-boxed" disabled="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/plugins.min.js"></script>

    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

    <!--[if lt IE 9]>
    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/html5shiv.min.js"></script>
    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/app.min.js"></script>
    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/configurator.min.js"></script>

    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/home-generic-3.js"></script>
    <script src="/theme/portal/assets/js/jquery.maskedinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/component-carousels.js"></script>
    <script src="https://agmstudio.io/themes/material-style/2.3.2/assets/js/index.js"></script>

    <!-- For available stars -->
    <script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js"></script>

    <!-- All Javascript Plugin File here -->
    <?php

        echo $this->Html->script(array
        (
             //'/assets/js/validador'
        )
    );
    ?>

</head>

<body>

<?php echo $this->Flash->render() ?>
<?php echo $this->Flash->render('ajax-portal-error') ?>
<?php echo $this->Flash->render('ajax-portal-success') ?>

<div id="ms-preload" class="ms-preload">
    <div id="status">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>

<div class="ms-site-container">

    <?php echo $this->element('Page/menu'); ?>

    <?php
    if ( $this->name == "Pages" && $this->view == 'index' )
    {
        echo $this->element('Page/search');
    }
    ?>

    <?php echo $this->fetch('content'); ?>

    <?php echo $this->element('Page/footer') ?>


    <footer class="ms-footer">
        <div class="container">
            <p>Copyright &copy; Construlista <?php echo date('Y') ?></p>
        </div>
    </footer>
    <div class="btn-back-top">
        <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised ">
            <i class="zmdi zmdi-long-arrow-up"></i>
        </a>
    </div>
</div>

<div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
    <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">
            <div class="ms-slidebar-login">
                <a href="/login" class="withripple"><i class="zmdi zmdi-account"></i>Entrar</a>
                <a href="/cadastro" class="withripple"><i class="zmdi zmdi-account-add"></i>Cadastrar</a>
            </div>
            <div class="ms-slidebar-title">
                <div class="ms-slidebar-t">
                    <img src="/theme/Portal/assets/img/logo-full-1.png" width="140" alt="">
                </div>
            </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
            <li class="card" role="tab" id="sch1">
                <a class="link" href="/"><i class="zmdi zmdi-home"></i>Início</a>
            </li>
            <li class="card" role="tab" id="sch2">
                <a class="link" href="/quem-somos"><i class="zmdi zmdi-desktop-mac"></i>Quem Somos</a>
            </li>
            <li class="card" role="tab" id="sch4">
                <a class="link" href="/vantagens"><i class="zmdi zmdi-time"></i>Vantagens</a>
            </li>
            <li class="card" role="tab" id="sch5">
                <a class="link" href="/planos"><i class="icon ion-ios-list-box"></i>Planos</a>
            </li>
            <li class="card">
                <a class="link" role="button" href="/contato" aria-expanded="false" aria-controls="sc6"><i class="mr-1 zmdi zmdi-email zmdi-hc-fw"></i>Contato</a>
            </li>
        </ul>
        <div class="ms-slidebar-social ms-slidebar-block">
            <h4 class="ms-slidebar-block-title">Social Links</h4>
            <div class="ms-slidebar-social">
                <a href="https://www.facebook.com/construlista.com.br" target="_blank" class="btn-circle btn-circle-raised btn-facebook">
                    <i class="zmdi zmdi-facebook"></i>
                    <div class="ripple-container"></div>
                </a>
                <a href="https://www.instagram.com/construlista/" target="_blank" class="btn-circle btn-circle-raised btn-instagram">
                    <i class="zmdi zmdi-instagram"></i>
                    <div class="ripple-container"></div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    div.city > div.bootstrap-select
    {
        margin-top: 0px;
    }
    button.dropdown-toggle
    {
        color:white!important;
    }
</style>

<script type="application/javascript">


    $( document ).ready(function() {

        // hide box alert
        var sec = 3500;
        setTimeout(function()
        {
            $("#flashMessage").hide('blind');
            $("#flash-success").hide('blind');
            $("#flash-ajax-error").hide('blind');
            $("#flash-ajax-success").hide('blind');
        }, sec);


        $(".rateYo").rateYo({
            readOnly: true
        });
        $(".rateYo").rateYo("option", "starWidth", "20px");


        $( "#btn_search" ).click(function() {
            var title = $('.dropdown-toggle').prop('title');
            $('#city_setted').val(title);
        });

        $('li.inicio').removeClass('active');

        // show and hide left menu mobile/responsive
//        $('body').children().click(function(){
//            event.preventDefault();
//            $(this).children('#ms-slidebar').slideToggle('slow');
//        });

        $(".bootstrap-select").css('margin-top','0');

        // show header full if diff mobile
        if( ! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
        {
            $('header.ms-header').removeClass('d-none');
        }

        // control nav-bar with full top header
        $('nav.navbar').removeClass('navbar-mode');
        $('nav.navbar').removeClass('ms-navbar-primary');
        $('header.ms-header').removeClass('ms-header-primary');

        <?php

        // control active menu

        $active = "";

        $routes = explode('/', $this->Html->url());

        if ( $routes[1] == "" )
        {
            echo "$('li.inicio').addClass('active')";
        }
        elseif ( $routes[1] == "quem-somos" )
        {
            echo "$('li.quem-somos').addClass('active')";
        }
        elseif ( $routes[1] == "vantagens-em-anunciar" )
        {
            echo "$('li.vantagens').addClass('active')";
        }
        elseif ( $routes[1] == "planos" )
        {
            echo "$('li.planos').addClass('active')";
        }
        elseif ( $routes[1] == "contato" )
        {
            echo "$('li.contato').addClass('active')";
        }
        elseif ( $routes[1] == "entrar" || $routes[1] == "login" )
        {
            echo "$('li.login').addClass('active')";
        }
        elseif ( $routes[1] == "cadastro" )
        {
            echo "$('li.cadastro').addClass('active')";
        }

        ?>
    });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122820265-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-122820265-1');
</script>

</body>
</html>