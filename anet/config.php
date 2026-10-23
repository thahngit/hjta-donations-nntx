<?php

  // will be config.php for HJTA account


   // includes - required files
   $_root  =$_SERVER['DOCUMENT_ROOT'];

   // 10/20/2014
   require dirname(__FILE__) . '/AuthorizeNet.php' ;




$METHOD_TO_USE = "AIM";



//// REAL NNTX MODIFIED ANET TO USB PROCESSOR
define("AUTHORIZENET_API_LOGIN_ID","5SCbc34P");    
define("AUTHORIZENET_TRANSACTION_KEY","422M939Gf5xFjS6z"); 
define("AUTHORIZENET_SANDBOX",false);       // TRUE goes to FAKE MERCHANT ACCOUNT ONLY.

//TRUE goes to real account.
// put live account into TEST MODE to test it there
//define("TEST_REQUEST", "TRUE");           // You may want to set to true if testing against production


// BLAKE FAKE TEST ACCOUNT
//define("AUTHORIZENET_API_LOGIN_ID","7Xw6vhR3P");    // Add your API LOGIN ID
//define("AUTHORIZENET_TRANSACTION_KEY","47A23B469nnbpSEg"); //
//define("AUTHORIZENET_SANDBOX",true);       // Set to false to test against production
//define("TEST_REQUEST", "TRUE");           // You may want to set to true if testing against production





?>
