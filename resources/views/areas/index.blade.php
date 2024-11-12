@extends('layouts.layout')

@section('content')
    <div class="grid-5 mt-10">
        <div class="flex-col-1 px-5 top-bottom-black-gradient" id="cities"></div>
        <div class="lg:col-span-3 flex-col-5">
            <h1 class="text-5xl lg:text-7xl text-center text-mainColor">Области в България</h1>
            <!-- kartata na bg -->
            <div>

            </div>
            <!-- kartata na bg -->
        </div>
        <div class="flex-col-1" id="weather"></div>
    </div>

    <!-- information blog -->
    <div class="top-bottom-black-gradient">
        <div class="z-10 flex-center flex-wrap w-full">
            <ul class="oblasti-hover flex justify-center items-center flex-wrap gap-3">
                <li>Хотели</li>
                <li>Заведения</li>
                <li>Авто и Транспорт</li>
                <li>Електроника</li>
                <li>Институции</li>
                <li>Мебели</li>
                <li>Образование</li>
                <li>Услуги</li>
            </ul>
        </div>
    </div>
    <!-- information blog -->

    <div class="top-bottom-green-gradient">
        <p class="p-5 text-center text-white">Elektronika</p>
    </div>

    <h1 class="uppercase text-center p-5 text-2xl">Резултат в категория части</h1>
    <section class="grid-4 gap-10 max-w-[105rem] mx-auto">
        <div class="grid-2 lg:col-span-3">
            <div class="flex-col-3">
                <div class="flex-between px-4 bg-neutral-200 p-2">
                    <h1 class="font-bold">Хотел</h1>
                    <p>VIP</p>
                </div>
                <div class="flex-between gap-3">
                    <img class="h-auto w-[200px]" src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995"
                        alt="image" />
                    <div class=" w-full flex-col-2">
                        <div class="flex gap-3 items-center">
                            <i class="fa-solid fa-phone"></i>
                            <p class="text-sm">(+359) 87778 95 65 / (+359) 87778 95 65</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <i class="fa-solid fa-location-pin"></i>
                            <p class="text-sm">Пловдив, бул. „Цар Борис III-ти Обединител</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <i class="fa-regular fa-envelope"></i>
                            <p class="text-sm">antique teatre@mail.mail</p>
                        </div>
                        <div class="flex gap-3 items-center">
                            <i class="fa-solid fa-globe"></i>
                            <p class="text-sm">www.antique teatre.bg</p>
                        </div>
                    </div>
                </div>
                <div class="flex-between">

                    <div class="flex items-center gap-3 w-[200px]">
                        <div class="flex-3">
                            <i class="fa-brands fa-facebook-f"></i>
                            <span>|</span>
                        </div>
                        <div class="flex-3">
                            <i class="fa-brands fa-facebook-f"></i>
                            <span>|</span>
                        </div>
                    </div>
                    <p class="w-full">Понеделник-Петьк: 9:00ч. - 17:30ч.</p>
                </div>
            </div>
        </div>

        <div class="flex-col-5">
            <div class="flex-col-3 p-5">
                <div class="bg-mainColor hover:bg-mainColorRed">
                    <h1 class="text-white p-3 text-xl uppercase">Пловдив</h1>
                    <img src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" class="w-full" />
                </div>
            </div>
        </div>


    </section>

    <script>
        const majorCitiesInBulgaria = [
            "Благоевград", "Бургас", "Варна", "Велико Търново", "Видин", "Враца",
            "Габрово", "Добрич", "Кърджали", "Кюстендил", "Ловеч", "Монтана",
            "Пазарджик", "Перник", "Плевен", "Пловдив", "Разград", "Русе",
            "Силистра", "Сливен", "Смолян", "София", "София-град", "Стара Загора",
            "Търговище", "Хасково", "Шумен", "Ямбол"
        ];

        const selectedCitiesInBulgaria = [{
                name: "София",
                temperature: 15
            },
            {
                name: "Пловдив",
                temperature: 17
            },
            {
                name: "Стара Загора",
                temperature: 16
            },
            {
                name: "Бургас",
                temperature: 18
            },
            {
                name: "Шумен",
                temperature: 14
            },
            {
                name: "Плевен",
                temperature: 16
            },
            {
                name: "Враца",
                temperature: 15
            },
            {
                name: "Русе",
                temperature: 17
            },
            {
                name: "Сливен",
                temperature: 16
            },
            {
                name: "Ямбол",
                temperature: 18
            },
            {
                name: "Пазарджик",
                temperature: 16
            },
            {
                name: "Пазарджик",
                temperature: 16
            }
        ];

        const weather = document.getElementById('weather');
        const cities = document.getElementById('cities')

        cities.innerHTML = majorCitiesInBulgaria.map((city, id) => {
            return `<div key=${id}><span class="text-sm">${city}</span></div>`
        }).join('')

        weather.innerHTML = selectedCitiesInBulgaria.map((city, id) => {
            return `
                <div key=${id} class='top-bottom-red-gradient p-4 flex-between text-white'>
                    <h1>${city.name}</h1>
                    <div class="flex items-center gap-2 text-lg">
                        <i class="fa-regular fa-sun"></i>
                        <span>|</span>
                        <h1 class="font-bold">${city.temperature}</h1>
                    </div>
                </div>
            `
        }).join('')
    </script>
@endsection
