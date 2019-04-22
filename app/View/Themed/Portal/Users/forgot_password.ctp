<br>
<br>
<div class="row">
    <div class="col-xl-4 order-xl-2"></div>
    <div class="col-xl-4 order-xl-2">
        <div class="card card-primary animated fadeInUp animation-delay-7">
            <div class="card-body">
                <h1 class="color-primary text-center">Esqueci minha senha</h1>
                <form class="form-horizontal" action="/esqueci-minha-senha/" method="post">
                    <fieldset>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input type="text" class="form-control" name="data[User][cpf]" maxlength="14" id="cpf" onkeypress="javascript:mascara(this, cpf_mask)" placeholder="Informe seu CPF" required /></div>
                        </div>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input class="form-control" type="text" name="data[User][data]" maxlength="60" id="password" placeholder="Dt. Nasc. (99/99/9999) ou E-mail" required/></div>
                        </div>
                    </fieldset>
                    <button class="btn btn-raised btn-primary btn-block">Enviar<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                    <p class="text-center"><a href="/login" >Voltar</a></p>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-4 order-xl-2"></div>
</div>