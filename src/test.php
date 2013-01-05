<?php
print "<div>BoF</div>";
require_once '../lib/Git.php';

$git = new Git();
$git->user('seagoj');
foreach ($git->listRepos() AS $repo) {
    print "<div>".$git->get($repo, 'name')."</div>";
}

print "EoF";