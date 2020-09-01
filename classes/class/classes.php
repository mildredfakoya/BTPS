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


$sql1 ="CREATE TABLE IF NOT EXISTS btps_topics(
id INT UNIQUE AUTO_INCREMENT ,
created_at varchar(100),
created_by_firstname VARCHAR(100) DEFAULT NULL,
created_by_lastname VARCHAR(100) DEFAULT NULL,
email VARCHAR(350) DEFAULT NULL,
date_last_updated varchar(100),
updated_by_firstname VARCHAR(100) DEFAULT NULL,
updated_by_lastname VARCHAR(100) DEFAULT NULL,
topics_covered VARCHAR (100) DEFAULT NULL,
grade VARCHAR(100) DEFAULT NULL,
subject VARCHAR(100) DEFAULT NULL,
notes TEXT,
month VARCHAR(15) DEFAULT NULL,
year VARCHAR(4) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql1);

$sql2 =
"CREATE TABLE IF NOT EXISTS `ihs_users` (
    `id` int(11) UNIQUE AUTO_INCREMENT  NOT NULL,
    `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
    `updated_by_lastname` varchar(100) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  INSERT INTO `ihs_users` (`id`, `uuid`, `firstname`, `middlename`, `lastname`, `email`, `password`, `role`, `userStatus`, `code`, `last_logged_in`, `access_status`, `created_at`, `created_by_firstname`, `created_by_lastname`, `updated_at`, `updated_by_firstname`, `updated_by_lastname`) VALUES
  (1, '75b1d11de6a4bb71d7057d3f44aaf8079a1c10fb36b030d991693e988ae5fc396e7fcd3a246e37e9a6ce45c6857427cf7a72', 'l064xcvrQ+KqiACxJkspsw==', NULL, 'jkfwH0L03ZTvBK0LIWwE6w==', 'r6TppR8eFavexNmWXTNyk+2LqhPDGlq5z492eRPr8NU=', 'h2pJ9R66xPp658byPqjZjGlW1qO0dOjbt06d/F3UAQI=', 'Admin', 'Y', '148f37eb56546d38a950', NULL, 'OK', '2020-04-23 06:30:00', '/yVgGxBKo5oyf/5C+gNxcA==', 'EySvf+MgEwj5yDRvN1au4Q==', '2020-04-23 06:30:00', NULL, NULL);";
  $this->conn->exec($sql2);

 $sql3 =
 "CREATE TABLE IF NOT EXISTS ihs_permissions(
 id INT NOT NULL UNIQUE AUTO_INCREMENT ,
 permission_name VARCHAR(100),
 permission_group VARCHAR(100)
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
 INSERT INTO `ihs_permissions` VALUES (31, 'classrooms', 'admin');
 INSERT INTO `ihs_permissions` VALUES (32, 'records', 'admin');
 INSERT INTO `ihs_permissions` VALUES (33, 'exams', 'admin');
 INSERT INTO `ihs_permissions` VALUES (34, 'information', 'admin');
 INSERT INTO `ihs_permissions` VALUES (35, 'finance', 'admin');
 INSERT INTO `ihs_permissions` VALUES (36, 'deletes', 'admin');
 INSERT INTO `ihs_permissions` VALUES (37, 'assessment', 'teacher');
 INSERT INTO `ihs_permissions` VALUES (38, 'review', 'admin');
 INSERT INTO `ihs_permissions` VALUES (39, 'libraryandgradebook', 'teacher');
 ";
 $this->conn->exec($sql3);

//CREATE THE ROLE TABLE
 $sql4 ="CREATE TABLE IF NOT EXISTS role(
 role_id INT UNIQUE AUTO_INCREMENT ,
 role VARCHAR(100)
 );
 INSERT INTO role (role_id, role) VALUES (1, 'Admin');
 INSERT INTO role (role_id, role) VALUES (2, 'Teacher');
 INSERT INTO role (role_id, role) VALUES (3, 'Student');";
 $this->conn->exec($sql4);

 $sql5 ="CREATE TABLE IF NOT EXISTS ihs_students(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
 address VARCHAR(250) DEFAULT NULL,
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
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql5);

 $sql6 =
 "CREATE TABLE IF NOT EXISTS ihs_students_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 first_name VARCHAR(100) DEFAULT NULL,
 middle_name VARCHAR(100) DEFAULT NULL,
 last_name VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(50) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 address VARCHAR(250) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 access_right VARCHAR(10) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql6);


 $sql7 =
 "CREATE TABLE IF NOT EXISTS ihs_students_gender(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql7);

 $sql8 =
 "CREATE TABLE IF NOT EXISTS ihs_students_gender_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 gender VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql8);

 $sql9 =
 "CREATE TABLE IF NOT EXISTS ihs_students_class(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql9);

 $sql10 =
 "CREATE TABLE IF NOT EXISTS ihs_students_class_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql10);

 $sql11 =
 "CREATE TABLE IF NOT EXISTS ihs_students_contact(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 address VARCHAR(250) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (uuid)
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql11);

 $sql12 ="CREATE TABLE IF NOT EXISTS ihs_students_contact_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 address VARCHAR(250) DEFAULT NULL,
 telephone VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) DEFAULT NULL,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql12);

 $sql13 =
 "CREATE TABLE IF NOT EXISTS ihs_students_age(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql13);

 $sql14 ="CREATE TABLE IF NOT EXISTS ihs_students_age_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 day_of_birth VARCHAR(15) DEFAULT NULL,
 month_of_birth VARCHAR(15) DEFAULT NULL,
 year_of_birth VARCHAR(15) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql14);

 $sql15 =
 "CREATE TABLE IF NOT EXISTS ihs_students_medical(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql15);

 $sql16 ="CREATE TABLE IF NOT EXISTS ihs_students_medical_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) DEFAULT NULL,
 created_by_lastname VARCHAR(100) DEFAULT NULL,
 medical_conditions TEXT,
 medications TEXT,
 emergency_contact VARCHAR(50) DEFAULT NULL,
 other_information TEXT,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql16);


 $sql17 =
 "CREATE TABLE IF NOT EXISTS ihs_teachers(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
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
 REFERENCES ihs_users(uuid)
 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql17);

 $sql18 =
 "CREATE TABLE IF NOT EXISTS ihs_teachers_change(
 id INT UNIQUE AUTO_INCREMENT ,
 `uuid` varchar(255) PRIMARY KEY NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
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
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql18);

 $sql19 =
 "CREATE TABLE IF NOT EXISTS ihs_video_uploads(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 title VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 subject VARCHAR(100) DEFAULT NULL,
 image VARCHAR(100) DEFAULT NULL,
 report TEXT
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql19);

 $sql20 =
 "CREATE TABLE IF NOT EXISTS ihs_news(
 id INT UNIQUE AUTO_INCREMENT ,
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
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql20);

 $sql21 ="CREATE TABLE IF NOT EXISTS ihs_news_change(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 topic VARCHAR(100),
 class VARCHAR(15),
 details TEXT
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql21);


 $sql22 ="CREATE TABLE IF NOT EXISTS ihs_timetable_uploads(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 grade VARCHAR(100) DEFAULT NULL,
 file VARCHAR(100) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql22);


 $sql23 ="CREATE TABLE IF NOT EXISTS ihs_menu_uploads(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 month VARCHAR(100) DEFAULT NULL,
 file VARCHAR(100) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql23);


 $sql24 ="CREATE TABLE IF NOT EXISTS ihs_newsletter_uploads(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) DEFAULT NULL,
 monthnews VARCHAR(100) DEFAULT NULL,
 file VARCHAR(100) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql24);


 $sql25 ="CREATE TABLE IF NOT EXISTS btps_info(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 date_last_updated varchar(100),
 updated_by_firstname VARCHAR(100) DEFAULT NULL,
 updated_by_lastname VARCHAR(100) DEFAULT NULL,
 email VARCHAR(100) NOT NULL,
 grade VARCHAR(35) DEFAULT NULL,
 ages VARCHAR(20) DEFAULT NULL,
 information TEXT DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql25);

 $sql26 ="CREATE TABLE IF NOT EXISTS btps_info_change(
 id INT UNIQUE AUTO_INCREMENT ,
 created_at varchar(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 grade VARCHAR(35) DEFAULT NULL,
 ages VARCHAR(20) DEFAULT NULL,
 information TEXT DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql26);

 $sql27 ="CREATE TABLE IF NOT EXISTS btps_new_assessment(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 access_code VARCHAR(50) NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 intended_access_date VARCHAR(100) NOT NULL,
 intended_close_date VARCHAR(100) NOT NULL,
 assessment_type VARCHAR(100) NOT NULL,
 subject VARCHAR(100) NOT NULL,
 submitted_review VARCHAR(50) DEFAULT NULL,
 review_status VARCHAR(100) DEFAULT NULL,
 review_notes TEXT DEFAULT NULL,
 approval_status VARCHAR(50) DEFAULT NULL,
 date_last_updated VARCHAR(50) DEFAULT NULL,
 updated_by_firstname VARCHAR(250) DEFAULT NULL,
 updated_by_lastname VARCHAR(250) DEFAULT NULL,
 duration VARCHAR(50) DEFAULT NULL,
 style VARCHAR(50) DEFAULT NULL,
 access_status VARCHAR(50) DEFAULT 'UNLOCKED',
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql27);

 $sql28 ="CREATE TABLE IF NOT EXISTS btps_new_assessment_change(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 access_code VARCHAR(50) NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 intended_access_date VARCHAR(100) NOT NULL,
 intended_close_date VARCHAR(100) NOT NULL,
 assessment_type VARCHAR(100) NOT NULL,
 subject VARCHAR(100) NOT NULL,
 review_status VARCHAR(100) DEFAULT NULL,
 review_notes TEXT DEFAULT NULL,
 approval_status VARCHAR(50) DEFAULT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql28);

 $sql29 ="CREATE TABLE IF NOT EXISTS btps_assignment(
 id INT PRIMARY KEY  AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 subject VARCHAR(100),
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (assessment_id)
 REFERENCES btps_new_assessment(assessment_id)
 ON DELETE CASCADE ON UPDATE CASCADE

 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql29);

 $sql30 ="CREATE TABLE IF NOT EXISTS continous_assessment(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 subject VARCHAR(100),
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (assessment_id)
 REFERENCES btps_new_assessment(assessment_id)
 ON DELETE CASCADE ON UPDATE CASCADE

 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql30);

 $sql31 ="CREATE TABLE IF NOT EXISTS exam(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 subject VARCHAR(100),
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (assessment_id)
 REFERENCES btps_new_assessment(assessment_id)
 ON DELETE CASCADE ON UPDATE CASCADE

 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql31);

 $sql32 ="CREATE TABLE IF NOT EXISTS btps_project(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) UNIQUE NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 target_class VARCHAR(50) NOT NULL,
 subject VARCHAR(100),
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (assessment_id)
 REFERENCES btps_new_assessment(assessment_id)

 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql32);

 $sql33 ="CREATE TABLE IF NOT EXISTS btps_multichoice(
 id INT PRIMARY KEY AUTO_INCREMENT ,
 assessment_id VARCHAR(50) NOT NULL,
 created_at VARCHAR(100),
 created_by_firstname VARCHAR(100) NOT NULL,
 created_by_lastname VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
 question_id VARCHAR(50) NOT NULL,
 question_text TEXT NOT NULL,
 option1 VARCHAR(250) NOT NULL,
 option2 VARCHAR(250) NOT NULL,
 option3 VARCHAR(250) NOT NULL,
 option4 VARCHAR(250) NOT NULL,
 answer VARCHAR(250) NOT NULL,
 topic VARCHAR(250) NOT NULL,
 feedback TEXT NOT NULL,
 month VARCHAR(15) DEFAULT NULL,
 year VARCHAR(4) DEFAULT NULL,
 FOREIGN KEY (assessment_id)
 REFERENCES btps_new_assessment(assessment_id)

 ON DELETE CASCADE ON UPDATE CASCADE
 )ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ";
 $this->conn->exec($sql33);


  $sql34 ="CREATE TABLE IF NOT EXISTS btps_boolean(
  id INT PRIMARY KEY AUTO_INCREMENT ,
  assessment_id VARCHAR(50) NOT NULL,
  created_at VARCHAR(100),
  created_by_firstname VARCHAR(100) NOT NULL,
  created_by_lastname VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  question_id VARCHAR(50) NOT NULL,
  question_text TEXT NOT NULL,
  option1 VARCHAR(250) NOT NULL,
  option2 VARCHAR(250) NOT NULL,
  answer VARCHAR(250) NOT NULL,
  topic VARCHAR(250) NOT NULL,
  feedback TEXT NOT NULL,
  month VARCHAR(15) DEFAULT NULL,
  year VARCHAR(4) DEFAULT NULL,
  FOREIGN KEY (assessment_id)
  REFERENCES btps_new_assessment(assessment_id)

  ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";
  $this->conn->exec($sql34);



  $sql35 ="CREATE TABLE IF NOT EXISTS btps_blank(
  id INT PRIMARY KEY AUTO_INCREMENT ,
  assessment_id VARCHAR(50) NOT NULL,
  created_at VARCHAR(100),
  created_by_firstname VARCHAR(100) NOT NULL,
  created_by_lastname VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  question_id VARCHAR(50) NOT NULL,
  question_text TEXT NOT NULL,
  answer_keyword TEXT NOT NULL,
  topic VARCHAR(250) NOT NULL,
  feedback TEXT NOT NULL,
  month VARCHAR(15) DEFAULT NULL,
  year VARCHAR(4) DEFAULT NULL,
  FOREIGN KEY (assessment_id)
  REFERENCES btps_new_assessment(assessment_id)

  ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ";
  $this->conn->exec($sql35);

//CREATE THE USER PERMISSIONS TABLE
$sql36 =
"CREATE TABLE IF NOT EXISTS ihs_user_permissions(
id INT NOT NULL UNIQUE AUTO_INCREMENT ,
uuid VARCHAR(250) DEFAULT NULL,
email VARCHAR(250) DEFAULT NULL,
permissions TEXT,
FOREIGN KEY (uuid)
REFERENCES ihs_users(uuid)

ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `ihs_user_permissions` (`id`, `email`, `permissions`) VALUES
(1, 'r6TppR8eFavexNmWXTNyk+2LqhPDGlq5z492eRPr8NU=', 'classrooms users_account updates records exams information finance deletes pre_k grade_k grade_1 grade_2 grade_3 grade_4 grade_5 grade_6 grade_7 grade_8 grade_9 grade_10 grade_11 pre_k_teacher grade_1_teacher grade_1_teacher grade_2_teacher grade_3_teacher grade_4_teacher grade_5_teacher grade_6_teacher grade_7_teacher grade_8_teacher grade_9_teacher grade_10_teacher grade_11_teacher');
";
$this->conn->exec($sql36);

$sql37 ="CREATE TABLE IF NOT EXISTS btps_essay(
id INT PRIMARY KEY AUTO_INCREMENT ,
assessment_id VARCHAR(50)  NOT NULL,
created_at VARCHAR(100),
created_by_firstname VARCHAR(100) NOT NULL,
created_by_lastname VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
question_id VARCHAR(50) NOT NULL,
question_text TEXT NOT NULL,
answer_guide TEXT NOT NULL,
topic VARCHAR(250) NOT NULL,
feedback TEXT NOT NULL,
month VARCHAR(15) DEFAULT NULL,
year VARCHAR(4) DEFAULT NULL,
FOREIGN KEY (assessment_id)
REFERENCES btps_new_assessment(assessment_id)
ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql37);

$sql38 =
"CREATE TABLE IF NOT EXISTS btps_subject(
id INT PRIMARY KEY AUTO_INCREMENT ,
created_at varchar(100),
created_by_firstname VARCHAR(100) NOT NULL,
created_by_lastname VARCHAR(100) NOT NULL,
date_last_updated varchar(100),
updated_by_firstname VARCHAR(100) DEFAULT NULL,
updated_by_lastname VARCHAR(100) DEFAULT NULL,
email VARCHAR(100) NOT NULL,
subject VARCHAR(100) ,
class VARCHAR(15)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql38);

$sql39 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_4(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql39);

$sql40 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_pre_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql40);


$sql41 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_4(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql41);


$sql42 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_4(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql42);



$sql43 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_5(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql43);

$sql44 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_5(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql44);



$sql45 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_5(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql45);



$sql46 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_6(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql46);

$sql47 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_6(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql47);



$sql48 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_6(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql48);



$sql49 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_3(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql49);

$sql50 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_3(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql50);



$sql51 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_3(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql51);


$sql52 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_2(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql52);

$sql53 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_2(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql53);



$sql54 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_2(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql54);



$sql55 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_1(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql55);

$sql56 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_1(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql56);



$sql57 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_1(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql57);


$sql58 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_pre_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql58);



$sql59 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_pre_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql59);


$sql60 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql60);

$sql61 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql61);



$sql62 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_k(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql62);


$sql63 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_7(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql63);

$sql64 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_7(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql64);



$sql65 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_7(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql65);


$sql66 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_8(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql66);

$sql67 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_8(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql67);



$sql68 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_8(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql68);



$sql69 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_9(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql69);

$sql70 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_9(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql70);



$sql71 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_9(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql71);



$sql72 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_10(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql72);

$sql73 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_10(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql73);



$sql74 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_10(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql74);



$sql75 =
"CREATE TABLE IF NOT EXISTS btps_student_assignment_grade_11(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql75);

$sql76 =
"CREATE TABLE IF NOT EXISTS btps_student_continous_grade_11(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql76);



$sql77 =
"CREATE TABLE IF NOT EXISTS btps_student_exam_grade_11(
id INT PRIMARY KEY AUTO_INCREMENT ,
submitted_at varchar(100) NOT NULL,
`firstname` varchar(255) NOT NULL,
`lastname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
question_id VARCHAR(100) NOT NULL,
subject VARCHAR(100) NOT NULL,
topic TEXT,
student_answer TEXT NOT NULL,
correct_answer TEXT,
visibility VARCHAR(50),
feedback TEXT,
score VARCHAR(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql77);

$sql78 =
"CREATE TABLE IF NOT EXISTS btps_student_grades(
id INT PRIMARY KEY AUTO_INCREMENT ,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
subject VARCHAR(100) NOT NULL,
class VARCHAR(100) NOT NULL,
assessment_type VARCHAR(100) NOT NULL,
total VARCHAR(100) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql78);


$sql79 =
"CREATE TABLE IF NOT EXISTS btps_student_timer(
id INT PRIMARY KEY AUTO_INCREMENT ,
`email` varchar(255) NOT NULL,
assessment_id VARCHAR(50) NOT NULL,
start_time VARCHAR(50) NOT NULL,
duration VARCHAR(50) NOT NULL,
end_time VARCHAR(50) DEFAULT NULL,
status VARCHAR(50) DEFAULT 'NOT TAKEN',
FOREIGN KEY (assessment_id)
REFERENCES btps_new_assessment(assessment_id)
ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql79);


$sql80 = "CREATE OR REPLACE VIEW grades AS (SELECT y.email, y.firstname, y.middlename, y.lastname, g.assessment_id, g.subject, g.class, g.assessment_type, g.total FROM ihs_users y JOIN btps_student_grades g ON y.email = g.email)
";
$this->conn->exec($sql80);


$sql81 =
"CREATE TABLE IF NOT EXISTS chats4(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql81);


$sql82 =
"CREATE TABLE IF NOT EXISTS chats5(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql82);


$sql83 =
"CREATE TABLE IF NOT EXISTS chats6(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql83);

$sql84 =
"CREATE TABLE IF NOT EXISTS chats7(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql84);


$sql85 =
"CREATE TABLE IF NOT EXISTS chats8(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql85);

$sql86 =
"CREATE TABLE IF NOT EXISTS chats9(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql86);


$sql87 =
"CREATE TABLE IF NOT EXISTS chats10(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql87);


$sql88 =
"CREATE TABLE IF NOT EXISTS chats11(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql88);



$sql89 =
"CREATE TABLE IF NOT EXISTS chats3(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql89);


$sql90 =
"CREATE TABLE IF NOT EXISTS chats2(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql90);

$sql91 =
"CREATE TABLE IF NOT EXISTS chats1(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql91);


$sql92 =
"CREATE TABLE IF NOT EXISTS chatsk(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql92);


$sql93 =
"CREATE TABLE IF NOT EXISTS chatspk(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
chat_id VARCHAR(50),
content TEXT NOT NULL,
recipient_mail VARCHAR(255) NOT NULL DEFAULT 'All'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql93);


$sql94 =
"CREATE TABLE IF NOT EXISTS assessmentdefinitions(
id INT PRIMARY KEY AUTO_INCREMENT,
created_at VARCHAR(255),
created_by_email VARCHAR(255),
definition_code VARCHAR(50) NOT NULL,
term VARCHAR(50),
academic_year VARCHAR(50),
class  VARCHAR(50),
assignment VARCHAR(50),
projects VARCHAR(50),
contassess VARCHAR(50),
exam VARCHAR(50),
amin VARCHAR(50),
amax VARCHAR(50),
bmin VARCHAR(50),
bmax VARCHAR(50),
cmin VARCHAR(50),
cmax VARCHAR(50),
dmin VARCHAR(50),
dmax VARCHAR(50),
emin VARCHAR(50),
emax VARCHAR(5)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql94);


$sql95 =
"CREATE TABLE IF NOT EXISTS btps_library(
id INT UNIQUE AUTO_INCREMENT ,
created_at varchar(100),
created_by_firstname VARCHAR(100) NOT NULL,
created_by_lastname VARCHAR(100) NOT NULL,
email VARCHAR(100) DEFAULT NULL,
booktitle VARCHAR(100) DEFAULT NULL,
class VARCHAR(100) DEFAULT NULL,
subject VARCHAR(100) DEFAULT NULL,
image VARCHAR(100) DEFAULT NULL,
description TEXT
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$this->conn->exec($sql95);

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
          if($userRow['access_status']=="OK"){
						$_SESSION['userSession'] = $userRow['id'];
						$_SESSION['useremail'] = $userRow['email'];
						$_SESSION['userrole'] = $userRow['role'];
						$_SESSION['userfirstname'] = $userRow['firstname'];
						$_SESSION['userlastname'] = $userRow['lastname'];
						$_SESSION['userpermission'] = $permissions;
						return true;
          }
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


    public function send_mail2($to, $from, $subject, $message, $fullname, $path)
      {
        require_once('../../../../mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "mail.privateemail.com";
        $mail->Port       = 465;
        $mail->AddAddress($to);
        $mail->Username="admin@btpps.org";
        $mail->Password="adminpasswd#20";
        #$mail->SetFrom($from,$fullname);
        $mail->SetFrom("admin@btpps.org",$fullname);
        $mail->AddReplyTo($from, $fullname);
        $mail->IsHTML(true);
        $mail->wordwrap = 50;
        $mail-> AddAttachment($path);
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
      }

}


?>
