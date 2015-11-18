<?php
require_once __DIR__ . '/../../AvangateSoapClient.php';

use \AvangateSoapClient as Client;

/**
 * Initialize client
 */
Client::setBaseUrl('https://api.avangate.com/soap/3.0/');
Client::setCredentials('APITEST', 'SECRET_KEY');

/**
 * Prepare call - get a non-empty product code
 */
$productListing = Client::searchProducts([
    'Limit' => 1,
    'Enabled' => true,
    'Types' => [
        'REGULAR'
    ]
]);

if (empty($productListing)) {
    die('No enabled products were found.');
}

$productCode = $productListing[0]->ProductCode;

if (empty($productCode)) {
    die('Choose a product with a valid product code');
}

/**
 * Prepare call - prepare order object
 */
$order = [
    'Items' => [
        0 => [
            'Code' => $productCode,
            'Quantity' => 1
        ]
    ],
    'BillingDetails' => [
        'FirstName' => 'John',
        'LastName' => 'Doe',
        'Email' => 'john.doe@avangate.com',
        'CountryCode' => 'RO'
    ],
    'PaymentDetails' => [
        'Type' => 'TEST',
        'Currency' => 'EUR',
        'PaymentMethod' => [
            'CardType' => 'visa',
            'CardNumber' => '4111111111111111',
            'CCID' => '123',
            'ExpirationMonth' => '10',
            'ExpirationYear' => '2020',
            'HolderName' => 'John Doe',
        ]
    ]
];

$responsePlaceOrder = Client::placeOrder($order);

echo json_encode($responsePlaceOrder, JSON_PRETTY_PRINT);

// output:
// {
//     "RefNo": "11306271",
//     "OrderNo": 0,
//     "ExternalReference": null,
//     "ShopperRefNo": null,
//     "Status": "AUTHRECEIVED",
//     "ApproveStatus": "WAITING",
//     "VendorApproveStatus": "OK",
//     "Language": "ro",
//     "OrderDate": "2015-11-18 16:52:22",
//     "FinishDate": null,
//     "Source": null,
//     "AffiliateSource": null,
//     "AffiliateId": null,
//     "AffiliateName": null,
//     "AffiliateUrl": null,
//     "RecurringEnabled": false,
//     "HasShipping": false,
//     "BillingDetails": {
//     "FiscalCode": "",
//         "Phone": "",
//         "FirstName": "John",
//         "LastName": "Doe",
//         "Company": "",
//         "Email": "john.doe@avangate.com",
//         "Address1": "",
//         "Address2": "",
//         "City": "",
//         "Zip": "",
//         "CountryCode": "ro",
//         "State": ""
//     },
//     "DeliveryDetails": {
//     "Phone": "",
//         "FirstName": "John",
//         "LastName": "Doe",
//         "Company": null,
//         "Email": "john.doe@avangate.com",
//         "Address1": "",
//         "Address2": "",
//         "City": "",
//         "Zip": "",
//         "CountryCode": "ro",
//         "State": ""
//     },
//     "PaymentDetails": {
//     "Type": "TEST",
//         "Currency": "eur",
//         "PaymentMethod": {
//         "FirstDigits": "4111",
//             "LastDigits": "1111",
//             "CardType": "visa",
//             "RecurringEnabled": false
//         },
//         "CustomerIP": "127.0.0.1"
//     },
//     "CustomerDetails": null,
//     "Origin": "API",
//     "AvangateCommission": 2.22,
//     "OrderFlow": "REGULAR",
//     "GiftDetails": null,
//     "PODetails": null,
//     "ExtraInformation": {
//         "PaymentLink": "\/order\/finish.php?id=2Xrl83KEs6O0snPrca%2B6amChuLo%3D"
//     },
//     "PartnerCode": null,
//     "PartnerMargin": null,
//     "PartnerMarginPercent": null,
//     "ExtraMargin": null,
//     "ExtraMarginPercent": null,
//     "ExtraDiscount": null,
//     "ExtraDiscountPercent": null,
//     "LocalTime": null,
//     "TestOrder": true,
//     "Errors": null,
//     "Items": [
//         {
//             "ProductDetails": {
//             "Name": "zeroPrice",
//                 "ExtraInfo": null,
//                 "RenewalStatus": false,
//                 "Subscriptions": null
//             },
//             "PriceOptions": [],
//             "Price": {
//             "UnitNetPrice": 0,
//                 "UnitGrossPrice": 0,
//                 "UnitVAT": 0,
//                 "UnitDiscount": 0,
//                 "UnitNetDiscountedPrice": 0,
//                 "UnitGrossDiscountedPrice": 0,
//                 "UnitAffiliateCommission": 0,
//                 "Currency": "eur",
//                 "NetPrice": 0,
//                 "GrossPrice": 0,
//                 "NetDiscountedPrice": 0,
//                 "GrossDiscountedPrice": 0,
//                 "Discount": 0,
//                 "VAT": 0,
//                 "AffiliateCommission": 0
//             },
//             "Code": "z3r0",
//             "Quantity": 1,
//             "SKU": null,
//             "CrossSell": null,
//             "Trial": null,
//             "AdditionalFields": null,
//             "Promotion": null
//         }
//     ],
//     "Promotions": [],
//     "AdditionalFields": null,
//     "Currency": "eur",
//     "NetPrice": 0,
//     "GrossPrice": 0,
//     "NetDiscountedPrice": 0,
//     "GrossDiscountedPrice": 0,
//     "Discount": 0,
//     "VAT": 0,
//     "AffiliateCommission": 0
// }
//
