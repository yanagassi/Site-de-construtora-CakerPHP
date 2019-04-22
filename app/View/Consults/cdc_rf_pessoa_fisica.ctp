<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/cdc/receita-federal-pessoa-fisica" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
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

				<h3 class="text-center">Consulta Pessoa Física</h3>
				<h5 class="text-center">Receita Federal</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/receita-federal-pessoa-fisica">
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
									<td><?php echo $result->Nome ?></td>
								</tr>
								<tr>
									<td>Data de Nascimento</td>
									<td><?php echo $result->DataNascimento ?></td>
								</tr>
								<tr>
									<td>Data de Inscrição</td>
									<td><?php echo $result->DataInscricao ?></td>
								</tr>
								<tr>
									<td>Ano de Óbito</td>
									<td><?php echo $result->AnoObito ?></td>
								</tr>
								<tr>
									<td>Mensagem de Óbito</td>
									<td><?php echo $result->MensagemObito ?></td>
								</tr>
								<tr>
									<td>Código da Situação Cadastral</td>
									<td><?php echo $result->CodigoSituacaoCadastral ?></td>
								</tr>
								<tr>
									<td>Situação Na Receita Federal</td>
									<td><?php echo $result->SituacaoRFB ?></td>
								</tr>
								<tr>
									<td>Data da Consulta</td>
									<td><?php echo $this->Custom->formatDateWithHours($result->DataConsultaRFB) ?></td>
								</tr>
								<tr>
									<td>Protocolo da Consulta</td>
									<td><?php echo $result->ProtocoloRFB ?></td>
								</tr>
								<tr>
									<td>Dígito Verificador</td>
									<td><?php echo $result->DigitoVerificador ?></td>
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