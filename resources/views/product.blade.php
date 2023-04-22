@include('header')


<div class="content mt-5 mb-5 radius-content py-3 px-3" style="min-height: 300px">
    <div class="item-block">
        <div class="item-pics">
            <div class="item-main-pic">
                <img src="http://127.0.0.1:8000/imgs/{{ $product['img'] }}" style="width: 400px; height: 400px"alt="">
            </div>
        </div>
        <div class="item-title">
            <h3>{{ $product['name'] }}</h3>
            <h3><strong>{{ $product['price']  }}₽</strong></h3>

            @if ($product['count'] > 0 )
            <div class="availability mt-2 d-flex">
            <div class="articul">
                Артикул:&nbsp
                <div class="articul-num">{{$product['id']}} &nbsp </div>
            </div>
                <div class="availability-true">Есть в наличии</div>
            </div>


            @else
            <div class="availability mt-2">
                <div class="availability-false">Нет в наличии</div>
            </div>



            @endif
        </div>
    </div>
    <div class="item-bottom mt-3">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Описание</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Характеристики</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Отзывы</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                {{ $product['desc']}}
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </div>
</div>
@include('footer')
