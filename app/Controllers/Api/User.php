<?php namespace App\Controllers\Api;

use App\Controllers\Base\BaseController;

class User extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

}
?>
