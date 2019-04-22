<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Planos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
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
				<h3 class="box-title m-b-0">Novo Plano</h3>
				<p class="text-muted m-b-30">Adição</p>

				<?php echo $this->Form->create('Plan', array("data-toggle" => "validator", "novalidate" => true));?>

				<div class="form-group">
					<label class="control-label">Nome</label>
					<input name="data[Plan][name]" type="text" value="" class="form-control" placeholder="Ex.: Plano Gold" required data-error="Este campo é obrigatório">
				</div>

				<div class="form-group">
					<label for="textarea" class="control-label">Descrição</label>
					<textarea name="data[Plan][description]" id="textarea" class="form-control" rows="5" maxlength="200"></textarea>
					<span class="help-block with-errors">Atenção, não ultrapasse 200 caracteres!</span>
				</div>

				<div class="form-group">
					<label class="control-label">Valor (R$)</label>
					<input name="data[Plan][value]" type="text" value="" class="form-control" placeholder="Ex.: 120,50" required data-error="Este campo é obrigatório">
				</div>

				<div class="form-group">
					<label class="control-label">Quantidade de Notificações Permitidas</label>
					<input name="data[Plan][qtde_notifications]" type="text" value="" class="form-control" placeholder="Ex.: 12" required data-error="Este campo é obrigatório">
				</div>
				<div class="form-group">
					<label class="control-label">Quantidade Consulta Serasa</label>
					<input name="data[Plan][qtde_consult_serasa]" type="text" value="" class="form-control" placeholder="Ex.: 5" required data-error="Este campo é obrigatório">
				</div>
				<div class="form-group">
					<label class="control-label">Quantidade Consulta de Registro Digital de Contratos</label>
					<input name="data[Plan][qtde_consult_agreements]" type="text" value="" class="form-control" placeholder="Ex.: 5" required data-error="Este campo é obrigatório">
				</div>

				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="/planos" class="btn btn-primary btn-danger">Cancelar</a>

				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>