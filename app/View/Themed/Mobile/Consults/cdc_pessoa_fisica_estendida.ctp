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
		});
	</script>

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">

				<h3 class="text-center">Consulta Pessoa Física Estendida</h3>
				<h5 class="text-center">Confirmação de Dados Cadastrais (CDC)</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/pessoa-fisica-estendida">
					<div class="form-group">
						<label for="Documento">CPF</label>
						<input name="data[Consult][document]" type="text" class="form-control" id="Documento" placeholder="999.999.999-99" maxlength="14" required>
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
									<td>Nome da Mãe</td>
									<td><?php echo $result->NomeMae ?></td>
								</tr>
								<tr>
									<td>Data de Nascimento</td>
									<td><?php echo $result->DataNascimento ?></td>
								</tr>
								<tr>
									<td>Escolaridade</td>
									<td><?php echo $result->Escolaridade ?></td>
								</tr>
								<tr>
									<td>Sexo</td>
									<td><?php echo ( $result->Sexo == 0 ? "Masculino" : "Feminino" ) ?></td>
								</tr>
								<tr>
									<td>Atividade Profissional</td>
									<td><?php echo $result->AtividadeProfissional ?></td>
								</tr>
								<tr>
									<td>Renda Presumida</td>
									<td><?php echo "R$ ".$result->RendaPresumida ?></td>
								</tr>
								<tr>
									<td>Cargo</td>
									<td><?php echo $result->Cargo ?></td>
								</tr>

								<tr>
									<td colspan="2">Endereço(s)</td>
								</tr>
								<?php $x = 1; foreach ($result->Enderecos as $endereco) { ?>
								<tr>
									<td class="text-right">Endereço <?php echo $x ?></td>
									<td>Logradouro: <?php echo $endereco->Logradouro ?>, N. <?php echo $endereco->Numero ?> - Complemento: <?php echo $endereco->Numero ?><br>
										Bairro: <?php echo $endereco->Bairro ?><br>
										Cidade: <?php echo $endereco->Cidade ?> - UF: <?php echo $endereco->Estado ?><br>
										Cep: <?php echo $endereco->CEP ?><br>
										Código IBGE: <?php echo $endereco->CodigoIBGE ?><br>
										Geo Localização: Latitude: <?php echo $endereco->GeoLocalizacao->Latitude ?>, Longitude: <?php echo $endereco->GeoLocalizacao->Longitude ?><br>
										Última Atualização: <?php echo $this->Custom->formatDate($endereco->DataAtualizacao) ?></td>
								</tr>
								<?php $x++; } ?>

								<tr>
									<td colspan="2">Telefone(s)</td>
								</tr>
								<?php $y = 1; foreach ($result->Telefones as $telefone) { ?>
								<tr>
									<td class="text-right">Telefone <?php echo $y ?></td>
									<td><?php echo $telefone->Numero ?> - Ramal: <?php echo $telefone->Ramal ?><br>
										Última Atualização: <?php echo $this->Custom->formatDate($telefone->DataAtualizacao) ?></td>
								</tr>
								<?php $y++; } ?>

								<tr>
									<td colspan="2">Email(s)</td>
								</tr>
								<?php $z = 1; foreach ($result->Emails as $email) { ?>
								<tr>
									<td class="text-right">Email <?php echo $z ?></td>
									<td><?php echo $email->Email ?></td>
								</tr>
								<?php $z++; } ?>

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