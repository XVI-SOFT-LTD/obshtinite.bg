export let navbarLinks = [];

const locale = document.documentElement.lang;

await loadTranslations(locale);

// Функция за зареждане на JSON файл
export async function loadTranslations(locale) {
    const response = await fetch(`/translations/${locale}`);
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    const translations = await response.json();
    navbarLinks = [
        {
            name: translations.home,
            path: '/'
        },
        {
            name: translations.news,
            path: '/listing/news'
        },
        {
            name: translations.areas,
            path: '/listing/areas'
        },
        {
            name: translations.parliamentary_groups,
            path: '/listing/parliamentary-groups'
        },
        {
            name: translations.landmarks,
            path: '/listing/landmarks'
        },
    ];
}


export const swiperHeaderSwipers = [
    {
        bg: '/theme/images/swiper.png',
        text: 'НАРОДЕН ТЕАТЪР ИВАН ВАЗОВ'
    },
    {
        bg: '/theme/images/swiper-2.jpg',
        text: 'АНТИЧЕН ТЕАТЪР ПЛОВДИВ'
    },
    {
        bg: '/theme/images/swiper-3.jpg',
        text: 'СТРИПТИЙЗ КЛУБ ВЕЛВЕТ'
    },
]

// export const blogBoxes = [
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
//     {
//         date: '20.10.2017',
//         heading: 'Новостите на града',
//         text: 'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec',
//         image: '/theme/images/box-image.png'
//     },
// ]


// export const sidebarNews = [
//     {
//         name: 'Пловдив',
//         image: '/theme/images/swiper.png'
//     },
//     {
//         name: 'Пловдив',
//         image: '/theme/images/sidenews-2.jpg'
//     },
//     {
//         name: 'Пловдив',
//         image: '/theme/images/sidenews-2.jpg'
//     },
//     {
//         name: 'Пловдив',
//         image: '/theme/images/sidenews-2.jpg'
//     },
// ]