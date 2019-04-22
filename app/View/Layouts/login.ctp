<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon.ico">
	<title><?php echo Configure::read('BRAND') .' - '. Configure::read('BRAND_SLOGAN') .' - Login' ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- animation CSS -->
	<link href="/css/animate.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="/css/style.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="/css/colors/blue.css" id="theme"  rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
<?php echo $this->Flash->render(); ?>

<div class="preloader">
	<div class="cssload-speeding-wheel"></div>
</div>

<?php echo $this->fetch('content'); ?>

<!-- jQuery -->
<script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

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

		// Login and recover password
		$('#to-recover').click(function () {
			$("#loginform").slideUp();
			$("#recoverform").fadeIn();
		});
		$('#to-return').click(function () {
			$("#recoverform").slideUp();
			$("#loginform").fadeIn();
		});
	});
</script>

</body>
</html>