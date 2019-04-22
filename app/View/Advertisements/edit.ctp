<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title"><?php echo $title_for_layout ?></h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<?php echo $this->Html->link('Novo', "/admin/anuncios/novo/", array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
				<ol class="breadcrumb">
					<li><a href="/admin/" title="Voltar para a Home">Início</a></li>
					<li><a href="/admin/anuncios/" title="Listar todos"><?php echo $title_for_layout ?></a></li>
					<li>Edição</li>
				</ol>
			</div>
		</div>
		<!-- /row -->

		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					<h3 class="box-title m-b-40"><?php echo $title_for_layout ?> <?php echo $this->Html->link('Ver Meu Anúncio', "/" . ( !empty($result['Advertisement']['slug']) ? $result['Advertisement']['slug'] : strtolower(Inflector::slug($result['Advertisement']['titulo_anuncio'], '-')) . '-' . $result['Advertisement']['id'] ), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded hidden-xs hidden-sm waves-effect waves-light','target' => '_blank')); ?></h3>
					<section>
						<div class="sttabs tabs-style-bar">
							<nav>
								<ul>
									<li class="tab-current"><a href="#section-bar-1" class="sticon fa fa-newspaper-o"><span>Dados do Anúncio</span></a></li>
									<li class=""><a href="#section-bar-2" class="sticon fa fa-address-book"><span>Dados Adicionais</span></a></li>
									<li class=""><a href="#section-bar-3" class="sticon fa fa-briefcase"><span>Meus Serviços</span></a></li>
									<li class=""><a href="#section-bar-4" class="sticon fa fa-gift"><span>Meus Produtos</span></a></li>
									<li class=""><a href="#section-bar-5" class="sticon fa fa-photo Galeria de Fotos"><span>Galeria de Fotos</span></a></li>
								</ul>
							</nav>
							<div class="content-wrap">
								<section id="section-bar-1" class="content-current">
									<?php echo $this->element('Advertisements/personal_data'); ?>
								</section>

								<section id="section-bar-2" class="">
									<?php echo $this->element('Advertisements/operating_hours'); ?>
									<br>
									<?php echo $this->element('Advertisements/about_establishment'); ?>
									<?php echo $this->element('Advertisements/payment_methods'); ?>
									<?php echo $this->element('Advertisements/social_network'); ?>
								</section>

								<section id="section-bar-3" class="">
									<?php echo $this->element('Advertisements/services'); ?>
								</section>

								<section id="section-bar-4" class="">
									<?php echo $this->element('Advertisements/products'); ?>
								</section>

								<section id="section-bar-5" class="">
									<h3>Galeria de Fotos</h3>

									<?php echo $this->element('Advertisements/photo_logo_and_cover'); ?>

									<br>
									<hr class="m-b-40">

									<?php echo $this->element('Advertisements/photo_gallery'); ?>

								</section>

								<script>
								$(document).ready(function () {
									$( '.ajaxSave' ).on('blur', function()
									{
										$('.preloader').show(); // loading process // ToDo: Show loadding proccess if loading is more than 3 sec.

										var _old_val_save = "";
										var _model          = $(this).attr('rel');  // model to update
										var _field          = $(this).attr('name'); // field to update
										var _id             = $(this).attr('id');   // id of field to update after change
										var _val            = $(this).val();        // value

										if ( $(this).val() == $(this).data("value") ) // verify if original value has changed
										{
											_old_val_save = "";
											$('.preloader').hide(); // hidding process
										}
										else if ( $(this).prop('required') && $(this).val() != '' )
										{
											var formData = "";
											formData = {
												"model": _model,
												"name": _field,
												"val" : _val
											}

											$.ajax({
												type: "POST",
												dataType: "json",
												url: "/<?php echo strtolower($this->name); ?>/edit_ajax/<?php echo $result[Inflector::singularize($this->name)]['id'] ?>",
												data: formData,
												success: function (result)
												{
													if ( result.status )
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-success').text(result.msg);
														$('#flash-ajax-success').show("slow").delay(2000);
														$("#flash-ajax-success").hide('blind');

														$('#'+_id).val(_val);
														$('#'+_id).data("value",_val);
													}
													else
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-error').text(result.msg);
														$('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
													}
												}
											});
										}
										else if ( ! $(this).prop('required') )
										{
											var formData = "";
											formData = {
												"model": _model,
												"name": _field,
												"val" : _val
											}

											$.ajax({
												type: "POST",
												dataType: "json",
												url: "/<?php echo strtolower($this->name); ?>/edit_ajax/<?php echo $result[Inflector::singularize($this->name)]['id'] ?>",
												data: formData,
												success: function (result)
												{
													if ( result.status )
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-success').text(result.msg);
														$('#flash-ajax-success').show("slow").delay(2000);
														$("#flash-ajax-success").hide('blind');

														$('#'+_id).val(_val);
														$('#'+_id).data("value",_val);
													}
													else
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-error').text(result.msg);
														$('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
													}
												}
											});
										}
										else
										{
											$('.preloader').hide(); // hidding process
										}
									});

									$('.ajaxSaveSlug').bind('keyup blur', function () {
										$(this).val($(this).val().replace(/[^A-Za-z0-9-_]/g, '')); // just accept number and letters
									});

									$('#bt_check_slug').on('click',function() {
										var _old_val_slug = "";
										//$('.preloader').show(); // loading process // ToDo: Show loadding proccess if loading is more than 3 sec.
										var _model          = $('.ajaxSaveSlug').attr('rel');  // model to update
										var _field          = $('.ajaxSaveSlug').attr('name'); // field to update
										var _id             = $('.ajaxSaveSlug').attr('id');   // id of field to update after change
										var _val            = $('.ajaxSaveSlug').val();        // value

										if ( $('.ajaxSaveSlug').val() === $('.ajaxSaveSlug').data("value") ) // verify if original value has changed
										{
											_old_val_slug = "";
										}
										else
										{
											$('.preloader').show(); // hidding process

											var formData = "";
											formData = {
												"model": _model,
												"name": _field,
												"val" : _val
											}

											$('.ajaxSaveSlug').data('value',_val);

											$.ajax({
												type: "POST",
												dataType: "json",
												url: "/<?php echo strtolower($this->name); ?>/edit_ajax_slug/?id=<?php echo $result[Inflector::singularize($this->name)]['id'] ?>&term=" + formData.val,
												data: formData,
												success: function (result)
												{
													if ( result.status )
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-success').text(result.msg);
														$('#flash-ajax-success').show("slow").delay(2000);
														$("#flash-ajax-success").hide('blind');

														$('.ajaxSaveSlug').val(_val);
														$('.ajaxSaveSlug').data("value",_val);
													}
													else
													{
														$('.preloader').hide(); // hidding process
														$('#flash-ajax-error').text(result.msg);
														$('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
													}
												}
											});
										}
									});

								});
								</script>

							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('footer'); ?>
</div>