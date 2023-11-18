<?php

namespace App\Services;

class GoogleSheetsService 
{
    private $cliente;
    private $spreadsheetId;

    public function __construct($cliente,$spreadsheetId)
    {
        $this->cliente = $cliente;
        $this->spreadsheetId = $spreadsheetId;
    }
    
    public function getClient ()
    {
        return $this->cliente;
    }
    
    public function getSpreadsheetId()
    {
        return $this->spreadsheetId;
    }
}