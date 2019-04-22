<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Serviços Serasa</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/configuracoes/serasa/adicionar" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Novo</a>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/configuracoes" title="Voltar para Configurações">Configurações</a></li>
				<li><a href="/configuracoes/serasa" title="Listar todos">Serviços Serasa</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Serviços Serasa</h3>
				<p class="text-muted m-b-30">Edição</p>

				<?php echo $this->Form->create('ConsultCategory', array("data-toggle" => "validator", "novalidate" => true));?>

				<div class="form-group">
					<label class="control-label">Nome</label>
					<input name="data[ConsultCategory][name]" type="text" value="" class="form-control" placeholder="Nome" required data-error="Este campo é obrigatório">
				</div>
				<div class="form-group">
					<label for="textarea" class="control-label">Descrição</label>
					<textarea name="data[ConsultCategory][description]" id="textarea" class="form-control" rows="5" maxlength="200"></textarea>
					<span class="help-block with-errors">Atenção, não ultrapasse 200 caracteres!</span>
				</div>
				<div class="form-group">
					<label class="control-label">Valor Serasa (R$)</label>
					<input name="data[ConsultCategory][value_serasa]" type="text" value="" class="form-control" placeholder="Valor" required data-error="Este campo é obrigatório">
				</div>
				<div class="form-group">
					<label class="control-label">Valor Aveeze (R$)</label>
					<input name="data[ConsultCategory][value_aveeze]" type="text" value="" class="form-control" placeholder="Valor" required data-error="Este campo é obrigatório">
				</div>
				<div class="form-group">
					<select class="form-control" name="data[ConsultCategory][type]">
						<option value="">Categoria</option>
						<option value="CDC">CDC</option>
						<option value="Receita Federal">Receita Federal</option>
						<option value="SERASA Experian">SERASA Experian</option>
						<option value="CEP">CEP</option>
					</select>
				</div>
				<div class="form-group">
					<div class="form-check">
						<label class="custom-control custom-radio">
							<input id="radio1" name="data[ConsultCategory][status]" type="radio" class="custom-control-input" value="1" checked="checked">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Ativo</span>
						</label>
					</div>
					<div class="form-check">
						<label class="custom-control custom-radio">
							<input id="radio2" name="data[ConsultCategory][status]" type="radio" class="custom-control-input" value="0">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Inativo</span>
						</label>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="/configuracoes/serasa" class="btn btn-primary btn-danger">Cancelar</a>

				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>