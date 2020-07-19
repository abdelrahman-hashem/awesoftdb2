<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->helper('url');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style.css">
</head>

<body>
	<div class="answerbox">
        <h4>Ansewrs Of This Question</h4>
		<form id="answerform" name="answerdashboard" action="<?php echo base_url(); ?>index.php/welcome/doanswerdashboard" method="post" onsubmit="return validateForm()">   
        <label for="question">Question</label><br>
        <input type="hidden" name="qid" value="<?php echo $quinfo->qid ?>">
            <input type="text" id="qid" name="question" value="<?php echo $quinfo->question ?>"><br>

            <ul class="userlistn">

            <?php foreach ($answers as $answer)
            {
                echo"<a ><li>$answer->answer   (posted by $answer->Username)</li></a>";
                
            }
            ?>
            </ul>
            <label></label>Add your answer in the field below</label><br>
            <input type="text" id="qid" name="answer" value="" required><br>

			<input type="submit" value="Add new answer">
        </form>
        <form action="http://localhost/awesoftdb1/index.php/welcome/dashboardq">
			<input type="submit" value="Back" >
			</form>
	</div>
</body>

</html>