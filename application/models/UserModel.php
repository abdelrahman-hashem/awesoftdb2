<?php
class UserModel extends CI_Model
{


  function __construct()
  {
    parent::__construct();
  }

  function getUsers()
  {
    $sql = "select * from Users";
    $query = $this->db->query($sql);
    $toSend = array();

    foreach ($query->result() as $x) {
      $toSend[] = $x;
    }
    return $toSend;
  }

  function getUserByID($uid)
  {
    $sql = "select * from Users where uid=$uid";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //make a new method here that will be called from the dashbaord method in the controller
  //this function is going to go to the database and fetch the username based on uid. return it in the results
  function getUserName($uid)
  {
    $sql = "select Username from Users where uid = '$uid'";
    $query = $this->db->query($sql);
    return $query->row()->Username;
  }

  function verfiylogin($user, $pass)
  {
    $sql = "select * from Users where username = '$user' and password= '$pass'";
    $query = $this->db->query($sql);
    $result = $query->result();
    if (count($result) == 0) {
      return 0;
    } else {
      return $query->row()->uid;
    }
  }

  function addnewuser($Username, $email, $occupation, $date, $password)
  {
    $sql = "INSERT INTO `Users`(`Username`, `password`, `email`, `occupation`, `date`) VALUES ('$Username','$password','$email', '$occupation', '$date')";
    $query = $this->db->query($sql); 
  }

  function edituser($uid, $username, $email, $password, $occupation, $date)
  {
    $sql = "UPDATE `Users` SET `Username`='$username',`password`='$password',`email`='$email',`occupation`='$occupation',`date`='$date' WHERE uid=$uid";
    $query = $this->db->query($sql);
  }
  function getqu()
  {
    $sql = "select * from question";
    $query = $this->db->query($sql);
    $toSend = array();

    foreach ($query->result() as $x) {
      $toSend[] = $x;
    }
    return $toSend;
  }
  function getQuByID($qid)
  {
    $sql = "select * from question where qid=$qid";
    $query = $this->db->query($sql);

    return $query->result();
  }
  function addnewqu($question, $uid)
  {
    $sql = "INSERT INTO `question`( `question`, `uid`) VALUES ('$question','$uid')";
    $query = $this->db->query($sql);
  }

  function editqu($qid, $username, $question, $answer)
  {
    $sql = "UPDATE `question` SET `Username`='$username',`question`='$question',`answer`='$answer' WHERE qid=$qid";
    $query = $this->db->query($sql);
  }
  function getUserByIDqu($username)
  {
    $sql = "select `uid` from Users where Username=$username";
    $query = $this->db->query($sql);
    return $query->result();
  }
  function answerdashboard($qid, $question)
  
  {
   $sql = "UPDATE `question` SET `question`='$question' WHERE qid=$qid";
   $query = $this->db->query($sql);
  }
  function getAnswerByQid($qid)
  {
    $sql="SELECT answer.answer, users.Username FROM answer INNER JOIN users ON answer.uid = users.uid where answer.qid = $qid";
    $query = $this->db->query($sql);
    $toSend = array();
    foreach ($query->result() as $x)
    {
      $toSend[] =$x;
    }
    return $toSend;
  }
  function doaddanswer($qid, $answer, $uid)
  {
  $sql = "INSERT INTO `answer`(`qid`,`answer`,`uid`) VALUES ('$qid','$answer', '$uid') ";
  $query = $this->db->query($sql);
}
}
