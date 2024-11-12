@extends('layouts.layout')

@section('content')
    <div class="grid-5 mt-10">
        <div class="flex-col-1 px-5 top-bottom-black-gradient" id="cities"></div>
        <div class="lg:col-span-3 flex-col-5">
            <h1 class="text-5xl lg:text-7xl text-center text-mainColor">Области в България</h1>
            <!-- kartata na bg -->
            <div class="flex-center flex-wrap w-full">
                <map name="image-map">
                    <img src="{{ asset('images/map_01.png') }}" alt="" usemap="#image-map" />

                    <map name="image-map">
                        <area target="" alt="" title="" href="/r6-sofiya"
                            coords="26,195,28,216,40,259,55,283,76,297,86,316,88,345,91,374,134,366,172,355,172,328,150,294,152,274,160,261,171,240,163,224,186,218,210,224,187,197,177,184,152,180,134,181,125,165,102,169,92,158,66,193" shape="poly">
                        <area target="" alt="" title="" href="/r5-plovdiv"
                            coords="158,274,163,291,160,306,168,320,184,334,185,352,223,352,242,369,271,369,289,389,311,377,331,377,354,376,368,364,364,342,357,325,379,325,391,324,401,310,392,280,371,274,360,299,336,289,323,284,294,281,274,276,269,269,269,259,264,236,261,221,257,210,231,206,212,208,209,229,174,227,179,248,169,264"
                            shape="poly">
                        <area target="" alt="" title="" href="/r3-burgas"
                            coords="273,205,269,230,281,240,281,270,308,282,319,272,323,271,335,284,361,298,374,271,401,276,401,298,427,299,451,289,463,287,489,305,528,295,513,278,503,256,503,267,494,244,471,241,514,208,492,190,464,184,447,185,433,191,407,182,386,176,371,183,359,203,332,203,307,211,283,203"
                            shape="poly">
                        <area target="" alt="" title="" href="/r1-vratsa"
                            coords="51,48,35,60,32,97,51,118,68,137,92,153,120,165,146,180,176,174,192,186,200,205,219,198,247,209,259,201,250,180,262,156,287,138,279,95,241,92,196,93,151,78,124,74,97,84,81,78,70,70,85,49,59,34,55,39,55,45"
                            shape="poly">
                        <area target="" alt="" title="" href="/r8-varna"
                            coords="515,194,516,170,530,150,536,134,569,131,577,108,572,111,575,96,562,90,546,91,521,76,512,62,493,66,471,82,447,96,431,108,420,139,401,139,383,146,386,129,372,114,355,128,365,148,362,181,392,173,415,184,441,180,468,183"
                            shape="poly">
                        <area target="" alt="" title="" href="/r4-pleven"
                            coords="260,170,268,201,294,200,321,205,358,189,354,168,353,142,338,125,347,129,349,130,360,111,385,114,390,135,415,132,442,89,487,64,443,46,378,62,356,72,328,101,292,106,270,153" shape="poly">
                    </map>
                </map>
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
