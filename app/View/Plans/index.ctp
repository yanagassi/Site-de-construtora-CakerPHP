<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Planos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'plans', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/configuracoes" title="Voltar para Configurações">Configurações</a></li>
				<li><a href="/configuracoes/planos" title="Listar todos">Planos</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Planos do Sistema</h3>
				<p class="text-muted m-b-20">Listagem de todos os planos do sistema | Total: <?php echo $numbers ?></p>
				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Nome</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Valor</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Qtde. Notificações</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Qtde. Consulta Serasa</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Qtde. Consulta de Registro Digital de Contratos</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Qtde. Usuários</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Criação</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Editar">Edit.</th>
						<!--<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9" class="text-center fit" title="Deletar">Del.</th>-->
					</tr>
					</thead>
					<tbody>

					<?php foreach ($plans as $plan): ?>
					<tr id="<?php echo $plan['Plan']['id'] ?>">
						<td><?php echo $plan['Plan']['id']; ?></td>
						<td><?php echo $this->Html->link($plan['Plan']['name'], array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Html->link("R$ ". $this->Custom->numberFormatToBR($plan['Plan']['value']), array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Html->link($plan['Plan']['qtde_notifications'], array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Html->link($plan['Plan']['qtde_consult_serasa'], array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Html->link($plan['Plan']['qtde_consult_agreements'], array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Html->link($plan['Plan']['qtde_users'], array('controller' => 'plans', 'action' => 'view', $plan['Plan']['id'])); ?></td>
						<td><?php echo $this->Custom->formatDateWithHours($plan['Plan']['created']); ?></td>
						<td class="text-center fit"><a href="/configuracoes/planos/editar/<?php echo $plan['Plan']['id'] ?>" title="Editar"><i class="fa fa-pencil-square-o text-info"></i></a></td>
						<!--<td class="text-center fit"><a href="#" onclick="confirmDeleteItem(<?php //echo $plan['Plan']['id'] ?>)" title="Deletar"><i class="fa fa-trash-o text-danger"></i></a></td>-->
					</tr>
					<?php endforeach; ?>
					<?php unset($plan); ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>