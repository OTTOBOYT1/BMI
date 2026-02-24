@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">BMI Result</div>

                    <div class="card-body">
                        <p><strong>Height:</strong> {{ $record->height_cm }} cm</p>
                        <p><strong>Weight:</strong> {{ $record->weight_kg }} kg</p>
                        <hr>
                        <p style="font-size: 20px;"><strong>BMI:</strong> {{ $record->bmi }}</p>
                        <p><strong>Category:</strong> {{ $record->category }}</p>

                        <a href="{{ route('bmi.index') }}" class="btn btn-secondary mt-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
