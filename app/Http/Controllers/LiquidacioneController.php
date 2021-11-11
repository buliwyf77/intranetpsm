<?php

namespace App\Http\Controllers;

use App\Liquidacione;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Alert;

class LiquidacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('archivo')) {
            //$img = Image::make($data['image'])->resize(300, 200);
            $archivo = Storage::disk('s3')->put('users-profiles/liquidaciones', $data['archivo']);
            $archivo = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $archivo;
        }

        $data['archivo'] = $archivo;
        
        try {

        $liquidacion = Liquidacione::create($data);

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        $user = User::find($data['user_id']);

        return redirect()->route('users.show', $user->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidacione  $liquidacione
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacione $liquidacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacione  $liquidacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquidacione $liquidacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacione  $liquidacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacione $liquidacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidacione  $liquidacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacione $liquidacione)
    {
        try {
            $user = User::find($liquidacione->user_id);
            $liquidacione->delete();
        } catch (Exception $liquidacione) {
            alert()->error('Error', $liquidacione->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('users.show', $user->slug);
    }
}
