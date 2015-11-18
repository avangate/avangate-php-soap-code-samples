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
$productId = 4586004;

$subscriptionData = [
    'StartDate' => '2015-01-01',
    'ExpirationDate' => '2020-01-01',
    'LicenseHistory' => null,
    'LicenseStatus' => 'ACTIVE',
    'RecurringEnabled' => 'YES',
    'EndUser' => [
        'FirstName'   => 'John',
        'LastName'    => 'Doe',
        'Company'     => 'Company',
        'Email'       => 'john.doe@avangate.com',
        'Phone'       => '0123456789',
        'Fax'         => '9876543210',
        'Address1'    => 'address1',
        'Address2'    => 'address2',
        'Zip'         => '12345',
        'City'        => 'Bucharest',
        'State'       => 'State',
        'CountryCode' => 'RO',
        'Language'    => 'ro'
    ],
    'ActivationInfo' => [
        'Codes' => [
            'Code'        => mt_rand(100, 999),
            'Description' => '-',
            'File'        => '',
            'Extrainfo'   => [],
        ],
        'Description' => '-'
    ],
    'ExternalSubscriptionReference' => mt_rand(100, 999),
    'Product' => [
        'ProductId'        => $productId,
        'ProductName'      => 'APRODUCT',
        'ProductCode'      => '',
        'ProductVersion'   => '1',
        'ProductQuantity'  => 1,
        'PriceOptionCodes' => []
    ],
    'NextRenewalPrice' => 100,
    'NextRenewalPriceCurrency' => 'USD',
    'CustomPriceBillingCyclesLeft' => 100,
];

$addedLicenseCode = Client::addSubscription($subscriptionData);

var_dump($addedLicenseCode);
// output:
// string(10) "8AF9A9DC95"

/**
 * Get subscription details
 */
$subscriptionDetails = Client::getSubscription($addedLicenseCode);
echo json_encode($subscriptionDetails, JSON_PRETTY_PRINT);

// output:
// {
//     "SubscriptionReference": "8AF9A9DC95",
//     "StartDate": "2015-01-01",
//     "ExpirationDate": "2020-01-01",
//     "RecurringEnabled": false,
//     "SubscriptionEnabled": true,
//     "Product": {
//         "ProductCode": "prod_many_options",
//         "ProductId": "4586004",
//         "ProductName": "APRODUCT",
//         "ProductVersion": "1",
//         "ProductQuantity": 1,
//         "PriceOptionCodes": null
//     },
//     "EndUser": {
//         "FirstName": "John",
//         "LastName": "Doe",
//         "Email": "john.doe@avangate.com",
//         "Company": "Company",
//         "Phone": "0123456789",
//         "Fax": "9876543210",
//         "Address1": "address1",
//         "Address2": "address2",
//         "Zip": "12345",
//         "City": "Bucharest",
//         "State": "State",
//         "CountryCode": "ro",
//         "Language": "ro"
//     },
//     "SKU": "",
//     "DeliveryInfo": {
//         "Description": "",
//         "Codes": [
//             {
//                 "Code": null,
//                 "File": null,
//                 "Description": "",
//                 "ExtraInfo": null
//             }
//         ]
//     },
//     "ReceiveNotifications": true,
//     "Lifetime": false,
//     "PartnerCode": "",
//     "AvangateCustomerReference": "258075058",
//     "ExternalCustomerReference": null,
//     "TestSubscription": false,
//     "IsTrial": false
// }
//
