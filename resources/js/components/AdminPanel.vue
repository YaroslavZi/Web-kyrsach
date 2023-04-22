
<template>
    <div class="content mt-5 mb-5 radius-content py-3 px-3" style="min-height: 300px">
        <div class="mb-3 d-flex justify-content-center" style="background-color: #14c004; font-weight: 700; font-size: 18px; ">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link"  style="color:white!important" href="/adminpanel/products">Товары</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white!important" href="/adminpanel/categories">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white!important" href="/adminpanel/brands">Производители</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white!important" href="/adminpanel/orders">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:white!important" href="/adminpanel/users">Пользователи</a>
                </li>
            </ul>
        </div>
        <hr>
        <div class="catalog-products-grid" style="grid-auto-rows: 200px!important; ">
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center; border-radius: 8px;">
                <button v-on:click="modalClick($event.target)" id="products" data-bs-toggle="modal"
                    data-bs-target="#dbModal" style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Товары</button>

            </div>
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center;  border-radius: 8px;">
                <button v-on:click="modalClick($event.target)" id="categories" data-bs-toggle="modal"
                    data-bs-target="#dbModal" style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Категории</button>

            </div>
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center;  border-radius: 8px;">
                <button v-on:click="modalClick($event.target)" id="orders" data-bs-toggle="modal" data-bs-target="#dbModal"
                    style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Заказы</button>

            </div>
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center;  border-radius: 8px;">
                <button v-on:click="modalClick($event.target)" id="brands" data-bs-toggle="modal"
                    data-bs-target="#dbModal" style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Производители</button>

            </div>
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center;  border-radius: 8px;">
                <button v-on:click="modalClick($event.target)" id="users" data-bs-toggle="modal" data-bs-target="#dbModal"
                    style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Пользователи</button>

            </div>
            
            <div class="catalog-product-item d-flex" style="background-color:#14c004; justify-content:center;  border-radius: 8px;">
                <button id="uploadpics" data-bs-toggle="modal" data-bs-target="#uploadModal"
                    style="width:100%; background-color: transparent; font-weight: 700; font-size: 22px; color:white">Загрузка фото</button>

            </div>
        </div>

        <div class="modal fade" id="dbModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="dbModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dbModalLabel">{{ this.data_id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">

                        <div v-if="this.data_id != 'slider'" class="item-bottom mt-3">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-add-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-add" type="button" role="tab" aria-controls="pills-add"
                                        aria-selected="true">Добавить</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-update-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-update" type="button" role="tab" aria-controls="pills-update"
                                        aria-selected="false">Изменить</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-remove-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-remove" type="button" role="tab" aria-controls="pills-remove"
                                        aria-selected="false">Удалить</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-add" role="tabpanel"
                                    aria-labelledby="pills-add-tab">
                                    <form>

                                        <div v-for="data in this.modal_data" class="mb-3">
                                            <div
                                                v-if="data !== 'email_verified_at' && data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token'">
                                                <label class="form-label">{{ data }}</label>
                                                <input type="text" class="form-control db-create" :id="data">
                                            </div>
                                        </div>
                                        <button type="button" v-on:click="actionClick($event.target)" id="create"
                                            class="btn btn-primary mt-3">Отправить</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-update" role="tabpanel"
                                    aria-labelledby="pills-update-tab">
                                    <form action="">
                                        <div class="mb-3">
                                            <label class="form-label">Введите ID</label>
                                            <input type="text" class="form-control" v-model="update_id">
                                            <button type="button" v-on:click="updateIdClick"
                                                class="btn btn-primary mt-3">Получить</button>
                                        </div>
                                    </form>
                                    <form>

                                        <div v-for="data in this.modal_data" class="mb-3">
                                            <div
                                                v-if="data !== 'email_verified_at' && data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token'">
                                                <label class="form-label">{{ data }}</label>
                                                <input type="text" class="form-control db-update" :id="data">
                                            </div>
                                        </div>
                                        <button type="button" v-on:click="actionClick($event.target)" id="update"
                                            class="btn btn-primary mt-3">Отправить</button>

                                    </form>

                                </div>
                                <div class="tab-pane fade" id="pills-remove" role="tabpanel"
                                    aria-labelledby="pills-remove-tab">
                                    <label class="form-label">Удаляемый ID</label>
                                    <input type="text" class="form-control db-remove">
                                    <button type="button" v-on:click="actionClick($event.target)" id="remove"
                                        class="btn btn-primary mt-3">Отправить</button>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Загрузка картинок</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <DropZone url="http://127.0.0.1:8000/filesupload" :uploadOnDrop="true"  method="POST" :headers="csrfHeader"   />

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import DropZone from 'dropzone-vue';
import 'dropzone-vue/dist/dropzone-vue.common.css';

export default {

    components: {
        DropZone,
    },
    data() {
        return {
            data_id: null,
            modal_data: null,
            tab_data: null,
            tab_links: null,
            tab_name: null,
            tab_columns: null,
            update_id: null,
            update_data: null,
            input_data: null,
            input_header: null,
            files: null,
            csrfHeader: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            }
        };
    },

    methods: {
        modalClick: function (e) {
            this.data_id = e.id;
            if (this.data_id != 'slider') {
                axios
                    .get('http://127.0.0.1:8000/getdbdata', {
                        params: {
                            id: this.data_id
                        }
                    })
                    .then(response => {
                        this.modal_data = response.data
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }

        },
        updateIdClick: function () {
            axios
                .get('http://127.0.0.1:8000/updatedata', {
                    params: {
                        id: this.update_id,
                        db: this.data_id
                    }
                })
                .then(response => {
                    this.update_data = response.data
                    let temp = this.update_data
                    let list = document.getElementsByClassName('db-update')
                    Array.from(list).forEach(function (el) {
                        el.value = temp[el.id] // в el.id содержится название атрибута
                    });
                })
                .catch(error => {
                    console.log(error);
                })
        },
        actionClick: function (e) {



            if (e.id == 'create') {
                let temp = new Array
                let temp2 = new Array
                let list = document.getElementsByClassName('db-create')
                let i = 0;
                let flag = false; // true если есть пустые значения
                Array.from(list).forEach(function (el) {
                    if (el.value == '') flag = true
                    temp[i] = el.value;
                    temp2[i] = el.id
                    i++
                });

                this.input_data = temp
                this.input_header = temp2
                if (flag == false) {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        input_data: this.input_data,
                        input_header: this.input_header,
                        db: this.data_id


                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')

            }
            else if (e.id == 'update') {
                let temp = new Array
                let temp2 = new Array
                let list = document.getElementsByClassName('db-update')
                let i = 0;
                let flag = false; // true если есть пустые значения
                Array.from(list).forEach(function (el) {
                    if (el.value == '') flag = true
                    temp[i] = el.value;
                    temp2[i] = el.id
                    i++
                });

                this.input_data = temp
                this.input_header = temp2
                if (flag == false) {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        input_data: this.input_data,
                        input_header: this.input_header,
                        db: this.data_id,
                        update_id: this.update_id

                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')

            }
            else if (e.id == 'remove') {

                let id = document.getElementsByClassName('db-remove')[0].value

                if (id != '') {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        db: this.data_id,
                        remove_id: id

                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')
            }
        },


    }
}
</script>