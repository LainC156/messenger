@extends('layouts.app')

@section('content')
<messenger-component
    :user_id="{{ auth()->id() }}"
    ></messenger-component>
@endsection
