<!-- Page title -->
@section('title')
    Edit Admin Profile
@stop

<!-- Specefic  style sheet section for this page -->
@section('css_sheets')
    <!-- Form css sheets -->
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
                <div class="row-fluid">
                    <!-- block -->
                    <div class="block">

                        <!-- block header -->
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Edit Admin Profile</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- tab buttons -->
                                <ul class="nav nav-tabs" role="tablist" id="usersTab">
                                   <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>

                                   <li role="presentation"><a href="#photograph" aria-controls="photograph" role="tab" data-toggle="tab">Photograph</a></li>
                               </ul>

                               <!-- Form view -->
                                {{ Form::model($admin, array('route' => array('admin-panel.admins.update', $admin->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'user-form')) }}

                                <fieldset>
                                    <div class="tab-content">
                                      <div role="tabpanel" class="tab-pane fade in active" id="personal">

                                      <div class="pull-right">
                                          <span class="required-sign"></span><small><i>Required Fields</i></small>
                                      </div>

                                    <legend>
                                        Personal Information
                                    </legend>

                                    <div class="control-group
                                    @if($errors->has('first_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('first_name', 'First Name', array('class' => 'control-label required')) }}

                                      <div class="controls">

                                      {{ Form::text('first_name', Input::old('first_name'), array('class'=>'input-xlarge focused', 'id'=>'first_name')) }}



                                        <span class="help-block">
                                            @if($errors->has('first_name'))
                                                {{ $errors->first('first_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('last_name'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('last_name', 'Last Name', array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('last_name', Input::old('last_name'), array('class'=>'input-xlarge focused', 'id'=>'last_name')) }}


                                        <span class="help-block">
                                            @if($errors->has('last_name'))
                                                {{ $errors->first('last_name') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>


                                    <div class="control-group
                                    @if($errors->has('phone'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('phone', "Phone", array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::text('phone', Input::old('phone'), array('class'=>'input-xlarge focused', 'id'=>'phone')) }}


                                        <span class="help-block">
                                            @if($errors->has('phone'))
                                                {{ $errors->first('phone') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>

                                    <div class="control-group
                                    @if($errors->has('address'))
                                        error
                                    @endif
                                    ">

                                      {{ Form::label('address', "Address", array('class' => 'control-label required')) }}
                                      <div class="controls">
                                      {{ Form::textarea('address', Input::old('address'), array('class'=>'input-xlarge focused', 'id'=>'address')) }}


                                        <span class="help-block">
                                            @if($errors->has('address'))
                                                {{ $errors->first('address') }}
                                            @endif
                                        </span>
                                      </div>
                                    </div>
                                    </div>

                                    <!-- photograph tab panel -->
                                    <div role="tabpanel" class="tab-pane fade" id="photograph">

                                        <div class="control-group">

                                          <div class="controls">
                                              {{ Form::file('image', array("onchange" => "uploadImage(this, 'Admin', $admin->id);")) }}

                                              <a tabindex="0" style="cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" data-html="true" data-content="<i class='fa fa-asterisk'></i> File must be less then 1MB in size<br><i class='fa fa-asterisk'></i> File must be in JPEG(.jpg or .jpeg) or PNG(.png) format"><i class="fa fa-info-circle"></i></a>
                                            <span class="help-block">
                                                <div id="upload-image-msg" ></div>
                                            </span>

                                            <br>
                                            <img src="{{ asset('uploads/images/'.$admin->profile_image) }}" id="image-preview" />

                                          </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="form-actions">
                                      <!-- submit button -->
                                      {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large')) }}
                                      <a class="btn" href="{{ URL::to('/admin-panel/admins') }}">Cancel</a>

                                    </div>
                                    </fieldset>
                                {{ Form::close() }}
                                <!-- Form view close -->
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
@stop
