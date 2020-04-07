<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use finfo;
// use DB;

class PegawaiController extends Controller
{
    //index (menampilkan semua, soft delete, sesuai ID, & cari)
    public function index()
    {
        $pegawai = Pegawai::all('NIP', 'nama_pegawai', 'alamat_pegawai', 'tglLahir_pegawai', 'noTelp_pegawai', 'stat',
        'password', 'createLog_at', 'updateLog_at', 'deleteLog_at')->where('deleteLog_at', null);
        $response = [
            'status' => 'Success',
            'Hasil' => $pegawai
        ];
        return response()->json($response, 200);
    }

    public function tampilSoftDelete()
    {
        $pegawai = Pegawai::all('NIP', 'nama_pegawai', 'alamat_pegawai', 'tglLahir_pegawai', 'noTelp_pegawai', 'stat',
        'password', 'createLog_at', 'updateLog_at', 'deleteLog_at')->where('deleteLog_at', !null);
        $response = [
            'status' => 'Success',
            'Hasil' => $pegawai
        ];
        return response()->json($response, 200);
    }

    // public function getbyid($id_pegawai)
    // {
    //     $pegawai = Pegawai::find($id_pegawai);
    //     if(is_null($pegawai)) {
    //         return response(['Message' => 'Not Found'], 404);
    //     }else{
    //         return $pegawai;
    //     }
    // }

    public function searchPegawai($cari)
    {
        $pegawai = Pegawai::all('NIP', 'nama_pegawai', 'alamat_pegawai', 'tglLahir_pegawai', 'noTelp_pegawai', 'stat',
        'password', 'createLog_at', 'updateLog_at', 'deleteLog_at')
        ->where('NIP','like','%'.$cari.'%')
        ->orWhere('nama_pegawai','like','%'.$cari.'%')
        ->where('deleteLog_at',null)->get();

        if(sizeof($pegawai)==0)
        {
            $status=404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan'
            ];
        }else{
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => $pegawai
            ];
        }
        return response()->json($response, $status);
    }

    //index (Menambah dan Edit data)
    public function create(Request $request)
    {
        $pegawai = new Pegawai;
        $pegawai->NIP = $this->generateNIP($request['stat']);
        $pegawai->nama_pegawai = $request['nama_pegawai'];
        $pegawai->alamat_pegawai = $request['alamat_pegawai'];
        $pegawai->tglLahir_pegawai = $request['tglLahir_pegawai'];
        $pegawai->noTelp_pegawai = $request['noTelp_pegawai'];
        $pegawai->stat = $request['stat'];
        // $pegawai->username = $request->username;
        $pegawai->password = md5($request['password']);
        $pegawai->gambar = $this->upload();
        // $pegawai->createLog_by = $request->createLog_by;
        $pegawai->updateLog_by = $request['updateLog_by'];
        // $pegawai->deleteLog_by = $request->deleteLog_by;
        $pegawai->createLog_at = Carbon::now();
        
        if($pegawai->gambar == 1)
        {
            $status = 500;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => "Gambar harus memiliki format jpg or png or gif"
            ];
        }else{
            try{
                $success = $pegawai->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => [
                        'NIP' => $pegawai->NIP,
                        'nama_pegawai' => $pegawai->nama_pegawai,
                        'alamat_pegawai' => $pegawai->alamat_pegawai,
                        'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                        'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                        'stat' => $pegawai->stat,
                        'password' => $pegawai->password,
                        'createLog_at' => $pegawai->createLog_at,
                        'updateLog_at' => $pegawai->updateLog_at,
                    ],
                    'Message' => 'Data Pegawai Berhasil Diinputkan'
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
    
    public function update(Request $request, $NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if($pegawai==NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan'
            ];
        }else{
            $pegawai->nama_pegawai = $request['nama_pegawai'];
            $pegawai->alamat_pegawai = $request['alamat_pegawai'];
            $pegawai->tglLahir_pegawai = $request['tglLahir_pegawai'];
            $pegawai->noTelp_pegawai = $request['noTelp_pegawai'];
            // $role_pegawai = $request->role_pegawai;
            // $username = $request->username;
            $pegawai->password = md5($request['password']);
            $pegawai->updateLog_at = Carbon::now();
            $pegawai->updateLog_by = $request['updateLog_by'];

            if($_FILES['gambar']['error'] != 4){
                $pegawai->gambar = $this->upload();
            }

            try{
                $success = $pegawai->save();
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => [
                        'NIP' => $pegawai->getKey(),
                        'nama_pegawai' => $pegawai->nama_pegawai,
                        'alamat_pegawai' => $pegawai->alamat_pegawai,
                        'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                        'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                        'stat' => $pegawai->stat,
                        'password' => $pegawai->password,
                        'createLog_at' => $pegawai->createLog_at,
                        'updateLog_at' => $pegawai->updateLog_at,
                    ],
                    'Message' => 'Data Pegawai Berhasil di Update'
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
    public function delete(Request $request, $NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if($pegawai==NULL || $pegawai->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan',
            ];
        }else{
            $pegawai->deleteLog_at = Carbon::now();
            $pegawai->save();
            $status=200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'NIP' => $pegawai->getKey(),
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'alamat_pegawai' => $pegawai->alamat_pegawai,
                    'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                    'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                    'stat' => $pegawai->stat,
                    'password' => $pegawai->password,
                    'createLog_at' => $pegawai->createLog_at,
                    'updateLog_at' => $pegawai->updateLog_at,
                ],
                'Message' => 'Data Pegawai Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function restore(Request $request, $NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if($pegawai == NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan',
            ];
        }else{
            $pegawai->updateLog_at = Carbon::now();
            $pegawai->deleteLog_at = NULL;
            $pegawai->updateLog_by = $request['updateLog_by'];

            $pegawai->save();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'NIP' => $pegawai->getKey(),
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'alamat_pegawai' => $pegawai->alamat_pegawai,
                    'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                    'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                    'stat' => $pegawai->stat,
                    'password' => $pegawai->password,
                    'createLog_at' => $pegawai->createLog_at,
                    'updateLog_at' => $pegawai->updateLog_at,
                ],
                'Message' => 'Data Pegawai Berhasil Dikembalikan'
            ];
        }
        return response()->json($response, $status);
    }

    public function deletePermanen($NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if($pegawai==NULL || $pegawai->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'message' => 'Data Pegawai Tidak Ditemukan',
            ];
        }else{
            $pegawai->delete();
            $status = 200;
            $response = [
                'status' => 'Success',
                'Hasil' => [
                    'NIP' => $pegawai->getKey(),
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'alamat_pegawai' => $pegawai->alamat_pegawai,
                    'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                    'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                    'stat' => $pegawai->stat,
                    'password' => $pegawai->password,
                    'createLog_at' => $pegawai->createLog_at,
                    'updateLog_at' => $pegawai->updateLog_at,
                ],
                'Message' => 'Data Pegawai Berhasil Dihapus'
            ];
        }
        return response()->json($response, $status);
    }

    public function login(Request $request)
    {
        $pegawai = Pegawai::find($request['NIP']);

        if(isset($pegawai))
        {
            if($pegawai->password == md5($request->password))
            {
                $status = 200;
                $response = [
                    'status' => 'Success',
                    'Hasil' => [
                        'NIP' => $pegawai->getKey(),
                        'nama_pegawai' => $pegawai->nama_pegawai,
                        'alamat_pegawai' => $pegawai->alamat_pegawai,
                        'tglLahir_pegawai' => $pegawai->tglLahir_pegawai,
                        'noTelp_pegawai' => $pegawai->noTelp_pegawai,
                        'stat' => $pegawai->stat,
                        'password' => $pegawai->password,
                        'createLog_at' => $pegawai->createLog_at,
                        'updateLog_at' => $pegawai->updateLog_at,
                    ],
                    'Message' => 'Anda Berhasil LogIn'
                ];
            }else{
                $status = 500;
                $response = [
                    'status' => 'Data Error',
                    'Hasil' => [],
                    'Message' => 'Password Anda Salah',
                ];
            }
        }else{
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan'
            ];
        }
        return response()->json($response, $status);
    }

    public function tampilImage($NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if($pegawai == NULL || $pegawai->deleteLog_at != NULL){
            $status = 404;
            $response = [
                'status' => 'Data Error',
                'Hasil' => [],
                'Message' => 'Data Pegawai Tidak Ditemukan',
            ];
            return response()->json($response, $status);
        }else{
            return response()->make($pegawai->gambar, 200, array(
                'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($pegawai->gambar)));
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

    public function generateNIP($stat)
    {
        $pegawai = Pegawai::where('stat',$stat)
        ->orderBy('createLog_at', 'desc')->first();

        if($stat=="Customer Service")
        {
            if(isset($pegawai))
            {
                $no = substr($pegawai->NIP, 2);

                if($no<9)
                {
                    return 'CS'.'00'.($no+1);
                } 
                else if($no<99)
                {
                    return 'CS'.'0'.($no+1);
                }
                else
                {
                    return 'CS'.($no+1);
                }
            }
            else
            {
                return 'CS001';
            }
        }
        else
        {
            if(isset($pegawai))
            {
                $no = substr($pegawai->NIP, 1);

                if($no<9){
                    return 'K'.'00'.($no+1);
                } 
                else if($no<99){
                    return 'K'.'0'.($no+1);
                }
                else
                {
                    return 'K'.($no+1);
                }
            }
            else
            {
                return 'K001';
            }
        }
    }
}
