<!-- Page title -->
@section('title')
    Notice Details
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
                           <div class="muted pull-left">Notice Details</div>

                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <h3>{{ $notice->title }}</h3>

                               <div class="row-fluid">
                                   <div class="span8">

                                       {{ $notice->description }}

                                   </div>
                                   <div class="span4">
                                       <!-- block -->
                                       <div class="div-box">
                                           <span class="titleText">Start Date:</span>
                                       {{ date("F j, Y", strtotime($notice->start_date)) }}
                                            <br>

                                           <span class="titleText">End Date:</span>
                                           {{ date("F j, Y", strtotime($notice->end_date)) }}
                                           <br>

                                           <span class="titleText">Creator:</span>
                                           {{ App::make('UtilController')->userFullName ($notice->created_by) }}
                                       </div>
                                   </div>

                               </div>
                           </div>
                       </div>

                   </div>
                   <!-- /block -->
               </div>

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Group List</div>

                       </div>
                       <div class="block-content collapse in">
                           <div class="span12">
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th>Name</th>
                                           <th>Creator</th>
                                           <th>Total Members</th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                       @foreach($groups as $key => $value)
                                       <tr class="gradeA">
                                           <td>
                                               <a href="{{ URL::to('/admin-panel/groups/'.$value->id) }}">
                                                   {{ $value->name }}
                                               </a>
                                           </td>

                                           <td>
                                               {{ App::make('UtilController')->userFullName ($value->created_by) }}
                                           </td>

                                           <td class="text-center">
                                               {{ App::make('UtilController')->totalGroupMembers ($value->id) }}
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
