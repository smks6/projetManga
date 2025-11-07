@extends("layouts.master")

@section('content')
    <form method="POST" action="{{route('validManga')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$manga->id_manga}}">
        <h1>@if($manga->id_manga) Modification @else Ajout @endif d'un manga</h1>
        <div class="col-md-12 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-3" selected>Titre : </label>
                <div class="col-md-6">
                    <input type="text" name="titre" value="{{$manga->titre}}" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6" >Genre :</label>
                <div class="col-md-6">
                    <select class="form-select" name="genre">
                        <option value="" disabled selected >Selectionnez un genre :</option>
                        @foreach($genres as $genre)


                            <option value="{{$genre->id_genre}}" @if($manga->id_genre == $genre->id_genre)selected @endif>
                                {{$genre->lib_genre}}
                            </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6" >Dessinateur :</label>
                <div class="col-md-6">
                    <select class="form-select" name="dess">
                        <option value="" disabled >Selectionnez un dessinateur :</option>
                        @foreach($dessinateur as $dess)
                            <option value="{{$dess->id_dessinateur}}" @if($manga->id_dessinateur == $dess->id_dessinateur)selected @endif>
                                {{$dess->nom_dessinateur}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-6" >Scénariste :</label>
                <div class="col-md-6">
                    <select class="form-select" name="sce">
                        <option value="" disabled >Selectionnez un scénariste :</option>
                        @foreach($scenariste as $sce)
                            <option value="{{$sce->id_scenariste}}" @if($manga->id_scenariste == $sce->id_scenariste)selected @endif>
                                {{$sce->nom_scenariste}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Prix : </label>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="prix" value="{{$manga->prix}}" @if($manga->prix) @endif class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Couverture : </label>
                <div class="col-md-6">
                    <input type="hidden" name="MAX_FILE_SIZE" value="204800">
                    <input type="file" accept="image/*" name="couv" class="form-control">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-md-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">
                        Valider
                    </button>
                    <button type="button" class="btn btn-secondary"
                            onclick="if (confirm('Annuler la saisie ?')) window.location='{{ url('/') }}'; ">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
