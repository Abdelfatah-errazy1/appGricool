@extends('layout.master')
@include('include.blade-components')
@section('page_title' , 'Ajouter Charges Technique Specifique')
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="Ajouter"
        :indexes="[
        ['name'=> 'retour' , 'route'=> route('TechniqueSpecifique.show',$especeId)],
        ['name'=> 'Ajouter Charge Technique specifique' ,     'current' =>true ],
    ]"
    />
@endsection


@section('content')

    <x-form.form
        method="post"
        action="{{ route('ChargesTechSpe.store') }}"
    >
        <x-form.card col="col-12 row" title="Entrer les informations  Charges Technique ">
       
             
            <x-form.input  name="titre"   required col='col-12 col-md-8' label="Titre"/>
            <x-form.input  name="costUnit" type="number" step="0.01" min='0' required col='col-12 col-md-4'  label="Cost Unit"/>
           
            <x-form.text-area  name="description" label="Description"/>
            <input type="hidden" name="idTechFK" value="{{$especeId }}">
        
            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>

    </x-form.form>
@endsection
