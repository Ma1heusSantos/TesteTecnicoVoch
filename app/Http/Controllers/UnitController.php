<?php

namespace App\Http\Controllers;

use App\Models\Flag;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitController extends Controller
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
        $flag = Flag::all();
        return view('unit.create',['flag'=>$flag]);
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
        $units = Unit::with('flag')->get();
        return view('unit.show',['units'=>$units]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::with('flag')->where('id', '=', $id)->first();
        return view('unit.edit',['unit'=>$unit]);
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
            $unit = Unit::find($id);
            if (!$unit){
                return redirect()->back()->withErrors('Bandeira não encontrada.')->withInput();
            }
            
            $unit->delete();
            DB::commit();
            session()->flash('global-success',true);
            session()->flash('message', 'Unidade excluido com sucesso!');
            return redirect()->route('unit.show');
        }catch(Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            session()->flash('global-error',true);
        }
    }
    public function collaboratorForUnit(){
        $unidades = Unit::withCount('collaborators')->get();
        $data = $unidades->map(function ($unit) {
            return [
                'name' => $unit->nome_fantasia,
                'y' => $unit->collaborators_count, 
            ];
        });

        return response()->json($data);
    }
   
}