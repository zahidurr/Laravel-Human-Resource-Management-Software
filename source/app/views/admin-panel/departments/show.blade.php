<!-- Page title -->
@section('title')
    Department
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
                   <!-- block -->
                   <div class="block">

                       <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Department Details</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <h3>{{ $department->name }}</h3>

                               <strong>Head:</strong> {{ App::make('UtilController')->userFullName ($department->head, 'Employee'); }}
                               <br>
                               <strong>Total Members:</strong> {{ $total_members }}

                                 <br><br>
                                 <h4>Member List</h4>

                                 <!-- table -->
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th>Name</th>
                                           <th>Email</th>
                                           <th>Phone</th>

                                       </tr>
                                   </thead>
                                   <tbody>
                                       @foreach($employees as $key => $value)
                                       <tr class="gradeA">
                                           <td>
                                               <img src="{{ asset('/uploads/images/'.$value->profile_image) }}"  class="profile-image-small" />


                                               <a href="{{ URL::to('/admin-panel/employees/'.$value->id) }}">{{ $value->first_name }} {{ $value->last_name }}</a>
                                           </td>

                                           <td> {{ $value->email }}</td>
                                           <td> {{ $value->phone }}</td>

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
