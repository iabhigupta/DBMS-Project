<?php

/* create you array with banned words for request*/
$arrInjection = array(
"UNION",
"SELECT",
"concat",
"user_password",
"char",
"user_name",
"administrators",
"FROM",
"../",
"etc/",
"script",
"alert",
"passwd",
"session",
"save_path",
"configuration",
"folder"
);

/* make exit if attacks are found from arrInjection */
foreach($arrInjection as $item){
	if(strstr($_SERVER["REQUEST_URI"],$item)){
		exit;
	}

}

/* make exit if attacks are from external website using file txt */
foreach($_REQUEST as $key=>$val){
	if(strstr($val,".txt")){
		exit;
	}
}

/* make exit if attacks are from external website  */
foreach($_POST as $key=>$val){
	if(strstr($val,"http")){
	exit;
	}
}

/* make exit if attacks are from external website  */
foreach($_GET as $key=>$val){
	if(strstr($val,"http")){
	exit;
	}
}

/* CHECK IF IS INTEGER*/
function isInteger($input){
return preg_match('@^[-]?[0-9]+$@',$input) === 1;
}

/* CHECK IF IS STRING*/
function isString($string)
{
	if(ereg('^[A-Za-z_][A-Za-z_]*$', $string))
	{
	return true;
	}
	else
	{
	return false;
	}
}

function onlyDigits ($string)
{
	if (ereg_replace("[^0-9]","",$string)==$string) return 1;
	else return 0;
}

function onlyString ($string)
{
	if (ereg_replace("[a-zA-Z]","",$string)==$string) return 1;
	else return 0;
}


/* VALIDATE GET REQUESTS */
/* make exit if id is not integer  */
if((!isInteger($_GET['id']))&&(isset($_GET['id']))) { exit;}

?>