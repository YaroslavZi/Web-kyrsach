<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: 0,
            totalprice: 0,
            desc: 'Корзина пуста',
            name: '',
            phone: '',
            comments: '',
            delivery: false

        };
    },
    mounted() {
        axios
            .get('http://127.0.0.1:8000/getcartdata')
            .then(response => {
                this.items = response.data[0]
                this.totalprice = response.data[1]
                console.log(this.items[0])
                console.log( this.totalprice)

            })
            .catch(error => {
                console.log(error);
            })

    },
    methods: {
        delFromCart: function (e) {

            axios
                .get('http://127.0.0.1:8000/delfromcart', {
                    params: {
                        id: e.getAttribute('data-id')
                    }
                })
                .then(response => {
                    if (response.data[0] != 0) {
                        this.items = response.data[0]
                        this.totalprice = response.data[1]
                    }
                    else {
                        this.items = null
                        this.totalprice = 0
                    }

                    var qty = document.getElementsByClassName('cart-qty-p')[0]
                    qty.textContent = Number(document.getElementsByClassName('cart-qty-p')[0].textContent) - 1

                })
                .catch(error => {
                    console.log(error);
                })
        },

        sendOrder: function () {

            // delivery type
            if (document.getElementById('radio-dostavka').checked) {
                this.delivery = true;
            } else if (document.getElementById('radio-vivoz').checked) {
                this.delivery = false
            }
            // -------------

            if (this.items != null && this.items != undefined) {
                if (this.name != '' && this.phone != '') {

                    console.log(this.delivery)
                    axios.post('http://127.0.0.1:8000/addorder', {

                        name: this.name,
                        phone: this.phone,
                        delivery: this.delivery,

                    })
                        .then(response => {
                            alert('Заказ оформлен')
                            this.items = null
                            axios.post('http://127.0.0.1:8000/clearcart').then(response => {
                                var qty = document.getElementsByClassName('cart-qty-p')[0]
                                qty.textContent = '0'
                            });

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля формы')
            }
            else {
                alert('Корзина пуста')
            }
        },

        changeCount: function (e) {
            if (Number(e.value) > Number(e.max)) e.value = e.max
            else if (Number(e.value) < Number(e.min)) e.value = e.min


            axios
                .get('http://127.0.0.1:8000/cartcount', {
                    params: {
                        id: e.getAttribute('data-id'),
                        count: e.value

                    }
                })
                .then(response => {

                    console.log('Значение товара изменено')


                })
                .catch(error => {
                    console.log(error);
                })
        }

    }
}
</script>
<template>
    <div class="content mt-3 mb-3">
        <h1>Корзина</h1>
        <div class="cart-items">
      

            <div v-if="this.items !== undefined && this.items !== null" v-for="item in this.items" class="cart-item "
                :id="item.id">
                <div class="cart-product">
                    <div class="cart-product-img">
                        <img v-bind:src="'http://127.0.0.1:8000/imgs/' + item.img" alt="">
                    </div>
                    <div class="cart-product-name">
                        <a v-bind:href="'http://127.0.0.1:8000/product/' + item.id + '-' + item.name.split(' ').join('-')">{{
                            item.name }}</a>
                    </div>
                </div>
                <div class="cart-count item-to-cart"><input v-on:input="changeCount($event.target)" type="number"
                        v-bind:data-id="item.id" class="form-control" min="1" value="1" :max="item.count"></div>
                <div class="cart-total">
                    <p>{{ item.price }}</p>
                </div>
                <div class="cart-remove">
                    <div style="color:red" class="del-product-link">
                        <i @click.prevent="delFromCart($event.target)" v-bind:data-id="item.id" class="fa fa-minus"
                            aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div v-else>
                <h3 class="mt-3 text-center">{{ this.desc }}</h3>
            </div>

            <div class="cart-item d-flex w-100" style="justify-content: center">
                <div style="font-size: 18px; font-weight: 700; margin: 0 20px" id="totalPrice">Итого: <span
                        style="color: green">{{ totalprice }} ₽</span></div>


            </div>
        </div>


        <form>
            <div class="cart-form">
                <div class="mycart">
                    <div class="cart-form-col">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Ваше имя</label>
                            <input type="text" v-model="name" class="form-control" id="inputName">
                        </div>
                        <div class="mb-3">
                            <label for="inputPhone" class="form-label">Телефон</label>
                            <input type="tel" v-model="phone" class="form-control" id="inputPhone" placeholder="+7 (949)">
                        </div>
                    </div>

                    <div class="cart-form-col">
                        <div class="mb-3">
                            <label for="inputPhone" required="" class="form-label">Комментарий к заказку</label>
                            <textarea class="form-control" v-model="comments" id="comments"></textarea>

                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio-dostavka">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Доставка
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio-vivoz"
                                    checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Самовывоз
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <button v-on:click="sendOrder" type="button" class="btn btn-primary ">Подтвердить заказ</button>

            </div>

        </form>
    </div>
</template>