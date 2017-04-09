<?php

namespace App\Hub;

use GuzzleHttp\Client;

/**
 * Class PerfectMoney
 */
class PerfectMoney
{
    public static function sendMoney($accounts, $amount)
    {
        $client = new Client([
            'base_uri' => config('perfectmoney.base_url'),
            'timeout'  => 10.0,
        ]);
        $params = [
            'Payee_Account' => $accounts,
            'Amount' => $amount,
        ];
        $params = array_merge($params, [
            'AccountID' => config('perfectmoney.account_id'),
            'PassPhrase' => config('perfectmoney.pass_phrase'),
            'Payer_Account' => config('perfectmoney.payer_account'),
            'Memo' => config('perfectmoney.memo'),
        ]);
        $response = $client->request('POST', '/acct/confirm.asp', [
            'query' => $params,
        ]);

        $content = $response->getBody()->getContents();

        if(! preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $content, $result, PREG_SET_ORDER)){
            throw new \Exception('PerfectMoeny return error');
        }

        $res = [];
        foreach($result as $item){
            $key = $item[1];
            $res[$key] = $item[2];
        }
        return $res;
    }
}
