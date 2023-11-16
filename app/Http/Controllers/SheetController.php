<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doc;
use Google\Client;
use Google\Service\Sheets;




class SheetController extends Controller
{
    public function ApiSheets(Request $request)
    {
        set_time_limit(3600);
        $client = new Client();
        $client->setApplicationName('nome da sua aplicação');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credencias.json');
        $client->setPrompt('select_account consent');

        $service = new Sheets($client);
        
        $spreadsheetId = "17DBBTG49P-7h9xJjwlojxCb6bL02WubbWzRx8AqVeOQ";

        $range = "A2:U";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        dd(json_encode($values));
    }
}
