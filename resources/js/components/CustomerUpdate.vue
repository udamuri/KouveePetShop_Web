<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Update Pegawai</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
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
          <button class="btn btn-primary" v-on:click="updateData()" to="/customer">Submit</button>
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
        id_customer:'',
        nama_customer: '',
        alamat_customer: '',
        tglLahir_customer:'',
        noTelp_customer:''
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
      axios31
        .get("http://localhost:8000/api/customer/" + this.$route.params.id_customer)
        .then(response => {
          // post value yang dari response ke form
          this.form.id_customer = response.data.id_customer;
          this.form.nama_customer = response.data.nama_customer;
          this.form.alamat_customer = response.data.alamat_customer;
          this.form.tglLahir_customer = response.data.tglLahir_customer;
          this.form.noTelp_customer = response.data.noTelp_customer;
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put("http://localhost:8000/api/pegawai/" + this.$route.params.NIP, {
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