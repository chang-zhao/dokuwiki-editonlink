<?php
/**
 * EditOnLink plugin
 * Test file
 * @author Constant Illumination (Chang Zhao) <alex@obschy.ru>
 * Date: 13.11.2018
 */
?>
<html lang="en">
<head>
    <title>EditOnLink Test</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body style="padding-left:6em;<?php if($_GET['do']=='edit')
    echo 'color:#369; background:#FFFFCC;'; ?>" class="dokuwiki">
<?php echo '$_GET = '.htmlspecialchars(var_export($_GET, true), ENT_QUOTES); ?>
<p id="top">Hover this link; see an animated<br>
decoration and a popover button.</p>
<div><a href="test.php" class="wikilink1">LINK TO TEST.PHP</a></div>
<p>Clicking that button must turn URL<br>
"test.php" into "test.php?do=edit".</p>
<p> <a href="test.php#top" class="breadcrumbs" style="font-size: x-small">breadcrumbs</a> *
    <a href="test.php?do=oops" class="breadcrumbs" style="font-size: small">breadcrumbs</a> *
    <a href="test.php?do=oops#top" class="wikilink2" style="font-size: large; color: red;">wikilink2</a></p>
</body>
</html>
