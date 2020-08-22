<?php
namespace App\Controllers\Base;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['asset_helper','my_constants_helper','general_helper','login_helper'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		
		// helper(array('asset_helper','my_constants_helper','general_helper'));
	}

	public function template($content, $content_js)
	{
		// $content['title'] = "judul";
		// $content_js["js"] = "";
		// $content["container"] = view("admin/template_default/list");
		$content["navbar"] = view("admin/template_default/navbar");
        $content["css"] = view("admin/template_default/css");
        $content["js"] = view("admin/template_default/js", $content_js);
        echo view("admin/template_default/dashboard", $content);
	}

}
