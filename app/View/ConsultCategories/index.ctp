<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Serviços Serasa</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'consult_categories', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/configuracoes" title="Voltar para Configurações">Configurações</a></li>
				<li><a href="/configuracoes/serasa" title="Listar todos">Serviços Serasa</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Serviços Serasa</h3>
				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Nome</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Vl. Serasa</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Vl. Aveeze</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Categoria</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Status</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Criação</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Editar">Edit.</th>
						<!--<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9" class="text-center fit" title="Deletar">Del.</th>-->
					</tr>
					</thead>
					<tbody>

					<?php foreach ($data as $item): ?>
					<tr id="<?php echo $item['ConsultCategory']['id'] ?>">
						<td><?php echo $item['ConsultCategory']['id']; ?></td>
						<td><?php echo $this->Html->link($item['ConsultCategory']['name'], array('controller' => 'consult_categories', 'action' => 'view', $item['ConsultCategory']['id'])); ?></td>
						<td><?php echo "R$ ". $this->Custom->numberFormatToBR($item['ConsultCategory']['value_serasa']); ?></td>
						<td><?php echo "R$ ". $this->Custom->numberFormatToBR($item['ConsultCategory']['value_aveeze']); ?></td>
						<td><?php echo $item['ConsultCategory']['type']; ?></td>
						<td><?php echo ($item['ConsultCategory']['status'] ? "Ativo" : "Inativo"); ?></td>
						<td><?php echo $this->Custom->formatDateWithHours($item['ConsultCategory']['created']); ?></td>
						<td class="text-center fit"><a href="/configuracoes/serasa/editar/<?php echo $item['ConsultCategory']['id'] ?>" title="Editar"><i class="fa fa-pencil-square-o text-info"></i></a></td>
						<!--<td class="text-center fit"><a href="#" onclick="confirmDeleteItem(<?php //echo $plan['Plan']['id'] ?>)" title="Deletar"><i class="fa fa-trash-o text-danger"></i></a></td>-->
					</tr>
					<?php endforeach; ?>
					<?php unset($data); ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>