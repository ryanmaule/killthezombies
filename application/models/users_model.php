<?php
class Users_model extends CI_Model {

    public $return_data;

    function __construct()
	{
		parent::__construct();
	}

	public function joomla_migration($username,$password)
	{
		// Joomla authentication is md5(password + salt)
		$this->db->select('id, joomla_hash, joomla_salt')->from('users')->where('username',$username);
		
		$query = $this->db->get();
		
		$user = $query->result_array();
		
		// Get joomla data for this username
		$joomla_hash = $user[0]['joomla_hash'];
		$joomla_salt = $user[0]['joomla_salt'];
		
		if ($joomla_hash==md5($password . $joomla_salt))
		{
			return $user[0]['id'];
		}
		else
		{
			return false;
		}
	}
	
	public function facebook_migration($userid)
	{
		// check for facebook user
		$this->db->select('fbconnect,username,password,remember_code')->from('users')->where('fbconnect',$userid);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_all_users()
	{
		$this->db->select('id, email, username')->from('users')->where('active',1);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_users_welcome()
	{
		$this->db->select('id, email, username')->from('users')->where('active',1)->where('welcome',0);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function top_users($limit=5, $start=0)
	{
		$this->db->select('plays.user_id, username, count(*) total_plays')->from('plays');
		$this->db->join('users','plays.user_id = users.id');
		$this->db->where('plays.created > date_sub(current_timestamp, interval 1 month)');
		$this->db->group_by('plays.user_id, username');
		$this->db->order_by('total_plays','desc');
		$this->db->limit($limit, $start);
		
		$query = $this->db->get();
		
		//die(print_r($query));
		
		return $query;
	}

	public function welcome_sent($id)
	{
		$update = array(
			'welcome' => 1,
		);
		
		$this->db->where('id',$id);
		$this->db->update('users', $update);
	}
	
    //Log a user in
    public function LogInUser($session_data){
        //Let see if we can add the user
        if(!$this->AddUser($session_data)){
          return false;
        }
        //Set the session for the user
        $this->session->set_userdata('userdata', $session_data);
        //return true
        return true;
    }

    public function AddUser($insert_array){
        //Lets check and see if we already have the user in the system
        $run_check_query = $this->db->query("SELECT * FROM users WHERE user_id = ".$this->db->escape($insert_array['user_id']).";");
        if($run_check_query->num_rows() > 0) return true;
        //We dont have the user so lets add them to the system
        $insert_user = $this->db->insert_string('users',$insert_array);
        if(!$this->db->query($insert_user)){
            log_message(
                        'error',
                        $this->db->_error_number()  . ':' .
                        $this->db->_error_message() . ':' .
                        $this->db->last_query()
                        );
            return false;
        }
     return true;
    }

}