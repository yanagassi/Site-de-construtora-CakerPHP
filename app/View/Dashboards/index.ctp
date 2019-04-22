<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Painel de Controle</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <?php echo $this->Html->link('Novo Anúncio', "/painel/anuncios/novo/", array('class' => 'btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light')); ?>
                <ol class="breadcrumb">
                    <li><a href="#">Painel de Controle</a></li>
                    <li class="active">Início</li>
                </ol>
            </div>
        </div>



        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <h4>Informações sobre seus anúncios no mês corrente <a class="get-code" style="background:transparent" href="/painel/relatorios"><i class="icon-plus" title="Ver relatório completo"></i></a></h4>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">ANÚNCIOS ATIVOS</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-menu text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo $adv_number ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">VISUALIZAÇÕES</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-eye text-info"></i></li>
                                <li class="text-right"><span class="counter"><?php echo $adv_views ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">VISITAS NA PÁGINA</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-mouse text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo $adv_clicks ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">AVALIAÇÕES</h3>
                            <ul class="list-inline two-part">
                                <li><i class="icon-badge text-success"></i></li>
                                <li class="text-right"><span class="counter"><?php echo $adv_rates ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <h4>Soluções de Marketing Construlista <a class="get-code" style="background:transparent" href="#"><i class="icon-plus" title="Saiba mais"></i></a></h4>
                <div class="news-slide m-b-15">
                    <div class="vcarousel slide">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="overlaybg"><img src="/plugins/images/assets/sms_mkt.jpg"></div>
                                <div class="news-content"><span class="label label-primary label-rounded">Marketing via SMS</span>
                                    <h2>Nosso marketing via SMS é usado para comunicar ofertas, atualizar o cliente ou alertá-lo de algo que seja do seu interesse.</h2>
                                    <a href="#">Saiba Mais</a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="overlaybg"><img src="/plugins/images/assets/email_mkt.jpg"></div>
                                <div class="news-content"><span class="label label-success label-rounded">E-mail Marketing</span>
                                    <h2>O e-mail marketing da Construlista é uma ferramenta de marketing direto com análises gráficas gerando campanhas cada vez mais otimizadas.</h2>
                                    <a href="#">Saiba Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('.vcarousel').carousel({
                            interval: 6000
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="row row-in">
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <i class="icon-call-in text-primary"></i>
                                    <h5 class="text-muted vb">CLICK(S) NO(S) TELEFONE(S)</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php echo $adv_phone_clicks ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <i class="icon-envelope-open text-primary"></i>
                                    <h5 class="text-muted vb">CLICK(S) NO(S) EMAIL(S)&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php echo $adv_email_clicks ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 row-in-br">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <i class="fa fa-product-hunt text-primary" aria-hidden="true"></i>
                                    <h5 class="text-muted vb">QTDE DE BUSCAS NOS PRODUTOS</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php echo $adv_product_views ?></h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6  b-0">
                            <div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <i class="icon-wrench text-primary" aria-hidden="true"></i>
                                    <h5 class="text-muted vb">QTDE DE BUSCAS NOS SERVIÇOS</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-primary"><?php echo $adv_service_views ?> </h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"><span class="sr-only">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--row -->

        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="white-box text-center bg-purple">
                    <h1 class="text-white counter"><?php echo $adv_product_total ?></h1>
                    <p class="text-white">Produtos Disponíveis na Plataforma</p>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="white-box text-center bg-info">
                    <h1 class="text-white counter"><?php echo $adv_service_total ?></h1>
                    <p class="text-white">Serviços Disponíveis na Plataforma</p>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="white-box text-center">
                    <h1 class="counter"><?php echo $adv_rating_total ?></h1>
                    <p class="text-muted">Avaliações Realizadas na Plataforma</p>
                </div>
            </div>
        </div>

        <?php /* ?>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Yearly Sales</h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>iPhone</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>iPad</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>iPod</h5>
                        </li>
                    </ul>
                    <div id="morris-area-chart" style="height: 340px;"></div>
                </div>
            </div>
            <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                <div class="bg-theme-dark m-b-15">
                    <div class="row weather p-20">
                        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                            <h3>&nbsp;</h3>
                            <h1>73<sup>°F</sup></h1>
                            <p class="text-white">AHMEDABAD, INDIA</p>
                        </div>
                        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-day-cloudy-high"></i><br/>
                            <br/>
                            <b class="text-white">SUNNEY DAY</b>
                            <p class="w-title-sub">April 14</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                <div class="bg-theme m-b-15">
                    <div id="myCarouse2" class="carousel vcarousel slide p-20">
                        <!-- Carousel items -->
                        <div class="carousel-inner ">
                            <div class="active item">
                                <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                                <div class="twi-user"><img src="/plugins/images/users/hritik.jpg" alt="user" class="img-circle img-responsive pull-left">
                                    <h4 class="text-white m-b-0">Govinda</h4>
                                    <p class="text-white">Actor</p>
                                </div>
                            </div>
                            <div class="item">
                                <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                                <div class="twi-user"><img src="/plugins/images/users/genu.jpg" alt="user" class="img-circle img-responsive pull-left">
                                    <h4 class="text-white m-b-0">Govinda</h4>
                                    <p class="text-white">Actor</p>
                                </div>
                            </div>
                            <div class="item">
                                <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                                <div class="twi-user"><img src="/plugins/images/users/ritesh.jpg" alt="user" class="img-circle img-responsive pull-left">
                                    <h4 class="text-white m-b-0">Govinda</h4>
                                    <p class="text-white">Actor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--row -->
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Recent Comments</h3>
                    <div class="comment-center">
                        <div class="comment-body">
                            <div class="user-img"> <img src="/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rounded label-info">PENDING</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span></div>
                        </div>
                        <div class="comment-body">
                            <div class="user-img"> <img src="/plugins/images/users/sonu.jpg" alt="user" class="img-circle"> </div>
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5>
                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span><span class="label label-rounded label-success">APPROVED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span></div>
                        </div>
                        <div class="comment-body">
                            <div class="user-img"> <img src="/plugins/images/users/arijit.jpg" alt="user" class="img-circle"> </div>
                            <div class="mail-contnet">
                                <h5>Arijit Sinh</h5>
                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. </span><span class="label label-rounded label-danger">REJECTED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span></div>
                        </div>
                        <div class="comment-body b-none">
                            <div class="user-img"> <img src="/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rounded label-info">PENDING</span> <a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2016</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Recent sales
                        <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                            <select class="form-control pull-right row b-none">
                                <option>March 2016</option>
                                <option>April 2016</option>
                                <option>May 2016</option>
                                <option>June 2016</option>
                                <option>July 2016</option>
                            </select>
                        </div>
                    </h3>
                    <div class="row sales-report">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h2>March 2016</h2>
                            <p>SALES REPORT</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 ">
                            <h1 class="text-right text-success m-t-20">$3,690</h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                            <tr>

                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>PRICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="txt-oflo">Admin</td>
                                <td><span class="label label-megna label-rounded">SALE</span> </td>
                                <td class="txt-oflo">April 18</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Real Homes</td>
                                <td><span class="label label-info label-rounded">EXTENDED</span></td>
                                <td class="txt-oflo">April 19</td>
                                <td><span class="text-info">$1250</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Medical Pro</td>
                                <td><span class="label label-danger label-rounded">TAX</span></td>
                                <td class="txt-oflo">April 20</td>
                                <td><span class="text-danger">-$24</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Hosting press</td>
                                <td><span class="label label-megna label-rounded">SALE</span></td>
                                <td class="txt-oflo">April 21</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Helping Hands</td>
                                <td><span class="label label-success label-rounded">MEMBER</span></td>
                                <td class="txt-oflo">April 22</td>
                                <td><span class="text-success">$24</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Digital Agency</td>
                                <td><span class="label label-megna label-rounded">SALE</span> </td>
                                <td class="txt-oflo">April 23</td>
                                <td><span class="text-danger">-$14</span></td>
                            </tr>
                            <tr>

                                <td class="txt-oflo">Helping Hands</td>
                                <td><span class="label label-success label-rounded">MEMBER</span></td>
                                <td class="txt-oflo">April 22</td>
                                <td><span class="text-success">$64</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="#">Check all the sales</a> </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!--row -->
        <div class="row">
            <div class="col-md-8 col-lg-9 col-sm-12 col-xs-12 pull-right">
                <div class="white-box">
                    <h3 class="box-title">Sales Difference</h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Site A View</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Site B View</h5>
                        </li>
                    </ul>
                    <div id="morris-area-chart2" style="height: 370px;"></div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box m-b-15">
                    <h3 class="box-title">Sales Difference</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
                            <h1 class="text-info">$647</h1>
                            <p class="text-muted">APRIL 2016</p>
                            <b>(150 Sales)</b> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div id="sparkline2dash" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box bg-purple m-b-15">
                    <h3 class="text-white box-title">VISIT STATASTICS</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
                            <h1 class="text-white">$347</h1>
                            <p class="light_op_text">APRIL 2016</p>
                            <b class="text-white">(150 Sales)</b> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div id="sales1" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">To Do List</h3>
                    <ul class="list-task list-group" data-role="tasklist">
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">
                                <label for="inputSchedule"> <span>Schedule meeting</span> </label>
                            </div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                                <label for="inputCall"> <span>Give Purchase report</span> <span class="label label-danger">Today</span> </label>
                            </div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputBook" name="inputCheckboxesBook">
                                <label for="inputBook"> <span>Book flight for holiday</span> </label>
                            </div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputForward" name="inputCheckboxesForward">
                                <label for="inputForward"> <span>Forward all tasks</span> <span class="label label-warning">2 weeks</span> </label>
                            </div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                                <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                            </div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="checkbox checkbox-info">
                                <input type="checkbox" id="inputForward2" name="inputCheckboxesd">
                                <label for="inputForward2"> <span>Important tasks</span> <span class="label label-success">2 weeks</span> </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">You have 5 new messages</h3>
                    <div class="message-center"> <a href="#">
                            <div class="user-img"> <img src="/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                        </a> <a href="#">
                            <div class="user-img"> <img src="/plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5>
                                <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                        </a> <a href="#">
                            <div class="user-img"> <img src="/plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Arijit Sinh</h5>
                                <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                        </a> <a href="#">
                            <div class="user-img"> <img src="/plugins/images/users/genu.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Genelia Deshmukh</h5>
                                <span class="mail-desc">I love to do acting and dancing</span> <span class="time">9:08 AM</span> </div>
                        </a> <a href="#" class="b-none">
                            <div class="user-img"> <img src="/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                        </a> </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Chat</h3>
                    <div class="chat-box">
                        <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">
                            <li>
                                <div class="chat-image"> <img alt="male" src="/plugins/images/users/sonu.jpg"> </div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <h4>Sonu Nigam</h4>
                                        <p> Hi, All! </p>
                                        <b>10.00 am</b> </div>
                                </div>
                            </li>
                            <li class="odd">
                                <div class="chat-image"> <img alt="Female" src="/plugins/images/users/genu.jpg"> </div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <h4>Genelia</h4>
                                        <p> Hi, How are you Sonu? ur next concert? </p>
                                        <b>10.03 am</b> </div>
                                </div>
                            </li>
                            <li>
                                <div class="chat-image"> <img alt="male" src="/plugins/images/users/ritesh.jpg"> </div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <h4>Ritesh</h4>
                                        <p> Hi, Sonu and Genelia, </p>
                                        <b>10.05 am</b> </div>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Say something">
                    <span class="input-group-btn">
                    <button class="btn btn-success" type="button">Send</button>
                    </span> </div>
                            </div>
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
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/genu.jpg" alt="user-img"  class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/ritesh.jpg" alt="user-img"  class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a></li>
                        <li><a href="javascript:void(0)"><img src="/plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.right-sidebar -->
        <?php */ ?>

    </div>
    <!-- /.container-fluid -->
    <?php echo $this->element('footer'); ?>
</div>