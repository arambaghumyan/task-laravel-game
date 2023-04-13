@extends('layouts.master')

@section('css')
	<style type="text/css">
		#home {
			display: flex;
			justify-content: center;
			height: 100vh;
		}
		.button {
            display: inline-block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            text-align: center;
            border: none;
            margin-right: 10px;
            height: max-content;
        }

        /* Стиль для кнопки "Мне повезет" */
        .lucky-button {
            background-color: #28a745;
        }

        /* Стиль для кнопки "История" */
        .history-button {
            background-color: #ffc107;
        }

        /* Стиль для кнопки "Деактивация" */
        .deactivate-button {
            background-color: #dc3545;
        }
	</style>
@stop
@section('content')
<section id="home">
	<button id="copy-button" class="button" onclick="copyToClipboard()">Копировать ссылку</button>

    @if($token)
        <form action="{{route('tokens.store')}}" method="POST">
            @csrf
            <button id="generate-button" value="{{$token->id}}" name="token_id" class="button">Сгенерировать ссылку</button>
        </form>
    @endif

    @if($token)
        <form action="{{route('tokens.deactivate', ['token' => $token->id])}}" method="POST">
            @csrf
            <button id="deactivate-button" class="button deactivate-button">Деактивировать ссылку</button>
        </form>
    @endif
    <form action="{{route('games.play', ['token' => $token->id])}}" method="POST">
        @csrf
        <button id="lucky-button" class="button lucky-button">Мне повезет</button>
    </form>
    <a class="button history-button" href="{{route('games.history', ['token' => $token->id])}}">История</a>

    @if($game)
        <div id="game">
            <p>Random number: {{$game->random_number}}</p>
            <p>Result: {{$game->result}}</p>
            @if($game->result == 'win')
                <p>Win {{$game->winning_amount}}</p>
            @else
                <p>Lose</p>
            @endif
        </div>
    @endif
</section>
@endsection
<script>
    function copyToClipboard() {
        var tempInput = document.createElement("input");
        tempInput.value = location.href;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
    }
</script>
