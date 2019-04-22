    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">

                <!--li class="sidebar-search hidden-sm hidden-md hidden-lg">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span>
                    </div>
                </li-->

                <?php if ( AuthComponent::user('role') == 'admin' ) { ?>
                <li><a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <i class="fa fa-cogs" aria-hidden="true"></i> <span class="hide-menu"> Admin <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="/admin/anuncios"><i class="fa fa-bars" aria-hidden="true"></i> Meus Anúncios</a></li>
                        <li><a href="/admin/newsletters"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Newsletters</a></li>
                        <li><a href="/admin/usuarios"><i class="fa fa-users" aria-hidden="true"></i> Usuários</a></li>
                        <li><a href="/admin/usuarios"><i class="fa fa-users" aria-hidden="true"></i> Usuários</a></li>
                    </ul>
                </li>
                <?php } ?>

                <li> <a href="/painel/dashboard/" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <i class="fa fa-tachometer" aria-hidden="true"></i> <span class="hide-menu"> Painel de Controle <span class="fa arrow"></span> </span></a>
                    <!--ul class="nav nav-second-level">
                        <li> <a href="index.html">Minimalistic</a> </li>
                        <li> <a href="index2.html">Demographical</a> </li>
                        <li> <a href="index3.html">Analitical</a> </li>
                        <li> <a href="index4.html">Simpler</a> </li>
                    </ul-->
                </li>

                <li><a href="/painel/anuncios/" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-bars" aria-hidden="true"></i> <span class="hide-menu">Meus Anúncios <span class="fa arrow"></span></span></a></li>
                <li><a href="/planos/" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-server" aria-hidden="true"></i> <span class="hide-menu">Planos<span class="fa arrow"></span></span></a></li>
                <li><a href="/painel/perfil/<?php echo AuthComponent::user('id') ?>" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-user" aria-hidden="true"></i> <span class="hide-menu">Perfil<span class="fa arrow"></span></span></a></li>
                <li> <a href="javascript:void(0)" class="waves-effect">|</a> </li>
                <li><a href="/painel/anuncios/novo" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-address-card text-success" aria-hidden="true"></i> <span class="hide-menu text-success">Novo Anúncio!<span class="fa arrow"></span></span></a></li>
                <li> <a href="javascript:void(0)" class="waves-effect">|</a> </li>
                <li><a href="/sair/" class="waves-effect" title="Sair do Sistema!"><i data-icon="&#xe045;" class="linea-icon linea-aerrow fa-fw"></i> <i class="fa fa-power-off text-danger" aria-hidden="true"></i> <span class="hide-menu text-danger">Sair</span></a></li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->