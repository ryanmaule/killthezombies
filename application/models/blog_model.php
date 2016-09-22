<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function get_all_entries($limit=5, $start=0)
    {
        //get all entry
        $this->db->select('*')->from('entry')->join('games', 'games.game_id = entry.game_id')->order_by('entry_date','desc')->limit($limit, $start);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_entry_by_id($entry_id)
    {
    	$this->db->select('*')->from('entry')->join('games', 'games.game_id = entry.game_id')->where('entry_id', $entry_id);
    	$query = $this->db->get();
    	
        return $query->result();
    }
    
    function get_entry_by_slug($entry_slug)
    {
    	$this->db->select('*')->from('entry')->join('games', 'games.game_id = entry.game_id')->where('entry_slug', $entry_slug);
    	$query = $this->db->get();
    	
        return $query->result();
    }
 
    function add_entry($entry)
    {
        $this->db->insert('entry',$entry);
    }
    
    function edit_entry($entry_id, $entry)
    {
    	$this->db->where('entry_id', $entry_id);
        $this->db->update('entry',$entry);
    }
    
    function get_all_features($limit=5, $start=0, $active=true)
    {
        //get all entry
        $this->db->select('*')->from('feature')->join('games', 'games.game_id = feature.game_id');
        if ($active) $this->db->where('active',1);
        $this->db->order_by('feature_date','desc')->limit($limit, $start);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_feature_by_id($feature_id)
    {
    	$this->db->select('*')->from('feature')->where('feature_id', $feature_id);
    	$query = $this->db->get();
    	
        return $query->result();
    }
    
    function get_feature_by_slug($feature_slug)
    {
    	$this->db->select('*')->from('feature')->where('feature_slug', $feature_slug);
    	$query = $this->db->get();
    	
        return $query->result();
    }
 
    function add_feature($feature)
    {
        $this->db->insert('feature',$feature);
    }
    
    function edit_feature($feature_id, $feature)
    {
    	$this->db->where('feature_id', $feature_id);
        $this->db->update('feature',$feature);
    }
}