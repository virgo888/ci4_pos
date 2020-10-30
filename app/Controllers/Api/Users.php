<?php namespace App\Controllers\Api;


use App\Controllers\Base\BaseApiController;
use App\Models\Users as UsersModel;

class Users extends BaseApiController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index()
	{
		$users = new UsersModel;

		$users = $users->findAll();

		return $this->respond($users);
	}

	public function show($id = NULL)
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

		$validation =  \Config\Services::validation();

		$validation->setRules([
		    PASSWORD => [
                'rules' => 'required|min_length[6]|max_length[32]',
                'errors' => [
                    'required'   => 'Password harus di isi.',
                    'min_length' => 'Password minimal 6 karakter.',
                    'max_length' => 'Password tidak boleh lebih dari 32 karakter.'
                ]
            ]
		]);

		if(!$validation->withRequest($this->request)->run())
		{
			return $this->fail($validation->getErrors(), 400);
		}

		$password = $data[PASSWORD];
		$password_hash = get_hash($password);
		$data[PASSWORD] = $password_hash;

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
		$user['url'] = site_url('/api/users/'.$id);

		$this->response->setHeader("location", $user['url']);

		return $this->respondCreated($user);
	}

	public function update($id = NULL)
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

	public function delete($id = NULL)
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