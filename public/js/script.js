
jQuery(function ($) {
  $(".accordion-title").on("click", function () {
    // クリックした次の要素のコンテンツを開閉
    $(this).next().slideToggle(200);
    // タイトルにopenクラスをつけ外して矢印の向きを変更
    $(this).toggleClass("open", 200);
  }).next().hide();
});


// $(document).ready(function () {
//   $('.modal').modal('hide');
// });
