<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="O maior portal de empresas e profissionais que oferecem serviços e produtos para construção civil. Vejas algumas vantagens de se utilizar a construlista. Faça uma busca. Tudo para sua obra, reforma ou manutenção. Todas as empresas e profissionais em um só local. Faça uma busca. Ganhe tempo. ">
	<meta name="author" content="Saulo Stopa - https://saulostopa.com/">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon.ico">
	<title>Contrulista o maior portal da contrução civil</title>
	<!-- Bootstrap Core CSS -->
	<link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	<link href="/plugins/bower_components/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	<!-- morris CSS -->
	<link href="/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
	<link href="/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- animation CSS -->
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="/plugins/bower_components/dropify/dist/css/dropify.min.css">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/application.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="/css/colors/gray-dark.css" id="theme"  rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="https://www.w3schools.com/lib/w3data.js"></script>

	<!-- jQuery -->
	<script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="/bootstrap/dist/js/bootstrap.min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- jQuery Mask Currency -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.js"></script>

	<script>
//		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
//
//		ga('create', 'UA-xxxxxxxxx-9', 'auto');
//		ga('send', 'pageview');

	</script>
</head>
<body>

<?php echo $this->Flash->render() ?>
<?php echo $this->Flash->render('ajax-error') ?>
<?php echo $this->Flash->render('ajax-success') ?>

<div class="preloader" id="preloader222">
	<div class="cssload-speeding-wheel"></div>
</div>

<div id="wrapper">
	<!-- Navigation -->
	<?php echo $this->element('menu'); ?>

	<!-- Left navbar-header -->
	<?php echo $this->element('sub_menu'); ?>

	<!-- Page Content -->
	<?php echo $this->fetch('content'); ?>
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

<!--Morris JavaScript -->
<script src="/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="/plugins/bower_components/morrisjs/morris.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/js/dashboard1.js"></script>
<script src='/plugins/bower_components/jquery-ui-1.12.1.custom/jquery-ui.min.js'></script>

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
	/*
	 $(document).ready(function() {
	 $.toast({
	 heading: 'Welcome to Admin',
	 text: 'Use the predefined ones, or specify a custom position object.',
	 position: 'top-right',
	 loaderBg:'#ff6849',
	 icon: 'info',
	 hideAfter: 3500,
	 stack: 6
	 });
	 });
	 */
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {

		// Switchery => Construct the elements
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});

		// set val (checked/unchecked) input to 0, 1 or 2 by click on Switchery status
		var status = '';
		$('span.switchery').on('click', function()
		{
			if ($(this).prev().val() == 1)
			{
				status = 0;
				$(this).prev().val("0");
			}
			else
			{
				status = 1;
				$(this).prev().val("1");
			}

			var id_row 		= $(this).parent().parent().attr('id');
			var controller 	= $(this).parent().parent().data('role');
			var method 		= $(this).parent().parent().data('action');

			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/"+controller+"/"+method+"/"+id_row+"/"+status
			});
		});

		// hide box alert
		var sec = 3500;
		setTimeout(function()
		{
			$("#flashMessage").hide('blind');
			$("#flash-success").hide('blind');
			$("#flash-ajax-error").hide('blind');
			$("#flash-ajax-success").hide('blind');
		}, sec);

		$(".myadmin-alert .closed").click(function(event){
			$(this).parents(".myadmin-alert").fadeToggle(350);
			return false;
		});

		$(".myadmin-alert-click").click(function(event){
			$(this).fadeToggle(350);
			return false;
		});

		$(".alert .closed").click(function(event){
			$(".alert").fadeToggle(350);
			return false;
		});

		$(".alert").click(function(event){
			$(this).fadeToggle(350);
			return false;
		});

		// Basic
		$('.dropify').dropify();

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
		});
		// Dropify

		// For Elements with Ajax
		$('#flash-ajax-success').empty();
		$('#flash-ajax-error').empty();

	});

	function confirmDeleteItem(id_row = null, controller = null)
	{
		swal({
			title: "Tem certeza que deseja realizar esta ação?",
			text: "Você não poderá desfazer esta ação!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Cancelar",
			confirmButtonText: "Sim!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: "/"+controller+"/ajax_delete/" + id_row,
				type: "POST",
				dataType: "json",
				success: function (result) {
					swal("Deletado", "Item removido com sucesso!", "success");
					$("tr#" + result).remove();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Problemas", "Você não tem permissão para esta ação!", "error");
				}
			});
		});
	}

	function confirmDeleteItemAdmin(id_row = null, controller = null)
	{
		swal({
			title: "Tem certeza que deseja realizar esta ação?",
			text: "Você não poderá desfazer esta ação!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Cancelar",
			confirmButtonText: "Sim!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: "/"+controller+"/ajax_delete/" + id_row,
				type: "POST",
				dataType: "json",
				success: function (result) {
					swal("Deletado", "Item removido com sucesso!", "success");
					//$("tr#" + result).remove();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Problemas", "Você não tem permissão para esta ação!", "error");
				}
			});
		});
	}

	(function() {

		[].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
			new CBPFWTabs(el);
		});

	})();
</script>

<!--Style Switcher -->
<script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>