<?php

class JobController extends \BaseController {
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

        $jobs = Job::all();
        $interview_schedules = InterviewSchedule::lists('job_id', 'job_id');


        $this->layout->content = View::make('admin-panel.jobs.index')
            ->with('jobs', $jobs)
            ->with('interview_schedules', $interview_schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('admin-panel.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $date_now = date('Y-m-d', strtotime('-1 days'));
        $rules = array(
            'title'       => 'required|min:2|max:50',
            'start_date' => 'required|date|date_format:"Y-m-d"|after:'.$date_now,
            'end_date' => 'required|date|date_format:"Y-m-d"|after:start_date',
            'salary_range' => 'required|max:30',
            'experience_requirements' => 'required|max:50',
            'educational_requirements' => 'required|max:100',
            'no_of_vacancies' => 'required|numeric|max:9',
            'job_nature' => 'required|max:20',
            'additional_requirements' => 'required',
            'description' => 'required',
            'other_benefits' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/jobs/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $job = new Job;
            $job->title       = Input::get('title');
            $job->start_date       = Input::get('start_date');
            $job->end_date       = Input::get('end_date');
            $job->salary_range       = Input::get('salary_range');
            $job->experience_requirements       = Input::get('experience_requirements');
            $job->educational_requirements       = Input::get('educational_requirements');
            $job->no_of_vacancies       = Input::get('no_of_vacancies');
            $job->job_nature       = Input::get('job_nature');
            $job->additional_requirements       = Input::get('additional_requirements');
            $job->description       = Input::get('description');
            $job->other_benefits       = Input::get('other_benefits');
            $job->created_by       = Input::get('created_by');
            $job->save();

            //flash message
            $title = Input::get('title');
            Session::flash('success_message', "<b>$title</b> has been created");
            // redirect
            return Redirect::to('/admin-panel/jobs');
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

        $job = Job::find($id);

        $this->layout->content = View::make('admin-panel.jobs.show')
            ->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        $this->layout->content = View::make('admin-panel.jobs.edit')
        ->with('job', $job);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $date_now = date('Y-m-d', strtotime('-1 days'));

        $rules = array(
            'title'       => 'required|min:2|max:50',
            'start_date' => 'required|date|date_format:"Y-m-d"|after:'.$date_now,
            'end_date' => 'required|date|date_format:"Y-m-d"|after:start_date',
            'salary_range' => 'required|max:30',
            'experience_requirements' => 'required|max:50',
            'educational_requirements' => 'required|max:100',
            'no_of_vacancies' => 'required|numeric|max:9',
            'job_nature' => 'required|max:20',
            'additional_requirements' => 'required',
            'description' => 'required',
            'other_benefits' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/jobs/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $job = Job::find($id);
            $job->title       = Input::get('title');
            $job->start_date       = Input::get('start_date');
            $job->end_date       = Input::get('end_date');
            $job->salary_range       = Input::get('salary_range');
            $job->experience_requirements       = Input::get('experience_requirements');
            $job->educational_requirements       = Input::get('educational_requirements');
            $job->no_of_vacancies       = Input::get('no_of_vacancies');
            $job->job_nature       = Input::get('job_nature');
            $job->additional_requirements       = Input::get('additional_requirements');
            $job->description       = Input::get('description');
            $job->other_benefits       = Input::get('other_benefits');
            $job->save();

            //flash message
            $title = Input::get('title');
            Session::flash('success_message', "<b>$title</b> has been updated");
            // redirect
            return Redirect::to('/admin-panel/jobs');
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
        $job = Job::find($id);
        $job->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/admin-panel/jobs');
    }

}
