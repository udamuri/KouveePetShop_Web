<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use finfo;

class ProdukController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $produk = Produk::all('id_produk', 'nama_produk', 'harga_produk', 'stok_produk', 'min_stok_produk', 'satuan_produk',
        'createLog_at', 'updateLog_at', 'deleteLog_at')->where('deleteLog_at', null);
        $response = [
            'status' => 'Success',
            'Hasil' => $produk
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $produk = Produk::all('id_produk', 'nama_produk', 'harga_produk', 'stok_produk', 'min_stok_produk', 'satuan_produk',
        'createLog_at', 'updateLog_at', 'deleteLog_at')->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $produk
        ];
        return response()->json($response, 200);
    }

    public function searchProduk($cari)
    {
        $produk = Produk::all('id_produk', 'nama_produk', 'harga_produk', 'stok_produk', 'min_stok_produk', 'satuan_produk',
        'createLog_at', 'updateLog_at', 'deleteLog_at')
        ->where('id_produk','like','%'.$cari.'%')
        ->orWhere('nama_produk','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($produk)==0)
        {
            $status=404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Produk Tidak Ditemukan'
            ];
        }else{
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $produk
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(request $request)
    {
        $produk = new Produk;
        $produk->id_produk = $this->generateIDProduk();
        $produk->nama_produk = $request['nama_produk'];
        $produk->harga_produk = $request['harga_produk'];
        $produk->stok_produk = $request['stok_produk'];
        $produk->min_stok_produk = $request['min_stok_produk'];
        $produk->satuan_produk = $request['satuan_produk'];
        $produk->gambar = $this->upload();
        $produk->updateLog_by = $request['updateLog_by'];
        $produk->createLog_at = Carbon::now();
        
        if($produk->gambar == 1)
        {
            $status = 500;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => "Gambar harus memiliki format jpg or png or gif"
            ];
        }else{
            try{
                $success = $produk->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => [
                        'id_produk' => $produk->getKey(),
                        'nama_produk' => $produk->nama_produk,
                        'harga_produk' => $produk->harga_produk,
                        'stok_produk' => $produk->stok_produk,
                        'min_stok_produk' => $produk->min_stok_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'createLog_at' => $produk->createLog_at,
                        'updateLog_at' => $produk->updateLog_at,
                    ],
                    'Message' => 'Data Produk Berhasil Diinputkan'
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
        }
        return response()->json($response, $status);
    }
    
    public function update(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);

        if($produk==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Produk Tidak Ditemukan'
            ];
        }else{
            $produk->nama_produk = $request['nama_produk'];
            $produk->harga_produk = $request['harga_produk'];
            $produk->stok_produk = $request['stok_produk'];
            $produk->min_stok_produk = $request['min_stok_produk'];
            $produk->satuan_produk = $request['satuan_produk'];
            $produk->updateLog_at = Carbon::now();
            $produk->updateLog_by = $request['updateLog_by'];

            if($_FILES['gambar']['error'] != 4){
                $produk->gambar = $this->upload();
            }

            try{
                $success = $produk->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => [
                        'id_produk' => $produk->getKey(),
                        'nama_produk' => $produk->nama_produk,
                        'harga_produk' => $produk->harga_produk,
                        'stok_produk' => $produk->stok_produk,
                        'min_stok_produk' => $produk->min_stok_produk,
                        'satuan_produk' => $produk->satuan_produk,
                        'createLog_at' => $produk->createLog_at,
                        'updateLog_at' => $produk->updateLog_at,
                        'deleteLog_at' => $produk->deleteLog_at,
                    ],
                    'Message' => 'Data Produk Berhasil di Update'
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
    public function delete(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);

        if($produk==NULL || $produk->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Produk Tidak Ditemukan',
            ];
        }else{
            $produk->deleteLog_at = Carbon::now();
            $produk->updateLog_by = $request['updateLog_by'];
            
            $produk->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'id_produk' => $produk->getKey(),
                    'nama_produk' => $produk->nama_produk,
                    'harga_produk' => $produk->harga_produk,
                    'stok_produk' => $produk->stok_produk,
                    'min_stok_produk' => $produk->min_stok_produk,
                    'satuan_produk' => $produk->satuan_produk,
                    'createLog_at' => $produk->createLog_at,
                    'updateLog_at' => $produk->updateLog_at,
                    'deleteLog_at' => $produk->deleteLog_at,
                ],
                'Message' => 'Data Produk Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);

        if($produk == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Produk Tidak Ditemukan',
            ];
        }else{
            $produk->updateLog_at = Carbon::now();
            $produk->deleteLog_at = NULL;
            $produk->updateLog_by = $request['updateLog_by'];

            $produk->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'id_produk' => $produk->getKey(),
                    'nama_produk' => $produk->nama_produk,
                    'harga_produk' => $produk->harga_produk,
                    'stok_produk' => $produk->stok_produk,
                    'min_stok_produk' => $produk->min_stok_produk,
                    'satuan_produk' => $produk->satuan_produk,
                    'createLog_at' => $produk->createLog_at,
                    'updateLog_at' => $produk->updateLog_at,
                    'deleteLog_at' => $produk->deleteLog_at,
                ],
                'Message' => 'Data Produk Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($id_produk)
    {
        $produk = Produk::find($id_produk);

        if($produk==NULL || $produk->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Produk Tidak Ditemukan',
            ];
        }else{
            $produk->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'id_produk' => $produk->getKey(),
                    'nama_produk' => $produk->nama_produk,
                    'harga_produk' => $produk->harga_produk,
                    'stok_produk' => $produk->stok_produk,
                    'min_stok_produk' => $produk->min_stok_produk,
                    'satuan_produk' => $produk->satuan_produk,
                    'createLog_at' => $produk->createLog_at,
                    'updateLog_at' => $produk->updateLog_at,
                    'deleteLog_at' => $produk->deleteLog_at,
                ],
                'Message' => 'Data Produk Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function tampilImage($id_produk)
    {
        $produk = Produk::find($id_produk);

        if($produk == NULL || $produk->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Produk Tidak Ditemukan',
            ];
            return response()->json($response, $status);
        }else{
            return response()->make($produk->gambar, 200, array(
                'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($produk->gambar)));
        }
    }

    function upload(){

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

         //mengecek file gambar atau bukan
        $ekstensiGambarValid = ['jpg','jpeg','png','gif'];
        $ekstensiGambar = explode('.',$namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            return 1;
        }
        
        $gambar=$this->scaleImageFileToBlob($tmpName);
    
        return $gambar;
    }

    function scaleImageFileToBlob($file) {

        $source_pic = $file;
        $max_width = 200;
        $max_height = 200;
    
        list($width, $height, $image_type) = getimagesize($file);
    
        switch ($image_type)
        {
            case 1: $src = imagecreatefromgif($file); break;
            case 2: $src = imagecreatefromjpeg($file);  break;
            case 3: $src = imagecreatefrompng($file); break;
            default: return '';  
            break;
        }
    
        $x_ratio = $max_width / $width;
        $y_ratio = $max_height / $height;
    
        if( ($width <= $max_width) && ($height <= $max_height) ){
            $tn_width = $width;
            $tn_height = $height;
            }elseif (($x_ratio * $height) < $max_height){
                $tn_height = ceil($x_ratio * $height);
                $tn_width = $max_width;
            }else{
                $tn_width = ceil($y_ratio * $width);
                $tn_height = $max_height;
        }
    
        $tmp = imagecreatetruecolor($tn_width,$tn_height);
    
        /* Check if this image is PNG or GIF, then set if Transparent*/
        if(($image_type == 1) OR ($image_type==3))
        {
            imagealphablending($tmp, false);
            imagesavealpha($tmp,true);
            $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
            imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
        }
        imagecopyresampled($tmp,$src,0,0,0,0,$tn_width, $tn_height,$width,$height);
    
        ob_start();
    
        switch ($image_type)
        {
            case 1: imagegif($tmp); break;
            case 2: imagejpeg($tmp, NULL, 100);  break; // best quality
            case 3: imagepng($tmp, NULL, 0); break; // no compression
            default: echo ''; break;
        }
    
        $final_image = ob_get_contents();
    
        ob_end_clean();
    
        return $final_image;
    }

    public function generateIDProduk()
    {
        $produk = Produk::orderBy('createLog_at', 'desc')->first();

        if (isset($produk))
        {
            $noUrut = substr($produk->id_produk, 4);
            if($noUrut<9)
                return 'PRDK'.'000'.((integer)$noUrut+1);
            else if($noUrut<99)
                return 'PRDK'.'00'.((integer)$noUrut+1);
            else if($noUrut<999)
                return 'PRDK'.'0'.((integer)$noUrut+1);
            else
                return 'PRDK'.((integer)$noUrut+1);
        }
        else
        {
            return 'PRDK0001';
        }
    }
}
