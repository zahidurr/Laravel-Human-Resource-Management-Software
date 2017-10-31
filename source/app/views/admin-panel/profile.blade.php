<!-- Page title -->
@section('title')
    My Profile
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
                           <div class="muted pull-left">My Profile</div>
                       </div>

                        <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <div class="span6" style="margin-left: 25px !important;">
                                   <h3>{{ $admin->first_name }} {{ $admin->last_name }}</h3>

                                   <i class="fa fa-envelope"></i> {{ $admin->email }}
                                   <br>
                                   <i class="fa fa-phone-square"></i> {{ $admin->phone }}

                               </div>

                               <div class="span4">
                                   <img src="{{ asset('/uploads/images/'.$admin->profile_image) }}" id="image-preview" />
                               </div>

                           </div>

                       </div>

                        <!-- profile content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                              <legend>Personal Information</legend>
                              <table class="profile-table">
                                  <tbody>
					                <tr>
					                  <td class="head-text" >Name</td>
					                  <td><b>:</b> {{ $admin->first_name }} {{ $admin->last_name }}</td>
					                </tr>
                                    <tr>
					                  <td class="head-text">Email</td>
					                  <td><b>:</b> {{ $admin->email }}</td>
					                </tr>
                                    <tr>
					                  <td class="head-text">Phone</td>
					                  <td><b>:</b> {{ $admin->phone }}</td>
					                </tr>
                                    <tr>
					                  <td class="head-text">Address</td>
					                  <td><b>:</b> {{ $admin->address }}</td>
					                </tr>

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
