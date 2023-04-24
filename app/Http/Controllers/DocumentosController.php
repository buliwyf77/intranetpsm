<?php

namespace App\Http\Controllers;

use App\Documentos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Block\Element\Document;

class DocumentosController extends Controller
{




    /**
     * 
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $documentos = Documentos::where('visible', 1)->orWhere('user_id', Auth::user()->id)->get();
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();

        $data = $request->all();

        unset($data['_token']);

        if (isset($data['visible'])) {
            $data['visible'] = 1;
        } else {
            $data['visible'] = 0;
        }



        $user = Auth::user();

        $data['user_id'] = $user->id;

        if ($request->hasFile('url')) {
            $archivo = Storage::disk('s3')->put('documentos/' . Str::slug($user->name, '-'), $data['url']);
            // $data['url'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $archivo;
            $data['url'] = $archivo;
        }

        try {

            Documentos::create($data);
        } catch (\Exception $e) {

            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso', 'El registro se ha procesado de manera exitosa')->showConfirmButton();

        //return redirect()->route('contratos.index');

        return redirect()->route('documentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $documento = Documentos::find($request->id);
        $path = Storage::disk('s3')->url($documento->url);


        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($path));

        return readfile($path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Documentos $documentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documentos $documentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documentos $documento)
    {
        //

        $documento->delete();
        return redirect()->route('documentos.index');
    }
}
