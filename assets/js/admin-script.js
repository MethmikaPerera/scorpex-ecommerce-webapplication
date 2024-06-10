function adminSignIn() {
  var adminemail = document.getElementById("adminemail");
  var adminpassword = document.getElementById("adminpassword");
  var adminremember = document.getElementById("adminremember");

  var f = new FormData();
  f.append("adminemail", adminemail.value);
  f.append("adminpassword", adminpassword.value);
  f.append("adminremember", adminremember.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "adminPanel.php";
      } else {
        document.getElementById("adminmsg").innerHTML = t;
        document.getElementById("adminmsg").className = "alert alert-danger";
        document.getElementById("adminmsgdiv").className = "d-block";
      }
    }
  };

  r.open("POST", "adminSignInProcess.php", true);
  r.send(f);
}

function adminSignout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "adminSignin.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "adminSignoutProcess.php", true);
  r.send();
}

function adminRegister() {
  var newadfn = document.getElementById("newadminfname");
  var newadln = document.getElementById("newadminlname");
  var newade = document.getElementById("newadminemail");
  var newadpw = document.getElementById("newadminpassword");

  var f = new FormData();
  f.append("newadminfname", newadfn.value);
  f.append("newadminlname", newadln.value);
  f.append("newadminemail", newade.value);
  f.append("newadminpassword", newadpw.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        document.getElementById("newadminmsg").innerHTML =
          "Account Created Successfully";
        document.getElementById("newadminmsg").className =
          "alert alert-success";
        document.getElementById("newadminmsgdiv").className = "d-block";
      } else {
        document.getElementById("newadminmsg").innerHTML = t;
        document.getElementById("newadminmsg").className = "alert alert-danger";
        document.getElementById("newadminmsgdiv").className = "d-block";
      }
    }
  };

  r.open("POST", "adminRegisterProcess.php", true);
  r.send(f);
}

function addProduct() {
  var title = document.getElementById("addproducttitle");
  var description = document.getElementById("addproductdescription");
  var category = document.getElementById("addproductcategory");
  var material = document.getElementById("addproductmaterial");
  var price = document.getElementById("addproductprice");
  var image = document.getElementById("addproductimg");

  var f = new FormData();

  f.append("title", title.value);
  f.append("description", description.value);
  f.append("category", category.value);
  f.append("material", material.value);
  f.append("price", price.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        Swal.fire({
          title: "Successfully Added!",
          text: "Item Added to the Store.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          title: "Error Occured",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "addProductProcess.php", true);
  r.send(f);
}

function addStock(sid) {
  var pid = document.getElementById("addproductid");
  var stockqty = document.getElementById(sid + "stockqty");

  var f = new FormData();

  f.append("pid", pid.value);
  f.append("sid", sid);
  f.append("stockqty", stockqty.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Stock Added.",
        });
      } else {
        Swal.fire({
          title: "Error Occured",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "addStockProcess.php", true);
  r.send(f);
}

function loadSizeQtyUpdate() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("sqtydiv").innerHTML = t;
    }
  };

  r.open("POST", "loadSizeQtyUpdate.php", true);
  r.send();
}

function updateStock(sid) {
  var pid = document.getElementById("addproductid");
  var stockqty = document.getElementById(sid + "stockqty");

  var f = new FormData();

  f.append("pid", pid.value);
  f.append("sid", sid);
  f.append("stockqty", stockqty.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Stock Updated.",
        });
      } else {
        Swal.fire({
          title: "Error Occured",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "updateStockProcess.php", true);
  r.send(f);
}

function updateProduct() {
  var id = document.getElementById("productid");
  var title = document.getElementById("producttitle");
  var description = document.getElementById("productdescription");
  var category = document.getElementById("productcategory");
  var material = document.getElementById("productmaterial");
  var price = document.getElementById("productprice");
  var image = document.getElementById("productimg");

  var f = new FormData();

  f.append("id", id.value);
  f.append("title", title.value);
  f.append("description", description.value);
  f.append("category", category.value);
  f.append("material", material.value);
  f.append("price", price.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, image.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Stock Updated.",
        });
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "warning",
          title: t,
        });
      }
    }
  };

  r.open("POST", "updateProductProcess.php", true);
  r.send(f);
}

function loadActiveProducts() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("activeproducts").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadActiveProductsProcess.php", true);
  r.send();
}

function loadDeactiveProducts() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("deactiveproducts").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadDeactiveProductsProcess.php", true);
  r.send();
}

function loadProducts() {
  loadActiveProducts();
  loadDeactiveProducts();
}

var activeview = document.getElementById("activeproducts");
var deactiveview = document.getElementById("deactiveproducts");
var activeviewbtn = document.getElementById("activeproductsbtn");
var deactiveviewbtn = document.getElementById("deactiveproductsbtn");
function changeDeactiveView() {
  activeview.classList.add("d-none");
  deactiveview.classList.remove("d-none");
  activeviewbtn.classList.remove("btn-dark");
  activeviewbtn.classList.add("btn-outline-dark");
  deactiveviewbtn.classList.remove("btn-outline-dark");
  deactiveviewbtn.classList.add("btn-dark");
}

function changeActiveView() {
  deactiveview.classList.add("d-none");
  activeview.classList.remove("d-none");
  deactiveviewbtn.classList.remove("btn-dark");
  deactiveviewbtn.classList.add("btn-outline-dark");
  activeviewbtn.classList.remove("btn-outline-dark");
  activeviewbtn.classList.add("btn-dark");
}

function deactiveProduct(pid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Deactivated Product",
        });
        loadProducts();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Something went wrong",
        });
        loadProducts();
      }
    }
  };

  r.open("GET", "deactiveProductProcess.php?id=" + pid, true);
  r.send();
}

function activeProduct(pid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Deactivated Product",
        });
        loadProducts();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Something went wrong",
        });
        loadProducts();
      }
    }
  };

  r.open("GET", "activeProductProcess.php?id=" + pid, true);
  r.send();
}

var activeuser = document.getElementById("activeusers");
var deactiveuser = document.getElementById("blockedusers");
function changeBlockedView() {
  activeuser.classList.add("d-none");
  deactiveuser.classList.remove("d-none");
}

function changeUserView() {
  deactiveuser.classList.add("d-none");
  activeuser.classList.remove("d-none");
}

function loadActiveUsers() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("activeusers").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadActiveUsersProcess.php", true);
  r.send();
}

function loadBlockedUsers() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("blockedusers").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadBlockedUsersProcess.php", true);
  r.send();
}

function loadUserViewBtn() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("userViewBtn").innerHTML = t;
    }
  };

  r.open("POST", "loadUserViewBtn.php", true);
  r.send();
}

function loadUsers() {
  loadUserViewBtn();
  loadActiveUsers();
  loadBlockedUsers();
}

function blockUser(uid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Blocked User",
        });
        loadUsers();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Something went wrong",
        });
        loadUsers();
      }
    }
  };

  r.open("GET", "blockUserProcess.php?id=" + uid, true);
  r.send();
}

function unblockUser(uid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Unblocked User",
        });
        loadUsers();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Something went wrong",
        });
        loadUsers();
      }
    }
  };

  r.open("GET", "unblockUserProcess.php?id=" + uid, true);
  r.send();
}

function loadSearchUsers() {
  var email = document.getElementById("searchmail").value;

  if (email != "") {
    var f = new FormData();
    f.append("email", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4 && r.status == 200) {
        var t = r.responseText;
        document.getElementById("searchusers").classList.remove("d-none");
        document.getElementById("searchusers").innerHTML = t;
      }
    };

    r.open("POST", "adminSearchUsersProcess.php", true);
    r.send(f);
  }
}

function loadCategory() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("categorydiv").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadCategoryProcess.php", true);
  r.send();
}

function loadMaterial() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("materialdiv").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadMaterialProcess.php", true);
  r.send();
}

function addProductLoad() {
  loadCategory();
  loadMaterial();
}

function loadNoStockProducts() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("productiddiv").innerHTML = t;
    }
  };

  r.open("POST", "adminLoadNoStockProductsProcess.php", true);
  r.send();
}

function addNewCategory() {
  var newcat = document.getElementById("newcategory");

  var f = new FormData();
  f.append("newcat", newcat.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "New Category Added.",
        });
        addProductLoad();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Type Category Name You Want to Add",
        });
        addProductLoad();
      }
    }
  };

  r.open("POST", "addCategoryProcess.php", true);
  r.send(f);
}

function addNewMaterial() {
  var newmat = document.getElementById("newmaterial");

  var f = new FormData();
  f.append("newmat", newmat.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "New Material Added.",
        });
        newmat.setAttribute("value", "");
        addProductLoad();
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Type Material Name You Want to Add",
        });
        addProductLoad();
      }
    }
  };

  r.open("POST", "addMaterialProcess.php", true);
  r.send(f);
}

function updateNewCategory() {
  var newcat = document.getElementById("newcategory");

  var f = new FormData();
  f.append("newcat", newcat.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "New Category Added.",
        });
        newcat.setAttribute("value", "");
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Type Category Name You Want to Add",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      }
    }
  };

  r.open("POST", "addCategoryProcess.php", true);
  r.send(f);
}

function updateNewMaterial() {
  var newmat = document.getElementById("newmaterial");

  var f = new FormData();
  f.append("newmat", newmat.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "New Material Added.",
        });
        newmat.setAttribute("value", "");
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 2000,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "error",
          title: "Type Material Name You Want to Add",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      }
    }
  };

  r.open("POST", "addMaterialProcess.php", true);
  r.send(f);
}

function loadChart(chartId, apiUrl, chartType, chartTitle) {
  const ctx = document.getElementById(chartId);
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var response = JSON.parse(request.responseText);
      new Chart(ctx, {
        type: chartType,
        data: {
          labels: response.labels,
          datasets: [
            {
              label: chartTitle,
              data: response.data,
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  };
  request.open("POST", apiUrl, true);
  request.send();
}

document.addEventListener("DOMContentLoaded", function () {
  loadChart("mostSoldChart","loadMostSoldProducts.php","pie","Most Sold Products");
  loadChart("mostCatChart","loadMostSoldCategories.php","pie","Most Sold Categories");
  loadChart("userGendChart", "loadUserGender.php", "pie", "User Gender");
});

function printPage() {
  var restorepage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.classList.remove("bg-dark");
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorepage;
}