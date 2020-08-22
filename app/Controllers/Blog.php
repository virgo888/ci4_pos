<?php namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;

class Blog extends BaseController
{
	public function index()
	{
        $content["title"] = "Daftar Data Supplier";
        $content["container"] = view("admin/user/list");
        $content_js["js"] = view("admin/user/js");
        $this->template($content, $content_js);
	}

    public function list()
    {

    }

    public function add()
    {

    }

    public function update()
    {

    }

    public function delete()
    {
    	
    }

}
?>
