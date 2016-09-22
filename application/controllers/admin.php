<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $the_user;

	public function __construct()
	{
		parent::__construct();

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
        }
        else
        { 
        	// shouldn't be here
        	//exit('Why are you here?');
        }
	}
	
	function __destruct()
	{
		$this->load->view('inc_admin_footer');
	}
	
	public function game($slug='')
	{
		// get the fields
		$game_id = $this->input->post('game_id');
		$update['slug'] = $this->input->post('slug');
		$update['title'] = $this->input->post('title');
		$update['width'] = $this->input->post('width');
		$update['height'] = $this->input->post('height');
		$update['fullscreen'] = $this->input->post('fullscreen');
		$update['description'] = $this->input->post('description');
		$update['instructions'] = $this->input->post('instructions');
		$update['published'] = $this->input->post('published');
		$update['folder_id'] = $this->input->post('folder_id');
		
		// if form is submitted, handle it
		switch (@$this->input->post('type'))
		{
			case 'thumbnail':
				// thumbnail upload
				$config['upload_path'] = SITE_ROOT.'/games/thumbs/';
				$config['allowed_types'] = 'png';
				$config['max_size']	= '9999';
				$config['max_width']  = '104';
				$config['max_height']  = '96';
				$config['file_name'] = $slug.'.png';
				$config['overwrite'] = TRUE;
		
				$this->load->library('upload', $config);
		
				if (!$this->upload->do_upload()) 
				{
					$data['error'] = $this->upload->display_errors();
				}
				else 
				{
					$data = array('upload_data' => $this->upload->data());
					$data['error'] = 'Your thumbnail upload was successful.';
				}
			break;
			
			case 'swf':
				// swf upload
				$config['upload_path'] = SITE_ROOT.'/games/';
				$config['allowed_types'] = 'swf';
				$config['max_size']	= '99999';
				$config['file_name'] = $slug.'.swf';
				$config['overwrite'] = TRUE;
		
				$this->load->library('upload', $config);
		
				if (!$this->upload->do_upload()) 
				{
					$data['error'] = $this->upload->display_errors();
				}
				else 
				{
					$data = array('upload_data' => $this->upload->data());
					$data['error'] = 'Your game swf upload was successful.';
				}
			break;
				
			case 'detail':
				// game modification
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('slug', 'Game Slug', 'required|xss_clean');
				$this->form_validation->set_rules('title', 'Game Title', 'required|xss_clean');
				$this->form_validation->set_rules('width', 'Width', 'required|xss_clean');
				$this->form_validation->set_rules('height', 'Height', 'required|xss_clean');
				$this->form_validation->set_rules('fullscreen', 'Fullscreen Capability', 'xss_clean');
				$this->form_validation->set_rules('description', 'Description', 'xss_clean');
				$this->form_validation->set_rules('instructions', 'Instructions', 'xss_clean');
				$this->form_validation->set_rules('published', 'Published Status', 'xss_clean');
				$this->form_validation->set_rules('folder_id', 'Folder', 'required|xss_clean');
				
				if ($this->form_validation->run())
				{
					// update the game
					$this->games_model->update($game_id,$update);
				}
				else
				{
					// set the flash data error message if there is one
					$data['error'] = validation_errors();
				}
			break;
			
			case 'create':
				// game creation
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('slug', 'Game Slug', 'required|xss_clean');
				$this->form_validation->set_rules('title', 'Game Title', 'required|xss_clean');
				$this->form_validation->set_rules('width', 'Width', 'required|xss_clean');
				$this->form_validation->set_rules('height', 'Height', 'required|xss_clean');
				$this->form_validation->set_rules('fullscreen', 'Fullscreen Capability', 'xss_clean');
				$this->form_validation->set_rules('description', 'Description', 'xss_clean');
				$this->form_validation->set_rules('instructions', 'Instructions', 'xss_clean');
				$this->form_validation->set_rules('published', 'Published Status', 'xss_clean');
				$this->form_validation->set_rules('folder_id', 'Folder', 'required|xss_clean');
				
				if ($this->form_validation->run())
				{
					// update the game
					$this->games_model->insert($update);
					$slug = $update['slug'];
				}
				else
				{
					// set the flash data error message if there is one
					$data['error'] = validation_errors();
				}
			break;
		}

		// get the game so we can edit it
		$game = $this->games_model->get_game($slug)->result_array();
		
		// set up the fields
		$data['slug'] = array('name' => 'slug',
			'id' => 'slug',
			'type' => 'text',
			'value' => $game[0]['slug'],
		);
		$data['title'] = array('name' => 'title',
			'id' => 'title',
			'type' => 'text',
			'value' => $game[0]['title'],
		);
		$data['width'] = array('name' => 'width',
			'id' => 'width',
			'type' => 'text',
			'value' => $game[0]['width'],
		);
		$data['height'] = array('name' => 'height',
			'id' => 'height',
			'type' => 'text',
			'value' => $game[0]['height'],
		);
		$data['fullscreen'] = array('name' => 'fullscreen',
			'id' => 'fullscreen',
			'checked' => $game[0]['fullscreen'],
			'value' => 1,
		);
		$data['description'] = array('name' => 'description',
			'id' => 'description',
			'value' => $game[0]['description'],
		);
		$data['instructions'] = array('name' => 'instructions',
			'id' => 'instructions',
			'value' => $game[0]['instructions'],
		);
		$data['published'] = array('name' => 'published',
			'id' => 'published',
			'checked' => $game[0]['published'],
			'value' => 1,
		);
		$data['game_id'] = $game[0]['game_id'];
		$folders = $this->games_model->game_folders(999)->result_array();
		foreach ($folders as $folder)
		{
			$data['folder_id']['folders'][$folder['folder_id']] = $folder['name'];
		}
		$data['folder_id']['default'] = $game[0]['folder_id'];
		
		$this->load->view('admin_game',$data);
	}
	
	function add_game()
	{
		// set up the fields
		$data['slug'] = array('name' => 'slug',
			'id' => 'slug',
			'type' => 'text',
			'value' => '',
		);
		$data['title'] = array('name' => 'title',
			'id' => 'title',
			'type' => 'text',
			'value' => '',
		);
		$data['width'] = array('name' => 'width',
			'id' => 'width',
			'type' => 'text',
			'value' => '',
		);
		$data['height'] = array('name' => 'height',
			'id' => 'height',
			'type' => 'text',
			'value' => '',
		);
		$data['fullscreen'] = array('name' => 'fullscreen',
			'id' => 'fullscreen',
			'checked' => '',
			'value' => 1,
		);
		$data['description'] = array('name' => 'description',
			'id' => 'description',
			'value' => '',
		);
		$data['instructions'] = array('name' => 'instructions',
			'id' => 'instructions',
			'value' => '',
		);
		$data['published'] = array('name' => 'published',
			'id' => 'published',
			'checked' => 1,
			'value' => 1,
		);
		$folders = $this->games_model->game_folders(999)->result_array();
		foreach ($folders as $folder)
		{
			$data['folder_id']['folders'][$folder['folder_id']] = $folder['name'];
		}
		$data['folder_id']['default'] = 1;
		
		$this->load->view('admin_game_add',$data);
	}

    function add_blog_entry()
    {
        $this->load->library('form_validation');
 
        //set validation rules
        $this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('entry_body', 'Body', 'required|xss_clean');
        $this->form_validation->set_rules('entry_body_extended', 'Extended Body', 'xss_clean');
        $this->form_validation->set_rules('entry_slug', 'Slug', 'required|xss_clean');
        $this->form_validation->set_rules('game_id', 'Game ID', 'xss_clean');
        $this->form_validation->set_rules('active', 'Active Status', 'xss_clean');
 
        if ($this->form_validation->run())
        {
            $entry['entry_name'] = $this->input->post('entry_name');
            $entry['entry_body'] = $this->input->post('entry_body');
            $entry['entry_body_extended'] = $this->input->post('entry_body_extended');
            $entry['entry_slug'] = $this->input->post('entry_slug');
            $entry['game_id'] = $this->input->post('game_id');
            $entry['active'] = 1;
            $this->blog_model->add_entry($entry);
            
            $data['error'] =  'BLOG POST SAVED';
        }
        else
        {
			// Display errors
			$data['error'] = validation_errors();
        }
        
		// set up the fields
		$data['entry_name'] = array('name' => 'entry_name',
			'id' => 'entry_name',
			'type' => 'text',
			'value' => '',
		);
		$data['entry_body'] = array('name' => 'entry_body',
			'id' => 'entry_body',
			'value' => '',
		);
		$data['entry_body_extended'] = array('name' => 'entry_body_extended',
			'id' => 'entry_body_extended',
			'value' => '',
		);
		$data['entry_slug'] = array('name' => 'entry_slug',
			'id' => 'entry_slug',
			'type' => 'text',
			'value' => '',
		);
		$data['active'] = array('name' => 'active',
			'id' => 'active',
			'checked' => 1,
			'value' => 1,
		);
		$games = $this->games_model->all_games()->result_array();
		foreach ($games as $game)
		{
			$data['game_id']['games'][$game['game_id']] = $game['title'];
		}
		$data['game_id']['games'][0] = '-- No Game --';
		$data['game_id']['default'] = '';
		$data['hidden'] = array();
		
		$data['type'] = 'add';
        $this->load->view('admin_blog_entry', $data);
    }
    
    function edit_blog_entry($entry_slug='')
    {
        $this->load->library('form_validation');
 
        //set validation rules
        $this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('entry_body', 'Body', 'required|xss_clean');
        $this->form_validation->set_rules('entry_body_extended', 'Extended Body', 'xss_clean');
        $this->form_validation->set_rules('entry_slug', 'Slug', 'required|xss_clean');
        $this->form_validation->set_rules('game_id', 'Game ID', 'xss_clean');
        $this->form_validation->set_rules('entry_id', 'Entry ID', 'required|xss_clean');
        $this->form_validation->set_rules('active', 'Active Status', 'xss_clean');
         
        if ($this->form_validation->run())
        {
            //if valid
            $entry_id = $this->input->post('entry_id');
            $entry['entry_name'] = $this->input->post('entry_name');
            $entry['entry_body'] = $this->input->post('entry_body');
            $entry['entry_body_extended'] = $this->input->post('entry_body_extended');
            $entry['entry_slug'] = $this->input->post('entry_slug');
            $entry['game_id'] = $this->input->post('game_id');
            $entry['active'] = $this->input->post('active');
            $this->blog_model->edit_entry($entry_id, $entry);
            
            $entry_slug = $this->input->post('entry_slug');
            
            $this->session->set_flashdata('message', 'Entry edited!');
        }
        else
        {
			// Display errors
			$data['error'] = validation_errors();
		}
        
        // set up the fields
        $entry = $this->blog_model->get_entry_by_slug($entry_slug);
        
		$data['entry_name'] = array('name' => 'entry_name',
			'id' => 'entry_name',
			'type' => 'text',
			'value' => $entry[0]->entry_name,
		);
		$data['entry_body'] = array('name' => 'entry_body',
			'id' => 'entry_body',
			'value' => $entry[0]->entry_body,
		);
		$data['entry_body_extended'] = array('name' => 'entry_body_extended',
			'id' => 'entry_body_extended',
			'value' => $entry[0]->entry_body_extended,
		);
		$data['entry_slug'] = array('name' => 'entry_slug',
			'id' => 'entry_slug',
			'type' => 'text',
			'value' => $entry[0]->entry_slug,
		);
		$data['active'] = array('name' => 'active',
			'id' => 'active',
			'checked' => $entry[0]->active,
			'value' => 1,
		);
		$games = $this->games_model->all_games()->result_array();
		foreach ($games as $game)
		{
			$data['game_id']['games'][$game['game_id']] = $game['title'];
		}
		$data['game_id']['games'][0] = '-- No Game --';
		$data['game_id']['default'] = $entry[0]->game_id;
		$data['hidden'] = array('entry_id' => $entry[0]->entry_id);
		$data['type'] = 'edit';
		
		// Display errors
		$data['error'] = validation_errors();

        $this->load->view('admin_blog_entry', $data);	
    }
    
    function add_blog_feature()
    {
        $this->load->library('form_validation');
 
        //set validation rules
        $this->form_validation->set_rules('feature_name', 'Title', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('feature_body', 'Body', 'required|xss_clean');
        $this->form_validation->set_rules('feature_slug', 'Slug', 'required|xss_clean');
        $this->form_validation->set_rules('game_id', 'Game ID', 'xss_clean');
        $this->form_validation->set_rules('active', 'Active Status', 'xss_clean');
 
        if ($this->form_validation->run())
        {
            $feature['feature_name'] = $this->input->post('feature_name');
            $feature['feature_body'] = $this->input->post('feature_body');
            $feature['feature_slug'] = $this->input->post('feature_slug');
            $feature['game_id'] = $this->input->post('game_id');
            $feature['active'] = 1;
            $this->blog_model->add_feature($feature);
            
            $data['error'] =  'BLOG FEATURE SAVED';
        }
        else
        {
			// Display errors
			$data['error'] = validation_errors();
        }
        
		// set up the fields
		$data['feature_name'] = array('name' => 'feature_name',
			'id' => 'feature_name',
			'type' => 'text',
			'value' => '',
		);
		$data['feature_body'] = array('name' => 'feature_body',
			'id' => 'feature_body',
			'value' => '',
		);
		$data['feature_slug'] = array('name' => 'feature_slug',
			'id' => 'feature_slug',
			'type' => 'text',
			'value' => '',
		);
		$data['active'] = array('name' => 'active',
			'id' => 'active',
			'checked' => 1,
			'value' => 1,
		);
		$games = $this->games_model->all_games()->result_array();
		foreach ($games as $game)
		{
			$data['game_id']['games'][$game['game_id']] = $game['title'];
		}
		$data['game_id']['games'][0] = '-- No Game --';
		$data['game_id']['default'] = '';
		$data['hidden'] = array();
		
		$data['type'] = 'add';
        $this->load->view('admin_blog_feature', $data);
    }
    
    function edit_blog_feature($feature_slug='')
    {
        $this->load->library('form_validation');
 
        //set validation rules
        $this->form_validation->set_rules('feature_name', 'Title', 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('feature_body', 'Body', 'required|xss_clean');
        $this->form_validation->set_rules('feature_slug', 'Slug', 'required|xss_clean');
        $this->form_validation->set_rules('game_id', 'Game ID', 'xss_clean');
        $this->form_validation->set_rules('feature_id', 'feature ID', 'required|xss_clean');
        $this->form_validation->set_rules('active', 'Active Status', 'xss_clean');
         
        if ($this->form_validation->run())
        {
            //if valid
            $feature_id = $this->input->post('feature_id');
            $feature['feature_name'] = $this->input->post('feature_name');
            $feature['feature_body'] = $this->input->post('feature_body');
            $feature['feature_slug'] = $this->input->post('feature_slug');
            $feature['game_id'] = $this->input->post('game_id');
            $feature['active'] = $this->input->post('active');
            $this->blog_model->edit_feature($feature_id, $feature);
            
            $feature_slug = $this->input->post('feature_slug');
            
            $this->session->set_flashdata('message', 'feature edited!');
        }
        else
        {
			// Display errors
			$data['error'] = validation_errors();
		}
        
        // set up the fields
        $feature = $this->blog_model->get_feature_by_slug($feature_slug);
        
		$data['feature_name'] = array('name' => 'feature_name',
			'id' => 'feature_name',
			'type' => 'text',
			'value' => $feature[0]->feature_name,
		);
		$data['feature_body'] = array('name' => 'feature_body',
			'id' => 'feature_body',
			'value' => $feature[0]->feature_body,
		);
		$data['feature_slug'] = array('name' => 'feature_slug',
			'id' => 'feature_slug',
			'type' => 'text',
			'value' => $feature[0]->feature_slug,
		);
		$data['active'] = array('name' => 'active',
			'id' => 'active',
			'checked' => $feature[0]->active,
			'value' => 1,
		);
		$games = $this->games_model->all_games()->result_array();
		foreach ($games as $game)
		{
			$data['game_id']['games'][$game['game_id']] = $game['title'];
		}
		$data['game_id']['games'][0] = '-- No Game --';
		$data['game_id']['default'] = $feature[0]->game_id;
		$data['hidden'] = array('feature_id' => $feature[0]->feature_id);
		$data['type'] = 'edit';
		
		// Display errors
		$data['error'] = validation_errors();

        $this->load->view('admin_blog_feature', $data);	
    }
    
    public function upload_blog_feature($slug)
    {
    	if (!empty($slug))
    	{
			// png upload
			$config['upload_path'] = SITE_ROOT.'/games/slides/';
			$config['allowed_types'] = 'png';
			$config['max_size']	= '99999';
			$config['file_name'] = $slug.'.png';
			$config['overwrite'] = TRUE;
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload()) 
			{
				$data['error'] = $this->upload->display_errors();
			}
			else 
			{
				$data = array('upload_data' => $this->upload->data());
				$data['error'] = 'Your game png upload was successful.';
			}
		}
		else
		{
			$data['error'] = 'No slug detected.  Cannot proceed.';
		}
		//$this->edit_blog_feature($slug);
		redirect('/admin/edit_blog_feature/'.$slug);
		//$this->load->view('admin_blog_feature', $data);	
    }
    
    public function upload_blog_entry($slug)
    {
    	if (!empty($slug))
    	{
			// png upload
			$config['upload_path'] = SITE_ROOT.'/games/headings/';
			$config['allowed_types'] = 'png';
			$config['max_size']	= '99999';
			$config['file_name'] = $slug.'.png';
			$config['overwrite'] = TRUE;
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload()) 
			{
				$data['error'] = $this->upload->display_errors();
			}
			else 
			{
				$data = array('upload_data' => $this->upload->data());
				$data['error'] = 'Your game png upload was successful.';
			}
		}
		else
		{
			$data['error'] = 'No slug detected.  Cannot proceed.';
		}
		//$this->edit_blog_entry($slug);
		redirect('/admin/edit_blog_entry/'.$slug);
		//$this->load->view('admin_blog_entry', $data);	
    }
    
    public function welcome_email() 
    {
    	$this->load->library('email');
    	
    	// get all users
    	$users = $this->users_model->get_all_users()->result_array();
    
    	foreach ($users as $user) 
    	{
    		$data['username'] = $user['username'];
    	
			$message = $this->load->view('email/welcome.tpl.php', $data, true);
			$this->email->clear();
			$this->email->set_newline("\r\n");
			$this->email->from('noreply@killthezombies.com', 'Kill The Zombies!');
			$this->email->to($user['email']);
			$this->email->subject('Come see the new Kill The Zombies!');
			$this->email->message($message);
			
			if ($this->email->send())
			{
				$this->users_model->welcome_sent($user['id']);
			}
			
			die();
		}
    }

}