/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

var current_url = location.href;
$(`a[href='${current_url}']`).closest("li").addClass("active");
$(`a[href='${current_url}']`)
  .closest("ul")
  .closest("li")
  .find(".has-dropdown")
  .addClass("toggled")
  .next()
  .slideDown("slow");

$(function () {
  $(".table").DataTable({
    dom: "lBfrtip",
    buttons: ["excel", "pdf", "print"],
    pageLength: 50,
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
  });
});
