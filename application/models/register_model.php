<?php 
class register_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($data)
	{
		$this->db->insert('register', $data);
		
		if($this->db->count_all_results() > 0)
			return(TRUE);
		else return(FALSE);
					
	}
	
	public function list_users($offset = NULL, $limit = NULL)
	{ 
		if(isset($limit) && isset($offset))
			$q = $this->db->get('register', $limit, $offset);
		else $q = $this->db->get('register');
		        
        foreach($q->result() as $row)
            $data[] = $row;
        
        if(!isset($data))
            $data = NULL;
        
        return($data);
	}
}
?>