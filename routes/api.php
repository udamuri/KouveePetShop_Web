<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CRUDS Produk
Route::get('produk', 'ProdukController@index'); //Bisa
Route::get('produk/{id_produk}/gambar', 'ProdukController@tampilImage'); //Bisa
Route::get('produk/softDelete', 'ProdukController@tampilSoftDelete'); //Bisa
Route::get('produk/{cari}', 'ProdukController@searchProduk');
//
Route::post('produk/login', 'ProdukController@login');
Route::post('produk', 'ProdukController@create'); //Bisa
Route::post('produk/{id_produk}/restore', 'ProdukController@restore'); //Bisa
Route::post('produk/update/{id_produk}', 'ProdukController@update'); //Bisa
//
Route::delete('produk/{id_produk}','ProdukController@delete'); //Bisa -> Di Model updateby dijadikan NULL
Route::delete('produk/{id_produk}/permanen','ProdukController@deletePermanen'); //

//CRUDS Layanan
Route::get('layanan', 'LayananController@index'); // Bisa
Route::get('layanan/softDelete', 'LayananController@tampilSoftDelete'); // Bisa
Route::get('layanan/{cari}', 'LayananController@searchLayanan');
//
Route::post('layanan', 'LayananController@create'); // Bisa
Route::post('layanan/{id_layanan}/restore', 'LayananController@restore'); // Bisa
Route::post('layanan/update/{id_layanan}', 'LayananController@update'); //Bisa
//
Route::delete('layanan/{id_layanan}','LayananController@delete'); //Bisa
Route::delete('layanan/{id_layanan}/permanen','ProdukController@LayananController'); //Bisa

//CRUDS Pegawai
Route::get('pegawai', 'PegawaiController@index'); //Bisa
Route::get('pegawai/{NIP}/gambar', 'PegawaiController@tampilImage'); //Bisa
Route::get('pegawai/softDelete', 'PegawaiController@tampilSoftDelete'); //Bisa
Route::get('pegawai/{cari}', 'PegawaiController@searchPegawai');
// Route::get('/pegawai/{NIP}', 'PegawaiController@getbyid');
//
Route::post('pegawai/login', 'PegawaiController@login');
Route::post('pegawai', 'PegawaiController@create'); //Bisa
Route::post('pegawai/{NIP}/restore', 'PegawaiController@restore'); //Bisa
Route::post('pegawai/update/{NIP}', 'PegawaiController@update'); //Bisa
//
Route::delete('pegawai/{NIP}','PegawaiController@delete'); //Bisa
Route::delete('pegawai/{NIP}/permanen','PegawaiController@deletePermanen'); //Bisa

//CRUDS Ukuran Hewan
Route::get('ukuranHewan', 'UkuranHewanController@index'); // Bisa
Route::get('ukuranHewan/softDelete', 'UkuranHewanController@tampilSoftDelete'); // Bisa
Route::get('ukuranHewan/{cari}', 'UkuranHewanController@searchUkuran');
//
Route::post('ukuranHewan', 'UkuranHewanController@create'); // Bisa
Route::post('ukuranHewan/{id_ukuranHewan}/restore', 'UkuranHewanController@restore'); // Bisa
Route::post('ukuranHewan/update/{id_ukuranHewan}', 'UkuranHewanController@update'); // Bisa
//
Route::delete('ukuranHewan/{id_ukuranHewan}','UkuranHewanController@delete'); // Bisa
Route::delete('ukuranHewan/{id_ukuranHewan}/permanen','UkuranHewanController@deletePermanen'); // Bisa

//CRUDS Jenis Hewan
Route::get('jenisHewan', 'JenisHewanController@index'); // Bisa
Route::get('jenisHewan/softDelete', 'JenisHewanController@tampilSoftDelete'); // Bisa
Route::get('jenisHewan/{cari}', 'JenisHewanController@searchJenis'); //
//
Route::post('jenisHewan', 'JenisHewanController@create'); // Bisa
Route::post('jenisHewan/{id_ukuranHewan}/restore', 'JenisHewanController@restore'); // Bisa
Route::post('jenisHewan/update/{id_ukuranHewan}', 'JenisHewanController@update'); // Bisa
//
Route::delete('jenisHewan/{id_ukuranHewan}','JenisHewanController@delete'); // Bisa
Route::delete('jenisHewan/{id_ukuranHewan}/permanen','JenisHewanController@deletePermanen'); // Bisa

//CRUDS Customer
Route::get('customer', 'CustomerController@index'); //Bisa
Route::get('customer/softDelete', 'CustomerController@tampilSoftDelete'); //Bisa
Route::get('customer/{cari}', 'CustomerController@searchCustomer'); //Bisa
//
Route::post('customer', 'CustomerController@create'); //Bisa
Route::post('customer/{id_customer}/restore', 'CustomerController@restore'); //Bisa
Route::post('customer/update/{id_customer}', 'CustomerController@update'); //Bisa
//
Route::delete('customer/{id_customer}','CustomerController@delete'); //Bisa
Route::delete('customer/{id_customer}/permanen','CustomerController@deletePermanen'); //Bisa

//CRUDS Supplier
Route::get('supplier', 'SupplierController@index'); //Bisa
Route::get('supplier/softDelete', 'SupplierController@tampilSoftDelete'); //Bisa
Route::get('supplier/{cari}', 'SupplierController@searchSupplier'); //Bisa
//
Route::post('supplier', 'SupplierController@create'); //Bisa
Route::post('supplier/{id_supplier}/restore', 'SupplierController@restore'); //Bisa
Route::post('supplier/update/{id_supplier}', 'SupplierController@update'); //Bisa
//
Route::delete('supplier/{id_supplier}','SupplierController@delete'); //Bisa
Route::delete('supplier/{id_supplier}/permanen','SupplierController@deletePermanen'); //

//CRUDS Hewan
Route::get('hewan', 'HewanController@index'); //Bisa
Route::get('hewan/softDelete', 'HewanController@tampilSoftDelete'); //Bisa
Route::get('hewan/{cari}', 'HewanController@searchHewan'); //Bisa
//
Route::post('hewan', 'HewanController@create'); //Bisa
Route::post('hewan/{id_supplier}/restore', 'HewanController@restore'); //Bisa
Route::post('hewan/update/{id_supplier}', 'HewanController@update'); //Bisa
//
Route::delete('hewan/{id_supplier}','HewanController@delete'); //Bisa
Route::delete('hewan/{id_supplier}/permanen','HewanController@deletePermanen'); //

//CRUDS Transaksi Pengadaan
Route::get('transaksiPengadaan', 'TransaksiPengadaanController@index'); //
Route::get('transaksiPengadaan/{cari}', 'TransaksiPengadaanController@searchHewan'); //
//
Route::post('transaksiPengadaan', 'TransaksiPengadaanController@create'); //
Route::post('transaksiPengadaan/update/{no_order}', 'TransaksiPengadaanController@update'); //
//
Route::delete('transaksiPengadaan/{no_order}','TransaksiPengadaanController@delete'); //