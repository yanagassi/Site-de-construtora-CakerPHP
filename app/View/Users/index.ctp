<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Usuários</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline waves-effect waves-light', 'title' => 'Adicionar novo usuário')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/usuarios" title="Listar todos usuários">Usuários</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Usuários do Sistema</h3>
				<p class="text-muted m-b-20">Listagem de todos os usuários do sistema | Total: <?php echo $number_users ?></p>

				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4" data-tablesaw-sortable-default-col class="text-center fit" title="Visualizar">Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" title="Visualizar">Nome</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Email</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Perfil</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Data</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="text-center fit" title="Editar">Edit.</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3" class="text-center fit" title="Deletar">Del.</th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($users as $item): ?>
					<tr id="<?php echo $item['User']['id'] ?>">
						<td class="text-center fit"><a href="/usuarios/visualizar/<?php echo $item['User']['id'] ?>" title="Visualizar"><u><?php echo $item['User']['id']; ?><u/><a/></td>
						<td><a href="/usuarios/visualizar/<?php echo $item['User']['id'] ?>" title="Visualizar"><u><?php echo $item['User']['first_name'] .' '. $item['User']['last_name']; ?></u></a></td>
						<td><?php echo $item['User']['email']; ?></td>
						<td><?php echo $item['Group']['name']; ?></td>
						<td><?php echo $this->Custom->formatDateWithHours($item['User']['created']); ?></td>
						<td class="text-center fit"><a href="/usuarios/editar/<?php echo $item['User']['id'] ?>" title="Editar"><i class="fa fa-pencil-square-o text-info"></i></a></td>
						<td class="text-center fit"><a href="#" onclick="confirmDeleteItem(<?php echo $item['User']['id'] ?>)" title="Deletar"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
					<?php endforeach; ?>
					<?php unset($item); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php /*
	<section id="paginations">
		<div class="pagination">
			<ul>
				<?php
				$hasPrev = $this->Paginator->hasPrev();
				if ($hasPrev) {
					echo $this->Paginator->prev(
						' << '
						, array('tag' => 'li')
						, null
						, array('class' => 'prev disabled')
					);
				}
				?>
				<?php echo $this->Paginator->numbers(
					array(
						'tag' => 'li'
					,'currentTag' => 'a'
					,'currentClass' => 'active'
					,'separator' => ''
					)
				);?>
				<?php
				$hasNext = $this->Paginator->hasNext();
				if ($hasNext) {
					echo $this->Paginator->next(
						' >> '
						, array('tag' => 'li')
						, null
						, array('class' => 'next')
					);
				}
				?>
			</ul>
		</div>
	</section>
	*/ ?>

</div>

<script type="text/javascript">
	function confirmDeleteItem(id_row = null)
	{
		swal({
			title: "Tem certeza que deseja realizar esta ação?",
			text: "Você não poderá desfazer isto!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Cancelar",
			confirmButtonText: "Sim!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: "/users/delete/" + id_row,
				type: "POST",
				dataType: "json",
				success: function (result) {
					swal("Deletado", "Item removido com sucesso!", "success");
					$("tr#" + result).remove();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Problemas", "Problemas ao remover o item!", "error");
				}
			});
		});
	}
</script>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>