<br>
<br>
<div class="row">
    <div class="col-xl-2 order-xl-1"></div>
    <div class="col-xl-8 order-xl-2">
        <div class="card card-primary animated fadeInUp animation-delay-7">
            <div class="card-body">
                <h1 class="color-primary text-center">Cadastre-se</h1>
                <h3 class="text-center">E utilize as ferramentas da Construlista</h3>
                <p class="text-center">Faça o cadastro de usuário com seus dados pessoas.<br>Depois é só acessar o painel para divulgar seus produtos e serviços.</p>
                <form class="form-horizontal" method="post" action="/users/add">
                    <fieldset>

                        <br>
                        <br>
                        <h3>Dados Pessoais</h3>
                        <hr class="color">

                        <div class="row form-group is-empty">
                            <label  class="col-md-3 control-label">Nome (*)</label>
                            <div class="col-md-9"><input type="text" name="data[User][nome]" value="<?php echo (empty($this->request->data['User']['nome']) ? "" : $this->request->data['User']['nome']) ?>" class="form-control" placeholder="Nome" required></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label  class="col-md-3 control-label">Sobrenome (*)</label>
                            <div class="col-md-9"><input type="text" name="data[User][last_name]" value="<?php echo (empty($this->request->data['User']['last_name']) ? "" : $this->request->data['User']['last_name']) ?>" class="form-control" placeholder="Sobrenome" required></div>
                        </div>

                        <div class="row form-group is-empty">
                            <label  class="col-md-3 control-label">Telefone Fixo</label>
                            <div class="col-md-9"><input type="text" name="data[User][telefone]" value="<?php echo (empty($this->request->data['User']['telefone']) ? "" : $this->request->data['User']['telefone']) ?>" class="form-control phone" placeholder="Telefone Fixo" onkeypress="javascript:mascara(this,phone_mask)" maxlength="14"></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label  class="col-md-3 control-label">Celular (*)</label>
                            <div class="col-md-9"><input type="text" name="data[User][telefone2]" value="<?php echo (empty($this->request->data['User']['telefone2']) ? "" : $this->request->data['User']['telefone2']) ?>" class="form-control cell" placeholder="Celular" required onkeypress="javascript:mascara(this,cell_mask)" maxlength="15"></div>
                        </div>

                        <div class="row form-group is-empty">
                            <label for="inputEmail" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9"><input type="email" name="data[User][email]" value="<?php echo (empty($this->request->data['User']['email']) ? "" : $this->request->data['User']['email']) ?>" class="form-control" id="inputEmail" placeholder="Email"></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label  class="col-md-3 control-label">Data de Nascimento (*)</label>
                            <div class="col-md-9"><input type="text" name="data[User][data_nascimento]" value="<?php echo (empty($this->request->data['User']['data_nascimento']) ? "" : $this->request->data['User']['data_nascimento']) ?>" class="form-control data_nascimento"  placeholder="Data de Nascimento" required onkeypress="javascript:mascara(this,birthday_mask)" maxlength="10"></div>
                        </div>

                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">Sexo</label>
                            <div class="radio radio-primary col-md-3">
                                <label><input type="radio" name="data[User][gender]" id="optionsRadios1" value="0" <?php echo (isset($this->request->data['User']['gender']) && $this->request->data['User']['gender'] == false ? "checked='checked'" : "") ?>>Masculino</label>
                            </div>
                            <div class="radio radio-primary col-md-3">
                                <label><input type="radio" name="data[User][gender]" id="optionsRadios2" value="1" <?php echo (isset($this->request->data['User']['gender']) && $this->request->data['User']['gender'] == true ? "checked='checked'" : "") ?>>Feminino</label>
                            </div>

                        </div>


                        <br>
                        <br>
                        <h3>Endereço</h3>
                        <hr class="color">

                        <script>

                        </script>

                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">Cep (*)</label>
                            <div class="col-md-3"><input type="text" name="data[User][cep]" value="<?php echo (empty($this->request->data['User']['cep']) ? "" : $this->request->data['User']['cep']) ?>"  id="cep" class="form-control cep" placeholder="Cep" required maxlength="10" onkeypress="javascript:mascara(this,cep_mask)"></div>
                            <label class="col-md-2 control-label"><a href="http://www.consultaenderecos.com.br/" target="_blank">Não sei meu CEP</a></label>
                        </div>
                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">Endereço (*)</label>
                            <div class="col-md-7"><input type="text" name="data[User][endereco]" value="<?php echo (empty($this->request->data['User']['endereco']) ? "" : $this->request->data['User']['endereco']) ?>" id="rua" class="form-control cep" placeholder="Endereço" required></div>
                            <div class="col-md-2"><input type="text" name="data[User][numero]" value="<?php echo (empty($this->request->data['User']['numero']) ? "" : $this->request->data['User']['numero']) ?>" id="numero" class="form-control cep" placeholder="Nº"></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-9"><input type="text" name="data[User][complemento]" value="<?php echo (empty($this->request->data['User']['complemento']) ? "" : $this->request->data['User']['complemento']) ?>" maxlength="100" class="form-control cep" placeholder="Complemento"></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4"><input type="text" name="data[User][bairro]" value="<?php echo (empty($this->request->data['User']['bairro']) ? "" : $this->request->data['User']['bairro']) ?>" id="bairro" class="form-control cep" placeholder="Bairro" required></div>
                            <div class="col-md-4"><input type="text" name="data[User][cidade]" value="<?php echo (empty($this->request->data['User']['cidade']) ? "" : $this->request->data['User']['cidade']) ?>" id="cidade" class="form-control cep" placeholder="Cidade" required></div>
                            <div class="col-md-1"><input type="text" name="data[User][estado]" value="<?php echo (empty($this->request->data['User']['estado']) ? "" : $this->request->data['User']['estado']) ?>" id="uf" class="form-control cep" placeholder="UF" required></div>
                        </div>


                        <br>
                        <br>
                        <h3>Dados de Acesso</h3>
                        <hr class="color">

                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">CPF (*)</label>
                            <div class="col-md-9"><input type="text" name="data[User][cpf]" value="<?php echo (empty($this->request->data['User']['cpf']) ? "" : $this->request->data['User']['cpf']) ?>" class="form-control cpf" placeholder="CPF" required onkeypress="javascript:mascara(this,cpf_mask)" onblur="javascript:validarCPF(this.value)" maxlength="14"></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">Senha (*)</label>
                            <div class="col-md-9"><input type="password" id="senha" name="data[User][senha]" value="<?php echo (empty($this->request->data['User']['senha']) ? "" : $this->request->data['User']['senha']) ?>" class="form-control" placeholder="Senha" required></div>
                        </div>
                        <div class="row form-group is-empty">
                            <label class="col-md-3 control-label">Confirmar senha (*)</label>
                            <div class="col-md-9"><input type="password" name="data[User][senha_confirm]" value="<?php echo (empty($this->request->data['User']['senha_confirm']) ? "" : $this->request->data['User']['senha_confirm']) ?>" class="form-control" placeholder="Confirmação de Senha" required></div>
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


                        <br>
                        <br>
                        <h3>Contrato, Termos e Condições do Site</h3>
                        <hr class="color">


                        <div class="form-group row justify-content-end is-empty">
                            <label for="textArea" class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="6" id="textArea">Condições gerais - Anunciantes Construlista
                                Os seguintes Termos completam o Contrato de Adesão de Publicidade em Internet e se destinam aos Clientes/Anunciantes.
                                A Construlista Ltda, inscrita no CNPJ sob número 26.836.612/0001-02, com sede na Rua Rio Grande do Sul 949, Bairro Brasil – Uberlândia-MG, CEP 38400-650, doravante denominada CONTRATADA, é detentora do site de buscas CONSTRULISTA.NET.
                                O www.construlista.net é um site com divulgações de anúncios e publicidades on-line, onde o contratante terá que optar por uma das modalidades de planos oferecidas e disponíveis no ato da contratação.
                                Limitação da Responsabilidade
                                De acordo com a legislação aplicável, a CONTRATADA não assume qualquer responsabilidade contratual ou extracontratual em razão de danos e ou prejuízos diretos e indiretos, que possa vir a ocasionar: (I) impossibilidade de utilização do serviço. (II) eventuais custos incorridos para obtenção de serviços substitutivos, ou de qualquer bem comprado ou adquirido ou informação ou mensagem recebidos ou operações concretizadas através destes serviços. (III) do acesso não autorizado ou a alteração de suas transmissões de dados. (IV) declarações de conduta de terceiros através do serviço.
                                O ANUNCIANTE concorda que, além disso, a CONTRATADA não será responsável por nenhum dano ou prejuízo derivados da interrupção, suspensão ou término do serviço, incluindo, mais não se limitando, a danos, lucros, uso, dados ou outros bens intangíveis, prejuízos diretos, indiretos, acidentais, especiais, consequentes, ou exemplares, mesmo que a interrupção, suspensão ou terminação seja justificada ou não, negligente ou intencional, advertida ou inadvertida. (V) a CONTRATADA não se responsabilizará por quaisquer danos e ou indenizações geradas em função das avaliações dos usuários do site em relação aos estabelecimentos anunciantes.
                                Negociações com Anunciantes
                                Os anúncios no site CONSTRULISTA são de responsabilidade exclusiva dos anunciantes. Cabe aos anunciantes, assegurarem idoneidade em seus negócios e transações.
                                A CONTRATADA, por meio da CONSTRULISTA, não realiza qualquer intermediação de venda, compra e/ou descontos, trocas ou qualquer tipo de transação feita pelos usuários de seu site, tratando-se de serviço exclusivamente de disponibilização de mídia para divulgação. A transação deverá ser feita diretamente entre as partes interessadas.
                                Indenizações
                                O ANUNCIANTE se obriga a indenizar a CONTRATADA, seus representantes, agentes, sócios e funcionários, de eventuais condenações relativas a reclamações administrativas ou demandas judiciais incluídos eventuais reembolsos de honorários de advogados de seus procuradores e ou de terceiros, em razão de quaisquer danos sofridos pela CONSTRULISTA provenientes do uso ou transmissão de informações indevidas, realizadas através dos diversos login(s) e senha(s) cadastrados na CONSTRULISTA que viole os termos de uso, lei ou regulamento local, nacional ou internacional, que venham a prejudicar os direitos de terceiros, desde que devidamente comprovados.

                                Proibição da Revenda do Serviço
                                O ANUNCIANTE se obriga a não reproduzir, duplicar, copiar, vender, revender para fins comerciais, qualquer seção do serviço, uso ou acesso ao mesmo.
                                Links
                                A CONTRATADA não se responsabiliza pelo destino sugerido em links vinculados nos anúncios e não mantém vínculos com outros sites sugeridos por eles. Bem como não será responsável, direta ou indiretamente, por qualquer dano ou prejuízo causado, ou que presume tenham sido ocasionados por tais conteúdos, produtos ou serviços disponíveis em ditos sites ou recursos externos, ou pela utilização ou confiança depositada pelo CLIENTE, usuário ou terceiros em tais conteúdos, produtos ou serviços.
                                Direitos de Propriedade
                                Todo conteúdo da CONSTRULISTA, não se limitando a: textos, programas, canções, sons, fotografias, gráficos, vídeos e outros materiais contidos em propagandas disponíveis no serviço, assim como também informações divulgadas ao usuário através do site dos anunciantes, estão devidamente protegidos pelas leis de direito autoral, marcas comerciais, patentes e outros direitos de propriedade intelectual. Os materiais e informações somente poderão ser utilizados de acordo com as autorizações expressas da CONTRATADA e anunciantes, não podendo ser copiadas, reproduzidas, transmitidas e distribuídas sem a expressa autorização do respectivo proprietário. O serviço e qualquer software usado em relação ao serviço contêm informações confidenciais protegida pela legislação de propriedade intelectual e outras disposições legais.
                                O conteúdo dos anúncios veiculados na CONSTRULISTA é de responsabilidade exclusiva do ANUNCIANTE.
                                Garantia Limitada
                                Tanto o serviço como assinantes, usuários e terceiros poderão estabelecer vínculos a outros sites ou recursos da rede mundial, exonerando-se a CONTRATADA pela disponibilização dos sites ou recursos externos ou por conteúdos, publicidade, produtos, serviços ou outro tipo de material contido ou a disposição em tais sites ou recursos.
                                A CONTRATADA não garante que o serviço cumprirá com todos os requisitos e/ou necessidades do ANUNCIANTE, usuário e ou terceiro, ou que o serviço se prestará de maneira ininterrupta, segura ou isenta de erro.
                                O site CONSTRULISTA tampouco concede qualquer garantia quanto aos resultados que se pode obter do uso do serviço ou em relação a exatidão ou confiabilidade de qualquer informação obtida através do serviço, nem que os defeitos nos programas sejam corrigidos.
                                Nenhuma assessoria ou informação, seja oral ou por escrito, obtida pelo ANUNCIANTE, usuário ou terceiro interessado da CONTRATADA através do serviço dará origem a nenhuma garantia que não seja expressamente especificada no presente acordo.
                                A CONTRATADA permite que os usuários avaliem e comentem os serviços e produtos dos anunciantes CONSTRULISTA, inserindo conteúdo no site. A CONTRATADA não revisa o conteúdo inserido e não se responsabiliza pelo seu teor. No entanto, a CONTRATADA reserva-se o direito de retirar do ar e/ou suprimir o conteúdo inserido se não estiver de acordo com os dispostos nos Termos de Uso de Perfil de Usuário CONSTRULISTA.
                                A CONTRATADA não se responsabiliza por eventuais danos ou prejuízos ocasionados por esses comentários e avaliações ou pela transmissão desse conteúdo através do serviço.
                                Obrigações do anunciante
                                O (a) ANUNCIANTE se compromete a não divulgar e inserir conteúdos impróprios e a não enviar material para produção dos anúncios que: (a) Violem a lei, a moral, os bons costumes, a propriedade intelectual, os direitos à honra, à vida privada, o sigilo das comunicações, à imagem, à intimidade pessoal e familiar; (b) Infrinjam patentes, marcas, segredos comerciais, direitos autorais; (c) Estimulem a prática de condutas ilícitas; (d) Incitem a prática de atos de discriminação, seja em razão de sexo, raça, religião, crenças, idade ou qualquer outra condição; (e) Coloquem à disposição ou possibilitem o acesso a mensagens, produtos ou serviços ilícitos, violentos, pornográficos, degradantes; (f) Induzam ou incitem práticas perigosas, de risco ou nocivas para a saúde e para o equilíbrio psíquico; (g) Sejam falsos, ambíguos, inexatos, exagerados, de forma que possam induzir a erro sobre seu objeto ou sobre as intenções ou propósitos do comunicador; (h) Constituam publicidade ilícita, enganosa ou desleal, e que configurem concorrência desleal; (i) Veiculem, incitem ou estimulem a pedofilia; (j) Incorporem vírus ou outros elementos físicos ou eletrônicos que possam danificar ou impedir o normal funcionamento da rede, do sistema ou dos equipamentos informáticos (hardware e software) de terceiros ou que possam danificar os documentos eletrônicos e arquivos armazenados nestes equipamentos informáticos; (k) Hostilizem terceiros; (l) Transmitam conteúdos ilegais, daninhos, incômodos, ameaçadores, abusivos, tortuosos, difamatórios, vulgares, obscenos, invasores da intimidade de terceiros, odiosos, xenófobos, ou, de algum modo, inaceitáveis. (m) Utilizem de falsificação de rubricas ou, de outro modo de manipular identificadores com o fim de disfarçar a natureza do conteúdo transmitido. Responsabiliza-se por toda e qualquer divulgação e promoção de produtos e/ou serviços, sendo ele o único responsável pela publicação no site CONSTRULISTA. O ANUNCIANTE se compromete a enviar e manter conteúdos dos anúncios de acordo com as especificações desse Termo de Uso.
                                A CONTRATADA reserva-se o direito de recusar o conteúdo do material enviado pelo ANUNCIANTE e o direito de suprimir e retirar do ar conteúdos impróprios ou de algum modo inaceitáveis e que não estejam de acordo com esses Termos de Uso.
                                A CONTRATADA não assumirá responsabilidade alguma, por nenhuma circunstância, pelo conteúdo, incluindo, sem limitação, erros ou omissões, danos ou prejuízos derivados do uso do conteúdo exibido, enviado por e-mail ou, de qualquer modo, transmitido através do serviço.
                                O ANUNCIANTE reconhece que a CONTRATADA pode manter ou revelar o conteúdo se for requerido para ele em virtude das disposições legais aplicáveis ou, de boa fé, e o considera necessário para: (a) Dar cumprimento a lei e a procedimentos legais, tais como ordens judiciais ou de órgãos administrativos competentes; (b) Fazer cumprir as presentes Condições; (c) Contestar reclamações relativas a violações de direitos de terceiros; ou (d) Proteger os legítimos interesses da CONSTRULISTA, seus usuários e o público.
                                O ANUNCIANTE entende e aceita que o processo técnico e a transmissão do serviço, incluindo seu conteúdo, podem implicar em: (a) Transmissões através de diversas redes; e (b) Modificações ou mudanças realizadas no objeto para tornar compatível o conteúdo com as necessidades técnicas de conexão de redes ou dispositivos.</textarea>
                            </div>
                        </div>

                        <div class="offset-lg-2 col-lg-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="agreement" required checked>
                                    <span class="ml-2">Declaro estar ciente e concordar com todos os termos, contratos  e politicas do site.</span>
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <button class="btn btn-raised btn-primary btn-block">Cadastrar</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-2 order-xl-3"></div>
</div>

<script type="application/javascript">
$( document ).ready(function()
{
    function limpa_formulário_cep()
    {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function ()
    {
        var cep = $(this).val();
        cep = cep.replace(/\D/g, "");

        if (cep != "")
        {
            var validacep = /^[0-9]{5}-?[0-9]{3}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep))
            {
                $("#rua").val("Carregando Rua...")
                $("#bairro").val("Carregando Bairro...")
                $("#cidade").val("Carregando Cidade..")
                $("#uf").val("Carregando Estado")
                $("#ibge").val("...")

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados)
                {
                    if (!("erro" in dados))
                    {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    }
                    else
                    {
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            }
            else
            {
                limpa_formulário_cep();
            }
        }
        else
        {
            limpa_formulário_cep();
        }
    });
});

function validarCPF(cpf)
{
    var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

    if (!filtro.test(cpf))
    {
        window.alert("CPF inválido. Tente novamente.");
        return false;
    }

    cpf = remove(cpf, ".");
    cpf = remove(cpf, "-");

    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
        cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
        cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
        cpf == "88888888888" || cpf == "99999999999") {
        window.alert("CPF inválido. Tente novamente.");
        return false;
    }

    soma = 0;

    for (i = 0; i < 9; i++)
    {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }

    resto = 11 - (soma % 11);

    if (resto == 10 || resto == 11)
    {
        resto = 0;
    }

    if (resto != parseInt(cpf.charAt(9)))
    {
        window.alert("CPF inválido. Tente novamente.");
        return false;
    }

    soma = 0;

    for (i = 0; i < 10; i++)
    {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);

    if (resto == 10 || resto == 11)
    {
        resto = 0;
    }

    if (resto != parseInt(cpf.charAt(10)))
    {
        window.alert("CPF inválido. Tente novamente.");
        return false;
    }
    return true;
}

function remove(str, sub)
{
    i = str.indexOf(sub);
    r = "";

    if (i == -1) return str;
    {
        r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
    }
    return r;
}

function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}
function cep_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{2})(\d)/, "$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{3})(\d)/, "$1-$2")    //Coloca traço entre o quinto e o oitav0 dígitos
    return v
}
function cpf_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
    v = v.replace(/(\d{3})(\d)/, "$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
    return v
}
function phone_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{0})(\d)/, "$1($2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{2})(\d)/, "$1) $2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{4})(\d)/, "$1-$2")    //Coloca ponto entre o setimo e o oitava dígitos
    return v
}
function cell_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{0})(\d)/, "$1($2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{2})(\d)/, "$1) $2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{5})(\d)/, "$1-$2")    //Coloca ponto entre o setimo e o oitava dígitos
    return v
}
function birthday_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{2})(\d)/, "$1/$2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{2})(\d)/, "$1/$2")    //Coloca ponto entre o terceiro e o quarto dígitos
    return v
}
</script>