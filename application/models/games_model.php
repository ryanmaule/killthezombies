<?php
class Games_model extends CI_Model {

	private $disqus_key = 'vtfTdTUuVksWZEtbtaurjiZ5FVx4047xPAp1VZes4dF3zYxtZSjQmKwWt56no4KK';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->library('session');
		
		//initialize messages and error
		$this->messages = array();
		$this->errors = array();
	}
	
	// Top 5 Games
	public function game_folders($limit=6, $start=0)
	{
		$this->db->from('folders')->order_by('order_id','asc')->limit($limit, $start);

		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_folder_by_slug($slug)
	{
		$this->db->from('folders')->where('slug',$slug);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_folder_by_id($folder_id)
	{
		$this->db->from('folders')->where('folder_id',$folder_id);
		
		$query = $this->db->get();
		
		return $query;
	}

	// Game Categories
	public function top_games($limit=5, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->order_by('(rating_sum/rating_count)','desc')->order_by('rating_count','desc');
		$this->db->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		return $query;
	}
	
	// Newest Games
	public function new_games($limit=5, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->order_by('games.game_id','desc')->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		return $query;
	}
	
	// Currently Played Games
	public function playing_games($limit=5, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->join('(select game_id, max(created) created from plays group by game_id order by max(created) desc) plays','games.game_id=plays.game_id');
		$this->db->order_by('plays.created','desc')->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		return $query;
	}
	
	// Popular Games
	public function popular_games($limit=5, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->join('plays','plays.game_id = games.game_id')->where('created >',date("Y-m-d",(time() - 60*60*24*30)))->group_by('games.game_id')->order_by('count(*)','desc')->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		//echo $this->db->last_query();
		
		return $query;
	}
	
	// Editors Games
	public function editors_games($limit=5, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->where('description','')->order_by('title','asc')->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		return $query;
	}
	
	// Similar Games
	public function similar_games($limit=5, $folder_id=0)
	{
		/* DISABLED DUE TO FOLDER CONFLICT
		// get number of games
		$this->db->from('games');
		if ($folder_id>0) $this->db->where('folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		$num_games = $query->num_rows;
		
		// generate 20 random numbers
		for ($i=0;$i<=20;$i++) { $nums[] = rand(1,$num_games); }
		
		// force one of the 20 random numbers instead of using mysql RAND()
		*/
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->limit($limit, 0)->order_by('RAND()');
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);

		$query = $this->db->get();
		
		return $query;
	}
	
	// Your Favorite Games
	public function user_games($limit=5, $start=0, $folder_id=0)
	{
	}
	
	public function all_games($limit=9999999, $start=0, $folder_id=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->where('published',1)->order_by('games.game_id','desc')->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_game($slug)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_avg_rating($game_id)
	{
		$this->db->from('ratings')->where('game_id',$game_id);
		$this->db->select_avg('rating');
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result[0]['rating'];
	}
	
	public function play_count($slug)
	{
		$this->db->where('slug', $slug);
		$this->db->set('numplayed', 'numplayed+1', FALSE);
		$this->db->update('games');
		
		// if user, then record the play
		if ($this->ion_auth->logged_in()) 
		{
			$game = $this->get_game($slug)->result_array();
			$data = array(
			   'user_id' => $this->the_user->id,
			   'game_id' => $game[0]['game_id']
			);

			$this->db->insert('plays', $data); 
		}
		
		return true;
	}
	
	public function search($fields, $query, $folder_id=0, $limit=30, $start=0)
	{
		$this->db->from('games');
		$this->db->join('games_folders','games.game_id = games_folders.game_id');
		$this->db->like('title',$query)->limit($limit, $start);
		if ($folder_id>0) $this->db->where('games_folders.folder_id', intval($folder_id));
		$this->db->where('published',1);
		$query = $this->db->get();
		
		return $query;
	}
	
	public function update($game_id, $game)
	{
		$this->db->where('game_id',$game_id);
		$this->db->update('games',$game);
		
		$this->db->where('game_id',$game_id);
		$this->db->update('games_folders',array('folder_id'=>$game['folder_id']));
		
		return true;
	}
	
	public function insert($game)
	{
		$this->db->insert('games',$game);
		$game_id = $this->db->insert_id();
		$this->db->insert('games_folders',array('game_id'=>$game_id,'folder_id'=>$game['folder_id']));
		
		return true;
	}
	
	public function save_rating($game_id, $rating)
	{
		// we want to accept ratings from non-users too.  if none, use session_id to prevent duplicate ratings.
		$user_id = @$this->the_user->id;
		if (empty($user_id)) $user_id = $this->session->userdata('session_id')+1000000;
		
		$this->db->from('ratings')->where('game_id', $game_id)->where('user_id', $user_id);
		$query = $this->db->get();
		
		if ($query->num_rows>0)
		{
			// update
			$this->db->where('game_id', $game_id)->where('user_id', $user_id);
			$this->db->set('rating', $rating);
			$this->db->update('ratings');
			
			// increment
			$result = $query->result_array();
			$old_rating = $result[0]['rating'];
			$this->db->where('game_id', $game_id);
			$this->db->set('rating_sum', 'rating_sum+'.($rating-$old_rating), FALSE);
			$this->db->update('games');
		}
		else
		{
			// insert
			$data = array(
			   'user_id' => $user_id,
			   'game_id' => $game_id,
			   'rating' => $rating
			);

			$this->db->insert('ratings', $data); 
			
			// increment
			$this->db->where('game_id', $game_id);
			$this->db->set('rating_sum', 'rating_sum+'.$rating, FALSE)->set('rating_count', 'rating_count+1', FALSE);
			$this->db->update('games');
		}
		
		return true;
	}
	
	public function user_recent($user_id, $results=4)
	{
		$this->db->select('distinct(games.game_id), title, description, slug, rating_sum, rating_count')->from('plays');
		$this->db->join('games','games.game_id=plays.game_id');
		$this->db->where('user_id', $user_id);
		$this->db->group_by('plays.game_id')->order_by('max(created)', 'desc')->limit($results,0);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function user_recommendations($user_id=0, $results=4)
	{
		$this->db->select('games.game_id, title, description, slug, rating_sum, rating_count')->from('entry');
		$this->db->join('games','games.game_id=entry.game_id');
		$this->db->order_by('entry_date', 'desc')->limit($results,0);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function user_favorites($user_id, $results=4)
	{
		$this->db->select('distinct(games.game_id), title, description, slug, rating_sum, rating_count')->from('plays');
		$this->db->join('games','games.game_id=plays.game_id');
		$this->db->where('user_id', $user_id);
		$this->db->group_by('plays.game_id')->order_by('count(*)', 'desc')->limit($results,0);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function user_rated($user_id, $results=4)
	{
		$this->db->select('games.game_id, title, description, slug, rating_sum, rating_count')->from('ratings');
		$this->db->join('games','games.game_id=ratings.game_id');
		$this->db->where('user_id', $user_id);
		$this->db->limit($results,0);
		
		$query = $this->db->get();
		
		return $query;
	}
	
}