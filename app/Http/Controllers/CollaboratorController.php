<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCollaboratorJob;
use App\Models\Collaborator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collaborator.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $collaborators = Collaborator::with('unit')->get();
        return view('collaborator.show',['collaborators'=>$collaborators]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collaborator = Collaborator::with('unit')->where('id', '=', $id)->first();
        return view('collaborator.edit',['collaborator'=>$collaborator]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $collaborator = Collaborator::find($id);
            if (!$collaborator){
                return redirect()->back()->withErrors('Colaborador não encontrada.')->withInput();
            }
            
            $collaborator->delete();
            session()->flash('global-success',true);
            session()->flash('message', 'Colaborador Excluido com sucesso!');
            
            DB::commit();
            return redirect()->route('collaborator.show');
        }catch(Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
    }

    public function export()
    {
        ExportCollaboratorJob::dispatch(Auth::user()->id);
        return response()->json(['message' => 'Exportação iniciada!'], 200);
    }
 
}