@extends('layout.master')
@include('include.blade-components')
@section('page_title', "Modifier Stade Variete")
@section('breadcrumb')
    <x-group.bread-crumb
     page-tittle="Modifier Stade Variete"
     :  :indexes="[
        ['name'=> 'retour' , 'route'=> route('varietes.show',$model['variete'])],
        ['name' => 'modifier le Variete Stade', 'current' => true],
    ]"

     />
@endsection
@section('content')

        <x-form.form method="post" action="{{ route('stadeVarietes.update', $model[$model::PK]) }}">
                <x-form.card col="col-12 row" title='Entrer les informations de Stade de Variete'>
                     @bind($model)
                        <x-form.input required col="col-12 col-md-6" name="nom" label="nom" />
                        <x-form.input required col="col-12 col-md-6" name="phaseFin" label="phase de Fin" />
                        <x-form.input required type='number' step="0.01" min='0' col="col-12 col-md-4" name="sommesTemps" label="sommesTemps"/>
                        <x-form.input required type='number' step="0.01" min='0' col="col-12 col-md-4" name="sommesTempFroid" label="sommesTempFroid"/>
                        <x-form.input required type='number' step="0.01" min='0' col="col-12 col-md-4" name="Kc" label="Kc"/>
                        <x-form.input required type='number' step="0.01" min='0' col="col-12 col-md-6" name="enracinement" label="enracinement"/>
                        <x-form.radios required col="col-12 col-md-6" name="maxEnracinement" label="maximum d'Enracinement"
                            :radios="[
                                [
                                    'value' => 'Y',
                                    'label' => 'Oui',
                                ],
                                [
                                    'value' => 'N',
                                    'label' => 'Non',
                                ],
                            ]" />
                        <x-form.text-area  name="description" label="description" />
                    @endBinding
                    <div class="col-12 mt-5">
                        <x-form.button />
                    </div>
                </x-form.card>
        </x-form.form>

@endsection
