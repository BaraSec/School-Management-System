<?php

    if(!isset($_POST['key']) || empty($_POST['key']) || $_SERVER["REQUEST_METHOD"] != "POST")
    	header("location: ../index.php");

	session_start();
	require_once 'DatabaseAPI.php';	    

	function generatePassword($length = 12) {
	    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $count = mb_strlen($chars);

	    for ($i = 0, $result = ''; $i < $length; $i++) 
	    {
	        $index = rand(0, $count - 1);
	        $result .= mb_substr($chars, $index, 1);
	    }

	    return $result;
	}

	if($_POST['key'] == "signin")
	{
		unset($_POST['key']);

		session_start();

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

		$data = $db->select(array("eID", "type", "username"), "employees", "username = '" . $decoded->username . "' and password = '" . sha1($decoded->password) . "'", null, null, null, null);

		if(count($data) != 1) 
		{
			$data = $db->select(array("sID", "username"), "students", "username = '" . $decoded->username . "' and password = '" . sha1($decoded->password) . "'", null, null, null, null);

			 if(count($data) == 1)
			 {
			 	$_SESSION['id'] = $data[0]['sID'];
			  	$_SESSION['userType'] = "Student";
			  	$_SESSION['username'] = $data[0]['username'];

		    echo "student.php";
			 }
			 else
			 	echo "Your credentials are Invalid!";
		}
		else if(count($data) == 1)
		{
		 $_SESSION['id'] = $data[0]['eID'];
		 $_SESSION['userType'] = $data[0]['type'];
		 $_SESSION['username'] = $data[0]['username'];

		 echo strtolower($_SESSION['userType']) . ".php";
		}
	}
	else if($_POST['key'] == "signout")
	{
		unset($_POST['key']);

		session_start();
	
		unset($_SESSION['id']);
		unset($_SESSION['userType']);
		unset($_SESSION['username']);

		session_destroy();
	}
	else if($_POST['key'] == "addFeedback")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

  		$db->insert("feedback", null, array($decoded->name, $decoded->phone, $decoded->email, $decoded->feedback, 0));
	}
	else if($_POST['key'] == "submitApplication")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

  		$db->insert("applications", null, array($decoded->first_name, $decoded->last_name, $decoded->gender, $decoded->average, $decoded->email, $decoded->interests, $decoded->father_name, $decoded->father_job, $decoded->father_phone, $decoded->mother_name, $decoded->mother_job, $decoded->mother_phone, $decoded->payment, $decoded->parents_email, "Pending"));
	}
	else if($_POST['key'] == "addEventNews")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

  		$db->insert($decoded->eventNewsType, null, array($decoded->new_short_story, $decoded->new_full_story));
	}
	else if($_POST['key'] == "loadEventsNews")
	{
		$_target = $_POST['target'];

		unset($_POST['target']);
		unset($_POST['key']);

		$db = new Database();

		if($_target != "events")
			$data = $db->select(array("short_story", "full_story"), $_target, null, null, null, $_target . "ID desc", 3);
		else
			$data = $db->select(array("short_story", "full_story"), $_target, null, null, null, "event" . "ID desc", 3);

		echo json_encode($data);
	}
	else if($_POST['key'] == "updatePW")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

		session_start();

		if($_SESSION['userType'] == "Student")
		{
			$checkCurrPwCorrectness = $db->select(array("sID"), "students", "sID = " . $_SESSION['id'] . " and username = '" . $_SESSION['username'] . "' and password = '" . sha1($decoded->currPW) . "'", null, null, null, null);

			if(count($checkCurrPwCorrectness) != 1)
				die("Wrong current password!");
			
			$db->update("students", "password = '" . sha1($decoded->newPW) . "'", "sID = " . $_SESSION['id']);
		}
		else
		{
			$checkCurrPwCorrectness = $db->select(array("eID"), "employees", "eID = " . $_SESSION['id'] . " and username = '" . $_SESSION['username'] . "' and password = '" . sha1($decoded->currPW) . "'", null, null, null, null);

			if(count($checkCurrPwCorrectness) != 1)
				die("Wrong current password!");
			
			$db->update("employees", "password = '" . sha1($decoded->newPW) . "'", "eID = " . $_SESSION['id']);
		}
	}
	else if($_POST['key'] == "removeTeacher")
	{
		$_teacherRM = $_POST['_teacherRM'];

		unset($_POST['key']);
		unset($_POST['_teacherRM']);

		$db = new Database();

		$checkTeacherExistence = $db->select(array("eID"), "employees", "ID = '" . $_teacherRM . "' and type = 'teacher'", null, null, null, null);

		if(count($checkTeacherExistence) != 1)
			die("Invalid Teacher!");

		$db->delete("employees", "ID = '" . $_teacherRM . "'");
	}
	else if($_POST['key'] == "addTeacher")
	{
		unset($_POST['key']);

		$decoded = json_decode($_POST['obj']);

		$db = new Database();

		$checkTeacherExistence = $db->select(array("eID"), "employees", "ID = '" . $decoded->newT_ID . "' and type = 'teacher'", null, null, null, null);

		if(count($checkTeacherExistence) != 0)
			die("Teacher with this ID already exists!");

		$checkUsernameExistence = $db->select(array("eID"), "employees", "username = '" . $decoded->newT_username . "'", null, null, null, null);

		if(count($checkUsernameExistence) != 0)
			die("Account with this username already exists! Enter another please!");
		else
		{
			$checkUsernameExistence = $db->select(array("sID"), "students", "username = '" . $decoded->newT_username . "'", null, null, null, null);

			if(count($checkUsernameExistence) != 0)
				die("Account with this username already exists! Enter another please!");
		}

		$db->insert("employees", null, array($decoded->newT_ID, $decoded->newT_name, $decoded->newT_gender, $decoded->newT_phone, $decoded->newT_email, $decoded->newT_dob, "Teacher", $decoded->newT_salary, $decoded->newT_username, $decoded->newT_password));
	}
	else if($_POST['key'] == "addSection")
	{
		$_grade = $_POST['grade'];

		unset($_POST['key']);
		unset($_POST['grade']);

		$db = new Database();

		$maxSec = $db->select(array("max(section_number)"), "sections", "grade = " . $_grade, null, null, null, null);

		$db->insertNoNullStart("sections", null, array($_grade, $maxSec[0]['max(section_number)'] + 1));
	}
	else if($_POST['key'] == "getSections")
	{
		$_grade = $_POST['grade'];

		unset($_POST['key']);
		unset($_POST['grade']);

		$db = new Database();

		$data = $db->select(array("section_number"), "sections", "grade = " . $_grade, null, null, null, null);

		echo json_encode($data);
	}
	else if($_POST['key'] == "getSectionsStrict")
	{
		$_grade = $_POST['grade'];

		unset($_POST['key']);
		unset($_POST['grade']);

		$db = new Database();

		$cond = "lec1_teacher = " . $_SESSION['id'];
        for($i = 2; $i <= 8; $i++)
          $cond .= " or lec" . $i . "_teacher = " . $_SESSION['id'];

		$data = $db->select(array("section"), "course_schedule", "grade = " . $_grade . ' and ' . $cond, null, null, null, null);

		echo json_encode($data);
	}
	else if($_POST['key'] == "getSubjectsStrict")
	{
		$_grade = $_POST['grade'];
		$_section = $_POST['section'];

		unset($_POST['key']);
		unset($_POST['grade']);
		unset($_POST['section']);

		$db = new Database();

      	$subs = array();

      	for($i = 1; $i <= 8; $i++)
      	{
      		$data = $db->select(array("lec" . $i . "_subject"), "course_schedule", "grade = " . $_grade . ' and section = ' . $_section . ' and lec' . $i . '_teacher = ' . $_SESSION['id'], null, null, null, null);

      		if($data != null)
      			array_push($subs, $data[0]["lec" . $i . "_subject"]);
      	}

		echo json_encode($subs);
	}
	else if($_POST['key'] == "delSection")
	{
		$_grade = $_POST['grade'];
		$_section = $_POST['section'];

		unset($_POST['key']);
		unset($_POST['grade']);
		unset($_POST['section']);

		$db = new Database();

		$checkExistence = $db->select(array("section_number"), "sections", "grade = " . $_grade . " and section_number = " . $_section, null, null, null, null);

		if(count($checkExistence) != 1)
			die("Grade or that section for the specified grade doesn't exist!");

		$db->delete("sections", "grade = " . $_grade . " and section_number = " . $_section);
	}
	else if($_POST['key'] == "movStd")
	{
		$_sID = $_POST['sID'];
		$_section = $_POST['section'];

		unset($_POST['key']);
		unset($_POST['sID']);
		unset($_POST['section']);

		$db = new Database();

		$db->update("students", "section = " . $_section, "sID = " . $_sID);
	}
	else if($_POST['key'] == "reject")
	{
		$_id = $_POST['id'];

		unset($_POST['key']);
		unset($_POST['id']);

		$db = new Database();

		$db->update("applications", "status = 'Rejected'", "applicID = " . $_id);
	}
	else if($_POST['key'] == "accept")
	{
		$_id = $_POST['id'];

		unset($_POST['key']);
		unset($_POST['id']);

		$db = new Database();

		$db->update("applications", "status = 'Accepted'", "applicID = " . $_id);

  		$applic = $db->select(array("*"), "applications", "applicID = " . $_id, null, null, null, null)[0];

  		$section = $db->select(array("max(section_number)"), "sections", "grade = " . $applic['grade'], null, null, null, null)[0]['max(section_number)'];

  		$username = "Student" . ++$db->select(array("max(sID)"), "students", null, null, null, null, null)[0]['max(sID)'];

  		$password = generatePassword();

  		$db->insert("students", null, array($applic['first_name'], $applic['last_name'], $applic['father_name'], $applic['mother_name'], $applic['father_job'], $applic['mother_job'], $applic['father_phone'], $applic['mother_phone'], $applic['grade'], $section, $applic['email'], $applic['parents_email'], $username, sha1($password)));

  		echo $username . ' | ' . $password;
	}
	else if($_POST['key'] == "updateSched")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

		$eID = $db->select(array("eID"), "employees", "ID = '" . $decoded->updTeacher . "' and type = 'Teacher'", null, null, null, null)[0]["eID"];

		$exists = $db->select(array("section"), "course_schedule", "grade = " . $decoded->updGrade . " and section = " . $decoded->updSec, null, null, null, null);

		if($exists == null)
			$db->insertNoNullStartTwo("course_schedule", array("grade", "section", "lec" . $decoded->updLec . "_teacher", "lec" . $decoded->updLec . "_subject"), array($decoded->updGrade, $decoded->updSec, $eID, $decoded->updSub));
  		else
  			$db->update("course_schedule", "lec" . $decoded->updLec . "_teacher = " . $eID . ", lec" . $decoded->updLec . "_subject = '" . $decoded->updSub . "'", "grade = " . $decoded->updGrade . " and section = " . $decoded->updSec);
	}
	else if($_POST['key'] == "loadStdInfo")
	{
		$_id = $_POST['sID'];

		unset($_POST['key']);
		unset($_POST['sID']);

		$db = new Database();

		$data = $db->select(array("first_name", "last_name", "father_name", "father_job", "father_phone", "mother_name", "mother_job", "mother_phone", "grade", "section", "email", "parents_email", "username"), "students", "sID = " . $_id, null, null, null, null);

		echo json_encode($data);
	}
	else if($_POST['key'] == "loadStudentsM")
	{
		$_grade = $_POST['grade'];
		$_section = $_POST['section'];

		unset($_POST['key']);
		unset($_POST['grade']);
		unset($_POST['section']);

		$db = new Database();

		$data = $db->select(array("first_name", "last_name", "sID"), "students", "grade = " . $_grade . " and section = " . $_section, null, null, null, null);

		echo json_encode($data);
	}
	else if($_POST['key'] == "addMarks")
	{
		unset($_POST['key']);

		$db = new Database();

		$decoded = json_decode($_POST['obj']);

		$db->insert("marks", null, array($decoded->mGrade, $decoded->mSec, $decoded->mSub, $decoded->mName));
	}
	else if($_POST['key'] == "addMarks_Students")
	{
		$_sID = $_POST['sID'];
		$_mark = $_POST['mark'];

		unset($_POST['key']);
		unset($_POST['mark']);
		unset($_POST['sID']);

		$db = new Database();

		$_mID = $db->select(array("max(mID)"), "marks", null, null, null, null, null)[0]["max(mID)"];

		$db->insertNoNullStartTwo("marks_students", null, array($_mID, $_sID, $_mark));
	}
?>