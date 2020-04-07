<?php

namespace App\Http\Controllers;

use App\JenisHewan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisHewanController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $jenisHewan = JenisHewan::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $jenisHewan
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $jenisHewan = JenisHewan::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $jenisHewan
        ];
        return response()->json($response, 200);
    }

    public function searchJenis($cari)
    {
        $jenisHewan = JenisHewan::where('id_jenisHewan','like','%'.$cari.'%')
        ->orWhere('nama_jenisHewan','like','%'.$cari.'%')
        ->where('deleteLog_at', null)->get();

        if(sizeof($jenisHewan)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Jenis Hewan Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $jenisHewan
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(Request $request)
    {
        $jenisHewan = new JenisHewan;
        $jenisHewan->nama_jenisHewan = $request['nama_jenisHewan'];
        $jenisHewan->createLog_at = Carbon::now();
        $jenisHewan->updateLog_by = $request['updateLog_by'];

        try{
            $success = $jenisHewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $jenisHewan,
                'Message' => 'Data Jenis Hewan Berhasil Diinputkan'
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

    public function update(Request $request, $id_jenisHewan)
    {
        $jenisHewan = JenisHewan::find($id_jenisHewan);

        if($jenisHewan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Jenis Hewan Tidak Ditemukan'
            ];
        }else{
            $jenisHewan->nama_jenisHewan = $request['nama_jenisHewan'];
            $jenisHewan->updateLog_at = Carbon::now();
            $jenisHewan->updateLog_by = $request['updateLog_by'];

            try{
                $success = $jenisHewan->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $jenisHewan,
                    'Message' => 'Data Jenis Hewan Berhasil di Update'
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
    public function delete(Request $request, $id_jenisHewan)
    {
        $jenisHewan = JenisHewan::find($id_jenisHewan);

        if($jenisHewan==NULL || $jenisHewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Jenis Hewan Tidak Ditemukan',
            ];
        }else{
            $jenisHewan->deleteLog_at = Carbon::now();
            $jenisHewan->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $jenisHewan,
                'Message' => 'Data Jenis Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_jenisHewan)
    {
        $jenisHewan = JenisHewan::find($id_jenisHewan);

        if($jenisHewan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Jenis Hewan Tidak Ditemukan',
            ];
        }else{
            $jenisHewan->updateLog_at = Carbon::now();
            $jenisHewan->deleteLog_at = NULL;
            $jenisHewan->updateLog_by = $request['updateLog_by'];

            $jenisHewan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $jenisHewan,
                'Message' => 'Data Jenis Hewan Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_jenisHewan)
    {
        $jenisHewan = JenisHewan::find($id_jenisHewan);

        if($jenisHewan==NULL || $jenisHewan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Jenis Hewan Tidak Ditemukan',
            ];
        }else{
            $jenisHewan->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $jenisHewan,
                'Message' => 'Data Jenis Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }
}
