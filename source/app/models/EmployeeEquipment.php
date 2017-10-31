<?php

class EmployeeEquipment extends Eloquent
{
    /**
     * Get employee data based on provided employee ID
     *
     * @return Response
     */
    public function scopeOfEmployeeID($query, $employee_id)
    {
        return $query->where('employee_id', '=', $employee_id);
    }
}
