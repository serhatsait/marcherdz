<?php

require_once('iyzipay/IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
   /*
   public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("");
        $options->setSecretKey("");
        $options->setBaseUrl("https://api.iyzipay.com/");
        return $options;
    }
	*/
	public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-2IyGIyZn6P9QXrRCDf9OK2NasoH8HBm1");
        $options->setSecretKey("sandbox-xFBL2okUuQyxtVuJUwmtdPKwKLXVuv4P");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}