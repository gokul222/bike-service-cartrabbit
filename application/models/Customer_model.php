<?php
class Customer_model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
	}

	public function login($data)
	{
		$username=$data['f_user_name'];
		$pwd=md5($data['f_user_password']);
		  $query=$this->db->select('*')->from('tbl_user')->where('f_user_email',$username,'f_user_password',$pwd)->get();
         $data= $query->result_array();
         if(!empty($data))
        {
       		 if($data[0]['f_user_email']==$username &&$data[0]['f_user_password']==$pwd)
        		{
        			$this->session->set_userdata('cust_userId', $data[0]['id']);
        			$datas['process']=true;
        			$datas['message']='Success Full Login';
        			$datas['location']=base_url().'/customer/dashboard';
        		}
        		else
        		{
        			$datas['process']=false;
        			$datas['message']='Please Check UserEmail And Password';
        		}			
        }
        else
        {
        	$datas['process']=false;
        	$datas['message']='Please register';
        }
        return $datas;
	}
    public function vendorlogin($data)
    {
        $username=$data['f_user_name'];
        $pwd=md5($data['f_user_password']);
          $query=$this->db->select('*')->from('tbl_workshop')->where('f_workshop_email',$username,'f_workshop_password',$pwd)->get();
         $data= $query->result_array();
         if(!empty($data))
        {
             if($data[0]['f_workshop_email']==$username &&$data[0]['f_workshop_password']==$pwd)
                {
                    $this->session->set_userdata('vendor_userId', $data[0]['id']);
                    $datas['process']=true;
                    $datas['message']='Success Full Login';
                    $datas['location']=base_url().'/vendor/dashboard';
                }
                else
                {
                    $datas['process']=false;
                    $datas['message']='Please Check UserEmail And Password';
                }           
        }
        else
        {
            $datas['process']=false;
            $datas['message']='Please register';
        }
        return $datas;
    }
	public function emailsending($data)
	{
	}
}
