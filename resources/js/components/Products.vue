<script>
import Slider from '@vueform/slider'

export default {
    props: ['products', 'brands', 'price_range', 'rus_category', 'eng_category', 'checked_brands', 'sort_price'],
    components: {
        Slider,
    },
    data() {
        return {
            value: [this.sort_price[0], this.sort_price[1]],
            orderby: [
                { name: 'цене, сначало недорогие', id: 1 },
                { name: 'цене, сначало дорогие', id: 2 },
                { name: 'наименованию А-Я', id: 3 },
                { name: 'наименованию Я-А', id: 4 }],
            order_id: 1,

        };
    },

    created() {

        // for navigation elements
        this.products['links'][0]['label'] = '<'
        this.products['links'][Object.keys(this.products['links']).length - 1]['label'] = '>'
        // --



    },
    methods: {
        orderClick: function (e) {
            this.order_id = e
        },
        sortClick: function () {




            var list = document.getElementsByClassName('form-check-input');
            var brands = new Array()

            Array.from(list).forEach(function (el) {
                if (el.checked) brands.push(el.id)
            });


            window.location.href = "http://127.0.0.1:8000/products/" + this.eng_category + "/sort/?order_id=" + this.order_id + "&min_price=" + this.value[0] + "&max_price=" + this.value[1] + "&brands=" + brands

        },
        toCartClick: function (e) {

            let id = e.getAttribute('data-id')
            axios
                .get('http://127.0.0.1:8000/addtocart', {
                    params: {
                        id: id
                    }
                })
                .then(response => {
                    console.log(response)
                    if (response.data == false) alert('Товар уже есть в корзине')
                  

                })
                .catch(error => {
                    console.log(error);
                })

        },


    }
}
</script>
<template> 
    <div class="content mt-3 mb-3 radius-content px-3">
        <div class="catalog">
            <div class="catalog-filter">
                <div class="filter-row">
                    <h4>Сортировать по:</h4>
                    <div class="filter">
                        <div class="dropdown myselect">

                            <select class="form-select" v-on:change="orderClick($event.target.value)"
                                aria-label="Default select example">
                                <option v-for="item in this.orderby" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="filter-row">
                    <h4>Цена</h4><br>
                    <div style="padding-right: 10px;">
                        <Slider v-model="value" :min="parseInt(price_range[0], 10)" :max="parseInt(price_range[1], 10)" />

                    </div>

                </div>
                <div class="filter-row">
                    <h4>Бренды</h4>
                    <div class="filter">
                        <div v-for="item in brands" class="form-check">
                            <input class="form-check-input" type="checkbox" v-bind:id="item">

                            <label class="form-check-label" for="flexCheckDefault">
                                {{ item }}
                            </label>
                        </div>

                    </div>
                </div>

                <div class="filter-row d-flex justify-content-center">
                    <button class="btn btn-primary" @click="sortClick">Применить</button>
                </div>
            </div>
            <div class="catalog-products">
                <h3>{{ rus_category }}</h3>
                <div class="catalog-products-grid">
                    <div v-for="one in this.products.data" class="card">
                        <img :src="'http://127.0.0.1:8000/imgs/' + one.img" class="card-img-top" :alt="one.img">
                        <div class="card-body">
                            <h5 class="card-title"><a :href="'http://127.0.0.1:8000/product/' + one.id">{{ one.name }}</a>
                            </h5>
                            <p style="color: #14c004; font-weight: 700; font-size: 18px;" class="card-text">{{ one.price }}₽
                            </p>
                            <a @click.prevent="toCartClick($event.target)"  :data-id="one.id" class="btn btn-primary">В корзину <i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" v-for="link in this.products.links"><a class="page-link"
                                v-bind:href="link.url">

                                <div> {{ link.label }}</div>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</template>
<style src="@vueform/slider/themes/default.css"></style>
