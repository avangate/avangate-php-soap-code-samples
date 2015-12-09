<?php

/**
 * @method createCustomer($customerObject)
 * @method getCustomerInformation($AvangateCustomerReference = 0, $ExternalCustomerReference = '')
 * @method placeOrder($orderObject)
 * @method getOrder($refNo)
 * @method addProduct($productObject)
 * @method getProductByCode($productCode)
 * @method addSubscription($subscriptionObject)
 * @method getSubscription($subscriptionCode)
 */
class AvangateSoapClient
{
    protected static $merchantCode;
    protected static $loginDate;
    protected static $hash;
    protected static $baseUrl;
    protected static $callCount = 0;
    protected static $sessionId = '';

    protected static $client;

    public static function setCredentials($code, $key)
    {
        static::$merchantCode = $code;
        static::$loginDate = gmdate('Y-m-d H:i:s');
        static::$hash = hash_hmac('md5', strlen($code) . $code . strlen(static::$loginDate) . static::$loginDate, $key);
        static::$sessionId = static::login();
    }

    public static function setBaseUrl($url)
    {
        static::$baseUrl = $url;
    }

    public static function login()
    {
        $client = static::getClient();
        return $client->login(static::$merchantCode, static::$loginDate, static::$hash);
    }

    public static function __callStatic($name, $arguments = array())
    {
        $client = static::getClient();

        array_unshift($arguments, static::$sessionId);
        $response = call_user_func_array(array($client, $name), $arguments);

        return $response;
    }

    protected static function getClient()
    {
        if (null === static::$client) {
            static::$client = new \SoapClient(static::$baseUrl . "?wsdl", array(
                'location' => static::$baseUrl,
                'cache_wsdl' => WSDL_CACHE_NONE,
            ));
        }

        return static::$client;
    }
}
