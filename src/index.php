<?php
/**
 * Portfolio for Jeremy Seago
 * 
 * @category Seagoj
 * @package  Portfolio
 * @author   Jeremy Seago <seagoj@gmail.com>
 * @license  http://github.com/seagoj/portfolio/LICENSE MIT
 * @link     http://github.com/seagoj/portfolio
 **/

namespace Seagoj\Resume;

require_once 'autoloader.php';

$portfolio = new \Portfolio();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">    
<html lang='en' xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>    
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
        <meta name=”viewport” content=”width=device-width, initial-scale=1.0″ />
        <script src="secure.php?file=analytics.js" type="text/javascript"></script>
        <link href="secure.php?file=google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
        <script src="secure.php?file=google-code-prettify/prettify.js" type="text/javascript" ></script>
        <script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
        <script src="secure.php?file=codesample.js" type="text/javascript"></script>
        <link href="secure.php?file=bootstrap/docs/assets/css/bootstrap.css" rel="stylesheet">
        <link href="secure.php?file=bootstrap/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="secure.php?file=style.css" rel="stylesheet" type="text/css" />
        <link  href="secure.php?file=font-asap.css" rel="stylesheet" type="text/css" >
        
        <title>Jeremy Seago: Portfolio</title>
    </head>
    <body onload="prettyPrint()">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2">
                    <div id='contact' class="well sidebar-nav">
                        <?php
                            $portfolio->contact();
                        ?>
                    </div>
                </div>
                <div class="span10">
                    <div id='resume' class="row-fluid" >
                        <?php
                            $portfolio->body();
                            $portfolio->projects();
                        ?>
                        <div id='footer'>&nbsp;</div>
                    </div>
                    <div id="shade" style='background-color: gray;opacity=100%'>&nbsp;</div>
                    

                </div>
            </div>
        </div>
        <script src="secure.php?file=bootstrap/docs/assets/js/jquery.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-transition.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-alert.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-modal.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-scrollspy.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-tab.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-tooltip.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-popover.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-button.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-carousel.js"></script>
        <script src="secure.php?file=bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
    </body>
</html>
