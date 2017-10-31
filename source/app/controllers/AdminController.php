<?php
class AdminController extends BaseController {
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
     * Get admin dashboard view with required data.
     *
     * @return Response
     */
    public function getDashboard() {
        //office settings
        $settings = Setting::find(1);

        //Employee attendance data
        $emp_attendance = DB::table('users')
        ->leftJoin('employees', 'users.id', '=', 'employees.user_id')
        ->leftJoin('employee_attendances', function($join)
        {
            $today_date = date('Y-m-d');
            $join->on('users.id', '=', 'employee_attendances.employee_id')
            ->on('employee_attendances.punch_date', '=', DB::raw("'$today_date'"));
        })
        ->where('users.role', '=', 2)
        ->select('users.id', 'employee_attendances.in_time', 'employee_attendances.out_time', 'employees.first_name', 'employees.last_name', 'employees.department_id', 'employees.profile_image')
        ->get();

        //calculate attendance parcentage
        $emp_attendance_data = array();
        $late = 0;
        $present = 0;
        $absent = 0;
        $total_employees = count($emp_attendance);
        foreach($emp_attendance as $key => $value)
        {
            if($value->in_time != '' && $value->in_time <= "$settings->office_hour_start:00")
                $present++;
            elseif($value->in_time > "$settings->office_hour_start:00")
                $late++;
            else $absent++;
        }

        //calculate
        $late = round(($late/$total_employees) * 100);
        $present = round(($present/$total_employees) * 100);
        $absent = round(($absent/$total_employees) * 100);

        //conver to json
        $emp_attendance_data[] = array(
            "d_label" => 'Late',
            "d_rate" => $late
        );
        $emp_attendance_data[] = array(
            "d_label" => 'Present',
            "d_rate" => $present
        );
        $emp_attendance_data[] = array(
            "d_label" => 'Absent',
            "d_rate" => $absent
        );
        $json_output_emp_attendance = json_encode($emp_attendance_data);


        //count department rate
        $emp_departments = DB::table('employees')
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->select('employees.department_id', 'departments.name', DB::raw('count(employees.department_id) as assigned_employees'))
        ->groupBy('departments.name')
        ->get();

        $emp_departments_data = array();
        foreach($emp_departments as $key => $value)
        {
            $dpt_name = $value->name;
            if($dpt_name == '') $dpt_name = 'Not assigned';

            $dpt_parcent = round(($value->assigned_employees/$total_employees) * 100);

            $emp_departments_data[] = array(
                "d_label" => $dpt_name,
                "d_rate" =>  $dpt_parcent
            );
        }
        $json_output_emp_departments = json_encode($emp_departments_data);

        //get  EmployeeEquipment list
        $equipment_list = EmployeeEquipment::where('status', '3')->get();

        //get EmployeeLeave list
        $leave_list = EmployeeLeave::where('status', '3')->get();

        //upcoming interview_schedules list
        $upcoming_is_list = DB::table('interview_schedules')
        ->join('jobs', 'interview_schedules.job_id', '=', 'jobs.id')
        ->where('interview_schedules.interview_date', '>', date('Y-m-d H:i'))
        ->where('interview_schedules.job_status', '=', '0')
        ->select('interview_schedules.id', 'interview_schedules.interview_date', 'jobs.title')
        ->get();

        $this->layout->content = View::make('admin-panel.dashboard')
        ->with('emp_attendance', $emp_attendance)
        ->with('json_output_emp_attendance', $json_output_emp_attendance)
        ->with('json_output_emp_departments', $json_output_emp_departments)
        ->with('equipment_list', $equipment_list)
        ->with('leave_list', $leave_list)
        ->with('upcoming_is_list', $upcoming_is_list)
        ->with('settings', $settings);

    }


    /**
     * Company Info form view
     *
     * @return Response
     */
    public function getCompanyInfo()
    {
        $company_info = CompanyInfo::find(1);

        $this->layout->content =  View::make('admin-panel.company-info.edit')
            ->with('company_info', $company_info);
    }


    /**
     * Post request data from Company Info form and update the fields
     *
     * @return Response
     *
     */
    public function postUpdateCompanyInfo()
    {
        $rules = array(
            'name'       => 'required|min:2|max:50',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/company-info')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $data = CompanyInfo::find(1);
            $data->name       = Input::get('name');
            $data->phone       = Input::get('phone');
            $data->email       = Input::get('email');
            $data->website       = Input::get('website');
            $data->address       = Input::get('address');
            $data->about       = Input::get('about');
            $data->latitude       = Input::get('latitude');
            $data->longitude       = Input::get('longitude');
            $data->save();

            // redirect
            Session::flash('success_message', 'Company info has been updated');
            return Redirect::to('/admin-panel/company-info');
        }
    }


    /**
     * This view panel update the system settings (e.g. Office hour/days, IP mask,
     * Zip code for location based weather report)
     *
     * @return Response
     */
    public function getSettings()
    {
        $settings = Setting::find(1);

        $time_list = array('01' => '1 AM', '02' => '2 AM', '03' => '3 AM', '04' => '4 AM', '05' => '5 AM', '06' => '6 AM', '07' => '7 AM', '08' => '8 AM', '09' => '9 AM', '10' => '10 AM', '11' => '11 AM', '12' => '12 PM', '13' => '1 PM', '14' => '2 PM', '15' => '3 PM', '16' => '4 PM', '17' => '5 PM', '18' => '6 PM', '19' => '7 PM', '20' => '8 PM', '21' => '9 PM', '22' => '10 PM', '23' => '11 PM');

        $weekday_list = array('1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday');

        $temperature_units = array('c' => 'Celsius', 'f' => 'Fahrenheit');

        $this->layout->content =  View::make('admin-panel.settings.edit')
        ->with('settings', $settings)
        ->with('time_list', $time_list)
        ->with('temperature_units', $temperature_units)
        ->with('weekday_list', $weekday_list);
    }


    /**
     * Post request data from settings form and update the fields
     *
     * @return Response
     *
     */
    public function postUpdateSettings()
    {
        $rules = array(
            'office_hour_start' => 'required',
            'office_hour_end' => 'required',
            'office_weekday_start' => 'required',
            'office_weekday_end' => 'required',
            'ip_range' => 'required',
            'weather_zip' => 'required',
            'temperature_units' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/settings')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $data = Setting::find(1);
            $data->office_hour_start       = Input::get('office_hour_start');
            $data->office_hour_end       = Input::get('office_hour_end');
            $data->office_weekday_start       = Input::get('office_weekday_start');
            $data->office_weekday_end       = Input::get('office_weekday_end');
            $data->ip_range       = Input::get('ip_range');
            $data->weather_zip       = Input::get('weather_zip');
            $data->temperature_units       = Input::get('temperature_units');
            $data->save();

            // redirect
            Session::flash('success_message', 'Settings has been updated');
            return Redirect::to('/admin-panel/settings');
        }
    }


    /**
     * Here admins arrange job interview and give their feedback
     *
     * @return Response
     */
    public function getInterviewBoard($id) {

        $ib = InterviewBoard::where('interview_schedule_id', $id)->where('interview_by', Auth::user()->id)->first();

        if(!$ib) {
            Session::flash('error_message', 'You are not an interview board member for this interview');
            return Redirect::to('/admin-panel/interview-schedules');
        }

        $applicant_selected = ($ib->selected == 1) ? true : null;
        $job_accepted = ($ib->accepted == 1) ? true : null;

        //print_r($ib);
        $this->layout->content = View::make('admin-panel.interview_schedules.interview_board.index')
        ->with('interview_board', $ib)
        ->with('applicant_selected', $applicant_selected)
        ->with('job_accepted', $job_accepted);
    }


    /**
     * Update Interview Board data
     *
     * @return Response
     */
    public function postUpdateInterviewBoard() {

        $rules = array(
            'marks'       => 'integer|between:0,100'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::table('interview_boards')
                ->where('interview_schedule_id', Input::get('interview_schedule_id'))
                ->where('interview_by', Auth::user()->id)
                ->update(array(
                    'selected' => Input::get('applicant_selected'),
                    'accepted' => Input::get('job_accepted'),
                    'marks' => Input::get('marks'),
                    'comment' => Input::get('comment')
                    ));


            Session::flash('success_message', 'Interview has been completed');
            return Redirect::to('/admin-panel/interview-schedules');
        }

    }


    /**
     * Here admin review and approve/reject Employee Leave List which is
     * generated by Employees
     *
     * @return Response
     */
    public function getEmployeeLeaveList() {
        $leave_list = EmployeeLeave::orderBy('id', 'desc')->get();

        $this->layout->content = View::make('admin-panel.employee-leave.index')
            ->with('leave_list', $leave_list);
    }


    /**
     * Employee Leave approve/reject form view for admin
     *
     * @return Response
     */
    public function getModerateEmployeeLeave($id)  {
        $leave = EmployeeLeave::find($id);

        $this->layout->content = View::make('admin-panel.employee-leave.moderate')
            ->with('leave', $leave);
    }


    /**
     * Update Employee Leave review status
     *
     * @return Response
     */
    public function postUpdateModerateEmployeeLeave() {
        $rules = array(
            'status'       => 'required',
            'comment'       => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $leave = EmployeeLeave::find(Input::get('leave_id'));
            $leave->status       = Input::get('status');
            $leave->moderated_by       = Input::get('moderated_by');
            $leave->moderator_comment       = Input::get('comment');
            $leave->save();

            $f_msg = 'Employee leave request has been rejected';
            if(Input::get('status') == 1) $f_msg = 'Employee leave request has been approved';

            Session::flash('success_message', $f_msg);
            return Redirect::to('/admin-panel/employee-leave-list');
        }
    }


    /**
     * Here admin review and approve/reject Employee Equipment List which is
     * generated by Employees
     *
     * @return Response
     */
    public function getEmployeeEquipmentList() {
        $equipment_list = EmployeeEquipment::orderBy('id', 'desc')->get();

        $this->layout->content = View::make('admin-panel.employee-equipments.index')
            ->with('equipment_list', $equipment_list);
    }


    /**
     * Employee Equipment approve/reject form view for admin
     *
     * @return Response
     */
    public function getModerateEmployeeEquipment($id)  {
        $equipment = EmployeeEquipment::find($id);

        $this->layout->content = View::make('admin-panel.employee-equipments.moderate')
            ->with('equipment', $equipment);
    }


    /**
     * Update Employee Equipment review status
     *
     * @return Response
     */
    public function postUpdateModerateEmployeeEquipment() {
        $rules = array(
            'status'       => 'required',
            'comment'       => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $equipment = EmployeeEquipment::find(Input::get('equipment_id'));
            $equipment->status       = Input::get('status');
            $equipment->moderated_by       = Input::get('moderated_by');
            $equipment->moderator_comment       = Input::get('comment');
            $equipment->save();

            $f_msg = 'Employee equipment request has been rejected';
            if(Input::get('status') == 1) $f_msg = 'Employee equipment request has been approved';

            Session::flash('success_message', $f_msg);
            return Redirect::to('/admin-panel/employee-equipment-list');
        }
    }


    /**
     * Show Admin profile
     *
     * @return Response
     */
    public function getMyProfile() {
        //admins
        $admin = DB::table('users')
        ->join('admins', 'users.id', '=', 'admins.user_id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        // show the view and pass the user to it
        $this->layout->content = View::make('admin-panel.profile')
            ->with('admin', $admin);
    }


    /**
     * Reset Account Access form view. If any users forget their login
     * cradentials, admin reset that from this panel.
     *
     * @return Response
     */
    public function getResetAccountAccess($id)  {
        $user = User::find($id);

        $account_type = 'admins';
        if($user->role == 2) $account_type = 'employees';

        $this->layout->content = View::make('admin-panel.reset-account-access')
            ->with('user', $user)
            ->with('account_type', $account_type);
    }


    /**
     * Post request to update reset-account-access data
     *
     * @return Response
     */
    public function postUpdateAccountAccess()  {
        $id = Input::get('user_id');
        $rules = array(
            'email'       => 'required|email|unique:users,email,'.$id.',id',
            'password'       => 'required|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find($id);
            $user->email       = Input::get('email');
            $user->password       = Hash::make(Input::get('password'));
            $user->save();

            $user_email = Input::get('email');

            // redirect
            Session::flash('success_message', "<b>$user_email</b>'s account access has been reset");
            return Redirect::to('/admin-panel/'.Input::get('account_type'));
        }
    }


    /**
     * In this panel admin have access to approve job application after interview
     *
     * @return Response
     */
    public function getApproveJobApplication($id)  {
        $interview_schedule = InterviewSchedule::find($id);
        $job = Job::find($interview_schedule->job_id);
        $applicant = Applicant::find($interview_schedule->applicant_id);

        $department_list = array('' => 'Select') + Department::lists('name', 'id');

        $this->layout->content = View::make('admin-panel.interview_schedules.approve_job_application')
            ->with('interview_schedule', $interview_schedule)
            ->with('job', $job)
            ->with('applicant', $applicant)
            ->with('department_list', $department_list);
    }


    /**
     * Post request to update "approve job application"
     *
     * @return Response
     */
    public function postUpdateApproveJobApplication()  {
        $id = Input::get('interview_schedule_id');
        $rules = array(
            'department_id'       => 'required',
            'designation'       => 'required',
            'employee_id'       => 'required',
            'joining_date'       => 'required',
            'email'       => 'required|email|unique:users,email',
            'password'       => 'required|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $applicant_id = Input::get('applicant_id');

            // get the $applicant data
            $applicant = Applicant::find($applicant_id);

            // store into users table
            $user = new User;
            $user->email       = Input::get('email');
            $user->password       = Hash::make(Input::get('password'));
            $user->role       = '2';
            $user->save();

            $last_inserted_id = $user->id;

            // store into Employees table
            $data = new Employee;
            $data->user_id       = $last_inserted_id;
            $data->first_name       = $applicant->first_name;
            $data->last_name       = $applicant->last_name;
            $data->main_email       = $applicant->email;
            $data->alternative_email       = $applicant->alternative_email;
            $data->ssn       = $applicant->ssn;
            $data->phone       = $applicant->phone;
            $data->alternative_phone       = $applicant->alternative_phone;
            $data->dob       = $applicant->dob;
            $data->gender       = $applicant->gender;
            $data->marital_status       = $applicant->marital_status;
            $data->nationality       = $applicant->nationality;
            $data->religion       = $applicant->religion;

            $data->father_name       = $applicant->father_name;
            $data->mother_name       = $applicant->mother_name;
            $data->address       = $applicant->address;

            $data->employee_id       = Input::get('employee_id');
            $data->department_id       = Input::get('department_id');
            $data->designation       = Input::get('designation');
            $data->joining_date       = Input::get('joining_date');

            $data->profile_image       = $applicant->profile_image;
            $data->save();

            //Academic Qualification data insert
            AcademicQualification::where('applicant_id', $applicant_id)->update(
            array(
                'user_id' => $last_inserted_id
            ));

            //Training Summary data insert
            TrainingSummary::where('applicant_id', $applicant_id)->update(
            array(
                'user_id' => $last_inserted_id
            ));

            //Professional Qualifications data insert
            ProfessionalSummary::where('applicant_id', $applicant_id)->update(
            array(
                'user_id' => $last_inserted_id
            ));

            //Employment History data insert
            EmploymentSummary::where('applicant_id', $applicant_id)->update(
            array(
                'user_id' => $last_inserted_id
            ));

            //Employment History data insert
            OtherProfileSummary::where('applicant_id', $applicant_id)->update(
            array(
                'user_id' => $last_inserted_id
            ));

            //Update job status
            $interview_schedule = InterviewSchedule::find($id);
            $interview_schedule->job_status       = '1';
            $interview_schedule->save();


            $user_fullname = $applicant->first_name . ' ' . $applicant->last_name;
            // redirect
            Session::flash('success_message', "<b>$user_fullname</b>'s job application has been approved and new employee account has been created");

            return Redirect::to('/admin-panel/interview-schedules');
        }
    }


    /**
     * In this panel admin have access to reject job application after interview
     *
     * @return Response
     */
    public function getRejectJobApplication($id)  {
        $interview_schedule = InterviewSchedule::find($id);

        $job = Job::find($interview_schedule->job_id);
        $applicant = Applicant::find($interview_schedule->applicant_id);

        $this->layout->content = View::make('admin-panel.interview_schedules.reject_job_application')
            ->with('interview_schedule', $interview_schedule)
            ->with('job', $job)
            ->with('applicant', $applicant);
    }


    /**
     * Post request to update "reject job application"
     *
     * @return Response
     */
    public function postUpdateRejectJobApplication()  {
        $id = Input::get('interview_schedule_id');
        $rules = array(
            'reason'       => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            //Update job status
            $interview_schedule = InterviewSchedule::find($id);
            $interview_schedule->job_status       = '2';
            $interview_schedule->reason       = Input::get('reason');
            $interview_schedule->save();

            // get the $applicant data
            $applicant_id = Input::get('applicant_id');
            $applicant = Applicant::find($applicant_id);

            $user_fullname = $applicant->first_name . ' ' . $applicant->last_name;
            // redirect
            Session::flash('success_message', "<b>$user_fullname</b>'s job application has been rejected");

            return Redirect::to('/admin-panel/interview-schedules');
        }
    }


}
