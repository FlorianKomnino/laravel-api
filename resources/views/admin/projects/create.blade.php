@extends('layouts.app')

@section('content')
@include('admin.projects.partials.createEdit',["route" => "admin.projects.store"  , "formMethod" => "POST" ])
@endsection