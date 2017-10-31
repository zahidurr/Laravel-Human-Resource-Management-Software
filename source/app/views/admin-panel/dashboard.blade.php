<!-- Page title -->
@section('title')
    Dashboard
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')

    <div class="container-fluid">
        <div class="row-fluid">

            <!-- Left menu for admin panel. See left_menu layouts -->
            @include('layouts.left_menu')

            <div class="span9" id="content">
                <div class="row-fluid">

                    <!-- Display notification message here -->
                    @if(App::make('UtilController')->isTodayHoliday())
                    <div class="alert alert-info">
                        <h4><i class="fa fa-flag"></i> Today is holiday</h4>
                    </div>
                    @endif

                    <!-- Display success flash message here -->
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-info-circle"></i> {{ Session::get('success_message') }}</strong>

                    </div>
                    @endif

                    <!-- Display  error flash message here -->
                    @if(Session::has('error_message'))
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-info-circle"></i> {{ Session::get('error_message') }}</strong>
                    </div>
                    @endif
                </div>

                <div class="row-fluid">
                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box">
                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Today's Attendance Rate</div>
                                <div class="pull-right">
                                    <a class="label" href="#attendance-details">Details</a>
                                </div>
                            </div>

                            <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    <div id="attendance_rate_piechart" style="width:100%;height:200px" ></div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box">

                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Employee Distribution by Department</div>
                            </div>

                            <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    <div id="employee_distribution_piechart" style="width:100%;height:200px" ></div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box">

                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Today</div>
                                <div class="pull-right">
                                    <span id="refresh-weather-forecast" class="label label-inverse" style="cursor:pointer;"><i class="fa fa-refresh"></i></span>

                                    <a class="label" href="{{ URL::to('/admin-panel/settings') }}">Settings</a>
                                </div>
                            </div>

                             <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    <span id="weather-forecast">
                                        <div style="text-align: center !important; padding-top:30%">
                                            <i class="fa fa-spinner fa-pulse fa-3x"></i>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box">

                             <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Pending Leave Requests</div>
                                <div class="pull-right">

                                    <a class="label" href="{{ URL::to('/admin-panel/employee-leave-list') }}">Details</a>
                                </div>
                            </div>

                             <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    @if(count($leave_list) > 0)
                                      <table class="table table-bordered">
                                      <tbody>

                                          @foreach($leave_list as $key => $value)
                                            <tr>
                                              <td>{{ $value->type }}</td>
                                              <td class="vert-align">

                                                   <a href="{{ URL::to('/admin-panel/moderate-employee-leave/'.$value->id) }}" class="btn btn-primary btn-mini">
                                                       <i class="fa fa-check-square-o"></i> Review
                                                   </a>

                                              </td>
                                            </tr>
                                          @endforeach

                                      </tbody>
                                    </table>
                                    @else
                                        <span>No pending requests found</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box" >

                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Pending Equipment Requests</div>
                                <div class="pull-right">

                                    <a class="label" href="{{ URL::to('/admin-panel/employee-equipment-list') }}">Details</a>
                                </div>
                            </div>

                            <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    @if(count($equipment_list) > 0)
                                      <table class="table table-bordered">
                                      <tbody>

                                          @foreach($equipment_list as $key => $value)
                                            <tr>
                                              <td>{{ $value->name }}</td>
                                              <td class="vert-align">

                                                   <a href="{{ URL::to('/admin-panel/moderate-employee-equipment/'.$value->id) }}" class="btn btn-primary btn-mini">
                                                       <i class="fa fa-check-square-o"></i> Review
                                                   </a>

                                              </td>
                                            </tr>
                                          @endforeach

                                      </tbody>
                                    </table>
                                    @else
                                        <span>No pending requests found</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="span4">
                        <!-- block -->
                        <div class="block admin-dashboard-box">

                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Upcoming Scheduled Interviews</div>
                                <div class="pull-right">

                                    <a class="label" href="{{ URL::to('/admin-panel/interview-schedules') }}">Details</a>
                                </div>
                            </div>

                             <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12 admin-dashboard-box2">
                                    @if(count($upcoming_is_list) > 0)
                                      <table class="table table-bordered">
                                      <tbody>

                                          @foreach($upcoming_is_list as $key => $value)
                                            <tr>
                                              <td>{{ $value->title }}</td>
                                              <td class="vert-align">

                                                   <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id) }}" class="btn btn-primary btn-mini">
                                                       <i class="fa fa-eye"></i> View
                                                   </a>

                                              </td>
                                            </tr>
                                          @endforeach

                                      </tbody>
                                    </table>
                                    @else
                                        <span>No upcoming scheduled interviews found</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>

                <div class="row-fluid" id="attendance-details">
                     <!-- block -->

                    <div class="block" >

                         <!-- block header -->
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Today's Attendance Details</div>
                        </div>

                         <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- table -->
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                  <thead>
                                      <tr>
                                          <th>Employee Name</th>
                                          <th>Department</th>
                                          <th>Punch In</th>
                                          <th>Punch Out</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($emp_attendance as $key => $value)
                                      <tr class="gradeA">
                                          <td>
                                              <img src="{{ asset('/uploads/images/'.$value->profile_image) }}"  class="profile-image-small" />

                                              <a href="{{ URL::to('/admin-panel/employees/'. $value->id) }}">
                                              {{ $value->first_name }} {{ $value->last_name }}
                                              </a>
                                          </td>

                                          <td>
                                              {{ App::make('UtilController')->departmentName ($value->department_id) }}
                                          </td>

                                          <td>
                                              @if($value->in_time != '')
                                                {{ date("g:i A", strtotime($value->in_time)) }}
                                              @endif
                                          </td>
                                          <td>
                                              @if($value->out_time != '')
                                                {{ date("g:i A", strtotime($value->out_time)) }}
                                              @endif
                                          </td>
                                          <td>
                                              @if($value->in_time != '' && $value->in_time <= "$settings->office_hour_start:00")
                                                   <i class="fa fa-user-plus" style="color:green;"></i> Present
                                              @elseif($value->in_time > "$settings->office_hour_start:00")
                                                   <i class="fa fa-user" style="color:orange;"></i> Late
                                              @else
                                                   <i class="fa fa-user-times" style="color:red;"></i> Absent
                                              @endif
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.charts')

    <!-- javascripts for graph -->
    <script>
        $(function() {
            showPieChart('#attendance_rate_piechart', {{ $json_output_emp_attendance }});
            showPieChart('#employee_distribution_piechart', {{ $json_output_emp_departments }});

            //click to refresh showWeather
            $('#refresh-weather-forecast').click(function() {
                showWeather ();
            });

            //smooth scroll
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                  if (target.length) {
                    $('html,body').animate({
                      scrollTop: target.offset().top
                    }, 1000);
                    return false;
                  }
                }
            });

            //load weather-forecast when page loaded
            showWeather ();
        });


        //javascripts for weather-forecast
        function showWeather () {
            $("#weather-forecast").html('<div style="text-align: center !important; padding-top:30%"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>');
            $.ajax({
                type: "GET",
                url : "ajax/weather-forecast",
                processData: false,
                contentType: false,
                cache: false,
                success : function(data){
                    $("#weather-forecast").html(data);
                }

            },"json");
        }

    </script>
@stop
