// Halaman home Siswa
$(document).ready(function () {
  const tambahButton = $(".tambah");

  // tambah button
  tambahButton.on("click", () => { 
    $(".card-body form").toggleClass("d-none");
    $("table").toggleClass("d-none");
    $(".alert").addClass("d-none");
    $(".card-header form").toggle("d-none");
    $(".paginate-el").toggleClass("d-none");

    if ($("table").hasClass("d-none")) {
      $(".card-header h4").html("Tambah Siswa");
      tambahButton.html("List Siswa");
      tambahButton.removeClass("btn-outline-success");
      tambahButton.addClass("btn-outline-secondary");
    } 
    else {
      $(".card-header h4").html("List Siswa");
      tambahButton.html("Tambah Siswa");
      tambahButton.removeClass("btn-outline-secondary");
      tambahButton.addClass("btn-outline-success");
    }
  });


  // edit button
  const editButton = $(".editButton");

  editButton.on("click", () => {
    $(".updateFrom").toggleClass("d-none");
    $(".card").toggleClass("d-none");
  });


  // Feature Search Student
  const inputSearch = $(".card-header form input");
  inputSearch.on("keyup", () => { // ketika user mengetikan apapun di inputSearch, maka jalankan function
    // lakukan ajax terhadap url search
    $.ajax({
      "url" : `http://localhost:8080/siswa/search`,
      "data" : {
        "query" : inputSearch.val() // kirim data query
      },
      "method" : "POST", // dengan method post
      success : data => {  // jika success
        $("table tbody").html(data);  // ambil element tbody dan timpa dengan data yang dikirmkan oleh url

        // secara default, hilangkan halaman/angka paginate
        $(".paginate-el").addClass("d-none");
        // tapi jika tidak ada apapaun di input search, munculkan lagi halaman/angka paginate nya
        if(!inputSearch.val())
        {
          $(".paginate-el").removeClass("d-none");
        }

      }
    });
  });
});


// image preview, jika user meng-inputkan image pada hal create/edit, maka ubah preview foto
function previewImage()
{
  const inputImage = document.querySelector("#foto_siswa");
  const image = new FileReader();
  image.readAsDataURL(inputImage.files[0]);
  image.onload = e => { // saat image sudah di load, maka :
    $(".img-preview").attr("src", e.target.result);  // ganti value atribut src pada image
  };
}
