<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Usuários</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline waves-effect waves-light', 'title' => 'Adicionar novo usuário')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/usuarios" title="Listar todos usuários">Usuários</a></li>
				<li>Visualizar</li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="tab active"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Perfil</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Nome</strong> <br>
								<p class="text-muted"><?php echo (!empty($user['User']['first_name']) ? $user['User']['first_name'] : ""); echo (!empty($user['User']['last_name']) ? " " . $user['User']['last_name'] : "") ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Celular</strong> <br>
								<p class="text-muted">(123) 456 7890</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong> <br>
								<p class="text-muted"><?php echo (!empty($user['User']['email']) ? $user['User']['email'] : "");?></p>
							</div>
							<div class="col-md-3 col-xs-6"> <strong>Criado em:</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->formatDateWithHours($user['User']['created']); ?></p>
							</div>
						</div>
						<hr>
					</div>

					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Empresa</strong> <br>
								<p class="text-muted">Auto Peças Irmãos Brandão</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Tel</strong> <br>
								<p class="text-muted">(34) 3232-4410</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong> <br>
								<p class="text-muted">contato@irmaosbrandao.com.br</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>CNPJ</strong> <br>
								<p class="text-muted">04.325.668/0001-45</p>
							</div>
						</div>
						<hr>
					</div>

					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Plano</strong> <br>
								<p class="text-muted">C - Até 30 Notificações/mês</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Valor</strong> <br>
								<p class="text-muted">R$99,00</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Usuários no Sistema</strong> <br>
								<p class="text-muted">5</p>
							</div>
							<div class="col-md-3 col-xs-6"> <strong>Dt. Assinatura:</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->formatDateWithHours($user['User']['created']); ?></p>
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:history.back(-1);" class="fcbtn btn btn-info btn-outline btn-1c">Voltar</a>
</div>