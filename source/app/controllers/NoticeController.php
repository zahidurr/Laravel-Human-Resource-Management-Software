<?php

class NoticeController extends \BaseController {
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

        $notices = Notice::where('end_date', '>=', date('Y-m-d'))->get();

        $this->layout->content = View::make('admin-panel.notices.index')
            ->with('notices', $notices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = Group::lists('name', 'id');

        $this->layout->content = View::make('admin-panel.notices.create')->with('viewers', $groups);
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
            'viewers' => 'required',
            'description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/notices/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $notice = new Notice;
            $notice->title       = Input::get('title');
            $notice->description       = Input::get('description');
            $notice->start_date       = Input::get('start_date');
            $notice->end_date       = Input::get('end_date');
            $notice->created_by       = Input::get('created_by');
            $notice->save();

            $last_inserted_id = $notice->id;

            //Get assigned user list
            $assigned_to = Input::get('viewers');

            //make insertion array
            $insert_data = array();
            foreach ($assigned_to as $key => $value)
            {
                $insert_data[] = array (
                    'notice_id' => $last_inserted_id,
                    'group_id' => $value
                );
            }

            //Insert data into
            NoticeViewer::insert(
                $insert_data
            );

            //flash message
            $title = Input::get('title');
            Session::flash('success_message', "<b>$title</b> has been created");
            // redirect
            return Redirect::to('/admin-panel/notices');
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

        $notice = Notice::find($id);

        $groups = DB::table('groups')
        ->leftJoin('notice_viewers', 'groups.id', '=', 'notice_viewers.group_id')
        ->where('notice_viewers.notice_id', $id)
        ->get();

        $this->layout->content = View::make('admin-panel.notices.show')
            ->with('notice', $notice)
            ->with('groups', $groups);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $groups = Group::lists('name', 'id');

        $notice_viewers = NoticeViewer::where('notice_id', '=', $id)->lists('group_id', 'group_id');

        $notice = Notice::find($id);

        $this->layout->content = View::make('admin-panel.notices.edit')
        ->with('notice', $notice)
        ->with('notice_viewers', $notice_viewers)
        ->with('viewers', $groups);

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
            'viewers' => 'required',
            'description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/admin-panel/notices/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $notice = Notice::find($id);
            $notice->title       = Input::get('title');
            $notice->description       = Input::get('description');
            $notice->start_date       = Input::get('start_date');
            $notice->end_date       = Input::get('end_date');
            $notice->save();

            //delete old records
            NoticeViewer::where('notice_id', '=', $id)->delete();

            //Get assigned user list
            $assigned_to = Input::get('viewers');

            //make insertion array
            $insert_data = array();
            foreach ($assigned_to as $key => $value)
            {
                $insert_data[] = array (
                    'notice_id' => $id,
                    'group_id' => $value
                );
            }

            //Insert data into
            NoticeViewer::insert(
                $insert_data
            );

            //flash message
            $title = Input::get('title');
            Session::flash('success_message', "<b>$title</b> has been updated");
            // redirect
            return Redirect::to('/admin-panel/notices');
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
        $notice = Notice::find($id);
        $notice->delete();

        //delete old records
        NoticeViewer::where('notice_id', '=', $id)->delete();

        // redirect
        Session::flash('success_message', "Successfully deleted");
        return Redirect::to('/admin-panel/notices');
    }

}
