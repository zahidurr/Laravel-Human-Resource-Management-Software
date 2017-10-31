<?php

class AjaxControllerEmployee extends BaseController {

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
     * Shows unread Notice Notifications number
     *
     * @return Response
     */
    public function getNoticeNotifications() {
        $unn = $this->totalUnreadNotices();

        return View::make('employee-panel.ajax.notice_notifications')
                ->with('total_unread_notices', $unn);
    }

    /**
     * Shows all current Notices
     *
     * @return Response
     */
    public function getShowNotices() {
        $my_notices = $this->showNotices();

        return View::make('employee-panel.ajax.show_notices')
                ->with('notices', $my_notices[0])
                ->with('notices_count', $my_notices[1]);
    }

    /**
     * Counts total unread notices
     *
     * @return int
     */

    public function totalUnreadNotices() {
        $user_id = Auth::user()->id;

        $last_seen_at = DB::table('notifications')->where('user_id', $user_id)->pluck('notice_last_seen_at');

        $notices = DB::table('notices')
        ->leftJoin('notice_viewers', 'notices.id', '=', 'notice_viewers.notice_id')
        ->leftJoin('group_members', 'notice_viewers.group_id', '=', 'group_members.group_id')
        ->where('group_members.user_id', '=', $user_id)
        ->groupBy('notices.id')
        ->orderBy('notices.id', 'DESC')
        ->select('notices.id', 'notices.start_date', 'notices.end_date', 'notices.updated_at')
        ->get();

        $time_now = date('Y-m-d');
        $notice_count = 0;
        foreach($notices as $key => $value)
        {
            $start_date = $value->start_date;
            $end_date = $value->end_date;

            if($start_date <= $time_now && $end_date >= $time_now) {

                //skip read notification
                if($value->updated_at < $last_seen_at) continue;

                $notice_count++;
            }

        }

        //return unread notices count
        return $notice_count;
    }


    /**
     * Shows available notices
     *
     * @return Array
     */
    public function showNotices() {
        $user_id = Auth::user()->id;

        //get data
        $my_notices = DB::table('notices')
        ->leftJoin('notice_viewers', 'notices.id', '=', 'notice_viewers.notice_id')
        ->leftJoin('group_members', 'notice_viewers.group_id', '=', 'group_members.group_id')
        ->where('group_members.user_id', '=', $user_id)
        ->groupBy('notices.id')
        ->orderBy('notices.id', 'DESC');

        //data type
        $notice_list = $my_notices->get();
        $notice_count = count($notice_list);

        //set notification as read
        $notification = Notification::firstOrCreate(array('user_id' => $user_id));

        $affectedRows = Notification::where('user_id', '=', $user_id)->update(array('notice_last_seen_at' => date('Y-m-d H:i:s') ));

        //return data
        return array($notice_list, $notice_count);
    }

    /**
     * Attendance Punch In view. Validate Punch in. Also stores punch in time. Shows json_encode data for
     * javascript codes
     *
     * @return void
     */
    public function getPunchIn() {
        $settings = Setting::find(1);
        $ip_range = $settings->ip_range;

        $client_ip = $this->getClientIP();

        $success = false;
        $message = '
            <div class="alert alert-error">
                <button class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-exclamation-triangle"></i> It looks like you are out of office. You can not punch in right now :)
            </div>';


        if($ip_range == 'localhost' || $this->isIPMatched($ip_range, $client_ip)) {

            $user_id = Auth::user()->id;

            $size = EmployeeAttendance::employee($user_id)->punchDate()->count();
            if($size < 1) {
                $attendance = new EmployeeAttendance;
                $attendance->employee_id       = $user_id;
                $attendance->punch_month       = date('F Y');
                $attendance->punch_date       = date('Y-m-d');
                $attendance->in_time       = date('H:i');
                $attendance->punch_type       = 'I';
                $attendance->save();
            } else {
                $attendance = EmployeeAttendance::employee($user_id)->punchDate()->update(array('punch_type' => 'I'));
            }

            $success = true;
            $message = '';
        }


        $output = array(
        	"success" => $success,
        	"message" => $message
        );

        echo json_encode($output);

    }

    /**
     * Attendance Punch out view. Also stores punch out time.
     * Shows json_encode data for javascript codes
     *
     * @return void
     */
    public function getPunchOut() {
        $user_id = Auth::user()->id;

        $size = EmployeeAttendance::employee($user_id)->punchDate()->count();
        if($size > 0) {
            $attendance = EmployeeAttendance::employee($user_id)->punchDate()->update(array('out_time' => date('H:i'), 'punch_type' => 'O'));
        }

    }


    /**
     * Set Attendance  Punch Button type, if page reloaded.
     *
     * @return void
     */
    public function getSetPunchButton() {
        $user_id = Auth::user()->id;

        $attendance = EmployeeAttendance::employee($user_id)->punchDate()->first();

        if($attendance)
            echo $attendance->punch_type;

    }


    /**
     * Shows Weather Forecast for employee dashboard
     *
     * @return void
     */
    public function getWeatherForecast() {
        echo App::make('UtilController')->showWeather();
    }


    /**
     * Checks user IP range according to Settings
     *
     * @return bool
     */
    public function isIPMatched ($network, $ip) {
        $network = trim($network);

        $orig_network = $network;
        $ip = trim($ip);

        if ($ip == $network) {
            //echo "used network ($network) for ($ip)\n";
            return TRUE;
        }

        $network = str_replace(' ', '', $network);

        if (strpos($network, '*') !== FALSE) {
            if (strpos($network, '/') !== FALSE) {
                $asParts = explode('/', $network);
                $network = @ $asParts[0];
            }
            $nCount = substr_count($network, '*');
            $network = str_replace('*', '0', $network);
            if ($nCount == 1) {
                $network .= '/24';
            } else if ($nCount == 2) {
                $network .= '/16';
            } else if ($nCount == 3) {
                $network .= '/8';
            } else if ($nCount > 3) {
                return TRUE; // if *.*.*.*, then all, so matched
            }
        }

        //echo "from original network($orig_network), used network ($network) for ($ip)\n";

        $d = strpos($network, '-');

        if ($d === FALSE) {
            $ip_arr = explode('/', $network);
            if (!preg_match("@\d*\.\d*\.\d*\.\d*@", $ip_arr[0], $matches)){
                $ip_arr[0].=".0";    // Alternate form 194.1.4/24
            }
            $network_long = ip2long($ip_arr[0]);
            $x = ip2long($ip_arr[1]);
            $mask = long2ip($x) == $ip_arr[1] ? $x : (0xffffffff << (32 - $ip_arr[1]));
            $ip_long = ip2long($ip);

            return ($ip_long & $mask) == ($network_long & $mask);
        } else {
            $from = trim(ip2long(substr($network, 0, $d)));
            $to = trim(ip2long(substr($network, $d+1)));
            $ip = ip2long($ip);

            return ($ip>=$from and $ip<=$to);
        }
    }

    /**
     * Get client IP address
     *
     * @return string
     */
    public function getClientIP() {
        $ipaddress = 'unknownip';

        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');

        return $ipaddress;
    }
}
