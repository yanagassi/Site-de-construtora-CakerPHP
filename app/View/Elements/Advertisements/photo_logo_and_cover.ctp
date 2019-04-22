        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <div class="row">
                        <h3 class="box-title m-b-0 text-center">Logo</h3>
                        <p class="text-muted m-b-20 text-center">Faça o upload de uma nova imagem e use a ferramenta abaixo para ajustá-la conforme sua necessidade.</p>
                        <?php
                        $logo = '/plugins/images/users/capaprofile.jpg';
                        if ( $result['Advertisement']['logo'] != null && file_exists( WWW_ROOT . "/uploads/anuncio/logo/" . $result['Advertisement']['id'] . '/' . $result['Advertisement']['logo'] ) )
                        {
                            $logo = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/logo/' . $result['Advertisement']['id'] . '/' . $result['Advertisement']['logo'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="img-container"><img id="image" src="<?php echo $logo ?>" class="img-responsive logo"  alt="Picture"></div>
                        </div>
                        <div class="col-md-6 m-t-40">
                            <a href="/advertisements/photo_logo/<?php echo $result['Advertisement']['id'] ?>" class="btn btn-raised btn-default">Alterar Logo<div class="ripple-container"></div></a>
                        </div>

                        <?php if ( $result['Advertisement']['logo'] != null ) : ?>
                        <div class="col-md-6 m-t-40 btn_remove_logo">
                            <a href="javascript:void(0)" class="btn btn-raised btn-default btRemovePhoto">Remover Logo<div class="ripple-container"></div></a>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="white-box">
                    <h3 class="box-title m-b-0 text-center">Foto de Capa</h3>
                    <p class="text-muted m-b-20 text-center">Faça o upload de uma nova imagem e use a ferramenta abaixo para ajustá-la conforme sua necessidade.</p>
                    <?php
                    $capa = '/plugins/images/users/capaprofile.jpg';
                    if ( $result['Advertisement']['foto_capa'] != null && file_exists( WWW_ROOT . "/uploads/anuncio/foto_capa/" . $result['Advertisement']['id'] . '/' . $result['Advertisement']['foto_capa'] ) )
                    {
                        $capa = Configure::read('SCHEME') . $_SERVER["SERVER_NAME"] . '/uploads/anuncio/foto_capa/' . $result['Advertisement']['id'] . '/' . $result['Advertisement']['foto_capa'];
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="img-container"><img id="image" src="<?php echo $capa ?>" class="img-responsive capa"  alt="Picture"></div>
                        </div>
                        <div class="col-md-6 m-t-40">
                            <a href="/advertisements/photo_capa/<?php echo $result['Advertisement']['id'] ?>" class="btn btn-raised btn-default">Alterar Foto de Capa<div class="ripple-container"></div></a>
                        </div>

                        <?php if ( $result['Advertisement']['foto_capa'] != null ) : ?>
                            <div class="col-md-6 m-t-40 btn_remove_capa">
                                <a href="javascript:void(0)" class="btn btn-raised btn-default btRemoveCapa">Remover Capa<div class="ripple-container"></div></a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function (){
                $( '.btRemovePhoto' ).on('click', function(){
                    $('.preloader').show(); // show loading process
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/advertisements/remove_photo_logo/<?php echo $result['Advertisement']['id'] ?>",
                        success: function (result)
                        {
                            if ( result.status )
                            {
                                $('.preloader').hide(); // hidding process
                                $('#flash-ajax-success').text(result.msg);
                                $('#flash-ajax-success').show("slow").delay(2000);
                                $("#flash-ajax-success").hide('blind');

                                $('.logo').prop('src','/plugins/images/users/capaprofile.jpg');
                                $('.btn_remove_logo').remove();
                            }
                            else
                            {
                                $('.preloader').hide(); // hidding process
                                $('#flash-ajax-error').text(result.msg);
                                $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                            }
                        }
                    });
                });

                $( '.btRemoveCapa' ).on('click', function(){
                    $('.preloader').show(); // show loading process
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/advertisements/remove_photo_capa/<?php echo $result['Advertisement']['id'] ?>",
                        success: function (result)
                        {
                            if ( result.status )
                            {
                                $('.preloader').hide(); // hidding process
                                $('#flash-ajax-success').text(result.msg);
                                $('#flash-ajax-success').show("slow").delay(2000);
                                $("#flash-ajax-success").hide('blind');

                                $('.capa').prop('src','/plugins/images/users/capaprofile.jpg');
                                $('.btn_remove_capa').remove();
                            }
                            else
                            {
                                $('.preloader').hide(); // hidding process
                                $('#flash-ajax-error').text(result.msg);
                                $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                            }
                        }
                    });
                });
            });
            </script>

        </div>
