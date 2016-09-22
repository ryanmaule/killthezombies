<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public $the_user;
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		//$this->output->cache(1);
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('blog_model');
		$this->load->model('games_model');
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
	
	function __destruct()
	{
		$this->data['folders'] = $this->games_model->game_folders(6);
		$this->data['ga'] = $this->session->userdata('ga');
		$this->load->view('inc_footer', $this->data);
	}
	
	public function index($offset=0) 
	{
		if ($offset==0)
		{
			//redirect('');
		}
		// get blog posts
		$this->load->library('pagination');
		
		$blog = $this->blog_model->get_all_entries(100000,0);
		
		$config['per_page'] = 5;
		$config['base_url'] = base_url() . 'blog/index/';
		$config['total_rows'] = sizeof($blog);
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		
		$data->blog = $this->blog_model->get_all_entries($config['per_page'],$this->uri->segment(3));
		
		$this->load->view('view_blog',$data);
	}
	
	public function post($entry_slug)
	{
		$data->blog = $this->blog_model->get_entry_by_slug($entry_slug);
		
		$this->load->view('view_blog_post',$data);
	}
	
	public function features($offset=0) 
	{
		// get featured posts
		$this->load->library('pagination');
		
		$features = $this->blog_model->get_all_features(100000,0,false);
		
		$config['per_page'] = 5;
		$config['base_url'] = base_url() . 'blog/index/';
		$config['total_rows'] = sizeof($features);
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		
		$data->features = $this->blog_model->get_all_features($config['per_page'],$this->uri->segment(3),false);
		
		$this->load->view('view_features',$data);
	}

}