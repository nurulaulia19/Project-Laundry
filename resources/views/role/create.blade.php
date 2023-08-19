

{{-- bener --}}

@extends('layoutsAdmin.main')
@section('content')
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
		@if (session('activated'))
                        <div class="alert alert-success" role="alert">
                            {{ session('activated') }}
                        </div>
                    @endif
        <div class="boxed">
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">         
					<div class="pad-all text-center">
						<h3>Welcome back to the Dashboard</h3>
						<p>This is your experience to manage the Laundry Application</p>
					</div>
                </div>  
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    {{-- <div class="row" style="background-color:red">
					        <div class="col-lg-7">
					
					            <!--Network Line Chart-->
					            <!--===================================================-->
					            <div id="demo-panel-network" class="panel">
					                <div class="panel-heading">
					                    <div class="panel-control">
					                        <button id="demo-panel-network-refresh" class="btn btn-default btn-active-primary" data-toggle="panel-overlay" data-target="#demo-panel-network"><i class="demo-psi-repeat-2"></i></button>
					                        <div class="dropdown">
					                            <button class="dropdown-toggle btn btn-default btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
					                            <ul class="dropdown-menu dropdown-menu-right">
					                                <li><a href="#">Action</a></li>
					                                <li><a href="#">Another action</a></li>
					                                <li><a href="#">Something else here</a></li>
					                                <li class="divider"></li>
					                                <li><a href="#">Separated link</a></li>
					                            </ul>
					                        </div>
					                    </div>
					                    <h3 class="panel-title">Network</h3>
					                </div>
					
					
					                <!--chart placeholder-->
					                <div class="pad-all">
					                    <div id="demo-chart-network" style="height: 255px"></div>
					                </div>
					
					
					                <!--Chart information-->
					                <div class="panel-body">
					
					                    <div class="row">
					                        <div class="col-lg-8">
					                            <p class="text-semibold text-uppercase text-main">CPU Temperature</p>
					                            <div class="row">
					                                <div class="col-xs-5">
					                                    <div class="media">
					                                        <div class="media-left">
					                                            <span class="text-3x text-thin text-main">43.7</span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">°C</p>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="col-xs-7 text-sm">
					                                    <p>
					                                        <span>Min Values</span>
					                                        <span class="pad-lft text-semibold">
					                                        <span class="text-lg">27°</span>
					                                        <span class="labellabel-success mar-lft">
					                                            <i class="pci-caret-down text-success"></i>
					                                            <smal>- 20</smal>
					                                        </span>
					                                        </span>
					                                    </p>
					                                    <p>
					                                        <span>Max Values</span>
					                                        <span class="pad-lft text-semibold">
					                                        <span class="text-lg">69°</span>
					                                        <span class="labellabel-danger mar-lft">
					                                            <i class="pci-caret-up text-danger"></i>
					                                            <smal>+ 57</smal>
					                                        </span>
					                                        </span>
					                                    </p>
					                                </div>
					                            </div>
					
					                            <hr>
					
					                            <div class="pad-rgt">
					                                <p class="text-semibold text-uppercase text-main">Today Tips</p>
					                                <p class="text-muted mar-top">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
					                            </div>
					                        </div>
					
					                        <div class="col-lg-4">
					                            <p class="text-uppercase text-semibold text-main">Bandwidth Usage</p>
					                            <ul class="list-unstyled">
					                                <li>
					                                    <div class="media pad-btm">
					                                        <div class="media-left">
					                                            <span class="text-2x text-thin text-main">754.9</span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">Mbps</p>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li class="pad-btm">
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Income</p>
					                                        <p class="pull-right mar-no">70%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-info" style="width: 70%;">
					                                            <span class="sr-only">70% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Outcome</p>
					                                        <p class="pull-right mar-no">10%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-primary" style="width: 10%;">
					                                            <span class="sr-only">10% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                            </ul>
					                        </div>
					                    </div>
					                </div>
					
					
					            </div>
					            <!--===================================================-->
					            <!--End network line chart-->
					
					        </div>
					        <div class="col-lg-5">
					            <div class="row">
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline Area Chart-->
					                    <div class="panel panel-success panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> HDD Usage</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">132Gb</span> Free Space
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">1,45Gb</span> Used space
					                            </p>
					                        </div>
					                        <div class="pad-top text-center">
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-area" class="sparklines-full-content"></div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline Line Chart-->
					                    <div class="panel panel-info panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold">Earning</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">$764</span> Today
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">$1,332</span> Last 7 Day
					                            </p>
					                        </div>
					                        <div class="pad-top text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-line" class="sparklines-full-content"></div>
					
					                        </div>
					                    </div>
					                </div>
					            </div>
					            <div class="row">
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline bar chart -->
					                    <div class="panel panel-purple panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-basket-coins icon-fw"></i> Sales</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">$764</span> Today
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">$1,332</span> Last 7 Day
					                            </p>
					                        </div>
					                        <div class="text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-bar" class="box-inline"></div>
					
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					
					                    <!--Sparkline pie chart -->
					                    <div class="panel panel-warning panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold">Task Progress</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">34</span> Completed
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold">79</span> Total
					                            </p>
					                        </div>
					                        <div class="pad-all">
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 45%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">45%</span>
					                                    </div>
					                                </div>
					                            </div>
					                            <div class="pad-btm">
					                                <div class="progress progress-sm">
					                                    <div style="width: 89%;" class="progress-bar progress-bar-light">
					                                        <span class="sr-only">89%</span>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
					
					
					            <!--Extra Small Weather Widget-->
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            <div class="panel">
					                <div class="panel-body text-center clearfix">
					                    <div class="col-sm-4 pad-top">
					                        <div class="text-lg">
					                            <p class="text-5x text-thin text-main">95</p>
					                        </div>
					                        <p class="text-sm text-bold text-uppercase">New Friends</p>
					                    </div>
					                    <div class="col-sm-8">
					                        <button class="btn btn-pink mar-ver">View Details</button>
					                        <p class="text-xs">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
					                        <ul class="list-unstyled text-center bord-top pad-top mar-no row">
					                            <li class="col-xs-4">
					                                <span class="text-lg text-semibold text-main">1,345</span>
					                                <p class="text-sm text-muted mar-no">Following</p>
					                            </li>
					                            <li class="col-xs-4">
					                                <span class="text-lg text-semibold text-main">23K</span>
					                                <p class="text-sm text-muted mar-no">Followers</p>
					                            </li>
					                            <li class="col-xs-4">
					                                <span class="text-lg text-semibold text-main">278</span>
					                                <p class="text-sm text-muted mar-no">Post</p>
					                            </li>
					                        </ul>
					                    </div>
					                </div>
					            </div>
					
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            <!--End Extra Small Weather Widget-->
					
					
					        </div>
					    </div>
					
					    <div class="row">
					        <div class="col-md-3">
					            <div class="panel panel-warning panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-file-word icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold">241</p>
					                    <p class="mar-no">Documents</p>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-3">
					            <div class="panel panel-info panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-file-zip icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold">241</p>
					                    <p class="mar-no">Zip Files</p>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-3">
					            <div class="panel panel-mint panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-camera-2 icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold">241</p>
					                    <p class="mar-no">Photos</p>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-3">
					            <div class="panel panel-danger panel-colorful media middle pad-all">
					                <div class="media-left">
					                    <div class="pad-hor">
					                        <i class="demo-pli-video icon-3x"></i>
					                    </div>
					                </div>
					                <div class="media-body">
					                    <p class="text-2x mar-no text-semibold">241</p>
					                    <p class="mar-no">Videos</p>
					                </div>
					            </div>
					        </div>
					
					    </div>
					
					    <div class="row">
					        <div class="col-sm-6 col-lg-4">
					            <!--List Todo-->
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            <div class="panel panel-trans">
					                <div class="panel-heading">
					                    <h3 class="panel-title">To do list</h3>
					                </div>
					                <div class="pad-ver">
					                    <ul class="list-group bg-trans list-todo mar-no">
					                        <li class="list-group-item">
					                            <input id="demo-todolist-1" class="magic-checkbox" type="checkbox">
					                            <label for="demo-todolist-1"><span>Find an idea. <span class="label label-danger">Important</span></span></label>
					                        </li>
					                        <li class="list-group-item">
					                            <input id="demo-todolist-2" class="magic-checkbox" type="checkbox" checked>
					                            <label for="demo-todolist-2"><span>Do some work</span></label>
					                        </li>
					                        <li class="list-group-item">
					                            <input id="demo-todolist-3" class="magic-checkbox" type="checkbox">
					                            <label for="demo-todolist-3"><span>Read the book</span></label>
					                        </li>
					                        <li class="list-group-item">
					                            <input id="demo-todolist-4" class="magic-checkbox" type="checkbox">
					                            <label for="demo-todolist-4"><span>Upgrade server <span class="label label-warning">Warning</span></span></label>
					                        </li>
					                        <li class="list-group-item">
					                            <input id="demo-todolist-5" class="magic-checkbox" type="checkbox" checked>
					                            <label for="demo-todolist-5"><span>Redesign my logo <span class="label label-info">2 Mins</span></span></label>
					                        </li>
					                    </ul>
					                </div>
					                <div class="input-group pad-all">
					                    <input type="text" class="form-control" placeholder="New task" autocomplete="off">
					                    <span class="input-group-btn">
					                    <button type="button" class="btn btn-success"><i class="demo-pli-add"></i></button>
					                </span>
					                </div>
					            </div>
					            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					            <!--End todo list-->
					        </div>
					        <div class="col-sm-6 col-lg-4">
					            <div class="panel panel-trans">
					                <div class="panel-heading">
					                    <div class="panel-control">
					                        <a title="" data-html="true" data-container="body" data-original-title="&lt;p class='h4 text-semibold'&gt;Information&lt;/p&gt;&lt;p style='width:150px'&gt;This is an information bubble to help the user.&lt;/p&gt;" href="#" class="demo-psi-information icon-lg icon-fw unselectable text-info add-tooltip"></a>
					                    </div>
					                    <h3 class="panel-title">Services</h3>
					                </div>
					                <div class="bord-btm">
					                    <ul class="list-group bg-trans">
					                        <li class="list-group-item">
					                            <div class="pull-right">
					                                <input id="demo-online-status-checkbox" class="toggle-switch" type="checkbox" checked>
					                                <label for="demo-online-status-checkbox"></label>
					                            </div>
					                            Online status
					                        </li>
					                        <li class="list-group-item">
					                            <div class="pull-right">
					                                <input id="demo-show-off-contact-checkbox" class="toggle-switch" type="checkbox" checked>
					                                <label for="demo-show-off-contact-checkbox"></label>
					                            </div>
					                            Show offline contact
					                        </li>
					                        <li class="list-group-item">
					                            <div class="pull-right">
					                                <input id="demo-show-device-checkbox" class="toggle-switch" type="checkbox">
					                                <label for="demo-show-device-checkbox"></label>
					                            </div>
					                            Show my device icon
					                        </li>
					                    </ul>
					                </div>
					                <div class="panel-body">
					                    <div class="pad-btm">
					                        <p class="text-semibold text-main">Upgrade Progress</p>
					                        <div class="progress progress-md">
					                            <div class="progress-bar progress-bar-purple" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;" role="progressbar">
					                                <span class="sr-only">15%</span>
					                            </div>
					                        </div>
					                        <small>15% Completed</small>
					                    </div>
					                    <div>
					                        <p class="text-semibold text-main">Database</p>
					                        <div class="progress progress-md">
					                            <div class="progress-bar progress-bar-success" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;" role="progressbar">
					                                <span class="sr-only">70%</span>
					                            </div>
					                        </div>
					                        <small>70% Completed</small>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class='col-sm-12 col-lg-4'>
					            <div class="panel panel-trans">
					                <div class="pad-all">
					                    <div class="media mar-btm">
					                        <div class="media-left">
					                            <img src="{{ asset('assets/img/profile-photos/2.png') }}" class="img-md img-circle" alt="Avatar">
					                        </div>
					                        <div class="media-body">
					                            <p class="text-lg text-main text-semibold mar-no">Ralph West</p>
					                            <p>Project manager</p>
					                        </div>
					                    </div>
					                    <blockquote class="bq-sm bq-open bq-close">Lorem ipsum dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</blockquote>
					                </div>
					
					                <div class="bord-top">
					                    <ul class="list-group bg-trans bord-no">
					                        <li class="list-group-item list-item-sm">
					                            <div class="media-left">
					                                <i class="demo-psi-facebook icon-lg"></i>
					                            </div>
					                            <div class="media-body">
					                                <a href="#" class="btn-link text-semibold">Facebook</a>
					                            </div>
					                        </li>
					                        <li class="list-group-item list-item-sm">
					                            <div class="media-left">
					                                <i class="demo-psi-twitter icon-lg"></i>
					                            </div>
					                            <div class="media-body">
					                                <a href="#" class="btn-link text-semibold">@RalphWe</a>
					                                <br> Design my themes with <a href="#" class="btn-link text-bold">#Bootstrap</a> Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					                            </div>
					                        </li>
					                        <li class="list-group-item list-item-sm">
					                            <div class="media-left">
					                                <i class="demo-psi-instagram icon-lg"></i>
					                            </div>
					                            <div class="media-body">
					                                <a href="#" class="btn-link text-semibold">Ralphz</a>
					                            </div>
					                        </li>
					                        <li class="list-group-item list-item-sm">
					                            <div class="media-body">
					
					                            </div>
					                        </li>
					                    </ul>
					                </div>
					            </div>
					        </div>
					    </div> --}}
					
					    <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Tambah Role</h3>
                                </div>
                        
                                <!--Horizontal Form-->
                                <!--===================================================-->
                                <form method="POST" action="/role/store">
                                    {{ csrf_field() }}
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="role_name">Nama Role</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Nama Role" name="role_name" id="role_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            
                                            <label class="col-sm-3 control-label" for="menu_link">Menu</label>
                                            
                                            <div class="col-sm-9">
                                                <div class="checkbox-container" style=" display: flex;
                                                flex-direction: column;">
                                                    @foreach ($dataMenu as $item)
                                                    <div class="form-check">
                                                      <input class="form-check-input" name="menu_id[]" type="checkbox" value="{{ $item->menu_id }}">
                                                      <label class="form-check-label">{{ $item->menu_name }}</label>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                            </div>
                                           
                                        </div>
                                    <div class="panel-footer text-right">
                                        <a href="{{ route('role.index') }}" class="btn btn-secondary">KEMBALI</a>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </form>
                                <!--===================================================-->
                                <!--End Horizontal Form-->
                        
                            </div>
                        </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

			<!--ASIDE-->
            <!--===================================================-->
            <aside id="aside-container">
                <div id="aside">
                    <div class="nano">
                        <div class="nano-content">
                            
                            <!--Nav tabs-->
                            <!--================================-->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#demo-asd-tab-1" data-toggle="tab">
                                        <i class="demo-pli-speech-bubble-7 icon-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-2" data-toggle="tab">
                                        <i class="demo-pli-information icon-lg icon-fw"></i> Report
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-3" data-toggle="tab">
                                        <i class="demo-pli-wrench icon-lg icon-fw"></i> Settings
                                    </a>
                                </li>
                            </ul>
                            <!--================================-->
                            <!--End nav tabs-->



                            <!-- Tabs Content -->
                            <!--================================-->
                            <div class="tab-content">

                                <!--First tab (Contact list)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade in active" id="demo-asd-tab-1">
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">
                                        <span class="pull-right badge badge-warning">3</span> Family
                                    </p>

                                    <!--Family-->
                                    <div class="list-group bg-trans">
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/2.png') }}" alt="Profile Picture">
												<i class="badge badge-success badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Stephen Tran</p>
							                    <small class="text-muteds">Availabe</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/7.png') }}" alt="Profile Picture">
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Brittany Meyer</p>
							                    <small class="text-muteds">I think so</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture">
												<i class="badge badge-info badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Jack George</p>
							                    <small class="text-muteds">Last Seen 2 hours ago</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/4.png') }}" alt="Profile Picture">
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Donald Brown</p>
							                    <small class="text-muteds">Lorem ipsum dolor sit amet.</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/8.png') }}" alt="Profile Picture">
												<i class="badge badge-warning badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Betty Murphy</p>
							                    <small class="text-muteds">Idle</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/9.png') }}" alt="Profile Picture">
												<i class="badge badge-danger badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Samantha Reid</p>
							                    <small class="text-muteds">Offline</small>
							                </div>
							            </a>
                                    </div>

                                    <hr>
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">
                                        <span class="pull-right badge badge-success">Offline</span> Friends
                                    </p>

                                    <!--Works-->
                                    <div class="list-group bg-trans">
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-purple badge-icon badge-fw pull-left"></span> Joey K. Greyson
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-info badge-icon badge-fw pull-left"></span> Andrea Branden
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-success badge-icon badge-fw pull-left"></span> Johny Juan
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-danger badge-icon badge-fw pull-left"></span> Susan Sun
                                        </a>
                                    </div>


                                    <hr>
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">News</p>

                                    <div class="pad-hor">
                                        <p>Lorem ipsum dolor sit amet, consectetuer
                                            <a data-title="45%" class="add-tooltip text-semibold text-main" href="#">adipiscing elit</a>, sed diam nonummy nibh. Lorem ipsum dolor sit amet.
                                        </p>
                                        <small><em>Last Update : Des 12, 2014</em></small>
                                    </div>


                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End first tab (Contact list)-->


                                <!--Second tab (Custom layout)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade" id="demo-asd-tab-2">

                                    <!--Monthly billing-->
                                    <div class="pad-all">
                                        <p class="pad-ver text-main text-sm text-uppercase text-bold">Billing &amp; reports</p>
                                        <p>Get <strong class="text-main">$5.00</strong> off your next bill by making sure your full payment reaches us before August 5, 2018.</p>
                                    </div>
                                    <hr class="new-section-xs">
                                    <div class="pad-all">
                                        <span class="pad-ver text-main text-sm text-uppercase text-bold">Amount Due On</span>
                                        <p class="text-sm">August 17, 2018</p>
                                        <p class="text-2x text-thin text-main">$83.09</p>
                                        <button class="btn btn-block btn-success mar-top">Pay Now</button>
                                    </div>


                                    <hr>

                                    <p class="pad-all text-main text-sm text-uppercase text-bold">Additional Actions</p>

                                    <!--Simple Menu-->
                                    <div class="list-group bg-trans">
                                        <a href="#" class="list-group-item"><i class="demo-pli-information icon-lg icon-fw"></i> Service Information</a>
                                        <a href="#" class="list-group-item"><i class="demo-pli-mine icon-lg icon-fw"></i> Usage Profile</a>
                                        <a href="#" class="list-group-item"><span class="label label-info pull-right">New</span><i class="demo-pli-credit-card-2 icon-lg icon-fw"></i> Payment Options</a>
                                        <a href="#" class="list-group-item"><i class="demo-pli-support icon-lg icon-fw"></i> Message Center</a>
                                    </div>


                                    <hr>

                                    <div class="text-center">
                                        <div><i class="demo-pli-old-telephone icon-3x"></i></div>
                                        Questions?
                                        <p class="text-lg text-semibold text-main"> (415) 234-53454 </p>
                                        <small><em>We are here 24/7</em></small>
                                    </div>
                                </div>
                                <!--End second tab (Custom layout)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


                                <!--Third tab (Settings)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade" id="demo-asd-tab-3">
                                    <ul class="list-group bg-trans">
                                        <li class="pad-top list-header">
                                            <p class="text-main text-sm text-uppercase text-bold mar-no">Account Settings</p>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-1" type="checkbox" checked>
                                                <label for="demo-switch-1"></label>
                                            </div>
                                            <p class="mar-no text-main">Show my personal status</p>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-2" type="checkbox" checked>
                                                <label for="demo-switch-2"></label>
                                            </div>
                                            <p class="mar-no text-main">Show offline contact</p>
                                            <small class="text-muted">Aenean commodo ligula eget dolor. Aenean massa.</small>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-3" type="checkbox">
                                                <label for="demo-switch-3"></label>
                                            </div>
                                            <p class="mar-no text-main">Invisible mode </p>
                                            <small class="text-muted">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </small>
                                        </li>
                                    </ul>


                                    <hr>

                                    <ul class="list-group pad-btm bg-trans">
                                        <li class="list-header"><p class="text-main text-sm text-uppercase text-bold mar-no">Public Settings</p></li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-4" type="checkbox" checked>
                                                <label for="demo-switch-4"></label>
                                            </div>
                                            Online status
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-5" type="checkbox" checked>
                                                <label for="demo-switch-5"></label>
                                            </div>
                                            Show offline contact
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-6" type="checkbox" checked>
                                                <label for="demo-switch-6"></label>
                                            </div>
                                            Show my device icon
                                        </li>
                                    </ul>



                                    <hr>

                                    <p class="pad-hor text-main text-sm text-uppercase text-bold mar-no">Task Progress</p>
                                    <div class="pad-all">
                                        <p class="text-main">Upgrade Progress</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-success" style="width: 15%;"><span class="sr-only">15%</span></div>
                                        </div>
                                        <small>15% Completed</small>
                                    </div>
                                    <div class="pad-hor">
                                        <p class="text-main">Database</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-danger" style="width: 75%;"><span class="sr-only">75%</span></div>
                                        </div>
                                        <small>17/23 Database</small>
                                    </div>

                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--Third tab (Settings)-->

                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!--===================================================-->
            <!--END ASIDE-->
            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
@endsection

@section('style')
<style>
#hidden_div {
    display: none ;
}
</style>
@endsection

@section('script')
<script>
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 'sub menu' ? 'block' : 'none';
}
</script>

@endsection



