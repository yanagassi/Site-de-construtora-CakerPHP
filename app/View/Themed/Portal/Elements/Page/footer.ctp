<aside class="ms-footbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ms-footer-col ml-2">
                <div class="row">
                    <div class="ms-footbar-block">
                        <h3 class="ms-footbar-title">Mapa do Site</h3>
                        <ul class="list-unstyled ms-icon-list three_cols">
                            <li><a href="/"><i class="zmdi zmdi-home"></i>Início</a></li>
                            <li><a href="/quem-somos/"><i class="zmdi zmdi-favorite-outline"></i>Quem Somos</a></li>
                            <li><a href="/vantagens-em-anunciar/"><i class="zmdi zmdi-time"></i>Vantagens</a></li>
                            <li><a href="/planos/"><i class="fas fa-bars"></i>Planos</a></li>
                            <li><a href="/contato/"><i class="zmdi zmdi-email"></i>Contato</a></li>

                            <?php if ( AuthComponent::user('id') > 0 ) { ?>
                                <li><a href="/dashboard/"><i class="mr-1 zmdi zmdi-account zmdi-hc-fw"></i>Painel</a></li>
                            <?php } else { ?>
                                <li><a href="/login/"><i class="mr-1 zmdi zmdi-account zmdi-hc-fw"></i>Entrar</a></li>
                            <?php } ?>

                            <li><a href="/cadastro/"><i class="mr-1 zmdi zmdi-account-add zmdi-hc-fw"></i>Cadastrar</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7 ms-footer-col text-center">
                        <div class="ms-footbar-block">
                            <a href="/cadastro/" class="btn btn-raised btn-primary">Cadastrar<div class="ripple-container"></div></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 ms-footer-col">
                <div class="ms-footbar-block">
                    <h3 class="ms-footbar-title text-center">Redes Sociais</h3>
                    <div class="ms-footbar-social text-center">
                        <a href="https://www.facebook.com/construlista.com.br" target="_blank" class="btn-circle btn-facebook">
                            <i class="zmdi zmdi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/construlista/" target="_blank" class="btn-circle btn-instagram">
                            <i class="zmdi zmdi-instagram"></i>
                        </a>
<!--                        <a href="javascript:void(0)" class="btn-circle btn-twitter">-->
<!--                            <i class="zmdi zmdi-twitter"></i>-->
<!--                        </a>-->
<!--                        <a href="javascript:void(0)" class="btn-circle btn-google">-->
<!--                            <i class="zmdi zmdi-google"></i>-->
<!--                        </a>-->
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-5 ms-footer-col ms-footer-text-right">
                <div class="ms-footbar-block">
                    <div class="ms-footbar-title">
                        <img src="/theme/Portal/assets/img/logo-full-3.png" width="100" alt="">
                    </div>
                    <address class="no-mb">
                        <p><i class="color-danger-light zmdi zmdi-pin mr-1"></i><a target="_blank" href="https://www.google.com.br/maps/place/Construlista/@-18.8873743,-48.2541635,15z/data=!4m5!3m4!1s0x0:0x286296a9ac68112a!8m2!3d-18.8873743!4d-48.2541635">Rua Acre 1856 Uberlândia / MG</a></p>
                        <p><i class="color-warning-light zmdi zmdi-map mr-1"></i>Cep: 38405-319 / Umuarama</p>
                        <p><i class="color-info-light zmdi zmdi-email mr-1"></i><a href="mailto:construlista@construlista.com.br">construlista@construlista.com.br</a></p>
                        <p><i class="color-success-light fa fa-fax mr-1"></i>(34) 3231-5006</p>
                        <p><i class="color-info  fab fa-whatsapp mr-1"></i> (34) 98810-5006</p>
                    </address>
                </div>

            </div>
        </div>
    </div>
</aside>