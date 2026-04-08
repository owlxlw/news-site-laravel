@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <div class="card">
        <h1>Контакты</h1>

        <h2>Адрес</h2>
        <p>{{ $contacts['address'] }}</p>

        <h2>Телефон</h2>
        <p>{{ $contacts['phone'] }}</p>

        <h2>Email</h2>
        <p>{{ $contacts['email'] }}</p>

        <h2>Режим работы</h2>
        <p>{{ $contacts['work_hours'] }}</p>

        <h2>Мы в соцсетях</h2>
        <p>{{ $contacts['social'] }}</p>
    </div>
@endsection