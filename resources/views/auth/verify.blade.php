@extends('layouts.app')

@section('content')
<div class="c-container">
    <div class="c-row justify-content-center">
        <div class="col-md-8">
            <div class="p-card">
                <div class="p-card__header">{{ __('Verify Your Email Address') }}</div>

                <div class="p-card__body">
                    @if (session('resent'))
                        <div class="c-alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
