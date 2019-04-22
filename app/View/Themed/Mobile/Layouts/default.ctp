<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon.ico">
	<title><?php echo Configure::read('BRAND') .' - '. Configure::read('BRAND_SLOGAN') .' - '. $title_for_layout ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	<link href="/plugins/bower_components/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="/plugins/bower_components/toast-master//css/jquery.toast.css" rel="stylesheet">
	<!-- morris CSS -->
	<link href="/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
	<!-- animation CSS -->
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="/plugins/bower_components/dropify/dist/css/dropify.min.css">
	<link href="/css/style.css" rel="stylesheet">
	<!-- Custom SS -->
	<link href="/css/style_ss.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="/css/colors/blue.css" id="theme"  rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="http://www.w3schools.com/lib/w3data.js"></script>

	<!-- jQuery -->
	<script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="/bootstrap/dist/js/bootstrap.min.js"></script>

	<script>
//		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
//
//		ga('create', 'UA-xxxxxxx', 'auto');
//		ga('send', 'pageview');

	</script>
</head>
<body>
<?php echo $this->Flash->render(); ?>
<!-- Preloader -->
<div class="preloader">
	<div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top m-b-0">
		<div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
			<div class="top-left-part" style="width: 76px"><a class="logo" href="/"><b><img style="padding-left:20px" src="<?php echo Configure::read('FULL_PATH') . Configure::read('LOGO_NAME') ?>" alt="home" /></b></a></div>
			<ul class="nav navbar-top-links navbar-right pull-right">
				<li class="dropdown"> <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo Configure::read('FULL_PATH') . Configure::read('AVATAR_NAME') ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo AuthComponent::user('first_name') ." ". AuthComponent::user('last_name') ?></b> </a>
					<ul class="dropdown-menu dropdown-user animated flipInY">
						<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
						<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
						<li><a href="#"><i class="ti-email"></i> Inbox</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="/sair"><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /.navbar-header -->
		<!-- /.navbar-top-links -->
		<!-- /.navbar-static-side -->
	</nav>
	<!-- Left navbar-header -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse slimscrollsidebar">
			<?php $routes = explode('/', $this->Html->url()); ?>
			<ul class="nav" id="side-menu">
				<li id="menu_activation">
					<a href="/" class="waves-effect" <?php $title = $this->fetch('title'); echo ( $title != "Home" ? "style='border-bottom:none;color: black;'" : "" ) ?>><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <i class="fa fa-home" aria-hidden="true" <?php $title = $this->fetch('title'); echo ( $title != "Home" ? "style='border-bottom:none;color: black;'" : "" ) ?>></i> <span class="hide-menu"> <span class="fa arrow"></span></span></a>
				</li>
				<li><a href="/notificacoes/" class="waves-effect <?php echo ( $routes[1] == "notificacoes" || $routes[1] == "notifications" ) ? "active" : "" ?>"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="hide-menu">Notificações <span class="fa arrow"></span></span></a></li>
				<li><a href="/contratos/" class="waves-effect <?php echo ( $routes[1] == "contratos" || $routes[1] == "contracts" ) ? "active" : "" ?>"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-pencil-square" aria-hidden="true"></i> <span class="hide-menu">Contratos <span class="fa arrow"></span></span></a></li>
				<li><a href="/financeiro/" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-usd" aria-hidden="true"></i> <span class="hide-menu">Financeiro <span class="fa arrow"></span></span></a></li>
				<li><a href="/usuarios/" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-user" aria-hidden="true"></i> <span class="hide-menu">Usuários <span class="fa arrow"></span></span></a></li>
				<li><a href="/consultas/" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-star" aria-hidden="true"></i> <span class="hide-menu">Consulta CPF/CNPJ <span class="fa arrow"></span></span></a></li>
				<li>
					<a href="/configuracoes/<?php  ?>" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <i class="fa fa-gears" aria-hidden="true"></i> <span class="hide-menu">Configurações <span class="fa arrow"></span></span></a>
					<ul class="nav nav-second-level">
						<li><a href="/configuracoes/planos" class="waves-effect">Planos</a></li>
<!--						<li><a href="/configuracoes/perfil/">Perfil</a></li>-->
<!--						<li><a href="javascript:void(0)" class="waves-effect">PagSeguro</a></li>-->
					</ul>
				</li>
				<li><a href="/sair/" class="waves-effect"><i data-icon="&#xe045;" class="linea-icon linea-aerrow fa-fw"></i> <i class="fa fa-power-off" aria-hidden="true"></i> <span class="hide-menu">Sair</span></a></li>
			</ul>
		</div>
	</div>
	<!-- Left navbar-header end -->


	<!-- Page Content -->
	<div id="page-wrapper">
		<?php echo $this->fetch('content'); ?>
		<footer class="footer text-center"> <?php echo date('Y') ?> &copy; <?php echo Configure::read('BRAND') .' '. Configure::read('BRAND_SLOGAN') ?> </footer>
	</div>
	<!-- /#page-wrapper -->


</div>
<!-- /#wrapper -->

<!-- Menu Plugin JavaScript -->
<script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="/js/waves.js"></script>
<!--Counter js -->
<script src="/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="/plugins/bower_components/counterup/jquery.counterup.min.js"></script>

<?php if ( $this->params['controller'] == "pages" && $this->params['action'] == "index" ) : ?>
	<!--Morris JavaScript -->
	<script src="/plugins/bower_components/raphael/raphael-min.js"></script>
	<script src="/plugins/bower_components/morrisjs/morris.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="/js/dashboard1.js"></script>
<?php endif; ?>

<!-- Sweet-Alert  -->
<script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

<script src="/js/custom.min.js"></script>
<script src="/js/jasny-bootstrap.js"></script>
<script src="/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="/js/validator.js"></script>

<!-- jQuery peity -->
<script src="/plugins/bower_components/tablesaw-master/dist/tablesaw.js"></script>
<script src="/plugins/bower_components/tablesaw-master/dist/tablesaw-init.js"></script>

<!-- Sparkline chart JavaScript -->
<script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="/plugins/jquery.maskedinput.js"></script>
<script src="/js/mask.js"></script>
<script src="/js/cbpFWTabs.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
	// hide box alert
	var sec = 3500;
	setTimeout(function()
	{
		$("#flashMessage").hide('blind');
	}, sec);

	$(".myadmin-alert .closed").click(function(event){
		$(this).parents(".myadmin-alert").fadeToggle(350);
		return false;
	});

	$(".myadmin-alert-click").click(function(event){
		$(this).fadeToggle(350);
		return false;
	});

	// Basic
	$('.dropify').dropify();

	// Translated
	$('.dropify-fr').dropify({
		messages: {
			default: 'Arraste o arquivo aqui ou click',
			replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
			remove:  'Supprimer',
			error:   'Désolé, le fichier trop volumineux'
		}
	});

	// Used events
	var drEvent = $('#input-file-events').dropify();

	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
	});

	drEvent.on('dropify.afterClear', function(event, element){
		alert('File deleted');
	});

	drEvent.on('dropify.errors', function(event, element){
		console.log('Has Errors');
	});

	var drDestroy = $('#input-file-to-destroy').dropify();
	drDestroy = drDestroy.data('dropify')
	$('#toggleDropify').on('click', function(e){
		e.preventDefault();
		if (drDestroy.isDropified()) {
			drDestroy.destroy();
		} else {
			drDestroy.init();
		}
	})
	// Dropify

});

(function() {

	[].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
		new CBPFWTabs(el);
	});

})();
</script>

</body>
</html>
