<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Contratos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/contratos/buscar" title="Voltar para Contratos">Contratos</a></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="tab active"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Contrato</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Nome</strong> <br>
								<p class="text-muted"><?php echo $agreement['Agreement']['name']; ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>CPF/CNPJ</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->mask_cpf_cnpj($agreement['Agreement']['cpf_cnpj']); ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Valor</strong> <br>
								<p class="text-muted"><?php echo h($agreement['Agreement']['value']); ?></p>
							</div>
							<div class="col-md-3 col-xs-6"> <strong>Adicioando em:</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->formatDateWithHours($agreement['Agreement']['created']); ?></p>
							</div>
						</div>
						<hr>
						<?php echo $this->Custom->limitText($agreement['Agreement']['description'], 200); ?> | <a href="/contratos/comprar/<?php echo $agreement['Agreement']['id'] ?>">Ver Contrato Completo</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:history.back(-1);" class="fcbtn btn btn-info btn-outline btn-1c">Voltar</a>
</div>