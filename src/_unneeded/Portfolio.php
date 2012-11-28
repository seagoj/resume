<?php
namespace seagoj\devtools;
require_once('_include.php');

class Portfolio
{
    public $portModel;
    
    public function __construct()
    {
        $this->portModel = new PortfolioModel();
    }
    public function getBody()
    {
        
    }
    public function getNameplate()
    {
        
    }
    public function getSidebar()
    {
        
    }
    public function getResume()
    {
        $this->portModel->getResume();
    }
    public function getContent($section)
    {
        print $this->portModel->getContent(array('section'=>$section));
    }
}

//$test = new Portfolio();
//print $test->getContent('title');