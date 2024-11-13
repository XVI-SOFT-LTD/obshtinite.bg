@extends('layouts.layout')

@section('content')
    @include('homepage.partials._information_block')

    <section class="grid-4 gap-10">
        <div class="flex-col-5 lg:col-span-3">

            @includeWhen($municipalities->count(), 'homepage.partials._municipality')

            @includeWhen($parties->count(), 'homepage.partials._parties')

            @includeWhen($landmarks->count(), 'homepage.partials._landmarks')
        </div>

        <div class="flex-col-5">
            <div class="bg-mainColor gap-5 flex-start px-5 h-[65px]">
                <h1 class="text-white text-xl">Полезно</h1>
            </div>
            <div class="flex-col-3 p-5">
                <div class="bg-mainColor hover:bg-mainColorRed">
                    <h1 class="text-white p-3 text-xl uppercase">Пловдив</h1>
                    <img src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" class="w-full" />
                </div>
                <div class="bg-mainColor hover:bg-mainColorRed">
                    <h1 class="text-white p-3 text-xl uppercase">Варна</h1>
                    <img src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" class="w-full" />
                </div>
                <div class="bg-mainColor hover:bg-mainColorRed">
                    <h1 class="text-white p-3 text-xl uppercase">София</h1>
                    <img src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" class="w-full" />
                </div>
            </div>
        </div>

    </section>
@endsection
