@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if ($errors->any())
<div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
@endif

<form method="post" action="{{ $weightclass->exists ? '/weightclasses/patch/' . $weightclass->id : '/weightclasses/put' }}">
    @csrf

    <div class="mb-3">
        <label for="weight-name" class="form-label">Nosaukums</label>
        <input type="text" id="weight-name" name="name" value="{{ old('name', $weightclass->name) }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <p class="invalid-feedback">{{ $errors->first('name') }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ $weightclass->exists ? 'Edit' : 'Add' }}</button>
</form>
@endsection