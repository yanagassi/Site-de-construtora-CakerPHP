                            <link href="/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
                            <script src="/plugins/bower_components/dropzone-master/dist/dropzone.js"></script>

                            <h3 class="box-title m-b-0 text-center">Geleria de Fotos</h3>

                            <div class="form-group">
                                <label class="col-md-12">Arraste as fotos para dentro do box ou clique no mesmo</label>
                            </div>

                            <form action="/advertisements/upload_img_gallery" class="" enctype="multipart/form-data" method="POST">
                                <div class="dropzone dz-clickable dz-started" id="myDropzone"></div>
                                <p class="minhas-fotos" style="display: none">Tamanho máximo de cada foto: 3Mb | Número máximo de fotos: 10</p>
                            </form>

                            <div class="minhas-fotos" style="display: none">
                                <?php foreach ($result['Photo'] as $photo):
                                    if ( file_exists( WWW_ROOT . "/uploads/anuncio/galeria/" . $photo['anuncio_id'] . '/' . $photo['foto'] ) ) {
                                    ?>
                                    <div class="col-md-2">
                                        <a href="/uploads/anuncio/galeria/<?php echo $photo['anuncio_id'] ?>/<?php echo $photo['foto'] ?>" class="swipebox">
                                            <img src="/uploads/anuncio/galeria/<?php echo $photo['anuncio_id'] ?>/<?php echo $photo['foto'] ?>" width="100" alt="image">
                                        </a>
                                        <a href="/advertisements/remove_img_gallery/<?php echo $photo['id']?>/<?php echo $photo['anuncio_id']?>/<?php echo $photo['foto'] ?>" class="btn_remove_photo"><i class="fa fa-trash"></i> Remover</a>
                                    </div>
                                <?php }
                                endforeach; ?>
                            </div>

                            <script>
                                $(document).ready(function ()
                                {
                                    $('#myDropzone').show();
                                    $('.minhas-fotos').show();

                                    var maxFilesUpload = 10 - <?php echo count($result['Photo']) ?>;

                                    $(".btn_remove_photo").on("click", function (e)
                                    {
                                        maxFilesUpload--;
                                    });

                                    Dropzone.options.myDropzone =
                                    {
                                        url: '/advertisements/upload_img_gallery',
                                        uploadMultiple: true,
                                        parallelUploads: 1,
                                        maxFiles: maxFilesUpload,
                                        maxFilesize: 3,
                                        dictDefaultMessage: "Clique ou arraste os arquivos para upload",
                                        dictMaxFilesExceeded: "Máximo de 10 imagens",
                                        dictResponseError: "Você atingiu o número máximo de imagens",
                                        params: {
                                            id: <?php echo $result['Advertisement']['id']; ?>
                                        }
                                    }

                                    $('.dz-message').show();
                                });
                            </script>