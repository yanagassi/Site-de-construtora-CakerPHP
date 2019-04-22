<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Validation Forms Page</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Forms</a></li>
				<li class="active">Validation Forms Page</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Form Validation</h3>
				<p class="text-muted m-b-30"> Bootstrap Form Validation</p>
				<?php echo $this->Form->create('Notification', array("data-toggle" => "validator", "novalidate" => true));?>
					<input name="data[Notification][id]" type="hidden" value="<?php echo (!empty($this->request->data['Notification']['id'])) ? $this->request->data['Notification']['id'] : 0 ?>">
					<div class="form-group">
						<label for="inputName1" class="control-label">Título</label>
						<input name="data[Notification][title]" type="text" value="<?php echo (!empty($this->request->data['Notification']['title'])) ? $this->request->data['Notification']['title'] : "" ?>" class="form-control" id="inputName1" placeholder="Cina Saffary" required data-error="Este campo é obrigatório">
					</div>
					<div class="form-group">
						<label for="textarea" class="control-label">Texto</label>
						<textarea name="data[Notification][body]" id="textarea" class="form-control" rows="5" maxlength="1000"  required data-error="Texto é um campo obrigatório"><?php echo (!empty($this->request->data['Notification']['body'])) ? $this->request->data['Notification']['body'] : "" ?></textarea>
						<span class="help-block with-errors">Atenção, não ultrapasse 1000 caracteres!</span>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>