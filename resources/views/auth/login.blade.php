@extends('layouts.main')

@section('title', 'Login')
@section('meta_description', 'Login to Respo QR Codes')

@section('content')
<div id="login-form-root"></div>
<div style="margin-top:12px">
    <a href="{{ route('google.redirect') }}">Login with Google</a> |
    <a href="{{ route('facebook.redirect') }}">Login with Facebook</a>
</div>
@endsection
