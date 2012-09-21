<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		
		ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);
		
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		//load libraries
		$this->load->database();
		$this->load->model('register_model');
		
		$this->load->library('table');
		$this->load->helper('url');
		$this->load->library('pagination');
	}
	
	public function index($offset = 0)
	{ 	 
		$PER_PAGE = 15;
		$YES_IMG = '<img src="'.base_url().'assets/images/yes.png" height="16" width="16" alt="Yes" border="0" title="Yes"/>';
		$NO_IMG  = '<img src="'.base_url().'assets/images/no.png"   height="16" width="16" alt="No"  border="0" title="No"/>';

		$data = array();
		$data['header'] = 'BUMPITY BUMP|ADMINISTRATION';
		
		$this->table->set_empty('&nbsp;');
		$this->table->set_heading('ID', 'Name', 'Email', 'Phone', 'Newsletter', 'Address', 'City', 'State', 'Zip', 'Registered');
	
		$total_rows = count($this->register_model->list_users());
		$register = $this->register_model->list_users($offset, $PER_PAGE);
		$num_register = count($register);
	 
		$config = array('uri_segment' => 3, 
						'base_url'    => base_url().'admin',
						'total_rows'  => $total_rows,
						'per_page'    => $PER_PAGE,
						'num_links'   => round($total_rows/$PER_PAGE));
 
		$this->pagination->initialize($config);
		 
		if($num_register > 0)
			for($i=0; $i<$num_register; $i++)
			{			
				$name[$i]    = $register[$i]->first_name .' '. $register[$i]->last_name;
				$email[$i]   = '<a href="mailto:'.$register[$i]->email.'">'.$register[$i]->email.'</a>';
				$address[$i] = $register[$i]->address.' '.$register[$i]->address_suffix;
				$city[$i]    = $register[$i]->city;
				$state[$i]   = $register[$i]->state;
				$zip[$i]     = $register[$i]->zip;
				$date[$i]    = date('M j, Y h:i:s a', strtotime($register[$i]->created));	
		
				if($register[$i]->newsletter == 1)
					$newsletter[$i] = $YES_IMG;
				else $newsletter[$i] = $NO_IMG; 
		
				$this->table->add_row($register[$i]->id, $name[$i], $email[$i], $register[$i]->phone, $newsletter[$i], $address[$i], $city[$i], $state[$i], $zip[$i], $date[$i]);
			}
		else $this->table->add_row(NULL, 'NO DATA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		
		
		$data['table'] = $this->table->generate();
		
		$this->load->view('admin', $data);
	}
	
	
	
	public function admin_list()
	{
		$data['header'] = 'BUMP AJAX CALLS';
		$offset = 0;
		$limit = 10;
		$register = $this->register_model->list_users($offset, $limit);
		foreach($register as $r)
			$r->created = date('M j, Y h:i:s a', strtotime($r->created));
			
		$data['register'] = $register;
		$data['num_rows'] = count($this->register_model->list_users($offset, $limit));
		
		$this->load->view('admin_list', $data);
		
	}
	
	public function get_list_ajax()
	{
		$offset = $this->input->post('offset');
		$limit = $this->input->post('limit');
		 
		$register = $this->register_model->list_users($offset, $limit);
		
		$offset = $offset + $limit;
		$data = array('register' => $register, 'offset'=>$offset, 'limit'=>$limit);
		
		header('content-type: application/json');
		echo json_encode($data);
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */