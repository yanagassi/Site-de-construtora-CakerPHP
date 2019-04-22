<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Contratos</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<?php echo $this->Html->link('Novo', array('controller' => 'agreements', 'action' => 'add'), array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
			<ol class="breadcrumb">
				<li><a href="/" title="Voltar para a Home">Início</a></li>
				<li><a href="/contratos" title="Listar todos">Contratos</a></li>
			</ol>
		</div>
	</div>
	<!-- /row -->

	<div class="row">

		<div class="white-box">
			<h3 class="box-title">Busque Aqui</h3>
			<form class="form-group" role="search" action="/contratos/buscar" method="post">
				<div class="input-group">
					<input type="text" id="example-input1-group2" name="data[Agreement][search_term]"  class="form-control" placeholder="Informe um CPF/CNPJ" maxlength="18">
					<span class="input-group-btn"><button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button></span>
				</div>
			</form>

			<?php if ( !empty($search_term)){ ?>
			<h2 class="m-t-40">Resultado da Busca por "<?php echo $this->Custom->mask_cpf_cnpj($search_term) ?>"</h2>
			<small>Total de Resultados: <?php echo $search_total_result ?></small>

			<hr>

			<ul class="search-listing">
				<?php foreach ($result as $item){ ?>
				<li>
					<h3><a href="/contratos/item/<?php echo $item['Agreement']['id'] ?>"><?php echo $item['Agreement']['name'] ?></a></h3>
					<a href="/contratos/item/<?php echo $item['Agreement']['id'] ?>" class="search-links"><?php echo "R$ ". $this->Custom->numberFormatToBR($item['Agreement']['value']) ?></a>
					<p><?php echo $item['Agreement']['description'] ?> | <a href="/contratos/item/<?php echo $item['Agreement']['id'] ?>">Ver</a></p>
				</li>
				<?php } ?>
			</ul>

<!--			<ul class="pagination m-b-0">-->
<!--				<li class="disabled"> <a href="#"><i class="fa fa-angle-left"></i></a> </li>-->
<!--				<li> <a href="javascript:void(0)">1</a> </li>-->
<!--				<li class="active"> <a href="javascript:void(0)">2</a> </li>-->
<!--				<li> <a href="javascript:void(0)">3</a> </li>-->
<!--				<li> <a href="javascript:void(0)">4</a> </li>-->
<!--				<li> <a href="javascript:void(0)">5</a> </li>-->
<!--				<li> <a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a> </li>-->
<!--			</ul>-->

			<?php } ?>

		</div>

		<?php /*
		<div class="col-lg-12">
			<div class="white-box">
				<h3 class="box-title m-b-0">Contratos de Clientes</h3>
				<p class="text-muted m-b-20">Listagem de todos os contratos cadastrados no sistema | Total: <?php echo $numbers ?></p>
				<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
					<thead>
					<tr>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" data-tablesaw-sortable-default-col>Id</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Nome</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Valor</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Tipo</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Vigência</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Garantia</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Público</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7">Data</th>
						<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" class="text-center fit" title="Editar"></th>
						<!--<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="9" class="text-center fit" title="Deletar">Del.</th>-->
					</tr>
					</thead>
					<tbody>

					<?php foreach ($result as $item): ?>
					<tr id="<?php echo $item['Agreement']['id'] ?>">
						<td><?php echo $item['Agreement']['id'] ?></td>
						<td><?php echo $item['Agreement']['name'] ?></td>
						<td><?php echo "R$ ". $this->Custom->numberFormatToBR($item['Agreement']['value']) ?></td>
						<td><?php echo $item['TypeAgreement']['name'] ?></td>
						<td><?php echo $this->Custom->formatDate($item['Agreement']['validity']) ?></td>
						<td><?php echo $item['Agreement']['guarantee'] ?></td>
						<td><?php echo ($item['Agreement']['is_public'] == 1 ? "Sim" : "Não") ?></td>
						<td><?php echo $this->Custom->formatDateWithHours($item['Agreement']['created']) ?></td>
						<td class="text-center fit"><a href="/contratos/editar/<?php echo $item['Agreement']['id'] ?>" title="Editar"><i class="fa fa-pencil-square-o text-info"></i></a></td>
						<!--<td class="text-center fit"><a href="#" onclick="confirmDeleteItem(<?php //echo $plan['Plan']['id'] ?>)" title="Deletar"><i class="fa fa-trash-o text-danger"></i></a></td>-->
					</tr>
					<?php endforeach; ?>
					<?php unset($result); ?>

					</tbody>
				</table>
			</div>
		</div>
 		*/?>

	</div>
</div>

<script>
	// onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()'
	function mascaraMutuario(o,f)
	{
		v_obj=o
		v_fun=f
		setTimeout('execmascara()',1)
	}

	function execmascara()
	{
		v_obj.value=v_fun(v_obj.value)
	}

	function cpfCnpj(v)
	{
		//Remove tudo o que não é dígito
		v=v.replace(/\D/g,"")

		if (v.length <= 14) { //CPF

			//Coloca um ponto entre o terceiro e o quarto dígitos
			v=v.replace(/(\d{3})(\d)/,"$1.$2")

			//Coloca um ponto entre o terceiro e o quarto dígitos
			//de novo (para o segundo bloco de números)
			v=v.replace(/(\d{3})(\d)/,"$1.$2")

			//Coloca um hífen entre o terceiro e o quarto dígitos
			v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

		} else { //CNPJ

			//Coloca ponto entre o segundo e o terceiro dígitos
			v=v.replace(/^(\d{2})(\d)/,"$1.$2")

			//Coloca ponto entre o quinto e o sexto dígitos
			v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

			//Coloca uma barra entre o oitavo e o nono dígitos
			v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

			//Coloca um hífen depois do bloco de quatro dígitos
			v=v.replace(/(\d{4})(\d)/,"$1-$2")

		}
		return v
	}
</script>

<?php // echo $this->element('sql_dump'); ?>
<?php // echo Configure::version() ?>