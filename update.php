<?php
$dir = __DIR__;

if(!file_exists($dir.'/src/')){
	echo shell_exec('mkdir src');
}

echo shell_exec("
cd ../../
git clone https://github.com/johnbillion/extended-cpts.git
cp extended-cpts/src/* ".$dir."/src/
cp extended-cpts/*.php ".$dir."/
");
//echo shell_exec("git clone https://github.com/johnbillion/extended-cpts.git");
//echo shell_exec("cp extended-cpts/src/* ".$dir."/src/");
//echo shell_exec("cp extended-cpts/*.php ".$dir."/");
//echo shell_exec("rm -r extended-cpts/");
//rmdir($dir.'/extended-cpts/');

echo shell_exec("ls");

date_default_timezone_set( 'UTC' );
$output = shell_exec( 'git log -1' );
$build_number    = getenv( 'TRAVIS_BUILD_NUMBER' );
$gh_token = getenv( 'GH_TOKEN' );

echo shell_exec("cd ".$dir."
git checkout -f master
git config --global user.email \"travis@travis-ci.org\"
git config --global user.name \"Travis CI\"
git add -A
git commit -m \"Travis build: $build_number [skip ci]\"
git remote set-url origin https://$gh_token@github.com/vsp-libs/extended-cpts.git > /dev/null 2>&1
git push origin master -f
");
/*echo shell_exec( 'git config --global user.email "travis@travis-ci.org"' );
echo shell_exec( 'git config --global user.name "Travis CI"' );
echo shell_exec( 'git add -A' );
echo shell_exec( "git commit -m \"Travis build: $build_number [skip ci]\"" );
echo shell_exec( "git remote set-url origin https://$gh_token@github.com/vsp-libs/extended-cpts.git > /dev/null 2>&1" );
echo shell_exec("git push origin master -f");*/
?>
