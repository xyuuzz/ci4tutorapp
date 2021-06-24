// Halaman home Siswa
$(document).ready(function () {
  const tambahButton = $(".tambah");

  // tambah button di click
  tambahButton.on("click", () => {
    $(".card-body form").toggleClass("d-none");
    $("table").toggleClass("d-none");

    if ($("table").hasClass("d-none")) {
      $(".card-header h4").html("Tambah Siswa");
      tambahButton.html("List Siswa");
      tambahButton.removeClass("btn-outline-success");
      tambahButton.addClass("btn-outline-secondary");
    } else {
      $(".card-header h4").html("List Siswa");
      tambahButton.html("Tambah Siswa");
      tambahButton.removeClass("btn-outline-secondary");
      tambahButton.addClass("btn-outline-success");
    }
  });

  const editButton = $(".editButton");

  editButton.on("click", () => {
    $(".updateFrom").toggleClass("d-none");
    $(".card").toggleClass("d-none");
  });

});
