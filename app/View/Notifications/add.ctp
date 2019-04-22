<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Notificações</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/usuarios" title="Listar todas as notificações">Notificações</a></li>
				<li>Adicionar</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Nova Notificação</h3>
				<p class="text-muted m-b-20">Adição</p>

				<?php echo $this->Form->create('Notification', array("data-toggle" => "validator", "novalidate" => true, "class" => "form-horizontal", "enctype" => "multipart/form-data"));?>

					<div class="form-group">
						<label class="col-md-12">Nome Destino</label>
						<div class="col-md-12">
							<input name="data[Notification][to_name]" type="text" class="form-control" placeholder="Nome da Pessoa de Destino" required data-error="Este campo é obrigatório">
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Email Destino</label>
						<div class="col-md-12">
							<input name="data[Notification][to_email]" type="text" class="form-control" placeholder="Email da Pessoa de Destino" required data-error="Este campo é obrigatório">
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-12">Título</label>
						<div class="col-md-12">
							<input name="data[Notification][title]" type="text" class="form-control" placeholder="Título da Notificação" required data-error="Este campo é obrigatório">
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Texto</label>
						<div class="col-md-12">
							<textarea name="data[Notification][body]" class="form-control" rows="5" maxlength="5000" placeholder="Este é um aviso de notificação via email. Você está recebendo-o através do Aveeze, sistema de notificações online."></textarea>
							<span class="help-block with-errors">Atenção, não ultrapasse 5000 caracteres!</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Arquivo</label>
						<div class="col-md-12">
							<input name="data[Notification][file_name]" type="file" id="input-file-max-fs" class="dropify" data-max-file-size="5M" />
							<span for="input-file-max-fs" class="help-block with-errors">Apenas formato PDF permitido. Tamanho máximo: 5MB</span>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-md-12">
							<div class="checkbox checkbox-success">
								<input id="is_acknowledgment_receipt" type="checkbox" name="data[Notification][is_acknowledgment_receipt]" value="1">
								<label for="is_acknowledgment_receipt">Com Aviso de AR <a title="Texto" data-target="#AR" data-toggle="modal"><i class="fa fa-info-circle text-info"></i></a></label>
							</div>

							<div class="checkbox checkbox-success">
								<input id="is_electronic_signature" type="checkbox" name="data[Notification][is_electronic_signature]" value="1">
								<label for="is_electronic_signature">Com Assinatura Eletrônica <a title="Texto" data-target="#AE" data-toggle="modal"><i class="fa fa-info-circle text-info"></i></a></label>
							</div>
						</div>
					</div>

					<hr>

					<button type="submit" class="btn btn-primary">Enviar</button>
					<a href="/notificacoes/" class="btn btn-primary btn-info">Cancelar</a>

				<?php echo $this->Form->end(); ?>

			</div>
		</div>
	</div>
</div>

<div id="AR" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Envio com AR</h4>
			</div>
			<div class="modal-body text-justify">
				<p>No envio de uma notificação com AR, o usuário que recebe a mesma, terá em seu email um link para visualizar o arquivo/texto da notificação na qual o sistema irá registrar a data e a hora que o receptor clicou no link e visualizou a notificação.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<div id="AE" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel2">Envio com Assinatura Eletrônica</h4>
			</div>
			<div class="modal-body text-justify">
				<p>O termo assinatura eletrônica pode ser confundido com assinatura digital , porém, tem um significado diferente: refere-se a qualquer mecanismo eletrônico, não necessariamente criptográfico, para identificar alguém, seja por meio de escaneamento de uma assinatura, identificação por impressão digital ou simples escrita do nome completo para identificar o remetente de uma mensagem eletrônica ou partes em um contrato ou documento. Tal assinatura somente passa a ter valor jurídico legal após periciado sua origem e remetente.</p>
				<p>A utilização da assinatura eletrônica não tem valor legal por si só; Para que uma assinatura eletrônica tenha validade legal, primeiramente deve ser criptografada, sendo assim, sua nomenclatura é mudada para assinatura digital devendo conter as seguintes propriedades:</p>

				<ul>
					<li>autenticidade - o receptor deve poder confirmar que a assinatura foi feita pelo emissor;</li>
					<li>integridade - qualquer alteração da mensagem faz com que a assinatura não corresponda mais ao documento;</li>
					<li>não repúdio ou irretratabilidade - o emissor não pode negar a autenticidade da mensagem.</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>