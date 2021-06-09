<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('Customer_model');
		$this->load->model('Crud_model');
		$this->load->library('email');
	}
	public function emailconfig()
	{
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'xxx@gmail.com';//email
		$config['smtp_pass']    = 'xxxx';//password
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not      

		$this->email->initialize($config);

	}
	public function Customerlogin()
	{
		
		$data=$this->input->post();
		$datas= $this->Customer_model->login($data);
        echo (json_encode($datas));
        
	}
	public function Customerinsert()
	{
		$data['f_user_name']=$this->input->post('f_user_name');
		$data['f_user_phoneno']=$this->input->post('f_user_phoneno');
		$data['f_user_email']=$this->input->post('f_user_email');
		$data['f_user_password']=md5($this->input->post('f_user_password'));
		$data['f_user_created_at']=date('Y/m/d h:i:s');
		$where=array('f_user_email' =>$data['f_user_email']);
		$emailvaild=$this->Crud_model->get_row('tbl_user',$where);
		// print_r($emailvaild);
		if(empty($emailvaild))
		{
			$datainsert= $this->Crud_model->insert('tbl_user',$data);
			$datas['process']=true;
        	$datas['message']='Success Full Registered Please Login';
		}
		else{
			$datas['process']=false;
        	$datas['message']='Alrady Registered';
		}
		echo (json_encode($datas));
	}
	public function dashboard()
	{
		if (isset($_SESSION['cust_userId'])) {
		
		$where=array('id' =>$_SESSION['cust_userId']);
		$data['data']=$this->Crud_model->get_row('tbl_user',$where);
		$this->load->view('header1');
		$this->load->view('dashboard_user',$data);
		$this->load->view('footer');
	    }
	    else{
	    	$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	    }
	}
	public function bookingdatalist()
	{
		
		$query=$this->db->select('tbl_workshop.f_workshop_name,tbl_workshop.f_workshop_phono,tbl_booking.f_workshop_type,tbl_booking.f_workshop_date,tbl_booking.f_workshop_booking_at,tbl_booking.f_workshop_status')
        ->from('tbl_workshop')
        ->join('tbl_booking', 'tbl_workshop.id = tbl_booking.f_workshop_id')
        ->where('tbl_booking.f_customer_id',$_SESSION['cust_userId'])->get();
		$data['data']=$query->result_array();
		$data['serviceat']=array(
			'1'=>'General service check-up',
			'2'=>'Oil change',
			'3'=>'Water wash'
		);
		//print_r($data['data']);die();
		$this->load->view('header1');
		$this->load->view('bookinglist_user',$data);
		$this->load->view('footer');
	}
	public function Customerbooking()
	{
		$data=$this->input->post();
		$data['f_workshop_booking_at']=date('Y/m/d');
		$data['f_workshop_status']='pending';
		$datainsert= $this->Crud_model->insert('tbl_booking',$data);
		$email= $this->Customer_model->emailsending($data);
		$this->emailconfig();
		$data['serviceat']=array(
			'1'=>'General service check-up',
			'2'=>'Oil change',
			'3'=>'Water wash'
		);
		$service=$data['serviceat'][$this->input->post('f_workshop_type')];
		$where=array('id' =>$data['f_workshop_id']);
		$data['data']=$this->Crud_model->get_row('tbl_workshop',$where);
		$where1=array('id' =>$data['f_customer_id']);
		$data['datalist']=$this->Crud_model->get_row('tbl_user',$where1);
		$text='<html> <body> <div class="container"> <h2>Booked Sucessfull</h2> <p>Customer name:'.$data['datalist']['f_user_name'].'</p><p>Customer PhoneNo:'.$data['datalist']['f_user_phoneno'].'</p> <p>Customer ServiceAt:'.$service.'</p> </div> <center>Thankyou</center> </body> </html>';
       $this->email->from('adminbikeservice@gmail.com', 'sender_name');
       $this->email->to($data['datalist']['f_user_email']); 
       $this->email->subject('Booking');
       $this->email->message($text);  
       $this->email->send();
       // echo $this->email->print_debugger();
		$datas['process']=true;
        $datas['message']='booked';

        echo (json_encode($datas));
	}
}
