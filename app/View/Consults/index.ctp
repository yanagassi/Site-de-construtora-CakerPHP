<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Consultas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'plans', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/consultas" title="Voltar">Consultas</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<section class="m-t-40">
					<div class="sttabs tabs-style-linebox">
						<nav>
							<ul>
								<li class="tab-current"><a href="#section-linebox-5"><span>CDC</span></a></li>
								<li class=""><a href="#section-linebox-4"><span>Receita Federal</span></a></li>
								<li class=""><a href="#section-linebox-2"><span>SERASA Experian</span></a></li>
								<li class=""><a href="#section-linebox-3"><span>CEP</span></a></li>
							</ul>
						</nav>
						<div class="content-wrap text-center">
							<section id="section-linebox-1" class="content-current">
								<h3>Confirmação de Dados Cadastrais (CDC)</h3>
								<p>Veja abaixo as consultas que você pode realizar através deste serviço:<br>(valores por consulta realizada *)</p>



								<div class="table-responsive" style="width:<?php echo $percent_table ?>;margin:0px auto;float: none;">
									<table class="table text-left">
										<thead>
										<tr>
											<th>Consulta</th>
											<th>Valor*</th>
											<th>Consultar</th>
											<th>Detalhes</th>
										</tr>
										</thead>
										<tbody>

										<?php foreach ($result as $item) : ?>
											<?php if ( $item['ConsultCategory']['type'] == 'CDC' ) : ?>
												<tr>
													<td><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>"><?php echo $item['ConsultCategory']['name'] ?></a></td>
													<td><?php echo "R$" . $this->Custom->numberFormatToBR($item['ConsultCategory']['value_aveeze']) ?></td>
													<td><div class="label label-table label-success"><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>" class="btn-success">Consultar</a></div></td>
													<td><div class="label label-table label-info"><a href="#" class="btn-info">Saiba Mais</a></div></td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>

										</tbody>
									</table>
								</div>


							</section>
							<section id="section-linebox-2" class="">
								<h3>Receita Federal</h3>
								<p>Veja abaixo as consultas que você pode realizar através deste serviço:</p>

								<div class="table-responsive" style="width:<?php echo $percent_table ?>;margin:0px auto;float: none;">
									<table class="table text-left">
										<thead>
										<tr>
											<th>Consulta</th>
											<th>Valor</th>
											<th>Consultar</th>
											<th>Detalhes</th>
										</tr>
										</thead>
										<tbody>

										<?php foreach ($result as $item) : ?>
											<?php if ( $item['ConsultCategory']['type'] == 'Receita Federal' ) : ?>
												<tr>
													<td><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>"><?php echo $item['ConsultCategory']['name'] ?></a></td>
													<td><?php echo "R$" . $this->Custom->numberFormatToBR($item['ConsultCategory']['value_aveeze']) ?></td>
													<td><div class="label label-table label-success"><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>" class="btn-success">Consultar</a></div></td>
													<td><div class="label label-table label-info"><a href="#" class="btn-info">Saiba Mais</a></div></td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>

										</tbody>
									</table>
								</div>

							</section>
							<section id="section-linebox-3" class="">
								<h3>Serasa Experian</h3>
								<p>Veja abaixo as consultas que você pode realizar através deste serviço:</p>

								<div class="table-responsive" style="width:<?php echo $percent_table ?>;margin:0px auto;float: none;">
									<table class="table text-left">
										<thead>
										<tr>
											<th>Consulta</th>
											<th>Valor</th>
											<th>Consultar</th>
											<th>Detalhes</th>
										</tr>
										</thead>
										<tbody>

										<?php foreach ($result as $item) : ?>
											<?php if ( $item['ConsultCategory']['type'] == 'SERASA Experian' ) : ?>
												<tr>
													<td><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>"><?php echo $item['ConsultCategory']['name'] ?></a></td>
													<td><?php echo "R$" . $this->Custom->numberFormatToBR($item['ConsultCategory']['value_aveeze']) ?></td>
													<td><div class="label label-table label-success"><a href="/consultas/serasa-experian/<?php echo $item['ConsultCategory']['slug'] ?>" class="btn-success">Consultar</a></div></td>
													<td><div class="label label-table label-info"><a href="#" class="btn-info">Saiba Mais</a></div></td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>

										</tbody>
									</table>
								</div>

							</section>
							<section id="section-linebox-4" class="">
								<h3>Consulta CEP</h3>
								<p>Veja abaixo as consultas que você pode realizar através deste serviço:</p>

								<div class="table-responsive" style="width:<?php echo $percent_table ?>;margin:0px auto;float: none;">
									<table class="table text-left">
										<thead>
										<tr>
											<th>Consulta</th>
											<th>Valor</th>
											<th>Consultar</th>
											<th>Detalhes</th>
										</tr>
										</thead>
										<tbody>

										<?php foreach ($result as $item) : ?>
											<?php if ( $item['ConsultCategory']['type'] == 'CEP' ) : ?>
												<tr>
													<td><a href="/consultas/cdc/<?php echo $item['ConsultCategory']['slug'] ?>"><?php echo $item['ConsultCategory']['name'] ?></a></td>
													<td><?php echo "R$" . $this->Custom->numberFormatToBR($item['ConsultCategory']['value_aveeze']) ?></td>
													<td><div class="label label-table label-success"><a href="/consultas/cep/<?php echo $item['ConsultCategory']['slug'] ?>" class="btn-success">Consultar</a></div></td>
													<td><div class="label label-table label-info"><a href="#" class="btn-info">Saiba Mais</a></div></td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>

										</tbody>
									</table>
								</div>

							</section>
						</div>
						<!-- /content -->
					</div>
					<!-- /tabs -->
				</section>

			</div>
		</div>
	</div>
</div>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>