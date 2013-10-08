<?php

class Credentials
{
    public static function getCredentials()
    {
        $credentials = new PagSeguroAccountCredentials("your@email.com", "your_token_here");
        return $credentials;
    }
}
