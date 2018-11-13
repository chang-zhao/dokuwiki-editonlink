window.onload=function() {
    document.body.addEventListener('click', function (event) {
        var a = event.target;
        if (a.classList.contains("wikilink1") || a.classList.contains("wikilink2") || a.classList.contains("breadcrumbs")) {
            var xy = a.getBoundingClientRect(),
                dx = xy.width - event.offsetX,
                dy = event.offsetY;
            if (dx*dx + dy*dy < 169) a.href += '?do=edit';
        }
    });
};
