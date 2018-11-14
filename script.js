window.onload=function() {
    document.body.addEventListener('click', function (event) {
        var a = event.target || event.srcElement;
        if (a.tagName === 'A' && (a.classList.contains("wikilink1") || a.classList.contains("wikilink2") || a.classList.contains("breadcrumbs"))) {
            var xy = a.getBoundingClientRect(),
                dx = xy.width - event.offsetX,
                dy = event.offsetY,
                r = parseFloat(window.getComputedStyle(a, ':after')['height'])/2 + 1;
            if (dx*dx + dy*dy < r*r) a.href = (a.href.split('#', 1))[0] + '?do=edit';
        }
    });
};
