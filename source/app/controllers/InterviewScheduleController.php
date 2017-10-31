<?php

class InterviewScheduleController extends \BaseController {
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
        $upcoming_list = DB::table('interview_schedules')
        ->join('applicants', 'interview_schedules.applicant_id', '=', 'applicants.id')
        ->join('jobs', 'interview_schedules.job_id', '=', 'jobs.id')
        ->where('interview_schedules.interview_date', '>', date('Y-m-d H:i'))
        ->where('interview_schedules.job_status', '=', '0')
        ->select('interview_schedules.id', 'interview_schedules.applicant_id', 'interview_schedules.job_id', 'interview_schedules.interview_date', 'applicants.first_name', 'applicants.last_name', 'jobs.title')
        ->get();

        $approved_list = DB::table('interview_schedules')
        ->join('applicants', 'interview_schedules.applicant_id', '=', 'applicants.id')
        ->join('jobs', 'interview_schedules.job_id', '=', 'jobs.id')
        ->where('interview_schedules.job_status', '=', '1')
        ->select('interview_schedules.id', 'interview_schedules.applicant_id', 'interview_schedules.job_id', 'interview_schedules.interview_date', 'applicants.first_name', 'applicants.last_name', 'jobs.title')
        ->get();

        $rejected_list = DB::table('interview_schedules')
        ->join('applicants', 'interview_schedules.applicant_id', '=', 'applicants.id')
        ->join('jobs', 'interview_schedules.job_id', '=', 'jobs.id')
        ->where('interview_schedules.job_status', '=', '2')
        ->select('interview_schedules.id', 'interview_schedules.applicant_id', 'interview_schedules.job_id', 'interview_schedules.interview_date', 'applicants.first_name', 'applicants.last_name', 'jobs.title')
        ->get();

        $inactive_list = DB::table('interview_schedules')
        ->join('applicants', 'interview_schedules.applicant_id', '=', 'applicants.id')
        ->join('jobs', 'interview_schedules.job_id', '=', 'jobs.id')
        ->where('interview_schedules.interview_date', '<', date('Y-m-d H:i'))
        ->where('interview_schedules.job_status', '=', '0')
        ->select('interview_schedules.id', 'interview_schedules.applicant_id', 'interview_schedules.job_id', 'interview_schedules.interview_date', 'applicants.first_name', 'applicants.last_name', 'jobs.title')
        ->get();

        $this->layout->content = View::make('admin-panel.interview_schedules.index')
        ->with('upcoming_list', $upcoming_list)
        ->with('approved_list', $approved_list)
        ->with('rejected_list', $rejected_list)
        ->with('inactive_list', $inactive_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $jobs = array('' => 'Select') + Job::lists('title', 'id');

        //make applicant list
        $applicant_list = array('' => 'Select');

        $applicants = Applicant::all();
        foreach($applicants as $key => $value)
        {
            $applicant_list[$value->id] = $value->first_name . ' ' . $value->last_name;
        }

        //make board members list
        $board_members_list = array();

        $board_members = Admin::all();
        foreach($board_members as $key => $value)
        {
            $board_members_list[$value->user_id] = $value->first_name . ' ' . $value->last_name;
        }

        $this->layout->content = View::make('admin-panel.interview_schedules.create')
        ->with('jobs', $jobs)
        ->with('applicants', $applicant_list)
        ->with('board_members', $board_members_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $date_now = date('Y-m-d');
        $rules = array(
            'job'       => 'required',
            'applicant'       => 'required|unique:interview_schedules,applicant_id,NULL,id,job_id,'.Input::get('job'),
            'interview_schedule'       => 'required|date|after:'.$date_now,
            'board_members'       => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $data = new InterviewSchedule;
            $data->applicant_id       = Input::get('applicant');
            $data->job_id       = Input::get('job');
            $data->interview_date       = Input::get('interview_schedule');
            $data->save();

            $last_inserted_id = $data->id;

            //Get assigned members list
            $members = Input::get('board_members');

            //make insertion array
            $insert_data = array();
            foreach ($members as $key => $value)
            {
                $insert_data[] = array (
                    'interview_schedule_id' => $last_inserted_id,
                    'interview_by' => $value
                );
            }

            //Insert data into
            InterviewBoard::insert(
                $insert_data
            );

            // redirect
            Session::flash('success_message', "New interview schedule has been created");
            return Redirect::to('/admin-panel/interview-schedules');
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

        $interview_schedule = InterviewSchedule::find($id);
        $job = Job::find($interview_schedule->job_id);
        $applicant = Applicant::where('id', '=', $interview_schedule->applicant_id)->first();

        $board_members = DB::table('interview_boards')
        ->join('admins', 'interview_boards.interview_by', '=', 'admins.user_id')
        ->where('interview_boards.interview_schedule_id', '=', $id)
        ->select('admins.first_name', 'admins.last_name', 'interview_boards.selected', 'interview_boards.accepted', 'interview_boards.marks', 'interview_boards.comment')
        ->get();

        //count total interview marks
        $total_marks = 0;
        $applicant_selected_count = 0;
        $job_accepted_count = 0;
        foreach($board_members as $value)
        {
            $total_marks += $value->marks;

            if($value->selected == 1) $applicant_selected_count += 1;
            if($value->accepted == 1) $job_accepted_count += 1;
        }

        $this->layout->content = View::make('admin-panel.interview_schedules.show')
            ->with('interview_schedule', $interview_schedule)
            ->with('job', $job)
            ->with('applicant', $applicant)
            ->with('board_members', $board_members)
            ->with('total_marks', $total_marks)
            ->with('applicant_selected_count', $applicant_selected_count)
            ->with('job_accepted_count', $job_accepted_count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $interview_schedule = InterviewSchedule::find($id);
        $interview_board = InterviewBoard::where('interview_schedule_id', '=', $id)->lists('interview_by', 'interview_by');

        $jobs = array('' => 'Select') + Job::lists('title', 'id');

        //make applicant list
        $applicant_list = array('' => 'Select');

        $applicants = Applicant::all();
        foreach($applicants as $key => $value)
        {
            $applicant_list[$value->id] = $value->first_name . ' ' . $value->last_name;
        }

        //make board members list
        $board_members_list = array();

        $board_members = Admin::all();
        foreach($board_members as $key => $value)
        {
            $board_members_list[$value->user_id] = $value->first_name . ' ' . $value->last_name;
        }

        $this->layout->content = View::make('admin-panel.interview_schedules.edit')
        ->with('interview_schedule', $interview_schedule)
        ->with('interview_board', $interview_board)
        ->with('jobs', $jobs)
        ->with('applicants', $applicant_list)
        ->with('board_members', $board_members_list);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {


        $date_now = date('Y-m-d');
        $rules = array(
            'job'       => 'required',

            'interview_schedule'       => 'required|date|after:'.$date_now,
            'board_members'       => 'required'
        );

        //check for same data or new data
        $data_count = InterviewSchedule::where('id', '=', $id)->where('applicant_id', '=', Input::get('applicant'))->where('job_id', '=', Input::get('job'))->count();
        if($data_count < 1) {
            $rules['applicant'] = 'required|unique:interview_schedules,applicant_id,NULL,id,job_id,'.Input::get('job');
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $data = InterviewSchedule::find($id);
            $data->applicant_id       = Input::get('applicant');
            $data->job_id       = Input::get('job');
            $data->interview_date       = Input::get('interview_schedule');
            $data->save();

            //delete old records
            InterviewBoard::where('interview_schedule_id', '=', $id)->delete();

            //Get assigned members list
            $members = Input::get('board_members');

            //make insertion array
            $insert_data = array();
            foreach ($members as $key => $value)
            {
                $insert_data[] = array (
                    'interview_schedule_id' => $id,
                    'interview_by' => $value
                );
            }

            //Insert data into
            InterviewBoard::insert(
                $insert_data
            );

            // redirect
            Session::flash('success_message', "Interview schedule has been updated");
            return Redirect::to('/admin-panel/interview-schedules');
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
        // delete
        $interviewschedule = InterviewSchedule::find($id);
        $interviewschedule->delete();

        //delete old records
        InterviewBoard::where('interview_schedule_id', '=', $id)->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/admin-panel/interview-schedules');
    }

}
