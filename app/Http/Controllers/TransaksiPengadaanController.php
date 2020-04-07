<?php

namespace App\Http\Controllers;

use App\TransaksiPengadaan;
use Illuminate\Http\Request;

class TransaksiPengadaanController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $transaksiPengadaan = TransaksiPengadaan::all();
        $response = [
            'status' => 'Success',
            'Hasil' => $transaksiPengadaan
        ];
        return response()->json($response, 200);
    }

    // public function tampilSoftDelete()
    // {
    //     $hewan = Hewan::all()->where('deleteLog_at', !null);
    //     $response = [
    //         'status' => 'Success',
    //         'Hasil' => $hewan
    //     ];
    //     return response()->json($response, 200);
    // }

    public function searchPengadaan($cari)
    {
        $transaksiPengadaan = TransaksiPengadaan::where('no_order','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($transaksiPengadaan)==0)
        {
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Transaksi Pengadaan Tidak Ditemukan'
            ];
        }else{
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $transaksiPengadaan
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $transaksiPengadaan = new TransaksiPengadaan;
        $transaksiPengadaan->no_order = $this->generateNoOrder();
        $transaksiPengadaan->tgl_pesan = Carbon::now();
        $transaksiPengadaan->tgl_Cetak = Carbon::now();
        $transaksiPengadaan->nama_stock = $request['nama_stock'];
        $transaksiPengadaan->satuan_stock = $request['satuan_stock'];
        $transaksiPengadaan->id_supplier = $request['id_supplier'];
        $transaksiPengadaan->createLog_at = Carbon::now();
        
        try{
            $success = $transaksiPengadaan->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => $transaksiPengadaan,
                'Message' => 'Data Pengadaan Berhasil Diinputkan'
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

    public function update(Request $request, $no_order)
    {
        $transaksiPengadaan = TransaksiPengadaan::find($no_order);

        if($transaksiPengadaan==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Transaksi Pengadaan Tidak Ditemukan'
            ];
        }else{
            $transaksiPengadaan->total_harga = $request['total_harga'];
            $transaksiPengadaan->id_supplier = $request['id_supplier'];
            $transaksiPengadaan->status = $request['status'];
            $transaksiPengadaan->updateLog_at = Carbon::now();

            try{
                $success = $transaksiPengadaan->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => $transaksiPengadaan,
                    'Message' => 'Data Transaksi Pengadaan Berhasil di Update'
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
    public function delete($no_order)
    {
        $transaksiPengadaan = TransaksiPengadaan::find($no_order);

        if($transaksiPengadaan==NULL || $transaksiPengadaan->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Transaksi Pengadaan Tidak Ditemukan',
            ];
        }else{
            $transaksiPengadaan->delete();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $transaksiPengadaan,
                'Message' => 'Data Hewan Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function generateNoOrder()
    {
        $transaksiPengadaan = TransaksiPengadaan::whereDate('created_at', date('Y-m-d'))
        ->orderBy('createLog_at', 'desc')->first();

        if (isset($transaksiPengadaan)) 
        {
            $noAkhir=substr($transaksiPengadaan->no_order, 14);
            if($noAkhir<9)
                return 'NO-' . date('Y-m-d') . '-0' . ($noAkhir + 1);
            else    
                return 'NO-' . date('Y-m-d') . '-' . ($noAkhir + 1);
        } 
        else 
        {
            return 'NO-' . date('Y-m-d') . '-01';
        }        
    }
}
