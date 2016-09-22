<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

	public $the_user;
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		//$this->output->cache(1);
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('games_model');
		$this->load->model('blog_model');
		$this->load->model('users_model');
		$this->load->view('inc_header');
	
		$data->error = $this->session->flashdata('error');

		if($this->ion_auth->logged_in()) {
            // get the user object
            $data->the_user = $this->ion_auth->user()->row();

            // put the user object in class wide property
            $this->the_user = $data->the_user;
            
            // load $the_user in all displayed views automatically
            $this->load->vars($data);
            
            // display member navigation
            $this->load->view('inc_navigation_member',$data);
        }
        else
        { 
        	// display guest navigation
        	$this->load->view('inc_navigation_guest',$data);
        }
	}

	public function index()
	{
		$this->load->view('view_forum', $this->data);
	}

	function __destruct()
	{
		$this->data['folders'] = $this->games_model->game_folders(6);
		$this->data['ga'] = $this->session->userdata('ga');
		$this->load->view('inc_footer', $this->data);
	}

}