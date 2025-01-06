@extends('layouts.app')

@section('title', 'Kalkulators')

@section('content')
<style>
.background_photo {
    position: relative;
    background-image: url('/images/background_photo.jpg');
    background-size: cover; 
    background-position: center; 
    height: 55vh;
    width: 60%;
    display: flex; 
    justify-content: center; 
    align-items: center; 
    text-align: center; 
    margin-right: auto;
    margin-left: auto;
    margin-top: 100px;
}
</style>
<div class="background_photo">
    <div class="text">
        <h1>Uzbūvē savu sapņu māju!</h1>
        <p>Izmanto moduļu māju cenu kalkulatoru jau šodien</p>
        <a href="{{ route('start') }}">
            <button class="start-btn">Sākt</button>
        </a>
    </div>
</div>
@endsection
