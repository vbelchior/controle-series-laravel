@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')

@includeWhen(!empty($mensagem),'mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">

            <div>
                <img src="{{$serie->capa_url}}" class="img-thumbmail" height="100px" width="100px">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
            </div>

            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex gap-1">
                @auth
                <button class="btn btn-info btn-sm" onclick="toggleInput({{ $serie->id }})">
                    <i class="fas fa-edit"></i>
                </button>
                @endauth
                <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm ">
                    <i class="fas fa-external-link-alt "></i>
                </a>
                @auth
                <form method="post" action="/series/{{ $serie->id }}"
                    onsubmit="return confirm('Tem certeza?')"
                    class="mb-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger ">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
                @endauth
            </span>

        </li>

    @endforeach
</ul>

<script>
    function toggleInput(serieId){
        const nomeSerieELEMENT = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieELEMENT = document.getElementById(`input-nome-serie-${serieId}`);

        if(nomeSerieELEMENT.hasAttribute('hidden')){
            nomeSerieELEMENT.removeAttribute('hidden');
            inputSerieELEMENT.hidden = true;
        }else{
            inputSerieELEMENT.removeAttribute('hidden');
            nomeSerieELEMENT.hidden = true;
        }
    }

    function editarSerie(serieId){
        let formData = new FormData();
                            //> input = filho da div , nesse caso Input
        const newName = document.
            querySelector(`#input-nome-serie-${serieId} > input`).value

        const token = document.querySelector('input[name="_token"]').value;
        formData.append('nome',newName);
        formData.append('_token',token);



        const url = `/series/${serieId}/editaNome`;
        fetch(url,{
            body: formData,
            method: 'POST'
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = newName;
        });
    }
</script>

@endsection
