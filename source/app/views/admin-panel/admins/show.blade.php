<!-- Page title -->
@section('title')
    Admin Profile
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
                           <div class="muted pull-left">Admin Profile</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                        <!-- block content -->
                       <div class="block-content collapse in">

                           <div class="span12">

                               <!-- profile brief -->
                               <div class="span6" style="margin-left: 25px !important;">
                                   <h3>{{ $admin->first_name }} {{ $admin->last_name }}</h3>

                                   <i class="fa fa-envelope"></i> {{ $admin->email }}
                                   <br>
                                   <i class="fa fa-phone-square"></i> {{ $admin->phone }}
                               </div>

                               <!-- profile image -->
                               <div class="span4">
                                   <img src="{{ asset('/uploads/images/'.$admin->profile_image) }}" id="image-preview" />
                               </div>

                           </div>

                       </div>

                       <!-- profile details -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <!-- tab button -->
                               <ul class="nav nav-tabs" role="tablist" id="profileTab">
                                  <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>

                                  <li role="presentation"><a href="#user-log" aria-controls="user-log" role="tab" data-toggle="tab">Log</a></li>
                               </ul>

                              <!-- tab content -->
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane fade in active" id="personal">
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

                              <div role="tabpanel" class="tab-pane fade" id="user-log">
                                  <legend>Log History</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >
                                                Account Created
                                            </td>
                                            <td>
                                                <b>:</b> {{ $admin->created_at }}
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="head-text" >
                                                Last Login
                                            </td>
                                            <td>
                                                <b>:</b> {{ $admin->last_login_at }}
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="head-text" >
                                                Last Login Agent
                                            </td>

                                            <td>
                                                <b>:</b> {{ $admin->last_login_agent }}
                                            </td>
                                          </tr>
                                      </tbody>
                                  </table>
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
