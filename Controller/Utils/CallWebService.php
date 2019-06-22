<?php


class CallWebService
{

    //returns JSON
    public function doGet($url)
    {
        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($request);
        curl_close($request);
        $data = json_decode($response);
        return $data;
    }

    public function doPost($url, $JSONdata)
    {
        $ch = curl_init($url);

        $payload = $JSONdata;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $result = curl_exec($ch);

        return $result;
    }
}


