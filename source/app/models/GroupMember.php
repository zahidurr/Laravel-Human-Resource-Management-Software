<?php

class GroupMember extends Eloquent
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
}
