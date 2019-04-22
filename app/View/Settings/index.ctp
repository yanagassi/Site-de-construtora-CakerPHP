<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Responsive Table</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'posts', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
			<ol class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Table</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Column Toggle Table</h3>
				<p class="text-muted m-b-20">The Column Toggle Table allows the user to select which columns they want to be visible.</p>
				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Para</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Data</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">#</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">X</th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($posts as $post): ?>
					<tr id="<?php echo $post['Post']['id'] ?>">
						<td><?php echo $post['Post']['id']; ?></td>
						<td><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></td>
						<td><?php echo $this->Custom->formatDateWithHours($post['Post']['created']); ?></td>
						<td><?php echo $this->Html->link('Editar', array('action' => 'edit', $post['Post']['id'])); ?></td>
						<td><a href="#" onclick="confirmDeleteItem(<?php echo $post['Post']['id'] ?>)">X</a></td>
					</tr>
					<?php endforeach; ?>
					<?php unset($post); ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function confirmDeleteItem(id_row = null)
	{
		swal({
			title: "Tem certeza que deseja realizar esta ação?",
			text: "Você não poderá desfazer esta ação!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Cancelar",
			confirmButtonText: "Sim!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (!isConfirm) return;
			$.ajax({
				url: "/posts/deletar/" + id_row,
				type: "POST",
				dataType: "json",
				success: function (result) {
					swal("Deletado", "Item removido com sucesso!", "success");
					$("tr#" + result).remove();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal("Problemas", "Você não tem permissão para esta ação!", "error");
				}
			});
		});
	}
</script>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>