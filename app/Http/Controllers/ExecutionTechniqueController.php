<?php

namespace App\Http\Controllers;

use App\Models\ChargeExecution;
use App\Models\CultureParcelle;
use App\Models\ExecutionTechnique;
use App\Models\ModesTechnique;
use App\Models\TechniqueAgricole;
use App\Models\TechniqueSpecifique;
use Illuminate\Http\Request;

class ExecutionTechniqueController extends Controller
{

    public function chargeTable(Request $request){
        $validator = validator($request->all(), [
            'culture' => 'required|exists:culture_parcelles,' . CultureParcelle::PK,
        ]);

        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }
        $data = ExecutionTechnique::query()
        ->leftJoin('culture_parcelles','culture_parcelles.id','execution_technique_spe.idculture')
        ->leftJoin('modes_technique','modes_technique.idM','execution_technique_spe.idModeTech')
        ->leftJoin('techniques_specifiques','techniques_specifiques.idTS','execution_technique_spe.idTechSpe')
        ->where('execution_technique_spe.idculture' , $validator->validated()['culture'])
        ->select('execution_technique_spe.*' , 'modes_technique.titre as idModeTech')
        ->addSelect('techniques_specifiques.titre as idTechSpe')
        ->get() ;
       

        return response()->json([
            'data' => $data ,
        ]);


    }
    public function getData(Request $request){

        $validator = validator($request->all(), [
            'id' => 'required|exists:techniques_agricole,' . TechniqueAgricole::PK,
        ]);

        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $techniqueSpecifique = TechniqueSpecifique::query()->where('idTechFK' ,$validator->validated()['id'] )->get() ;
        $modesTechnique = ModesTechnique::query()->where('idTechFK' ,$validator->validated()['id'] )->get() ;
       

        return response()->json([
            'techniqueSpecifique' => $techniqueSpecifique ,
            'modesTechnique' => $modesTechnique ,
        ]);

    }

    public function store(Request $request){

        $validator = validator($request->all(), [
           
            'techniquespecifique' => 'required|exists:techniques_specifiques,' . TechniqueSpecifique::PK,
            'modetechnique' => 'required|exists:modes_technique,' . ModesTechnique::PK,
            'culture' => 'nullable|exists:culture_parcelles,' . CultureParcelle::PK,
            'quantification' => 'required|numeric|max:999999' ,
            'date' => 'nullable',
            'observation' => 'nullable|string|max:500'

        ]);

        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }


        $data = ExecutionTechnique::create([
           'idculture' => $validator->validated()['culture'] ?? 1,
           'idModeTech' => $validator->validated()['modetechnique'] ?? null,
           'idTechSpe' => $validator->validated()['techniquespecifique'] ?? null,
           'quantification' => $validator->validated()['quantification'] ?? null,
           'date' => $validator->validated()['date'] ?? null,
           'observation' => $validator->validated()['observation'] ?? null,
        ]);



        return response()->json([
            'data' => $data ,
        ]);

    }

    public function delete(Request $request, $id)
    {
        ExecutionTechnique::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect()->back();
    }

    public function ajouteCharge(Request $request, $id)
    {
        $model =ExecutionTechnique::query()->findOrFail($id);
        $charges = ChargeExecution::query()->where('idExcuTech' ,$id )->get();
        return view('crud.chargeExecution.charge_execution' , compact('model' , 'charges'));
    }

    public function chargeExecStore(Request $request){

        $res = $request->validate([
           
            'observation' => 'nullable',
            'montant' => 'required|numeric',
        
        ]);

        $res['idExcuTech'] = $request['execId'] ;

        ChargeExecution::query()->create($res);

        $this->success(text: trans('messages.added_message'));
        return redirect()->back();

    }

    public function deleteCharge($id)
    {
        ChargeExecution::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect()->back();
    }





}
