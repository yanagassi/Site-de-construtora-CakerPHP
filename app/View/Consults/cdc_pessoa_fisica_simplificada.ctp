<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/cdc/pessoa-fisica-simplificada" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/consultas" title="Voltar">Consultas</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			$('#Documento').mask('999.999.999-99');
			$('#DataNascimento').mask('99/99/9999');
		});
	</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">

				<h3 class="text-center">Consulta Pessoa Física Simplificada</h3>
				<h5 class="text-center">Confirmação de Dados Cadastrais (CDC)</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/pessoa-fisica-simplificada">
					<div class="form-group">
						<label for="Documento">CPF</label>
						<input name="data[Consult][document]" type="text" class="form-control" id="Documento" placeholder="999.999.999-99" maxlength="14" required>
					</div>
					<div class="form-group">
						<label for="DataNascimento">Data de Nascimento</label>
						<input name="data[Consult][birthday]" type="DataNascimento" id="DataNascimento" class="form-control" placeholder="99/99/9999" maxlength="10" required>
					</div>
					<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Consultar</button>
					<a href="javascript:history.back(-1)" class="btn btn-inverse waves-effect waves-light">Cancelar</a>
				</form>

				<?php }else{ ?>

					<p class="text-center">
					<br>
					<?php if ( ! $result->Status ) { ?>
						O CPF <?php echo $this->Custom->mask_cpf_cnpj($result->Documento) ?> consultado é <strong>inválido!</strong></p>
					<?php }else{ ?>
						O CPF <strong><?php echo $this->Custom->mask_cpf_cnpj($result->Documento) ?></strong> consultado é <strong>válido!</strong>
						<br>
						Nome: <?php echo $result->Nome ?>
					<?php } ?>
					</p>

					<a class="btn btn-success" href="javascript:history.back(-1)">VOLTAR</a>

				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>