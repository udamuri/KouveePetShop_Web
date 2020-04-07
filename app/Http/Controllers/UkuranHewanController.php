<?php

namespace App\Http\Controllers;

use App\UkuranHewan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UkuranHewanController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $ukuranHewan = UkuranHewan::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $ukuranHewan
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $ukuranHewan = UkuranHewan::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $ukuranHewan
        ];
        return response()->json($response, 200);
    }

    public function searchUkuran($cari)
    {
        $ukuranHewan = UkuranHewan::where('id_ukuranHewan','like','%'.$cari.'%')
        ->orWhere('nama_ukuranHewan','like','%'.$cari.'%')
        ->where('deleteLog_at', null)->get();

        if(sizeof($ukuranHewan)==0)
        {
            $status=404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Ukuran Hewan Tidak Ditemukan'
            ];
        }else{
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $ukuranHewan
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(Request $request)
    {
        $ukuranHewan = new UkuranHewan;
        $ukuranHewan->nama_ukuranHewan = $request['nama_ukuranHewan'];
        $ukuranHewan->createLog_at = Carbon::now();
        $ukuranHewan->updateLog_by = $request['updateLog_by'];

        try{
            $success = $ukuranHewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $ukuranHewan,
                'Message' => 'Data Ukuran Hewan Berhasil Diinputkan'
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

    public function update(Request $request, $id_ukuranHewan)
    {
        $ukuranHewan = UkuranHewan::find($id_ukuranHewan);

        if($ukuranHewan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Ukuran Hewan Tidak Ditemukan'
            ];
        }else{
            $ukuranHewan->nama_ukuranHewan = $request['nama_ukuranHewan'];
            $ukuranHewan->updateLog_at = Carbon::now();
            $ukuranHewan->updateLog_by = $request['updateLog_by'];

            try{
                $success = $ukuranHewan->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $ukuranHewan,
                    'Message' => 'Data Ukuran Hewan Berhasil di Update'
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
    public function delete(Request $request, $id_ukuranHewan)
    {
        $ukuranHewan = UkuranHewan::find($id_ukuranHewan);

        if($ukuranHewan==NULL || $ukuranHewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Ukuran Hewan Tidak Ditemukan',
            ];
        }else{
            $ukuranHewan->deleteLog_at = Carbon::now();
            $ukuranHewan->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $ukuranHewan, //Takon Simbah
                'Message' => 'Data Ukuran Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_ukuranHewan)
    {
        $ukuranHewan = UkuranHewan::find($id_ukuranHewan);

        if($ukuranHewan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Ukuran Hewan Tidak Ditemukan',
            ];
        }else{
            $ukuranHewan->updateLog_at = Carbon::now();
            $ukuranHewan->deleteLog_at = NULL;
            $ukuranHewan->updateLog_by = $request['updateLog_by'];

            $ukuranHewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $ukuranHewan,
                'Message' => 'Data Ukuran Hewan Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_ukuranHewan)
    {
        $ukuranHewan = UkuranHewan::find($id_ukuranHewan);

        if($ukuranHewan==NULL || $ukuranHewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Ukuran Hewan Tidak Ditemukan',
            ];
        }else{
            $ukuranHewan->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $ukuranHewan,
                'Message' => 'Data Jenis Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }
}
