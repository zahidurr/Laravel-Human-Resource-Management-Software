<!-- Page title -->
@section('title')
    Employees
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
                           <div class="muted pull-left">Employees</div>
                           <div class="pull-right"><a href="{{ URL::to('/admin-panel/employees/create') }}">Create</a></div>
                       </div>

                        <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- table -->
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th>Name</th>
                                           <th>Email</th>
                                           <th>Phone</th>
                                           <th></th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                       @foreach($employees as $key => $value)
                                       <tr class="gradeA">

                                           <td>
                                               <img src="{{ asset('/uploads/images/'.$value->profile_image) }}"  class="profile-image-small" />

                                               <a href="{{ URL::to('/admin-panel/employees/'. $value->id) }}">{{ $value->first_name }} {{ $value->last_name }}</a>
                                           </td>

                                           <td>
                                               {{ $value->email }}
                                           </td>

                                           <td>
                                               {{ $value->phone }}
                                           </td>


                                           <td class="vert-align">

                                               <a href="#" onClick="confirmAction('<b>{{ $value->first_name }} {{ $value->last_name }}</b>\'s account', '/admin-panel/employees/{{ $value->id }}')" class="btn btn-danger btn-mini">
                                                   <i class="icon-trash icon-white"></i> Delete
                                               </a>



                                                <a href="{{ URL::to('/admin-panel/employees/'.$value->id.'/edit') }}" class="btn btn-primary btn-mini">
                                                    <i class="icon-edit icon-white"></i> Edit
                                                </a>

                                                <a href="{{ URL::to('/admin-panel/reset-account-access/'.$value->id) }}" class="btn btn-mini">
                                                    <i class="fa fa-key"></i> Reset Account Access
                                                </a>
                                           </td>

                                       </tr>

                                       @endforeach
                                   </tbody>
                               </table>

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
