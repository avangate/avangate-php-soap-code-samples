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
            'Quantity' => 1
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
            'CardType' => 'visa',
            'CardNumber' => '4111111111111111',
            'CCID' => '123',
            'ExpirationMonth' => '10',
            'ExpirationYear' => '2020',
            'HolderName' => 'John Doe',
        )
    )
);

$responsePlaceOrder = Client::placeOrder($order);

echo json_encode($responsePlaceOrder, JSON_PRETTY_PRINT);

// output:
//
// {
//     "RefNo": "11331111",
//     "OrderNo": 0,
//     "ExternalReference": null,
//     "ShopperRefNo": null,
//     "Status": "PENDING",
//     "ApproveStatus": "WAITING",
//     "VendorApproveStatus": "OK",
//     "Language": "ro",
//     "OrderDate": "2015-11-18 16:47:07",
//     "FinishDate": null,
//     "Source": null,
//     "AffiliateSource": null,
//     "AffiliateId": null,
//     "AffiliateName": null,
//     "AffiliateUrl": null,
//     "RecurringEnabled": false,
//     "HasShipping": true,
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
//         "FirstDigits": "4111",
//             "LastDigits": "1111",
//             "CardType": "Visa",
//             "RecurringEnabled": false
//         },
//         "CustomerIP": "127.0.0.1"
//     },
//     "CustomerDetails": null,
//     "Origin": "API",
//     "AvangateCommission": 0,
//     "OrderFlow": "REGULAR",
//     "GiftDetails": null,
//     "PODetails": null,
//     "ExtraInformation": {
//         "PaymentLink": "https:\/\/api.avangate.com\/order\/finish.php?id=2Xrl83KEs6O0snHrceW6aqrHuLg%3D"
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
//     "CARD_PAYMENT_ERROR": "Couldn't complete the payment validation process"
//     },
//     "Items": [
//         {
//             "ProductDetails": {
//                 "Name": "test4_tc1rk0rk0qfiveipucqgc72fv5",
//                 "ExtraInfo": null,
//                 "RenewalStatus": false,
//                 "Subscriptions": null
//             },
//             "PriceOptions": [
//                 {
//                     "Code": "COLOR",
//                     "Required": false,
//                     "Options": [
//                         "yellow"
//                     ]
//                 }
//             ],
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
//             "Code": "test2tc1rk0rk0qfiveipucqgc72fv5",
//             "Quantity": 1,
//             "SKU": null,
//             "CrossSell": null,
//             "Trial": null,
//             "AdditionalFields": null,
//             "Promotion": null
//         },
//         {
//             "ProductDetails": {
//                 "Name": "NG_SHIPPING_GENERIC_PRODUCT",
//                 "ExtraInfo": null,
//                 "RenewalStatus": false,
//                 "Subscriptions": null
//             },
//             "PriceOptions": [],
//             "Price": {
//             "UnitNetPrice": 10,
//                 "UnitGrossPrice": 12.4,
//                 "UnitVAT": 2.4,
//                 "UnitDiscount": 0,
//                 "UnitNetDiscountedPrice": 10,
//                 "UnitGrossDiscountedPrice": 12.4,
//                 "UnitAffiliateCommission": 0,
//                 "Currency": "eur",
//                 "NetPrice": 10,
//                 "GrossPrice": 12.4,
//                 "NetDiscountedPrice": 10,
//                 "GrossDiscountedPrice": 12.4,
//                 "Discount": 0,
//                 "VAT": 2.4,
//                 "AffiliateCommission": 0
//             },
//             "Code": "SHIPPING_GENERIC_PRODUCT",
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
//     "NetPrice": 10,
//     "GrossPrice": 12.4,
//     "NetDiscountedPrice": 10,
//     "GrossDiscountedPrice": 12.4,
//     "Discount": 0,
//     "VAT": 2.4,
//     "AffiliateCommission": 0
// }
