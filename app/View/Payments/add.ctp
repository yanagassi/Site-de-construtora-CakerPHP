<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Financeiro</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<?php echo $this->Html->link('Novo', array('controller' => 'plans', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
				<ol class="breadcrumb">
					<li><a href="/painel/dashboard/" title="Voltar para a Home">Início</a></li>
					<li><a href="/painel/anuncios/" title="Voltar">Anúncios</a></li>
					<li><a href="/financeiro" title="Voltar">Financeiro</a></li>
				</ol>
			</div>
		</div>
		<!-- /row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<section>
						<div class="sttabs tabs-style-bar">
							<nav>
								<ul>
									<li class="tab-current"><a href="#section-bar-1" class="sticon fa fa-server"><span>Dados de Assinatura</span></a></li>
								</ul>
							</nav>
							<div class="content-wrap">
								<section id="section-bar-1" class="content-current">

									<script type="text/javascript" src="<?php echo Configure::read('PAGSEGURO_URL_STATIC') ?>/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
									<script type="text/javascript" src="/js/application.js"></script>

									<script type="text/javascript">
										jQuery(document).ready(function() {
											PagSeguroDirectPayment.setSessionId("<?php echo $pagseguro_session_id ?>");
											var senderHash,cart_number,cBin,cc_brand,cc_token;

											$("#validation_cart").click(function() {
												$("#card-brand").empty();
												$('#show_validation_card').empty();

												cart_number = $('input[name="payment[ps_cc_number]"]').val();
												cBin = cart_number.substr(0,6);

												PagSeguroDirectPayment.getBrand({
													cardBin: cBin,
													success: function(psresponse) {
														$('#card-brand').append('<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/' + psresponse.brand.name + '.png" alt="' + psresponse.brand.name + '" title="' + psresponse.brand.name + '"/>');
														cc_brand = psresponse.brand.name;
														cc_brand = cc_brand.toUpperCase();
													},
													error: function(psresponse){
														$('#show_validation_card').text('Cartão Inválido!');
														$('#show_validation_card').show();
													}
												});

												PagSeguroDirectPayment.createCardToken({
													cardNumber: cart_number,
													cvv: $('#cc_number_cvv').val(),
													expirationMonth: $('#cc_month').val(),
													expirationYear: $('#cc_year').val(),
													success: function(response){
														$('#show_validation_card').text('Cartão Válido!');
														$('#show_validation_card').show();
														cc_token = response.card.token;
														$('#cc_token').val(cc_token);
														senderHash = PagSeguroDirectPayment.getSenderHash();
														$('#senderHash').val(senderHash);
													},
													error: function(response){
														$('#show_validation_card').text('Cartão Inválido!');
														$('#show_validation_card').show();
													}
												});
											});

											//$('#phone').mask('(99) 9999-9999');
											//$('#cellphone').mask('(99) 99999-9999');
											//$('#cpf').mask('999.999.999-99');
											//$('#birthday').mask('99/99/9999');
											$('#cep').mask('99.999-999');

											$("#cep").blur(function ()
											{
												var cep = $(this).val(); //Nova variável com valor do campo "cep".
												if (cep != "") //Verifica se campo cep possui valor informado.
												{
													// Clear to keep just numbers
													cep = cep.replace(/[^0-9]/, '');

													//Expressão regular para validar o CEP.
													var validacep = /^[0-9]{5}-?[0-9]{3}$/;
													//Valida o formato do CEP.
													if (validacep.test(cep))
													{
														//Preenche os campos com "..." enquanto consulta webservice.
														$("#endereco").val("Carregando Rua...")
														$("#bairro").val("Carregando Bairro...")
														$("#cidade").val("Carregando Cidade..")
														$("#uf").val("Carregando Estado")

														//Consulta o webservice viacep.com.br/
														$.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados)
														{
															if (!("erro" in dados))
															{
																$("#endereco").val(dados.logradouro); //Atualiza os campos com os valores da consulta.
																$("#bairro").val(dados.bairro);
																$("#cidade").val(dados.localidade);
																$("#uf").val(dados.uf);
															}
															else
															{
																limpa_formulário_cep();//CEP pesquisado não foi encontrado.
																alert("CEP não encontrado.");
															}
														});
													}
													else
													{
														limpa_formulário_cep(); //cep é inválido.
														alert("Formato de CEP inválido.");
													}
												}
												else
												{
													limpa_formulário_cep(); //cep sem valor, limpa formulário.
												}
											});

											function limpa_formulário_cep() // Limpa valores do formulário de cep.
											{
												$("#endereco").val("");
												$("#bairro").val("");
												$("#cidade").val("");
												$("#uf").val("");
											}
										});
									</script>

									<br>
									<br>
									<?php echo $this->Form->create('Plan', array("data-toggle" => "validator", "novalidate" => true));?>

									<input type="hidden" name="data[Advertisement][id]" value="<?php echo $advertisement_id ?>">
									<input type="hidden" name="data[Plan][id]" 			value="<?php echo $plan_id ?>">

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Nome *</span></label>
												<input type="text" name="data[User][first_name]" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['first_name']) ? $this->request->data['User']['first_name'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Sobrenome *</span></label>
												<input type="text" maxlength="40" name="data[User][last_name]" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['last_name']) ? $this->request->data['User']['last_name'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">CPF *</span></label>
												<input type="text" maxlength="14" name="data[User][cpf]" id="cpf" onkeypress="javascript:mascara(this,cpf_mask)" <?php /*onblur="javascript:valida_cpf(this.value)" */?> required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cpf']) ? $this->request->data['User']['cpf'] : "" ) ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Email *</span></label>
												<input type="text" name="data[User][email]" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['email']) ? $this->request->data['User']['email'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Dt. Nascimento *</span></label>
												<input type="text" maxlength="10" name="data[User][birthday]" id="birthday" onkeypress="javascript:mascara(this,birthday_mask)" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['birthday']) ? $this->request->data['User']['birthday'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Celular *</span></label>
												<input type="text" maxlength="15" name="data[User][cell_phone]" id="cell_phone" onkeypress="javascript:mascara(this,cell_mask)" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cell_phone']) ? $this->request->data['User']['cell_phone'] : "" ) ?>">
											</div>
										</div>
									</div>

									<hr class="m-b-40">

									<h3 class="box-title m-b-30">Endereço</h3>
									<!-- <p class="text-muted m-b-30 font-13"> Campos com (*) são obrigatórios</p>-->

									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="col-md-12"><span class="help">CEP *</span> | <a href="http://www.consultaenderecos.com.br/" target="_blank">Não sei o CEP</a></label>
												<input type="text" name="data[Address][cep]" id="cep" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cep']) ? $this->request->data['User']['cep'] : "" ) ?>">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-7">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Endereço *</span></label>
												<input type="text" name="data[Address][street]" id="endereco" required class="form-control" value="<?php echo ( !empty($this->request->data['Address']['street']) ? $this->request->data['Address']['street'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Número *</span></label>
												<input maxlength="45" type="text" name="data[Address][number]" id="numero" required class="form-control" value="<?php echo ( !empty($this->request->data['Address']['number']) ? $this->request->data['Address']['number'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Complemento</span></label>
												<input maxlength="45" type="text" name="data[Address][complement]" id="complemento" class="form-control" value="<?php echo ( !empty($this->request->data['Address']['complement']) ? $this->request->data['Address']['complement'] : "" ) ?>">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-7">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Bairro *</span></label>
												<input maxlength="245" type="text" name="data[Address][neighborhood]" id="bairro" required class="form-control" value="<?php echo ( !empty($this->request->data['Address']['neighborhood']) ? $this->request->data['Address']['neighborhood'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Cidade *</span></label>
												<input maxlength="45" type="text" name="data[Address][city]" id="cidade" required class="form-control" value="<?php echo ( !empty($this->request->data['Address']['city']) ? $this->request->data['Address']['city'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="col-md-12"><span class="help">UF *</span></label>
												<input maxlength="2" type="text" name="data[Address][state]" id="uf" required class="form-control" value="<?php echo ( !empty($this->request->data['Address']['state']) ? $this->request->data['Address']['state'] : "" ) ?>">
											</div>
										</div>
									</div>

									<hr class="m-b-40">

									<h3 class="box-title m-b-30">Dados do Pagamento</h3>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Nome no Cartão *</span></label>
												<input maxlength="50" type="text" name="data[UserPayment][cc_display_name]" id="cc_display_name" required class="form-control" value="<?php echo ( !empty($this->request->data['UserPayment']['cc_display_name']) ? $this->request->data['UserPayment']['cc_display_name'] : "" ) ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Número *</span></label>
												<input maxlength="16" type="text" name="payment[ps_cc_number]" id="ps_cc_number" required class="form-control" value="<?php echo ( !empty($this->request->data['UserPayment']['ps_cc_number']) ? $this->request->data['UserPayment']['ps_cc_number'] : "" ) ?>">
												<input type="hidden" name="data[UserPayment][cc_token]" id="cc_token" value="">
												<input type="hidden" name="data[UserPayment][senderHash]" id="senderHash" value="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="col-md-12"><span class="help">CVV *</span></label>
												<input maxlength="3" type="text" name="data[UserPayment][cc_number_cvv]" id="cc_number_cvv" required class="form-control" value="<?php echo ( !empty($this->request->data['UserPayment']['cc_number_cvv']) ? $this->request->data['UserPayment']['cc_number_cvv'] : "" ) ?>">
												<span id="show_validation_card" style="padding-left: 100px;color: cadetblue;font-weight: 600;position: absolute;top: 34px;"></span>
												<span id="card-brand" style="text-transform: capitalize;position: absolute;top: 33px;left: 227px;"></span>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Validade *</span></label>
												<select id="cc_month" name="data[UserPayment][cc_month]" class="form-control">
													<option value="">Mês</option>
													<option value="01">01</option>
													<option value="02">02</option>
													<option value="03">03</option>
													<option value="04">04</option>
													<option value="05">05</option>
													<option value="06">06</option>
													<option value="07">07</option>
													<option value="08">08</option>
													<option value="09">09</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Ano *</span></label>
												<select id="cc_year" name="data[UserPayment][cc_month]" class="form-control">
													<option value="">Ano</option>
													<option value="2018">2018</option>
													<option value="2019">2019</option>
													<option value="2020">2020</option>
													<option value="2021">2021</option>
													<option value="2022">2022</option>
													<option value="2023">2023</option>
													<option value="2024">2024</option>
													<option value="2025">2025</option>
													<option value="2026">2026</option>
													<option value="2027">2027</option>
													<option value="2028">2028</option>
													<option value="2029">2029</option>
													<option value="2030">2030</option>
													<option value="2031">2031</option>
													<option value="2032">2032</option>
													<option value="2033">2033</option>
													<option value="2034">2034</option>
													<option value="2035">2035</option>
												</select>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="col-md-12"><span class="help">Valor (R$)</span></label>
												<input type="text" class="form-control" readonly value="<?php echo $this->Custom->numberFormatToBR($plan_info['Plan']['valor_plano']) ?>">
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label class="col-md-12"><span class="help">&nbsp;</span></label>
												<a href="javascrip:;" id="validation_cart" class="btn btn-primary btn_add_student btn-small">Checar</a>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<img src="/img/pagseguro_selo/selo01_200x60.gif">
										</div>
									</div>

									<hr class="m-b-40">

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Realizar Pagamento</button>
											</div>
										</div>
									</div>

									<?php echo $this->Form->end(); ?>
								</section>
							</div>
						</div>
					</section>

				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('footer'); ?>
</div>
<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>