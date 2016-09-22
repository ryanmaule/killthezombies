<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugins extends CI_Controller {

	public function jsconnect()
	{
		$this->load->helper('jsconnect');
		$this->load->library('session');
		
		// 1. Get your client ID and secret here. These must match those in your jsConnect settings.
		$clientID = "1936561548";
		$secret = "4b995bc863da9d2c2e620ccb9e595754";
		$secure = true;
		
		if($this->ion_auth->logged_in()) {
			$user = $this->ion_auth->user()->row();
			
			$data['uniqueid'] = $user->id;
			$data['name'] = $user->username;
			$data['email'] = $user->email;
			$data['photourl'] = 'http://www.killthezombies.com/users/images/'.$user->id.'.png';
			
			die(WriteJsConnect($data, $_GET, $clientID, $secret, $secure));
		}
	}

}