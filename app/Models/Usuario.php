<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Usuario extends Model
{
    protected $collection = 'Usuarios';
    protected $connection = 'mongodb';
    
    protected $fillable = [
        "TESTE 1811",
        "TETOOO",
        "TESTE",
        "TESTE2",
        "TESTE3",
        "TTESTEE",
        "VITALITY",
        "ASTRALIS",
        "NAVI",
        "TETOOO",
        "TESTE",
        "TESTE2",
        "TESTE3",
        "TTESTEE",
        "TRANSMED",
        "FHSO",
        "AGILE",
        "CASAALADIM",
        "VAPTVUPT",
        "IZITRANSP",
        "VAPUTVUPT",
        "FENIX",
        "FONSECA",
        "WANDERLEY",
        "AACR",
        "TNORTE",
        "MEDLOG",
        "AACARVALHO",
        "JSP",
        "ALMEIDA",
        "WF",
        "R2B",
        "ITZ",
        "NAZARIA",
        "INFODEC",
        "ROCHA",
        "YM",
        "TOTAL",
        "LOGAKI",
        "SANTACLARA",
        "PONTUAL",
        "MM",
        "PG",
        "JOBSON",
        "PONTUALCARGA",
        "M&M",
        "JOSEAUGUSTO",
        "FM",
        "RC",
        "TRANSLIDER",
        "TRANSSOARES",
        "AR4D",
        "OFFICE",
        "PACOTE",
        "EXPRESSO",
        "TRANSELLO",
        "TEGMA",
        "CEPALAB",
        "TRANSDONATTO",
        "TESTSE",
        "GSFARMA",
        "RODOFAR",
        "AZAPFYESAS",
        "REDEMINEIRA",
        'remember_token',       // string  -- token de validacao -- Adix
        'name',                 // String  -- nome do usuario -- Adix
        'nome',                 // String  -- nome do usuario -- Adix
        'login',                 // String  -- nome do usuario -- Adix
        'email',                // string  -- email de usuario -- Adix
        'cpf',                  // string  -- cpf do usuario -- Adix
        'novo_user',
        'password',             // String  -- senha do usuario -- Adix
        'grupo_emp',            // String  -- nome do grupo_empresa qual o usuario pertence -- Filipe
        'cnpj_empresa',         // String  -- cnpj da empresa do usuario -- Filipe
        'base',                 // String  -- base do usuario -- Filipe
        'bases',                 // String  -- base do usuario -- Filipe
        'nome_par',             // String  -- nome da empresa do parceiro -- Filipe
        'cnpj_par',             // String  -- cnpj da empresa do parceiro -- Filipe
        'cnh',                  // String  -- cnh do motorista -- Filipe
        'placa_veiculo',        // String  -- placa do veiculo do motorista -- Filipe
        'tipo_veiculo',         // String  -- tipo do veiculo do motorista -- Filipe
        'grupo_usuario',        // String  -- nome do grupo_usuario qual o usuario pertence -- Filipe
        'telefone',             // String  -- telefone do usuario
        'empresas',             // Array   -- Empresas do motorista
        'ativo',                // Boolean -- status do usuario -- Filipe
        'dt_ultimo_uso',        // date    -- data do ultimo acesso -- Adix
        'versao_app',           // string  -- versao do aplicativo -- Adix
        'token_app',            // string  -- token do aplicativo -- Erick
        'dt_token_app',         // date    -- data do token do aplicativo -- Erick
        'cnpj_cliente',         // array -- cnpjs ligados ao usuario cliente -- Filipe
        'pago',                 // boolean -- informa se o cliente e pago ou nao -- Filipe
        'app',                // array -- dados para suporte ao usuario e informacoes vindas do celular -- Filipe
        'codigo_redef',          // string -- codigo para redefinir a senha do usuario
        'grupos',
        'senha',
        "adicionais",
        "img_perfil",
        'config_app',           // array -- configurações do App Motorista
        'jornada_trabalho'
    ];
}
