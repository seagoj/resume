<?php 
    require_once('../lib/Predis/autoloader.php');
    require_once('ImportRedis.php');
    Predis\Autoloader::register();

    $redis = new Predis\Client();
    $map = array('page','contact','section1','section2');
    foreach($map AS $location) {
        $$location = $redis->hgetall('portfolio.'.$location);
    }
    
    function sections() {
        Predis\Autoloader::register();
        $redis = new Predis\Client();
        
        $sectionCount=1;
        $section = $redis->hgetall('portfolio.section'.$sectionCount++);
        while($section) {
            print "<div class='section'>\n";
            key_exists('title',$section) ? print "\t<div class='title'>".$section['title']."</div>\n" : print "";
            key_exists('description',$section) ? print "\t<div class='description'>".$section['description']."</div>\n" : print "";
            if(key_exists("entry1",$section)) {
                $entryCount=1;
                print "\t<ul class='bullet'>\n";
                $entry = key_exists('entry'.$entryCount,$section);
                while($entry) {
                    $current = 'entry'.$entryCount;
                    print "\t\t<li class='entry'>".$section[$current]."</li>\n";
                    $entry = key_exists('entry'.++$entryCount,$section);
                }
                print "\t</ul>\n";
            } else if(key_exists("_entry1",$section)) {
                print "\t<div class='subsection'>\n";
                if(key_exists('_title1',$section)) {
                    $subCount = 1;
                    $sub = key_exists('_title'.$subCount,$section);
                    while($sub) {
                        print "\t<div class='subsection'>\n";
                        print "\t<div class='title'>".$section['_title'.$subCount]."</div>\n";
                        key_exists('_description'.$subCount,$section) ? print "\t<div class='description'>".$section['_description'.$subCount]."</div>\n" : print "";
                        $sub = key_exists('_title'.$subCount,$section);
                        if(key_exists("_entry".$subCount."1",$section)) {
                            $_entryCount=1;
                            print "\t<ul class='bullet'>\n";
                            $entry = key_exists('_entry'.$subCount.$_entryCount,$section);
                            while($entry) {
                                $current = '_entry'.$subCount.$_entryCount;
                                print "\t\t<li class='entry'>".$section[$current]."</li>\n";
                                $entry = key_exists('_entry'.$subCount.++$_entryCount,$section);
                            }
                            print "\t</ul>\n";
                            print "</div>\n";
                            $sub = key_exists('_title'.++$subCount,$section);
                        }
                    }
                }
                print "</div>\n";
            } else {
                $entryCount=1;
                print "<ul class='bullet'>";
                $entry = key_exists('entry'.$entryCount,$section);
                while($entry) {
                    $current = 'entry'.$entryCount;
                    print "<li class='entry'>".$section[$current]."</li>";
                    $entry = key_exists('entry'.++$entryCount,$section);
                }
                print "</ul>\n</div>\n";
            }
            print "</div>\n";
            
            //------------------------------------------------------------//
            $section = $redis->hgetall('portfolio.section'.$sectionCount++); 
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>    
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
        <link href="../lib/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../lib/google-code-prettify/prettify.js"></script>
        <script src="codesample.js" type="text/javascript"></script>
        <title><?= $page['title']?></title>
    </head>
    <body onload="prettyPrint()">
        <div id='contact'>
		<div class='spacer'>&nbsp;</div>
		<div class='spacer'>&nbsp;</div>
		<div id='name'><?= $contact['name']?></div>
		<div class='address'><?= $contact['address1']?></div>
		<div id='phone'><?= $contact['phone']?></div>
		<div id='email'><a href='<?= $contact['email']?>'><?= $contact['email']?></a></div>
                <div class='spacer'>&nbsp;</div>
                <div class='badge'>
                    <a href="http://jigsaw.w3.org/css-validator/check/referer">
                        <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" />
                    </a>
                </div>
	</div>
        <div id='resume'>
        <?php sections(); ?>
            <div id="codesample1">
                <a id="sampleClose">x</a>
                <div class='title'>Code Sample</div>
                <pre class='prettyprint'>
                    <code class='language-php'><?php print file_get_contents('../lib/model/src/model.php'); ?></code>
                </pre>
            </div>
            <div id="shade"></div>
            <div id='footer'>&nbsp;</div>
        </div>
    </body>
</html>