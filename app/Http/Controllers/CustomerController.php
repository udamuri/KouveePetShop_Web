<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $customer = Customer::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $customer
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $customer = Customer::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $customer
        ];
        return response()->json($response, 200);
    }

    public function searchCustomer($cari)
    {
        $customer = Customer::where('id_customer','like','%'.$cari.'%')
        ->orWhere('nama_customer','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($customer)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Customer Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $customer
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $customer = new Customer;
        $customer->nama_customer = $request['nama_customer'];
        $customer->alamat_customer = $request['alamat_customer'];
        $customer->tglLahir_customer = $request['tglLahir_customer'];
        $customer->noTelp_customer = $request['noTelp_customer'];
        $customer->updateLog_by = $request['updateLog_by'];
        $customer->createLog_at = Carbon::now();
        $customer->updateLog_at = Carbon::now();
        
        try{
            $success = $customer->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $customer,
                'Message' => 'Data Customer Berhasil Diinputkan'
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

    public function update(Request $request, $id_customer)
    {
        $customer = Customer::find($id_customer);

        if($customer==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Customer Tidak Ditemukan'
            ];
        }else{
            $customer->nama_customer = $request['nama_customer'];
            $customer->alamat_customer = $request['alamat_customer'];
            $customer->tglLahir_customer = $request['tglLahir_customer'];
            $customer->noTelp_customer = $request['noTelp_customer'];
            $customer->updateLog_at = Carbon::now();
            $customer->updateLog_by = $request['updateLog_by'];

            try{
                $success = $customer->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $customer,
                    'Message' => 'Data Customer Berhasil di Update'
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
    public function delete($id_customer)
    {
        $customer = Customer::find($id_customer);

        if($customer==NULL || $customer->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Customer Tidak Ditemukan',
            ];
        }else{
            $customer->deleteLog_at = Carbon::now();
            $customer->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $customer,
                'Message' => 'Data Customer Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_customer)
    {
        $customer = Customer::find($id_customer);

        if($customer == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Customer Tidak Ditemukan',
            ];
        }else{
            $customer->updateLog_at = Carbon::now();
            $customer->deleteLog_at = NULL;
            $customer->updateLog_by = $request['updateLog_by'];

            $customer->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $customer,
                'Message' => 'Data Customer Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_customer)
    {
        $customer = Customer::find($id_customer);

        if($customer==NULL || $customer->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Customer Tidak Ditemukan',
            ];
        }else{
            $customer->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $customer,
                'Message' => 'Data Customer Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }
}
