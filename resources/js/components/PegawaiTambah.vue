<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Tambah Data Pegawai</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
            <div class="form-group">
            <label>NIP</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan NIP"
              v-model="form.NIP"
              required
            >
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Nama"
              v-model="form.nama_pegawai"
              required
            >
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Alamat"
              v-model="form.alamat_pegawai"
              required
            >
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="YYYY-MM-DD"
              v-model="form.tglLahir_pegawai"
              required
            >
          </div>
          <div class="form-group">
            <label>No Telepon</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan No Telepon"
              v-model="form.noTelp_pegawai"
              required
            >
          </div>
          <div class="form-group">
            <label>Status</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Status"
              v-model="form.stat"
              required
            >
          </div>
        <div class="form-group">
            <label>Password</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Password"
              v-model="form.password"
              required
            >
          </div>
          <button class="btn btn-primary" to="/" v-on:click="addData()">Submit</button>
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
        NIP:'',
        nama_pegawai: '',
        alamat_pegawai: '',
        tglLahir_pegawai:'',
        noTelp_pegawai:'',
        stat:'',
        password:''
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/pegawai", {
          NIP: this.form.NIP,
          nama_pegawai: this.form.nama_pegawai,
          alamat_pegawai: this.form.alamat_pegawai,
          tglLahir_pegawai: this.form.tglLahir_pegawai,
          noTelp_pegawai: this.form.noTelp_pegawai,
          stat: this.form.stat,
          password: this.form.password
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/");
        });
    }
  }
};
</script>