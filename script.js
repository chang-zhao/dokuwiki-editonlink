window.onload=function() {
    document.body.addEventListener('click', function (event) {
        var a = document.querySelector(':hover');
        if (!a) return;
        if (a.classList.contains("wikilink1") || a.classList.contains("wikilink2")) {
            var xy = a.getBoundingClientRect(),
                dx = xy.right - 12 - event.offsetX,
                dy = event.offsetY;
            if (dx*dx + dy*dy < 169) { a.href += '?do=edit'; }
            console.log(xy);
            console.log(event.offsetX+" * "+event.offsetY+"; dx= "+dx+", dy="+dy);
            console.log(event.target);
        }
        console.log(a);
    });
};
