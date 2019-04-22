<div id="page-wrapper">
	<div class="container-fluid">

		<?php echo $this->element('breadcrumb'); ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<h3 class="box-title m-b-0"><?php echo $title_for_layout ?></h3>


					<div class="table-responsive">
						<div id="example_wrapper" class="dataTables_wrapper">

							<div class="col-lg-12">
								<div class="col-lg-4">
									<p class="text-muted m-b-20">Listagem de todos os <?php echo $title_for_layout ?> cadastrados no sistema | Total: <?php echo $numbers ?></p>
								</div>
								<div class="col-lg-6">
									<div id="example_filter" class="dataTables_filter">
										<form action="/admin/anuncios" method="post" class="form_student">
											<label>Buscar: <input type="search" name="term" style="width:300px" class="form-control input-sm" placeholder="Digite o Título do Anúncio ou CPF/CNPJ" aria-controls="example"></label>
											<input type="submit" class="btn btn-default input-sm" value="OK">
										</form>
									</div>
								</div>
							</div>





							<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
								<thead>
								<tr>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Título</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Dt. Cadastro</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Plano</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Tipo</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">CPF/CNPJ</th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Editar"></th>
									<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9" class="text-center fit" title="Deletar"></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($result as $item): ?>
									<tr id="<?php echo $item[Inflector::singularize($this->name)]['id'] ?>" data-role="advertisements" data-action="ajax_delete_admin">
										<td><?php echo $item[Inflector::singularize($this->name)]['id'] ?></td>
										<td><?php echo $item[Inflector::singularize($this->name)]['titulo_anuncio'] ?></td>
										<td><?php echo $this->Custom->formatDateWithHours($item[Inflector::singularize($this->name)]['created']) ?></td>
										<td><?php echo $item['Plan']['nome'] ?></td>
										<td><?php echo $item[Inflector::singularize($this->name)]['tipo'] ?></td>
										<td><?php echo ( $item[Inflector::singularize($this->name)]['tipo'] == 'JURÍDICA' ? $this->Custom->mask_cpf_cnpj($item[Inflector::singularize($this->name)]['cnpj']) : $this->Custom->mask_cpf_cnpj($item[Inflector::singularize($this->name)]['cpf']) ) ?></td>
										<td><a href="/painel/anuncios/editar/<?php echo $item[Inflector::singularize($this->name)]['id'] ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
										<td class="text-center fit"><input data-size="small" <?php echo ( $item[Inflector::singularize($this->name)]['status'] == 2 ? "" : "checked" ) ?> value="<?php echo ( $item[Inflector::singularize($this->name)]['status'] == 2 ? "0" : "1" ) ?>" type="checkbox" class="js-switch confirmInactiveItem" data-color="#009efb" title="Inativar" onclick="" /></td>
									</tr>
								<?php endforeach; ?>
								<?php unset($result); ?>
								<?php echo $this->element('pagination'); ?>
								</tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="/plugins/bower_components/switchery/dist/switchery.min.js"></script>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>