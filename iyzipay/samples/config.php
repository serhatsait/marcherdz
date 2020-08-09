<?php

require_once('../IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-eCQIkNo9jczDhKM1skYlrLkAAcfeNoep");
        $options->setSecretKey("sandbox-EY2V249ejEVL1U8FouTG6sTmxaTIVnJt");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}