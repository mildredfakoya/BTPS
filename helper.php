<?php
class HELPER
{
public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

public function redirect($url)
	{
		header("Location: $url");
	}


public function timestamp(){
	  date_default_timezone_set('America/Dominica');
	  $date =  date('l,d-M-Y h:i:sa');
	  return $date;
}
}
