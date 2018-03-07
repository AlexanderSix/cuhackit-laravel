@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <goal-tracker user="{{ Auth::user()->id }}"></goal-tracker>
        </div>
    </div>
</div>
@endsection
