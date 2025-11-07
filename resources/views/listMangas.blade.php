@extends('layouts.master')

@section('content')
    <h1>Liste des mangas</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Couverture</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Dessinateur</th>
            <th>Scénariste</th>
            <th>Prix</th>
            <th><i class="bi bi-pencil"></i></th>
            <th><i class="bi bi-trash"></i></th>
        </tr>
        </thead>
        @foreach($mangas as $manga)
        <tr>
            <td><img class="img-thumbnail"
                     src="{{ asset('assets/images/' . $manga->couverture) }}" alt="{{ $manga->titre }}" width="100">
            </td>
            <td>{{$manga->titre}}</td>
            <td>{{$manga->lib_genre}}</td>
            <td>{{$manga->nom_dessinateur}}</td>
            <td>{{$manga->nom_scenariste}}</td>
            <td>{{$manga->prix}}</td>
            <td><a href="{{ route('editerManga', $manga->id_manga) }}"><i class="bi bi-pencil"></i></a></td>
            <td><a onclick="return confirm('Supprimer ce manga ?')"
                   href="{{route('removeManga', $manga->id_manga)}}"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        @endforeach

    </table>
@endsection
