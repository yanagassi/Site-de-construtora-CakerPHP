<header class="ms-header ms-header-white">
    <!--ms-header-primary-->
    <div class="container container-full">
        <div class="ms-title">
            <a href="/">
                <img src="/theme/portal/assets/img/logo-full-1.png" class="responsive" width="250" alt="">
            </a>
        </div>

        <?php if ( AuthComponent::user('id') < 1 ) { ?>
        <div class="header-right">
            <a title="Login" href="/login/" class="btn btn-raised btn-default">Login<div class="ripple-container"></div></a>
        </div>
        <div class="header-right mr-3">
            <a title="Cadastrar" href="/cadastro/" class="btn btn-raised btn-primary" id="register_news_email">Cadastrar<div class="ripple-container"></div></a>
        </div>
        <?php } ?>

    </div>
</header>
<nav class="navbar navbar-expand-md navbar-static ms-navbar ms-navbar-primary">
    <div class="container container-full">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src="/theme/Portal/assets/img/logo-full-3.png" width="150" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="ms-navbar">
            <ul class="navbar-nav">
                <li class="nav-item inicio">
                    <a href="/" class="nav-link animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="" title="Início">Início</a>
                </li>
                <li class="nav-item quem-somos">
                    <a href="/quem-somos/" class="nav-link animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="" title="Quem Somos">Quem Somos</a>
                </li>
                <li class="nav-item vantagens">
                    <a href="/vantagens/" class="nav-link animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="" title="Vantagens">Vantagens</a>
                </li>
                <li class="nav-item planos">
                    <a href="/planos/" class="nav-link animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="" title="Planos">Planos</a>
                </li>
                <li class="nav-item contato">
                    <a href="/contato/" class="nav-link animated fadeIn animation-delay-8" role="button" aria-haspopup="true" aria-expanded="false" data-name="" title="Contato">Contato</a>
                </li>

                <?php if ( AuthComponent::user('id') > 0 ) { ?>
                    <li class="nav-item entrar">
                        <a href="/painel/dashboard/" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce" title="Painel">Painel</a>
                    </li>
                    <li class="nav-item painel">
                        <a href="/sair/" class="nav-link animated fadeIn animation-delay-9" title="Sair">Sair</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item login">
                        <a href="/login/" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce" title="Entrar">Entrar</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
        <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu">
            <i class="zmdi zmdi-menu"></i>
            <div class="ripple-container"></div>
        </a>
    </div>
    <!-- container -->
</nav>