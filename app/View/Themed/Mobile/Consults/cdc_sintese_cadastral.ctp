<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/cdc/sintese-cadastral" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/consultas" title="Voltar">Consultas</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			//$('#Documento').mask('999.999.999-99');
		});
	</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">

				<h3 class="text-center">Síntese Cadastral</h3>
				<h5 class="text-center">Confirmação de Dados Cadastrais (CDC)</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/sintese-cadastral">
					<div class="form-group">
						<label for="Documento">CPF</label>
						<input name="data[Consult][document]" type="text" class="form-control" id="Documento" placeholder="999.999.999-99 ou 99.999.999/9999-99" maxlength="18" required>
					</div>
					<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Consultar</button>
					<a href="javascript:history.back(-1)" class="btn btn-inverse waves-effect waves-light">Cancelar</a>
				</form>

				<?php }else{ ?>

					<p class="text-center">
					<br>
					<?php if ( ! $result['Status'] ) { ?>
						O CPF/CNPJ <?php echo $this->Custom->mask_cpf_cnpj($result['Documento']) ?> consultado é <strong>inválido!</strong></p>
					<?php }else{ ?>
						O CPF/CNPJ <strong><?php echo $this->Custom->mask_cpf_cnpj($result['Documento']) ?></strong> consultado é <strong>válido!</strong>
						<br>

						<div class="table-responsive" style="width:<?php echo $percent_table ?>;margin:0px auto;float: none;">
							<table class="table text-left">
								<thead>
								<tr>
									<th>Nome</th>
									<th>Valor</th>
								</tr>
								</thead>

								<tbody>
								<tr>
									<td>Nome</td>
									<td><?php echo $result['Nome'] ?></td>
								</tr>
								<tr>
									<td>Data de Nascimento</td>
									<td><?php echo $result['DataNascimento'] ?></td>
								</tr>

								</tbody>
							</table>
						</div>

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