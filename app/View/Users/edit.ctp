<div id="page-wrapper">
	<div class="container-fluid">

		<?php echo $this->element('breadcrumb'); ?>

		<style>
			.container {
				max-width: 960px;
			}
			img {
				max-width: 100%;
			}
		</style>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				$('#phone').mask('(99) 9999-9999');
				$('#cellphone').mask('(99) 99999-9999');
				$('#cpf').mask('999.999.999-99');
				$('#birthday').mask('99/99/9999');
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

		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					<h3 class="box-title m-b-0">Dados Pessoais</h3>
					<p class="text-muted m-b-30 font-13"> Campos com (*) são obrigatórios</p>
					<form method="post" action="/painel/perfil/<?php echo $this->request->data['User']['id'] ?>" data-toggle="validator" role="form">
						<div class="form-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Nome *</span></label>
										<input type="text" name="nome" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['nome']) ? $this->request->data['User']['nome'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Sobrenome *</span></label>
										<input type="text" maxlength="40" name="last_name" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['last_name']) ? $this->request->data['User']['last_name'] : "" ) ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Telefone Fixo</span></label>
										<input type="text" name="telefone" id="phone" class="form-control" value="<?php echo ( !empty($this->request->data['User']['telefone']) ? $this->Custom->clearAllToNumber($this->request->data['User']['telefone']) : "" ) ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Celular *</span></label>
										<input type="text" name="telefone2" id="cellphone" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['telefone2']) ? $this->Custom->clearAllToNumber($this->request->data['User']['telefone2']) : "" ) ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">CPF *</span></label>
										<input type="text" name="cpf" id="cpf" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cpf']) ? $this->Custom->clearAllToNumber($this->request->data['User']['cpf']) : "" ) ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Dt. Nascimento *</span></label>
										<input type="text" name="data_nascimento" id="birthday" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['data_nascimento']) ? $this->request->data['User']['data_nascimento'] : "" ) ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Email</span></label>
										<input type="text" name="email" class="form-control" value="<?php echo ( !empty($this->request->data['User']['email']) ? $this->request->data['User']['email'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Sexo *</span></label>
										<select class="form-control" required name="gender">
											<option <?php echo ( $this->request->data['User']['gender'] == false ? "selected='selected'" : "" ) ?> value="0">Masculino</option>
											<option <?php echo ( $this->request->data['User']['gender'] == true ? "selected='selected'" : "" ) ?> value="1">Feminino</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Cargo ou função realizada na empresa ou negócio</span></label>
										<input type="text" name="occupation" id="occupation" maxlength="120" class="form-control" value="<?php echo ( !empty($this->request->data['User']['occupation']) ? $this->request->data['User']['occupation'] : "" ) ?>">
									</div>
								</div>
							</div>

							<hr class="m-b-40">

							<h3 class="box-title m-b-0">Endereço</h3>
							<p class="text-muted m-b-30 font-13"> Campos com (*) são obrigatórios</p>

							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="col-md-12"><span class="help">CEP *</span> | <a href="http://www.consultaenderecos.com.br/" target="_blank">Não sei o CEP</a></label>
										<input type="text" name="cep" id="cep" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cep']) ? $this->request->data['User']['cep'] : "" ) ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Endereço *</span></label>
										<input type="text" name="endereco" id="endereco" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['endereco']) ? $this->request->data['User']['endereco'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Número *</span></label>
										<input maxlength="45" type="text" name="numero" id="numero" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['numero']) ? $this->request->data['User']['numero'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Complemento</span></label>
										<input maxlength="45" type="text" name="complemento" id="complemento" class="form-control" value="<?php echo ( !empty($this->request->data['User']['complemento']) ? $this->request->data['User']['complemento'] : "" ) ?>">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Bairro *</span></label>
										<input maxlength="245" type="text" name="bairro" id="bairro" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['bairro']) ? $this->request->data['User']['bairro'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Cidade *</span></label>
										<input maxlength="45" type="text" name="cidade" id="cidade" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['cidade']) ? $this->request->data['User']['cidade'] : "" ) ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="col-md-12"><span class="help">UF *</span></label>
										<input maxlength="2" type="text" name="estado" id="uf" required class="form-control" value="<?php echo ( !empty($this->request->data['User']['estado']) ? $this->request->data['User']['estado'] : "" ) ?>">
									</div>
								</div>
							</div>

							<hr class="m-b-40">

							<h3 class="box-title m-b-0">Alterar Senha</h3>
							<p class="text-muted m-b-30 font-13"> Deixe em branco caso não queira alterar sua senha</p>

							<script type="text/javascript" src="/plugins/bower_components/password-validation/password-validation.js"></script>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Senha *</span></label>
										<input maxlength="45" type="password" name="senha" id="senha" class="form-control" data-minlength="6" data-error="Mínimo de 6 caracteres">
										<span class="help-block with-errors"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-12"><span class="help">Confirme sua senha *</span></label>
										<input maxlength="45" type="password" name="senha_confirm" id="senha_confirm" class="form-control" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>

							<script src="/plugins/bower_components/password-strength/jquery.passwordstrength.js"></script>

							<script type="application/javascript">
							$(document).ready(function() {
								$("#senha").passwordStrength({
									// The password strength you consider secure
									secureStrength: 25,

									// Allows you to specify a custom indicator element (arbitrary jQuery selection)
									$indicator: undefined,

									// The class that the indicator element will have
									indicatorClassName: "password-strength-indicator",

									// CSS "display" property of the indicator elements
									indicatorDisplayType: "inline-block",

									// Points for different character sets
									points: {
										forEachCharacter: 1,
										forEachSpace: 1,
										containsLowercaseLetter: 2,
										containsUppercaseLetter: 2,
										containsNumber: 4,
										containsSymbol: 5
									},

									// The class names to give the indicator element, according to the current password strength
									strengthClassNames: [{
										name: "very-weak",
										text: "muito fraca"
									}, {
										name: "weak",
										text: "fraca"
									}, {
										name: "mediocre",
										text: "média"
									}, {
										name: "strong",
										text: "forte"
									}, {
										name: "very-strong",
										text: "muito forte"
									}]
								});
							});
							</script>

							<!--hr>

                            <h3 class="box-title m-b-0">Cadastro de Promoções e Notificações</h3>
                            <p class="text-muted m-b-30 font-13"> Marque abaixo se você não deseja receber promoções notificações</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><span class="help">Desejo receber promoções e conteúdos</span></label>
                                        <input type="checkbox" name="is_spam" class="form-control">
                                    </div>
                                </div>
                            </div-->

						</div>

						<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Salvar</button>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
	<?php echo $this->element('footer'); ?>
</div>