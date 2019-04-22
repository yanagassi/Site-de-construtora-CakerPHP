<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $welcome .' - '. $slogan  ?></title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
	<div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
			<tbody>
			<tr>
				<td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="<?php echo $host ?>" target="_blank"><img width="200" src="<?php echo $host ?>/theme/portal/assets/img/logo-full-1.png" alt="<?php echo $welcome .' - '. $slogan  ?>" style="border:none"></a></td>
			</tr>
			</tbody>
		</table>
		<div style="padding: 40px; background: #fff;">
			<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
				<tbody>
				<tr>
					<td>
						<b><?php echo $intro ?></b>

						<p><?php echo $body ?></p>

						<p>
							<?php echo $client ?><br>
							<?php echo $phone_client ?><br>
							<?php echo $email_client ?>
						</p>

						<br>
						<hr style="border-width:0.5px;">
						<br>

						<center><b><?php echo $welcome .' - '. $slogan  ?></b></center>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
			<p><a href="<?php echo $host ?>" target="_blank"><?php echo $host  ?></a></p>
		</div>
	</div>
</div>
</body>
</html>