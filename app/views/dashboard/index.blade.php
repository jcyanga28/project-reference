@extends('layout.backend')

@section('content')


<div id="dashboard_container">
<!-- /.row -->

@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3) 

    <div id="dashboard_request_content" class="row">
    <br/>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($contact_result_ofrequest) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($contact_result_ofrequest) }}</div>
                            @endif
                            <div id="bdo_font_notif">CONTACT LIST</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('contact.notif', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($company_result_ofrequest) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($company_result_ofrequest) }}</div>
                            @endif
                            <div id="bdo_font_notif">COMPANY LIST</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('company.notif', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bar-chart fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($project_result_ofrequest) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($project_result_ofrequest) }}</div>
                            @endif
                            <div id="bdo_font_notif">PROJECT LIST</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('project.notif', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-inbox fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($assignedproject_result_ofrequest) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($assignedproject_result_ofrequest) }}</div>
                            @endif
                            <div id="bdo_font_notif1">ASSIGNED-PROJECT</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('project.list', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endif

@if(Session::get('role') == 1)
<hr/>
@endif

@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 4) 

    <div id="dashboard_request_content" class="row">
    <br/>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($request_contact) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($request_contact) }}</div>
                            @endif
                            <div id="bdo_font_notif">New Contact</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('contact.ra', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($request_company) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($request_company) }}</div>
                            @endif
                            <div id="bdo_font_notif">New Company</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('company.ra', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-area-chart fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($request_project) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($request_project) }}</div>
                            @endif
                            <div id="bdo_font_notif">New Project</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('project.ra', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div id="bdo_border_notif" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-inbox fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            @if(count($assignedproject_forcc_result_ofrequest) == 0)
                                <div class="huge">0</div>
                            @else
                                <div class="huge" id="count_request">{{ count($assignedproject_forcc_result_ofrequest) }}</div>
                            @endif
                            <div id="bdo_font_notif1">ASSIGNED-PROJECT</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">{{ HTML::linkRoute('project.list', 'View Details', array(), array('class' => 'submenu-font')) }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endif 


<br/><br/>
</div>


                <!--<div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>-->
            <!--</div>
            <!-- /.row -->

            <!--<div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <!--<div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    <!--</div>
                    <!-- /.panel -->
                    <!--<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <!--<div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>3326</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:29 PM</td>
                                                    <td>$321.33</td>
                                                </tr>
                                                <tr>
                                                    <td>3325</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:20 PM</td>
                                                    <td>$234.34</td>
                                                </tr>
                                                <tr>
                                                    <td>3324</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:03 PM</td>
                                                    <td>$724.17</td>
                                                </tr>
                                                <tr>
                                                    <td>3323</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:00 PM</td>
                                                    <td>$23.71</td>
                                                </tr>
                                                <tr>
                                                    <td>3322</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:49 PM</td>
                                                    <td>$8345.23</td>
                                                </tr>
                                                <tr>
                                                    <td>3321</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:23 PM</td>
                                                    <td>$245.12</td>
                                                </tr>
                                                <tr>
                                                    <td>3320</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:15 PM</td>
                                                    <td>$5663.54</td>
                                                </tr>
                                                <tr>
                                                    <td>3319</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:13 PM</td>
                                                    <td>$943.45</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                <!--</div>
                                <!-- /.col-lg-4 (nested) -->
                                <!--<div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            <!--</div>
                            <!-- /.row -->
                        <!--</div>
                        <!-- /.panel-body -->
                    <!--</div>
                    
                </div>
                <!-- /.col-lg-8 -->
                <!--<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <!--<div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <!--<a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    <!--</div>
                    <!-- /.panel -->
                    <!--<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">View Details</a>
                        </div>
                        <!-- /.panel-body -->
                    <!--</div>
                   
                </div>
                <!-- /.col-lg-4 -->
            <!--</div>
            <!-- /.row -->


@stop