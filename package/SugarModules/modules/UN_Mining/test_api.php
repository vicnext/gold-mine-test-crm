<?php

echo 'start';


function restRequest($method, $arguments){
 //global $url;
        
 
$url = "http://suite7143.lc/custom/service/v4_1_custom/rest.php";
        
 $curl = curl_init($url);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $post = array(
         "method" => $method,
         "input_type" => "JSON",
         "response_type" => "JSON",
         "rest_data" => json_encode($arguments),
 );

 curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

 $result = curl_exec($curl);
 curl_close($curl);
 return json_decode($result,1);
}


$userAuth = array(
        'user_name' => 'admin',
        'password' => md5('adminpass'),
);
$appName = 'My SuiteCRM REST Client';
$nameValueList = array();

$args = array(
            'user_auth' => $userAuth,
            'application_name' => $appName,
            'name_value_list' => $nameValueList);

$result = restRequest('login',$args);
$sessId = $result['id'];

echo '<pre>';
print_r($result);
echo '</pre>';


$entryArgs = array(
 //Session id - retrieved from login call
	'session' => $sessId,
 //Module to get_entry_list for
	'module_name' => 'UN_Country',
 //Filter query - Added to the SQL where clause,
	'query' => "", //"accounts.billing_address_city = 'Ohio'",
 //Order by - unused
	'order_by' => '',
 //Start with the first record
	'offset' => 0,
 //Return the id and name fields
	'select_fields' => array('id','name',),
 //Link to the "contacts" relationship and retrieve the
 //First and last names.
                   /*
	'link_name_to_fields_array' => array(
        array(
                'name' => 'contacts',
                        'value' => array(
                        'first_name',
                        'last_name',
                ),
        ),
),*/
   //Show 10 max results
  		'max_results' => 100,
   //Do not show deleted
  		'deleted' => 0,
 );




$entryArgs = array(
    'session' => $sessId,
    'module_name' => 'UN_Country',
    'name_value_list' => [
        ['name' => 'description', 'value' => 'desc1'],
    ],
 );



$entryArgs = array(
    'session' => $sessId,
    'year' => 2024,
    'month' => 5,
 );


$entryArgs = array(
    'session' => $sessId,
 );

 //$result = restRequest('get_entry_list',$entryArgs);
  //$result = restRequest('set_entry', $entryArgs);
//$result = restRequest('get_available_modules', $entryArgs);

  //$result = restRequest('get_report', $entryArgs);
  $result = restRequest('generate_test_data', $entryArgs);
  
  
echo '<pre>';
print_r($result);
echo '</pre>';
print_r('end');
