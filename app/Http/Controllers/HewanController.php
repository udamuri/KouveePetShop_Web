<?php

namespace App\Http\Controllers;

use App\Hewan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HewanController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $hewan = Hewan::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $hewan
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $hewan = Hewan::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $hewan
        ];
        return response()->json($response, 200);
    }

    public function searchHewan($cari)
    {
        $hewan = Hewan::where('id_hewan','like','%'.$cari.'%')
        ->orWhere('nama_hewan','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($hewan)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Hewan Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $hewan
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $hewan = new Hewan;
        $hewan->nama_hewan = $request['nama_hewan'];
        $hewan->tglLahir_hewan = $request['tglLahir_hewan'];
        $hewan->id_customer = $request['id_customer'];
        $hewan->id_jenisHewan = $request['id_jenisHewan'];
        $hewan->updateLog_by = $request['updateLog_by'];
        $hewan->createLog_at = Carbon::now();
        
        try{
            $success = $hewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $hewan,
                'Message' => 'Data Hewan Berhasil Diinputkan'
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

    public function update(Request $request, $id_hewan)
    {
        $hewan = Hewan::find($id_hewan);

        if($hewan==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Hewan Tidak Ditemukan'
            ];
        }else{
            $hewan->nama_hewan = $request['nama_hewan'];
            $hewan->tglLahir_hewan = $request['tglLahir_hewan'];
            $hewan->id_customer = $request['id_customer'];
            $hewan->id_jenisHewan = $request['id_jenisHewan'];
            $hewan->updateLog_at = Carbon::now();
            $hewan->updateLog_by = $request['updateLog_by'];

            try{
                $success = $hewan->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $hewan,
                    'Message' => 'Data Hewan Berhasil di Update'
                ];  
            }
            catch(\Illuminate\Database\QueryException $ex){
                $status = 500;
                $response = [
                    'status' => 'Data Error',
                    'Hasil' => [],
                    'message' => $ex,
                ];
            }
        }
        return response()->json($response, $status);
    }

    //index (Delete, Restore & delete permanen data)
    public function delete($id_hewan)
    {
        $hewan = Hewan::find($id_hewan);

        if($hewan==NULL || $hewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Hewan Tidak Ditemukan',
            ];
        }else{
            $hewan->deleteLog_at = Carbon::now();
            $hewan->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $hewan,
                'Message' => 'Data Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_hewan)
    {
        $hewan = Hewan::find($id_hewan);

        if($hewan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Hewan Tidak Ditemukan',
            ];
        }else{
            $hewan->updateLog_at = Carbon::now();
            $hewan->deleteLog_at = NULL;
            $hewan->updateLog_by = $request['updateLog_by'];

            $hewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $hewan,
                'Message' => 'Data Hewan Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_hewan)
    {
        $hewan = Hewan::find($id_hewan);

        if($hewan==NULL || $hewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Hewan Tidak Ditemukan',
            ];
        }else{
            $hewan->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $hewan,
                'Message' => 'Data Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }
}
