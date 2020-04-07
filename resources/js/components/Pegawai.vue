<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Pegawai</h4>
            <router-link to="/">| Pegawai | </router-link>
            <router-link to="/customer">Customer | </router-link>
            <router-link to="/produk">Produk | </router-link>
            <router-link to="/layanan">Layanan | </router-link>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/pegawaitambah">+ Tambah</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="pegawai in pegawais" :key="pegawai.NIP">
              <td style="width:10%">{{pegawai.NIP}}</td>
              <td style="width:10%">{{pegawai.nama_pegawai}}</td>
              <td style="width:10%">{{pegawai.alamat_pegawai}}</td>
              <td style="width:10%">{{pegawai.tglLahir_pegawai}}</td>
              <td style="width:10%">{{pegawai.noTelp_pegawai}}</td>
              <td style="width:10%">{{pegawai.stat}}</td>
              <td style="width:10%">
                <router-link class="btn btn-warning" :to="'/detail/'+pegawai.NIP">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(pegawai.NIP)">Delete</button>
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
      pegawais: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/pegawai").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.pegawais = response.data;
      });
    },
    deleteData(NIP) {
      // delete data
      axios.delete("http://localhost:8000/api/pegawai/" + NIP).then(response => {
        this.loadData();
      });
    }
  }
};
</script>