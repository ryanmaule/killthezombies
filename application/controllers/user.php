<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('facebook_model');
		$this->load->view('inc_header');
	
		$data->error = $this->session->flashdata('error');
		
		// get facebook session
        $data->fb_data = $this->session->userdata('fb_data');
        $this->data['fb_data'] = $data->fb_data;

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
	
	public function index()
	{	
		// get categories
		$data->new_games = $this->games_model->new_games(10);
		$data->popular_games = $this->games_model->popular_games(10);
		$data->top_games = $this->games_model->top_games(10);
		$data->similar_games = $this->games_model->similar_games(10);
		$data->playing_games = $this->games_model->playing_games(10);
		//$data->editors_games = $this->games_model->editors_games(5);
		
		// get user fans
		if (!empty($this->the_user->id))
		{
			$data->user_recent = $this->games_model->user_recent($this->the_user->id);
			$data->user_favorites = $this->games_model->user_favorites($this->the_user->id);
			$data->user_recommendations = $this->games_model->user_recommendations();
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
		
		$data->blog = $this->blog_model->get_all_entries($config['per_page'],0);
		$data->features = $this->blog_model->get_all_features(5,0);
        
		$this->load->view('view_homepage',$data);
	}
	
	public function register()
    {
    	$this->load->library('form_validation');
    	
		if ($this->the_user)
		{
			//punt that homey back to the homepage
			redirect('', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
    
    	//set the flash data error message if there is one
		$this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('error')));
		
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$dup_email = $this->ion_auth->email_check($email);
		
		//check to see if we are creating the user
		if ($this->form_validation->run() == true && !$dup_email && $this->ion_auth->register($username, $password, $email))
		{ 
			//get the user
			$this->ion_auth->login($username,$password);
			$this->data['the_user'] = $this->ion_auth->user()->row();
			
			//give them a default avatar
			$path = SITE_ROOT.'/users/images';
			
			copy($path.'/default.png', $path.'/'.$this->data['the_user']->id.'.png');
			
			//take them to the welcome page
			redirect('/user/welcome');
		}
		else
		{
			if ($this->ion_auth->errors()) $this->data['error'] = $this->ion_auth->errors();
			
			if ($dup_email) $this->data['error'] = 'An account already exists for this email address.';
			
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['username'] = array('name' => 'username',
				'id' => 'username',
				'type' => 'text',
				'value' => $this->form_validation->set_value('username'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array('name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
	    
	        $this->load->view('view_register',$this->data);
		}
    }
	
	public function welcome()
	{
		if (!$this->the_user)
		{
			//punt that homey back to the homepage
			redirect('', 'refresh');
		}
	
		if (!empty($this->the_user->id))
		{
			$data->user_recommendations = $this->games_model->user_recommendations($this->the_user->id, 5);
		}
		
		$data->folders = $this->games_model->game_folders(6);
		
		$this->session->set_userdata('ga', '_gaq.push([\'_trackEvent\', \'Actions\', \'Registration\', \''.$this->the_user->username.'\']);');
		
		$this->load->view('view_welcome', $data);
	}
	
	public function profile()
	{
		if (!$this->the_user)
		{
			//punt that homey back to the homepage
			redirect('', 'refresh');
		}
	
		if (!empty($this->the_user->id))
		{
			$data->user_recent = $this->games_model->user_recent($this->the_user->id, 5);
			$data->user_favorites = $this->games_model->user_favorites($this->the_user->id, 5);
			$data->user_recommendations = $this->games_model->user_recommendations($this->the_user->id, 5);
			$data->user_rated = $this->games_model->user_rated($this->the_user->id, 5);
		}
		
		$data->email = array('name' => 'email',
			'id' => 'email',
			'type' => 'text',
			'value' => $this->the_user->email,
		);
		$data->password = array('name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'value' => '',
		);
		$data->password_confirm = array('name' => 'password_confirm',
			'id' => 'password_confirm',
			'type' => 'password',
			'value' => '',
		);
		
		$email_error = $this->session->flashdata('email_error');
		if (!empty($email_error)) $data->email_error = $email_error;
			
		$error = $this->session->flashdata('error');
		if (!empty($error)) $data->error = $error;
		
		$this->load->view('view_user', $data);
	}
	
	public function login()
    {
		if ($this->the_user)
		{
			//punt that homey back to the homepage
			redirect('', 'refresh');
		}
		if ($_POST)
	    {
	    	$this->load->library('form_validation');
	    
	    	// simple form validation
			$this->form_validation->set_rules('identity', 'Identity', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() == true)
			{
		        // get form values and xss filter the input
	            $identity = $this->input->post('identity', true);
	            $password = $this->input->post('password', true);
	            
	            //check for "remember me"
				$remember = (bool) $this->input->post('remember');
	
	            // if user is logged in successfully
	            if($this->ion_auth->login($identity,$password,$remember)) 
	            {
	                // load up error
	                $data->error = $this->ion_auth->errors();
	                
	                // track the event in google analytics
					$this->session->set_userdata('ga', '_gaq.push([\'_trackEvent\', \'Actions\', \'Login\', \''.$identity.'\']);');
	                
					// go back to the page i logged in from
					$this->session->set_flashdata('error', @$data->error);
					redirect($_SERVER['HTTP_REFERER']);
					
					// prevent __destruct?
					die();
	            }
	            else
	            {
	            	// could be a joomla migration
	            	$userid = $this->users_model->joomla_migration($identity,$password);
	            	
	            	if ($userid)
	            	{
	            		// save a proper password, salt for this user
	            		// basically, we broke the ion auth config by forcing salt here.. should fix
	            		$salt = $this->ion_auth->salt();
	            		
	            		// first, put a salt in the db.. we need it to update the password
	            		$update['salt'] = $salt;
	            		$this->ion_auth->update($userid, $update);
	            		unset($update);
	            		
	            		// now, update the password
	            		$update['password'] = $password;
	            		$update['ip_address'] = sprintf('%u', ip2long($this->input->ip_address()));
						$update['created_on'] = time();
						$update['last_login'] = time();
	            		$this->ion_auth->update($userid, $update);
	            		
	            		// make a default thumbnail for this person
	            		$path = SITE_ROOT.'/users/images';
			
						copy($path.'/default.png', $path.'/'.$userid.'.png');

	            		// now try to do an ion_auth login
	            		$this->ion_auth->login($identity,$password,$remember);
	            		
	            		// go to the welcome page
	            		redirect('/user/welcome');
	            	}
	            	else
	            	{
						// load up validation errors
						$data->error = $this->ion_auth->errors();
						
						// display the login form for corrections
						$this->session->set_flashdata('error', @$data->error);
						
						$this->load->view('view_login', $data);
					}
	            }
			}
			else
			{
				// load up validation errors
				$data->error = validation_errors();
				// display the login form for corrections
				$this->session->set_flashdata('error', @$data->error);
				$this->load->view('view_login', $data);
			}
	    }
	    else
	    {
	    	// i didn't try to log in, so show me a form (should never be used)
        	$this->load->view('view_login');
        }
    }
	
	public function logout()
    {
        // log current user out and send back to public root
        $this->ion_auth->logout();
		session_unset();
		session_destroy();
		session_write_close();
		session_regenerate_id(true);
        redirect('/');
    }
    
	function forgot_password()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'value' => @$this->input->get('username'),
			);
			//set any errors and display the form
			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
			$this->load->view('view_password', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('error', $this->ion_auth->messages());
				redirect("/user/login", 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect("/user/forgot_password", 'refresh');
			}
		}
	}
	
	public function reset_password($code)
	{
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{  //if the reset worked then send them to the login page
			$this->session->set_flashdata('error', $this->ion_auth->messages());
			redirect("/user/login", 'refresh');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('error', $this->ion_auth->errors());
			redirect("/user/forgot_password", 'refresh');
		}
	}
	
	public function edit_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');		
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$update['email'] = $this->input->post('email', true);
			$update['password'] = $this->input->post('password', true);
			if ($this->ion_auth->update($this->the_user->id, $update))
			{
				$data['error'] = 'Successfully Updated Account';	
			}
			else
			{
				$data['error'] = $this->ion_auth->errors();
			}
		}
		else
		{
			$data['error'] = validation_errors();
		}
		$this->session->set_flashdata('email_error', $data['error']);
		redirect('/user/profile', 'refresh');
	}
	
	public function fbconnect()
	{
		if ($this->data['fb_data'])
		{
			// active facebook connect session
			$fbid = $this->data['fb_data']['uid'];
			$username = $this->data['fb_data']['me']['name'];
			$password = 'RND'.$this->data['fb_data']['uid'];
			$email = $this->data['fb_data']['me']['email'];
			$remember = 1;
			
			$user = $this->users_model->facebook_migration($fbid);
			
			if (!$user)
			{
				// register them
				if ($this->ion_auth->register($username, $password, $email))
				{
					//get the user
					$this->ion_auth->login($username,$password);
					$this->data['the_user'] = $this->ion_auth->user()->row();
				
					$userid = $this->data['the_user']->id;
					
					// update the database to set the fbid 
					$update['fbconnect'] = $fbid;
	            	$this->ion_auth->update($userid, $update);
	    		
	    			// make a default thumbnail for this person their facebook profile picture
	    			$path = SITE_ROOT.'/users/images';
	
					copy('https://graph.facebook.com/'.$fbid.'/picture', $path.'/'.$userid.'.png');
					
					// log them in
	    			$this->ion_auth->login($username,$password,$remember);
	    	
	    			// redirect to welcome
	    			redirect('/user/welcome');
				}
				else
				{
					// we couldn't register them, better logout
					$this->logout();
				}
			}
	    	// log them in
	    	$this->ion_auth->login($username,$password,$remember);
	    	
	    	// load up error
	        $data->error = $this->ion_auth->errors();
		}
		// track the event in google analytics
		$this->session->set_userdata('ga', '_gaq.push([\'_trackEvent\', \'Actions\', \'Login\', \''.$username.'\']);');
		
		// redirect to homepage
	    redirect('/');
	    
	    // prevent __destruct?
		die();
	}
	
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			//redirect them to the home page
			$this->session->set_flashdata('error', $this->ion_auth->messages());
			redirect("", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('error', $this->ion_auth->errors());
			redirect("/user/forgot_password", 'refresh');
		}
	}

	function deactivate($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('view_deactivate', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->the_user && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the home page
			redirect('', 'refresh');
		}
	}
	
	public function upload_avatar()
	{
		// thumbnail upload
		$path = SITE_ROOT.'/users/images';
		
		$config['upload_path'] = $path . '/temp';
		$config['allowed_types'] = 'png|jpg|gif|jpeg';
		$config['max_size']	= 2048;
		$config['max_width']  = 500;
		$config['max_height']  = 500;
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) 
		{
			$this->data['error'] = $this->upload->display_errors();
		}
		else 
		{
			// reset config
			$file = $this->upload->data();
			unset($config);
			$source_image = $path.'/temp/'.$file['file_name'];
			
			// check for animated gif
			if ($this->is_ani($source_image))
			{
				$this->data['error'] = 'Animated gifs are not accepted.';
			}
			else
			{
				// convert and resize the file to png
				$config['image_library'] = 'ImageMagick';
				$config['library_path'] = '/usr/bin';
				$config['source_image'] = $source_image;
				$config['new_image'] = $path.'/'.$this->the_user->id.'.png';
				//$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	 = 100;
				$config['height']	= 100;
				
				$this->load->library('image_lib',$config);
				
				if (!$this->image_lib->resize())
				{
					$this->data['error'] = $this->image_lib->display_errors();
				}
				else
				{
					$this->data['error'] = 'Your avatar upload was successful.';
				}
			}
			// delete the original uploaded file
			if (is_file($source_image)) unlink($source_image);
		}
		//$this->load->view('view_user',$data);
		//redirect to index()
		//redirect('/user/profile');
		//die($this->data['error']);
		$this->profile();
	} 
	
	function top_users()
	{
		$users = $this->users_model->top_users();
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url() . 'users/';
		$config['total_rows'] = $users->num_rows();
		$config['per_page'] = 20; 
		$config['cur_tag_open'] = '<a href="#" class="active">';
		$config['cur_tag_close'] = '</a>';
		
		$this->pagination->initialize($config); 
		
		$data->pagination = $this->pagination->create_links();
		$data->total = $config['total_rows'];
		$data->title = 'Recent Top Users';
	
		// paginate through 30 users at a time
		$data->users = $this->users_model->top_users($config['per_page'],$this->uri->segment(3));
		$this->load->view('view_users_top',$data);
	}
	
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function is_ani($filename) {
	    if(!($fh = @fopen($filename, 'rb')))
	        return false;
	    $count = 0;
	    //an animated gif contains multiple "frames", with each frame having a
	    //header made up of:
	    // * a static 4-byte sequence (\x00\x21\xF9\x04)
	    // * 4 variable bytes
	    // * a static 2-byte sequence (\x00\x2C)
	
	    // We read through the file til we reach the end of the file, or we've found
	    // at least 2 frame headers
	    while(!feof($fh) && $count < 2) {
	        $chunk = fread($fh, 1024 * 100); //read 100kb at a time
	        $count += preg_match_all('#\x00\x21\xF9\x04.{4}\x00\x2C#s', $chunk, $matches);
	    }
	
	    fclose($fh);
	    return $count > 1;
	}

}