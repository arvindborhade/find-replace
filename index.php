<?php

/**
 *
 * Find and Replace on Server 
 *
 * This Script is made for find the string from url 
 * and it also have functionality to replace the string 
 *
 * Developed By: Arvind Borhade 
 * Support : arivnd@skyscript.in
 *
 **/

 
 







  echo "Find:".$string = 'http://yloud.in/yodelloud_v2/TechSupportCenters/sitemgr/registration.php'; 
  echo "</br> Replace:".$replace = 'http://yloud.in/yodelloud_v2/';  //Replace Code
  $time=date("Y-m-d_h_i_sa");
  $find = $string; 

/********************************************************************/
  $DoReplace = false; //make it true if need to replace file 
 
/********************************************************************/
 
if($DoReplace){
 $op="Replace";	
}else{
$op="Only Search";
}
  
  
$myfile = fopen($time.".txt", "w") or die("Unable to open file!");

	$txt = "Find:.$string\n";
	fwrite($myfile, $txt);
	$txt = "Replace: $replace \n";
	fwrite($myfile, $txt);
	$txt = "Date: $time \n";
	fwrite($myfile, $txt);
	$txt = "Operation: $op \n";
	fwrite($myfile, $txt);


$i = 0;

$ii = 1;

$rootpath = '/home/yloudovl/public_html/yodelloud_v2/';
$fileinfos = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootpath)
);
foreach($fileinfos as $pathname => $fileinfo) {
    if (!$fileinfo->isFile()) continue;
    $content = file_get_contents($pathname);
	
        //echo "<br /><br />". $i . " : " ;
    if (strpos($content, $string) !== false) {
	
	if($DoReplace){
		$content = str_replace($find, $replace, $content);
		if( !file_put_contents( $pathname, $content ) ){
			echo "There was a problem (permissions?) replacing the file " . $pathname;
		}
		else{
			 echo "<br /><br />". $ii . " : ";
			echo "<div style='color:green;'> File " . $pathname . " replaced!</div>";
				$txt = "File Replaced: $pathname \n";
				fwrite($myfile, $txt);
			$count++;
		}			
	}
	
        echo "<br /><br />". $ii . " : ";
        echo '<div style="color:red;">' . $pathname . "</div>";
				$txt = "File Find on URL: $pathname \n";
				fwrite($myfile, $txt);
        echo "<br /><br />";
		
						
        $ii++;
        
    }
        else 
        {
        //echo $pathname;
        }
        //echo "<br /><br />";
        $i++;
}

fclose($myfile);



?>
