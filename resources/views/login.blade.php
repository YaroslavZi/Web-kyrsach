@include('header')
    <div class="content mt-5 mb-5 radius-content py-3 px-3" style="min-height: 300px">
        <h1>Авторизация</h1>
        <form action="/adminlogin" method="post" class="row g-3 needs-validation" validate>

            @csrf
            <div class="col-md-6">
                <input type="email" name="email" aria-label="E-mail" placeholder="E-mail" required="" class="form-control">
            </div>
            <div class="col-md-6">
                <input type="password" aria-label="Пароль" placeholder="Пароль" name="password" required="" class="form-control">
            </div>
            <div class="col-12 d-flex" style="align-items: center;">
                <button class="btn btn-primary" type="submit">Войти</button>
            </div>
        </form>
        <div style="color: red;">
        @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
        @endif</div>


    </div>

@include('footer')
