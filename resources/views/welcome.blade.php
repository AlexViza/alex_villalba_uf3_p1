<!DOCTYPE html>
<html lang="en">
@extends('layouts.master')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container">
@section('content')
    <h1 class="mt-4 text-center">Lista de Peliculas</h1>
    <ul class="list-unstyled text-center">
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/films">Pelis</a></li>
        <li><a href="/filmout/sortFilms">Pelis ordenadas por año</a></li>
        <li><a href="/filmout/countFilms">Contar pelis</a></li>
    </ul>

    <h1 class="text-center mt-4">Añadir Pelicula</h1>
    <form action="{{ route('createFilm') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" class="form-control">
        </div>
        <div class="form-group">
            <label for="duration">Duration:</label>
            <input type="number" id="duration" name="duration" class="form-control">
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" class="form-control">
        </div>
        <div class="form-group">
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" class="form-control">
        </div>
        <div class="form-group">
            <label for="url">Url:</label>
            <input type="text" id="url" name="url" class="form-control">
        </div>
        <button type="submit" name="send" class="btn btn-primary btn-block">Send</button>
    </form>

    @if(isset($Error))
        <div class="alert alert-danger mt-4">
            <h2 class="text-center">{{ $Error }}</h2>
        </div>
    @endif

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @endsection
</body>

</html>
