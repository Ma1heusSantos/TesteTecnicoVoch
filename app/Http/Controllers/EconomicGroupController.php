<?php

namespace App\Http\Controllers;

use App\Models\EconomicGroup;
use App\Models\Flag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EconomicGroupController extends Controller
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
        return view('economicGroup.create');
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
        $economicGroup = EconomicGroup::all();
        return view('economicGroup.show',['economicGroup'=>$economicGroup]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $economicGroup = EconomicGroup::find($id);
        return view('economicGroup.edit',['economicGroup'=>$economicGroup]);
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
            $economicGroup = EconomicGroup::find($id);

            if (!$economicGroup) {
                return redirect()->back()->withErrors('Grupo Econômico não encontrado.')->withInput();
            }
            $economicGroup->delete();
            DB::commit();
            session()->flash('global-success',true);
            session()->flash('message', 'Grupo Economico excluido com sucesso!');
            return redirect()->route('economicGroup.show');
        }catch(Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
    }
}