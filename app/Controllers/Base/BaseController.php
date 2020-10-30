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
		$this->session = \Config\Services::session();
		 
		// Ensure that the session is started and running
        // if (session_status() == PHP_SESSION_NONE)
        // {
        //     $this->session = \Config\Services::session();
        // }
		
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

	public function myCurlRequest($method, $url, $form = null)
	{
		$options = [];
		try
		{
			if($form)
			{
				if($method == 'POST')
				{
					$options = [
						'headers' => [
							'Content-Type' => 'multipart/form-data',
						],
						'multipart' => $form
					];
				}
				else
				{
					$options = [
						'form_params' => $form
					];
				}
			}
			$client = \Config\Services::curlrequest();
			$response = $client->request($method, $url, $options);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}

		$data = json_decode($response->getBody());

		return $data;
	}

    public function myCurl($method, $url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if($method == "PUT")
        {
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));
		}
		else
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
        
        $respondBody=curl_exec($ch);

        // return $respondBody;

        // if($output === false)
        // {
        //     $errno = curl_errno($ch);
        //     $error_message = curl_strerror($errno);
        //     $messages =  "cURL error ({$errno}): {$error_message}";
        //     $callBack = [
        //         'success' => 'false',
        //         'message' => $messages,
        //     ];
        //     return json_encode($callBack, true);
        // }

        // $httpcode = curl_getinfo($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($httpcode == 404)
        {
        	$errno = curl_errno($ch);
            $error_message = curl_strerror($errno);
            $messages =  "cURL error ({$errno}): {$error_message}";
            $callBack = [
                'error' => true,
                'httpcode' => $httpcode,
                'message' => $messages,
                'data' => json_decode($respondBody)
            ];
        }
        elseif($httpcode == 400)
        {
            $callBack = [
                'error' => true,
                'httpcode' => $httpcode,
                'data' => json_decode($respondBody)
            ];
        }
        else
        {
        	$callBack = [
                'error' => false,
                'httpcode' => $httpcode,
                'data' => json_decode($respondBody)
            ];
        }
        curl_close($ch);

        return $callBack;
    }

}
