<!-- get URI -->
{{-- */$uri1 = $_SERVER['REQUEST_URI'];/* --}}

 <!-- sidebar -->
<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        @if(strpos($uri1,'dashboard') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a href="{{ URL::to('/admin-panel/dashboard') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-tachometer"></i> Dashboard</a>

        </li>

        @if(strpos($uri1,'admins') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a href="{{ URL::to('/admin-panel/admins') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-user-secret"></i> Admin Management</a>

        </li>
    </ul>

    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">

        @if(strpos($uri1,'departments') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/departments') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-sitemap"></i> Department Management</a>
        </li>

        @if(strpos($uri1,'employees') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/employees') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-user-plus"></i> Employee Management</a>
        </li>

        @if(strpos($uri1,'employee-equipment-list') !== false || strpos($uri1,'moderate-employee-equipment') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/employee-equipment-list') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-list-alt"></i> Equipment Management</a>
        </li>

        @if(strpos($uri1,'groups') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/groups') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-users"></i> Group Management</a>
        </li>

        @if(strpos($uri1,'employee-leave-list') !== false || strpos($uri1,'moderate-employee-leave') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/employee-leave-list') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-list-alt"></i> Leave Management</a>
        </li>


        @if(strpos($uri1,'notices') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/notices') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-bell"></i> Notice Management</a>
        </li>

    </ul>
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        @if(strpos($uri1,'applicants') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/applicants') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-user-plus"></i> Applicant Management</a>
        </li>

        @if(strpos($uri1,'interview-schedules') !== false || strpos($uri1,'interview-board') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/interview-schedules') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-calendar-o"></i> Interview Schedules</a>
        </li>

        @if(strpos($uri1,'jobs') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a  href="{{ URL::to('/admin-panel/jobs') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-briefcase"></i> Job Management</a>
        </li>

    </ul>

    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        @if(strpos($uri1,'company-info') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a href="{{ URL::to('/admin-panel/company-info') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-building"></i> Company Info</a>
        </li>

        @if(strpos($uri1,'settings') !== false)
        <li class="active" >
        @else
        <li>
        @endif
            <a href="{{ URL::to('/admin-panel/settings') }}"><i class="icon-chevron-right"></i>
                <i class="fa fa-cogs"></i> Settings</a>
        </li>
    </ul>
</div>
