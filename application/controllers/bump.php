<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bump extends CI_Controller {

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
		
		// load libraries
		$this->load->database();
		$this->load->model('register_model');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
		 
	public function index()
	{	 
		$data = array();
		$data['header'] = 'BUMPITY BUMP';

		$validation_rules = array(
			array('field' => 'first-name',     'label' => 'First Name',     'rules' => 'trim|required|min_length[2]|max_length[64]|xss_clean|alpha'),
			array('field' => 'last-name',  	   'label' => 'Last Name',      'rules' => 'trim|required|min_length[2]|max_length[64]|xss_clean|alpha'),
			array('field' => 'email',          'label' => 'Email',          'rules' => 'trim|required|min_length[2]|max_length[32]|xss_clean|valid_email'),
			array('field' => 'phone',          'label' => 'Phone',          'rules' => 'trim|numeric|exact_length[10]'),
			array('field' => 'newsletter',     'label' => 'Newsletter',     'rules' => "trim|xss_clean"),
			array('field' => 'address',        'label' => 'Address',        'rules' => 'trim|xss_clean'),
			array('field' => 'address-suffix', 'label' => 'Address Suffix', 'rules' => 'trim|xss_clean|alpha_numeric'),
			array('field' => 'city',           'label' => 'City',           'rules' => 'trim|xss_clean'),
			array('field' => 'state',          'label' => 'State',          'rules' => NULL),
			array('field' => 'zip',            'label' => 'Zip',            'rules' => 'trim|xss_clean|numeric|exact_length[5]')
		);
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		$this->form_validation->set_rules($validation_rules);
		
		if($this->form_validation->run() == FALSE)
			$this->load->view('bump', $data);
		 
		else
		{
			// create a encrypted id for each registered user, also clean data for record.
			$STRLEN = 8;
			$register_id = substr(sha1(crypt(time().uniqid().$this->config->item('encryption_key'))),0, $STRLEN);
			$newsletter = $this->input->post('newsletter');
			
			if($newsletter == 'on')
				$newsletter = TRUE;
			else $newsletter = 0;
			
			$phone = $this->input->post('phone');
			if(!empty($phone))
				$phone = substr($phone, 0, 3).'-'.substr($phone, 3, 3).'-'.substr($phone, 6, 4);
			else $phone = NULL;
			
			$register_data = array('register_id'     => $register_id,
									'first_name'     => ucwords(strtolower($this->input->post('first-name'))),
									'last_name'      => ucwords(strtolower($this->input->post('last-name'))),
									'email'          => strtolower($this->input->post('email')),
									'phone'          => $phone,
									'newsletter'     => $newsletter,
									'address'        => ucwords($this->input->post('address')),
									'address_suffix' => $this->input->post('address-suffix'),
									'city'	         => ucwords($this->input->post('city')),
									'state'          => $this->input->post('state'),
									'zip'            => $this->input->post('zip'),
									'created'        => date('Y-m-d h:i:s'));

			if($this->register_model->add($register_data) == TRUE)
				$this->load->view('success', $data);
			else '<p>ERROR! Data did not get inserted into db</p>';
		}
	}
	
	
	public function test()
	{
		$alpha = 'abcdefghijklmnopqrstuvwxyz';
		$alpha_size = strlen($alpha);
		$state_list = array(
							"AL",
							"AK", 
							"AZ", 
							"AR", 
							"CA", 
							'CO', 
							'CT', 
							'DE', 
							'DC', 
							'FL', 
							'GA', 
							'HI', 
							'ID', 
							'IL', 
							'IN', 
							'IA', 
							'KS', 
							'KY', 
							'LA', 
							'ME', 
							'MD', 
							'MA', 
							'MI', 
							'MN', 
							'MS', 
							'MO', 
							'MT',
							'NE',
							'NV',
							'NH',
							'NJ',
							'NM',
							'NY',
							'NC',
							'ND',
							'OH', 
							'OK', 
							'OR', 
							'PA', 
							'RI', 
							'SC', 
							'SD',
							'TN', 
							'TX', 
							'UT', 
							'VT', 
							'VA', 
							'WA', 
							'WV', 
							'WI', 
							'WY');
	
		$state_size = count($state_list);
		$domain = array('.org', '.com', '.net', '.biz', '.co.uk');
		$domain_size = count($domain);
		
		for($i=0; $i<100; $i++)
		{
			$first_name = $last_name = $email = $zip = $city = $address = $state = $address_suffix = $phone = NULL;
			$register_id = substr(sha1(crypt(time().uniqid().$this->config->item('encryption_key'))),0,8);

			$rand = mt_rand(3, 16);
			for($j=0; $j<$rand; $j++)
				$first_name .= substr($alpha, mt_rand(0,$alpha_size-1),1);
				
			$rand = mt_rand(3, 16);
			for($j=0; $j<$rand; $j++)
				$last_name .= substr($alpha, mt_rand(0,$alpha_size-1),1);
			
			$rand = mt_rand(3, 10);
			for($j=0; $j<$rand; $j++)
				$last_name .= substr($alpha, mt_rand(0,$alpha_size-1),1);
			
			$rand = mt_rand(3, 10);
			for($j=0; $j<$rand; $j++)
				$email .= substr($alpha, mt_rand(0,$alpha_size-1),1); 
			 
			$email .= '@';
			$rand = mt_rand(3, 10);
			for($j=0; $j<$rand; $j++)
				$email .= substr($alpha, mt_rand(0,$alpha_size-1),1); 
			$email .= $domain[mt_rand(0, $domain_size-1)];	
			 
			for($j=0; $j<10; $j++)
				$phone .= mt_rand(0,9);
			
			$phone = substr($phone, 0,3).'-'.substr($phone, 3,3).'-'.substr($phone, 6,4);
			
			
			$newsletter = mt_rand(0,1);
			if($newsletter == 1)
			{	
				$address .= mt_rand(100, 999).' ';
				$rand = mt_rand(4, 10);
				for($j=0; $j<$rand; $j++)
					$address .= substr($alpha, mt_rand(0,$alpha_size-1),1);
				
				$rand = mt_rand(0,1);
				if($rand == 0)
					$address_suffix = substr($alpha, mt_rand(0,$alpha_size-1),1);
				else if($rand == 1)
					$address_suffix = mt_rand(0,100);
				
				
				$rand = mt_rand(3, 15);
				for($j=0; $j<$rand; $j++)
					$city .= substr($alpha, mt_rand(0,$alpha_size-1),1);
		
				$state = $state_list[mt_rand(0,49)];
				$zip = mt_rand(11111, 99999);
			}
			
			$created = date('Y-m-d H:i:s', mt_rand((time()-(60*60*24*30)), (time()+(60*60*24*30))));
				
			$register_data = array('register_id'     => $register_id,
									'first_name'     => ucwords($first_name),
									'last_name'      => ucwords(strtolower($last_name)),
									'email'          => strtolower($email),
									'phone'          => $phone,
									'newsletter'     => $newsletter,
									'address'        => ucwords($address),
									'address_suffix' => $address_suffix,
									'city'	         => ucwords($city),
									'state'          => $state,
									'zip'            => $zip,
									'created'        => $created);
		
			print_r($register_data);
			$this->register_model->add($register_data);
		}
	}
}

/* End of file bump.php */
/* Location: ./application/controllers/bump.php */