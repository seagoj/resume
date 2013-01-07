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

namespace Seagoj\Portfolio;
// require_once 'ImportRedis.php';
// require_once '../lib/Devtools/Markdown.php';
//require_once 'git.php';
require_once 'autoloader.php';

/**
 * Class Portfolio
 *
 * @category Seagoj
 * @package  Portfolio
 * @author   Jeremy Seago <seagoj@gmail.com>
 * @license  http://github.com/seagoj/portfolio/LICENSE MIT
 * @link     http://github.com/seagoj/portfolio
 */
class Portfolio
{
    //private $_dbg;
    private $_redis;
    
    /**
     * Portfolio Constructor
     */
    public function __construct()
    {
        $this->_redis = new Predis\Client();
        // $this->_dbg = new \Devtools\Dbg($this);
        
        $this->page = $this->_getSection("portfolio.page");
        $this->map = explode(",", $this->page['map']);
        
        foreach ($this->map AS $location) {
            $this->$location = $this->_redis->hgetall('portfolio.'.$location);
        }
    }

    /**
     * Portfolio.body()
     *
     * Prints the body of the portfolio
     *
     * @return void
     **/
    public function body()
    {
        $md = new Markdown();
        $md->convert('../lib/Portfolio.md');

        /*
        $count = 1;
        while (isset($this->{'section'.$count})) {
            $this->_printSection('section'.$count++);
        }
        */
    }

    /**
     * Portfolio.contact()
     *
     * Prints the contact section of the portfolio
     *
     * @return void
     **/
    public function contact()
    {
        $contact = $this->_getSection('portfolio.contact');

        print "<div id='name'><span class='icon'></span>".$contact['name']."</div>"
            ."<div id='address'><span class='icon'></span>".$contact['address1']."</div>"
            ."<div id='citystatezip'><span class='icon'></span>".$contact['city'].", ".$contact['state']." ".$contact['zip']."</div>"
            ."<div id='phone'><span class='icon'></span>".$contact['phone']."</div>"
            ."<div id='email'><span class='icon'></span><a href='mailto:".$contact['email']."'>".$contact['email']."</a></div>"
            ."<div id='github'><span class='icon'></span>".$contact['github']."</div>"
            //."<div class='badge'>"
            //."<a href='http://jigsaw.w3.org/css-validator/check/referer'>"
            //."<img style='border:0;width:88px;height:31px' src='http://jigsaw.w3.org/css-validator/images/vcss-blue' alt='Valid CSS!' />"
            //."</a>"
            //."</div>"
            ;
    }

    /**
     * Portfolio.projects()
     *
     * Prints the projects from GitHub
     *
     * @return void
     **/
    public function projects()
    {
        include_once '../lib/Git.php';
        $git = new Git();
        print "<div>before set user</div>";
        $git->user('seagoj');
        print "<div>before list</div>";
        $list = $git->listRepos();
        die(var_dump($list));
        print "<div class='well span10'><h3>Current projects</h3>\n";
        // print "<ul>";
        // $count = 1;
        // foreach ($list AS $repo) {
        //     $name = $git->get($repo, 'name');
        //     $url = $git->get($repo, 'svn_url');
        //     if (substr($repo, strpos($repo, '/')+1, 9)=='cookbook-') {
        //         $link = $url.'/raw/master/recipes/default.rb';
        //     } else {
        //         $link = $url.'/raw/master/src/index.php';
        //     }
        
        //     $code = file_get_contents($link);
            
        //     print '<div id="codesample'.$count.'">'
        //         .'<a class="sampleClose">x</a>'
        //         .'<div class="title">Code Sample</div>'
        //         .'<pre class="prettyprint">'
        //         .'<code class="language-php">'.$code."</code></pre></div>";
        //     print "<li><span class='project'><a id='sample".$count++."' href='#'>".strtoupper($info->name)."</a></span>:".$info->description." <br /><!--//<a href='".$info->svn_url."/raw/master/README.md'>README.md<a>//--></li>";
        // }
        // print "</ul>";
        print "</div>";
    }

    /**
     * Portfolio._printSection()
     *
     * Prints a single section of the body
     *
     * @param string $map Hash for the section to be printed
     *
     * @return  void
     **/
    private function _printSection($map)
    {
        //print "<div class='section'>";
        print '<div class="well span10">';
        $this->_sectionTitle($map);
        $this->_sectionDescription($map);
        $this->_sectionEntries($map);
        
        if ($this->_hasSubsection($map)) {
            $this->_printSubsections($map);
        }
        print '</div>';
    }

    /**
     * Portfolio._hasSubsection()
     *
     * Prints a single section of the body
     *
     * @param string $map Hash for the current section
     *
     * @return  bool True: subsection exists; False: Subsection does not exist
     **/
    private function _hasSubsection($map)
    {
        return key_exists('_title11', $this->$map);
    }

    /**
     * Portfolio._getSection()
     *
     * Prints a single section of the body
     *
     * @param string $tag Index of redis hash for the section to be retrieved
     *
     * @return  void
     **/
    private function _getSection($tag)
    {
        return $this->_redis->hgetall($tag);
    }

    /**
     * Portfolio._section()
     *
     * Prints a single section of the body
     *
     * @param string $map Hash for the current section
     * @param string $key Index that refers to the section title
     *
     * @return  void
     **/
    private function _sectionTitle($map,$key = 'title')
    {
        $ret = $this->$map;
        //print "\t<div class='title'>".$ret[$key]."</div>\n";
        print "\t<h3>".$ret[$key]."</h3>\n";
    }

    /**
     * Portfolio._subTitle()
     *
     * Prints the title for the current subsection
     *
     * @param string $map Hash for the current subsection
     * @param string $key Index for subtitle
     *
     * @return  void
     **/
    private function _subTitle($map, $key='_title11')
    {
        print "\t<div class='subsection'>\n";
        $this->_sectionTitle($map, $key);
        //die("map: $map; key: $key");
    }

    /**
     * Portfolio._sectionDescription()
     *
     * Prints the description line of the current section
     *
     * @param string $map Hash for the current section
     * @param string $key Index that refers to the section description
     *
     * @return  void
     **/
    private function _sectionDescription($map,$key='description')
    {
        $ret = $this->$map;
        //print "\t<div class='description'>".$ret[$key]."</div>\n";
        print "\t<h4>".$ret[$key]."</h4>\n";
    }

    /**
     * Portfolio._subDescription()
     *
     * Prints the description line of the current subsection
     *
     * @param string $map Hash for the current subsection
     * @param string $key Index for subdescription
     *
     * @return  void
     **/
    private function _subDescription($map,$key='_description11')
    {
        $this->_sectionDescription($map, $key);
    }

    /**
     * Portfolio._sectionEntries()
     *
     * Prints the entries of the current section
     *
     * @param string $map Hash for the current section
     * @param string $key Index that refers to the section entries
     *
     * @return  void
     **/
    private function _sectionEntries($map,$key='entry')
    {
        $count = 1;
        $ret = $this->$map;
        print "\t<ul class='bullet'>\n";
        while ($entry = $ret[$key.$count++]) {
            print "\t\t<li class='entry'>$entry</li>\n";
        }
        print "\t</ul>\n";
    }

    /**
     * Portfolio._subEntries()
     *
     * Prints the entries for the current subsection
     *
     * @param string $map Hash for the current subsection
     * @param string $key Index for subentries
     *
     * @return  void
     **/
    private function _subEntries($map, $key)
    {
        $this->_sectionEntries($map, $key);
        print "</div>\n";
    }

    /**
     * Portfolio._printSubSections()
     *
     * Prints the current subsection
     *
     * @param string $map Hash for the current subsection
     *
     * @return  void
     **/
    private function _printSubsections($map)
    {
        $count = 1;
        
        while (array_key_exists('_title'.$count.'1', $this->$map) || array_key_exists('_description'.$count.'1', $this->$map)) {
            if (array_key_exists('_title'.$count.'1', $this->$map))
                $this->_subTitle($map, '_title'.$count.'1');
            if (array_key_exists('_description'.$count.'1', $this->$map))
                $this->_subDescription($map, '_description'.$count.'1');
            $this->_subEntries($map, '_entry'.$count++);
        }
    }
}

$portfolio = new Portfolio();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">    
<html lang='en' xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>    
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
      
        <link href="secure.php?file=google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
        <script src="secure.php?file=google-code-prettify/prettify.js" type="text/javascript" ></script>

      
        <script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
        <script src="secure.php?file=codesample.js" type="text/javascript"></script>
        
      
        <link href="secure.php?file=bootstrap/docs/assets/css/bootstrap.css" rel="stylesheet">
        <link href="secure.php?file=bootstrap/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <link href="secure.php?file=style.css" rel="stylesheet" type="text/css" />
        <link  href="http://fonts.googleapis.com/css?family=Anonymous+Pro:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css" >
        
        <title>Jeremy Seago: Portfolio</title>
    </head>
    <body onload="prettyPrint()">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2">
                    <div id='contact' class="well sidebar-nav">
                        <?php $portfolio->contact() ?>
                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span10">
                    <div id='resume' class="row-fluid" >
                        <?php
                            $md = new \Devtools\Markdown();
                            print $md->convert('../lib/Portfolio.md');

                            $portfolio->body();
                            $portfolio->projects();
                        ?>                        
                        <div id='footer'>&nbsp;</div>
                    </div>
                    <div id="shade" style='background-color: blue;opacity=100%'>&nbsp;</div>
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
