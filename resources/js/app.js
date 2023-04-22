require('./bootstrap');


import { createApp } from 'vue';
import Latest from './components/Latest.vue'
import Products from './components/Products.vue'
import AdminPanel from './components/AdminPanel.vue'
import Cart from './components/Cart.vue'




let app=createApp()
app.component('latest', Latest)
app.component('products', Products)
app.component('admin-panel', AdminPanel)
app.component('cart', Cart)


app.mount('#app');

