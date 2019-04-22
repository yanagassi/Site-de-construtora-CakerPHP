<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background: #f8f8f8">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo Configure::read('BRAND') ?> - <?php echo Configure::read('BRAND_SLOGAN') ?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon.ico">
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

<body style="margin:0px; background: #f8f8f8; ">

<?php echo $this->Flash->render(); ?>

<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
	<div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
			<tbody>
			<tr>
				<td style="vertical-align: top; padding-bottom:30px;" align="center">
					<a href="<?php echo Configure::read('HOST') ?>" target="_blank">
						<img src="<?php echo Configure::read('HOST') . Configure::read('FULL_PATH') ?>logo.png" alt="<?php echo Configure::read('BRAND') ?>" style="border:none"><br/>
						<img src="<?php echo Configure::read('HOST') . Configure::read('FULL_PATH')?>logo_slogan.png" alt="<?php echo Configure::read('BRAND_SLOGAN') ?>" style="border:none">
					</a>
				</td>
			</tr>
			</tbody>
		</table>
		<?php echo $this->fetch('content'); ?>
		<div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px"><p>Powered by <?php echo Configure::read('BRAND') ?></p></div>
	</div>
</div>

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

		$( "#clicked_doc" ).click(function() {
			$('#submit_doc_sign').prop('disabled', false);
			$("#submit_doc_sign").css("background-color", "#00c0c8");
			$("#submit_doc_sign").css("color", "#fff");
		});

		$( "#clicked_doc_ar" ).click(function() {
			$.post("/notificacoes/token/<?php echo $this->request->params['pass'][0] ?>");
		});
	});
</script>

</body>
</html>
