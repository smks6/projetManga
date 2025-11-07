<?php

namespace App\Services;
use App\Models\Manga;
use Exception;
use Illuminate\Database\QueryException;
use App\Exceptions\UserException;
class MangaService
{
    public function getListMangas(){
        try {
            $liste=Manga::query()
                ->select('manga.*', 'genre.lib_genre', 'dessinateur.nom_dessinateur', 'scenariste.nom_scenariste')
                ->join('genre', 'genre.id_genre', '=', 'manga.id_genre')
                ->join('dessinateur', 'dessinateur.id_dessinateur', '=', 'manga.id_dessinateur')
                ->join('scenariste',  'scenariste.id_scenariste', '=', 'manga.id_scenariste')
                ->get();
            return $liste;
        }catch (QueryException $exception){
            $userMessage ="Impossible d'acceder a la base de donnees.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function getManga($id)
    {
        $mangas=Manga::query()->find($id);
        return $mangas;
    }

    public function saveManga(Manga $manga){
        try {
            $manga->save();
        }catch (Exception $exception){
            if (!$manga->id_genre){
                $userMessage="Vous devez sélectionner un genre";
            }else if (!$manga->id_dessinateur){
                $userMessage="Vous devez sélectionner un dessinateur";
            }else if (!$manga->id_scenariste){
                $userMessage="Vous devez sélectionner un scenariste";
            }else if (!$manga->couverture){
                $userMessage="Vous devez sélectionner une image de couverture";
            }else{
                $userMessage ="Impossible de mettre a jour la base de données.";
            }
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function deleteManga($id){
        $manga=Manga::query()->find($id);
        $manga->delete();
    }
}
