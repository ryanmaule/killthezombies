<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

	public $the_user;
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		//$this->output->cache(1);
		//$this->output->enable_profiler(TRUE);
		
		//get SEO descriptions
		$this->load->model('seo_model');
		$this->data->description = $this->seo_model->description();
		
		$this->load->model('games_model');
		$this->load->view('inc_header', $this->data);
	
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
		
		$this->load->library('amazon_ecs');
		$this->ecs->setReturnType(AmazonECS::RETURN_TYPE_ARRAY);
	}
	
	function __destruct()
	{
		$this->data->folders = $this->games_model->game_folders(6);
		$this->data->ga = $this->session->userdata('ga');
		$this->load->view('inc_footer', $this->data);
	}
	
	public function index()
	{
		$category = 'Books';
		$search = 'zombie';
	
		//var_dump($this->ecs->category('Books')->responseGroup('Large')->search("Codeigniter"));
		
		//create the amazon object (array)
		$this->data->response = $this->ecs->category($category)->responseGroup('Medium,Images,Offers')->search($search);
		
		$this->load->view('view_store',$this->data);
	}
	
	function item($asin)
	{
		$this->data->response = $this->ecs->responseGroup('Large,Images,Offers')->lookup($asin);
		
		$this->load->view('view_store_item',$this->data);
	}
	
}