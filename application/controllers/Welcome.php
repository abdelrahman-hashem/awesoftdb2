<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('UserModel');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('login');
	}
	public function dologin()	
	{if (isset($_POST)) {
		$formusername = $_POST["username"];
		$formpassword = $_POST["password"];
		$result = $this->UserModel->verfiylogin($formusername, $formpassword);
		if ($result != 0) {
			$this->session->set_userdata("isuserloggedin", "true");
			$this->session->set_userdata("uid", $result);
			redirect('welcome/dashboardq');
		} else {
			echo "username and password are incorrect";
		}
	}}
	public function dashboard()
	{
		$uid = $this->session->userdata('uid');
		//1- make a call to a method in the model
		//2- after the call is sucessful, load the data to the view below
		$result = $this->UserModel->getUserName($uid);
		$all_users = $this->UserModel->getUsers();
		$data = array();
		$data['username'] = $result;
		$data['users'] = $all_users;
		$this->load->view('userdashboard/dashboard', $data);
	}

	public function adduser()
	{

		$this->load->view('userdashboard/adduser');
	}
	public function doadduser()
	{
		$formusername = $this->input->post("username");
		$formemail = $this->input->post("email");
		$formoccupation = $this->input->post("occupation");
		$formdate = $this->input->post("date");
		$formpassword = $this->input->post("password");
		$this->UserModel->addnewuser($formusername, $formemail, $formoccupation, $formdate, $formpassword);
		redirect('');
	}

	public function edituser()
	{
		$userid = $this->input->get("id");
		$userinfo = $this->UserModel->getUserByID($userid);
		$data = array();
		$data['userinfo'] = array_pop($userinfo);
		$this->load->view("userdashboard/edituser", $data);
	}
	public function doedituser()
	{
		$formusername = $this->input->post("username");
		$formemail = $this->input->post("email");
		$formpassword = $this->input->post("password");
		$formoccupation = $this->input->post("occupation");
		$formdate = $this->input->post("date");
		$uid = $this->input->post("uid");
		$this->UserModel->edituser($uid, $formusername, $formemail, $formpassword, $formoccupation, $formdate);
		redirect('welcome/dashboard');
	}

	public function showAllUsers()
	{
		$all_users = $this->UserModel->getUsers();
		$data = array();
		$data['users'] = $all_users;
		$this->load->view('welcome_message', $data);
	}


	public function dashboardq()
	{
		$uid = $this->session->userdata('uid');
		//1- make a call to a method in the model
		//2- after the call is sucessful, load the data to the view below
		$result = $this->UserModel->getUserName($uid);
		$all_questions = $this->UserModel->getqu();
		$data = array();
		$data['username'] = $result;
		$data['questions'] = $all_questions;
		$this->load->view('userdashboard/qdashboard', $data);
	}

	public function showAllQu()
	{
		$all_questions = $this->UserModel->getqu();
		$data = array();
		$data['questions'] = $all_questions;
		$this->load->view('welcome_messageq', $data);
	}
	public function addqu()
	{

		//$uid = $this->input->get("uid");
		//$userinfo = $this->UserModel->getUserByID($uid);
		//$data = array();
		//$data['userinfo'] = array_pop($userinfo);
		$this->load->view("userdashboard/addqu");
	}

	public function doaddqu()
	{
		$uid = $this->session->userdata('uid');
		$formquestion = $this->input->post("question");
		$this->UserModel->addnewqu($formquestion, $uid);
		redirect('welcome/dashboardq');
	}

	public function editqu()
	{
		$qid = $this->input->get("qid");
		$quinfo = $this->UserModel->getQuByID($qid);
		$data = array();
		$data['quinfo'] = array_pop($quinfo);
		$this->load->view("userdashboard/editqu", $data);
	}
	public function doeditqu()
	{
		$formusername = $this->input->post("username");
		$formquestion = $this->input->post("question");
		$formanswer = $this->input->post("answer");
		$qid = $this->input->post("qid");
		$this->UserModel->editqu($qid, $formusername, $formquestion, $formanswer);
		redirect('welcome/qdashboard');
	}
	public function answerdashboard()
	{
		$qid = $this->input->get('qid');
		$quinfo = $this->UserModel->getQuById("$qid");
		$answers = $this->UserModel->getAnswerByQid("$qid");
		$data = array();
		$data['quinfo'] = array_pop($quinfo);
		$data['answers'] = ($answers);
		$this->load->view("userdashboard/answerdashboard", $data);
	}
	public function doanswerdashboard()
	{
	 $uid = $this->session->userdata('uid');
	 $formanswer = $this->input->post("answer");
	 $qid = $this->input->post("qid");
	 $this->UserModel->doaddanswer($qid, $formanswer, $uid);
	 redirect('Welcome/dashboardq');
	}
	function logout()
    {
        session_destroy();
        redirect("login");
    }
}
