<!-- Page title -->
@section('title')
    Edit Equipment Request
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
            <div class="span12" id="content">

                <div class="row-fluid">
                    <!-- block -->
                    <div class="block">

                        <!-- block header -->
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Edit Equipment Request</div>
                        </div>

                        <!-- block content -->
                        <div class="block-content collapse in">
                            <div class="span12">

                                <!-- Form view -->
                                {{ Form::model($equipment, array('route' => array('employee-panel.equipments.update', $equipment->id), 'method' => 'PUT', 'class'=>'form-horizontal')) }}
                                <fieldset>

                                <div class="control-group
                                @if($errors->has('name'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('name', 'Equipment Name', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('name',  Input::old('name'), array('class'=>'input-xlarge focused', 'id'=>'name', 'placeholder'=>'Mouse')) }}

                                    <span class="help-block">
                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="control-group
                                @if($errors->has('quantity'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('quantity', 'Quantity', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::text('quantity',  Input::old('quantity'), array('class'=>'input-xlarge focused', 'id'=>'quantity', 'placeholder'=>'1')) }}

                                    <span class="help-block">
                                        @if($errors->has('quantity'))
                                            {{ $errors->first('quantity') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>


                                <div class="control-group
                                @if($errors->has('reason'))
                                    error
                                @endif
                                ">

                                  {{ Form::label('reason', 'Reason', array('class' => 'control-label')) }}
                                  <div class="controls">
                                  {{ Form::textarea('reason',  Input::old('reason'), array('class'=>'input-xlarge focused', 'id'=>'reason', 'placeholder'=>'Mouse is not working...')) }}

                                    <span class="help-block">
                                        @if($errors->has('reason'))
                                            {{ $errors->first('reason') }}
                                        @endif
                                    </span>

                                  </div>
                                </div>

                                <div class="form-actions">

                                  {{ Form::submit('Update', array('class'=>'btn btn-danger btn-large'))}}

                                  <a class="btn" href="{{ URL::to('/employee-panel/equipments') }}">Cancel</a>

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
    @include('layouts.js_scripts.form_employee')
    @include('layouts.js_scripts.employee_master')
@stop
