<?php

class EmployeeAttendance extends Eloquent
{
    /**
	 * Eloquent will not maintain the created_at and updated_at columns on your database table automatically
	 *
	 * @var string
	 */
    public $timestamps = false;

    /**
	 * Eloquent will not maintain auto increment on your database table automatically
	 *
	 * @var string
	 */
    public $incrementing  = false;

    /**
     * Get employee data based on provided employee ID
     *
     * @return Response
     */
    public function scopeEmployee ($query, $employee_id)
    {
        return $query->where('employee_id', '=', $employee_id);
    }

    /**
     * Get attendance records based on current punch_date
     *
     * @return Response
     */
    public function scopePunchDate ($query)
    {
        return $query->where('punch_date', '=', date('Y-m-d'));
    }
}
