@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="p-4 sm:ml-64">

   <div class="flex items-center justify">
      <img src="{{ asset('img/logo seri 5.png') }}" alt="Logo" class="h-60 w-auto p-6">
   </div>

   @include('rekapitulasi.index')

   <div class="p-4 sm:ml-64">
      <div class="p-4 border-4 border-gray-200 border-dashed rounded-lg ">
         <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="bg-blue-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
               <i class="fa-solid fa-folder fa-2xl"></i>
               <a href="/arsip-pasi" class="text-2xl">Daftar Arsip</a>
            </div>
            <div class="bg-green-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
               <i class="fa-solid fa-file-lines fa-2xl"></i>
               <a href="/informasi" class="text-2xl">Klasifikasi Arsip</a>
            </div>
            <div class="bg-yellow-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
               <i class="fa-solid fa-clipboard fa-2xl"></i>
               <a href="/activity-logs" class="text-2xl">Aktivitas</a>
            </div>
            <div class="bg-red-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
               <i class="fa-solid fa-diagram-project fa-2xl"></i>
               <a href="/pemindahan/table-active" class="text-2xl">Pemindahan Arsip</a>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="justify-items-center p-6">
   <div class="container flex items-center justify-between block px-6 py-4 mx-auto">
      <p class="mx-auto text-black-900 font-bold center sm:py-0 pl-60">
         © Copyright 2024 | Dionisius and Dewa Eka | All
         Rights Reserved
   </div>
</div>
@endsection