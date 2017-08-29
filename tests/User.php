<?php

namespace Parameter\Tests;

use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
	private $isAdmin;

	public function __construct($isAdmin = true)
	{
		$this->isAdmin = $isAdmin;
	}
}
