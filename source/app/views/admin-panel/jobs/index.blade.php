<!-- Page title -->
@section('title')
    Jobs
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
                </div>

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">

                       <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Jobs</div>
                           <div class="pull-right"><a href="{{ URL::to('/admin-panel/jobs/create') }}">Create</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                                <!-- table -->
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th>Tilte</th>
                                           <th>Start Date</th>
                                           <th>End Date</th>
                                           <th>No. of Vacancies</th>
                                           <th>Job Nature</th>
                                           <th></th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                       @foreach($jobs as $key => $value)
                                       <tr class="gradeA">
                                           <td><a href="{{ URL::to('/admin-panel/jobs/'. $value->id) }}">{{ $value->title }} </a></td>


                                           <td>
                                               {{ $value->start_date }}
                                           </td>

                                           <td>
                                               {{ $value->end_date }}
                                           </td>

                                           <td class="text-center">
                                               {{ $value->no_of_vacancies }}
                                           </td>

                                           <td>
                                               {{ $value->job_nature }}
                                           </td>

                                           <td class="vert-align">
                                            @if(in_array($value->id, $interview_schedules))
                                               <button class="btn btn-danger btn-mini disabled" onClick="disabledAction('Interview scheduled job can not be deleted')">
                                                   <i class="icon-trash icon-white"></i> Delete
                                               </button>

                                           @else
                                               <button class="btn btn-danger btn-mini" onClick="confirmAction('<b>{{ $value->title }}</b>', '/admin-panel/jobs/{{ $value->id }}')">
                                                   <i class="icon-trash icon-white"></i> Delete
                                               </button>


                                           @endif

                                                <a href="{{ URL::to('/admin-panel/jobs/'.$value->id.'/edit') }}" class="btn btn-primary btn-mini">
                                                    <i class="icon-edit icon-white"></i> Edit
                                                </a>
                                           </td>

                                       </tr>

                                       @endforeach
                                   </tbody>
                               </table>

                               <div id="disabledActionModal" class="modal hide">
                                   <div class="modal-header">
                                       <button data-dismiss="modal" class="close" type="button">&times;</button>
                                       <h3>Info</h3>
                                   </div>
                                   <div class="modal-body">
                                       <p>Do you want to delete?</p>
                                   </div>

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
                   <!-- /block -->
               </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    {{ HTML::script('/js/confirm.js'); }}
@stop
