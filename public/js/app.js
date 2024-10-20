import {
  // blogBoxes,
  navbarLinks,
  // sidebarNews,
  // swiperHeaderSwipers,
} from "./static.js";

const navbarLinksWrapper = document.getElementById("navbarlinks-wrapper");
// const swiperWrapperHeader = document.getElementById("swiper-wrapper-header");
// const blogWrapper = document.getElementById("blog-wrapper");
// const sidenewsWrapper = document.getElementById("sidenews-wrapper");

navbarLinksWrapper.innerHTML = navbarLinks
  .map((link, id) => {
    return `<li key=${id}><a href=${link.path}>${link.name}</a></li>`;
  })
  .join("");

document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.custom-navbar-component li');
  const contents = document.querySelectorAll('[id^="content-"]');

  tabs.forEach(tab => {
    tab.addEventListener('click', function () {
      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove('active'));

      // Hide all content divs
      contents.forEach(content => content.classList.add('hidden'));

      // Add active class to the clicked tab
      this.classList.add('active');

      // Show the corresponding content div
      const contentId = this.id.replace('tab', 'content');
      document.getElementById(contentId).classList.remove('hidden');
    });
  });
});

// swiperWrapperHeader.innerHTML = swiperHeaderSwipers
//   .map((swiper, id) => {
//     return `<div key=${id} class="swiper-slide relative"><img src=${swiper.bg} /><h1 class="text-white drop-shadow-xl text-3xl absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">${swiper.text}</h1></div>`;
//   })
//   .join("");

// blogWrapper.innerHTML = blogBoxes
//   .map((box, id) => {
//     const { image, name, date, text, heading } = box;

//     return `
    
//         <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all" key=${id}>
//             <img src=${image} alt=${name}/>
//             <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
//                 <p class="font-light group-hover:text-white">${date}</p>
//                 <h1 class="font-bold text-lg group-hover:text-white">${heading}</h1>
//                 <p class="text-sm max-w-[350px] group-hover:text-white">${
//                   text.slice(1, 70) + "..."
//                 }</p>
//                 <button class="w-max text-sm text-red group-hover:text-white">Прочети повече</button>
//             </div>
//         </div>
    
//     `;
//   })
//   .join("");
  
// sidenewsWrapper.innerHTML = sidebarNews
//   .map((news, id) => {
//     return `
//     <div key=${id} class="group flex flex-col transition-all">
//         <div class="group-hover:bg-[#8b2c3e] w-full bg-[#6d7b40]">
//             <h1>${news.name}</h1>
//         </div>
//         <img alt=${news.name} src=${news.image}/>
//     </div>`;
//   })
//   .join("");
