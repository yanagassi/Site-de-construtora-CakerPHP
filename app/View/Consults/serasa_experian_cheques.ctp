<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="/consultas/serasa-experian/serasa-experian-cheques" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Nova</a>
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

				<h3 class="text-center">CHEQUES - Consulta de Cheques por CPF/CNPJ</h3>
				<h5 class="text-center">SERASA Experian</h5>

				<?php if ( empty($result) ) { ?>
				<form method="post" action="/consultas/serasa-experian/serasa-experian-cheques">
					<div class="form-group">
						<label for="Documento">CNPJ</label>
						<input name="data[Consult][document]" type="text" class="form-control" id="Documento" placeholder="99.999.999/9999-99" maxlength="18" required value="04.088.208/0001-65">
					</div>
					<div class="form-group">
						<label for="Banco">Banco</label>
						<input name="data[Consult][banco]" type="text" class="form-control" id="Banco" placeholder="" maxlength="5" required value="756">
					</div>
					<div class="form-group">
						<label for="Agência">Agência</label>
						<input name="data[Consult][agencia]" type="text" class="form-control" id="Agencia" placeholder="" maxlength="5" required value="4238">
					</div>
					<div class="form-group">
						<label for="ContaCorrente">Conta Corrente</label>
						<input name="data[Consult][conta_corrente]" type="text" class="form-control" id="ContaCorrente" placeholder="" maxlength="10" required value="528001-0">
					</div>
					<div class="form-group">
						<label for="NumeroChequeInicial">Número Cheque Inicial</label>
						<input name="data[Consult][numero_cheque_inicial]" type="text" class="form-control" id="NumeroChequeInicial" placeholder="" maxlength="10" required value="000185-6">
					</div>
					<div class="form-group">
						<label for="NumeroChequeFinal">Número Cheque Final</label>
						<input name="data[Consult][numero_cheque_final]" type="text" class="form-control" id="NumeroChequeFinal" placeholder="" maxlength="10" required value="000185-6">
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
									<td><?php echo $result->TotalOcorrencias ?></td>
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
								<?php if ( isset($result->SinteseCadastral->DataNascimento) ) : ?>
									<tr>
										<td class="text-right">Data de Nascimento</td>
										<td><?php echo $result->SinteseCadastral->DataNascimento ?></td>
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
									<td><?php echo $tel->Telefone ?></td>
								</tr>
								<?php } ?>
								<?php endif; ?>
								<?php /* END - Alerta Documentos */  ?>


								<?php /* BEGIN - ChequesResumo */  ?>
								<tr>
									<td colspan="2">Cheques Resumo</td>
								</tr>
								<?php if ( !empty($result->ChequesResumo->TotalMensagens) ) : ?>
									<tr>
										<td class="text-right">Total de Mensagens</td>
										<td><?php echo $result->ChequesResumo->TotalMensagens ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->ChequesResumo->NomeFantasiaBanco) ) : ?>
									<tr>
										<td class="text-right">Nome do Banco</td>
										<td><?php echo $result->ChequesResumo->NomeFantasiaBanco ?></td>
									</tr>
								<?php endif; ?>
								<?php if ( !empty($result->ChequesResumo->ChequeDetalhe) ) : ?>
									<tr>
										<td colspan="2">Detalhe do(s) Cheque(s)</td>
									</tr>
									<?php foreach( $result->ChequesResumo->ChequeDetalhe as $cheque ) { ?>
										<tr>
											<td class="text-right">Banco</td>
											<td><?php echo $cheque->Banco ?></td>
										</tr>
										<tr>
											<td class="text-right">Agência</td>
											<td><?php echo $cheque->Agencia ?></td>
										</tr>
										<tr>
											<td class="text-right">Conta Corrente</td>
											<td><?php echo $cheque->ContaCorrente ?></td>
										</tr>
										<tr>
											<td class="text-right">Número Cheque</td>
											<td><?php echo $cheque->NumeroCheque ?></td>
										</tr>
										<tr>
											<td class="text-right">Motivo</td>
											<td><?php echo $cheque->Motivo ?></td>
										</tr>
										<tr>
											<td class="text-right">Data de Cadastro</td>
											<td><?php echo $cheque->DataCadastro ?></td>
										</tr>
										<tr>
											<td class="text-right">Data de Cadastro</td>
											<td><?php echo $cheque->DataCadastro .' - '. $cheque->HoraCadastro ?></td>
										</tr>
										<tr>
											<td class="text-right">Código da Fonte</td>
											<td><?php echo $cheque->CodigoDaFonte ?></td>
										</tr>
									<?php } ?>
								<?php endif; ?>
								<?php /* END - ChequesResumo */  ?>


								<?php /* BEGIN - PendenciasInternas */  ?>
								<?php if ( !empty($result->PendenciasInternas) && $result->PendenciasInternas->TotalOcorrencias > 0 ) : ?>
									<tr>
										<td colspan="2">Pendências Internas</td>
									</tr>
									<tr>
										<td class="text-right">Total de Ocorrências</td>
										<td><?php echo $result->PendenciasInternas->TotalOcorrencias ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Antiga</td>
										<td><?php echo $result->PendenciasInternas->OcorrenciaMaisAntiga ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Recente</td>
										<td><?php echo $result->PendenciasInternas->OcorrenciaMaisRecente ?></td>
									</tr>
									<tr>
										<td class="text-right">Valor Total das Ocorrências</td>
										<td><?php echo $result->PendenciasInternas->ValorTotalOcorrencias ?></td>
									</tr>
									<?php if ( !empty($result->PendenciasInternas->PendenciasIternasDetalhe) ) : ?>
										<tr>
											<td colspan="2">Detalhes das Pendências Internas</td>
										</tr>
										<?php foreach( $result->PendenciasInternas->PendenciasIternasDetalhe as $detalhe ) { ?>
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
												<td class="text-right">Tipo da Moeda</td>
												<td><?php echo $detalhe->TipoMoeda ?></td>
											</tr>
											<tr>
												<td class="text-right">Valor</td>
												<td><?php echo $detalhe->Valor ?></td>
											</tr>
											<tr>
												<td class="text-right">Contrato</td>
												<td><?php echo $detalhe->Contrato ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - PendenciasInternas */  ?>


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
												<td class="text-right">Documento do Credor</td>
												<td><?php echo $detalhe->DocumentoCredor ?></td>
											</tr>
											<tr>
												<td class="text-right">Nome do Credor</td>
												<td><?php echo $detalhe->NomeCredor ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência</td>
												<td><?php echo $detalhe->DataOcorrencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Natureza</td>
												<td><?php echo $detalhe->Natureza ?></td>
											</tr>
											<tr>
												<td class="text-right">Descrição da Natureza</td>
												<td><?php echo $detalhe->NaturezaDescricao ?></td>
											</tr>
											<tr>
												<td class="text-right">Praça</td>
												<td><?php echo $detalhe->Praca ?></td>
											</tr>
											<tr>
												<td class="text-right">Principal</td>
												<td><?php echo $detalhe->Principal ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Inclusão</td>
												<td><?php echo $detalhe->DataHoraInclusao ?></td>
											</tr>
											<tr>
												<td class="text-right">Modalidade</td>
												<td><?php echo $detalhe->Modalidade ?></td>
											</tr>
											<tr>
												<td class="text-right">Descrição da Modalidade</td>
												<td><?php echo $detalhe->ModalidadeDescricao ?></td>
											</tr>
											<tr>
												<td class="text-right">Distribuidor</td>
												<td><?php echo $detalhe->Distribuidor ?></td>
											</tr>
											<tr>
												<td class="text-right">Vara</td>
												<td><?php echo $detalhe->Vara ?></td>
											</tr>
											<tr>
												<td class="text-right">Processo</td>
												<td><?php echo $detalhe->Processo ?></td>
											</tr>
											<tr>
												<td class="text-right">Valor</td>
												<td><?php echo $detalhe->Valor ?></td>
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
												<td class="text-right">Data Sub Judice</td>
												<td><?php echo $detalhe->DataSubJudice ?></td>
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
										<td class="text-right">Mensagem</td>
										<td><?php echo $result->PendenciasBacen->Mensagem ?></td>
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
												<td class="text-right">Agência</td>
												<td><?php echo $detalhe->Agencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Cidade</td>
												<td><?php echo $detalhe->Cidade ?></td>
											</tr>
											<tr>
												<td class="text-right">UF</td>
												<td><?php echo $detalhe->Estado ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - Pendências Bacen */  ?>


								<?php /* BEGIN - Contumacias */  ?>
								<?php if ( isset($result->Contumacias->ContumaciaResumo->TotalOcorrencias) && $result->Contumacias->ContumaciaResumo->TotalOcorrencias > 0 ) : ?>
									<tr>
										<td colspan="2">Pendências Bacen</td>
									</tr>
									<tr>
										<td class="text-right">Mensagem</td>
										<td><?php echo $result->Contumacias->ConsumaciaResumo->Mensagem ?></td>
									</tr>
									<tr>
										<td class="text-right">Total de Ocorrências</td>
										<td><?php echo $result->Contumacias->ConsumaciaResumo->TotalOcorrencias ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Antiga</td>
										<td><?php echo $result->Contumacias->ConsumaciaResumo->OcorrenciaMaisAntiga ?></td>
									</tr>
									<tr>
										<td class="text-right">Ocorrência Mais Recente</td>
										<td><?php echo $result->Contumacias->ConsumaciaResumo->OcorrenciaMaisRecente ?></td>
									</tr>
									<tr>
										<td class="text-right">Detalhe</td>
										<td><?php echo $result->Contumacias->ConsumaciaResumo->ContumaciaDetalhe ?></td>
									</tr>
									<?php if ( !empty($result->Contumacias->ContumaciaDetalhe) ) : ?>
										<tr>
											<td colspan="2">Detalhes das Costumacias</td>
										</tr>
										<?php foreach( $result->Contumacias->ContumaciaDetalhe as $detalhe ) { ?>
											<tr>
												<td class="text-right">Cóodigo Compensação</td>
												<td><?php echo $detalhe->CodigoCompensacao ?></td>
											</tr>
											<tr>
												<td class="text-right">Agência</td>
												<td><?php echo $detalhe->Agencia ?></td>
											</tr>
											<tr>
												<td class="text-right">Conta Corrente</td>
												<td><?php echo $detalhe->ContaCorrente ?></td>
											</tr>
											<tr>
												<td class="text-right">Número Cheque Inicial</td>
												<td><?php echo $detalhe->NumeroChequeInicial ?></td>
											</tr>
											<tr>
												<td class="text-right">Número Cheque Final</td>
												<td><?php echo $detalhe->NumeroChequeFinal ?></td>
											</tr>
											<tr>
												<td class="text-right">Motivo</td>
												<td><?php echo $detalhe->Motivo ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência</td>
												<td><?php echo $detalhe->DataOcorrencia ?></td>
											</tr>
											<tr>
												<td class="text-right">CodigoDaFonte</td>
												<td><?php echo $detalhe->CodigoDaFonte ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - Contumacias */  ?>


								<?php /* BEGIN - Historicos */  ?>
								<?php if ( isset($result->Historicos->Resumo->TotalConsultasCheque) && $result->Historicos->Resumo->TotalConsultasCheque > 0 ) : ?>
									<tr>
										<td colspan="2">Históricos</td>
									</tr>
									<tr>
										<td class="text-right">Mensagem</td>
										<td><?php echo $result->Historicos->Mensagem ?></td>
									</tr>
									<tr>
										<td class="text-right">Número Cheque</td>
										<td><?php echo $result->Historicos->Resumo->NumeroCheque ?></td>
									</tr>
									<tr>
										<td class="text-right">Total de Ocorrências</td>
										<td><?php echo $result->Historicos->Resumo->TotalConsultasCheque ?></td>
									</tr>
									<tr>
										<td class="text-right">Data da Consulta Mais Antiga</td>
										<td><?php echo $result->Historicos->Resumo->DataConsultaMaisAntiga ?></td>
									</tr>
									<tr>
										<td class="text-right">Data Consulta Mais Recente</td>
										<td><?php echo $result->Historicos->Resumo->DataConsultaMaisRecente ?></td>
									</tr>
									<tr>
										<td class="text-right">Última Empresa Consultante</td>
										<td><?php echo $result->Historicos->Resumo->UltimaEmpresaConsultante ?></td>
									</tr>
									<tr>
										<td class="text-right">Quantidade de Dado Cadastral</td>
										<td><?php echo $result->Historicos->Resumo->QuantidadeDadoCadastral ?></td>
									</tr>
									<tr>
										<td class="text-right">Quantidade Conta Corrente</td>
										<td><?php echo $result->Historicos->Resumo->QuantidadeContaCorrente ?></td>
									</tr>
									<?php if ( !empty($result->Historicos->DadosCadastrais) ) : ?>
										<tr>
											<td colspan="2">Dados Cadastrais</td>
										</tr>
										<?php foreach( $result->Historicos->DadosCadastrais as $detalhe ) { ?>
											<tr>
												<td class="text-right">Tipo de Documento</td>
												<td><?php echo $detalhe->TipoDocumento ?></td>
											</tr>
											<tr>
												<td class="text-right">Documento</td>
												<td><?php echo $detalhe->Documento ?></td>
											</tr>
											<tr>
												<td class="text-right">Nome</td>
												<td><?php echo $detalhe->Nome ?></td>
											</tr>
											<tr>
												<td class="text-right">Quantidade de Consultas</td>
												<td><?php echo $detalhe->QuantidadeConsultas ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência Mais Antiga</td>
												<td><?php echo $detalhe->DataOcorrenciaMaisAntiga ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência Mais Recente</td>
												<td><?php echo $detalhe->DataOcorrenciaMaisRecente ?></td>
											</tr>
											<tr>
												<td class="text-right">Última Empresa Consultante</td>
												<td><?php echo $detalhe->UltimaEmpresaConsultante ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>

									<?php if ( !empty($result->Historicos->ContaCorrente) ) : ?>
										<tr>
											<td colspan="2">Conta Corrente</td>
										</tr>
										<?php foreach( $result->Historicos->ContaCorrente as $detalhe ) { ?>
											<tr>
												<td class="text-right">Tipo de Documento</td>
												<td><?php echo $detalhe->TipoDocumento ?></td>
											</tr>
											<tr>
												<td class="text-right">Documento</td>
												<td><?php echo $detalhe->Documento ?></td>
											</tr>
											<tr>
												<td class="text-right">Nome</td>
												<td><?php echo $detalhe->Nome ?></td>
											</tr>
											<tr>
												<td class="text-right">Quantidade de Consultas</td>
												<td><?php echo $detalhe->QuantidadeConsultas ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência Mais Antiga</td>
												<td><?php echo $detalhe->DataOcorrenciaMaisAntiga ?></td>
											</tr>
											<tr>
												<td class="text-right">Data da Ocorrência Mais Recente</td>
												<td><?php echo $detalhe->DataOcorrenciaMaisRecente ?></td>
											</tr>
											<tr>
												<td class="text-right">Última Empresa Consultante</td>
												<td><?php echo $detalhe->UltimaEmpresaConsultante ?></td>
											</tr>
										<?php } ?>
									<?php endif; ?>
								<?php endif; ?>
								<?php /* END - Historicos */  ?>


								<?php /* BEGIN - AgenciaBancaria */  ?>
								<?php if ( isset($result->AgenciaBancaria->TotalOcorrencias) && $result->AgenciaBancaria->TotalOcorrencias > 0 ) : ?>
									<tr>
										<td colspan="2">Agência Bancária</td>
									</tr>
									<tr>
										<td class="text-right">Nome da Agêencia</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaResumo->NomeAgencia ?></td>
									</tr>
									<tr>
										<td class="text-right">Data Última Atualização</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaResumo->DataUltimaAtualizacao ?></td>
									</tr>
									<tr>
										<td class="text-right">Fone</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaResumo->Fone ?></td>
									</tr>
									<tr>
										<td class="text-right">Fax</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaResumo->Fax ?></td>
									</tr>

									<tr>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaEndereco->Logradouro ?></td>
									</tr>
									<tr>
										<td class="text-right">Cidade</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaEndereco->Cidade ?></td>
									</tr>
									<tr>
										<td class="text-right">Estado</td>
										<td><?php echo $result->AgenciaBancaria->AgenciaBancariaEndereco->Estado ?></td>
									</tr>
								<?php endif; ?>
								<?php /* END - AgenciaBancaria */  ?>


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