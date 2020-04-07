<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Tambah Data Produk</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
        <div class="form-group">
            <label>ID Produk</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan ID"
              v-model="form.id_produk"
              required
            >
          </div>
          <div class="form-group">
            <label>Nama Produk</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Nama Produk"
              v-model="form.nama_produk"
              required
            >
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Harga"
              v-model="form.harga_produk"
              required
            >
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Stok"
              v-model="form.stok_produk"
              required
            >
          </div>
          <div class="form-group">
            <label>Minimal Stok</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Minimal Stok"
              v-model="form.min_stok_produk"
              required
            >
          </div>
          <div class="form-group">
            <label>Satuan Produk</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Masukkan Satuan Produk"
              v-model="form.satuan_produk"
              required
            >
          </div>
          <button class="btn btn-primary" to="/produk" v-on:click="addData()">Submit</button>
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
        id_produk:'',
        nama_produk: '',
        harga_produk: '',
        stok_produk:'',
        min_stok_produk:'',
        satuan_produk:''
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/produk", {
          id_produk: this.form.id_produk,
          nama_produk: this.form.nama_produk,
          harga_produk: this.form.harga_produk,
          stok_produk: this.form.stok_produk,
          min_stok_produk: this.form.min_stok_produk,
          satuan_produk: this.form.satuan_produk
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/produk");
        });
    }
  }
};
</script>