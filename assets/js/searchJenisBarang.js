function searchTable() {
    // Ambil input pencarian dari pengguna
    var input = document.getElementById("searchInput").value.toUpperCase();
  
    // Ambil tabel dan baris di tabel
    var table = document.getElementById("myTableJenisBarang");
    var rows = table.getElementsByTagName("tr");
  
    // Loop melalui semua baris tabel, sembunyikan yang tidak sesuai
    for (var i = 0; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      var found = false;
      for (var j = 0; j < cells.length; j++) {
        var cellText = cells[j].textContent.toUpperCase();
        if (cellText.indexOf(input) > -1) {
          found = true;
          break;
        }
      }
      if (found) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
      // tambahkan pengecualian untuk baris thead
      if (rows[i].parentNode.nodeName === "THEAD") {
        rows[i].style.display = "";
      }
    }
  }
  
  document.getElementById("searchInput").addEventListener("keyup", searchTable);
  