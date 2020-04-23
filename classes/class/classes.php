<?php
require_once 'dbconfig.php';

class USER
{
private $conn;

public function __construct()
  {
  $database = new Database();
	$db = $database->dbConnection();
  $this->conn = $db;


  #create the uuid table
  $sql1 ="
  CREATE TABLE IF NOT EXISTS ihs_uuid(
  uuid VARCHAR(255) PRIMARY KEY NOT NULL,
  email VARCHAR(100) NOT NULL,
  created_at varchar(100),
  created_by_firstname VARCHAR(100) NOT NULL,
  created_by_lastname VARCHAR(100) NOT NULL,
  updated_at varchar(100),
  updated_by_firstname VARCHAR(100) DEFAULT NULL,
  updated_by_lastname VARCHAR(100) DEFAULT NULL
  )ENGINE=MyISAM DEFAULT CHARSET=utf8;
  ";
  $this->conn->exec($sql1);

 $sql2 =
  "CREATE TABLE IF NOT EXISTS `ihs_users` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `uuid` varchar(255) NOT NULL,
    `firstname` varchar(255) NOT NULL,
    `middlename` varchar(255) DEFAULT NULL,
    `lastname` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` varchar(50) NOT NULL,
    `userStatus` enum('Y','N') DEFAULT 'N',
    `code` varchar(100) DEFAULT NULL,
    `last_logged_in` varchar(50) DEFAULT NULL,
    `access_status` enum('OK','Restricted') DEFAULT 'Restricted',
    `created_at` varchar(100),
    `created_by_firstname` varchar(100) NOT NULL,
    `created_by_lastname` varchar(100) NOT NULL,
    `updated_at` varchar(100),
    `updated_by_firstname` varchar(100) DEFAULT NULL,
    `updated_by_lastname` varchar(100) DEFAULT NULL,
  FOREIGN KEY (uuid)
  REFERENCES ihs_uuid(uuid)
  ON UPDATE CASCADE
  ON DELETE CASCADE
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  INSERT INTO `ihs_users` (`id`, `uuid`, `firstname`, `middlename`, `lastname`, `email`, `password`, `role`, `userStatus`, `code`, `last_logged_in`, `access_status`, `created_at`, `created_by_firstname`, `created_by_lastname`, `updated_at`, `updated_by_firstname`, `updated_by_lastname`) VALUES
  (1, '75b1d11de6a4bb71d7057d3f44aaf8079a1c10fb36b030d991693e988ae5fc396e7fcd3a246e37e9a6ce45c6857427cf7a72', 'l064xcvrQ+KqiACxJkspsw==', NULL, 'jkfwH0L03ZTvBK0LIWwE6w==', 'r6TppR8eFavexNmWXTNyk+2LqhPDGlq5z492eRPr8NU=', 'h2pJ9R66xPp658byPqjZjGlW1qO0dOjbt06d/F3UAQI=', 'Admin', 'Y', '148f37eb56546d38a950', NULL, 'OK', '2020-04-23 06:30:00', '/yVgGxBKo5oyf/5C+gNxcA==', 'EySvf+MgEwj5yDRvN1au4Q==', '2020-04-23 06:30:00', NULL, NULL);";
  $this->conn->exec($sql2);


 //CREATE THE USER PERMISSIONS TABLE
  $sql2 =
  "CREATE TABLE IF NOT EXISTS ihs_user_permissions(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  uuid VARCHAR(250) DEFAULT NULL,
  email VARCHAR(250) DEFAULT NULL,
  permissions TEXT,
  FOREIGN KEY (uuid)
  REFERENCES ihs_uuid(uuid)
  ON UPDATE CASCADE
  ON DELETE CASCADE
  )ENGINE=MyISAM DEFAULT CHARSET=utf8;
  INSERT INTO `ihs_user_permissions` (`id`, `email`, `permissions`) VALUES
  (3, 'r6TppR8eFavexNmWXTNyk+2LqhPDGlq5z492eRPr8NU=', 'classrooms users_account updates pre_k grade_k grade_1 grade_2 grade_3 grade_4 grade_5 grade_6 grade_7 grade_8 grade_9 grade_10 grade_11 pre_k_teacher grade_1_teacher grade_1_teacher grade_2_teacher grade_3_teacher grade_4_teacher grade_5_teacher grade_6_teacher grade_7_teacher grade_8_teacher grade_9_teacher grade_10_teacher grade_11_teacher');
  ";
  $this->conn->exec($sql2);

//CREATE THE PERMISSIONS TABLE
 $sql3 =
 "CREATE TABLE IF NOT EXISTS ihs_permissions(
 id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 permission_name VARCHAR(100),
 permission_group VARCHAR(100)
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 INSERT INTO `ihs_permissions` VALUES (1, 'users_account', 'admin');
 INSERT INTO `ihs_permissions` VALUES (2, 'updates', 'admin');
 INSERT INTO `ihs_permissions` VALUES (3, 'pre_k', 'student');
 INSERT INTO `ihs_permissions` VALUES (4, 'grade_k', 'student');
 INSERT INTO `ihs_permissions` VALUES (5, 'grade_1', 'student');
 INSERT INTO `ihs_permissions` VALUES (6, 'grade_2', 'student');
 INSERT INTO `ihs_permissions` VALUES (7, 'grade_3', 'student');
 INSERT INTO `ihs_permissions` VALUES (8, 'grade_4', 'student');
 INSERT INTO `ihs_permissions` VALUES (9, 'grade_5', 'student');
 INSERT INTO `ihs_permissions` VALUES (10, 'grade_6', 'student');
 INSERT INTO `ihs_permissions` VALUES (11, 'grade_7', 'student');
 INSERT INTO `ihs_permissions` VALUES (12, 'grade_8', 'student');
 INSERT INTO `ihs_permissions` VALUES (13, 'grade_9', 'student');
 INSERT INTO `ihs_permissions` VALUES (14, 'grade_10', 'student');
 INSERT INTO `ihs_permissions` VALUES (15, 'grade_11', 'student');
 INSERT INTO `ihs_permissions` VALUES (17, 'pre_k_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (18, 'grade_k_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (19, 'grade_1_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (20, 'grade_2_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (21, 'grade_3_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (22, 'grade_4_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (23, 'grade_5_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (24, 'grade_6_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (25, 'grade_7_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (26, 'grade_8_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (27, 'grade_9_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (28, 'grade_10_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (29, 'grade_11_teacher', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (31, 'classrooms', 'admin');";
 $this->conn->exec($sql3);

//CREATE THE ROLE TABLE
 $sql4 =
 "CREATE TABLE IF NOT EXISTS role(
 role_id INT PRIMARY KEY AUTO_INCREMENT,
 role VARCHAR(100)
 );
 INSERT INTO role (role_id, role) VALUES (1, 'Admin');
 INSERT INTO role (role_id, role) VALUES (2, 'Teacher');
 INSERT INTO role (role_id, role) VALUES (3, 'Student');";
 $this->conn->exec($sql4);


 $sql5 ="
 CREATE TABLE IF NOT EXISTS ihs_students(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 first_name VARCHAR(100) DEFAULT NULL,
 middle_name VARCHAR(100) DEFAULT NULL,
 last_name VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(50) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 access_right VARCHAR(10) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql5);

 $sql6 ="
 CREATE TABLE IF NOT EXISTS ihs_students_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 first_name VARCHAR(100) DEFAULT NULL,
 middle_name VARCHAR(100) DEFAULT NULL,
 last_name VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(50) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 access_right VARCHAR(10) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql6);


 $sql7 ="
 CREATE TABLE IF NOT EXISTS ihs_students_gender(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql7);

 $sql8 ="
 CREATE TABLE IF NOT EXISTS ihs_students_gender_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql8);

 $sql9 ="
 CREATE TABLE IF NOT EXISTS ihs_students_class(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql9);

 $sql10 ="
 CREATE TABLE IF NOT EXISTS ihs_students_class_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql10);


 $sql11 ="
 CREATE TABLE IF NOT EXISTS ihs_students_contact(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql11);

 $sql12 ="
 CREATE TABLE IF NOT EXISTS ihs_students_contact_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql12);

 $sql13 ="
 CREATE TABLE IF NOT EXISTS ihs_students_age(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql13);

 $sql14 ="
 CREATE TABLE IF NOT EXISTS ihs_students_age_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql14);

 $sql15 ="
 CREATE TABLE IF NOT EXISTS ihs_students_medical(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql15);

 $sql16 ="
 CREATE TABLE IF NOT EXISTS ihs_students_medical_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql16);


 $sql17 ="
 CREATE TABLE IF NOT EXISTS ihs_teachers(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 first_name VARCHAR(100) DEFAULT NULL,
 middle_name VARCHAR(100) DEFAULT NULL,
 last_name VARCHAR(100) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 class VARCHAR(50) DEFAULT NULL,
 subjects TEXT,
 access_right VARCHAR(10) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql17);

 $sql18 ="
 CREATE TABLE IF NOT EXISTS ihs_teachers_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 uuid VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 first_name VARCHAR(100) DEFAULT NULL,
 middle_name VARCHAR(100) DEFAULT NULL,
 last_name VARCHAR(100) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 address VARCHAR(15) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 class VARCHAR(50) DEFAULT NULL,
 subjects TEXT,
 access_right VARCHAR(10) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_uuid(uuid)
 ON UPDATE CASCADE
 ON DELETE CASCADE
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql18);

 $sql19 ="
 CREATE TABLE IF NOT EXISTS ihs_video_uploads(
 id INT PRIMARY KEY AUTO_INCREMENT,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 title VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 subject VARCHAR(100) DEFAULT NULL,
 image VARCHAR(100) DEFAULT NULL,
 report VARCHAR(100) DEFAULT NULL
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql19);

 $sql20 ="
 CREATE TABLE IF NOT EXISTS ihs_news(
 id INT PRIMARY KEY AUTO_INCREMENT,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) NOT NULL,
 topic VARCHAR(100) ,
 class VARCHAR(15) ,
 details TEXT
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql20);

 $sql21 ="
 CREATE TABLE IF NOT EXISTS ihs_news_change(
 id INT PRIMARY KEY AUTO_INCREMENT,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 topic VARCHAR(100) ,
 class VARCHAR(15) ,
 details TEXT
 )ENGINE=MyISAM DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql21);
}
public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function runQuery2($sql)
	{
		$stmt = $this->conn->query($sql);
		return $stmt;
	}


	public function runQuery3($sql)
	{
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

public function runQuery4($sql)
	{
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function register($uuid, $firstname, $lastname, $email, $password, $role, $code, $access, $created_at, $created_by_firstname, $created_by_lastname)
	{
		try
		{

			$stmt = $this->conn->prepare( "INSERT INTO ihs_users (uuid, firstname, lastname, email, password, role, code, access_status, created_at,
      created_by_firstname, created_by_lastname) VALUES (:uuid, :firstname, :lastname, :email, :password, :role, :code, :access, :created_at,
      :created_by_firstname, :created_by_lastname)");
      $stmt->bindparam(":uuid",$uuid);
			$stmt->bindparam(":firstname",$firstname);
			$stmt->bindparam(":lastname",$lastname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":role",$role);
			$stmt->bindparam(":code",$code);
      $stmt->bindparam(":access",$access);
      $stmt->bindparam(":created_at",$created_at);
      $stmt->bindparam(":created_by_firstname",$created_by_firstname);
      $stmt->bindparam(":created_by_lastname",$created_by_lastname);
			$stmt->execute();
			return $stmt;


      $stmt2 = $this->conn->prepare( "INSERT INTO ihs_uuid (uuid, email, created_at, created_by_firstname, created_by_lastname) VALUES (:uuid, :email, :created_at, :created_by_firstname, :created_by_lastname)");
      $stmt2->bindparam(":uuid",$uuid);
      $stmt2->bindparam(":email",$email);
      $stmt2->bindparam(":created_at",$created_at);
      $stmt2->bindparam(":created_by_firstname",$created_by_firstname);
      $stmt2->bindparam(":created_by_lastname",$created_by_lastname);
      $stmt2->execute();
      return $stmt2;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}



	public function login($emailn,$passwordn)
	{
		try
		{

	  $stmt = $this->conn->prepare("SELECT * FROM ihs_users WHERE email=:email AND password =:password");
	  $stmt->bindparam(':email', $emailn);
    $stmt->bindparam(':password', $passwordn);
    $stmt->execute();
      //$stmt->execute(array(":password"=>$passwordn));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			$stmt1 = $this->conn->prepare("SELECT * FROM ihs_user_permissions WHERE email=:email");
			$stmt1->execute(array(":email"=>$emailn));
			$userPerm=$stmt1->fetch(PDO::FETCH_ASSOC);

			$list = $userPerm['permissions'];
			$permissions = explode(" ", $list);


			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y" )
				{

						$_SESSION['userSession'] = $userRow['id'];
						$_SESSION['useremail'] = $userRow['email'];
						$_SESSION['userrole'] = $userRow['role'];
						$_SESSION['userfirstname'] = $userRow['firstname'];
						$_SESSION['userlastname'] = $userRow['lastname'];
						$_SESSION['userpermission'] = $permissions;
						return true;

				}

			}
			else
			{
				header("Location: errors.php?error");
				exit;
			}
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	public function auto_logout($x){

		$t = time();
		$t0 = $_SESSION[$x];
		$diff = $t - $t0;
		if($diff > 1500 || !isset($t0)){
			return true;
		}
		else{
			$_SESSION[$x] = time();
		}
	}

	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}

  public function send_mail($email,$message,$subject)
    {
      require_once('../../../../mailer/class.phpmailer.php');
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPDebug  = 0;
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = "ssl";
      $mail->Host       = "mail.privateemail.com";
      $mail->Port       = 465;
      $mail->AddAddress($email);
      $mail->Username="admin@btpps.org";
      $mail->Password="adminpasswd#20";
      $mail->SetFrom('admin@btpps.org','Bonne Terre Preparatory School');
      $mail->AddReplyTo("admin@btpps.org",'Bonne Terre Preparatory School');
      $mail->Subject    = $subject;
      $mail->MsgHTML($message);
      $mail->Send();
    }


}


?>
