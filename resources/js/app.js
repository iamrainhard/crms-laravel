require('./bootstrap');
require('./script');

// (function ($) {
//     "use strict"; // Start of use strict
//     // Toggle the side dashboard navigation
//     $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
//         $("body").toggleClass("sidebar-toggled");
//         $(".sidebar").toggleClass("toggled");
//         if ($(".sidebar").hasClass("toggled")) {
//             $('.sidebar .collapse').collapse('hide');
//         }
//     });
// })(jQuery);

$("#sidebarToggle, #sidebarToggleTop").click(function () {
    $("body").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
        $('.sidebar .collapse').collapse('hide');
    }else{
        $(".sidebar").removeClass("toggled");
    }
    // $(".sidebar").toggleClass("toggled");
    // if($(".sidebar").hasClass("toggled")){
    //     $('.sidebar .collapse').collapse('hide');
    // }
})
