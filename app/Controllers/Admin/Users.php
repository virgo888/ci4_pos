<?php namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;

class Users extends BaseController
{
    public $id;
    public $id_parent;
    public $username;
    public $alias;
    public $enable;
    public $active;
    public $created_date;
    public $created_by;
    public $updated_date;
    public $updated_by;

    public $url_api;

    public function __construct()
    {
        $this->url_api  = site_url('api/users');
    }

	public function index()
	{
        $content["title"]      = "Daftar User";
        $data['content_title'] = $content["title"];
        $content["container"]  = view("admin/users/list", $data);
        $content_js["js"]      = view("admin/users/js");
        $this->template($content, $content_js);
	}

    public function list()
    {
        $type = "GET";
        $url = $this->url_api;
        $list['data'] = $this->myCurlRequest($type, $url);

        echo json_encode($list);
    }

    public function add()
    {
        $content["title"] = "Input User";
        $data['content_title'] = $content["title"];
        $content["container"] = view('admin/users/add', $data);
        $content_js["js"] = view("admin/users/js");
        $this->template($content, $content_js);
    }

    public function add_post()
    {
        $username = $this->request->getPost(USERNAME);
        $email    = $this->request->getPost(EMAIL);
        $phone    = $this->request->getPost(PHONE);
        $password = $this->request->getPost(PASSWORD);

        $params = [
            USERNAME => $username,
            EMAIL    => $email,
            PHONE    => $phone,
            PASSWORD => $password
        ];

        $method = "POST";
        $url = $this->url_api;
        $result = $this->myCurl($method, $url, $params);

        if($result['error'] == true)
        {
            if($result['httpcode'] == 400 )
            {
                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $params);
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $result['data']);
                // kembali ke halaman form
                return redirect()->to(base_url('admin/users/add'));
            }
            else
            {
                $message = $result['message'];

                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $params);
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', 'Gagal menambahkan data user. '.$message);
                // kembali ke halaman form
                return redirect()->to(base_url('admin/users/add'));
            }
        }
        else
        {
            session()->setFlashdata('success', 'Berhasil menambahkan data user. Email <b>'.$result['data']->email.'</b> username <b>'.$result['data']->username.'</b>');

            // kembali ke halaman daftar user
            return redirect()->to(base_url('admin/users'));
        }
    }

    public function update($id_user)
    {
        $type = "GET";
        $url = $this->url_api.'/'.$id_user;
        $data['data'] = $this->myCurlRequest($type, $url);

        $content["title"] = "Update User";
        $data['content_title'] = $content["title"];
        $content["container"] = view('admin/users/update', $data);
        $content_js["js"] = view("admin/users/js");
        $this->template($content, $content_js);
    }

    public function update_post()
    {
        $id       = $this->request->getPost(ID_USER);
        $username = $this->request->getPost(USERNAME);
        $email    = $this->request->getPost(EMAIL);
        $phone    = $this->request->getPost(PHONE);

        $username_temp = $this->request->getPost('username_temp');
        $email_temp    = $this->request->getPost('email_temp');
        $phone_temp    = $this->request->getPost('phone_temp');

        $params = [];
        if($username != $username_temp)
        {
        	$params[USERNAME] = $username;
        }

        if($email != $email_temp)
        {
        	$params[EMAIL] = $email;
        }

        if($phone != $phone_temp)
        {
        	$params[PHONE] = $phone;
        }

        $method = "PUT";
        $url = $this->url_api."/".$id;
        $result = $this->myCurl($method, $url, $params);

        if($result['error'])
        {
            // if error
            if($result['httpcode'] == 400 )
            {
            	// mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $params);
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', $data['data']);
                // kembali ke halaman form
                return redirect()->to(base_url('admin/users/update/'.$id));
            }
            else
            {
                $message = $data['message'];

                // mengembalikan nilai input yang sudah dimasukan sebelumnya
                session()->setFlashdata('inputs', $params);
                // memberikan pesan error pada saat input data
                session()->setFlashdata('errors', 'Gagal menambahkan data user. '.$message);
                // kembali ke halaman form
                return redirect()->to(base_url('admin/users/update/'.$id));
            }
        }

        session()->setFlashdata('success', 'Berhasil mengupdate data user <b>'.$result['data']->email.'</b>');

        // kembali ke halaman daftar user
        return redirect()->to(base_url('admin/users'));
    }

    public function delete($id_user)
    {
    	$method = "DELETE";
        $url = $this->url_api.'/'.$id_user;
        $data = "";
        $request = $this->myCurl($method, $url, $data);

        $httpcode = $request['httpcode'];

        if($httpcode == 200)
        {
            session()->setFlashdata('success', 'Berhasil menghapus data user.');  
        }
        elseif ($httpcode == 404) { 
            session()->setFlashdata('error', 'Data user tidak ditemukan.');
        }
        else
        {
            session()->setFlashdata('error', 'Terjadi kesalahan ketika menghapus data user. '.$request['message']);
        }

        // kembali ke halaman daftar user
        return redirect()->to(base_url('admin/users'));
    }

}
