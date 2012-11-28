<?php
namespace seagoj\devtools;

require_once('_include.php');

class PortfolioModel extends Model
{
    public $model;
    
    public function __construct() {
        $this->model = new Model($this);
    }
    public function setContent($contentArray)
    {
        $this->model->setTable('content');
        $this->model->setQueryType('insertupdate');
        $this->model->setColumns(array('section','value'));
        $this->model->setValues($contentArray);
        return $this->model->query();
    }
    public function getContent($conditionArray)
    {
        $this->model->setTable('content');
        $this->model->setQueryType('select');
        $this->model->setColumns(array('value'));
        $this->model->setCondition($conditionArray);
        $result = $this->model->query();
        return $result['value'];
    }
    public function getResume()
    {
        $this->model->setTable('content');
        $this->model->setQueryType('select');
        $this->model->setColumns(array('section'));
        $this->model->setCondition(true);
        $result = $this->model->query();
        
        //var_dump($result);
        $map = array(array(array()));
        
        foreach($result['section'] AS $section) {
            if(strpos($section,'.')) {
                $locationArray = explode('.',$section);
                $depth = count($locationArray);
                for($i=0;$i<$depth;$i++) {
                    $tier = 'tier'.$i;
                    $$tier = $locationArray[$i];
                }
                
                if($tier2==0) {
                    if($tier1==0) {
                        $type = 'header';        
                    }
                    else {
                        $type='subheader';
                    }
                } else {
                    if($tier1==0) {
                        $type = 'entry';
                    }
                    else {
                        $type='subentry';
                    }
                }
                
                $map[$tier0][$tier1][$tier2]=$type;
                /*
                if($depth==2) {
                    if($tier1==0) {
                        if(!isset($map[$tier0]))
                            $map[$tier0]=array();
                        //if(!isset($map[$tier0][$tier1]))
                            $map[$tier0][$tier1]='header';
                    } else {
                        if(!isset($map[$tier0]))
                            $map[$tier0]=array();
                        //if(!isset($map[$tier0][$tier1]))
                            $map[$tier0][$tier1]='entry';
                    }    
                } else if($depth==3) {
                    if($tier2==0) {
                        if(!isset($map[$tier0]))
                            $map[$tier0]=array();
                        if(!isset($map[$tier0][$tier1]))
                            $map[$tier0][$tier1]=array();
                        //if(!isset($map[$tier0][$tier1][$tier2]))
                             $map[$tier0][$tier1][$tier2]='subheader';
                    } else {
                        if(!isset($map[$tier0]))
                            $map[$tier0]=array();
                        if(!isset($map[$tier0][$tier1]))
                            $map[$tier0][$tier1]=array();
                        if(!isset($map[$tier0][$tier1][$tier2]))
                            $map[$tier0][$tier1][$tier2]=array();
                    }
                }
                */


            }
            unset($tier0);
            unset($tier1);
            unset($tier2);
        }
        //var_dump($map);
        //die();
    }
}

//$port=new PortfolioModel();
//$port->getContent(array('section'=>'title'));
//$port->getResume();