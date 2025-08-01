function myFunction() {
  var input, filter, table, tr, th, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabelprofil");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    th = tr[i].getElementsByTagName("th")[0];
    if (th) {
      txtValue = th.textContent || th.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function myFunctionfunc() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("inPutbarang");
  filter = input.value.toUpperCase();
  table = document.getElementById("taBelinventaris");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
