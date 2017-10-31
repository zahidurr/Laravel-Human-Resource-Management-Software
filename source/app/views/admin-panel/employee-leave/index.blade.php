<!-- Page title -->
@section('title')
    Employee Leave List
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
                           <div class="muted pull-left">Employee Leave List</div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- table -->
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th class="index-th">#</th>
                                           <th>Employee Name</th>
                                           <th>Leave Details</th>
                                           <th>Reviewed By</th>
                                           <th>Comment</th>
                                           <th>Status</th>
                                           <th></th>

                                       </tr>
                                   </thead>
                                   <tbody>
                                       @foreach($leave_list as $key => $value)
                                       <tr>
                                           <td>
                                               {{ $key+1 }}
                                           </td>

                                           <td>
                                               <a href="{{ URL::to('/admin-panel/employees/'. $value->employee_id) }}">{{ App::make('UtilController')->userFullName ($value->employee_id, 'Employee') }}
                                               </a>
                                           </td>


                                           <td>
                                               <span class="titleText">Type:</span>
                                               {{ $value->type }}
                                               <br>
                                               <span class="titleText">Duration:</span>
                                               {{ date("Y-M-j", strtotime($value->from_date)) }} to {{ date("Y-M-j", strtotime($value->to_date)) }}
                                               <br>
                                               <span class="titleText">Reason:</span>
                                               {{ $value->reason }}

                                           </td>

                                           <td>

                                               <a href="{{ URL::to('/admin-panel/admins/'. $value->moderated_by) }}">{{ App::make('UtilController')->userFullName ($value->moderated_by) }}
                                               </a>
                                           </td>

                                           <td>
                                               {{ $value->moderator_comment }}
                                           </td>

                                           <td>
                                               @if($value->status == 1)
                                                    <i class="fa fa-check-square" style="color:green;"></i> Approved
                                               @elseif($value->status == 2)
                                                    <i class="fa fa-times" style="color:red;"></i> Rejected
                                               @else
                                                    <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                               @endif
                                           </td>

                                           <td class="vert-align">

                                                <a href="{{ URL::to('/admin-panel/moderate-employee-leave/'.$value->id) }}" class="btn btn-primary btn-mini">
                                                    <i class="fa fa-check-square-o"></i> Review
                                                </a>

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
