// Initialize sideNav
var sideNav = document.querySelector(".sidenav");
M.Sidenav.init(sideNav);

// Initialize Modal
var modal = document.querySelector(".modal");
M.Modal.init(modal);

// initialize Form Select
$(document).ready(function () {
    $("select").formSelect();
    $(".datepicker").datepicker({
        defaultDate: (new Date()).getFullYear(),
        yearRange: [1950, (new Date()).getFullYear()],
        format: "yyyy/mm/dd"
    });
    $(".dropdown-trigger").dropdown();
    $(".collapsible").collapsible();
});
if (document.getElementById('address')) {
    M.textareaAutoResize($("#address"));
}

$(document).ready(function () {
    $('.modal').modal();
});

$(document).ready(function () {
    $('.fixed-action-btn').floatingActionButton();
});

$(document).ready(function () {
    $('.tooltipped').tooltip();
});

$(function () {
    $('#birth_date').on('change #birth_date', function () {
        var $dob = $(this);
        var d = moment($dob.val()).toDate();
        var jy = '元号XX年';
        if (d.toString() !== "Invalid Date") {
            jy = d.toLocaleDateString('ja-JP-u-ca-japanese', {
                year: 'numeric'
            });
        }
        $dob.prev().find('span.jy').text(jy);
    }).change();
})