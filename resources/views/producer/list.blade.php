@extends('layouts.master')
@section('content')

<h1>{{$title}}</h1>

@if(empty($producers))
    <FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
    <div align="center">
    <table border="1">
        <tr>
            @foreach($producers as $producer)
                @foreach(array_keys($producer) as $key)
                    <th>{{$key}}</th>
                @endforeach
                @break
            @endforeach
        </tr>

        @foreach($producers as $producer)
            <tr>
                <td>{{$producer['id']}}</td>
                <td>{{$producer['name']}}</td>
                <td>{{$producer['film_id']}}</td>
                <td><img src={{$producer['img_url']}} style="width: 100px; heigth: 120px;" /></td>
            </tr>
        @endforeach
    </table>
</div>
@endif
@endsection
