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
            border: thin solid #990;
            content: url("data:image/svg+xml;utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83 3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75L3 17.25z'%3E%3C/path%3E%3C/svg%3E");
            color: #990;
            padding: 2px;
            margin: 0;
            box-shadow: 0 0 1px #EAEAC0;
            background-color: #FAFAE0;
            position: absolute;
            z-index: 100;
            top: 0;
            right: 0;
            max-width: 24px;
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
</body>
</html>
