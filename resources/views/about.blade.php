@extends('layouts.layout')

@section('title','Контакты')

@section('main_content')
<main class="bg-light py-5">
    <div class="container">


        <div class="row">

            <div class="col-md-5">
                <h1>Контакты</h1>
                
                <p class="mt-4">г. Челябинск, улица Кирова, 159</p>

                <h4 class="mt-4">Часы работы</h4>
                <p>ПН-ПТ: 9:00 - 21:00</p>
                <p>СБ: 10:00 - 20:00</p>

                <p class="mt-4"><a href="tel:+79320123077" class="text-success">+7 932-012-30-77</a></p>
                <p><a href="tel:+79365123043" class="text-success">+7 936-512-30-43</a></p>
                
            </div>
            <div class="col-md-7">
                <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/house/ulitsa_kirova_159/YkgYcgdhS0cDQFtvfX13dXpgbQ==/?ll=61.401682%2C55.164472&utm_medium=mapframe&utm_source=maps&z=19.25" style="color:#eee;font-size:12px;position:absolute;top:14px;">Улица Кирова, 159 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/-/CCUBzDsBLA" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;" class="border rounded-lg"></iframe></div>
            </div>
        </div>
      

    </div>

</main>

@endsection