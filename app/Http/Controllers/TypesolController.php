<?php

namespace App\Http\Controllers;

use Crypt;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Helpers\Components\Action;
use Illuminate\Support\Facades\DB;
use App\Models\Typesol as ModelTarget;
use League\Flysystem\FilesystemException;
use App\Http\Requests\Typesols\Add as TypesolsAdd;


class TypesolController extends Controller
{
    /***
     * Page create
     */
    public function create(Request $request)
    {
        $fermeId = $request->get('id_ferme') ?? null;



        return view('crud.typesol.create', compact('fermeId'));
    }
    /***
     * Page edit
     */
    public function show(Request $request, $id)
    {
        $model = ModelTarget::query()->where(ModelTarget::PK, $id)->firstOrFail();
        
        return view('crud.typesol.edit', compact('model'));
    }
    /***
     * Delete multi records
     */
    //---------------------------------
    public function destroyGroup(Request $request)
    {
        $ids = $request['ids'] ?? [];
       foreach ($ids as $id) {
           $client = ModelTarget::query()->findOrFail($id);
           $client?->delete();
        }
        $this->success(text: trans('messages.deleted_message'));
        return response()->json(['success' => true]);
    }
    //----------------------------
    /***
     * Delete one record by id if exists
     */
    public function destroy(Request $request, $id)
    {
        ModelTarget::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect()->back(); 
    }
    /***
     * Add a new record
     */
    public function store(TypesolsAdd $request)
    {
        $validated = $request->validated();
        $model = ModelTarget::query()->create($validated);
     
        $this->success(text: trans('messages.added_message'));
        return redirect(Route('fermes.show', $model['ferme']));
    }
    /***
     * Update record if exists
     */
    public function update(TypesolsAdd $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);
        $validated=$request->validated();
        $model->update($validated);
        $this->success(text: trans('messages.updated_message'));
        return redirect(Route('fermes.show', $model['ferme']));
    }
}
