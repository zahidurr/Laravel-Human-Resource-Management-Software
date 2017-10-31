<!-- Page title -->
@section('title')
    Company Info
@stop

<!-- Specefic  style sheet section for this page -->
@section('css_sheets')
    @include('layouts.css_sheets.form')
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

                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Company Info</div>
                            <div class="pull-right">
                                <a href="{{ URL::to('/company-info') }}">View</a>
                            </div>

                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view  -->
                                {{ Form::open(array('url' => 'admin-panel/update-company-info', 'class'=>'form-horizontal', 'id'=>'company_info-form')) }}
                                <fieldset>

                                <div class="control-group
                                @if($errors->has('name'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('name', $company_info->name, array('class'=>'input-xlarge focused', 'id'=>'name')) }}


                                  <span class="help-block">
                                      @if($errors->has('name'))
                                          {{ $errors->first('name') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group">

                                  <div class="controls">
                                      {{ Form::file('image', array("onchange" => "uploadCompanyLogo(this);")) }}

                                      <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="<i class='fa fa-asterisk'></i> File must be less then 1MB in size<br><i class='fa fa-asterisk'></i> File must be in PNG(.png) format<br><i class='fa fa-asterisk'></i> 300x100 pixels recommended"><i class="fa fa-info-circle"></i></a>
                                    <span class="help-block">
                                        <div id="upload-image-msg" ></div>
                                    </span>

                                    <br>
                                    <img src="{{ asset('uploads/company_logo.png') }}" id="image-preview" />

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('phone'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('phone', 'Phone', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('phone', $company_info->phone, array('class'=>'input-xlarge focused', 'id'=>'phone')) }}


                                  <span class="help-block">
                                      @if($errors->has('phone'))
                                          {{ $errors->first('phone') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('email'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('email', 'Email', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('email', $company_info->email, array('class'=>'input-xlarge focused', 'id'=>'email')) }}


                                  <span class="help-block">
                                      @if($errors->has('email'))
                                          {{ $errors->first('email') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('website'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('website', 'Website', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('website', $company_info->website, array('class'=>'input-xlarge focused', 'id'=>'website')) }}


                                  <span class="help-block">
                                      @if($errors->has('website'))
                                          {{ $errors->first('website') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('address'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('address', 'Address', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('address', $company_info->address, array('class'=>'input-xlarge focused', 'id'=>'address')) }}


                                  <span class="help-block">
                                      @if($errors->has('address'))
                                          {{ $errors->first('address') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('latitude'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('latitude', 'Latitude', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('latitude', $company_info->latitude, array('class'=>'input-xlarge focused', 'id'=>'latitude')) }}


                                  <span class="help-block">
                                      @if($errors->has('latitude'))
                                          {{ $errors->first('latitude') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('longitude'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('longitude', 'Longitude', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('longitude', $company_info->longitude, array('class'=>'input-xlarge focused', 'id'=>'longitude')) }}


                                  <span class="help-block">
                                      @if($errors->has('longitude'))
                                          {{ $errors->first('longitude') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('about'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('about', 'About', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('about', $company_info->about, array('class'=>'input-xlarge focused', 'id'=>'about')) }}


                                  <span class="help-block">
                                      @if($errors->has('about'))
                                          {{ $errors->first('about') }}
                                      @endif
                                  </span>
                                  </div>
                                </div>

                                <div class="form-actions">

                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large')) }}

                                  <a class="btn" href="{{ URL::to('/admin-panel/dashboard') }}">Cancel</a>

                                </div>


                                </fieldset>
                                {{ Form::close() }}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.form')

    <!-- javascripts code to upload image into server  -->
    <script>
    function uploadCompanyLogo (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result).css(
                {
                     'width': '200',
                     'height': '64'
                });
            };


            //set uploading sign
            $("#upload-image-msg").html('<i class="fa fa-spinner fa-pulse"></i> Uploading...');

            //Upload to Server
            var form_data = new FormData();

            form_data.append('image', input.files[0]);

            $.ajax({
                url: baseUrl() + '/ajax/upload-company-logo', // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response){
                    //display when upload successful
                    if(response.success) reader.readAsDataURL(input.files[0]);

                    //show message
                    $("#upload-image-msg").html(response.message);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $("#upload-image-msg").html("<span style='color:red;'>Error occurred<span>");
                }
            });
        }
    }
    </script>
@stop
