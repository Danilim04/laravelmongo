<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;
use \Google\Service\Sheets\ValueRange;

class SheetController extends Controller
{
    public function ApiSheets(Request $request)
    {
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
        
        
        $newValues = [
            
            ["Novo Valor 1", "Novo Valor 2", "Novo Valor 3"],
        ];

        $body = new ValueRange([
            'values' => $newValues
        ]);

        $rangeToWrite = "A" . (count($values) + 2) . ":U"; // Adiciona após a última linha existente

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $result = $service->spreadsheets_values->append($spreadsheetId, $rangeToWrite, $body, $params);

        if ($result->getUpdates()->getUpdatedCells() > 0) {
            dd('Valores adicionados com sucesso!');
        } else {
            dd('Falha ao adicionar valores.');
        }
    }
}
