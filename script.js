window.onload=function() {
    document.body.addEventListener('click', editOnLink);
    document.body.addEventListener('contextmenu', editOnLink);
};
function editOnLink(e) {
    var a = e.target || e.srcElement;
    if (a.tagName === 'A' && (a.classList.contains("wikilink1") || a.classList.contains("wikilink2") || a.classList.contains("breadcrumbs"))) {

        // In case of multy-line link, simple getBoundingClientRect wouldn't work well,
        // so we find the spot by adding another element with the same positioning as
        // that ":after" button. Thus we know where the popover button is.
        var v = document.createElement('span');
        v.id = 'plugin__editonlink';
        a.appendChild(v);
        var xy = v.getBoundingClientRect(),
            x = xy.right,
            y = xy.top,                         // x,y = of the popover button center
            xya = a.getBoundingClientRect(),    // the mouse click was related to <a>
            dx = e.offsetX + xya.left - x,      // how far the click was from the button?
            dy = e.offsetY + xya.top - y,
            r = parseFloat(window.getComputedStyle(a, ':after')['height'])/2 + 1;
        if ((dx*dx + dy*dy) < r*r) {
            a.setAttribute('data-editonlink', a.href);      // maybe ctrl-click etc
            a.href = (a.href.split('#'))[0];                // link href (without anchor hash)
            if (a.href.indexOf('?') < 0) a.href += '?do=edit';// add EDIT to the link
            else {
                if (a.href.search(/\bdo=/) < 0) a.href += '&do=edit';
                else a.href.replace(/\bdo=[^&]*/, 'do=edit');
            }
            v.remove();
            a.addEventListener('mouseleave', editOnLinkOut);    // to restore the link back
        }
    }
}
function editOnLinkOut(e) {
    var a = e.target || e.srcElement;
    if (a.tagName !== 'A') return;
    var d = a.getAttribute('data-editonlink');
    if (d) {
        a.href = d;
        a.removeAttribute('data-editonlink');
    }
    a.removeEventListener('mouseleave');
}
