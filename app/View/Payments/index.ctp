<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Financeiro</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<?php echo $this->Html->link('Novo', array('controller' => 'plans', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
				<ol class="breadcrumb">
					<li><a href="/painel/dashboard/" title="Voltar para a Home">Início</a></li>
					<li><a href="/painel/anuncios/" title="Voltar">Anúncios</a></li>
					<li><a href="/financeiro" title="Voltar">Financeiro</a></li>
				</ol>
			</div>
		</div>
		<!-- /row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<section>
						<div class="sttabs tabs-style-bar">
							<nav>
								<ul>
									<li class="tab-current"><a href="#section-bar-1" class="sticon fa fa-server"><span>Planos</span></a></li>

									<?php if ( !empty($user_plan) && $user_plan['UserPlan']['plan_id'] != 8 ) { // != Free não precisa mostrar dados de assinatura, pq não tem ?>
									<li class=""><a href="#section-bar-3" class="sticon fa fa-credit-card"><span>Dados da Assinatura</span></a></li>
									<?php } ?>
								</ul>
							</nav>
							<div class="content-wrap">
								<section id="section-bar-1" class="content-current">
									<br>
									<br>
									<?php echo $this->element('Payments/plans'); ?>
								</section>

								<?php if ( empty($user_plan['UserPlan']) || $user_plan['UserPlan']['plan_id'] != 8 ) { // != Free não precisa mostrar dados de assinatura, pq não tem ?>
								<section id="section-bar-2" class="">
									<br>
									<br>
									<?php echo $this->element('Payments/signature'); ?>
								</section>
								<?php } ?>
							</div>
						</div>
					</section>

				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('footer'); ?>
</div>
<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>