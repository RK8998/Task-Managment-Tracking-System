
@extends('layouts_of_employee.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::get('employee_login_session')[0]->role == 1)
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data['total_project']}}</h3>

                <p>Total Project</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-folder"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data['total_project_complete']}}</h3>

                <p>Complete Project</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-checkmark"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data['total_project_pending']}}</h3>

                <p>Pending Project</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-information"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data['total_team']}}</h3>

                <p>Total Teams</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      @elseif(Session::get('employee_login_session')[0]->role == 3)
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data['total_task']}}</h3>

                <p>Total Task</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-folder"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data['total_task_complete']}}</h3>

                <p>Complete Task</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-checkmark"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data['total_task_pending']}}</h3>

                <p>Pending Task</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-information"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data['total_member']}}</h3>

                <p>My Teams</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      @endif 



        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            @if(Session::get('employee_login_session')[0]->role == 1)
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Recent Projects
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  @foreach($data['projects'] as $pro)
                     <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>

                      <!-- todo text -->
                      <span class="text">{{$pro->pname}}</span>
                      
                      <!-- Emphasis label -->
                      @foreach($data['project_assign'] as $assign)
                        @if($assign->pid == $pro->pid)
                          <small class="badge badge-secondary">
                          <i class="far fa-clock"></i>
                          {{ date_diff(new \DateTime($assign->edate), new \DateTime($assign->sdate))->format("%m Months, %d days"); }}
                          </small>
                        @endif
                      @endforeach
                      @if($pro->status == 1)
                        <span class="bg-danger" 
                        style="padding: 5px; font-size: 12px;border-radius: 8px;">
                          <b>Not Assign</b></span>
                      @elseif($pro->status == 2)
                        <span class="bg-warning"
                          style="padding: 5px; font-size: 12px;border-radius: 8px;">
                          <b>Assign</b></span>
                      @elseif($pro->status == 3)
                        <span class="bg-success"
                          style="padding: 5px; font-size: 12px;border-radius: 8px;">
                          <b>Complete</b></span>
                      @endif
                      
                      <div class="tools">
                        <a href="{{url('projects_view_detail',[$pro->pid]) }}">
                            <i class="fas fa-eye"></i></a>

                        <a href="{{url('edit_project_status',[$pro->pid]) }}">
                            <i class="fas fa-edit"></i></a>
                        
                        <a href="{{url('create_task',[$pro->pid]) }}">
                            <i class="fas fa-plus-circle"></i></a>

                        <a href="{{url('create_issue_project',[$pro->pid]) }}">
                            <i class="fas fa-exclamation-triangle"></i></a>
                      </div>
                    </li>
                  @endforeach
                 
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a type="button" href="{{url('taskmanager_projects')}}" class="btn btn-primary float-right"><i class="fas fa-eye"></i> View Projects</a>
              </div>
            </div>
            <!-- /.card -->


            @elseif(Session::get('employee_login_session')[0]->role == 3) 


            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Recent Task
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  @foreach($data['tasks'] as $task)
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    
                    <!-- todo text -->
                    <span class="text">{{$task->tname}}</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-secondary"><i class="far fa-clock"></i>
                      {{ date_diff(new \DateTime($task->edate), new \DateTime($task->sdate))->format("%d days"); }}
                    </small>
                    @if($task->status == 1)
                      <span class="bg-danger" 
                      style="padding: 5px; font-size: 12px;border-radius: 8px;">
                        <b>To Do</b></span>
                    @elseif($task->status == 2)
                      <span class="bg-info"
                        style="padding: 5px; font-size: 12px;border-radius: 8px;">
                        <b>Start</b></span>
                    @elseif($task->status == 3)
                      <span class="bg-warning"
                        style="padding: 5px; font-size: 12px;border-radius: 8px;">
                        <b>Stop</b></span>
                    @elseif($task->status == 4)
                      <span class="bg-success"
                        style="padding: 5px; font-size: 12px;border-radius: 8px;">
                        <b>Complete</b></span>
                    @endif
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{ url('member_task_view',[$task->tid]) }}"><i class="fas fa-eye"></i></a>
                      <a href="{{ url('edit_task_status',[$task->tid]) }}"><i class="fas fa-edit"></i></a>
                      <a href="{{ url('create_issue_task',[$task->tid]) }}">
                        <i class="fas fa-exclamation-triangle"></i></a>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a type="button" href="{{url('member_task')}}" class="btn btn-primary float-right">
                  <i class="fas fa-eye">&nbsp;&nbsp;
                </i>View Task</a>
              </div>
            </div>
            <!-- /.card -->
            @endif

            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->


            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @endsection