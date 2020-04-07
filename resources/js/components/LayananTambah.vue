<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Tambah Data Layanan</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
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
          <button class="btn btn-primary" to="/layanan" v-on:click="addData()">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        id_layanan:'',
        nama_layanan: '',
        harga_layanan: ''
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/layanan", {
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