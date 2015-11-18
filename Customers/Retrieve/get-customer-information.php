<?php
require_once __DIR__ . '/../../AvangateSoapClient.php';

use \AvangateSoapClient as Client;

/**
 * Initialize client
 */
Client::setBaseUrl('https://api.avangate.com/soap/3.0/');
Client::setCredentials('APITEST', 'SECRET_KEY');

/**
 * Prepare call
 */
$AvangateCustomerReference = 435384557;

$customerObject = Client::getCustomerInformation($AvangateCustomerReference);

echo json_encode($customerObject, JSON_PRETTY_PRINT);
// output:
// {
//     "AvangateCustomerReference": "435384557",
//     "ExternalCustomerReference": null,
//     "FirstName": "John",
//     "LastName": "Jsonrpc",
//     "Company": "A",
//     "FiscalCode": "12345",
//     "Address1": "DP10A",
//     "Address2": "CBP, b3",
//     "City": "Atlanta",
//     "State": "Georgia",
//     "Zip": "123456",
//     "CountryCode": "us",
//     "Phone": "021-000-222",
//     "Fax": "021-000-000",
//     "Email": "john.jsonrpc@avangate.com",
//     "ExistingCards": [],
//     "Enabled": false,
//     "Trial": false,
//     "Language": ""
// }
//
