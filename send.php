<?php 

	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Credentials: true');

    $name = $_POST["name"];
    $phone = $_POST["phone"];



	$queryUrl = "https://tumargroup.bitrix24.kz/rest/3237/m302ijcntr1ogj37/crm.lead.add.json";	


	$queryData = http_build_query(array(
		"fields" => array(
			"TITLE" => "Заявка с сайта Tamerlan",	
			"NAME" => $name,
			"PHONE" => Array(
				"n0" => Array(
					"VALUE" => "$phone",
					"VALUE_TYPE" => "WORK"
				),
			),
		),
		"params" => array("REGISTER_SONET_EVENT" => "Y")
	));




	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $queryUrl,
		CURLOPT_POSTFIELDS => $queryData,
	));
	$result = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($result, 1); 

	if(array_key_exists('error', $result))
	{      
		die("Ошибка при сохранении лида: ".$result['error_description']);
	}
?>