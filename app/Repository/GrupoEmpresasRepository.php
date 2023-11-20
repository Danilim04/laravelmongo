<?php

namespace App\Repository;

use App\Models\Grupo_empresas;
use App\Models\Doc;
use MongoDB\BSON\UTCDateTime;
use App\Models\Integracao;
use App\Models\Grupo_empresa;
use App\Models\Usuario;

class GrupoEmpresasRepository
{
    public function getGrupoEmpresas()
    {
        $grupoEmpresas = Grupo_empresa::All();
        return $grupoEmpresas;
    }
    public function getTotalDocs($grupo_emp)
    {
        // $docs = Doc::where('dt_emis', '>=', new UTCDateTime(now()->subDay(1)->startOfDay()))
        //     ->where('dt_emis', '<', new UTCDateTime(now()->startOfDay()))
        //     ->where("$grupo_emp", 'exists', true)->get();
        $docs = Doc::where("$grupo_emp", 'exists', true)->get();
        return $docs;
    }
    public function getIntegracoes($grupo_emp)
    {
        $integracoes = Integracao::where('ativo', true)
            ->whereNotIn('cron', ['NT', 'nt'])
            ->where('grupo_emp', "$grupo_emp")->get();
        return $integracoes;
    }
    public function getTotalComprovados($grupo_emp)
    {
        // $totalComprovadas = Doc::where('dt_emis', '>=', new UTCDateTime(now()->subDay(1)->startOfDay()))
        //     ->where('dt_emis', '<', new UTCDateTime(now()->startOfDay()))
        //     ->where("$grupo_emp", 'exists', true)
        //     ->whereIn("$grupo_emp.status", ["COMPROVADO", "PROTOCOLADO", "VALIDADO"])
        //     ->where('historico.cam_imagem', 'exists', true)->get();
        $totalComprovadas = Doc::where("$grupo_emp", 'exists', true)
            ->whereIn("$grupo_emp.status", ["COMPROVADO", "PROTOCOLADO", "VALIDADO"])
            ->where('historico.cam_imagem', 'exists', true)->get();
        return $totalComprovadas;
    }
    public function getUsers($grupo_emp, $tipoUser)
    {
        $usuarios = Usuario::where("grupos.$grupo_emp", 'exists', true)
            ->where("grupos.$grupo_emp.ativo", true)
            ->where("grupos.$grupo_emp.grupo_user", "$tipoUser")->get();
        return $usuarios;
    }
    public function getDocsRomaneio($grupo_emp)
    {
        $docsRomaneados = Doc::where("$grupo_emp", 'exists', true)
            ->where("$grupo_emp.romaneio", 'exists', true)
            ->get();
        return $docsRomaneados;
    }
}
