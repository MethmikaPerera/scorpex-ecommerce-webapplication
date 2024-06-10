/******** Account Actions (Sign In / Sign Up / Sign Out) ********/
function changeView() {
  var SignUpBox = document.getElementById("signupbox");
  var SignInBox = document.getElementById("signinbox");

  SignUpBox.classList.toggle("d-none");
  SignInBox.classList.toggle("d-none");
}

function signUp() {
  var fn = document.getElementById("fname");
  var ln = document.getElementById("lname");
  var e = document.getElementById("email");
  var pw = document.getElementById("password");
  var m = document.getElementById("mobile");
  var g = document.getElementById("gender");

  var f = new FormData();
  f.append("fname", fn.value);
  f.append("lname", ln.value);
  f.append("email", e.value);
  f.append("password", pw.value);
  f.append("mobile", m.value);
  f.append("gender", g.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        document.getElementById("msg").innerHTML =
          "Account Created Successfully";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msg").className = "alert alert-danger";
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(f);
}

function signIn() {
  var siemail = document.getElementById("signinemail");
  var sipassword = document.getElementById("signinpassword");
  var siremember = document.getElementById("rememberme");

  var f = new FormData();
  f.append("signinemail", siemail.value);
  f.append("signinpassword", sipassword.value);
  f.append("rememberme", siremember.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "index.php";
      } else {
        document.getElementById("simsg").innerHTML = t;
        document.getElementById("simsg").className = "alert alert-danger";
        document.getElementById("simsgdiv").className = "d-block";
      }
    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(f);
}

var bm;
function forgotPassword() {
  var email = document.getElementById("signinemail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        var m = document.getElementById("forgotPasswordModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        Swal.fire({
          title: "Oops...",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  r.send();
}

function resetPassword() {
  var email = document.getElementById("signinemail");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var f = new FormData();
  f.append("e", email.value);
  f.append("np", np.value);
  f.append("rnp", rnp.value);
  f.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        bm.hide();
        Swal.fire({
          title: "Successfully Updated!",
          text: "Your Account Password has been Updated.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          title: "Oops...",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "resetPasswordProcess.php", true);
  r.send(f);
}

function shownp() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    np.type = "password";
    npb.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
}

function showrnp() {
  var rnp = document.getElementById("rnp");
  var rnpb = document.getElementById("rnpb");

  if (rnp.type == "password") {
    rnp.type = "text";
    rnpb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    rnp.type = "password";
    rnpb.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
}

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        window.location = "account-log.php";
      } else {
        Swal.fire({
          title: "Oops",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();
}

/******** Newsletter Actions ********/
function newslettersubs() {
  var newsemail = document.getElementById("newsletteremail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
          Swal.fire({
            title: "Subscribed!",
            text: "Successfully Subscribed to Newsletter.",
            icon: "success",
            confirmButtonText: "Ok",
          });
      } else {
          Swal.fire({
            title: "Already Subscribed!",
            text: "Entered Email Already Exists.",
            icon: "warning",
            confirmButtonText: "Ok",
          });
      }
    }
  };

  r.open("GET", "newsletterProcess.php?e=" + newsemail.value, true);
  r.send();
}

/******** Profile Actions *********/
function updateProfileChangeView() {
  var userDetails = document.getElementById("user-details");
  var userUpdate = document.getElementById("user-update");

  userDetails.classList.toggle("d-none");
  userUpdate.classList.toggle("d-none");
}

function updateProfile() {
  var fname = document.getElementById("user-fname");
  var lname = document.getElementById("user-lname");
  var mobile = document.getElementById("user-mobile");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mobile", mobile.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        Swal.fire({
          title: "Successfully Updated!",
          text: "Your Account has been Updated.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          title: "No Permission",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "userProfileUpdateProcess.php", true);
  r.send(f);
}

var dpmodal;
function updateProfileImgView() {
  var dpm = document.getElementById("profileImageUpdateModal");
  dpmodal = new bootstrap.Modal(dpm);
  dpmodal.show();
}

function updateProfileImg() {
  var newdp = document.getElementById("newdp");

  var f = new FormData();

  var file_count = newdp.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, newdp.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "updated") {
        dpmodal.hide();
        Swal.fire({
          title: "Successfully Updated!",
          text: "Your Profile Image has been Updated.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        dpmodal.hide();
        Swal.fire({
          title: "Error!",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "userProfileImgUpdateProcess.php", true);
  r.send(f);
}

function showcp() {
  var cp = document.getElementById("cp");
  var cpb = document.getElementById("cpb");

  if (cp.type == "password") {
    cp.type = "text";
    cpb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    cp.type = "password";
    cpb.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
}

function shownp() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    np.type = "password";
    npb.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
}

function changeUserPassword() {
  var cp = document.getElementById("cp");
  var np = document.getElementById("np");

  var f = new FormData();

  f.append("cp", cp.value);
  f.append("np", np.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      if (t == "success") {
        Swal.fire({
          title: "Successfully Updated!",
          text: "Your Password has been Updated.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          title: "Error",
          text: t,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "userChangePasswordProcess.php", true);
  r.send(f);
}

function loadAddress() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("addressBody").innerHTML = t;
    }
  };

  r.open("POST", "loadAddressProcess.php", true);
  r.send();
}

function saveAddress() {
  var alertDiv = document.getElementById("addressAlert");

  var tagname = document.getElementById("tagname");
  var no = document.getElementById("no");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var city = document.getElementById("city");
  var district = document.getElementById("district");
  var postal = document.getElementById("postal");

  var f = new FormData();

  f.append("tagname", tagname.value);
  f.append("no", no.value);
  f.append("line1", line1.value);
  f.append("line2", line2.value);
  f.append("city", city.value);
  f.append("district", district.value);
  f.append("postal", postal.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        Swal.fire({
          title: "Address Added!",
          icon: "success",
          confirmButtonText: "Ok",
        });
        loadAddress();
      } else if (t == "exceeded") {
        Swal.fire({
          title: "Can't Add More!",
          text: "Maximum Amount of Addresses Achieved.",
          icon: "error",
          confirmButtonText: "Ok",
        });
      } else {
        alertDiv.classList.remove("d-none");
        alertDiv.innerHTML = t;
      }
    }
  };

  r.open("POST", "saveAddressProcess.php", true);
  r.send(f);
}

function removeAddress(id) {
  var adid = id;

  var f = new FormData();

  f.append("adid", adid);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "removed") {
        Swal.fire({
          title: "Address Removed!",
          icon: "success",
          confirmButtonText: "Ok",
        });
        loadAddress();
      } else {
        Swal.fire({
          title: "Address Unavailable!",
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "removeAddressProcess.php", true);
  r.send(f);
}

/********* Watchlist Actions *******/
function addToWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "added") {
        Swal.fire({
          title: "Successfully Added!",
          text: "Item Added to the Watchlist.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else if (t == "exist") {
        Swal.fire({
          title: "Already Exist!",
          text: "Item is Already in the Watchlist",
          icon: "info",
          confirmButtonText: "Ok",
        });
      } else if (t == "login") {
        Swal.fire({
          icon: "warning",
          title: "No Account",
          text: "Please Login First.",
          footer: '<a href="account-log.php">Click Here to Login or Signup</a>',
        });
      } else {
        Swal.fire({
          icon: "question",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  r.send();
}

function incQty() {
  var qty = document.getElementById("pqty");
  var bqty = document.getElementById("buyqty");
  var newQty = parseInt(qty.value) + 1;

  qty.value = newQty;
  bqty.value = newQty;
}

function decQty() {
  var qty = document.getElementById("pqty");
  var bqty = document.getElementById("buyqty");
  var newQty = parseInt(qty.value) - 1;

  if (newQty > 0) {
    qty.value = newQty;
    bqty.value = newQty;
  } else {
  }
}

function removeFromWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "deleted") {
        Swal.fire({
          title: "Successfully Removed!",
          text: "Item Removed from the Watchlist.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else if (t == "login") {
        Swal.fire({
          icon: "warning",
          title: "No Account",
          text: "Please Login First.",
          footer: '<a href="account-log.php">Click Here to Login or Signup</a>',
        });
      } else {
        Swal.fire({
          icon: "question",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("GET", "removeFromWatchlistProcess.php?id=" + id, true);
  r.send();
}

/******** View Product Actions ********/
var num = document.getElementById("num-product");
num.onkeydown = function (e) {
  if (
    !(
      (e.keyCode > 95 && e.keyCode < 106) ||
      (e.keyCode > 47 && e.keyCode < 58) ||
      e.keyCode == 8
    )
  ) {
    return false;
  }
};

/******** Cart Actions *******/
function addToCart() {
  var pid = document.getElementById("pid");
  var psize = document.getElementById("psize");
  var pqty = document.getElementById("pqty");

  if (pqty.value > 0) {
    var f = new FormData();
    f.append("pid", pid.value);
    f.append("psize", psize.value);
    f.append("pqty", pqty.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4 && r.status == 200) {
        var t = r.responseText;

        if (t == "added") {
          Swal.fire({
            title: "Successfully Added!",
            text: "Item Added to the Cart.",
            icon: "success",
            confirmButtonText: "Ok",
          });
          setTimeout(function () {
            location.reload();
          }, 1500);
        } else if (t == "updated") {
          Swal.fire({
            title: "Successfully Updated!",
            text: "Updated the Item in the Cart.",
            icon: "info",
            confirmButtonText: "Ok",
          });
          setTimeout(function () {
            location.reload();
          }, 1500);
        } else if (t == "qtyerror") {
          Swal.fire({
            title: "Insufficient Availability!",
            text: "Quantity in the stock is insufficient for the order",
            icon: "error",
            confirmButtonText: "Ok",
          });
        } else if (t == "login") {
          Swal.fire({
            icon: "warning",
            title: "No Account",
            text: "Please Login First.",
            footer:
              '<a href="account-log.php">Click Here to Login or Signup</a>',
          });
        } else {
          Swal.fire({
            icon: "question",
            title: "Oops...",
            text: "Something went wrong!",
            confirmButtonText: "Ok",
          });
        }
      }
    };
  } else {
    Swal.fire({
      icon: "error",
      title: "Select a Quantity",
      text: "Please select a correct Quantity.",
      confirmButtonText: "Ok",
    });
  }

  r.open("POST", "addToCartProcess.php", true);
  r.send(f);
}

function removeFromCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "deleted") {
        Swal.fire({
          title: "Successfully Removed!",
          text: "Item Removed from the Cart.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else if (t == "login") {
        Swal.fire({
          icon: "warning",
          title: "No Account",
          text: "Please Login First.",
          footer: '<a href="account-log.php">Click Here to Login or Signup</a>',
        });
      } else {
        Swal.fire({
          icon: "question",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("GET", "removeFromCartProcess.php?id=" + id, true);
  r.send();
}

function loadCart() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var response = r.responseText;
      document.getElementById("cartBody").innerHTML = response;
    }
  };

  r.open("POST", "loadCartProcess.php", true);
  r.send();
}

function incCartQty(cid) {
  var cartid = cid;
  var qty = document.getElementById("qty" + cid);
  var newQty = parseInt(qty.value) + 1;

  var f = new FormData();
  f.append("cid", cartid);
  f.append("qty", newQty);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        loadCart();
      } else if (t == "exceeded") {
        Swal.fire({
          icon: "error",
          title: "Unavailable",
          text: "Maximum Quantity Achieved.",
          confirmButtonText: "Ok",
        });
      } else {
        Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "No Product Found",
          confirmButtonText: "Ok",
        });
      }
    }
  };
  r.open("POST", "updateCartQtyProcess.php", true);
  r.send(f);
}

function decCartQty(cid) {
  var cartid = cid;
  var qty = document.getElementById("qty" + cid);
  var newQty = parseInt(qty.value) - 1;

  var f = new FormData();
  f.append("cid", cartid);
  f.append("qty", newQty);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      loadCart();
    }
  };
  r.open("POST", "updateCartQtyProcess.php", true);
  r.send(f);
}

function showAddress() {
  var id = document.getElementById("shippingAddress").value;
  var address = document.getElementById("showAddress");
  var btn = document.getElementById("showAddressBtn");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "no") {
        Swal.fire({
          title: "No Address Selected!",
          text: "Please select a address to view",
          icon: "warning",
          confirmButtonText: "Ok",
        });
      } else if (t == "login") {
        Swal.fire({
          icon: "warning",
          title: "No Account",
          text: "Please Login First.",
          footer: '<a href="account-log.php">Click Here to Login or Signup</a>',
        });
      } else if (t == "error") {
        Swal.fire({
          icon: "question",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonText: "Ok",
        });
      } else {
        address.innerHTML = t;
      }
    }
  };

  r.open("GET", "showAddressProcess.php?id=" + id, true);
  r.send();
}

/******* Invoice Actions ******/
function printInvoice() {
  var restorepage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorepage;
}

/****** Products Page Actions *****/
function loadProducts(n) {
  var page = n;

  var f = new FormData();
  f.append("p", page);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("pload").innerHTML = t;
    }
  };

  r.open("POST", "loadProductsProcess.php", true);
  r.send(f);
}

function searchProduct(n) {
  var page = n;
  var product = document.getElementById("psearch");

  var f = new FormData();
  f.append("p", product.value);
  f.append("pg", page);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("pload").innerHTML = t;
    }
  };

  r.open("POST", "searchProductProcess.php", true);
  r.send(f);
}

function advancedSearch(n) {
  var page = n;
  var txt = document.getElementById("txt");
  var cat = document.getElementById("cat");
  var mat = document.getElementById("mat");
  var min = document.getElementById("min");
  var max = document.getElementById("max");

  // alert(cat.value);

  var f = new FormData();
  f.append("pg", page);
  f.append("txt",txt.value);
  f.append("cat", cat.value);
  f.append("mat", mat.value);
  f.append("min", min.value);
  f.append("max", max.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("viewarea").innerHTML = t;
    }
  };

  r.open("POST", "advancedSearchProcess.php", true);
  r.send(f);
}

function sendMail() {
  var cmail = document.getElementById("client-mail");
  var cname = document.getElementById("client-name");
  var cmsg = document.getElementById("client-msg");

  var f = new FormData();
  f.append("cmail", cmail.value);
  f.append("cname", cname.value);
  f.append("cmsg", cmsg.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "success") {
        Swal.fire({
          title: "Sent!",
          text: "Your Message Sent Successfully.",
          icon: "success",
          confirmButtonText: "Ok",
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: t,
          confirmButtonText: "Ok",
        });
      }
    }
  };

  r.open("POST", "sendMailProcess.php", true);
  r.send(f);
}