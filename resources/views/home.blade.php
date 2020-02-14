@extends('layouts.app')

@section('content')
<div class="c-container">
    <div class="c-row justify-content-center">
        <div class="col-md-8">
            <div class="p-card">
                <div class="p-card__header">Dashboard</div>

                <div class="p-card__body">
                    @if (session('status'))
                        <div class="c-alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
