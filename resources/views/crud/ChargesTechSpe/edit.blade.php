@extends('layout.master')
@include('include.blade-components')
@section('page_title' , 'Modifier Charge Technique Specifique')
@section('breadcrumb')
    <x-group.bread-crumb
        page-tittle="Modifier ChargesTechSpe"
        :indexes="[
            ['name'=> 'retour' , 'route'=> route('TechniqueSpecifique.show',$model['idTechFK'])],
            ['name'=> 'Modifier' ,     'current' =>true ],
        ]"
    />
@endsection
@section('content')
    <x-form.form
        method="post"
        action="{{ route('ChargesTechSpe.update' , $model[$model::PK]) }}"
        >
        @bind($model)
        <x-form.card col="col-12 row" title="Entrer les informations des Charges Technique">
            
            <x-form.input  name="titre"    col='col-12 col-md-8' required label="Titre"/>
            <x-form.input  name="costUnit" type="number" step="0.01" col='col-12 col-md-4' required  label="Cost Unit"/>
           
            <x-form.text-area  name="description" label="Description"/>
            <div class="col-12 mt-5">
                <x-form.button/>
            </div>
        </x-form.card>
        @endBinding
    </x-form.form>
@endsection
