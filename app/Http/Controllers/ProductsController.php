<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Muestra una coleccion del recurso
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Muestra un formulario para crear nuevos recursos (productos)
        $product = new Product;
        return view('products.create', ["product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Almacena en la BD nuevos recursos
        $options = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price
        ];

        if(Product::create($options)){
            return redirect('/');
        }else{
            return view('products.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Muestra un Producto
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Muestra un formulario para editar un producto en especifico
        $product = Product::find($id);
        return view("products.edit",["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Actualiza un producto en especifico
        $product = Product::find($id);

        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;

        if($product->save()){
            return redirect('/');
        }else{
            return view("products.edit",["product" => $product]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Elimina un recurso en especifico
    }
}
