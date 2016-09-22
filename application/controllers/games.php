<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Controller {

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
	}
	
	function __destruct()
	{
		$this->data->folders = $this->games_model->game_folders(6);
		$this->data->ga = $this->session->userdata('ga');
		$this->load->view('inc_footer', $this->data);
	}
	
	public function _remap($method, $params = array())
	{
		//die($method);
		// try to find a method
	    if (method_exists($this, $method))
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
		// get the game
		$result = $this->games_model->get_game($method);
		if ($result->num_rows>0) 
		{
			$game = $result->result_array();
			// get similar games
			$game[0]['similar'] = $this->games_model->similar_games(5,$game[0]['folder_id']);
			// get short url
			$this->load->library('google_url_api');
			$game[0]['short_url'] = $this->google_url_api->shorten(base_url().'games/'.$game[0]['slug']);
		}
		else
		{
			set_status_header(404);
			show_404('/games/'.$method);
			
			return false;
		}
		
		// increment play counter (add session check)
		$this->games_model->play_count($method);
		$game[0]['user_recent'] = @$this->data->user_recent;
		$game[0]['user_favorites'] = @$this->data->user_favorites;
		$game[0]['user_recommendations'] = @$this->data->user_recommendations;
		
		$this->load->view('view_game',$game[0]);
	}
	
	public function newest()
	{
		$games = $this->games_model->all_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/newest/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Newest Zombie Games';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->new_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function similar()
	{
		$games = $this->games_model->similar_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/similar/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Random Zombie Games';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->similar_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function popular()
	{
		$games = $this->games_model->all_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/popular/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Popular Zombie Games';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->popular_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function current()
	{
		$games = $this->games_model->all_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/current/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Zombies Games Currently Being Played';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->playing_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function editors()
	{
		$games = $this->games_model->all_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/editors/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Editor\'s Favorite Zombie Games';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->editors_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function top()
	{
		$games = $this->games_model->all_games();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/top/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Top Zombie Games';
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->top_games($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_directory',$data);
	}
	
	public function search($query)
	{
		// look for matching games
		if (empty($query)) $query = $this->input->post('search');
		$query = urldecode($query);
		
		$data->games = $this->games_model->search('all',$query);
		$data->title = 'Results: "'.$query.'"';
		$data->total = $data->games->num_rows(); 
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . '/games/search/'.urlencode($query);
		$config['total_rows'] = $data->total;
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		
		// get user fans
		if (!empty($this->the_user->id))
		{
			$data->user_recent = $this->games_model->user_recent($this->the_user->id);
			$data->user_favorites = $this->games_model->user_favorites($this->the_user->id);
			$data->user_recommendations = $this->games_model->user_recommendations();
		}
		
		// track the event in google analytics
		$this->session->set_userdata('ga', '_gaq.push([\'_trackEvent\', \'Actions\', \'Search\', \''.$query.'\']);');
		
		$this->load->view('view_directory',$data);
	}
	
	public function rate()
	{
		$game_id = $this->uri->segment(3);
		$rating = $this->uri->segment(4);
		
		if (!empty($game_id) && !empty($rating))
		{
			$this->games_model->save_rating($game_id, $rating);
		}
	}
	
	public function resize()
	{
		// this is a hidden function to resize all games in the db
		error_reporting(-1);
		
		$games = $this->games_model->all_games()->result_array();
		foreach ($games as $game)
		{
			$file = SITE_ROOT.'/games/'.$game['slug'].'.swf';
			$filesize = filesize($file);
			echo $file;
			echo ' ('.$filesize.')';

			//if ($game['width']==620 && $filesize < 9494603)
			if ($game['height']==620)
			{
				unset($filesize);
				// get swf info
				$swf = getimagesize($file);
				// update new relative height in the db
				if ($swf[0]>0)
				{
					$new_height = round(($swf[1]/$swf[0])*620);
					$this->games_model->update($game['game_id'],array('width'=>620,'height'=>$new_height));
				}
				else
				{
					echo ' ERROR';
				}
				unset($swf);
			}
			else
			{
				echo ' TOO BIG';
			}
			echo '<br />';
		}
	}
	
	public function folders($slug)
	{
		$folder = $this->games_model->get_folder_by_slug($slug);
		$folder = $folder->result_array();
		$folder_id = $folder[0]['folder_id'];
		$name = $folder[0]['name'];
		
		$games = $this->games_model->all_games(9999999, 0, $folder_id);
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'games/folders/'.$slug.'/';
		$config['total_rows'] = $games->num_rows();
		$config['per_page'] = 30; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = $name;
		
		$data->user_recent = @$this->data->user_recent;
		$data->user_favorites = @$this->data->user_favorites;
		$data->user_recommendations = @$this->data->user_recommendations;
	
		// paginate through 30 games at a time
		$data->games = $this->games_model->all_games($config['per_page'],$this->uri->segment(3),$folder_id);
		$this->load->view('view_directory',$data);	
	}

}