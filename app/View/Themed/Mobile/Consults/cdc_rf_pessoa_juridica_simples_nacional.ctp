<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/cdc/receita-federal-pessoa-juridica-simples-nacional" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/consultas" title="Voltar">Consultas</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			$('#Documento').mask('99.999.999/9999-99');
		});
	</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">

				<h3 class="text-center">Consulta Pessoa Jurídica Simples Nacional</h3>
				<h5 class="text-center">Receita Federal</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/receita-federal-pessoa-juridica-simples-nacional">
					<div class="form-group">
						<label for="Documento">CNPJ</label>
						<input name="data[Consult][document]" type="text" class="form-control" id="Documento" placeholder="99.999.999/9999-99" maxlength="18" required>
					</div>
					<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Consultar</button>
					<a href="javascript:history.back(-1)" class="btn btn-inverse waves-effect waves-light">Cancelar</a>
				</form>

				<?php }else{ ?>

					<p class="text-center">
					<br>
					<?php if ( ! $result['Status'] ) { ?>
						O CNPJ <?php echo $this->Custom->mask_cpf_cnpj($result['Documento']) ?> consultado é <strong>inválido!</strong></p>
					<?php }else{ ?>
						O CNPJ <strong><?php echo $this->Custom->mask_cpf_cnpj($result['Documento']) ?></strong> consultado é <strong>válido!</strong>
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
									<td>SIMEI</td>
									<td><?php echo $result['SIMEI'] ?></td>
								</tr>
								<tr>
									<td>SINAC</td>
									<td><?php echo $result['SINAC'] ?></td>
								</tr>
								<tr>
									<td>Data de Opção SIMEI</td>
									<td><?php echo $result['DataOpcaoSIMEI'] ?></td>
								</tr>
								<tr>
									<td>Data de Opção SINAC</td>
									<td><?php echo $result['DataOpcaoSINAC'] ?></td>
								</tr>
								<tr>
									<td>Períodos SIMEI</td>
									<td><?php echo "Início: " . $result['PeriodosSIMEI']['Inicio'] ." | Fim: ". $result['PeriodosSIMEI']['Fim'] ?></td>
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