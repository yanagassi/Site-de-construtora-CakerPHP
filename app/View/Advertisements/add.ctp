<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title"><?php echo $title_for_layout ?></h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="/admin/" title="Voltar para a Home">Início</a></li>
					<li><a href="/admin/anuncios/" title="Listar todos"><?php echo $title_for_layout ?></a></li>
					<li>Novo</li>
				</ol>
			</div>
		</div>
		<!-- /row -->

		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					<h3 class="box-title m-b-0"><?php echo $title_for_layout ?></h3>
					<p class="text-muted m-b-30">Novo</p>
					<section>
						<div class="sttabs tabs-style-bar">
							<nav>
								<ul>
									<li class="tab-current"><a href="#section-bar-1" class="sticon fa fa-newspaper-o"><span>Dados do Anúncio</span></a></li>
								</ul>
							</nav>
							<div class="content-wrap">
								<section id="section-bar-1" class="content-current">
									<h3>Dados do Anúncio</h3>
									<form method="post" action="/admin/anuncios/novo">
										<div class="form-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-12"><span class="help">Título do Anúncio (Ex.: Construfácil Reformas em Geral) *</span></label>
														<input type="text" rel="Advertisement" name="data[Advertisement][titulo_anuncio]" id="titulo_anuncio" required class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-12"><span class="help">Email</span></label>
														<input type="text" rel="Advertisement" name="data[Advertisement][email]" class="form-control">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-12"><span class="help">Descrição *</span></label>
														<textarea rel="Advertisement" name="data[Advertisement][quem_somos]" class="form-control ajaxSave" required rows="5"></textarea>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<label class="col-md-12"><span class="help">Tipo de Cadastro *</span></label>
													<div class="custom-control custom-radio">
														<input type="radio" id="customRadio1" name="data[Advertisement][tipo]" value="FÍSICA" class="custom-control-input" required>
														<label class="custom-control-label" for="customRadio1">Pessoa Física</label>
													</div>
													<div class="custom-control custom-radio">
														<input type="radio" id="customRadio2" name="data[Advertisement][tipo]" VALUE="JURÍDICA" class="custom-control-input" required>
														<label class="custom-control-label" for="customRadio2">Pessoa Jurídica</label>
													</div>
												</div>
											</div>
											<hr>
										</div>

										<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Salvar</button>
									</form>
								</section>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('footer'); ?>
</div>