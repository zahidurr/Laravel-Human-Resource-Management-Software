 <!-- Header top bar for Admin panel -->
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
                        <img src="{{ asset('/uploads/images/'. App::make('UtilController')->userProfileImageName (Auth::user()->id, 'Admin')) }}" class="profile-image-top-bar" />

                        <!-- user name -->
                        {{ App::make('UtilController')->userFullName (Auth::user()->id, 'Admin') }}
                        <i class="caret"></i>

                        </a>

                        <!-- dropdown menu -->
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="{{ URL::to('/admin-panel/my-profile') }}">
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

                <!-- navigation -->
                <ul class="nav">
                    <li class="active">
                        <a href="{{ URL::to('/admin-panel/dashboard') }}">Admin Panel</a>
                    </li>
                </ul>

                <!-- Sidebar show/hide button -->
                <ul class="nav" style="margin-top:7px;">

                    <i class="fa fa-list fa-2x hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                    <i class="fa fa-align-justify fa-2x show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>

                </ul>
            </div>
        </div>
    </div>
</div>
