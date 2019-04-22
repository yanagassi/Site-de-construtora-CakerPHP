<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Planos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/configuracoes/planos/adicionar" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Novo</a>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/configuracoes/planos" title="Listar todos planos">Planos</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Planos do Sistema</h3>
				<p class="text-muted m-b-30">Edição</p>

				<?php echo $this->Form->create('Plan', array("data-toggle" => "validator", "novalidate" => true));?>

					<input name="data[Plan][id]" 			 type="hidden" value="<?php echo (!empty($this->request->data['Plan']['id'])) ? $this->request->data['Plan']['id'] : 0 ?>">
					<input name="data[Plan][code_pagseguro]" type="hidden" value="<?php echo (!empty($this->request->data['Plan']['code_pagseguro'])) ? $this->request->data['Plan']['code_pagseguro'] : 0 ?>">

					<div class="form-group">
						<label class="control-label">Nome</label>
						<input name="data[Plan][name]" type="text" value="<?php echo (!empty($this->request->data['Plan']['name'])) ? $this->request->data['Plan']['name'] : "" ?>" class="form-control" placeholder="Nome" required data-error="Este campo é obrigatório">
					</div>

					<div class="form-group">
						<label for="textarea" class="control-label">Descrição</label>
						<textarea name="data[Plan][description]" id="textarea" class="form-control" rows="5" maxlength="200"><?php echo (!empty($this->request->data['Plan']['description'])) ? $this->request->data['Plan']['description'] : "" ?></textarea>
						<span class="help-block with-errors">Atenção, não ultrapasse 200 caracteres!</span>
					</div>

					<div class="form-group">
						<label class="control-label">Valor (R$)</label>
						<input name="data[Plan][value]" type="text" value="<?php echo (!empty($this->request->data['Plan']['value'])) ? $this->Custom->numberFormatToBR($this->request->data['Plan']['value']) : "" ?>" class="form-control" placeholder="Valor" required data-error="Este campo é obrigatório">
					</div>

					<div class="form-group">
						<label class="control-label">Quantidade de Notificações Permitidas</label>
						<input name="data[Plan][qtde_notifications]" type="text" value="<?php echo (!empty($this->request->data['Plan']['qtde_notifications'])) ? $this->request->data['Plan']['qtde_notifications'] : "" ?>" class="form-control" placeholder="Qtde. Notificações" required data-error="Este campo é obrigatório">
					</div>
					<div class="form-group">
						<label class="control-label">Quantidade Consulta Serasa</label>
						<input name="data[Plan][qtde_consult_serasa]" type="text" value="<?php echo (!empty($this->request->data['Plan']['qtde_consult_serasa'])) ? $this->request->data['Plan']['qtde_consult_serasa'] : "" ?>" class="form-control" placeholder="Qtde. Consulta Serasa" required data-error="Este campo é obrigatório">
					</div>
					<div class="form-group">
						<label class="control-label">Quantidade Consulta de Registro Digital de Contratos</label>
						<input name="data[Plan][qtde_consult_agreements]" type="text" value="<?php echo (!empty($this->request->data['Plan']['qtde_consult_agreements'])) ? $this->request->data['Plan']['qtde_consult_agreements'] : "" ?>" class="form-control" placeholder="Qtde. Consulta de Registro Digital de Contratos" required data-error="Este campo é obrigatório">
					</div>
<!--					<div class="form-group">-->
<!--						<div class="form-check">-->
<!--							<label class="custom-control custom-radio">-->
<!--								<input id="radio1" name="radio" type="radio" class="custom-control-input">-->
<!--								<span class="custom-control-indicator"></span>-->
<!--								<span class="custom-control-description">Ativo</span>-->
<!--							</label>-->
<!--						</div>-->
<!--						<div class="form-check">-->
<!--							<label class="custom-control custom-radio">-->
<!--								<input id="radio2" name="data[]" type="radio" class="custom-control-input">-->
<!--								<span class="custom-control-indicator"></span>-->
<!--								<span class="custom-control-description">Inativo</span>-->
<!--							</label>-->
<!--						</div>-->
<!--					</div>-->

					<button type="submit" class="btn btn-primary">Salvar</button>
					<a href="/planos" class="btn btn-primary btn-danger">Cancelar</a>

				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>