let toggleMenu = document.querySelector(".wrapper .header .fa-bars");
let wrapper = document.querySelector(".wrapper");
let label = document.querySelectorAll(".wrapper .content  form .inputs label");
let inputArray = document.querySelectorAll(".wrapper .content  form .inputs input");
let controller = document.querySelectorAll(".controller table tbody tr");

let other = document.querySelector(
  ".wrapper .header .leftSide > li:last-child"
);
let subLinks = document.querySelectorAll(
  ".wrapper .body .sidebar .links > li > div"
);
let arrowHeder = document.querySelector(".header .rightSide .header-arrow");


toggleMenu.onclick = function () {
  wrapper.classList.toggle("open-side");
};

other.addEventListener("click", (e) => {
  e.currentTarget.classList.toggle("open-other");
  console.log();
});

inputArray.forEach((element, index) => {
  element.onfocus = function () {
    label[index].style.opacity = "1";
    element.parentElement.querySelector("span").style.width="100%";
  };
});
inputArray.forEach((element, index) => {
  element.onblur = function () {
    label[index].style.opacity = "0";
    element.parentElement.querySelector("span").style.width="0%";

  };
});

subLinks.forEach((link, index) => {
  link.addEventListener("click", (e) => {
    subLinks.forEach((otherLink) => {
      if (otherLink !== link) {
        otherLink.parentElement.classList.remove("open-sub-links");
      }
    });
    link.parentElement.classList.toggle("open-sub-links");
  });
});

let lang = document.body.dataset.lang;

if (lang == "ar") {
  arrowHeder.classList.remove("fa-chevron-right");
  arrowHeder.classList.add("fa-chevron-left");
} else if (lang == "en") {
  arrowHeder.classList.remove("fa-chevron-left");
  arrowHeder.classList.add("fa-chevron-right");
}
  
