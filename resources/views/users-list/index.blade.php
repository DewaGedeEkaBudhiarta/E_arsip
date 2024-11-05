@extends('layouts.app')

@section('title', 'user-list')

@section('content')
<div class="p-4 md:ml-64">
  @include('users-list.partials.user-list')
</div>
@endsection

@section('scripts')
@endsection