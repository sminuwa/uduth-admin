<?php

if (function_exists('is_connected') == false) {
    function is_connected()
    {
        $connected = @fsockopen(get_configuration('site_url')->value, 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
}

if(function_exists('is_synced') == false){
    function is_synced(){
        if (services_synced() == true)  return true;
        else return false;
    }
}

if(function_exists('get_unsynced_services') ==false){
    function services_synced(){
        return false;
    }
}
