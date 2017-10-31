<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>404 Not Found | {{ App::make('UtilController')->companyName () }}</title>

        <!-- Bootstrap -->
        {{ HTML::style('/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('/bootstrap/css/bootstrap-responsive.min.css') }}
        {{ HTML::style('/assets/DT_bootstrap.css') }}
        {{ HTML::style('/assets/styles.css') }}

        {{ HTML::style('/vendors/font-awesome/css/font-awesome.min.css') }}

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            {{ HTML::script('//html5shim.googlecode.com/svn/trunk/html5.js') }}
        <![endif]-->
        {{ HTML::script('/vendors/modernizr-2.6.2-respond-1.1.0.min.js') }}

    </head>
    <body>
        <!-- top bar content -->
        @include('layouts.top_bar')

        <div class="container-fluid">
            <div class="row-fluid">
               <!-- block -->
               <div class="block">
                   <div class="block-content collapse in">

                       <!-- 404 error message -->
                        <div style="height: 100%; text-align: center; padding-top: 10%; padding-bottom: 10%;">
                           <span style="color: #B5123D; font-size: 400%;">
                               <i class="fa fa-exclamation-triangle"></i>
                           </span>
                           <h1>404</h1>
                           Page Not Found!
                       </div>

                   </div>
               </div>
               <!-- /block -->
            </div>

        </div>

        <!-- footer content -->
        @include('layouts.footer')

        <!-- required javascript files -->
        {{ HTML::script('/vendors/jquery-1.9.1.min.js') }}
        {{ HTML::script('/bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('/vendors/wizard/jquery.bootstrap.wizard.min.js') }}


        {{ HTML::script('/vendors/datatables/js/jquery.dataTables.min.js') }}
        {{ HTML::script('/assets/DT_bootstrap.js') }}

        {{ HTML::script('/assets/scripts.js') }}

    </body>
</html>
