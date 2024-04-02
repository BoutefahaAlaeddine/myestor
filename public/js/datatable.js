//data

let tableData = document.querySelector("table.data");

let upperControl = document.createElement("div");
upperControl.className = "data upperControl";

let inputsInfo = [];
if (lang == "ar") {
  inputsInfo = [
    { className: "search", type: "text", textContent: "بحث:" },
    { className: "show", type: "number", textContent: "عرض سجلات:" },
  ];
} else if (lang == "en") {
  inputsInfo = [
    { className: "search", type: "text", textContent: "Search:" },
    { className: "show", type: "number", textContent: "entries per page:" },
  ];
}

inputsInfo.forEach((inputInfo) => {
  let inputs = document.createElement("div");
  inputs.className = "inputs";
  let label = document.createElement("label");
  label.textContent = inputInfo.textContent;
  let input = document.createElement("input");
  input.className = inputInfo.className;
  input.type = inputInfo.type;
  if (inputInfo.type === "number") {
    input.value = "10";
    input.min = "1";
    input.max = "10";
  }
  inputs.appendChild(label);
  inputs.appendChild(input);
  upperControl.appendChild(inputs);
});

let lowerControl = document.createElement("div");
lowerControl.className = "data lowerControl";
let ul = document.createElement("ul");
ul.className = "pagination";

if (lang == "ar") {
  move = ["السابق", "التالي"];
} else if ("en") {
  move = ["prev", "next"];
}
move.forEach((text) => {
  let li = document.createElement("li");
  li.textContent = text;
  ul.appendChild(li);
});
lowerControl.appendChild(ul);

let info = document.createElement("div");
info.className = "info";
lowerControl.appendChild(info);

tableData.insertAdjacentElement("beforebegin", upperControl);
tableData.insertAdjacentElement("afterend", lowerControl);

let data = document.querySelectorAll("table.data tbody tr");
let tbody = document.querySelector("table.data tbody");

let show = document.querySelector(".data.upperControl .inputs .show");
let search = document.querySelector(".data.upperControl .inputs .search");
let prev = document.querySelector(
  ".data.lowerControl .pagination li:first-child"
);
let next = document.querySelector(
  ".data.lowerControl .pagination li:last-child"
);
let totalRow = document.querySelector(".data.lowerControl .show .total-row");
let totalTable = document.querySelector(
  ".data.lowerControl .show .total-table"
);

let tableIndex = [];
let test = [];

data.forEach((element, index) => {
  test.push(index);
});

function generateTableIndex() {
  let max = parseInt(show.value);

  tableIndex = [];
  if (test.length == 0) {
    createRowEnquiry();
  } else {
    for (let i = 0; i < test.length; i += max) {
      tableIndex.push(test.slice(i, i + max));
    }

    Showing(1, tableIndex[0].length);
    generatePagination();
    generatePagination(0);
  }
}

generateTableIndex();

search.onkeyup = function (ele) {
  showRowBySearch(ele.target.value);
  counterRowsNone();
};

show.onchange = function (ele) {
  showRowsByNumber(ele.target.value);
  counterRowsNone();
  generateTableIndex();
};

function showRowBySearch(textInput) {
  tbody.innerHTML = "";

  data.forEach(function (ele, index) {
    let text = ele.querySelector("td:first-child").textContent;

    if (textInput !== "") {
      text.includes(textInput) ? tbody.appendChild(ele) : "";
    } else {
      if (index < show.value) {
        tbody.appendChild(ele);
      }
    }
  });
}

function counterRowsNone() {
  let $rows = tbody.querySelectorAll("tr td");
  if ($rows.length == 0) {
    createRowEnquiry();
  } else {
    removeRowEnquiry();
  }
}

function createRowEnquiry() {
  removeRowEnquiry();
  let Enquiry = document.createElement("div");
  Enquiry.textContent =
    lang == "ar" ? "عذرا، لا يوجد اي صف" : "Sorry, there is no row ";
  Enquiry.className = "data enquiry";
  tableData.after(Enquiry);
}

function removeRowEnquiry() {
  if (document.querySelector(".data.enquiry") !== null) {
    document.querySelector(".data.enquiry").remove();
  }
}

function showRowsByNumber(maxData) {
  tbody.innerHTML = "";
  data.forEach((element, index) => {
    index < maxData ? tbody.appendChild(element) : "";
  });
}

showRowsByNumber(show.value);

let index = 0;
next.onclick = function () {
  if (index < tableIndex.length - 1) {
    index++;
    newTable(tableIndex[index]);
    Showing(
      tableIndex[index][0] + 1,
      tableIndex[index][0] + tableIndex[index].length
    );
    generatePagination(index);
  }
};

prev.onclick = function () {
  if (index > 0) {
    index--;
    newTable(tableIndex[index]);
    Showing(
      tableIndex[index][0] + 1,
      tableIndex[index][0] + tableIndex[index].length
    );

    generatePagination(index);
  }
};

function newTable(rowsVis) {
  tbody.innerHTML = "";

  data.forEach((element, ind) => {
    if (rowsVis.includes(ind)) {
      tbody.appendChild(element);
    }
  });
}

function Showing(from, to) {
  if (lang == "ar") {
    info.textContent =
      " عرض " + from + " الى " + to + " من " + data.length + " سجل";
  } else {
    info.textContent =
      " Showing" + from + " to " + to + "  of " + data.length + " entries";
  }
}

function generatePagination(pageNamer) {
  if (document.querySelector(".pagination li.count") !== null) {
    document.querySelectorAll(".pagination li.count").forEach((element) => {
      element.remove();
    });
  }
  tableIndex.forEach((element, index) => {
    li = document.createElement("li");
    li.textContent = index + 1;
    li.className = "count";

    if (index == pageNamer) {
      li.classList.add("active");
    }
    next.before(li);
  });
}
