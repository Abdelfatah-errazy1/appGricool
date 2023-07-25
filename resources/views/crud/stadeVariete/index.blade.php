@extends('layout.master')
@include('include.blade-components')

@section('page_title', 'Liste de stade variete')
@section('breadcrumb')
    <x-group.bread-crumb page-tittle="Liste de  stade variete" :indexes="[
        ['name' => 'liste de stade variete', 'current' => true],
    ]" />

@endsection


@section('content')
    @bind($collection)
        <x-table.data-table
        {{-- :actions="$actions" --}}
        :heads="$heads"
        />
    @endBinding
@endsection

