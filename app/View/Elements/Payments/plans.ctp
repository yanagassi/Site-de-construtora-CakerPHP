            <div class="row pricing-plan">
                <div class="col-md-4 col-xs-12 col-sm-6 no-padding">
                    <div class="pricing-box b-l">
                        <div class="pricing-body">
                            <div class="pricing-header">

                                <?php if ( $user_plan['UserPlan']['plan_id'] == 8 ) { ?>
                                    <h4 class="price-lable text-white bg-warning">Atual</h4>
                                <?php } ?>

                                <h4 class="text-center">Free</h4>
                                <h2 class="text-center"><span class="price-sign">$</span>00</h2>
                                <p class="uppercase">por mês</p>
                            </div>
                            <div class="price-table-content">
                                <div class="price-row"><i class="fa fa-info"></i> Informações do negócio</div>
                                <div class="price-row"><i class="fa fa-globe"></i> Empresa no mapa</div>
                                <div class="price-row"><i class="fa fa-cog"></i> 6 Cadastro de produtos</div>
                                <div class="price-row"><i class="fa fa-cogs"></i> 6 Cadastro de serviços</div>
                                <div class="price-row"><i class="fa fa-cloud"></i> Relatório mensal das atividades</div>
                                <div class="price-row"><i class="fa fa-comments"></i> Chat</div>
                                <?php if ( isset($user_plan['UserPlan']) && $user_plan['UserPlan']['plan_id'] != 8 ) { ?>
                                    <div class="price-row">
                                        <form action="/painel/anuncios/financeiro/novo" method="get">
                                            <input type="hidden" name="advertisement_id" value="<?php echo $advertisement['Advertisement']['id'] ?>">
                                            <input type="hidden" name="plan_id"          value="8">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-t-20">Trocar para o Free!</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-6 no-padding">
                    <div class="pricing-box featured-plan">
                        <div class="pricing-body">
                            <div class="pricing-header">

                                <?php if ( $user_plan['UserPlan']['plan_id'] == 9 ) { ?>
                                <h4 class="price-lable text-white bg-warning">Atual</h4>
                                <?php } ?>

                                <h4 class="text-center">Prata</h4>
                                <h2 class="text-center"><span class="price-sign">$</span>49,90</h2>
                                <p class="uppercase">por mês</p>
                            </div>
                            <div class="price-table-content">
                                <div class="price-row"><i class="fa fa-info"></i> Informações do negócio</div>
                                <div class="price-row"><i class="fa fa-globe"></i> Empresa no mapa</div>
                                <div class="price-row"><i class="fa fa-cog"></i> 10 Cadastro de produtos</div>
                                <div class="price-row"><i class="fa fa-cogs"></i> Cadastro de serviços ilimitados</div>
                                <div class="price-row"><i class="fa fa-cloud"></i> Relatório mensal das atividades</div>
                                <div class="price-row"><i class="fa fa-comments"></i> Chat</div>

                                <?php if (isset($user_plan['UserPlan'])) { ?>
                                    <?php if ( $user_plan['UserPlan']['plan_id'] != 9 ) { ?>
                                    <div class="price-row">
                                        <form action="/painel/anuncios/financeiro/novo" method="get">
                                            <input type="hidden" name="advertisement_id" value="<?php echo $advertisement['Advertisement']['id'] ?>">
                                            <input type="hidden" name="plan_id"          value="9">
                                            <button type="submit" class="btn btn-lg btn-info waves-effect waves-light m-t-20">Assinar Este!</button>
                                        </form>
                                    </div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <div class="price-row">
                                        <form action="/painel/anuncios/financeiro/novo" method="get">
                                            <input type="hidden" name="advertisement_id" value="<?php echo $advertisement['Advertisement']['id'] ?>">
                                            <input type="hidden" name="plan_id"          value="9">
                                            <button type="submit" class="btn btn-lg btn-info waves-effect waves-light m-t-20">Assinar Este!</button>
                                        </form>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <br>
                        <br>
                        <a href="/planos/">Ver comparativo de planos</a>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-6 no-padding">
                    <div class="pricing-box">
                        <div class="pricing-body b-r">
                            <div class="pricing-header">

                                <?php if ( $user_plan['UserPlan']['plan_id'] == 10 ) { ?>
                                <h4 class="price-lable text-white bg-warning">Atual</h4>
                                <?php } ?>

                                <h4 class="text-center">Ouro</h4>
                                <h2 class="text-center"><span class="price-sign">$</span>89,90</h2>
                                <p class="uppercase">por mês</p>
                            </div>
                            <div class="price-table-content">
                                <div class="price-row"><i class="fa fa-info"></i> Informações do negócio</div>
                                <div class="price-row"><i class="fa fa-globe"></i> Empresa no mapa</div>
                                <div class="price-row"><i class="fa fa-cog"></i> Cadastro de produtos ilimitados</div>
                                <div class="price-row"><i class="fa fa-cogs"></i> Cadastro de serviços ilimitados</div>
                                <div class="price-row"><i class="fa fa-cloud"></i> Relatório mensal das atividades</div>
                                <div class="price-row"><i class="fa fa-comments"></i> Chat</div>
                                <?php if ( isset($user_plan['UserPlan']) ) { ?>
                                    <?php if ( $user_plan['UserPlan']['plan_id'] != 10 ) { ?>
                                        <div class="price-row">
                                            <form action="/painel/anuncios/financeiro/novo" method="get">
                                                <input type="hidden" name="advertisement_id" value="<?php echo $advertisement['Advertisement']['id'] ?>">
                                                <input type="hidden" name="plan_id"          value="10">
                                                <button type="submit" class="btn btn-success waves-effect waves-light m-t-20">Assinar Este!</button>
                                            </form>
                                        </div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <div class="price-row">
                                        <form action="/painel/anuncios/financeiro/novo" method="get">
                                            <input type="hidden" name="advertisement_id" value="<?php echo $advertisement['Advertisement']['id'] ?>">
                                            <input type="hidden" name="plan_id"          value="10">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-t-20">Assinar Este!</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>