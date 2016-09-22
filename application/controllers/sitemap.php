<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('sitemaps');
		$this->load->model('games_model');
	}
	
	public function index()
	{
		//assuming a hypothetical posts_model
		$games = $this->games_model->all_games()->result_array();
		
		    foreach ($games AS $game)
		    {
		        $item = array(
		            "loc" => site_url("games/" . $game['slug']),
		            "lastmod" => date("c", strtotime($game['dateadded'])),
		            "changefreq" => "hourly",
		            "priority" => "0.8"
		        );
		
		        $this->sitemaps->add_item($item);
		    }
		    
		// file name may change due to compression
		$file_name = $this->sitemaps->build("sitemap.xml");
		
		$responses = $this->sitemaps->ping(site_url($file_name));
		
		print_r($responses);
	}
}