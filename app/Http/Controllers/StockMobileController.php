<?php

namespace App\Http\Controllers;

use Redirect;
use DataTables;
use Log;
use App\stock_mobile;
use Illuminate\Http\Request;



class StockMobileController extends Controller
{
    public function getItemById($id)
    {
        return stock_mobile::find($id);
    }

    public function showAllProductsItems()
    {
        return stock_mobile::all();
    }
    public function ShowProductsTable(){
        return view('products_display');
    }
    public function showAllProducts()
    {
        $data=stock_mobile::all();
        return Datatables::of($data)
            ->addColumn('edit', function ($e) {
                return '<button class="btn btn-xs btn-primary" id="edit"><i class="glyphicon glyphicon-edit"></i>Edit</button></a>';
            })
            ->addColumn('delete', function ($e) {
                return '<button class="btn btn-xs btn-primary" id="delete"><i class="glyphicon glyphicon-trash"></i> Delete</button></a>';
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
    }
    public function destroy($id)
    {
        stock_mobile::where('id', $id)->delete();

        return "success";
    }
    public function edithProducts($id)
    {
        $data = stock_mobile::find($id);
        return view('edit')->with('d', $data);
    }
    public function updateProducts(Request $request,$id)
    {
//        Log::info($request);
        $data=$this->getItemById($id);
        $data->store_owner = $request->store_owner;
        $data->product = $request->product;
        $data->quantity_available = $request->quantity_available;
        $data->sold = $request->sold;
        $data->date = $request->date;
        $data->clear_status = $request->clear_status;
        $data->save();
        return $data;
    }
}
