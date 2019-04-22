<div id="page-wrapper">
	<div class="container-fluid">

		<?php echo $this->element('breadcrumb'); ?>

		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<h3 class="box-title m-b-0"><?php echo $title_for_layout ?></h3>
					<p class="text-muted m-b-20">Listagem de todos os <?php echo $title_for_layout ?> cadastrados no sistema | Total: <?php echo $numbers ?></p>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
						<tr>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Nome</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Email</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Celular</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Dt. Cadastro</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Status</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Ativar/Destivar esta newsletter"></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($result as $item): ?>
						<tr id="<?php echo $item[Inflector::singularize($this->name)]['id'] ?>" data-role="newsletters" data-action="ajax_delete">
							<td><?php echo $item[Inflector::singularize($this->name)]['id'] ?></td>
							<td><?php echo $item[Inflector::singularize($this->name)]['name'] ?></td>
							<td><?php echo $item[Inflector::singularize($this->name)]['email'] ?></td>
							<td><?php echo $item[Inflector::singularize($this->name)]['celular'] ?></td>
							<td><?php echo $this->Custom->formatDate($item[Inflector::singularize($this->name)]['created']) ?></td>
							<td><?php echo ( $item[Inflector::singularize($this->name)]['status'] ? "Ativo" : "Inativo" ) ?></td>
							<td class="text-center fit"><input data-size="small" <?php echo ( $item[Inflector::singularize($this->name)]['status'] ? "checked" : "" ) ?> value="<?php echo ( $item[Inflector::singularize($this->name)]['status'] ? "1" : "0" ) ?>" type="checkbox" class="js-switch confirmInactiveItem" data-color="#009efb" title="Inativar" onclick="" /></td>
						</tr>
						<?php endforeach; ?>
						<?php unset($result); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/plugins/bower_components/switchery/dist/switchery.min.js"></script>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>