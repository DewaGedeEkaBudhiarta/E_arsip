@extends('layouts.app')

@section('title', 'Home')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
      <div class="grid grid-cols-4 gap-4 mb-4">
         <div class="bg-slate-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
            <i class="fa-solid fa-folder fa-2xl"></i>
            <a href="/arsip-pasi" class="text-2xl">Daftar Arsip</a>
         </div>
         <div class="bg-slate-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
            <i class="fa-solid fa-file-lines fa-2xl"></i>
            <a href="/informasi" class="text-2xl">Klasifikasi Arsip</a>
         </div>
         <div class="bg-slate-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
            <i class="fa-solid fa-folder-open fa-2xl"></i>
            <a href="/upload" class="text-2xl">Upload Document</a>
         </div>
         <div class="bg-slate-300 p-6 rounded-lg flex flex-col gap-10 pt-10 font-bold">
            <i class="fa-solid fa-diagram-project fa-2xl"></i>
            <a href="/pemindahan/table-active" class="text-2xl">Pemindahan Arsip</a>
         </div>
      </div>
   </div>
</div>
@endsection