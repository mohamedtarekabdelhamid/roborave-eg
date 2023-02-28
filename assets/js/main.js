let menu = document.getElementById("menu");
function show_hide() {
    if (menu.hasAttribute("hidden"))
        menu.removeAttribute("hidden");
    else
        menu.setAttribute("hidden", "hidden");
}

let opacity = document.getElementById("opacity"),
    event = document.getElementsByClassName("event-info")[0];
function event_info() {
    opacity.removeAttribute("hidden");
    event.removeAttribute("hidden");
}

function hide_event_info() {
    opacity.setAttribute("hidden", "hidden");
    event.setAttribute("hidden", "hidden");
}

$(document).ready(function() {
    $(".loader").delay(500).fadeOut("slow");
})



$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        dots: false
    });
});

// $("body").niceScroll({
//     cursorwidth:12,
//     cursorcolor: "#f50000",
// })

var scroll = new SmoothScroll('a[href*="#"]', {
	speed: 500,
	speedAsDuration: true,
    offset: 78,
    updateURL: false,
});

let to_top = document.getElementById("to-top");
(function show_to_top() {
    if (window.scrollY > 400) {
        to_top.removeAttribute("style");
    }
    else {
        to_top.setAttribute("style", "display: none");
    }

    setTimeout(show_to_top, 1);
})();