<!-- Page title -->
@section('title')
    Company Info
@stop

<!-- Specefic  style sheet section for this page -->
@section('css_sheets')
    {{ HTML::style('/css/map.css') }}

    <!-- Map display box style -->
    <style>
    #map_canvas {
        width:100%;
        height:374px;
        -webkit-box-sizing:border-box;
        -moz-box-sizing:border-box;
        box-sizing:border-box;
    }
    </style>
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')


    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12" id="content">

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">

                       <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Company Info</div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               <img src="{{ asset('/uploads/company_logo.png') }}" alt="Logo" />

                               <span style="font-size: 35px;">{{ $company_info->name }}</span>
                           </div>
                       </div>

                       <!-- details content -->
                       <div class="block-content collapse in">
                           <div class="span12">
                               @if($company_info->about != '')
                               <div class="span12">
                               {{ $company_info->about }}
                               <br><br>
                                </div>
                               @endif

                               @if($company_info->address != '')
                               <div class="span9"><i class="fa fa-map-marker"></i> {{ $company_info->address }}</div>
                               @endif

                               @if($company_info->phone != '')
                               <div class="span9"><i class="fa fa-phone-square"></i> {{ $company_info->phone }}</div>
                               @endif

                               @if($company_info->email != '')
                               <div class="span9"><i class="fa fa-envelope"></i> <a href="mailto:{{ $company_info->email }}" target="_top">{{ $company_info->email }}</a></div>
                               @endif

                               @if($company_info->website != '')
                               <div class="span9"><i class="icon-globe"></i> <a href="http://{{ $company_info->website }}" >{{ $company_info->website }}</a></div>
                               @endif

                           </div>

                       </div>

                       @if($company_info->latitude != '' && $company_info->longitude != '')

                       <!-- BEGIN GOOGLE MAP -->
                       <div class="block-content collapse in">

                           <div class="span12">

                               <div id="map_canvas"></div>

                           </div>

                       </div>
                       <!-- END GOOGLE MAP -->
                       @endif

                   </div>
                   <!-- /block -->
               </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')

    <!-- initialize jQuery Library -->
    {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}
    <!-- Google Map -->
    {{ HTML::script('http://maps.google.com/maps/api/js?sensor=true') }}
    {{ HTML::script('/vendors/jquery.ui.map.js') }}

    <!-- Google Map Init-->
    <script type="text/javascript">
        jQuery(function($){
            //getter
            var zoom= $('#map_canvas').gmap('option', 'zoom');

            $('#map_canvas').gmap().bind('init', function(ev, map) {
                $('#map_canvas').gmap('addMarker', {'position': '{{ $company_info->latitude }},{{ $company_info->longitude }}', 'bounds': true});
                $('#map_canvas').gmap('option', 'zoom', 13);
            });
        });
    </script>
@stop
