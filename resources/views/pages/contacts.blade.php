@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="en">

<body class="bg-gray-100">
    {{-- @include('layouts.partials._before_header') --}}
    @include('layouts.partials._header')

    <header class="flex flex-col overflow-x-hidden bg-gray-200 shadow-md">
        <div class="grid grid-cols-1">
            <div class="flex justify-center items-center p-5">
                <img alt="bg" src="{{ asset('theme/images/logo.png') }}" class="mx-auto" />
            </div>
        </div>
        <div class="flex items-center justify-between px-5 py-3 bg-white shadow-sm headline">
            <div class="flex items-center text-sm gap-1 text-gray-500">
                <a href="/" class="text-black">Начало</a> /
                <a class="text-black">{{ $page->i18n->title }}</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 mt-10">
        <div class="flex flex-col lg:flex-row justify-between gap-10 p-6 rounded-lg shadow-lg bg-white ">
            <div class="w-full lg:w-1/2">
                <h2 class="font-bold text-xl mb-4">{!! $page->i18n->title !!}</h2>
                <form class="space-y-4">
                    <input type="text" name="name" placeholder="Въведете Име" required
                        class="w-full p-3 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <input type="text" name="surname" placeholder="Въведете Фамилия" required
                        class="w-full p-3 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <input type="email" name="email" placeholder="Въведете Email" required
                        class="w-full p-3 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <input type="text" name="phone" placeholder="Въведете Телефон" required
                        class="w-full p-3 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <textarea name="message" placeholder="Въведете Съобщение" rows="4" required
                        class="w-full p-3 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
                    <button type="submit"
                        class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">ИЗПРАТИ</button>
                </form>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="text-sm text-gray-600 leading-relaxed">{!! $page->i18n->description !!}</div>
                <iframe class="w-full h-72 border-0 mt-4"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.6237274985587!2d23.319934615290504!3d42.69605117916854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40aa857a92e7da45%3A0x3e4c39c0ad1d4c9e!2s285%20Gotse%20Delchev%20Blvd%2C%20Sofia%2C%20Bulgaria!5e0!3m2!1sen!2sbg!4v1633093420590!5m2!1sen!2sbg"
                    allowfullscreen></iframe>

            </div>
        </div>
    </main>

    @include('layouts.partials._footer')

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>
</body>

</html>

<style>

</style>
