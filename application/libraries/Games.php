<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games
{
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;
	
	/**
	 * __construct
	 *
	 * @return void
	 * @author Ben
	 **/
	public function __construct()
	{
		$this->ci =& get_instance();
		
	}
	
	public function game_categories($identity)
	{
		$output = $this->ci->games_model->game_categories($identity);
	}
}