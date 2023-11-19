<?php

namespace App\Services;

use App\Repository\GrupoEmpresasRepository;
use Google\Service\Sheets;
use \Google\Service\Sheets\ValueRange;
use Google\Client;

class GoogleSheetsService
{
    private $client;
    private $googleSheetsRepository;
    private $dados;
    private $retorno;

    public function __construct(GrupoEmpresasRepository $googleSheetsRepository)
    {
        $this->googleSheetsRepository = $googleSheetsRepository;
    }

    private function Client()
    {
        $this->client = new Client();
        $this->client->setApplicationName('nome da sua aplicação');
        $this->client->setScopes([Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(base_path(env('GOOGLE_CREDENTIALS_PATH')));
        $this->client->setPrompt('select_account consent');
        return $this->client;
    }

    public function insertPlanilha($dados,$empAtualizadas)
    {
        $service = new Sheets($this->Client());
        $body = new ValueRange([
            'values' => $dados
        ]);
        $rangeToWrite = "A2:Z";
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $result = $service->spreadsheets_values->append(env('GOOGLE_ID_PLAN'), $rangeToWrite, $body, $params);

        if ($result->getUpdates()->getUpdatedCells() > 0) {
            $this->retorno = $empAtualizadas;
        } else {
            $this->retorno = $empAtualizadas;
        }   
    }

    public function getData()
    {       
        $gruposEmpresas = $this->googleSheetsRepository->getGrupoEmpresas();

        foreach ($gruposEmpresas as $grupoEmpresa) {
            $grupo_emp = $grupoEmpresa['grupo_emp'];
            $tipo_emp = $grupoEmpresa['tipo_emp'];
            $totalDocs = count($this->googleSheetsRepository->getTotalDocs($grupo_emp));
            $empAtualizadas[] = $grupo_emp;
            $this->dados[] = [ $grupo_emp ,$tipo_emp, "$totalDocs"];
        }
        $this->insertPlanilha($this->dados,$empAtualizadas);
        return $this->retorno;
    }
}
