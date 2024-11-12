@extends('layouts.layout')

@section('content')
    @php
        $phones = array_filter([$municipality->contact_phone_one, $municipality->contact_phone_two]);
        $longitude = $municipality->longitude;
        $latitude = $municipality->latitude;
    @endphp

    <!-- grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-30 mt-10">
        <!-- left side -->
        <div class="flex flex-col gap-5 lg:col-span-2">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3 px-5">
                <div class="bg-red-600 w-full">
                    <img alt="obshtina-snimka" src="{{ $municipality->getLogo() }}" class="w-full h-full object-cover" />

                </div>
                <div class="flex flex-col gap-10 lg:col-span-2 px-5">
                    <div class="p-3 uppercase flex-center slanted-border-container shadow-xl w-full">
                        <h1 class="text-center text-lg">Община {{ $municipality->i18n->name }}</h1>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone"></i>
                            <p>{{ implode(' / ', $phones) }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-map-pin"></i>
                            <p>{!! $municipality->i18n->address !!}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-envelope"></i>
                            <p>{!! $municipality->contact_email !!}</p>
                        </div>
                        @if ($municipality->website)
                            <div class="flex items-center gap-2">
                                <p>
                                    <i class="fa-solid fa-globe"></i>
                                    <a href="{{ $municipality->website }}" target="_blank" rel="noopener noreferrer">{{ $municipality->website }}</a>
                                </p>
                            </div>
                        @endif
                        <div class="flex items-center gap-2">
                            {{-- <i class="fa-solid fa-share-nodes"></i>
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-regular fa-envelope"></i> --}}
                            <a href="mailto:{{ $municipality->contact_email }}"><i class="fa-solid fa-envelope"></i></a>
                            @if ($municipality->social_media_links)
                                @foreach ($municipality->social_media_links as $network => $url)
                                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fa-brands fa-{{ $network }}"></i>
                                    </a>
                                @endforeach
                            @else
                                <p>Няма налични социални мрежи</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            @if ($municipality->gallery->count() > 0)
                <!-- multiple pictures swiper component -->
                <div class="swiper mySwiperTwo w-full h-[250px]">
                    <div class="swiper-wrapper">
                        @foreach ($municipality->gallery as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset($image->getImage(445)) }}" alt="Gallery Image" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <!-- multiple pictures swiper component -->
            @endif


            <!-- custom navbar component -->

            <ul class="bg-green hidden lg:flex justify-start gap-20 items-center custom-navbar-component">
                <li class="active" id="tab-party">{{ trans('app.aboutMunicipality') }}</li>
                <li id="tab-coalitions">Кметства</li>
                <li id="tab-europrojects">Европроекти</li>
                <li id="tab-inquiry">Запитване</li>
            </ul>

            <div class="flex flex-col gap-3 px-5" id="content-party">
                <p>{!! html_entity_decode($municipality->i18n->description) !!}</p>
            </div>

            <div class="flex flex-col gap-3 px-5 hidden" id="content-coalitions">
                <p>Кметствата в нашата община играят ключова роля в управлението и развитието на местните общности. Те
                    предоставят важни услуги и подкрепа на жителите, като същевременно работят за подобряване на
                    инфраструктурата и качеството на живот.</p>
            </div>

            <div class="flex flex-col gap-3 px-5 hidden" id="content-europrojects">
                <p>Европейските проекти са важен инструмент за финансиране и развитие на различни инициативи в нашата
                    община. Те подпомагат реализирането на проекти в областта на инфраструктурата, образованието,
                    културата и околната среда.</p>
            </div>

            <div class="flex flex-col gap-3 px-5 hidden" id="content-inquiry">
                <p>Ако имате въпроси или нужда от допълнителна информация, не се колебайте да се свържете с нас. Нашият
                    екип е на разположение да ви помогне и да отговори на вашите запитвания.</p>
            </div>


            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d5914.955480934349!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sbg!2sbg!4v1721156789591!5m2!1sbg!2sbg"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


            <div class="flex flex-col gap-3 text-center white-bg-gradient py-3">
                <div class="relative bg-red w-full text-center text-white px-5 lg:px-0">
                    <button class="absolute left-0 white-button-bg-gradient text-black h-[100%] px-5">{{ trans('app.landmarks') }}</button>
                    <p class="max-w-[1500px] mx-auto py-5">Бизнес и администрация | Транспорт | Мероприятия | Образование | Магазини | Хотели | Здраве и красота</p>
                </div>
            </div>
        </div>



        <!-- left side -->


        <!-- right side -->
        <div class="flex flex-col gap-5">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white uppercase text-xl">
                <h1>{{ trans('app.useful') }}</h1>
            </div>

            <div class="2xl:px-14 flex flex-col gap-5">
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-red p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover"
                            src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover"
                            src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover"
                            src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover"
                            src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- grid -->


    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiper = new Swiper(".mySwiperTwo", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                740: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                900: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1550: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    </script>
@endsection
