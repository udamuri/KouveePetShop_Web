<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Update Produk</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>ID</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan ID"
              v-model="form.id_layanan"
              required
            >
          </div>
          <div class="form-group">
            <label>Nama Layanan</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Nama Layanan"
              v-model="form.nama_layanan"
              required
            >
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Harga"
              v-model="form.harga_layanan"
              required
            >
          </div>
          <button class="btn btn-primary" v-on:click="updateData()" to="/layanan">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        id_layanan:'',
        nama_layanan: '',
        harga_layanan: ''
      }
    };
  },
  created() {
    // load data saat pertama kali halaman dibuka
    this.loadData();
  },
  methods: {
    loadData() {
      // load data berdasarkan id
      axios
        .get("http://localhost:8000/api/layanan/" + this.$route.params.id_layanan)
        .then(response => {
          // post value yang dari response ke form
          this.form.id_layanan = response.data.id_layanan;
          this.form.nama_layanan = response.data.nama_layanan;
          this.form.harga_layanan = response.data.harga_layanan;
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put("http://localhost:8000/api/layanan/" + this.$route.params.id_layanan, {
          id_layanan: this.form.id_layanan,
          nama_layanan: this.form.nama_layanan,
          harga_layanan: this.form.harga_layanan
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/layanan");
        });
    }
  }
};
</script>