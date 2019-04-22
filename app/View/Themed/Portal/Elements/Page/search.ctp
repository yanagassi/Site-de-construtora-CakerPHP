<div class="ms-hero-page ms-hero-img-city2 ms-hero-bg-info">
    <div class="container">
        <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Encontre Empresas, Profissionais, Produtos e Serviços</span>
            </h1>
            <form action="/busca" method="get" class="mt-4 mw-800 center-block animated fadeInUp">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group label-floating input-group">
                            <label class="control-label ml-1 color-white" for="inputDefault2">O que você precisa...</label>
                            <input type="text" name="termo" id="termo" class="termo form-control color-white" placeholder="O que você precisa..." value="<?php echo ( !empty($this->request->query['termo']) ? $this->request->query['termo'] : "" ) ?>" id="inputDefault2" style="border:2px solid white;background-image:none;padding-left: 10px;background-color:#fff;color:#000!important;">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group row justify-content-end">
                            <div class="col-lg-10 color-white city">
                                <style>
                                    .filter-option{border:2px solid;background-color:#fff}
                                    .filter-option-inner{color:#000}
                                </style>
                                <?php
                                $cidadesEstados[''] = 'Todas as cidades';

                                foreach ($cidades as $valor) {
                                    $cidade = $valor['Address']['cidade'] . '/' . $valor['Address']['estado'];
                                    $cidadesEstados[$valor['Address']['cidade']] = $cidade;
                                }

                                $city_and_uf = ( !empty($this->request->query['cidade']) ? preg_split("#/#", $this->request->query['cidade']) : "" );

                                echo $this->Form->input(
                                     'cidade'
                                    ,array
                                    (
                                         'id'               => 'select111'
                                        ,'options'          => $cidadesEstados
                                        ,'value'            => $city_and_uf
                                        ,'class'            => 'form-control selectpicker'
                                        ,'label'            => false
                                        ,'data-dropup-auto' => false
                                        ,'label'            => false
                                        ,'div'              => false
                                    )
                                );
                                ?>
                                <input type="hidden" name="cidade" id="city_setted">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-2">
                        <div class="form-group label-floating input-group " style="margin-top:16px">
                            <button type="submit" id="btn_search" class="btn btn-raised btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="checkbox label-floating input-group ">
                            <label>
                                <input id="check-2" type="checkbox" name="type_person_pj" value="JURÍDICA" <?php echo ( !empty($this->request->query['type_person_pj']) ? "checked='checked'" : "" ) ?> />
                                <span for="check-2"></span> Empresas
                            </label>

                            <label>
                                <input id="check-3" type="checkbox" name="type_person_pf" value="FÍSICA" <?php echo ( !empty($this->request->query['type_person_pf']) ? "checked='checked'" : "" ) ?> />
                                <span for="check-2" id="check-3_text"></span> Profissionais
                            </label>

                            <label>
                                <input id="check-4" type="checkbox" name="type_product" value="produtos" <?php echo ( !empty($this->request->query['type_product']) ? "checked='checked'" : "" ) ?> />
                                <span for="check-4" id="check-4_text"></span> Produtos
                            </label>

                            <label>
                                <input id="check-5" type="checkbox" name="type_services" value="servicos" <?php echo ( !empty($this->request->query['type_services']) ? "checked='checked'" : "" ) ?> />
                                <span for="check-5"></span> Serviços
                            </label>
                            <style>
                                span.check{
                                    border:2px solid #bdbdbd!important;
                                }
                                #btn_search
                                {
                                    background-color:#f3863f;
                                }
                                button.dropdown-toggle
                                {
                                    text-transform:capitalize;
                                }
                            </style>
                        </div>
                        <script type="text/javascript">
                            $( document ).ready(function()
                            {
                                // Validation if term is present.
                                if ( $(".termo").length == 1  && $(".termo").val() == '' )
                                {
                                    $("#btn_search").attr('disabled', true);
                                }
                                else
                                {
                                    $("#btn_search").attr('disabled', false);
                                }

                                // validation if input text has term inputed
                                $('input[type="text"]').keyup(function()
                                {
                                    if($(this).val() != '')
                                    {
                                        $(':input[type="submit"]').prop('disabled', false);

                                        var termo = $('.termo').val();
                                        $('.termo').val(termo);
                                        $('#term_setted').val(termo);
                                    }
                                    else
                                    {
                                        $(':input[type="submit"]').prop('disabled', true);
                                    }
                                });

                                $( "#check-3" ).click(function() {
                                    if (this.checked) { // if check Profissional
                                        $("#check-4").attr("disabled", true); // disabled produtos
                                        $("#check-4_text").css( "text-decoration", "line-through" );
                                    } else {
                                        $("#check-4").removeAttr("disabled");
                                        $("#check-4_text").css( "text-decoration", "none" );
                                    }
                                });

                                $( "#check-4" ).click(function(){
                                    if (this.checked) { // if check Product
                                        $("#check-3").attr("disabled", true); // disabled Profissional
                                        $("#check-3_text").css( "text-decoration", "line-through" );
                                    } else {
                                        $("#check-3").removeAttr("disabled");
                                        $("#check-3_text").css( "text-decoration", "none" );
                                    }
                                });

                                $( "#check-3" ).click(function() {
                                    if (this.checked) { // if check Profissional
                                        $("#check-4").attr("disabled", true); // disabled produtos
                                        $("#check-4_text").css( "text-decoration", "line-through" );
                                    } else {
                                        $("#check-4").removeAttr("disabled");
                                        $("#check-4_text").css( "text-decoration", "none" );
                                    }
                                });

                                $( "#check-4" ).click(function(){
                                    if (this.checked) { // if check Product
                                        $("#check-3").attr("disabled", true); // disabled Profissional
                                        $("#check-3_text").css( "text-decoration", "line-through" );
                                    } else {
                                        $("#check-3").removeAttr("disabled");
                                        $("#check-3_text").css( "text-decoration", "none" );
                                    }
                                });

                            });
                        </script>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>