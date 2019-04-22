<div id="page-wrapper">
	<div class="container-fluid">

		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title"><?php echo $title_for_layout ?></h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<?php echo $this->Html->link('Novo Anúncio', "/painel/anuncios/novo/", array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
				<ol class="breadcrumb">
					<li><a href="/painel/" title="Voltar para a Home">Início</a></li>
					<li><?php echo $title_for_layout ?></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<h3 class="box-title m-b-0"><?php echo $title_for_layout ?></h3>
					<p class="text-muted m-b-20">Listagem de todos os <?php echo $title_for_layout ?> no sistema | Total: <?php echo $numbers ?></p>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
						<tr>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id do Anúncio</th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Título do Anúncio</th>

							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="icon-eye text-info"></i></th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="icon-mouse text-success"></i></th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="icon-call-in text-primary"></i></th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="icon-envelope-open text-primary"></i></th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="fa fa-product-hunt text-primary" aria-hidden="true"></i></th>
							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit-50px"><i class="icon-wrench text-primary" aria-hidden="true"></i></th>

<!--							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit">Produtos Buscados</th>-->
<!--							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit">Serviços Buscados</th>-->

<!--							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Editar"></th>-->
<!--							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title=""></th>-->
<!--							<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9" class="text-center fit" title="Deletar"></th>-->
						</tr>
						</thead>
						<tbody>
						<?php foreach ($result as $item): ?>
						<tr id="<?php echo $item[Inflector::singularize($this->name)]['advertisement_id'] ?>" data-role="advertisements" data-action="ajax_delete">
							<td><?php echo $item[Inflector::singularize($this->name)]['advertisement_id'] ?></td>
							<td><?php echo $item['Advertisement']['titulo_anuncio'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_view'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_click'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_phone_click'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_email_click'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_product_view'] ?></td>
							<td class="text-center fit"><?php echo $item[0]['adv_service_view'] ?></td>

<!--							<td class="text-center fit">--><?php //echo count($adv_product_total) ?><!--</td>-->
<!--							<td class="text-center fit">--><?php //echo count($adv_service_total) ?><!--</td>-->

<!--							<td><a href="/painel/anuncios/editar/--><?php //echo $item[Inflector::singularize($this->name)]['advertisement_id'] ?><!--"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>-->
<!--							<td class="text-center fit"><input data-switchery="true" data-size="small" --><?php ////echo ( $item[Inflector::singularize($this->name)]['status'] ? "checked" : "" ) ?><!-- value="--><?php ////echo ( $item[Inflector::singularize($this->name)]['status'] ? "1" : "0" ) ?><!--" type="checkbox" class="js-switch confirmInactiveItem" data-color="#009efb" title="Inativar" onclick="" /></td>-->
<!--							<td class="text-center fit"><a href="#" onclick="confirmDeleteItem(--><?php ////echo $item[Inflector::singularize($this->name)]['id'] ////,'advertisements')" title="Deletar"><i class="fa fa-trash-o fa-2x text-danger"></i></a></td>?>
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