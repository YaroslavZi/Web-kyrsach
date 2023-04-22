@include('header')


<div id="app">
    <products :products = '@json($products)' :brands = '@json($brands)' :price_range = '@json($price_range)' :rus_category = '@json($rus_category)' :eng_category = '@json($eng_category)' :checked_brands_category = '@json($checked_brands)'  :sort_price = '@json($sort_price)'/>
</div>

@include('footer')
