<br>
<br>
<div class="row">
    <div class="col-xl-4 order-xl-2"></div>
    <div class="col-xl-4 order-xl-2">
        <div class="card card-primary animated fadeInUp animation-delay-7">
            <div class="card-body">
                <h1 class="color-primary text-center">Redefinir senha</h1>
                <form class="form-horizontal" action="/redefinir-senha/" method="post">
                    <input type="hidden" name="data[User][token]" value="<?php echo $this->request->params['pass'][0]; ?>">
                    <fieldset>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input type="password" class="form-control" name="data[User][senha]" maxlength="60" placeholder="Informe sua nova senha" required /></div>
                        </div>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input class="form-control" type="password" name="data[User][senha_confirm]" maxlength="60" placeholder="Redigite a senha nova" required/></div>
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