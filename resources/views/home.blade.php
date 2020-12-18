@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <br><br>
                    @if(Auth::user()->is_registered == 1)
                    <a href="{{ route('license.edit', Auth::user()->id ) }}"><button class="btn btn-primary">Edit your license info.</button></a>
                    @endif
                    @if(Auth::user()->is_registered == 0)
                        <a href="{{ route('license.create') }}"><button class="btn btn-primary">Register for your license.</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
