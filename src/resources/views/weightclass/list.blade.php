@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
<table class="table table-sm table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <a href="/weightclasses/update/{{ $item->id }}" class="btn btn-outline-primary btn-sm">Edit</a>
                <form method="post" action="/weightclasses/delete/{{ $item->id }}" class="d-inline deletion-form">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Nav atrasts neviens ieraksts</p>
@endif

<a href="/weightclasses/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection