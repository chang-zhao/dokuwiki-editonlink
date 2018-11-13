<?php
/**
 * editonlink
 * Date: 13.11.2018
 */
?>
<html lang="en">
<head>
    <style type="text/css">
        .wikilink1, .wikilink2 {
            position: relative;
        }
        .wikilink1:after, .wikilink2:after {
            width: 24px;
            height: 24px;
            border-radius: 14px;
            padding: 2px;
            border: thin solid #990;
            content: "";
            color: #990;
            margin: 0;
            box-shadow: 0 0 1px #EAEAC0;
            background-color: #FAFAE0;
            background-image: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83 3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75L3 17.25z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            z-index: 100;
            top: 0;
            right: 0;
            visibility: hidden;
            opacity: 0;
            -webkit-transition: all 0.3s ease-out 0.2s;
            -moz-transition: all 0.3s ease-out 0.2s;
            -o-transition: all 0.3s ease-out 0.2s;
            transition: all 0.3s ease-out 0.2s;
        }
        .wikilink1:hover:after, .wikilink2:hover:after {
            visibility: visible;
            opacity: 0.8;
            margin: -0.67em -14px 0 0;

        }
    </style>
</head>
<body>
asasa
<div><a href="/" class="wikilink1">ASSA MASSA</a></div>
masasa
<script>
    window.onload=function() {
        var aaa = document.querySelectorAll('wikilink1'); // , wikilink2
        for (var i = 0; i < aaa.length; i++) {
            aaa[i].setAttribute('href', '/?do=edit');
        }
        document.body.addEventListener('click', function (event) {
            var bbb = document.querySelectorAll(':hover');
            console.log(bbb);
        });
    };
    /*
        body.addEventListener('keydown', function(event) {
            var key = event.keyCode,
                bg = document.body.style.background,
                tmp = bg.lastIndexOf('.jpg'),
                bodyBgNum = bg.slice((tmp-2), tmp);
            bodyBgMax = 50;
            if (key == 33 || key == 34) {
                if (event.shiftKey || event.ctrlKey) return;
                if (event.altKey) {
                    if (key == 34) { // PgDn = next background pic
                        tmp = Number(bodyBgNum);
                        if (tmp == bodyBgMax) {
                            bodyBgNum = "00";
                        } else {
                            bodyBgNum = String( ++tmp );
                        }
                    } else { // PgUp = prev background pic
                        if (bodyBgNum == "00") {
                            bodyBgNum = String(bodyBgMax);
                        } else {
                            tmp = Number(bodyBgNum);
                            bodyBgNum = String(--tmp);
                        }
                    }
                    if ((bodyBgNum).length == 1) bodyBgNum = "0" + bodyBgNum;
                    document.documentElement.style.background = '#65663d url("/lib/tpl/myhome/images/bg/' + bodyBgNum + '.jpg") no-repeat fixed center center / cover';
                    document.body.style.background = '#65663d url("/lib/tpl/myhome/images/bg/' + bodyBgNum + '.jpg") no-repeat fixed center center / cover';
                    return false;
                }
            }
        })
    )

    $("div").click(function(e){
        var $me = $(this),
            width = $me.outerWidth(),
            height = $me.outerHeight(),
            top = $me.position().top,
            left = $me.position().left;

        var len = Math.sqrt(Math.pow(width - e.offsetX, 2) + Math.pow(e.offsetY, 2));

        if (len < 10)
            alert('ding');
    });
    */
</script>
</body>
</html>
