<div class="ms-hero-page-override ms-hero-img-team ms-hero-bg-primary">
    <div class="container">
        <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Fale Conosco</h1>
            <p class="lead lead-lg color-light text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Você gostaria de obter maiores informações sobre nossos serviços?
                <br>precisa de detalhes sobre planos ou tem dúvidas sobre qual é a melhor alternativa para sua empresa? Entre em contato agora mesmo.</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="card card-hero animated fadeInUp animation-delay-7">
        <div class="card-body">
            <form class="form-horizontal" method="post" action="/pages/contact">
                <fieldset class="container">
                    <div class="form-group row is-empty">
                        <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Nome</label>
                        <div class="col-lg-9"><input type="text" name="data[Contato][nome]" class="form-control" id="inputName" placeholder="Nome" required maxlength="50"></div>
                    </div>
                    <div class="form-group row is-empty">
                        <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9"><input type="email" name="data[Contato][email]" class="form-control" id="inputEmail" placeholder="Email" maxlength="50"></div>
                    </div>
                    <div class="form-group row is-empty">
                        <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Celular</label>
                        <div class="col-lg-9"><input type="text" name="data[Contato][telefone]" class="form-control cell" id="inputSubject" placeholder="Celular" required onkeypress="javascript:mascara(this,cell_mask)" maxlength="15"></div>
                    </div>
                    <div class="form-group row is-empty">
                        <label for="textArea" class="col-lg-2 control-label">Mensagem</label>
                        <div class="col-lg-9"><textarea name="data[Contato][mensagem]" class="form-control" rows="3" id="textArea" placeholder="Mensagem..." required maxlength="5000"></textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-raised btn-primary">Enviar</button>
                            <button type="reset" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="card card-primary">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5">
                <div class="card-body wow fadeInUp" style="visibility: hidden; animation-name: none;">
                    <div class="mb-2">
                        <img src="/theme/Portal/assets/img/logo-full-1.png" width="120" alt="" class="responsive">
                    </div>
                    <address class="no-mb">
                        <p><i class="color-danger-light zmdi zmdi-pin mr-1"></i><a target="_blank" href="https://www.google.com.br/maps/place/Construlista/@-18.8873743,-48.2541635,15z/data=!4m5!3m4!1s0x0:0x286296a9ac68112a!8m2!3d-18.8873743!4d-48.2541635">Rua Acre 1856 Uberlândia / MG</a></p>
                        <p><i class="color-warning-light zmdi zmdi-map mr-1"></i>Cep: 38405-319 / Umuarama</p>
                        <p><i class="color-info-light zmdi zmdi-email mr-1"></i><a href="mailto:construlista@construlista.com.br">construlista@construlista.com.br</a></p>
                        <p><i class="color-success-light fa fa-fax mr-1"></i>(34) 3231-5006</p>
                        <p><i class="fab fa-whatsapp"></i> (34) 98810-5006</p>
                    </address>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-7">
                <iframe width="100%" height="340" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3774.8002479595825!2d-48.269464985257336!3d-18.895940787191517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94a445c7ad6d5ec1%3A0x286296a9ac68112a!2sConstrulista!5e0!3m2!1spt-BR!2sbr!4v1531938299382" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}
function cell_mask(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
    v = v.replace(/(\d{0})(\d)/, "$1($2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{2})(\d)/, "$1) $2")    //Coloca ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{5})(\d)/, "$1-$2")    //Coloca ponto entre o setimo e o oitava dígitos
    return v
}
</script>