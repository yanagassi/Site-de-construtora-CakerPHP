    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i> Menu</a>
            <div class="top-left-part"><a class="logo" href="/"><b><img src="/plugins/images/construlista-logo.png" alt="home" /></b><span class="hidden-xs"><img src="/plugins/images/construlista-text.png" alt="home" /></span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                <!--li>
                    <form role="search" class="app-search hidden-xs">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li-->
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <?php //if ( $this->request->session()->read('Auth') ) { ?>


                        <img src="<?php echo ( !empty( AuthComponent::user('avatar') ) ? '/uploads/anuncio/avatar/' . AuthComponent::user('id') . '/' . AuthComponent::user('avatar') : '/plugins/images/users/varun.jpg' ) ?>" alt="user-img" width="36" class="img-circle">


                        <b class="hidden-xs"><?php echo AuthComponent::user('nome');?> <?php echo ( !empty(AuthComponent::user('last_name')) ? AuthComponent::user('last_name') : "" ) ?></b>
                        <?php //} ?>
                    </a>

                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li><a href="/painel/perfil/<?php echo AuthComponent::user('id');?>"><i class="ti-user"></i> Meu Pefil</a></li>
                        <li><a href="/painel/avatar/<?php echo AuthComponent::user('id');?>"><i class="fa fa-address-book"></i> Minha Foto</a></li>
                        <!--                        <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>-->
                        <!--                        <li><a href="#"><i class="ti-email"></i> Inbox</a></li>-->
                        <!--                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li-->
                        <li role="separator" class="divider"></li>
                        <li><a href="/sair/"><i class="fa fa-power-off"></i> Sair</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li class=""><a class="waves-effect waves-light" href="javascript:void(0)"><i class=""></i></a></li>
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>