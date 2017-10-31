<?php

class Notification extends Eloquent
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
     * The fillable property specifies which attributes should be mass-assignable.
     * This can be set at the class or instance level.
     *
     * @var array
     */
    protected $fillable = array('user_id', 'last_seen_notice');
}
