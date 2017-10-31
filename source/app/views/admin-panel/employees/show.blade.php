<!-- Page title -->
@section('title')
    Employee Résumé
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
                           <div class="muted pull-left">Employee Résumé</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- profile brief -->
                               <div class="span6" style="margin-left: 25px !important;">

                                   <h3>{{ $employee->first_name }} {{ $employee->last_name }}</h3>

                                   <i class="fa fa-envelope"></i> {{ $employee->email }}
                                   <br>
                                   <i class="fa fa-phone-square"></i> {{ $employee->phone }}
                                   <br>
                                   <i class="fa fa-sitemap"></i> {{ App::make('UtilController')->departmentName ($employee->department_id) }}
                                   <br>
                                   <i class="fa fa-briefcase"></i> {{ $employee->designation }}
                                   <br>
                                   <i class="fa fa-user"></i> {{ $employee->employee_id }}

                               </div>

                               <!-- profile image -->
                               <div class="span4">
                                   <img src="{{ asset('/uploads/images/'.$employee->profile_image) }}" id="image-preview" />
                               </div>

                           </div>

                       </div>

                       <div class="block-content collapse in">
                           <div class="span12">
                               <!-- tab button -->
                               <ul class="nav nav-tabs" role="tablist" id="profileTab">
                                  <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>
                                  <li role="presentation"><a href="#education-training" aria-controls="education-training" role="tab" data-toggle="tab">Education/Training</a></li>
                                  <li role="presentation"><a href="#employment" aria-controls="employment" role="tab" data-toggle="tab">Education/Training</a></li>
                                  <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Other</a></li>
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
						                  <td><b>:</b> {{ $employee->first_name }} {{ $employee->last_name }}</td>
						                </tr>
                                        <tr>
						                  <td class="head-text">Father's Name</td>
						                  <td><b>:</b> {{ $employee->father_name }}</td>
						                </tr>
                                        <tr>
						                  <td class="head-text">Mother's Name</td>
						                  <td><b>:</b> {{ $employee->mother_name }}</td>
						                </tr>
                                        <tr>
                                          <td class="head-text">Date of Birth</td>
                                          <td><b>:</b> {{ $employee->dob }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Gender</td>
                                          <td><b>:</b> {{ App::make('UtilController')->genderName ($employee->gender) }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Marital Status</td>
                                          <td><b>:</b> {{ App::make('UtilController')->maritalStatusName ($employee->marital_status) }}</td>
                                        </tr>

                                        <tr>
                                          <td class="head-text">Nationality</td>
                                          <td><b>:</b> {{ $employee->nationality }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Religion</td>
                                          <td><b>:</b> {{ $employee->religion }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">SSN / ID No</td>
                                          <td><b>:</b> {{ $employee->ssn }}</td>
                                        </tr>
                                       </tbody>
                                  </table>

                                  <legend>Contact Information</legend>
                                  <table class="profile-table">
                                      <tbody>
                                            <tr>
                                              <td class="head-text" >Email</td>
                                              <td><b>:</b> {{ $employee->main_email }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Alternative Email</td>
                                              <td><b>:</b> {{ $employee->alternative_email }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Phone</td>
                                              <td><b>:</b> {{ $employee->phone }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Alternative Phone</td>
                                              <td><b>:</b> {{ $employee->alternative_email }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Address</td>
                                              <td><b>:</b> {{ $employee->address }}</td>
                                            </tr>

                                      </tbody>
                                   </table>

                                   <legend>Employee Information</legend>
                                   <table class="profile-table">

                                       <tbody>
                                             <tr>
                                               <td class="head-text" >Department</td>

                                               <td><b>:</b> {{ App::make('UtilController')->departmentName ($employee->department_id) }}</td>
                                             </tr>

                                             <tr>
                                               <td class="head-text" >Designation</td>

                                               <td><b>:</b> {{ $employee->designation }}</td>
                                             </tr>

                                             <tr>
                                               <td class="head-text" >Employee ID</td>

                                               <td><b>:</b> {{ $employee->employee_id }}</td>
                                             </tr>

                                             <tr>
                                               <td class="head-text" >Joining Date</td>

                                               <td><b>:</b> {{ $employee->joining_date }}</td>
                                             </tr>
                                         </tbody>
                                      </table>
                              </div>


                              <div role="tabpanel" class="tab-pane fade" id="education-training">
                                  <legend>Academic Qualification</legend>
                                  <table class="profile-table">

                                      <tbody>
                                            <tr>
                                              <td class="head-text" >Level of Education</td>

                                              <td><b>:</b> {{ $employee->level_of_education }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Exam/Degree Title</td>

                                              <td><b>:</b> {{ $employee->exam_or_degree_title }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Concentration/Major/Group</td>

                                              <td><b>:</b> {{ $employee->concentration_or_major_or_group }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Institute Name</td>

                                              <td><b>:</b> {{ $employee->institute_name }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Result</td>

                                              <td><b>:</b> {{ $employee->result }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Year of Passing</td>

                                              <td><b>:</b> {{ $employee->year_of_passing }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Achievement</td>

                                              <td><b>:</b> {{ $employee->achievement }}</td>
                                            </tr>
                                        </tbody>
                                  </table>

                                  <legend>Training Summary</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Training Title</td>

                                            <td><b>:</b> {{ $employee->training_title }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Institute Name</td>

                                            <td><b>:</b> {{ $employee->ts_institute }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Location</td>

                                            <td><b>:</b> {{ $employee->ts_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Training Year</td>

                                            <td><b>:</b> {{ $employee->training_year }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Professional Qualifications</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Certification</td>

                                            <td><b>:</b> {{ $employee->certification }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Institute Name</td>

                                            <td><b>:</b> {{ $employee->pq_institute }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Location</td>

                                            <td><b>:</b> {{ $employee->pq_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >From</td>

                                            <td><b>:</b>
                                                @if($employee->pq_from != '')
                                                    {{ $employee->pq_from }}
                                                @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >To</td>

                                            <td><b>:</b>
                                                @if($employee->pq_to != '')
                                                    {{ $employee->pq_to }}
                                                @endif
                                            </td>
                                          </tr>
                                        </tbody>
                                  </table>
                              </div>

                              <div role="tabpanel" class="tab-pane fade" id="employment">
                                  <legend>Employment History</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Company Name</td>

                                            <td><b>:</b> {{ $employee->company_name }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Company Location</td>

                                            <td><b>:</b> {{ $employee->company_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Position Held</td>

                                            <td><b>:</b> {{ $employee->position_held }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Department</td>

                                            <td><b>:</b> {{ $employee->eh_department }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Responsibilities</td>

                                            <td><b>:</b> {{ $employee->eh_responsibilities }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >From</td>

                                            <td><b>:</b> {{ $employee->eh_from }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >To</td>

                                            <td><b>:</b> {{ $employee->eh_to }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Area of Experiences</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Category</td>

                                            <td><b>:</b> {{ $employee->experience_category }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Skills</td>

                                            <td><b>:</b> {{ $employee->skills }}</td>
                                          </tr>
                                        </tbody>
                                  </table>
                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="other">
                                  <legend>Reference</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Name</td>

                                            <td><b>:</b> {{ $employee->ref_name }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Organization</td>
                                            <td><b>:</b> {{ $employee->ref_organization }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Designation</td>

                                            <td><b>:</b> {{ $employee->ref_designation }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Address</td>

                                            <td><b>:</b> {{ $employee->ref_address }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Phone</td>

                                            <td><b>:</b> {{ $employee->ref_phone }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Email</td>

                                            <td><b>:</b> {{ $employee->ref_email }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Relation</td>

                                            <td><b>:</b> {{ $employee->ref_relation }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Career and Application Information</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Objective</td>

                                            <td><b>:</b> {{ $employee->objective }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Career Summary</td>

                                            <td><b>:</b> {{ $employee->career_summary }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Spacial Qualification</td>

                                            <td><b>:</b> {{ $employee->spacial_qualification }}</td>
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
                                                <b>:</b> {{ $employee->created_at }}
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="head-text" >
                                                Last Login
                                            </td>

                                            <td>
                                                <b>:</b> {{ $employee->last_login_at }}
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="head-text" >
                                                Last Login Agent
                                            </td>

                                            <td>
                                                <b>:</b> {{ $employee->last_login_agent }}
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
