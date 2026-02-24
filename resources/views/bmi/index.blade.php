@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">BMI Calculator</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('bmi.calculate') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Height (cm)</label>
                                <input type="number" step="0.1" class="form-control" name="height_cm"
                                       value="{{ old('height_cm', 170) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" step="0.1" class="form-control" name="weight_kg"
                                       value="{{ old('weight_kg', 70) }}" required>
                            </div>

                            <button class="btn btn-primary" type="submit">Calculate BMI</button>
                        </form>

                        @if(isset($latest) && $latest->count())
                            <hr>
                            <h6 class="mb-2">Last calculations</h6>
                            <ul class="mb-0">
                                @foreach($latest as $r)
                                    <li>
                                        {{ $r->height_cm }} cm, {{ $r->weight_kg }} kg → BMI {{ $r->bmi }} ({{ $r->category }})
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
