<?php

namespace App\Http\Controllers;

use App\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LayananController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $layanan = Layanan::where('deleteLog_at', null)->get();
        $response = [
            'status' => 'Success',
            'Hasil' => $layanan
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $layanan = Layanan::all()->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $layanan
        ];
        return response()->json($response, 200);
    }

    public function searchLayanan($cari)
    {
        $layanan = Layanan::where('id_layanan','like','%'.$cari.'%')
        ->orWhere('nama_layanan','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($layanan)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Layanan Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $layanan
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $layanan = new Layanan;
        $layanan->id_layanan = $this->generateIDLayanan();
        $layanan->nama_layanan = $request['nama_layanan'];
        $layanan->harga_layanan = $request['harga_layanan'];
        // $layanan->jenis_layanan = $request['jenis_layanan'];
        $layanan->id_ukuranHewan = $request['id_ukuranHewan'];
        $layanan->updateLog_by = $request['updateLog_by'];
        $layanan->createLog_at = Carbon::now();
        
        try{
            $success = $layanan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $layanan,
                'Message' => 'Data Layanan Berhasil Diinputkan'
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

    public function update(Request $request, $id_layanan)
    {
        $layanan = Layanan::find($id_layanan);

        if($layanan==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Layanan Tidak Ditemukan'
            ];
        }else{
            $layanan->nama_layanan = $request['nama_layanan'];
            $layanan->harga_layanan = $request['harga_layanan'];
            // $layanan->jenis_layanan = $request['jenis_layanan'];
            $layanan->id_ukuranHewan = $request['id_ukuranHewan'];
            $layanan->updateLog_at = Carbon::now();
            $layanan->updateLog_by = $request['updateLog_by'];

            try{
                $success = $layanan->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $layanan,
                    'Message' => 'Data Layanan Berhasil di Update'
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
    public function delete($id_layanan)
    {
        $layanan = Layanan::find($id_layanan);

        if($layanan==NULL || $layanan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Layanan Tidak Ditemukan',
            ];
        }else{
            $layanan->deleteLog_at = Carbon::now();
            $layanan->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $layanan,
                'Message' => 'Data Layanan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_layanan)
    {
        $layanan = Layanan::find($id_layanan);

        if($layanan == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Layanan Tidak Ditemukan',
            ];
        }else{
            $layanan->updateLog_at = Carbon::now();
            $layanan->deleteLog_at = NULL;
            $layanan->updateLog_by = $request['updateLog_by'];

            $layanan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $layanan,
                'Message' => 'Data Layanan Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_layanan)
    {
        $layanan = Layanan::find($id_layanan);

        if($layanan==NULL || $layanan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Layanan Tidak Ditemukan',
            ];
        }else{
            $layanan->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $layanan,
                'Message' => 'Data Layanan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function generateIDLayanan()
    {
        $layanan = Layanan::orderBy('createLog_at', 'desc')->first();

        if (isset($layanan))
        {
            $noUrut = substr($layanan->id_layanan, 4);
            if($noUrut<9)
                return 'LYNN'.'00'.((integer)$noUrut+1);
            else if($noUrut<99)
                return 'LYNN'.'0'.((integer)$noUrut+1);
            else
                return 'LYNN'.((integer)$noUrut+1);
        }
        else
        {
            return 'LYNN001';
        }
    }
}
