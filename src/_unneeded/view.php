<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
<link href="secure.php?google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<link href="secure.php?file=style.css" type="text/css" rel="stylesheet"   />
<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="secure.php?google-code-prettify/prettify.js" type="text/javascript" ></script>
<script src="secure.php?file=codesample.js" type="text/javascript"></script>
<title>%page.title%</title>
    </head>
    <body onload="prettyPrint()">
        <div id='contact'>
        	%contact%
		</div>
        <div id='resume'>
        	%body%
            <div id="codesample1">
                <a id="sampleClose">x</a>
                <div class='title'>Code Sample</div>
                <pre class='prettyprint'>
                    <code class='language-php'><?php print file_get_contents('../lib/model/src/model.php'); ?></code>
                </pre>
            </div>
            <div id="shade"></div>
            <div id='footer'>%footer%</div>
        </div>
    </body>
</html>