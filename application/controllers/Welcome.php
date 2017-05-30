<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $shared_dir = './shared/';

	public function index()
	{
		$data = [
			'ip_addr' => $this->get_ip_addr(),
		];
		$this->load->view('welcome_message', $data);
	}

	private function get_ip_addr()
	{
		// $ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');

		$ip = $_SERVER['REMOTE_ADDR'];

		return $ip;
	}

	public function upload()
	{
		ini_set('upload_max_filesize', 2000000000);
		// print_r($_FILES);
		$filename = $_FILES['file']['name'];
		$tmpfile = $_FILES['file']['tmp_name'];
		$type = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		$error = $_FILES['file']['error'];
		$hash_suger = md5(date('Y-m-d H:i:s')) . '-';

		$ipaddr = $this->get_ip_addr();
		echo $ipaddr;
		$filename = $this->shared_dir . $ipaddr . '-' . $hash_suger . $filename;
		try {
			@move_uploaded_file($tmpfile, $filename);
			echo json_encode([true, 'Success', $filename]);
		} catch (Exception $ex) {
			echo json_encode([false, $ex, $filename]);
		}
		die();
	}

	public function get_data()
	{
		$dir = './shared/';
		$data = scandir($dir);

		$datalistip = [];
		$current_ip = $this->get_ip_addr();
		// print($current_ip);

		$index = 0;
		foreach($data as $dt) {
			$datalist = [];
			$component = explode('-', $dt);
			$component_length = count($component);
			if($dt == '.' || $dt == '..') {
				unset($data[$index]);
			}
			if ($component[0] == $current_ip) {
				$data_nama = [];
				for($i=2;$i<$component_length;$i++) {
					$data_nama[] = $component[$i];
				}
				$datalist = implode('-', $data_nama);
				$datalistip['local'][] = [
					'host' => 'local',
					'list' => $datalist,
					'name' => $dt,
				];
				unset($data[$index]);
			}
			$index++;
		}

		$client = 0;

		foreach($data as $dt) {
			$datalist = [];
			$component = explode('-', $dt);
			// print_r($component);
			$component_length = count($component);
			if ($component[0] != $current_ip) {
				$data_nama = [];
				for($i=2;$i<$component_length;$i++) {
					$data_nama[] = $component[$i];
				}
				$datalist = implode('-', $data_nama);
				$datalistip[$component[0]][] = [
					'host' => 'client' . ($client+1),
					'list' => $datalist,
					'name' => $dt,
				];
				$client++;
			}
		}

		// print('<pre>');print_r($datalistip);
		// return ($datalistip);

		$data = [
			'data' => $datalistip,
		];

		$this->load->view('data', $data);
	}
}
