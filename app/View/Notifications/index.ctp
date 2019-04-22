<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Notificações</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Nova', array('controller' => 'notifications', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline waves-effect waves-light', 'title' => 'Adicionar Nova')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/notificacoes" title="Listar todos">Notificações</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Notificações do Sistema</h3>
				<p class="text-muted m-b-20">Listagem de todas as notificações do sistema | Total: <?php echo $numbers ?></p>

				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" data-tablesaw-sortable-default-col class="text-center fit" title="Visualizar">Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" title="Visualizar">Título</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">De</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Para</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4" class="text-center fit">AR</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" class="text-center fit">AE</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Data</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7" class="text-center fit" title="Visualizar">Vis.</th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($result as $item): ?>
						<tr id="<?php echo $item['Notification']['id'] ?>">
							<td class="text-center fit"><?php echo $item['Notification']['id']; ?></td>
							<td><a title="Texto" data-target="#<?php echo $item['Notification']['id'] ?>" data-toggle="modal"><u><?php echo $item['Notification']['title'] ?></u></a></td>
							<td><?php echo $item['User']['first_name'] .' '. $item['User']['last_name']; ?></td>
							<td><a class="popover-info" title="Email" data-toggle="popover" data-placement="top" data-content="<?php echo $item['Notification']['to_email'] ?>" data-original-title="Email"><u><?php echo $item['Notification']['to_name'] ?><u/></a></td>

							<td class="text-center"><i data-original-title="Visualizado em" data-content="<?php echo (!empty($item['Notification']['acknowledgment_receipt_visualized']) ? $this->Custom->formatDateWithHours($item['Notification']['acknowledgment_receipt_visualized']) : "Ainda não visualizado" ) ?>" data-placement="top" data-toggle="popover" class="popover-info fa <?php echo $item['Notification']['is_acknowledgment_receipt'] .' '. $item['Notification']['is_acknowledgment_receipt_checked'] ?>"></i></td>
							<td class="text-center"><i data-original-title="Assinado em" data-content="<?php echo (!empty($item['Notification']['electronic_signature_signed']) ? $this->Custom->formatDateWithHours($item['Notification']['electronic_signature_signed']) : "Ainda não assiando" ) ?>"       data-placement="top" data-toggle="popover" class="popover-info fa <?php echo $item['Notification']['is_electronic_signature'] .' '. $item['Notification']['is_electronic_signature_checked'] ?>"></i></td>

							<td><?php echo $this->Custom->formatDateWithHours($item['Notification']['created']); ?></td>

							<td class="text-center fit"><a href="#" title="Visualizar" data-target="#<?php echo $item['Notification']['id'] ?>" data-toggle="modal"><i class="fa fa-info-circle text-info"></i></a></td>

							<div id="<?php echo $item['Notification']['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title" id="myModalLabel">Notificação</h4>
										</div>
										<div class="modal-body text-justify">
											<p><?php echo $this->Custom->formatTextToParagraphs($item['Notification']['body']) ?></p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>

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

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>