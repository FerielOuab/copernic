<?php
  // 1. I got all contacts by: https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=6b9c8df1-de8b-4601-9e46-f84a81eeda5a
  // 2. I choosed a VID to display all the deals IDs (the "4" is for association type: Contact to deal) using: https://api.hubapi.com/crm-associations/v1/associations/601/HUBSPOT_DEFINED/4?hapikey=6b9c8df1-de8b-4601-9e46-f84a81eeda5a
  // 3. I choosed to test with deal_id = 3067155452 for "Closed won"

  
  $curl = curl_init(); // Initialize curl

  curl_setopt_array($curl, array(
  // CURLOPT_URL => 'https://api.hubapi.com/deals/v1/deal/' . $deal_id . '?hapikey=' . $hapikey,
  CURLOPT_URL => 'https://api.hubapi.com/deals/v1/deal/3067155452?hapikey=6b9c8df1-de8b-4601-9e46-f84a81eeda5a', // I added the url with the deal id and the api key. 
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl); // Once all params set, execute the request and get the result in the variable $response
  
  
  curl_close($curl);
  $j_response = json_decode($response); // Put response in json format to handle the object and access its properties
  
  $data = array(
    "titre du deal" => $j_response->properties->dealname->value,
    "montant du deal" => $j_response->properties->amount->value,
    "date de creation du deal" => $j_response->properties->createdate->value,
    "nom du contact lie" => $j_response->properties->nom_party_leader->value,
    "prenom du contact lie" => $j_response->properties->prenom_party_leader->value,
    "mail du contact lie" => $j_response->properties->email_party_leader->value,
  ); // Put all data I need in array $data


  echo json_encode($data); // Encode $data to display it in a string form
  
?>