<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use DB;

class currencyApiController extends Controller
{
    public function currencyApi(){

        $connect_web = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');


        $usd_name = $connect_web->Currency[0]->CurrencyName;
        $usd_buying = $connect_web->Currency[0]->BanknoteBuying;

        $euro_name = $connect_web->Currency[3]->CurrencyName;
        $euro_buying = $connect_web->Currency[3]->BanknoteBuying;

        Currency::where('id',1)->update(['name'=>$usd_name, 'price'=>$usd_buying]);
        Currency::where('id',2)->update(['name'=>$euro_name, 'price'=>$euro_buying]);

        // $usddata = [
        //     ['id'=>1, 'name'=> $usd_name, 'price'=> $usd_buying]
        // ];

        // $updateUsd = Currency::where('id', 1)->update(['data'=>$usddata]);

        // $eurodata = [
        //     ['id'=>1, 'name'=> $usd_name, 'price'=> $usd_buying]
        // ];

        // $updateEuro = Currency::where('id', 2)->update(['data'=>$eurodata]);



        return "veriler cekildi";
    }
}
