<?php
/**
 * Portfolio for Jeremy Seago
 * 
 * @category Seagoj
 * @package  Git
 * @author   Jeremy Seago <seagoj@gmail.com>
 * @license  http://github.com/seagoj/portfolio/LICENSE MIT
 * @link     http://github.com/seagoj/portfolio
 **/
class Git
{
    private $_user;
    private $_host;
    private $_hash;

    public function __construct($user=null,$host='github')
    {
        if ($user!=null) {
            $this->user($user);
            $this->_setHash();
        }

        $this->host($host);
    }
    public function user($user)
    {
        $this->_user = $user;
        $this->_setHash();
    }
    public function listRepos()
    {
        $count = 0;
        $ret = array();
        foreach ($this->repos AS $repo) {
            if ($count++!=0) {
                array_push($ret, $repo->full_name);
            }
        }
        return $ret;
    }
    public function repoInfo($repoName, $tag=null)
    {
        foreach ($this->repos AS $repo) {
            $found = false;
            if ($found = ($repo->full_name==$repoName)) {
                if($tag!=null)
                    return $repo->$tag;
                else
                    return $repo;
            }
        }
        !$found ? die("<div>$repoName NOT found</div>") : print "";
    }
    public function host($host)
    {
        $this->_host = $host;
        if(isset($this->_user))
            $this->_setHash();
    }
    private function _setHash()
    {
        switch($this->_host) {
        case 'github':
            $this->_hash = array('repos_url'=>'https://api.github.com/users/'.$this->_user.'/repos');
            break;
        default:
            die("Host $host is not implemented.");
            break;
        }

        $this->_reposInit();
    }
    private function _reposInit()
    {
        $this->repos = json_decode(file_get_contents($this->_hash['repos_url']));
    }
}

$git = new Git();
$git->user('seagoj');
$list = $git->listRepos();
foreach ($list AS $repo) {
    $info = $git->repoInfo($repo);
    print "<div><a href='".$info->svn_url."'>".$info->name."</a>: ".$info->description." <a href='".$info->svn_url."/raw/master/README.md'>README.md<a></div>";
}