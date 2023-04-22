<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Подпишись на наши социальные сети:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="" class="me-4 text-reset">
                <i class="fa fa-vk" aria-hidden="true"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fa fa-telegram" aria-hidden="true"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
            </a>

        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>ArtShop
                    </h6>
                    <p>
                        У нас вы можете купить различные художественные товары
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Товары
                    </h6>
                    @foreach (session('categories') as $category)
                    <p>
                        <a href="http://127.0.0.1:8000/products/{{ $category['name']  }}" class="text-reset">{{ ucfirst($category['rus_name']) }}</a>
                    </p>
                    @endforeach

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">

                        Ссылки </h6>
                    <p>
                        <a href="http://127.0.0.1:8000/" class="text-reset">Главная</a>
                    </p>
                    <p>
                        <a href="http://127.0.0.1:8000/profile" class="text-reset">Профиль</a>
                    </p>
                    <p>
                        <a href="http://127.0.0.1:8000/signin" class="text-reset">Войти</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Контакты
                    </h6>
                    <p><i class="fa fa-home" aria-hidden="true"></i>
                        г.Донецк, м-рн Мирный, 8а</p>
                    <p>
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        </i>
                        info@example.com
                    </p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i>
                        + 7 949 999 99 99</p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i>
                        + 7 949 999 99 99</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2023 Copyright:
        <a class="text-reset fw-bold" href="https://vk.com/id124456762">Ярослав Захаров</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script src="{{ mix('js/app.js') }} "></script>

</body>

</html>
