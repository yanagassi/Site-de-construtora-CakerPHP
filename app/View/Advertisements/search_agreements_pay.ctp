<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Contratos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/contratos/buscar" title="Voltar para Contratos">Contratos</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="tab active"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Contrato</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Nome</strong> <br>
								<p class="text-muted"><?php echo $agreement['Agreement']['name']; ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>CPF/CNPJ</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->mask_cpf_cnpj($agreement['Agreement']['cpf_cnpj']); ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Valor</strong> <br>
								<p class="text-muted"><?php echo h($agreement['Agreement']['value']); ?></p>
							</div>
							<div class="col-md-3 col-xs-6"> <strong>Adicioando em:</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->formatDateWithHours($agreement['Agreement']['created']); ?></p>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-info">
								<div class="panel-heading">Dados de Pagamento</div>
								<div class="panel-wrapper collapse in" aria-expanded="true">
									<div class="panel-body">
										<form action="#" class="form-horizontal">
											<div class="form-body">
												<h3 class="box-title">Informações Pessoais</h3>
												<hr class="m-t-0 m-b-40">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Nome</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="John doe">
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Sobrenome</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="">
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Sexo</label>
															<div class="col-md-9">
																<select class="form-control">
																	<option value="1">M</option>
																	<option value="2">F</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Date of Birth</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="dd/mm/yyyy">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<h3 class="box-title">Dados do Cartão</h3>
												<hr class="m-t-0 m-b-40">
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Número</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Validade</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">CCV</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"></label>
															<div class="col-md-9">
																<button type="submit" class="btn btn-success">Validar Cartão</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn btn-success">Pagar</button>
																<button type="button" class="btn btn-default">Cancelar</button>
															</div>
														</div>
													</div>
													<div class="col-md-6"> </div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:history.back(-1);" class="fcbtn btn btn-info btn-outline btn-1c">Voltar</a>
</div>