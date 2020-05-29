<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $response = Http::get('http://localhost:8080/api/products/');
            $result = $response->json();
            return Datatables::of($result)
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $view = '<a href="'.route('product.view',$row['id']).'" title="View"><span style="font-size: 1em; color: Mediumslateblue;"><i class="fas fa-eye"></i></span></a>';
                    $edit = '<a href="'.route('product.edit',$row['id']).'" title="Edit"><span style="font-size: 1em; color: Dodgerblue;"><i class="fas fa-edit"></i></span></a>';
                    $delete = '<a href="'.route('product.delete',$row['id']).'" title="Delete"><span style="font-size: 1em; color: Tomato;"><i class="fas fa-trash"></i></span></a>';
                    $action = $view.'&nbsp;&nbsp;'.$edit.'&nbsp;&nbsp;'.$delete;
                    return $action;
                })
                ->editColumn('product_price', function ($row) {
                    return number_format($row['product_price'], 0);
                })                
                ->make(true);
        }
        return view('product.list',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'  => 'required',
            'product_price' => 'required'
        ]);
        $client = new \GuzzleHttp\Client();
        $data['product_name']     = $request->post('product_name');
        $data['product_price']    = $request->post('product_price');
        $response = $client->post('http://localhost:8080/api/products/', 
                [ 'form_params' => $data ]
            );
        $result = $response->getBody()->getContents();
//      dd($result);
        return redirect('/products-list')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get('http://localhost:8080/api/products/'.$id);
        $result = $response->json();
//        dd($result);
        return $result;
    }

    public function view($id)
    {
        $data = $this->show($id);
//        dd($data);
        return view('product.view', compact('data')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->show($id);
        return view('product.edit', compact('data')); 
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
        $request->validate([
            'product_name'  => 'required',
            'product_price' => 'required'
        ]);
        $client = new \GuzzleHttp\Client();
        $data = $this->show($id);
        $data['product_name']     = $request->post('product_name');
        $data['product_price']    = $request->post('product_price');
        $response = $client->put('http://localhost:8080/api/product/'.$id, 
                [ 'form_params' => $data ]
            );
        $result = $response->getBody()->getContents();
//      dd($result);
        return redirect('/products-list')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $data = $this->show($id);
        return view('product.delete', compact('data')); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete('http://localhost:8080/api/product/'.$id);
        $result = $response->json();
//        dd($data);
        return redirect('/products-list')->with('success', $result['message']);    
    }
}
