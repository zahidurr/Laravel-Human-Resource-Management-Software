<!-- Page title -->
@section('title')
    Applicant Résumé
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
                           <div class="muted pull-left">Applicant Résumé</div>
                           <div class="pull-right"><a href="#" onclick="redirectBack()">Back</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- profile brief -->
                               <div class="span6" style="margin-left: 25px !important;">
                                   <h3>{{ $applicant->first_name }} {{ $applicant->last_name }}</h3>

                                   <i class="fa fa-envelope"></i> {{ $applicant->email }}
                                   <br>
                                   <i class="fa fa-phone-square"></i> {{ $applicant->phone }}
                               </div>

                               <!-- profile image -->
                               <div class="span4">
                                   <img src="{{ asset('/uploads/images/'.$applicant->profile_image) }}" id="image-preview" />
                               </div>

                           </div>

                       </div>

                       <!-- profile details -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- tab button -->
                               <ul class="nav nav-tabs" role="tablist" id="profileTab">
                                  <li role="presentation" class="active"><a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">Personal</a></li>
                                  <li role="presentation"><a href="#education-training" aria-controls="education-training" role="tab" data-toggle="tab">Education/Training</a></li>
                                  <li role="presentation"><a href="#employment" aria-controls="employment" role="tab" data-toggle="tab">Education/Training</a></li>
                                  <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Other</a></li>
                              </ul>

                              <!-- tab content -->
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane fade in active" id="personal">
                                  <legend>Personal Information</legend>
                                  <table class="profile-table">
                                      <tbody>
						                <tr>
						                  <td class="head-text" >Name</td>
						                  <td><b>:</b> {{ $applicant->first_name }} {{ $applicant->last_name }}</td>
						                </tr>
                                        <tr>
						                  <td class="head-text">Father's Name</td>
						                  <td><b>:</b> {{ $applicant->father_name }}</td>
						                </tr>
                                        <tr>
						                  <td class="head-text">Mother's Name</td>
						                  <td><b>:</b> {{ $applicant->mother_name }}</td>
						                </tr>
                                        <tr>
                                          <td class="head-text">Date of Birth</td>
                                          <td><b>:</b> {{ $applicant->dob }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Gender</td>
                                          <td><b>:</b> {{ App::make('UtilController')->genderName ($applicant->gender) }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Marital Status</td>
                                          <td><b>:</b> {{ App::make('UtilController')->maritalStatusName ($applicant->marital_status) }}</td>
                                        </tr>

                                        <tr>
                                          <td class="head-text">Nationality</td>
                                          <td><b>:</b> {{ $applicant->nationality }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">Religion</td>
                                          <td><b>:</b> {{ $applicant->religion }}</td>
                                        </tr>
                                        <tr>
                                          <td class="head-text">SSN / ID No</td>
                                          <td><b>:</b> {{ $applicant->ssn }}</td>
                                        </tr>
                                       </tbody>
                                  </table>

                                  <legend>Contact Information</legend>
                                  <table class="profile-table">
                                      <tbody>
                                            <tr>
                                              <td class="head-text" >Email</td>
                                              <td><b>:</b> {{ $applicant->email }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Alternative Email</td>
                                              <td><b>:</b> {{ $applicant->alternative_email }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Phone</td>
                                              <td><b>:</b> {{ $applicant->phone }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Alternative Phone</td>
                                              <td><b>:</b> {{ $applicant->alternative_email }}</td>
                                            </tr>

                                            <tr>
                                              <td class="head-text" >Address</td>
                                              <td><b>:</b> {{ $applicant->address }}</td>
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

                                              <td><b>:</b> {{ $applicant->level_of_education }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Exam/Degree Title
</td>

                                              <td><b>:</b> {{ $applicant->exam_or_degree_title }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Concentration/Major/Group
</td>

                                              <td><b>:</b> {{ $applicant->concentration_or_major_or_group }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Institute Name
</td>

                                              <td><b>:</b> {{ $applicant->institute_name }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Result
</td>

                                              <td><b>:</b> {{ $applicant->result }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Year of Passing
</td>

                                              <td><b>:</b> {{ $applicant->year_of_passing }}</td>
                                            </tr>
                                            <tr>
                                              <td class="head-text" >Achievement
</td>

                                              <td><b>:</b> {{ $applicant->achievement }}</td>
                                            </tr>
                                        </tbody>
                                  </table>

                                  <legend>Training Summary</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Training Title
</td>

                                            <td><b>:</b> {{ $applicant->training_title }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Institute Name
</td>

                                            <td><b>:</b> {{ $applicant->ts_institute }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Location
</td>

                                            <td><b>:</b> {{ $applicant->ts_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Training Year
</td>

                                            <td><b>:</b> {{ $applicant->training_year }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Professional Qualifications</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Certification
</td>

                                            <td><b>:</b> {{ $applicant->certification }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Institute Name
</td>

                                            <td><b>:</b> {{ $applicant->pq_institute }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Location
</td>

                                            <td><b>:</b> {{ $applicant->pq_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >From
</td>

                                            <td>
                                                <b>:</b> {{ $applicant->pq_from }}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >To</td>
                                            <td>
                                                <b>:</b> {{ $applicant->pq_to }}
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
                                            <td class="head-text" >Company Name
</td>

                                            <td><b>:</b> {{ $applicant->company_name }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Company Location
</td>

                                            <td><b>:</b> {{ $applicant->company_location }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Position Held
</td>

                                            <td><b>:</b> {{ $applicant->position_held }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Department
</td>

                                            <td><b>:</b> {{ $applicant->eh_department }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Responsibilities
</td>

                                            <td><b>:</b> {{ $applicant->eh_responsibilities }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >From
</td>

                                            <td><b>:</b> {{ $applicant->eh_from }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >To</td>

                                            <td><b>:</b> {{ $applicant->eh_to }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Area of Experiences</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Category
</td>

                                            <td><b>:</b> {{ $applicant->experience_category }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Skills
</td>

                                            <td><b>:</b> {{ $applicant->skills }}</td>
                                          </tr>
                                        </tbody>
                                  </table>
                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="other">
                                  <legend>Reference</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Name

</td>

                                            <td><b>:</b> {{ $applicant->ref_name }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Organization</td>
                                            <td><b>:</b> {{ $applicant->ref_organization }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Designation</td>

                                            <td><b>:</b> {{ $applicant->ref_designation }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Address</td>

                                            <td><b>:</b> {{ $applicant->ref_address }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Phone</td>

                                            <td><b>:</b> {{ $applicant->ref_phone }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Email</td>

                                            <td><b>:</b> {{ $applicant->ref_email }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Relation</td>

                                            <td><b>:</b> {{ $applicant->ref_relation }}</td>
                                          </tr>
                                        </tbody>
                                  </table>

                                  <legend>Career and Application Information</legend>
                                  <table class="profile-table">
                                      <tbody>
                                          <tr>
                                            <td class="head-text" >Objective</td>

                                            <td><b>:</b> {{ $applicant->objective }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Career Summary</td>

                                            <td><b>:</b> {{ $applicant->career_summary }}</td>
                                          </tr>
                                          <tr>
                                            <td class="head-text" >Spacial Qualification</td>

                                            <td><b>:</b> {{ $applicant->spacial_qualification }}</td>
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
