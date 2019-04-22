<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $title_for_layout ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/painel/" title="Voltar para a Home">Início</a></li>
                    <li><a href="/painel/anuncios/" title="Listar todos"><?php echo $title_for_layout ?></a></li>
                    <li><a href="/painel/anuncios/editar/<?php echo $result['Advertisement']['id'] ?>" title="Listar todos">Edição</a></li>
                    <li>Logo</li>
                </ol>
            </div>
        </div>
        <!-- .row -->

        <style>
            .container {
                max-width: 960px;
            }
            img {
                max-width: 100%;
            }
        </style>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">

                    <h3 class="box-title m-b-0 text-center">Anúncio: <?php echo $result['Advertisement']['titulo_anuncio'] ?></h3>
                    <p class="text-muted m-b-20 text-center">Faça o upload de uma nova imagem e use a ferramenta abaixo para ajustá-la conforme sua necessidade.</p>

                    <link href="/plugins/bower_components/cropper/cropper.min.css" rel="stylesheet">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-9 p-20">
                                        <div class="img-container"><img id="image" src="/plugins/images/users/capaprofile.jpg" class="img-responsive"  alt="Picture"></div>
                                    </div>
                                    <div class="col-md-3 docs-buttons p-20">
                                        <div class="btn-group">
                                            <label class="btn btn-default btn-outline btn-upload" for="inputImage" title="">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip" title=""><span class="fa fa-upload"></span> Importar Imagem</span>
                                            </label>
                                        </div>
                                        <div class="btn-group btn-group-crop">
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas"> <span class="docs-tooltip" data-toggle="tooltip" title="">Visualizar</span></button>
                                        </div>

                                        <!-- Show the cropped image in modal -->
                                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="getCroppedCanvasTitle">Imagem Personalizada</h4>
                                                    </div>
                                                    <div class="modal-body"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                        <a style="display:none;" class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                        <a class="btn btn-primary" id="send_avatar" href="javascript:void(0);">Salvar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="application/javascript">
                    $(function () {
                        'use strict';

                        var console = window.console || { log: function () {} };
                        var URL = window.URL || window.webkitURL;
                        var $image = $('#image');
                        var $download = $('#download');
                        var $dataX = $('#dataX');
                        var $dataY = $('#dataY');
                        var $dataHeight = $('#dataHeight');
                        var $dataWidth = $('#dataWidth');
                        var $dataRotate = $('#dataRotate');
                        var $dataScaleX = $('#dataScaleX');
                        var $dataScaleY = $('#dataScaleY');
                        var options = {
                            aspectRatio: 1 / 1,
                            preview: '.img-preview',
                            crop: function (e) {
                                $dataX.val(Math.round(e.detail.x));
                                $dataY.val(Math.round(e.detail.y));
                                $dataHeight.val(Math.round(e.detail.height));
                                $dataWidth.val(Math.round(e.detail.width));
                                $dataRotate.val(e.detail.rotate);
                                $dataScaleX.val(e.detail.scaleX);
                                $dataScaleY.val(e.detail.scaleY);
                            }
                        };
                        var originalImageURL = $image.attr('src');
                        var uploadedImageName = 'cropped.jpg';
                        var uploadedImageType = 'image/jpeg';
                        var uploadedImageURL;

                        // Tooltip
                        $('[data-toggle="tooltip"]').tooltip();

                        // Cropper
                        $image.on({
                            ready: function (e) {
                                //console.log(e.type);
                            },
                            cropstart: function (e) {
                                //console.log(e.type, e.detail.action);
                            },
                            cropmove: function (e) {
                                //console.log(e.type, e.detail.action);
                            },
                            cropend: function (e) {
                                //console.log(e.type, e.detail.action);
                            },
                            crop: function (e) {
                                //console.log(e.type);
                            },
                            zoom: function (e) {
                                //console.log(e.type, e.detail.ratio);
                            }
                        }).cropper(options);

                        // Buttons
                        if (!$.isFunction(document.createElement('canvas').getContext)) {
                            $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
                        }

                        if (typeof document.createElement('cropper').style.transition === 'undefined') {
                            $('button[data-method="rotate"]').prop('disabled', true);
                            $('button[data-method="scale"]').prop('disabled', true);
                        }

                        // Download
                        if (typeof $download[0].download === 'undefined') {
                            $download.addClass('disabled');
                        }

                        // Options
                        $('.docs-toggles').on('change', 'input', function () {
                            var $this = $(this);
                            var name = $this.attr('name');
                            var type = $this.prop('type');
                            var cropBoxData;
                            var canvasData;

                            if (!$image.data('cropper')) {
                                return;
                            }

                            if (type === 'checkbox') {
                                options[name] = $this.prop('checked');
                                cropBoxData = $image.cropper('getCropBoxData');
                                canvasData = $image.cropper('getCanvasData');

                                options.ready = function () {
                                    $image.cropper('setCropBoxData', cropBoxData);
                                    $image.cropper('setCanvasData', canvasData);
                                };
                            } else if (type === 'radio') {
                                options[name] = $this.val();
                            }

                            $image.cropper('destroy').cropper(options);
                        });

                        // Methods
                        $('.docs-buttons').on('click', '[data-method]', function () {
                            var $this = $(this);
                            var data = $this.data();
                            var cropper = $image.data('cropper');
                            var cropped;
                            var $target;
                            var result;

                            if ($this.prop('disabled') || $this.hasClass('disabled')) {
                                return;
                            }

                            if (cropper && data.method) {
                                data = $.extend({}, data); // Clone a new one

                                if (typeof data.target !== 'undefined') {
                                    $target = $(data.target);

                                    if (typeof data.option === 'undefined') {
                                        try {
                                            data.option = JSON.parse($target.val());
                                        } catch (e) {
                                            console.log(e.message);
                                        }
                                    }
                                }

                                cropped = cropper.cropped;

                                switch (data.method) {
                                    case 'rotate':
                                        if (cropped && options.viewMode > 0) {
                                            $image.cropper('clear');
                                        }

                                        break;

                                    case 'getCroppedCanvas':
                                        if (uploadedImageType === 'image/jpeg') {
                                            if (!data.option) {
                                                data.option = {};
                                            }

                                            data.option.fillColor = '#fff';
                                        }

                                        break;
                                }

                                result = $image.cropper(data.method, data.option, data.secondOption);

                                switch (data.method) {
                                    case 'rotate':
                                        if (cropped && options.viewMode > 0) {
                                            $image.cropper('crop');
                                        }

                                        break;

                                    case 'scaleX':
                                    case 'scaleY':
                                        $(this).data('option', -data.option);
                                        break;

                                    case 'getCroppedCanvas':
                                        if (result) {
                                            // Bootstrap's Modal
                                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                                            if (!$download.hasClass('disabled')) {
                                                download.download = uploadedImageName;
                                                $download.attr('href', result.toDataURL(uploadedImageType));
                                            }
                                        }

                                        break;

                                    case 'destroy':
                                        if (uploadedImageURL) {
                                            URL.revokeObjectURL(uploadedImageURL);
                                            uploadedImageURL = '';
                                            $image.attr('src', originalImageURL);
                                        }

                                        break;
                                }

                                if ($.isPlainObject(result) && $target) {
                                    try {
                                        $target.val(JSON.stringify(result));
                                    } catch (e) {
                                        console.log(e.message);
                                    }
                                }
                            }
                        });

                        // Keyboard
                        $(document.body).on('keydown', function (e) {
                            if (e.target !== this || !$image.data('cropper') || this.scrollTop > 300) {
                                return;
                            }

                            switch (e.which) {
                                case 37:
                                    e.preventDefault();
                                    $image.cropper('move', -1, 0);
                                    break;

                                case 38:
                                    e.preventDefault();
                                    $image.cropper('move', 0, -1);
                                    break;

                                case 39:
                                    e.preventDefault();
                                    $image.cropper('move', 1, 0);
                                    break;

                                case 40:
                                    e.preventDefault();
                                    $image.cropper('move', 0, 1);
                                    break;
                            }
                        });

                        // Import image
                        var $inputImage = $('#inputImage');

                        if (URL) {
                            $inputImage.change(function () {
                                var files = this.files;
                                var file;

                                if (!$image.data('cropper')) {
                                    return;
                                }

                                if (files && files.length) {
                                    file = files[0];

                                    if (/^image\/\w+$/.test(file.type)) {
                                        uploadedImageName = file.name;
                                        uploadedImageType = file.type;

                                        if (uploadedImageURL) {
                                            URL.revokeObjectURL(uploadedImageURL);
                                        }

                                        uploadedImageURL = URL.createObjectURL(file);
                                        $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                                        $inputImage.val('');
                                    } else {
                                        window.alert('Please choose an image file.');
                                    }
                                }
                            });
                        } else {
                            $inputImage.prop('disabled', true).parent().addClass('disabled');
                        }


                        $('#send_avatar').on('click', function()
                        {
                            $('.preloader').show(); // show loading process
                            var imgData  = $('#download').attr('href');
                            var formData =
                            {
                                "Advertisement" :
                                {
                                    "id"            : <?php echo $result['Advertisement']['id'] ?>,
                                    "img" 			: imgData,
                                    "relative_path" : 'uploads/anuncio/logo',
                                    "field"         : 'logo'
                                }
                            }

                            $.ajax({
                                url: '/advertisements/upload_image/',
                                dataType: 'json',
                                data:  formData,
                                type: 'POST',
                                success: function(result)
                                {
                                    if ( result.status )
                                    {
                                        $('.preloader').hide(); // hidding process
                                        $('#flash-ajax-success').text(result.msg);
                                        $('#flash-ajax-success').show("slow").delay(2000);
                                        $("#flash-ajax-success").hide('blind');
                                        window.location.replace("/painel/anuncios/editar/<?php echo $result['Advertisement']['id'] ?>");
                                    }
                                    else
                                    {
                                        $('.preloader').hide(); // hidding process
                                        $('#flash-ajax-error').text(result.msg);
                                        $('#flash-ajax-error').show("slow").delay(2000).hide('highlight', {color: '#e26857'}, 1500);
                                    }

                                }
                            });

                            $('.modal.in').modal('hide');
                        });
                    });
                    </script>

                    <script src="/plugins/bower_components/cropperjs-master/dist/cropper.js"></script>
                    <link rel="stylesheet" href="/plugins/bower_components/cropperjs-master/dist/cropper.css">

                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <?php echo $this->element('footer'); ?>
</div>