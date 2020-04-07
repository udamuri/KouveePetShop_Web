<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Produk</h4>
            <router-link to="/">| Pegawai | </router-link>
            <router-link to="/customer">Customer | </router-link>
            <router-link to="/produk">Produk | </router-link>
            <router-link to="/layanan">Layanan | </router-link>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/produktambah">+ Tambah</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Produk</th>
              <th scope="col">Harga</th>
              <th scope="col">Stok</th>
              <th scope="col">Minimal Stok</th>
              <th scope="col">Satuan Produk</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="produk in produks" :key="produk.id_produk">
              <td style="width:10%">{{produk.id_produk}}</td>
              <td style="width:10%">{{produk.nama_produk}}</td>
              <td style="width:10%">{{produk.harga_produk}}</td>
              <td style="width:10%">{{produk.stok_produk}}</td>
              <td style="width:10%">{{produk.min_stok_produk}}</td>
              <td style="width:10%">{{produk.satuan_produk}}</td>
              <td style="width:10%">
                <router-link class="btn btn-warning" :to="'/produkupdate/'+produk.id_produk">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(produk.id_produk)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      produks: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/produk").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.produks = response.data;
      });
    },
    deleteData(id_produk) {
      // delete data
      axios.delete("http://localhost:8000/api/produk/" + id_produk).then(response => {
        this.loadData();
      });
    }
  }
};
</script>