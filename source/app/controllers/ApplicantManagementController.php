<?php

class ApplicantManagementController extends \BaseController {
    /**
	 * Master layouts (HTML & CSS files) and design for all pages.
	 *
     * @var string
	 */
    protected $layout = "layouts.master";

    /**
     * 'csrf' filter checks for form token validation
     * ------------------------------------------------------------------------
     * 'auth' filter checks for user's login authentication
     * ------------------------------------------------------------------------
     * 'admin' filter checks for user is admin or not
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
      $this->beforeFilter('csrf', array('on'=>'post'));
      $this->beforeFilter('auth');
      $this->beforeFilter('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //applicants
        $applicants = DB::table('applicants')->get();
        $interview_schedules = InterviewSchedule::lists('applicant_id', 'applicant_id');

        // load the view and pass the users
        $this->layout->content = View::make('admin-panel.applicants.index')
            ->with('applicants', $applicants)
            ->with('interview_schedules', $interview_schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gender_list = array('' => 'Select') + Gender::lists('name', 'id');
        $maritalstatus_list = array('' => 'Select') + MaritalStatus::lists('name', 'id');


        $this->layout->content = View::make('admin-panel.applicants.create')
        ->with('gender_list', $gender_list)
        ->with('maritalstatus_list', $maritalstatus_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required|min:2',
            'last_name'       => 'required|min:2',
            'father_name'       => 'required|min:2',
            'mother_name'       => 'required|min:2',
            'dob'       => 'required|date',
            'gender'       => 'required',
            'marital_status'       => 'required',
            'nationality'       => 'required|max:20',
            'religion'       => 'max:20',
            'email'       => 'required|email|unique:applicants,email',
            'alternative_email'       => 'email|unique:applicants,alternative_email',
            'phone' => 'required|unique:applicants,phone',
            'alternative_phone' => 'unique:applicants,alternative_phone',
            'address'       => 'required',
            'image' => 'between:1,999|mimes:jpeg,jpg,png,JPG'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {

            // store into Applicants table
            $data = new Applicant;
            $data->first_name       = Input::get('first_name');
            $data->last_name       = Input::get('last_name');
            $data->email       = Input::get('email');
            $data->alternative_email       = Input::get('alternative_email');
            $data->ssn       = Input::get('ssn');
            $data->phone       = Input::get('phone');
            $data->alternative_phone       = Input::get('alternative_phone');
            $data->dob       = Input::get('dob');
            $data->gender       = Input::get('gender');
            $data->marital_status       = Input::get('marital_status');
            $data->nationality       = Input::get('nationality');
            $data->religion       = Input::get('religion');

            $data->father_name       = Input::get('father_name');
            $data->mother_name       = Input::get('mother_name');
            $data->address       = Input::get('address');
            $data->profile_image       = 'preview.png';
            $data->save();

            //applicant unique id
            $last_inserted_id = $data->id;

            //verify and save profile image
            if (Input::hasFile('image'))
            {
                $file = Input::file('image');

                $filename = 'applicant'.$last_inserted_id . '.' . $file->getClientOriginalExtension();
                $file->move('public/uploads/images', $filename);

                $image = Image::make(sprintf('public/uploads/images/%s', $filename))->resize(200, 200)->save();

                //Update profile image
                $image_data = Applicant::find($last_inserted_id);
                $image_data->profile_image       = $filename;
                $image_data->save();
            }

            //Academic Qualification data insert
            $data2 = new AcademicQualification;
            $data2->applicant_id       = $last_inserted_id;
            $data2->level_of_education       = Input::get('level_of_education');
            $data2->exam_or_degree_title       = Input::get('exam_or_degree_title');
            $data2->concentration_or_major_or_group       = Input::get('concentration_or_major_or_group');
            $data2->institute_name       = Input::get('institute_name');
            $data2->result       = Input::get('result');
            $data2->year_of_passing       = Input::get('year_of_passing');
            $data2->achievement       = Input::get('achievement');
            $data2->save();

            //Training Summary data insert
            $data3 = new TrainingSummary;
            $data3->applicant_id       = $last_inserted_id;
            $data3->training_title       = Input::get('training_title');
            $data3->ts_institute       = Input::get('ts_institute');
            $data3->ts_location       = Input::get('ts_location');
            $data3->training_year       = Input::get('training_year');
            $data3->save();

            //Professional Qualifications data insert
            $data4 = new ProfessionalSummary;
            $data4->applicant_id       = $last_inserted_id;
            $data4->certification       = Input::get('certification');
            $data4->pq_institute       = Input::get('pq_institute');
            $data4->pq_location       = Input::get('pq_location');
            $data4->pq_from       = Input::get('pq_from');
            $data4->pq_to       = Input::get('pq_to');
            $data4->save();

            //Employment History data insert
            $data5 = new EmploymentSummary;
            $data5->applicant_id       = $last_inserted_id;
            $data5->company_name       = Input::get('company_name');
            $data5->company_location       = Input::get('company_location');
            $data5->position_held       = Input::get('position_held');
            $data5->eh_department       = Input::get('eh_department');
            $data5->eh_responsibilities       = Input::get('eh_responsibilities');
            $data5->eh_from       = Input::get('eh_from');
            $data5->eh_to       = Input::get('eh_to');
            $data5->experience_category       = Input::get('experience_category');
            $data5->skills       = Input::get('skills');
            $data5->save();

            //Employment History data insert
            $data6 = new OtherProfileSummary;
            $data6->applicant_id       = $last_inserted_id;
            $data6->ref_name       = Input::get('ref_name');
            $data6->ref_organization       = Input::get('ref_organization');
            $data6->ref_designation       = Input::get('ref_designation');
            $data6->ref_address       = Input::get('ref_address');
            $data6->ref_phone       = Input::get('ref_phone');
            $data6->ref_email       = Input::get('ref_email');
            $data6->ref_relation       = Input::get('ref_relation');
            $data6->objective       = Input::get('objective');
            $data6->career_summary       = Input::get('career_summary');
            $data6->spacial_qualification       = Input::get('spacial_qualification');
            $data6->save();

            $user_full_name = Input::get('first_name'). ' ' . Input::get('last_name');

            // redirect
            Session::flash('success_message', "<b>$user_full_name</b>'s account has been created");
            return Redirect::to('/admin-panel/applicants');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //applicants
        $applicant = DB::table('applicants')
        ->join('academic_qualifications', 'applicants.id', '=', 'academic_qualifications.applicant_id')
        ->join('employment_summaries', 'applicants.id', '=', 'employment_summaries.applicant_id')
        ->join('professional_summaries', 'applicants.id', '=', 'professional_summaries.applicant_id')
        ->join('other_profile_summaries', 'applicants.id', '=', 'other_profile_summaries.applicant_id')
        ->join('training_summaries', 'applicants.id', '=', 'training_summaries.applicant_id')
        ->where('applicants.id', '=', $id)
        ->first();

        // show the view and pass the user to it
        $this->layout->content = View::make('admin-panel.applicants.show')
            ->with('applicant', $applicant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //applicants
        $applicant = DB::table('applicants')
        ->join('academic_qualifications', 'applicants.id', '=', 'academic_qualifications.applicant_id')
        ->join('employment_summaries', 'applicants.id', '=', 'employment_summaries.applicant_id')
        ->join('professional_summaries', 'applicants.id', '=', 'professional_summaries.applicant_id')
        ->join('other_profile_summaries', 'applicants.id', '=', 'other_profile_summaries.applicant_id')
        ->join('training_summaries', 'applicants.id', '=', 'training_summaries.applicant_id')
        ->where('applicants.id', '=', $id)
        ->first();

        //get other data
        $gender_list = array('' => 'Select') + Gender::lists('name', 'id');
        $maritalstatus_list = array('' => 'Select') + MaritalStatus::lists('name', 'id');


        $this->layout->content = View::make('admin-panel.applicants.edit')
        ->with('applicant', $applicant)
        ->with('gender_list', $gender_list)
        ->with('maritalstatus_list', $maritalstatus_list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required|min:2',
            'last_name'       => 'required|min:2',
            'father_name'       => 'required|min:2',
            'mother_name'       => 'required|min:2',
            'dob'       => 'required|date',
            'gender'       => 'required',
            'marital_status'       => 'required',
            'nationality'       => 'required|max:20',
            'religion'       => 'max:20',
            'email'       => 'required|email|unique:applicants,email,'.$id,
            'alternative_email' => 'email|unique:applicants,alternative_email,'.$id.',id',
            'phone' => 'required|unique:applicants,phone,'.$id.',id',
            'alternative_phone' => 'unique:applicants,alternative_phone,'.$id.',id',
            'address'       => 'required',
            'image' => 'between:1,999|mimes:jpeg,jpg,png'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin-panel/applicants/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store into Applicants table
            Applicant::where('id', $id)->update(
            array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'alternative_email' => Input::get('alternative_email'),
                'ssn' => Input::get('ssn'),
                'phone' => Input::get('phone'),
                'alternative_phone' => Input::get('alternative_phone'),
                'dob' => Input::get('dob'),
                'gender' => Input::get('gender'),
                'marital_status' => Input::get('marital_status'),
                'nationality' => Input::get('nationality'),
                'religion' => Input::get('religion'),
                'father_name' => Input::get('father_name'),
                'mother_name' => Input::get('mother_name'),
                'address' => Input::get('address')
            ));

            //Academic Qualification data insert
            AcademicQualification::where('applicant_id', $id)->update(
            array(
                'level_of_education' => Input::get('level_of_education'),
                'exam_or_degree_title' => Input::get('exam_or_degree_title'),
                'concentration_or_major_or_group' => Input::get('concentration_or_major_or_group'),
                'institute_name' => Input::get('institute_name'),
                'result' => Input::get('result'),
                'year_of_passing' => Input::get('year_of_passing'),
                'achievement' => Input::get('achievement')
            ));

            //Training Summary data insert
            TrainingSummary::where('applicant_id', $id)->update(
            array(
                'training_title' => Input::get('training_title'),
                'ts_institute' => Input::get('ts_institute'),
                'ts_location' => Input::get('ts_location'),
                'training_year' => Input::get('training_year')
            ));

            //Professional Qualifications data insert
            ProfessionalSummary::where('applicant_id', $id)->update(
            array(
                'certification' => Input::get('certification'),
                'pq_institute' => Input::get('pq_institute'),
                'pq_location' => Input::get('pq_location'),
                'pq_from' => Input::get('pq_from'),
                'pq_to' => Input::get('pq_to')
            ));


            //Employment History data insert
            EmploymentSummary::where('applicant_id', $id)->update(
            array(
                'company_name' => Input::get('company_name'),
                'company_location' => Input::get('company_location'),
                'position_held' => Input::get('position_held'),
                'eh_department' => Input::get('eh_department'),
                'eh_responsibilities' => Input::get('eh_responsibilities'),
                'eh_from' => Input::get('eh_from'),
                'eh_to' => Input::get('eh_to'),
                'experience_category' => Input::get('experience_category'),
                'skills' => Input::get('skills')
            ));

            //Employment History data insert
            OtherProfileSummary::where('applicant_id', $id)->update(
            array(
                'ref_name' => Input::get('ref_name'),
                'ref_organization' => Input::get('ref_organization'),
                'ref_designation' => Input::get('ref_designation'),
                'ref_address' => Input::get('ref_address'),
                'ref_phone' => Input::get('ref_phone'),
                'ref_email' => Input::get('ref_email'),
                'ref_relation' => Input::get('ref_relation'),
                'objective' => Input::get('objective'),
                'career_summary' => Input::get('career_summary'),
                'spacial_qualification' => Input::get('spacial_qualification')
            ));


            $user_full_name = Input::get('first_name'). ' ' . Input::get('last_name');
            // redirect
            Session::flash('success_message', "<b>$user_full_name</b>'s Résumé has been updated");
            return Redirect::to('/admin-panel/applicants');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Applicant::destroy($id);
        AcademicQualification::where('applicant_id', '=', $id)->delete();
        TrainingSummary::where('applicant_id', '=', $id)->delete();
        ProfessionalSummary::where('applicant_id', '=', $id)->delete();
        EmploymentSummary::where('applicant_id', '=', $id)->delete();
        OtherProfileSummary::where('applicant_id', '=', $id)->delete();

        // redirect
        Session::flash('success_message', 'Successfully deleted');
        return Redirect::to('/admin-panel/applicants');
    }
}
