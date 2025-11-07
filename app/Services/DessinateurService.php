<?php

namespace App\Services;

use App\Models\Dessinateur;
use Illuminate\Database\QueryException;
use App\Exceptions\UserException;

class DessinateurService
{
    public function getListDess(){
        try {
            $liste=Dessinateur::all();
            return $liste;
        }catch (QueryException $exception){
            $userMessage="Impossibe d'acceder a la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
