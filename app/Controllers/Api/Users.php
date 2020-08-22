<?php namespace App\Controllers\Api;

use App\Controllers\Base\BaseController;
use App\Models\Users as UsersModel;

class Users extends BaseController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index()
	{
		$users = new UsersModel;

		$users = $users->paginate();

		return $this->respond($users);
	}

	public function show($id)
	{
		$users = new UsersModel;

		$user = $users->find($id);

		if(!$user)
		{
			return $this->fail('User not found.', 404);
		}

		return $this->respond($user);
	}

	public function create()
	{
		$data = $this->request->getPost();

		$users = new UsersModel;

		$id = $users->insert($data);


		if($users->errors())
		{
			return $this->fail($users->errors());
		}

		if($id === false)
		{
			return $this->failServerError();
		}

		$user = $users->find($id);
		$user['url'] = site_url('/users/'.$id);

		$this->response->setHeader("location", $user['url']);

		return $this->respondCreated($user);
	}

	public function update($id)
	{
		$data = $this->request->getRawInput();

		$users = new UsersModel;

		// I do no want to send all the fields! Only waht I need to update!
		$users->setUdpateRules($data);

		$updated = $users->update($id, $data);

		if($users->errors())
		{
			return $this->fail($users->errors());
		}

		if($updated === false)
		{
			return $this->failServerError();
		}

		$user = $users->find($id);

		return $this->respond($user);
	}

	public function delete($id)
	{
		$users = new UsersModel;

		$user = $users->select('id')->find($id);

		if(!$user)
		{
			return $this->fail('User not found', 404);
		}

		if($users->delete($id))
		{
			return $this->respondDeleted();
		}
		else
		{
			return $this->failServerError();
		}
	}

}
