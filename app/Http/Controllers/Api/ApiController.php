<?php

namespace App\Http\Controllers\Api;
use App\House;
use App\Extra;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    
    // PROVA

//  public function filter(Request $request)
//  {

//      $dataRequest = $request->all();

//      $data = [];

//      if ($dataRequest['wifi'] == '1') {
//          $extraWifi = Extra::where('name', 'Wifi')->first();
//          $houseWifi = $extraWifi->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $houseWifi;
//      }
//      if ($dataRequest['posto_macchina'] == '1') {
//          $extraPostoMacchina = Extra::where('name', 'Posto Macchina')->first();
//          $housePostoMacchina = $extraPostoMacchina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePostoMacchina;
//      }
//      if ($dataRequest['piscina'] == '1') {
//          $extraPiscina = Extra::where('name', 'Piscina')->first();
//          $housePiscina = $extraPiscina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePiscina;
//      }
//      if ($dataRequest['portineria'] == '1') {
//          $extraPortineria = Extra::where('name', 'Portineria')->first();
//          $housePortineria = $extraPortineria->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $housePortineria;
//      }
//      if ($dataRequest['sauna'] == '1') {
//          $extraSauna = Extra::where('name', 'Sauna')->first();
//          $houseSauna = $extraSauna->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();
//          $data[] = $houseSauna;
//      }

//      return json_encode($data);
//  }


}
