@extends('layouts.app')

@section('title', 'Kalkulators')

@section('content')
    <div class="text">
        <h1>Uzbūvē savu sapņu māju!</h1>
        <p>Izmanto moduļu māju cenu kalkulatoru jau šodien</p>
        <a href="{{ route('start') }}">
            <button class="start-btn">Sākt</button>
        </a>
    </div>
@endsection
