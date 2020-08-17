<?php namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function test()
	{
		echo T_PRODUCT;
		echo "<br><br>";
		echo base_url();
		assets_app();
	}

	public function template_test()
	{
		$content['title'] = "judul";
		$content_js["js"] = "";
		$content["container"] = view("admin/template_default/list");
		$content["navbar"] = view("admin/template_default/navbar");
        $content["css"] = view("admin/template_default/css");
        $content["js"] = view("admin/template_default/js", $content_js);
        echo view("admin/template_default/dashboard", $content);
	}

    public function list()
    {
        $content["title"] = "Daftar Data Supplier";
        $content["container"] = "";
        $content_js["js"] = "";
        $this->template($content, $content_js);
    }

	//--------------------------------------------------------------------

}
?>
