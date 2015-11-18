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
$customerObject = (object)[
    'FirstName'   => 'John',
    'LastName'    => 'Jsonrpc',
    'Email'       => 'john.jsonrpc@avangate.com',
    'Company'     => 'A',
    'FiscalCode'  => '12345',
    'Phone'       => '021-000-222',
    'Fax'         => '021-000-000',
    'Address1'    => 'DP10A',
    'Address2'    => 'CBP, b3',
    'Zip'         => '123456',
    'City'        => 'Atlanta',
    'State'       => 'Georgia',
    'CountryCode' => 'US',
    'Language'    => 'en'
];

$addedAvangateCustomerReference = Client::createCustomer($customerObject);

echo 'Customer reference: ' . $response . PHP_EOL;
// output:
// Customer reference: 141589723


/**
 * Get added details:
 */
$customerObject = Client::getCustomerInformation($addedAvangateCustomerReference);

echo json_encode($customerObject, JSON_PRETTY_PRINT);
// output:
// {
//     "AvangateCustomerReference": "141589723",
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
