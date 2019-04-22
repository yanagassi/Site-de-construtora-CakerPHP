<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $subject ?></title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
	<div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
			<tbody>
			<tr>
				<td style="vertical-align: top; padding-bottom:30px;" align="center">
					<a href="<?php echo Configure::read('HOST') ?>" target="_blank">
						<img src="<?php echo Configure::read('HOST') . Configure::read('FULL_PATH') ?>/logo.png" alt="<?php echo Configure::read('BRAND') ?>" style="border:none"><br/>
						<img src="<?php echo Configure::read('HOST') . Configure::read('FULL_PATH')?>/logo_slogan.png" alt="<?php echo Configure::read('BRAND_SLOGAN') ?>" style="border:none">
					</a>
				</td>
			</tr>
			</tbody>
		</table>

		<div style="padding: 40px; background: #fff;">
			<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tbody>
				<tr>
					<td style="border-bottom:1px solid #f6f6f6;">
						<h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Caro(a) <?php echo $to_name ?>,</h1>
						<p style="margin-top:0px; color:#bbbbbb;">Email de Notificação Enviado por: <?php echo $from_first_name .' '. $from_last_name ?> | Email: <?php echo $from_email ?></p>
					</td>
				</tr>
				<tr>
					<td style="padding:10px 0 30px 0;text-align:justify">
						<p><?php echo $this->Custom->formatTextToParagraphs($body) ?></p>

						<?php if ( $is_electronic_signature ) { ?>

								<center>
									<a href="<?php echo $link ?>" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;">Visualizar Documento</a>
								</center>

						<?php } else { ?>

							<?php if ( $is_acknowledgment_receipt ) { ?>

								<center>
									<a href="<?php echo $link ?>" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;">Confirmar Recebimento</a>
								</center>

							<?php } ?>

						<?php } ?>

						Atenciosamente<br/>
						<b><?php echo $from_first_name .' '. $from_last_name ?></b>
					</td>
				</tr>
				<tr>
					<td  style="border-top:1px solid #f6f6f6; padding-top:20px; color:#777">Se você está recebendo este email e desconhece esta ação, contacte-nos através do email: info@<?php echo Configure::read('HOST_SUFIX') ?></td>
				</tr>
				</tbody>
			</table>
		</div>
		<div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px"><p>Powered by <?php echo Configure::read('BRAND') ?></p></div>
	</div>
</div>
</body>
</html>
