<div class="col-md-12 col-xs-12">
    <div class="white-box">
        <div class="tab-content">
            <div class="tab-pane active" id="profile">
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r"> <strong>Data da Assinatura</strong> <br>
                        <p class="text-muted"><?php echo (!empty($payment_information['PagseguroPayment']['created']) ? $this->Custom->formatDate($payment_information['PagseguroPayment']['created']) : "Nenhuma assinatura atribuída para este anúncio") ?></p>
                    </div>
                    <?php if (!empty($payment_information['PagseguroPayment']['created'])) { ?>
                    <div class="col-md-2 col-xs-6 b-r"> <strong>Valor</strong><br>
                        <p class="text-muted"><?php echo "R$" . $this->Custom->numberFormatToBR($payment_information['PagseguroPayment']['value']) ?></p>
                    </div>
                    <div class="col-md-2 col-xs-6 b-r"> <strong>Plano</strong><br>
                        <p class="text-muted"><?php echo $user_plan['Plan']['nome'] ?></p>
                    </div>
                    <div class="col-md-2 col-xs-6 b-r"> <strong>Cartão de Crédito</strong><br>
                        <p class="text-muted"><?php echo ( !empty($payment_information['PagseguroPayment']['cc_final_number']) ? "**** **** **** " . $payment_information['PagseguroPayment']['cc_final_number'] : "" ) ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Cód. Pagseguro</strong><br>
                        <p class="text-muted"><?php echo $payment_information['PagseguroPayment']['pagseguro_code'] ?></p>
                    </div>
                    <?php } ?>
                </div>

                <hr>

                <p class="m-t-30">Se você tiver qualquer dúvidas sobre sua assintura, entre em contato conosco através do email financeiro@construlista.com.br. Todos os planos e serviços da Construlista estão baseados nos termos de serviços e política de privacidade. Se houver dúvidas, </p>

            </div>

            <div class="row">
                <div class="col-sm-12 m-t-30 col-md-offset-5">
                    <form method="post" action="/painel/anuncios/financeiro/cancelar">
                        <input type="hidden" name="data[PagseguroPayment][pagseguro_code]"  value="<?php echo $payment_information['PagseguroPayment']['pagseguro_code'] ?>">
                        <input type="hidden" name="data[PagseguroPayment][id]"              value="<?php echo $payment_information['PagseguroPayment']['id'] ?>">
                        <input type="hidden" name="data[UserPlan][id]"                      value="<?php echo $user_plan['UserPlan']['id'] ?>">
                        <button class="btn btn-success btn-danger">Cancelar Assinatura</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>