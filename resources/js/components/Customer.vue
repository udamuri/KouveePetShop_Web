<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Customer</h4>
            <router-link to="/">| Pegawai | </router-link>
            <router-link to="/customer">Customer | </router-link>
            <router-link to="/produk">Produk | </router-link>
            <router-link to="/layanan">Layanan | </router-link>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/customertambah">+ Tambah</router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="customer in customers" :key="customer.id_customer">
              <td style="width:10%">{{customer.id_customer}}</td>
              <td style="width:10%">{{customer.nama_customer}}</td>
              <td style="width:10%">{{customer.alamat_customer}}</td>
              <td style="width:10%">{{customer.tglLahir_customer}}</td>
              <td style="width:10%">{{produk.noTelp_customer}}</td>
              <td style="width:10%">
                <router-link class="btn btn-warning" :to="'/customerupdate/'+customer.id_customer">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(customer.id_customer)">Delete</button>
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
      customers: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/customer").then(response => {
        // mengirim data hasil fetch ke varibale array persons
        this.customers = response.data;
      });
    },
    deleteData(id_customer) {
      // delete data
      axios.delete("http://localhost:8000/api/customer/" + id_customer).then(response => {
        this.loadData();
      });
    }
  }
};
</script>