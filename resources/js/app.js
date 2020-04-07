require('./bootstrap');

window.Vue = require('vue');

// import dependecies tambahan
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';

Vue.use(VueRouter,VueAxios,Axios);

// import file yang dibuat tadi
import App from './components/App.vue';
import Pegawai from './components/Pegawai.vue';
import PegawaiTambah from './components/PegawaiTambah.vue';
import PegawaiUpdate from './components/PegawaiUpdate.vue';
import Produk from './components/Produk';
import ProdukTambah from './components/ProdukTambah';
import ProdukUpdate from './components/ProdukUpdate';
import Customer from './components/Customer';
import CustomerTambah from './components/CustomerTambah';
import CustomerUpdate from './components/CustomerUpdate';
import Layanan from './components/Layanan';
import LayananTambah from './components/LayananTambah';
import LayananUpdate from './components/LayananUpdate';

// membuat router
const routes = [
    {
        name: 'pegawai',
        path: '/',
        component: Pegawai
    },
    {
        name: 'pegawaitambah',
        path: '/pegawaitambah',
        component: PegawaiTambah
    },
    {
        name: 'pegawaiupdate',
        path: '/pegawaiupdate/:NIP',
        component: PegawaiUpdate
    },
    {
        name: 'produk',
        path: '/produk',
        component: Produk
    },
    {
        name: 'produktambah',
        path: '/produktambah',
        component: ProdukTambah
    },
    {
        name: 'produkupdate',
        path: '/produkupdate/:id_produk',
        component: ProdukUpdate
    },
    {
        name: 'customer',
        path: '/customer',
        component: Customer
    },
    {
        name: 'customertambah',
        path: '/customertambah',
        component: CustomerTambah
    },
    {
        name: 'customerupdate',
        path: '/customerupdate/:id_customer',
        component: CustomerUpdate
    },
    {
        name: 'layanan',
        path: '/layanan',
        component: Layanan
    },
    {
        name: 'layanantambah',
        path: '/layanantambah',
        component: LayananTambah
    },
    {
        name: 'layananupdate',
        path: '/layananupdate/:id_layanan',
        component: LayananUpdate
    }
]

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");