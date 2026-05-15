@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif

    <form method="post" action="{{ $fighter->exists ? '/fighters/patch/' . $fighter->id : '/fighters/put' }}">
        @csrf

        <div class="mb-3">
            <label for="fighter-name" class="form-label">Fighter Name</label>

            <input type="text" class="form-control @error('name') is-invalid @enderror" id="fighter-name" name="name" value="{{ old('name', $fighter->name) }}">

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">{{$fighter->exists ? 'Atjaunot' : 'Pievienot'}}</button>

    </form>

@endsection