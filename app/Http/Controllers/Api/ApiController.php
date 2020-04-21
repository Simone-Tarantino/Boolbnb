<?php

namespace App\Http\Controllers\Api;
use App\House;
use App\Extra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function filter()
    {
        $extraWifi = Extra::where('name', 'Wifi')->first();
        $houseWifi = $extraWifi->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();

        $extraPostoMacchina = Extra::where('name', 'Posto Macchina')->first();
        $housePostoMacchina = $extraPostoMacchina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();

        $extraPiscina = Extra::where('name', 'Piscina')->first();
        $housePiscina = $extraPiscina->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();

        $extraPortineria = Extra::where('name', 'Portineria')->first();
        $housePortineria = $extraPortineria->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();

        $extraSauna = Extra::where('name', 'Sauna')->first();
        $houseSauna = $extraSauna->houses()->where('status', '1')->orderBy('updated_at', 'DESC')->get();

        // $articles = Category::with('articles')->get();

        $data = [
            'wifi' => $houseWifi,
            'posto_macchina' => $housePostoMacchina,
            'piscina' => $housePiscina,
            'portineria' => $housePortineria,
            'sauna' => $houseSauna
        ];

        return json_encode($data);
    }
}
