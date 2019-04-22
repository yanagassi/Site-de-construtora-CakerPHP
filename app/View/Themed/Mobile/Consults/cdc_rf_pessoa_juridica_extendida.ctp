<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/cdc/receita-federal-pessoa-juridica-extendida" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
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

				<h3 class="text-center">Consulta Pessoa Jurídica Estendida</h3>
				<h5 class="text-center">Receita Federal</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/cdc/receita-federal-pessoa-juridica-extendida">
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
									<td>Nome</td>
									<td><?php echo $result['RazaoSocial'] ?></td>
								</tr>
								<tr>
									<td>Nome Fantasia</td>
									<td><?php echo $result['NomeFantasia'] ?></td>
								</tr>
								<tr>
									<td>Data de Fundação</td>
									<td><?php echo $result['DataFundacao'] ?></td>
								</tr>
								<tr>
									<td>Código Atividade Econômica</td>
									<td><?php echo $result['CodigoAtividadeEconomica'] ?></td>
								</tr>
								<tr>
									<td>Código Atividade Econômica - Descrição</td>
									<td><?php echo $result['CodigoAtividadeEconomicaDescricao'] ?></td>
								</tr>
								<tr>
									<td>Código da Natureza Jurídica</td>
									<td><?php echo $result['CodigoNaturezaJuridica'] ?></td>
								</tr>
								<tr>
									<td>Código da Natureza Jurídica - Descrição</td>
									<td><?php echo $result['CodigoNaturezaJuridicaDescricao'] ?></td>
								</tr>
								<tr>
									<td>Situação na Receita Federal</td>
									<td><?php echo $result['SituacaoRFB'] ?></td>
								</tr>
								<tr>
									<td>Data da Situação</td>
									<td><?php echo $result['DataSituacaoRFB'] ?></td>
								</tr>
								<tr>
									<td>Data da Consulta</td>
									<td><?php echo $result['DataConsultaRFB'] ?></td>
								</tr>
								<tr>
									<td>Motivo da Consulta</td>
									<td><?php

										if ( !empty($result['MotivoSituacaoRFB']) )
										{
											(is_array($result['MotivoSituacaoRFB']) ? $var_arr = true : $var_arr = false );

											if ( $var_arr )
												print_r($result['MotivoSituacaoRFB']);
											else {
												echo $result['MotivoSituacaoRFB'];
											}
										}

										?></td>
								</tr>
								<tr>
									<td>Data de Motivo Especial da Consulta</td>
									<td><?php echo $result['DataMotivoEspecialSituacaoRFB'] ?></td>
								</tr>
								<tr>
									<td>Cartão</td>
									<td><?php

										if ( !empty($result['Cartao']) )
										{
											(is_array($result['Cartao']) ? $var_arr = true : $var_arr = false );

											if ( $var_arr )
												print_r($result['Cartao']);
											else {
												echo $result['Cartao'];
											}
										}

										?></td>
								</tr>
								<tr>
									<td>PDF da Consulta</td>
									<td><?php

										$file = '';

									if ( !empty($result['PDF']) )
									{
										$str_pdf_base64 = $result['PDF'];

										header("Content-Type: application/pdf");
										//header("Content-Disposition: inline; filename=" . $tempfile );
										$file = file_get_contents("data://application/pdf;base64," . $str_pdf_base64);
									}

										if ( empty($file) )
										{
											$pdf_link = 'javascript:void(0)';
											$content_pdf = 'Indisponível';
										}else{
											$pdf_link = $file;
										}


									?>
									<a href='<?php echo $pdf_link ?>'><?php echo $content_pdf ?></a></td>
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