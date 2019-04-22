<br>
<br>
<div class="row">
    <div class="col-xl-4 order-xl-2"></div>
    <div class="col-xl-4 order-xl-2">
        <div class="card card-primary animated fadeInUp animation-delay-7">
            <div class="card-body">
                <h1 class="color-primary text-center">Entrar</h1>
                <form class="form-horizontal" action="/users/login" method="post">
                    <script type="text/javascript">
                    jQuery(document).ready(function(){
                        $('#cpf').focus().val();
                    });
                    </script>
                    <fieldset>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input type="text" class="form-control" name="data[User][cpf]" id="cpf" onkeypress="javascript:mascara(this,cpf_mask)" maxlength="14" placeholder="CPF" required /></div>
                        </div>
                        <div class="form-group row is-empty">
                            <div class="col-md-12"><input data-id="inputPassword-login" class="form-control" type="password" name="data[User][senha]" id="password" placeholder="Senha" required/></div>
                        </div>
                    </fieldset>
                    <button class="btn btn-raised btn-primary btn-block">Entrar<i class="zmdi zmdi-long-arrow-right no-mr ml-1"></i></button>
                    <p class="text-center"><a href="/esqueci-minha-senha/" >Esqueceu sua senha ?</a></p>
                </form>

    <!--            <div class="text-center mt-4">-->
    <!--                <h3>Login with</h3>-->
    <!--                <a href="javascript:void(0)" class="btn-circle btn-facebook">-->
    <!--                    <i class="zmdi zmdi-facebook"></i>-->
    <!--                </a>-->
    <!--                <a href="javascript:void(0)" class="btn-circle btn-twitter">-->
    <!--                    <i class="zmdi zmdi-twitter"></i>-->
    <!--                </a>-->
    <!--                <a href="javascript:void(0)" class="btn-circle btn-google">-->
    <!--                    <i class="zmdi zmdi-google"></i>-->
    <!--                </a>-->
    <!--            </div>-->
            </div>
        </div>
    </div>
    <div class="col-xl-4 order-xl-2"></div>
</div>
<script>
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    function cpf_mask(v) {
        v = v.replace(/\D/g, "")                 //Remove tudo o que não é dígito
        v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
        v = v.replace(/(\d{3})(\d)/, "$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
        return v
    }
</script>