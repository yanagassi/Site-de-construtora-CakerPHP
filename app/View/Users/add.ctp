<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Usuários</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/usuarios" title="Listar todos usuários">Usuários</a></li>
				<li>Adicionar</li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Usuário do Sistema</h3>
				<p class="text-muted m-b-20">Adição</p>

				<?php echo $this->Form->create('User', array("data-toggle" => "validator", "novalidate" => true, "class" => "form-horizontal"));?>

					<div class="form-group">
						<label class="col-md-12">Nome</label>
						<div class="col-md-12">
							<input name="data[User][first_name]" type="text" class="form-control" placeholder="Nome" required data-error="Este campo é obrigatório">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Sobrenome</label>
						<div class="col-md-12">
							<input name="data[User][last_name]" type="text" class="form-control" placeholder="Sobrenome" required data-error="Este campo é obrigatório">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-12">Email</label>
						<div class="col-md-12">
							<input name="data[User][email]" type="text" class="form-control" placeholder="Email" required data-error="Este campo é obrigatório">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-12">Grupo</label>
						<div class="col-sm-12">
							<select class="form-control" name="data[User][group_id]">
								<?php foreach ( $groups as $item ) { ?>
								<option value="<?php echo $item["Group"]["id"] ?>"><?php echo $item["Group"]["name"] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-12">Senha</label>
						<div class="col-sm-12">
							<div class="form-group col-sm-6">
								<input name="data[User][password]" type="password" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="Senha" required>
								<span class="help-block">Mínimo de 6 caracteres</span>
							</div>
							<div class="form-group col-sm-6">
								<input name="data[User][password_confirm]" type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="As senhas não conferem!" placeholder="Confimação de Senha" required>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary">Salvar</button>
					<a href="/" class="btn btn-primary btn-danger">Cancelar</a>

				<?php echo $this->Form->end(); ?>

			</div>
		</div>
	</div>
</div>