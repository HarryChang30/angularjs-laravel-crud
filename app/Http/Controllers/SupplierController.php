<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Supplier;


class SupplierController extends Controller
{
    //
    public function index($id = null)
    {
        if($id == null){
           return Supplier::orderBy('id' , 'asc')->get();
        }else{
           return $this->show($id);
        }
    }

    public function show($id)
    {
        return Supplier::find($id);
    }

    public function store(Request $request)
    {
        $supplier = new Supplier;
        $supplier->supplierName = $request->input('supplierName');
        $supplier->supplierEmail = $request->input('supplierEmail');
        $supplier->supplierContact = $request->input('supplierContact');
        $supplier->supplierPosition = $request->input('supplierPosition');
        $supplier->save();

        return 'Supplier record successfully created with id'.$supplier->id;
    }

    public function update(Request $request , $id)
    {
        $supplier = Supplier::find($id);
        $supplier->supplierName = $request->input('supplierName');
        $supplier->supplierEmail = $request->input('supplierEmail');
        $supplier->supplierContact = $request->input('supplierContact');
        $supplier->supplierPosition = $request->input('supplierPosition');
        $supplier->save();

        return 'Supplier record successfully updated with id'.$supplier->id;
    }

    public function destroy($id)
    {
        $supplier = Supplier::destroy($id);
        return 'Supplier record successfully deleted';
    }
}
