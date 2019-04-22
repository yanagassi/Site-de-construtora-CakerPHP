<div style="padding: 40px; background: #fff;" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
        <tr>
            <td style="border-bottom:1px solid #f6f6f6;">
                <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Caro(a) <?php echo $to_name ?>,</h1>
                <p style="margin-top:0px; color:#bbbbbb;">Email de Notificação com Assinatura Eletrônica Enviado por: <?php echo $from_first_name .' '. $from_last_name ?> | Email: <?php echo $from_email ?></p>
            </td>
        </tr>
        <tr>
            <td style="padding:10px 0 30px 0;">
                <p>Esta notificação refere-se ao documento número: <?php echo $id ?>, enviado dia <?php echo $this->Custom->formatDateWithHours($date) ?></p>

                <br>
                <p><?php echo $this->Custom->formatTextToParagraphs($body) ?></p>
                <br>

                <?php if ( $is_electronic_signature && !$is_electronic_signature_checked ) : ?>
                    <center>

                        <?php if ( !empty($link_doc) )
                        {
                            $disabled = 'disabled';
                            $bg_color = 'ghostwhite';
                            $color = 'd2d2d2';

                            ?>
                            <a id="clicked_doc" target="_blank" href="<?php echo $link_doc ?>" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #03a9f3; border-radius: 60px; text-decoration:none;">Visualizar Documento</a>

                        <?php }else{

                            $disabled = '';
                            $bg_color = '#00c0c8';
                            $color = '#fff';

                        } ?>

                        <?php if ( ! $is_electronic_signature_checked ) { ?>

                        <form method="post" action="<?php echo $link_signature ?>"><input id="submit_doc_sign" <?php echo $disabled ?> type="submit" style="background:<?php echo $bg_color ?>;color:<?php echo $color ?>; display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; border-radius: 60px; text-decoration:none;" value="Assinar Eletronicamente" /></form>
                        <?php } ?>

                    </center>
                <?php endif; ?>
                <br>

                Ao clicar no botão 'Assinar Eletronicamente', declaro que li e estou ciente deste aviso e de seus documentos anexos caso existam.
                <br />
                <br />

                Atenciosamente<br/><b><?php echo $from_first_name .' '. $from_last_name ?></b>
            </td>
        </tr>
        <tr>
            <td  style="border-top:1px solid #f6f6f6; padding-top:20px; color:#777">Se você está recebendo este email e desconhece esta ação, contacte-nos através do email: info@<?php echo Configure::read('HOST_SUFIX') ?></td>
        </tr>
        </tbody>
    </table>
</div>