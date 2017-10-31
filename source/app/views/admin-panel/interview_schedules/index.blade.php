<!-- Page title -->
@section('title')
    Interview Schedules
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

                <!-- Display flash message here -->
                <div class="row-fluid">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> {{ Session::get('success_message') }}
                    </div>
                    @endif
                    @if(Session::has('error_message'))
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-exclamation-triangle"></i> {{ Session::get('error_message') }}
                    </div>
                    @endif

                </div>

                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">

                            <!-- block header -->
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Interview Schedules</div>

                                <div class="pull-right"><a href="{{ URL::to('/admin-panel/interview-schedules/create') }}" >Create</a></div>
                            </div>

                            <!-- block content -->
                            <div class="block-content collapse in">
                                <div class="span12">

                                    <!-- tab button -->
                                    <ul class="nav nav-tabs" role="tablist" id="usersTab">
                                       <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Upcoming</a></li>

                                       <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Approved</a></li>

                                       <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Rejected</a></li>

                                       <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Inactive</a></li>
                                   </ul>

                                   <!-- tab content -->
                                 <div class="tab-content">
                                   <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                                       <table class="table table-bordered">
        						            <thead>
        						                <tr>

        						                  <th>Job Title</th>
        						                  <th>Applicant Name</th>
        						                  <th>Interview Date</th>
        						                  <th>Board Member(s)</th>
        						                  <th></th>
        						                </tr>
        						            </thead>
        						            <tbody>
                                                    @foreach($upcoming_list as $key => $value)
            						                <tr>


            						                  <td>
                                                          <a href="{{ URL::to('/admin-panel/jobs/'. $value->job_id) }}">
                                                              {{ $value->title }}
                                                          </a>
                                                      </td>


            						                  <td>
                                                          <a href="{{ URL::to('/admin-panel/applicants/'. $value->applicant_id) }}">
                                                              {{ $value->first_name }} {{ $value->last_name }}
                                                          </a>

                                                      </td>

                                                      <td>
                                                          {{ date("j M Y, h:i A", strtotime($value->interview_date)) }}
                                                      </td>

                                                      <td>
                                                          {{ App::make('UtilController')->boardMembersName ($value->id) }}
                                                      </td>

                                                      <td class="vert-align">

                                                          <a href="#" onClick="confirmAction('interview schedule', '/admin-panel/interview-schedules/{{ $value->id }}')" class="btn btn-danger btn-mini">
                                                              <i class="icon-trash icon-white"></i> Delete
                                                          </a>


                                                           <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id.'/edit') }}" class="btn btn-primary btn-mini">
                                                               <i class="icon-edit icon-white"></i> Edit
                                                           </a>

                                                           <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id) }}" class="btn btn-mini">
                                                               <i class="icon-eye-open"></i> Details
                                                           </a>

                                                           <a href="{{ URL::to('/admin-panel/interview-board/'.$value->id) }}" class="btn btn-mini">
                                                               <i class="fa fa-comments-o"></i> Start Interview
                                                           </a>
                                                      </td>
            						                </tr>
                                                    @endforeach
        						              </tbody>
        						            </table>
                                            </div>

                                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                                <table class="table table-bordered">
         						              <thead>
         						                <tr>

         						                  <th>Job Title</th>
         						                  <th>Applicant Name</th>
         						                  <th>Interview Date</th>
         						                  <th>Board Member(s)</th>
         						                  <th></th>
         						                </tr>
         						              </thead>
         						              <tbody>
                                                     @foreach($approved_list as $key => $value)
             						                <tr>

             						                  <td>
                                                           <a href="{{ URL::to('/admin-panel/jobs/'. $value->job_id) }}">
                                                               {{ $value->title }}
                                                           </a>
                                                       </td>


             						                  <td>
                                                           <a href="{{ URL::to('/admin-panel/applicants/'. $value->applicant_id) }}">
                                                               {{ $value->first_name }} {{ $value->last_name }}
                                                           </a>

                                                       </td>

                                                       <td>
                                                           {{ date("j M Y, h:i A", strtotime($value->interview_date)) }}
                                                       </td>

                                                       <td>
                                                           {{ App::make('UtilController')->boardMembersName ($value->id) }}
                                                       </td>

                                                       <td class="vert-align">
                                                            <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id) }}" class="btn btn-mini">
                                                                <i class="icon-eye-open"></i> Details
                                                            </a>
                                                       </td>
             						                </tr>
                                                     @endforeach
         						              </tbody>
         						            </table>
                                             </div>

                                             <div role="tabpanel" class="tab-pane fade" id="tab3">
                                                 <table class="table table-bordered">
                                                <thead>
                                                  <tr>

                                                    <th>Job Title</th>
                                                    <th>Applicant Name</th>
                                                    <th>Interview Date</th>
                                                    <th>Board Member(s)</th>
                                                    <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach($rejected_list as $key => $value)
                                                      <tr>

                                                        <td>
                                                            <a href="{{ URL::to('/admin-panel/jobs/'. $value->job_id) }}">
                                                                {{ $value->title }}
                                                            </a>
                                                        </td>


                                                        <td>
                                                            <a href="{{ URL::to('/admin-panel/applicants/'. $value->applicant_id) }}">
                                                                {{ $value->first_name }} {{ $value->last_name }}
                                                            </a>

                                                        </td>

                                                        <td>
                                                            {{ date("j M Y, h:i A", strtotime($value->interview_date)) }}
                                                        </td>

                                                        <td>
                                                            {{ App::make('UtilController')->boardMembersName ($value->id) }}
                                                        </td>

                                                        <td class="vert-align">
                                                             <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id) }}" class="btn btn-mini">
                                                                 <i class="icon-eye-open"></i> Details
                                                             </a>
                                                        </td>
                                                      </tr>
                                                      @endforeach
                                                </tbody>
                                              </table>
                                              </div>

                                              <div role="tabpanel" class="tab-pane fade" id="tab4">
                                                  <table class="table table-bordered">
           						              <thead>
           						                <tr>

           						                  <th>Job Title</th>
           						                  <th>Applicant Name</th>
           						                  <th>Interview Date</th>
           						                  <th>Board Member(s)</th>
           						                  <th></th>
           						                </tr>
           						              </thead>
           						              <tbody>
                                                       @foreach($inactive_list as $key => $value)
               						                <tr>

               						                  <td>
                                                             <a href="{{ URL::to('/admin-panel/jobs/'. $value->job_id) }}">
                                                                 {{ $value->title }}
                                                             </a>
                                                         </td>


               						                  <td>
                                                             <a href="{{ URL::to('/admin-panel/applicants/'. $value->applicant_id) }}">
                                                                 {{ $value->first_name }} {{ $value->last_name }}
                                                             </a>

                                                         </td>

                                                         <td>
                                                             {{ date("j M Y, h:i A", strtotime($value->interview_date)) }}
                                                         </td>

                                                         <td>
                                                             {{ App::make('UtilController')->boardMembersName ($value->id) }}
                                                         </td>

                                                         <td class="vert-align">

                                                             <a href="#" onClick="confirmAction('interview schedule', '/admin-panel/interview-schedules/{{ $value->id }}')" class="btn btn-danger btn-mini">
                                                                 <i class="icon-trash icon-white"></i> Delete
                                                             </a>


                                                              <a href="{{ URL::to('/admin-panel/interview-schedules/'.$value->id.'/edit') }}" class="btn btn-primary btn-mini">
                                                                  <i class="icon-edit icon-white"></i> Edit
                                                              </a>

                                                         </td>
               						                </tr>
                                                       @endforeach
           						              </tbody>
           						            </table>
                                       </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    <!-- delete confirmation modal -->
                    <div id="confirmActionModal" class="modal hide">
                        <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">&times;</button>
                            <h3>Alert!</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <a data-dismiss="modal" id="confirmActionButton" class="btn btn-primary danger" href="#" >Confirm</a>
                            <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    {{ HTML::script('/js/confirm.js'); }}
@stop
