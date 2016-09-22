<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class International extends CI_Controller {

	public $the_user;
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		//$this->output->cache(1);
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('games_model');
		$this->load->view('inc_header');
	
		$data->error = $this->session->flashdata('error');

		if($this->ion_auth->logged_in()) {
            // get the user object
            $data->the_user = $this->ion_auth->user()->row();

            // put the user object in class wide property
            $this->the_user = $data->the_user;
            
			// get user fans
			$this->data->user_recent = $this->games_model->user_recent($this->the_user->id);
			$this->data->user_favorites = $this->games_model->user_favorites($this->the_user->id);
			$this->data->user_recommendations = $this->games_model->user_recommendations();
            
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
	
	function __destruct()
	{
		$this->data['folders'] = $this->games_model->game_folders(6);
		$this->data['ga'] = $this->session->userdata('ga');
		$this->load->view('inc_footer', $this->data);
	}

	public function _remap($method, $params = array())
	{
		// try to find a method
	    if (method_exists($this, $method))
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
		$data->new_games = $this->games_model->new_games(5);
		$data->popular_games = $this->games_model->popular_games(5);
		$data->top_games = $this->games_model->top_games(5);
		$data->playing_games = $this->games_model->playing_games(5);
	    
		$data->article = $method;
		$this->load->view('view_international',$data);
	}

}