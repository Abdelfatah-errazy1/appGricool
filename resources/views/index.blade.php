@extends('layout.master')
@include('include.blade-components')
@section('page_title' , 'dashboard')

@section('content')
<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Identification Plantation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Gestion d'irrigation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_6">Gestion de Fertilisation</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="kt_tab_pane_4" role="tabpanel">
       @include('dashboard.plantation')
    </div>
    <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
        @include('dashboard.irrigation')
        @include('dashboard.execution')
        @include('chart')
    </div>
    <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
        {{-- @include('dashboard.GestionIrrigation') --}}
    </div>
</div>
@endsection

