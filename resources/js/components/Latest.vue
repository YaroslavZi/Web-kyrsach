<script>
import axios from 'axios'

export default {

    data() {
        return {
            latest: null,
        };
    },
    mounted() {
        axios
            .post('/getlatest')
            .then(response => {

                this.latest = response.data

            })
            .catch(error => {
                console.log(error);
            })


    },
    methods: {
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


    },
};
</script>

<template>
    <div class="products">

        <div v-for="one in this.latest" class="card">
            <img :src="'imgs/' + one.img" class="card-img-top" :alt="one.img">
            <div class="card-body">
                <h5 class="card-title"><a :href="'http://127.0.0.1:8000/product/' + one.id">{{ one.name }}</a></h5>
                <p style="color: #14c004; font-weight: 700; font-size: 18px;" class="card-text">{{ one.price }}₽</p>
                <a @click.prevent="toCartClick($event.target)" :data-id="one.id" class="btn btn-primary">В корзину <i class="fa fa-shopping-cart"
                        aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</template>