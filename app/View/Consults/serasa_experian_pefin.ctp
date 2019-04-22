<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/serasa-experian/serasa-experian-pefin" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
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

				<h3 class="text-center">PEFIN - Pendências Financeiras</h3>
				<h5 class="text-center">SERASA Experian</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/serasa-experian/serasa-experian-pefin">
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
					<?php if ( ! $result->Status ) { ?>
						O CNPJ <?php echo $this->Custom->mask_cpf_cnpj($result->SinteseCadastral->Documento) ?> consultado é <strong>inválido!</strong></p>
					<?php }else{ ?>
						O CNPJ <strong><?php echo $this->Custom->mask_cpf_cnpj($result->SinteseCadastral->Documento) ?></strong> consultado é <strong>válido!</strong>
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
									<td>Total de Ocorrências</td>
									<td><?php echo $result->ValorTotalOcorrencias ?></td>
								</tr>
								<tr>
									<td>Valor Total de Ocorrências</td>
									<td><?php echo $result->ValorTotalOcorrencias ?></td>
								</tr>

								<?php /* BEGIN - Síntese Cadastral */  ?>
								<tr>
									<td colspan="2">Síntese Cadastral</td>
								</tr>

								<?php if ( !empty($result->SinteseCadastral->Documento) ) : ?>
								<tr>
									<td class="text-right">Documento</td>
									<td><?php echo $this->Custom->mask_cpf_cnpj($result->SinteseCadastral->Documento) ?></td>
								</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->Nome) ) : ?>
									<tr>
										<td class="text-right">Nome</td>
										<td><?php echo $result->SinteseCadastral->Nome ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->NomeMae) ) : ?>
									<tr>
										<td class="text-right">Nome da Mãe</td>
										<td><?php echo $result->SinteseCadastral->NomeMae ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->NomeFantasia) ) : ?>
									<tr>
										<td class="text-right">Nome Fantasia</td>
										<td><?php echo $result->SinteseCadastral->NomeFantasia ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->DataNascimento) ) : ?>
									<tr>
										<td class="text-right">Data de Nascimento</td>
										<td><?php echo $result->SinteseCadastral->DataNascimento ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->DataFundacao) ) : ?>
									<tr>
										<td class="text-right">Data de Fundação</td>
										<td><?php echo $result->SinteseCadastral->DataFundacao ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->SituacaoRFB) ) : ?>
									<tr>
										<td class="text-right">Situação na Receita Federal</td>
										<td><?php echo $result->SinteseCadastral->SituacaoRFB ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->SituacaoDescricaoRFB) ) : ?>
									<tr>
										<td class="text-right">Descrição da Situação na Receita Federal</td>
										<td><?php echo $result->SinteseCadastral->SituacaoDescricaoRFB ?></td>
									</tr>
								<?php endif; ?>

								<?php if ( isset($result->SinteseCadastral->DataSituacaoRFB) ) : ?>
									<tr>
										<td class="text-right">Data Situação na Receita Federal</td>
										<td><?php echo $result->SinteseCadastral->DataSituacaoRFB ?></td>
									</tr>
								<?php endif; ?>

								<?php /* END - Síntese Cadastral */  ?>




								<?php /* BEGIN - Alerta Documentos */  ?>
								<tr>
									<td colspan="2">Alerta Documentos</td>
								</tr>
								<?php if ( !empty($result->AlertaDocumentos->NumeroMensagem) ) : ?>
									<tr>
										<td class="text-right">Número de Mensagem</td>
										<td><?php echo $result->AlertaDocumentos->NumeroMensagem ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->TotalMensagens) ) : ?>
									<tr>
										<td class="text-right">Total de Mensagens</td>
										<td><?php echo $result->AlertaDocumentos->TotalMensagens ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->TipoDocumento) ) : ?>
									<tr>
										<td class="text-right">Tipo de Documento</td>
										<td><?php echo $result->AlertaDocumentos->TipoDocumento ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->NumeroDocumento) ) : ?>
									<tr>
										<td class="text-right">Número do Documento</td>
										<td><?php echo $result->AlertaDocumentos->NumeroDocumento ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->MotivoOcorrencia) ) : ?>
									<tr>
										<td class="text-right">Motivo da Ocorrência</td>
										<td><?php echo $result->AlertaDocumentos->MotivoOcorrencia ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->DataOcorrencia) ) : ?>
									<tr>
										<td class="text-right">Data da Ocorrência</td>
										<td><?php echo $result->AlertaDocumentos->DataOcorrencia ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->Mensagem) ) : ?>
									<tr>
										<td class="text-right">Mensagem</td>
										<td><?php echo $result->AlertaDocumentos->Mensagem ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->AlertaDocumentos->TelefonesContato) ) : ?>
								<tr>
									<td colspan="2">Telefones</td>
								</tr>
								<?php foreach( $result->AlertaDocumentos->TelefonesContato as $tel ) { ?>
								<tr>
									<td class="text-right">Telefone</td>
									<td><?php echo $tel['Telefone'] ?></td>
								</tr>
								<?php } ?>
								<?php endif; ?>
								<?php /* END - Alerta Documentos */  ?>


								<?php /* BEGIN - Pendências Financeiras */  ?>
								<?php if ( !empty($result->PendenciasFinanceiras) && $result->PendenciasFinanceiras->TotalOcorrencias > 0 ) : ?>
									<tr>
										<td colspan="2">Pendências Financeiras</td>
									</tr>
									<tr>
										<td class="text-right">Total de Ocorrências</td>
										<td><?php echo $result->PendenciasFinanceiras->TotalOcorrencias ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Antiga</td>
										<td><?php echo $result->PendenciasFinanceiras->OcorrenciaMaisAntiga ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Recente</td>
										<td><?php echo $result->PendenciasFinanceiras->OcorrenciaMaisRecente ?></td>
									</tr>
									<tr>
										<td class="text-right">Valor Total das Ocorrências</td>
										<td><?php echo $result->PendenciasFinanceiras->ValorTotalOcorrencias ?></td>
									</tr>

									<?php if ( !empty($result->PendenciasFinanceiras->PendenciasFinanceirasDetalhe) ) : ?>
										<tr>
											<td colspan="2">Detalhes das Pendências Financeiras</td>
										</tr>
										<?php foreach( $result->PendenciasFinanceiras->PendenciasFinanceirasDetalhe as $detalhe ) { ?>
											<tr>
												<td class="text-right">Data da Ocorrência</td>
												<td><?php echo $detalhe->DataOcorrencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Modalidade</td>
												<td><?php echo $detalhe->Modalidade ?></td>
											</tr>
											<tr>
												<td class="text-right">Avalista</td>
												<td><?php echo $detalhe->Avalista ?></td>
											</tr>
											<tr>
												<td class="text-right">Valor</td>
												<td><?php echo $detalhe->TipoMoeda . $detalhe->Valor ?></td>
											</tr>
											<tr>
												<td class="text-right">Contrato</td>
												<td><?php echo $detalhe->Contrato ?></td>
											</tr>
											<tr>
												<td class="text-right">Origem</td>
												<td><?php echo $detalhe->Origem ?></td>
											</tr>
											<tr>
												<td class="text-right">Sigla</td>
												<td><?php echo $detalhe->Sigla ?></td>
											</tr>
											<tr>
												<td class="text-right">Sub Judice</td>
												<td><?php echo $detalhe->SubJudice ?></td>
											</tr>
											<tr>
												<td class="text-right">Descrição Sub Judice</td>
												<td><?php echo $detalhe->SubJudiceDescricao ?></td>
											</tr>
											<tr>
												<td class="text-right">Tipo de Anotação</td>
												<td><?php echo $detalhe->TipoAnotacao ?></td>
											</tr>
											<tr>
												<td class="text-right">Descrição do Tipo de Anotação</td>
												<td><?php echo $detalhe->TipoAnotacaoDescricao ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - Pendências Financeiras */  ?>


								<?php /* BEGIN - Pendências Bacen */  ?>
								<?php if ( !empty($result->PendenciasBacen) && $result->PendenciasBacen->TotalOcorrencias > 0 ) : ?>
									<tr>
										<td colspan="2">Pendências Bacen</td>
									</tr>
									<tr>
										<td class="text-right">Total de Ocorrências</td>
										<td><?php echo $result->PendenciasBacen->TotalOcorrencias ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Antiga</td>
										<td><?php echo $result->PendenciasBacen->OcorrenciaMaisAntiga ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Recente</td>
										<td><?php echo $result->PendenciasBacen->OcorrenciaMaisRecente ?></td>
									</tr>
									<tr>
										<td class="text-right">Número do Banco</td>
										<td><?php echo $result->PendenciasBacen->Banco ?></td>
									</tr>
									<tr>
										<td class="text-right">Agência</td>
										<td><?php echo $result->PendenciasBacen->Agencia ?></td>
									</tr>
									<tr>
										<td class="text-right">Nome do Banco</td>
										<td><?php echo $result->PendenciasBacen->NomeFantasiaBanco ?></td>
									</tr>
									<?php if ( !empty($result->PendenciasBacen->PendenciasBacenDetalhe) ) : ?>
										<tr>
											<td colspan="2">Detalhes das Pendências Bacen</td>
										</tr>
										<?php foreach( $result->PendenciasBacen->PendenciasBacenDetalhe as $detalhe ) { ?>
											<tr>
												<td class="text-right">Data da Ocorrência</td>
												<td><?php echo $detalhe->DataOcorrencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Número do Cheque</td>
												<td><?php echo $detalhe->NumeroCheque ?></td>
											</tr>
											<tr>
												<td class="text-right">Alinea Cheque</td>
												<td><?php echo $detalhe->AlineaCheque ?></td>
											</tr>
											<tr>
												<td class="text-right">Quantidade CCF Banco</td>
												<td><?php echo $detalhe->QuantidadeCCFBanco ?></td>
											</tr>
											<tr>
												<td class="text-right">Valor</td>
												<td><?php echo $detalhe->Valor ?></td>
											</tr>
											<tr>
												<td class="text-right">Número do Banco</td>
												<td><?php echo $detalhe->Banco ?></td>
											</tr>
											<tr>
												<td class="text-right">Banco</td>
												<td><?php echo $detalhe->NomeBanco ?></td>
											</tr>
											<tr>
												<td class="text-right">Agência</td>
												<td><?php echo $detalhe->Agencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Cidade</td>
												<td><?php echo $detalhe->Cidade ?></td>
											</tr>
											<tr>
												<td class="text-right">UF</td>
												<td><?php echo $detalhe->UF ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - Pendências Bacen */  ?>


								<?php /* BEGIN - QSA */  ?>
								<?php if ( !empty($result->QSA) && sizeof($result->QSA) > 0 ) : ?>
									<tr>
										<td colspan="2">Sócios e Administradores</td>
									</tr>
									<?php if ( !empty($result->QSA->Socios) && sizeof($result->QSA->Socios) > 0 ) : ?>
									<tr>
										<td colspan="2">Sócios</td>
									</tr>
									<?php $x=1;foreach ($result->QSA->Socios as $socios) { ?>
									<tr>
										<td class="text-right"></td>
										<td class=""><strong>Sócio <?php echo $x ?></strong></td>
									</tr>
									<tr>
										<td class="text-right">Nome</td>
										<td><?php echo $socios->Nome ?></td>
									</tr>
									<tr>
										<td class="text-right">Documento</td>
										<td><?php echo $this->Custom->mask_cpf_cnpj($socios->Documento) ?></td>
									</tr>
									<tr>
										<td class="text-right">Capital</td>
										<td><?php echo $socios->Capital ?></td>
									</tr>
									<?php $x++; } ?>
									<?php endif; ?>


									<?php if ( !empty($result->QSA->Administradores) && sizeof($result->QSA->Administradores) > 0 ) : ?>
										<tr>
											<td colspan="2">Administradores</td>
										</tr>
										<?php $y=1; foreach ($result->QSA->Administradores as $socios) { ?>
											<tr>
												<td class="text-right"></td>
												<td class=""><strong>Administrador <?php echo $y ?></strong></td>
											</tr>
											<tr>
												<td class="text-right">Nome</td>
												<td><?php echo $socios->Nome ?></td>
											</tr>
											<tr>
												<td class="text-right">Documento</td>
												<td><?php echo $this->Custom->mask_cpf_cnpj($socios->Documento) ?></td>
											</tr>
											<tr>
												<td class="text-right">Cargo</td>
												<td><?php echo $socios->Cargo ?></td>
											</tr>
										<?php $y++; } ?>
									<?php endif; ?>
								<?php endif; ?>

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