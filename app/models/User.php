<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $rules = array(
		'username'				=> 'required|alpha|min:2',
		'email'					=> 'required|email|unique:users',
		'password'				=> 'required|alpha_num|between:6,12|confirmed',
		'password_confirmation'	=> 'required|alpha_num|between:6,12|same:password',
		'tipo_user'				=> 'in:1,2',
	);

	public static $rules_modificacion = array(
		'username'				=> 'required|alpha|min:2',
		'email'					=> 'required|email',
		'password'				=> 'alpha_num|between:6,12|confirmed',
		'password_confirmation'	=> 'alpha_num|between:6,12|same:password',
		'tipo_user'				=> 'in:1,2',
	);

	public static function isLogged() {
		if(Session::has('id'))
			return true;
		else
			return false;
	}

	public static function isAdmin() {
		if(Session::get('user_type') == 2)
			return true;
		else
			return false;
	}
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}