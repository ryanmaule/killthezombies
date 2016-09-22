<?php
class Seo_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->library('session');
		
		$this->load->model('games_model');
		
		//initialize messages and error
		$this->messages = array();
		$this->errors = array();
	}
	
	public function description()
	{
		$section = $this->uri->segment(1);
		$subsection = $this->uri->segment(2);
		
		// For games
		$result = $this->games_model->get_game($subsection);
		$game = $result->result_array();
		$description = @$game[0]['description'];
		
		$description = substr($description, 0, strpos(wordwrap($description, 155), "\n"));
		
		return $description;
	}
	
	public function title()
	{
		$title = 'Zombie Games | Be A Zombie Killer';
		if ($this->uri->segment(2)) $title = ucwords(str_replace('-',' ',$this->uri->segment(2)));
		if ($this->uri->segment(1)) $title .= ' | ' . ucwords(str_replace('-',' ',$this->uri->segment(1)));
		
		return $title;
	}

}