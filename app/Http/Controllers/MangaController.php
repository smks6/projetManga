<?php

namespace App\Http\Controllers;
use App\Models\Manga;
use App\Services\DessinateurService;
use App\Services\ScenaristeService;
use App\Services\MangaService;
use App\Services\GenreService;
use Exception;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function listMangas(){
        try {
            $service=new MangaService();
            $mangas=$service->getListMangas();
            foreach ($mangas as $manga) {
                if (!file_exists('assets\\images\\'. $manga->couverture)){
                    $manga->couverture='erreur.png';
                }
            }
            return view('listMangas', compact('mangas'));
        }catch (Exception $exception){
            return view('error', compact('exception'));
        }
    }
    public function editManga($id)
    {
        $mangaService = new MangaService();
        $manga = $mangaService->getManga($id);

        $dessinateurService = new DessinateurService();
        $dessinateur = $dessinateurService->getListDess();

        $genreService = new GenreService();
        $genres = $genreService->getListGenres();

        $scenaristeService = new ScenaristeService();
        $scenariste = $scenaristeService->getListSce();

        return view('formManga', compact('manga', 'genres', 'dessinateur', 'scenariste'));
    }


    public function addManga(){
        try {
            $manga=new Manga();

            $service=new GenreService();
            $genres=$service->getListGenres();

            $service=new DessinateurService();
            $dessinateur=$service->getListDess();

            $service= new ScenaristeService();
            $scenariste=$service->getListSce();

            return view('formManga', compact('manga', 'genres', 'dessinateur', 'scenariste'));
        }catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function validManga(Request $request)
    {
        try {
            $service = new MangaService();
            $id = $request->input('id');

            if ($id) {
                $manga = $service->getManga($id);
            } else {
                $manga = new Manga();
            }

            $manga->titre = $request->input('titre');
            $manga->id_genre = $request->input('genre');
            $manga->id_dessinateur = $request->input('dess');
            $manga->id_scenariste = $request->input('sce');
            $manga->prix = $request->input('prix');

            $couv = $request->file('couv');
            if ($couv) {
                $manga->couverture = $couv->getClientOriginalName();
                $couv->move(public_path('assets/images'), $manga->couverture);
            }

            $service->saveManga($manga);
            return redirect()->route('listMangas');

        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function removeManga($id)
    {
        $service = new MangaService();
        $service->deleteManga($id);
        return redirect()->route('listMangas');
    }



}
