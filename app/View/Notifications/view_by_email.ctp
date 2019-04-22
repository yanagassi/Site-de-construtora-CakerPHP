<div style="padding: 40px; background: #fff;">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
        <tr>
            <td style="border-bottom:1px solid #f6f6f6;">
                <h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Caro(a) <?php echo $to_name ?>,</h1>
                <p style="margin-top:0px; color:#bbbbbb;">Email de Notificação com AR Enviado por: <?php echo $from_first_name .' '. $from_last_name ?> | Email: <?php echo $from_email ?></p>
            </td>
        </tr>
        <tr>
            <td style="padding:10px 0 30px 0;">
                <p>Esta notificação refere-se ao documento número: <?php echo $id ?>, enviado dia <?php echo $this->Custom->formatDateWithHours($date) ?></p>

                <br>
                <p><?php echo $this->Custom->formatTextToParagraphs($body) ?></p>
                <br>

                <?php if ( !empty($link_doc) ) { ?>
                    <center>
                    <a id="clicked_doc_ar" target="_blank" href="<?php echo $link_doc ?>" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #03a9f3; border-radius: 60px; text-decoration:none;">Visualizar Documento</a>
                    </center>
                <?php } ?>

                <b>Atenciosamente<br/><?php echo $from_first_name .' '. $from_last_name ?></b>
            </td>
        </tr>
        <tr>
            <td  style="border-top:1px solid #f6f6f6; padding-top:20px; color:#777">Se você está recebendo este email e desconhece esta ação, contacte-nos através do email: info@<?php echo Configure::read('HOST_SUFIX') ?></td>
        </tr>
        </tbody>
    </table>
</div>