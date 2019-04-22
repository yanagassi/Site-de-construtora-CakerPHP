<section id="wrapper" class="login-register">
	<div class="login-box login-sidebar">
		<div class="white-box">
			<form class="form-horizontal form-material" id="loginform" action="/login/" method="post">
				<a href="javascript:void(0)" class="text-center db"><img src="<?php echo Configure::read('FULL_PATH') ?>/logo_login.png" width="120" alt="Home" /><br/><img src="<?php echo Configure::read('FULL_PATH')?>/logo_slogan.png" alt="Home" /></a>

				<div class="form-group m-t-40">
					<div class="col-xs-12">
						<input name="data[User][email]" class="form-control" type="text" required="" placeholder="Email" autofocus>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<input name="data[User][password]" class="form-control" type="password" required="" placeholder="Senha">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12"><a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Perdeu a senha?</a></div>
				</div>
				<div class="form-group text-center m-t-20">
					<div class="col-xs-12">
						<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">ENTRAR</button>
					</div>
				</div>
				<div class="form-group m-b-0">
					<div class="col-sm-12 text-center">
						<p>Não tem uma conta ainda? <a href="/registro/" class="text-primary m-l-5"><b>Registre-se</b></a></p>
					</div>
				</div>
			</form>

			<form class="form-horizontal" id="recoverform" action="/recuperar-senha/" method="post">
				<div class="form-group ">
					<div class="col-xs-12">
						<h3>Recuperar Senha</h3>
						<p class="text-muted">Entre com seu email e verifique as instruções enviadas em seu email!</p>
					</div>
				</div>
				<div class="form-group ">
					<div class="col-xs-12">
						<input class="form-control" name="data[User][email]" type="text" required="" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12"><a href="javascript:void(0)" id="to-return" class="text-dark pull-right"> Fechar</a></div>
				</div>
				<div class="form-group text-center m-t-20">
					<div class="col-xs-12">
						<button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">RECUPERAR</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>