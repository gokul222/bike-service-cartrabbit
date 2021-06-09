<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

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
	public function Vendorlogin()
	{
		
		$data=$this->input->post();
		$datas= $this->Customer_model->vendorlogin($data);
        echo (json_encode($datas));
        
	}
	public function Vendorinsert()
	{
		//$data=$this->input->post();print_r($_FILES);die();
		// die();
		$data['f_workshop_name']=$this->input->post('f_workshop_name');
		$data['f_workshop_phono']=$this->input->post('f_workshop_phono');
		$data['f_workshop_desc']=$this->input->post('f_workshop_desc');
		$data['f_workshop_disc']=$this->input->post('f_workshop_disc');
		$data['f_workshop_email']=$this->input->post('f_workshop_email');
		$data['f_workshop_password']=md5($this->input->post('f_workshop_password'));
		$data['f_workshop_status']=1;
		$data['f_created_at']=date('Y/m/d h:i:s');
		$where=array('f_workshop_email' =>$data['f_workshop_email']);
		$emailvaild=$this->Crud_model->get_row('tbl_workshop',$where);
		// print_r($emailvaild);
		if(empty($emailvaild))
		{
			if(!empty($_FILES['f_workshop_photo'])){
                    
				print_r('ff');
                        $file_name = 'vendor_'.rand(1,9999).'_logo'. $_FILES['f_workshop_photo']['name'];
                        $file_size =$_FILES['f_workshop_photo']['size'];
                        $file_tmp =$_FILES['f_workshop_photo']['tmp_name'];
                        $file_type=$_FILES['f_workshop_photo']['type'];

                            if(move_uploaded_file($file_tmp,"image/".$file_name)) {
                            $data['f_workshop_photo']='image/'.$file_name;
                             // $update = $this->db->updateRow($image_id, $this->table, "`pduser_id`='" . $insert_id . "' ");
                            }
                        }
             
			// $data['f_workshop_status']=;
			$datainsert= $this->Crud_model->insert('tbl_workshop',$data);
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
		if (isset($_SESSION['vendor_userId'])) {
		
		$where=array('id' =>$_SESSION['vendor_userId']);
		$data['data']=$this->Crud_model->get_row('tbl_workshop',$where);
		$this->load->view('header1');
		$this->load->view('dashboard_vendor',$data);
		$this->load->view('footer');
	    }
	    else{
	    $this->load->view('header');
		$this->load->view('loginvendor');
		$this->load->view('footer');
	    }
	}
	public function bookingdatalist()
	{
		
		$query=$this->db->select('tbl_booking.id as bookid,tbl_user.f_user_name,tbl_user.f_user_email,tbl_user.f_user_phoneno,tbl_booking.f_workshop_type,tbl_booking.f_workshop_date,tbl_booking.f_workshop_booking_at,tbl_booking.f_workshop_status')
        ->from('tbl_workshop')
        ->join('tbl_booking', 'tbl_workshop.id = tbl_booking.f_workshop_id')
        ->join('tbl_user', 'tbl_user.id = tbl_booking.f_customer_id')
        ->where('tbl_booking.f_workshop_id',$_SESSION['vendor_userId'])->get();
		$data['data']=$query->result_array();
		$data['serviceat']=array(
			'1'=>'General service check-up',
			'2'=>'Oil change',
			'3'=>'Water wash'
		);
		//print_r($data['data']);die();
		$this->load->view('header1');
		$this->load->view('bookinglist_vendor',$data);
		$this->load->view('footer');
	}
	public function bookingdatalistupdate()
	{
		$data['id']=$this->input->post('workshop_id');
		$var=array('f_workshop_status'=>$this->input->post('f_workshop_type'));
		$where=array('id' =>$data['id']);
		if($this->input->post('f_workshop_type')=='completed')
		{
			$data['serviceat']=array(
			'1'=>'General service check-up',
			'2'=>'Oil change',
			'3'=>'Water wash'
		     );
		    $data['datalist']=$this->Crud_model->get_row('tbl_booking',$where);
			$where12=array('id' =>$data['datalist']['f_workshop_id']);
		    $data['data']=$this->Crud_model->get_row('tbl_workshop',$where12);	
		    $where1=array('id' =>$data['datalist']['f_customer_id']);
		    $data['datalist1']=$this->Crud_model->get_row('tbl_user',$where1);
			$this->emailconfig();
		    $service=$data['serviceat'][$data['datalist']['f_workshop_type']];
			$text='<html> <body> <div class="container"> <h2>Develiry Mode</h2> <p>Vendor name:'.$data['data']['f_workshop_name'].'</p><p>Vendor PhoneNo:'.$data['data']['f_workshop_phono'].'</p> <p>Customer ServiceAt:'.$service.'</p> </div> <center>Thankyou</center> </body> </html>';
       			$this->email->from('adminbikeservice@gmail.com', 'sender_name');
       			$this->email->to($data['datalist1']['f_user_email']); 
       			$this->email->subject('Booking Sucessfull');
       			$this->email->message($text);  
       			$this->email->send();
		}
		$emailvaild=$this->Crud_model->update('tbl_booking',$var,$where);
		$this->bookingdatalist();
	}
	public function bookingview()
	{
		
		$query=$this->db->select('tbl_booking.id as bookid,tbl_user.f_user_name,tbl_user.f_user_email,tbl_user.f_user_phoneno,tbl_booking.f_workshop_type,tbl_booking.f_workshop_date,tbl_booking.f_workshop_booking_at,tbl_booking.f_workshop_status')
        ->from('tbl_workshop')
        ->join('tbl_booking', 'tbl_workshop.id = tbl_booking.f_workshop_id')
        ->join('tbl_user', 'tbl_user.id = tbl_booking.f_customer_id')
        ->where('tbl_booking.id',$_GET['id'])->get();
		$data['data']=$query->result_array();
		$data['serviceat']=array(
			'1'=>'General service check-up',
			'2'=>'Oil change',
			'3'=>'Water wash'
		);
		//print_r($data['data']);die();
		$this->load->view('header1');
		$this->load->view('bookinglist_vendor_view',$data);
		$this->load->view('footer');
	}
	
}
