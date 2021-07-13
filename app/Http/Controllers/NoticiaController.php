<?php

namespace App\Http\Controllers;

use App\Noticia;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
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
        $data['slug'] = Str::slug($data['titulo'], '-');
        $data['user_id'] = Auth::id();

        //$imagen = 'https://intranet1.s3-sa-east-1.amazonaws.com/config/user.png';
        if ($request->hasFile('imagen')) {
            //$img = Image::make($data['image'])->resize(300, 200);
            $imagen = Storage::disk('s3')->put('noticias', $data['imagen']);
            $data['imagen'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $imagen;
            
        }

        $noticia = Noticia::create($data);

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('noticias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $noticia = Noticia::where('slug', $slug)->first();
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {
           
            if(isset($data['imagen']) && ($data['imagen'] != null)) {                
                Storage::disk('s3')->delete('noticias/' . $noticia->imagen);
                $imagen = Storage::disk('s3')->put('noticias', $data['imagen']);
                $url_imagen = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $imagen;
                $data['imagen'] = $url_imagen;
            }
            
            $data['slug'] = Str::slug($data['titulo'], '-');
            $data['user_id'] = Auth::id();
            
            $noticia->fill($data);
            $noticia->save();

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
        
        return redirect()->route('noticias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        try {

            $noticia->delete();
        } catch (Exception $noticia) {
            alert()->error('Error', $noticia->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('noticias.index');
    }
}
