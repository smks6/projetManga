<?php

namespace App\Services;

use App\Models\Dessinateur;
use App\Models\Genre;
use Illuminate\Database\QueryException;
use App\Exceptions\UserException;

class GenreService
{
    public function getListGenres(){
        try {
            $liste=Genre::all();
            return $liste;
        }catch (QueryException $exception){
            $userMessage="Impossibe d'acceder a la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
