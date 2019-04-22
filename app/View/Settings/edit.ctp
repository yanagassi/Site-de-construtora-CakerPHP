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
	<!-- /.row -->
	<!-- .row -->
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg"> <img width="100%" alt="user" src="../plugins/images/large/img1.jpg">
					<div class="overlay-box">
						<div class="user-content"> <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" class="thumb-lg img-circle" alt="img"></a>
							<h4 class="text-white">User Name</h4>
							<h5 class="text-white">info@myadmin.com</h5>
						</div>
					</div>
				</div>
				<div class="user-btm-box">
					<div class="col-md-4 col-sm-4 text-center">
						<p class="text-purple"><i class="ti-facebook"></i></p>
						<h1>258</h1>
					</div>
					<div class="col-md-4 col-sm-4 text-center">
						<p class="text-blue"><i class="ti-twitter"></i></p>
						<h1>125</h1>
					</div>
					<div class="col-md-4 col-sm-4 text-center">
						<p class="text-danger"><i class="ti-dribbble"></i></p>
						<h1>556</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="white-box">
				<ul class="nav nav-tabs tabs customtab">
					<li class="active tab"><a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Perfil</span></a></li>
					<li class="tab"><a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Configurações</span> </a> </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<div class="row">
							<div class="col-md-3 col-xs-6 b-r"><strong>Nome</strong><br><p class="text-muted"><?php echo (!empty($setting["User"]["first_name"]) ? $setting["User"]["first_name"] : ""); echo (!empty($setting["User"]["last_name"]) ? " ".$setting["User"]["last_name"] : "" ); ?></p></div>
							<div class="col-md-3 col-xs-6 b-r"><strong>Mobile</strong><br><p class="text-muted">(123) 456 7890</p></div>
							<div class="col-md-3 col-xs-6 b-r"><strong>Email</strong><br><p class="text-muted">johnathan@admin.com</p></div>
							<div class="col-md-3 col-xs-6"> <strong>Location</strong><br><p class="text-muted">London</p></div>
						</div>

						<hr>

						<p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
						<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

						<h4 class="font-bold m-t-30">Skill Set</h4>
						<hr>
						<h5>Wordpress <span class="pull-right">80%</span></h5>
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
						</div>
						<h5>HTML 5 <span class="pull-right">90%</span></h5>
						<div class="progress">
							<div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
						</div>
						<h5>jQuery <span class="pull-right">50%</span></h5>
						<div class="progress">
							<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
						</div>
						<h5>Photoshop <span class="pull-right">70%</span></h5>
						<div class="progress">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
						</div>
					</div>
					<div class="tab-pane" id="settings">
						<form class="form-horizontal form-material" method="post" action="/configuracoes">
							<input type="hidden" name="data[User][id]" value="<?php echo (!empty($setting["User"]["id"]) ? $setting["User"]["id"] : 0); ?>">
							<input type="hidden" name="data[Setting][id]" value="<?php echo (!empty($setting["Setting"]["id"]) ? $setting["Setting"]["id"] : 0); ?>">
							<div class="form-group">
								<label class="col-md-12">Nome</label>
								<div class="col-md-12">
									<input type="text" name="data[User][first_name]" placeholder="Nome" class="form-control form-control-line" value="<?php echo (!empty($setting["User"]["first_name"]) ? $setting["User"]["first_name"] : ""); ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Sobrenome</label>
								<div class="col-md-12">
									<input type="text" name="data[User][last_name]" placeholder="Nome" class="form-control form-control-line" value="<?php echo (!empty($setting["User"]["last_name"]) ? $setting["User"]["last_name"] : ""); ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-12">Marca</label>
								<div class="col-md-12">
									<input type="text" name="data[Setting][brand_name]" placeholder="Nome" class="form-control form-control-line" value="<?php echo (!empty($setting["Setting"]["brand_name"]) ? $setting["Setting"]["brand_name"] : ""); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="example-email" class="col-md-12">Email</label>
								<div class="col-md-12">
									<input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Password</label>
								<div class="col-md-12">
									<input type="password" value="password" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Phone No</label>
								<div class="col-md-12">
									<input type="text" placeholder="123 456 7890" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-12">Message</label>
								<div class="col-md-12">
									<textarea rows="5" class="form-control form-control-line"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-12">Select Country</label>
								<div class="col-sm-12">
									<select class="form-control form-control-line">
										<option>London</option>
										<option>India</option>
										<option>Usa</option>
										<option>Canada</option>
										<option>Thailand</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success">Update Profile</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- .right-sidebar -->
	<div class="right-sidebar">
		<div class="slimscrollright">
			<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
			<div class="r-panel-body">
				<ul>
					<li><b>Layout Options</b></li>
					<li>
						<div class="checkbox checkbox-info">
							<input id="checkbox1" type="checkbox" class="fxhdr">
							<label for="checkbox1"> Fix Header </label>
						</div>
					</li>

				</ul>
				<ul id="themecolors" class="m-t-20">
					<li><b>With Light sidebar</b></li>
					<li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
					<li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
					<li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
					<li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
					<li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
					<li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
					<li><b>With Dark sidebar</b></li>
					<br/>
					<li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
					<li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
					<li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>

					<li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
					<li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
					<li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
				</ul>
				<ul class="m-t-20 chatonline">
					<li><b>Chat option</b></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img"  class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img"  class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a></li>
					<li><a href="javascript:void(0)"><img src="../plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.right-sidebar -->
</div>

