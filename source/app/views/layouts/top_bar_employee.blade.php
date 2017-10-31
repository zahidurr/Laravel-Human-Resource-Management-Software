<!-- get URI -->
{{-- */$uri_emp = $_SERVER['REQUEST_URI'];/* --}}

<!-- Header top bar for Employee panel -->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
            </a>

            <!-- brand logo -->
            <a class="brand-logo" href="{{ URL::to('/company-info') }}">
                <img src="{{ asset('/uploads/company_logo.png') }}" alt="Logo" style="height:40px;" />
            </a>

            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">

                         <!-- profile-image -->
                        <img src="{{ asset('/uploads/images/'. App::make('UtilController')->userProfileImageName (Auth::user()->id, 'Employee')) }}" class="profile-image-top-bar" />

                         <!-- user name -->
                        {{ App::make('UtilController')->userFullName (Auth::user()->id, 'Employee') }}
                        <i class="caret"></i>

                        </a>

                         <!-- dropdown menu -->
                        <ul class="dropdown-menu">

                            <li>
                                <a tabindex="-1" href="{{ URL::to('/employee-panel/my-profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/logout') }}">Sign Out</a>
                            </li>

                        </ul>
                    </li>
                </ul>


                <ul class="nav pull-right">
                     <!-- notification icon -->
                    <li>
                        <a href="#myModal" data-toggle="modal" onclick="getNoticesList()">
                            <i class="fa fa-bell"></i>
                            <div id="notice-notification"></div>
                        </a>

                    </li>

                </ul>

                <!-- navigation panel -->
                <ul class="nav">
                    @if(strpos($uri_emp,'dashboard') !== false)
                    <li class="active" >
                    @else
                    <li>
                    @endif
                        <a href="{{ URL::to('/employee-panel/dashboard') }}">Dashboard</a>
                    </li>


                    @if(strpos($uri_emp,'leave') !== false)
                    <li class="dropdown active" >
                    @else
                    <li class="dropdown">
                    @endif
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Leave <i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/employee-panel/leave') }}"> My Leave List</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/employee-panel/leave/create') }}">Create Leave Request</a>
                            </li>

                        </ul>
                    </li>

                    @if(strpos($uri_emp,'equipments') !== false)
                    <li class="dropdown active" >
                    @else
                    <li class="dropdown">
                    @endif
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Equipment <i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/employee-panel/equipments') }}"> My Equipment List</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/employee-panel/equipments/create') }}">Create Equipment Request</a>
                            </li>

                        </ul>
                    </li>

                    @if(strpos($uri_emp,'attendance-details') !== false)
                    <li class="active" >
                    @else
                    <li>
                    @endif
                        <a href="{{ URL::to('/employee-panel/attendance-details') }}">Monthly Attendance Details</a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>

 <!-- Notice board modal -->
<div class="container-fluid">
    <div class="row-fluid">
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h3>Notice Board</h3>
            </div>
            <div class="modal-body" id="total-notice-list">
                <div style="text-align: center !important;">
                	<i class="fa fa-spinner fa-pulse fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
