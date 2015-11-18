<?php
require_once __DIR__ . '/../../AvangateSoapClient.php';

use \AvangateSoapClient as Client;

/**
 * Initialize client
 */
Client::setBaseUrl('https://api.avangate.com/soap/3.0/');
Client::setCredentials('APITEST', 'SECRET_KEY');


/**
 * Get subscription details
 */
$subscriptionCode = "8AF9A9DC95";
$subscriptionDetails = Client::getSubscription($subscriptionCode);

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
