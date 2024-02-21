let toggleMenu = document.querySelector(".wrapper .header .fa-bars");
let wrapper = document.querySelector(".wrapper");
let label = document.querySelectorAll(".wrapper .content  form label");
let inputArray = document.querySelectorAll(".wrapper .content  form input");
let controller = document.querySelectorAll(".controller table tbody tr");
let statusEmp = document.querySelectorAll(
  ".controller table tbody tr td:nth-child(6)"
);
let other = document.querySelector(
  ".wrapper .header .leftSide > li:last-child"
);
let subLinks = document.querySelectorAll(
  ".wrapper .body .sidebar .links > li > div"
);
let arrowHeder = document.querySelector(".header .rightSide .header-arrow");

statusEmp.forEach((element, index) => {
  if (element.dataset.status == "active") {
    Array.from(controller[index].children).forEach((col) => {
      col.style.boxShadow = "inset -2px -2px 9px 1px #029102a1";
    });
  } else {
    Array.from(controller[index].children).forEach((col) => {
      col.style.boxShadow = "inset -2px -2px 9px 1px #cf6969";
    });
  }
});

toggleMenu.onclick = function () {
  wrapper.classList.toggle("open-side");
};

other.querySelector(".other").addEventListener("click", (e) => {
  e.stopPropagation();
});

other.addEventListener("click", (e) => {
  e.target.classList.toggle("open-other");
});

document.addEventListener("click", (e) => {
  if (e.target.classList.item(0) !== "open-other") {
    other.classList.remove("open-other");
  }
});

inputArray.forEach((element, index) => {
  element.onfocus = function () {
    label[index].style.opacity = "1";
  };
});
inputArray.forEach((element, index) => {
  element.onblur = function () {
    label[index].style.opacity = "0";
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
  arrowHeder.classList.remove("fa-chevron-left");
  arrowHeder.classList.add("fa-chevron-left");
} else if (lang == "en") {
  arrowHeder.classList.remove("fa-chevron-left");
  arrowHeder.classList.add("fa-chevron-right");
}
