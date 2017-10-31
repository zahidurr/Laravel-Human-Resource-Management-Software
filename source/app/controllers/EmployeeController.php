<?php
class EmployeeController extends BaseController {

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
     * 'employee' filter checks for user is employee or not
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth');
        $this->beforeFilter('employee');
    }

    /**
     * Display a listing of the resource for Employee dashboard
     *
     * @return Response
     */
    public function getDashboard() {
        $user_id = Auth::user()->id;

        $settings = Setting::find(1);

        $weekday_list = array('1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday');

        //employees
        $employee = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->where('users.id', '=', $user_id)
        ->first();

        //Employee attendance data
        $emp_attendance = EmployeeAttendance::where('employee_id', '=', $user_id)
        ->where('punch_month', '=', date('F Y'))
        ->get();

        //calculate attendance parcentage
        $month_days = date('j');
        $emp_attendance_data = array();
        $late = 0;
        $present = 0;
        $absent = $month_days - count($emp_attendance);
        foreach($emp_attendance as $key => $value)
        {
            if($value->in_time != '' && $value->in_time <= "$settings->office_hour_start:00")
                $present++;
            elseif($value->in_time > "$settings->office_hour_start:00")
                $late++;
            else $absent++;
        }


        //calculate
        $late = round(($late/$month_days) * 100);
        $present = round(($present/$month_days) * 100);
        $absent = round(($absent/$month_days) * 100);

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


        //get  EmployeeEquipment list
        $equipment_list = EmployeeEquipment::where('employee_id', $user_id)
        ->where(function ($query) {
            $old_days = date('Y-m-d', strtotime('-7 day'));
            $query->where('status', '=', 3)
                  ->orWhere('created_at', '>', $old_days);
        })
        ->orderBy('status', 'desc')
        ->get();

        //get EmployeeLeave list
        $leave_list = EmployeeLeave::where('employee_id', $user_id)
        ->where(function ($query) {
            $old_days = date('Y-m-d', strtotime('-7 day'));
            $query->where('status', '=', 3)
                  ->orWhere('created_at', '>', $old_days);
        })
        ->orderBy('status', 'desc')
        ->get();

        //get my groups list
        $group_list = DB::table('groups')
        ->join('group_members', 'groups.id', '=', 'group_members.group_id')
        ->select('groups.id', 'groups.name', 'groups.description')
        ->where('group_members.user_id', $user_id)
        ->get();

        //return output
        $this->layout->content = View::make('employee-panel.dashboard')
        ->with('settings', $settings)
        ->with('employee', $employee)
        ->with('json_output_emp_attendance', $json_output_emp_attendance)
        ->with('weekday_list', $weekday_list)
        ->with('leave_list', $leave_list)
        ->with('equipment_list', $equipment_list)
        ->with('group_list', $group_list);
    }

    /**
     * Display a listing of the resource of Employee profile
     *
     * @return Response
     */
    public function getMyProfile() {

        //query employee info
        $employee = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->join('academic_qualifications', 'users.id', '=', 'academic_qualifications.user_id')
        ->join('employment_summaries', 'users.id', '=', 'employment_summaries.user_id')
        ->join('professional_summaries', 'users.id', '=', 'professional_summaries.user_id')
        ->join('other_profile_summaries', 'users.id', '=', 'other_profile_summaries.user_id')
        ->join('training_summaries', 'users.id', '=', 'training_summaries.user_id')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $this->layout->content = View::make('employee-panel.profile')
        ->with('employee', $employee);
    }

    /**
     * Display a listing of the resource of Employee Attendance
     *
     * @return Response
     */
    public function getAttendanceDetails() {
        $monthly_attendance = isset($_GET['monthly_attendance']) ? $_GET['monthly_attendance'] : date('F Y');

        $monthly_full_date = array();
        $monthly_in_time = array();
        $monthly_out_time = array();

        $month_days = date('t', strtotime($monthly_attendance));
        //if running month then set current day
        if($monthly_attendance == date('F Y')) $month_days = date('j');

        for($i=1; $i<=$month_days; $i++)
        {
            $monthly_full_date[$i] = $i.$monthly_attendance;
            $monthly_in_time[$i] = '';
            $monthly_out_time[$i] = '';
        }

        $my_attendance = DB::table('employee_attendances')
        ->where('employee_id', '=', Auth::user()->id)
        ->where('punch_month', '=', $monthly_attendance)
        ->get();

        foreach($my_attendance as $key => $value)
        {
            $monthly_in_time[date("j", strtotime($value->punch_date))] = $value->in_time;
            $monthly_out_time[date("j", strtotime($value->punch_date))] = $value->out_time;
        }

        //monthly_attendance option
        $monthly_attendance_options = DB::table('employee_attendances')
        ->groupBy('punch_month')
        ->where('employee_id', '=', Auth::user()->id)
        ->orderBy('punch_date', 'desc')
        ->lists('punch_month', 'punch_month');

        //office settings
        $settings = Setting::find(1);

        $this->layout->content = View::make('employee-panel.attendance.details')
        ->with('monthly_full_date', $monthly_full_date)
        ->with('monthly_in_time', $monthly_in_time)
        ->with('monthly_out_time', $monthly_out_time)
        ->with('monthly_attendance_options', $monthly_attendance_options)
        ->with('monthly_attendance', $monthly_attendance)
        ->with('month_days', $month_days)
        ->with('settings', $settings);
    }
}
