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
$productListing = Client::searchProducts(array(
    'Limit' => 1,
    'Enabled' => true,
    'Types' => array(
        'REGULAR'
    )
));

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
$order = array(
    'Items' => array(
        0 => array(
            'Code' => $productCode,
            'Quantity' => 1,
            'Trial' => array(
                'Period' => 30,
                'Price' => 9.99
            )
        )
    ),
    'BillingDetails' => array(
        'FirstName' => 'John',
        'LastName' => 'Doe',
        'Email' => 'john.doe@avangate.com',
        'CountryCode' => 'RO'
    ),
    'PaymentDetails' => array(
        'Type' => 'CC',
        'Currency' => 'EUR',
        'PaymentMethod' => array(
            'CardType' => 'mastercard',
            'CardNumber' => '5555555555554444',
            'CCID' => '321',
            'ExpirationMonth' => '10',
            'ExpirationYear' => '2020',
            'HolderName' => 'John Doe',
        )
    )
);

$responsePlaceOrder = Client::placeOrder($order);

echo json_encode($responsePlaceOrder, JSON_PRETTY_PRINT);

// output:
// {
//     "RefNo": "11317803",
//     "OrderNo": 0,
//     "ExternalReference": null,
//     "ShopperRefNo": null,
//     "Status": "PENDING",
//     "ApproveStatus": "WAITING",
//     "VendorApproveStatus": "OK",
//     "Language": "ro",
//     "OrderDate": "2015-11-18 16:54:59",
//     "FinishDate": null,
//     "Source": null,
//     "AffiliateSource": null,
//     "AffiliateId": null,
//     "AffiliateName": null,
//     "AffiliateUrl": null,
//     "RecurringEnabled": true,
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
//     "Type": "CC",
//         "Currency": "eur",
//         "PaymentMethod": {
//         "FirstDigits": "5555",
//             "LastDigits": "4444",
//             "CardType": "MasterCard",
//             "RecurringEnabled": true
//         },
//         "CustomerIP": "127.0.0.1"
//     },
//     "CustomerDetails": null,
//     "Origin": "API",
//     "AvangateCommission": 2.71,
//     "OrderFlow": "REGULAR",
//     "GiftDetails": null,
//     "PODetails": null,
//     "ExtraInformation": {
//         "PaymentLink": "\/order\/finish.php?id=2Xrl83KEs6O0snGkca%2B6aqnHuLM%3D"
//     },
//     "PartnerCode": null,
//     "PartnerMargin": null,
//     "PartnerMarginPercent": null,
//     "ExtraMargin": null,
//     "ExtraMarginPercent": null,
//     "ExtraDiscount": null,
//     "ExtraDiscountPercent": null,
//     "LocalTime": null,
//     "TestOrder": false,
//     "Errors": {
//          "CARD_PAYMENT_ERROR": "Couldn't complete the payment validation process"
//     },
//     "Items": [
//         {
//             "ProductDetails": {
//                 "Name": "zeroPrice",
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
//             "Trial": {
//             "Period": 30,
//                 "GrossPrice": 9.99,
//                 "VAT": 1.93,
//                 "NetPrice": 8.06
//             },
//             "AdditionalFields": null,
//             "Promotion": null
//         }
//     ],
//     "Promotions": [],
//     "AdditionalFields": null,
//     "Currency": "eur",
//     "NetPrice": 8.06,
//     "GrossPrice": 9.99,
//     "NetDiscountedPrice": 8.06,
//     "GrossDiscountedPrice": 9.99,
//     "Discount": 0,
//     "VAT": 1.93,
//     "AffiliateCommission": 0
// }
//
