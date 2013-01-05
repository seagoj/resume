<?php

class Markdown
{
    public function __construct()
    {

    }
    public function convert($file)
    {
        $code = file_get_contents($file);

        $first = true;

        foreach (explode("\n", $code) AS $line) {
            if ($line!="") {

                $tag = substr($line, 0, strpos($line, ' '));
                $string = substr($line, strpos($line, ' ')+1);

                switch($tag) {
                case '###':
                    if (!$first) {
                        print "</ul>";
                        $first = true;
                    }
                    print "<div class='well span10'><h3>$string</h3>";
                    break;
                case '####':
                    if (!$first) {
                        print "</ul>";
                        $first = true;
                    }
                    print "<h4>$string</h4>";
                    break;
                case '#####':
                    if (!$first) {
                        print "</ul>";
                        $first = true;
                    }
                    print "<h5>$string</h5>";
                    break;
                case '*':
                    if ($first) {
                        $first = false;
                        print "<ul>";
                    }
                    print "<li>$string</li>";
                    break;
                }
            } else {
                if (!$first) {
                    $first = true;
                }
                print "</div>";
            }
        }
    }
}