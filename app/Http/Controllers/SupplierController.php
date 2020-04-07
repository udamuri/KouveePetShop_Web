<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $supplier = Supplier::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $supplier
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $supplier = Supplier::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $supplier
        ];
        return response()->json($response, 200);
    }

    public function searchSupplier($cari)
    {
        $supplier = Supplier::where('id_supplier','like','%'.$cari.'%')
        ->orWhere('nama_supplier','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($supplier)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Supplier Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $supplier
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $supplier = new Supplier;
        $supplier->nama_supplier = $request['nama_supplier'];
        $supplier->alamat_supplier = $request['alamat_supplier'];
        $supplier->telepon_supplier = $request['telepon_supplier'];
        $supplier->stok_supplier = $request['stok_supplier'];
        $supplier->updateLog_by = $request['updateLog_by'];
        $supplier->createLog_at = Carbon::now();
        
        try{
            $success = $supplier->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $supplier,
                'Message' => 'Data Supplier Berhasil Diinputkan'
            ];
        }
        catch(\Illuminate\Database\QueryException $ex) {
            $status = 500;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => $ex
            ];
        }
        return response()->json($response, $status);
    }

    public function update(Request $request, $id_supplier)
    {
        $supplier = Supplier::find($id_supplier);

        if($supplier==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Supplier Tidak Ditemukan'
            ];
        }else{
            $supplier->nama_supplier = $request['nama_supplier'];
            $supplier->alamat_supplier = $request['alamat_supplier'];
            $supplier->telepon_supplier = $request['telepon_supplier'];
            $supplier->stok_supplier = $request['stok_supplier'];
            $supplier->updateLog_at = Carbon::now();
            $supplier->updateLog_by = $request['updateLog_by'];

            try{
                $success = $supplier->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $supplier,
                    'Message' => 'Data Supplier Berhasil di Update'
                ];  
            }
            catch(\Illuminate\Database\QueryException $ex){
                $status = 500;
                $response = [
                    'status' => 'Data Error',
                    'result' => [],
                    'message' => $ex,
                ];
            }
        }
        return response()->json($response, $status);
    }

    //index (Delete, Restore & delete permanen data)
    public function delete($id_supplier)
    {
        $supplier = Supplier::find($id_supplier);

        if($supplier==NULL || $supplier->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Supplier Tidak Ditemukan',
            ];
        }else{
            $supplier->deleteLog_at = Carbon::now();
            $supplier->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $supplier,
                'Message' => 'Data Supplier Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_supplier)
    {
        $supplier = Supplier::find($id_supplier);

        if($supplier == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Supplier Tidak Ditemukan',
            ];
        }else{
            $supplier->updateLog_at = Carbon::now();
            $supplier->deleteLog_at = NULL;
            $supplier->updateLog_by = $request['updateLog_by'];

            $supplier->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $supplier,
                'Message' => 'Data Supplier Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_supplier)
    {
        $supplier = Supplier::find($id_supplier);

        if($supplier==NULL || $supplier->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Supplier Tidak Ditemukan',
            ];
        }else{
            $supplier->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $supplier,
                'Message' => 'Data Supplier Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }
}
