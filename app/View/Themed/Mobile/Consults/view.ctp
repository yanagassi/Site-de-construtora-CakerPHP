<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Profile page</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="https://themeforest.net/item/elite-admin-responsive-dashboard-web-app-kit-/16750820" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
			<ol class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Sample Pages</a></li>
				<li class="active">Profile page</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="tab active"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Post</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong> <br>
								<p class="text-muted"><?php echo h($post['Post']['title']); ?></p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong> <br>
								<p class="text-muted">(123) 456 7890</p>
							</div>
							<div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong> <br>
								<p class="text-muted">johnathan@admin.com</p>
							</div>
							<div class="col-md-3 col-xs-6"> <strong>Created</strong> <br>
								<p class="text-muted"><?php echo $this->Custom->formatDateWithHours($post['Post']['created']); ?></p>
							</div>
						</div>
						<hr>
						<?php echo $post['Post']['body']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="javascript:history.back(-1);" class="fcbtn btn btn-info btn-outline btn-1c">Voltar</a>
</div>