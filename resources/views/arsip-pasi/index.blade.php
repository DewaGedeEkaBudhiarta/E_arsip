@extends('layouts.app')

@section('title', 'Arsip PASI')

@section('content')
<div class="p-4 sm:ml-64">
  @include('arsip-pasi.partials.table')
</div>

@endsection