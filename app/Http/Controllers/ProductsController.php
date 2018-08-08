<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductsCollection;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Muestra una coleccion del recurso
        $products = Product::paginate(15);

        if ($request->wantsJson()) {
            return new ProductsCollection($products);
        }

        return view('products.index', ['products' => $products]);
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
        $hasFile = $request->hasFile('image_url') && $request->image_url->isValid();
        
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        // $options = [
        //     'id' => $request->id,
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'image_url' => $request->image_url,
        // ];

        if($hasFile){
            $extension = $request->image_url->extension();
            $product->extension = $extension;
        }
        
        if($product->save()){
            if($hasFile){
                $request->image_url->storeAs('images', "$product->id.$extension");
            }
            return redirect('/productos');
        }else{
            return view('products.create');
        }
        // if(Product::create($options)){
        //     if($hasFile){
        //         $request->image_url->storeAs('images',"$request->id.$extension");
        //     }
        //     return redirect('/productos');
        // }else{
        //     return view('products.create');
        // }
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
        $product = Product::find($id);

        return view('products.show', ['product' => $product ]);
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
        Product::destroy($id);
        return redirect('/productos');
    }
}
