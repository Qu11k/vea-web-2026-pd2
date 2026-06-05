@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if ($errors->any())
<div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
@endif

<form method="post" action="{{ $fight->exists ? '/fights/patch/' . $fight->id : '/fights/put' }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="fight-fighter" class="form-label">Fighter</label>
        <select id="fight-fighter" name="fighter_id" class="form-select @error('fighter_id') is-invalid @enderror">
            <option value="">Choose a fighter</option>
            @foreach($fighters as $fighter)
            <option value="{{ $fighter->id }}" {{ old('fighter_id', $fight->fighter_id) == $fighter->id ? 'selected' : '' }}>
                {{ $fighter->name }}
            </option>
            @endforeach
        </select>
        @error('fighter_id')
        <p class="invalid-feedback">{{ $errors->first('fighter_id') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fight-opponent" class="form-label">Opponent</label>
        <input type="text" id="fight-opponent" name="opponent" value="{{ old('opponent', $fight->opponent) }}" class="form-control @error('opponent') is-invalid @enderror">
        @error('opponent')
        <p class="invalid-feedback">{{ $errors->first('opponent') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fight-result" class="form-label">Result</label>
        <select id="fight-result" name="result" class="form-select @error('result') is-invalid @enderror">
            <option value="">Choose a result</option>
            <option value="Win" {{ old('result', $fight->result) == 'Win' ? 'selected' : '' }}>Win</option>
            <option value="Loss" {{ old('result', $fight->result) == 'Loss' ? 'selected' : '' }}>Loss</option>
            <option value="Draw" {{ old('result', $fight->result) == 'Draw' ? 'selected' : '' }}>Tie</option>
        </select>
        @error('result')
        <p class="invalid-feedback">{{ $errors->first('result') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fight-method" class="form-label">Win/loss by</label>
        <select id="fight-method" name="method" class="form-select @error('method') is-invalid @enderror">
            <option value="">win/loss by</option>
            <option value="KO" {{ old('method', $fight->method) == 'KO' ? 'selected' : '' }}>KO/TKO</option>
            <option value="Submission" {{ old('method', $fight->method) == 'Submission' ? 'selected' : '' }}>Decision</option>
            <option value="Decision" {{ old('method', $fight->method) == 'Decision' ? 'selected' : '' }}>DQ/Surrender</option>
        </select>
        @error('method')
        <p class="invalid-feedback">{{ $errors->first('method') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fight-date" class="form-label">date</label>
        <input type="date" id="fight-date" name="fight_date" value="{{ old('fight_date', $fight->fight_date) }}" class="form-control @error('fight_date') is-invalid @enderror">
        @error('fight_date')
        <p class="invalid-feedback">{{ $errors->first('fight_date') }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fight-event" class="form-label">Event</label>
        <input type="text" id="fight-event" name="event" value="{{ old('event', $fight->event) }}" class="form-control @error('event') is-invalid @enderror">
        @error('event')
        <p class="invalid-feedback">{{ $errors->first('event') }}</p>
        @enderror
    </div>

    <!-- IMAGE UPLOAD FIELD - ADD THIS -->
    <div class="mb-3">
        <label for="fight-image" class="form-label">Attēls</label>
        
        @if($fight->image)
        <img src="{{ asset('images/' . $fight->image) }}" class="img-fluid img-thumbnail d-block mb-2" style="max-width: 200px;" alt="{{ $fight->opponent }}">
        @endif
        
        <input type="file" accept="image/png, image/jpeg, image/webp" id="fight-image" name="image" class="form-control @error('image') is-invalid @enderror">
        
        @error('image')
        <p class="invalid-feedback">{{ $errors->first('image') }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ $fight->exists ? 'Edit' : 'Add' }}</button>
</form>
@endsection