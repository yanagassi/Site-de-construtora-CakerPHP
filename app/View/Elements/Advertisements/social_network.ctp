                            <h3>Redes Sociais</h3>
                            <form method="post" action="/admin/anuncios/editar/<?php echo $result['Advertisement']['id'] ?>">
                            <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Facebook</span></label>
                                                <input type="text" rel="SocialNetwork" name="facebook" id="facebook" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['facebook']) ? $result['SocialNetwork']['facebook'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['facebook']) ? $result['SocialNetwork']['facebook'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['facebook']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="facebook"><i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['facebook']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['facebook']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>


                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">YouTube</span></label>
                                                <input type="text" rel="SocialNetwork" name="youtube" id="youtube" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['youtube']) ? $result['SocialNetwork']['youtube'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['youtube']) ? $result['SocialNetwork']['youtube'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['youtube']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="youtube"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['youtube']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Twitter</span></label>
                                                <input type="text" rel="SocialNetwork" name="twitter" id="twitter" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['twitter']) ? $result['SocialNetwork']['twitter'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['twitter']) ? $result['SocialNetwork']['twitter'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['twitter']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="twitter"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['twitter']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Instagram</span></label>
                                                <input type="text" rel="SocialNetwork" name="instagram" id="instagram" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['instagram']) ? $result['SocialNetwork']['instagram'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['instagram']) ? $result['SocialNetwork']['instagram'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['instagram']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="instagram"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['instagram']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Google+</span></label>
                                                <input type="text" rel="SocialNetwork" name="google_plus" id="google_plus" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['google_plus']) ? $result['SocialNetwork']['google_plus'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['google_plus']) ? $result['SocialNetwork']['google_plus'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['google_plus']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="google_plus"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['google_plus']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="col-md-12"><span class="help">Site</span></label>
                                                <input type="text" rel="SocialNetwork" name="site" id="site" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['site']) ? $result['SocialNetwork']['site'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['facebook']) ? $result['SocialNetwork']['facebook'] : "" ) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group" style="margin-top:30px">
                                                <?php if ( !empty($result['SocialNetwork']['site']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="site"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['site']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-md-12"><span class="help">LinkedIn</span></label>
                                            <input type="text" rel="SocialNetwork" name="linkedin" id="linkedin" class="form-control ajaxSave" value="<?php echo ( !empty($result['SocialNetwork']['linkedin']) ? $result['SocialNetwork']['linkedin'] : "" ) ?>" data-value="<?php echo ( !empty($result['SocialNetwork']['linkedin']) ? $result['SocialNetwork']['linkedin'] : "" ) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:30px">
                                            <?php if ( !empty($result['SocialNetwork']['linkedin']) ) { ?>
                                                <a href="javascript:void(0)" id="" data-role="SocialNetwork" class="bt_del_socialmedia" data-id="<?php echo $result['SocialNetwork']['id'] ?>" data-value="linkedin"><i class="fa fa-trash text-danger fa-2x" aria-hidden="true"></i></a>
                                            <?php }else{ ?>
                                                <i class="fa fa-trash <?php echo ( !empty($result['SocialNetwork']['linkedin']) ? "text-danger" : "text-muted" ) ?> fa-2x" aria-hidden="true"></i>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                            <script>
                                $(document).ready(function () {
                                    $( '.bt_del_socialmedia' ).on('click', function()
                                    {
                                        //$('.preloader').show(); // loading process // ToDo: Show loadding proccess if loading is more than 3 sec.
                                        var _model       = $(this).data('role');
                                        var _id          = $(this).data('id');
                                        var _field       = $(this).data('value');

                                        if ( $('#'+_field).val() != "" ) // verify if original value has changed
                                        {
                                            $('.preloader').show(); // show loading process

                                            var formData = "";
                                            formData = {
                                                "model": _model,
                                                "name":  _field,
                                                "id":    _id
                                            }

                                            $.ajax({
                                                type: "POST",
                                                dataType: "json",
                                                url: "/admin/socialnetworks/ajax_delete",
                                                data: formData,
                                                success: function (result)
                                                {
                                                    if ( result.status )
                                                    {
                                                        $('.preloader').hide(); // hidding process
                                                        $('#flash-ajax-success').text(result.msg);
                                                        $('#flash-ajax-success').show("slow").delay(2000);
                                                        $("#flash-ajax-success").hide('blind');

                                                        $('#'+_field).val('');
                                                        $('#'+_field).data("value",'');
                                                        $(this).next().removeClass('text-danger');
                                                        $(this).addClass('text-muted');
                                                        $('.preloader').hide();
                                                    }
                                                    else
                                                    {
                                                        $('.preloader').hide(); // hidding process
                                                        $('#flash-ajax-error').text(result.msg);
                                                        $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                                                        $('.preloader').hide();
                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>