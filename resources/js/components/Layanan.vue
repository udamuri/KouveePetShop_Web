<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Layanan</h4>
            <router-link to="/">| Pegawai | </router-link>
            <router-link to="/customer">Customer | </router-link>
            <router-link to="/produk">Produk | </router-link>
            <router-link to="/layanan">Layanan | </router-link>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/layanantambah">+ Tambah</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Layanan</th>
              <th scope="col">Harga</th>
              <th scope="col">ID Hewan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="layanan in layanans" :key="layanan.id_layanan">
              <td style="width:10%">{{layanan.id_layanan}}</td>
              <td style="width:10%">{{layanan.nama_layanan}}</td>
              <td style="width:10%">{{layanan.harga_layanan}}</td>
              <td style="width:10%">{{ }}</td>
              <td style="width:10%">
                <router-link class="btn btn-warning" :to="'/layananupdate/'+produk.id_produk">Update</router-link>
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
      layanans: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/layanan").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.layanans = response.data;
      });
    },
    deleteData(id_layanan) {
      // delete data
      axios.delete("http://localhost:8000/api/layanan/" + id_produk).then(response => {
        this.loadData();
      });
    }
  }
};
</script>