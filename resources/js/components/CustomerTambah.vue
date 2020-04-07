<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Tambah Data Customer</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
            <div class="form-group">
            <label>ID</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan ID"
              v-model="form.id_customer"
              required
            >
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Nama"
              v-model="form.nama_customer"
              required
            >
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Alamat"
              v-model="form.alamat_customer"
              required
            >
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="YYYY-MM-DD"
              v-model="form.tglLahir_customer"
              required
            >
          </div>
          <div class="form-group">
            <label>No Telepon</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan No Telepon"
              v-model="form.noTelp_customer"
              required
            >
          </div>
          <button class="btn btn-primary" to="/customer" v-on:click="addData()">Submit</button>
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
        id_customer:'',
        nama_customer: '',
        alamat_customer: '',
        tglLahir_customer:'',
        noTelp_customer:''
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/customer", {
          id_customer: this.form.id_customer,
          nama_customer: this.form.nama_customer,
          alamat_customer: this.form.alamat_customer,
          tglLahir_customer: this.form.tglLahir_customer,
          noTelp_customer: this.form.noTelp_customer
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/customer");
        });
    }
  }
};
</script>