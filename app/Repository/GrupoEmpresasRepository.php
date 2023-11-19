<?php

namespace App\Repository;

use App\Models\Grupo_empresas;
use App\Models\Doc;
use MongoDB\BSON\UTCDateTime;

class GrupoEmpresasRepository
{

    public function getGrupoEmpresas()
    {
        $grupoEmpresas = Grupo_empresas::All();
        return $grupoEmpresas;
    }

    public function getTotalDocs($grupo_emp)
    {
        $docs = Doc::where('dt_emis', '>=', new UTCDateTime(now()->subDay(1)->startOfDay()))
            ->where('dt_emis', '<', new UTCDateTime(now()->startOfDay()))
            ->where("$grupo_emp", 'exists', true)->get();
        return $docs;
    }
}
