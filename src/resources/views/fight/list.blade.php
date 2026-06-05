@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
<table class="table table-sm table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fighter</th>
            <th>Opponent</th>
            <th>Result</th>
            <th>Method</th>
            <th>Date</th>
            <th>Event</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $fight)
        <tr>
            <td>{{ $fight->id }}</td>
            <td>{{ $fight->fighter->name ?? 'N/A' }}</td>
            <td>{{ $fight->opponent }}</td>
            <td>{{ $fight->result }}</td>
            <td>{{ $fight->method }}</td>
            <td>{{ $fight->fight_date }}</td>
            <td>{{ $fight->event }}</td>
            <td>
                @if($fight->image)
                    <img src="{{ asset('images/' . $fight->image) }}" style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    —
                @endif
            </td>
            <td>
                <a href="/fights/update/{{ $fight->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                <form method="post" action="/fights/delete/{{ $fight->id }}" class="d-inline deletion-form">
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

<a href="/fights/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection