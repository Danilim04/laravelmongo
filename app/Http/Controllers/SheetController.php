<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;
use App\Models\Doc;
use App\Models\Grupo_empresas;
use MongoDB\BSON\UTCDateTime;
use \Google\Service\Sheets\ValueRange;

class SheetController extends Controller
{
    private $values;
    private $dados;
    private $totalDocs;
    public function ApiSheets(Request $request)
    {
        $this->dadosPlanilha();
        $this->dadosBanco();
        // $this->adicionarPlanilha();
    }

    public function dadosPlanilha () {
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
        $this->values = $response->getValues(); 
    }

    public function dadosBanco() {       
        $dado = Grupo_empresas::where('grupo_emp','JC')->get();
        
        foreach($dado as $doc) {
            $this->dados['grupo_emp'] = $doc['grupo_emp'];
            $this->dados['tipo_emp'] =  $doc['tipo_emp'];
            $this->dados['cnpj'] = $doc['cnpjs'][0];

            $docs = Doc::where('dt_emis', '>=', new UTCDateTime(now()->subDay(1)->startOfDay()))
            ->where('dt_emis', '<', new UTCDateTime(now()->startOfDay()))
            ->where($this->dados['grupo_emp'],'exists', true)->get();
            $this->totalDocs = count($docs);
            $this->adicionarPlanilha();           
        }
    }

    public function adicionarPlanilha() {
        
        $client = new Client();
        $client->setApplicationName('nome da sua aplicação');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credencias.json');
        $client->setPrompt('select_account consent');
        
        $service = new Sheets($client);

        $spreadsheetId = "17DBBTG49P-7h9xJjwlojxCb6bL02WubbWzRx8AqVeOQ";
        
        $newValues = [
            
            [$this->dados['grupo_emp'],$this->dados['tipo_emp'] ,"$this->totalDocs" ],
        ];

        $body = new ValueRange([
            'values' => $newValues
        ]);

        $rangeToWrite = "A2:Z"; // Adiciona após a última linha existente

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
