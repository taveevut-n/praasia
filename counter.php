<?
/*
Counter Information

Website: http://www.free-php-counter.com/
Version: Text version

Installation help:

http://www.free-php-counter.com/text-counter.php


You like to remove the link on the counter? Click here and get an link free license:

http://www.free-php-counter.com/adfree_counter.php
*/


// edit counter settings here


// absolut path to the folder containing counter.php and counter.gif (ÍÂèÒÅ×ÁÁÕ / »Ô´·éÒÂ´éÇÂ)
// use $_SERVER['DOCUMENT_ROOT'] . "/" when the counter is in root dir
/* use <? echo dirname($_SERVER['SCRIPT_FILENAME']) . "/"; ?> to get absolute path */
$counter_path_absolut = dirname($_SERVER['SCRIPT_FILENAME'])."/";

// http path to the folder containing counter.php and counter.gif (ÍÂèÒÅ×ÁÁÕ / »Ô´·éÒÂ´éÇÂ)
// set http://www.your-homepage.com/ when the counter is in root dir
$counter_path_http = "http://ctydatas.site90.com/scripts/counter_useronline_text/";

// IP-lock in seconds
$counter_expire = 600;


// do not edit from here

$counter_filename = $counter_path_absolut . "counter.txt";

if (file_exists($counter_filename)) 
{
   $ignore = false;
   $current_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "no agent";
   $current_time = time();
   $current_ip = $_SERVER['REMOTE_ADDR']; 
      
   // daten einlesen
   $c_file = array();
   $handle = fopen($counter_filename, "r");
   
   if ($handle)
   {
      while (!feof($handle)) 
      {
         $line = trim(fgets($handle, 4096)); 
		 if ($line != "")
		    $c_file[] = $line;		  
      }
      fclose ($handle);
   }
   else
      $ignore = true;
   
   // bots ignorieren   
   if (substr_count($current_agent, "bot") > 0)
      $ignore = true;
	  
   
   // hat diese ip einen eintrag in den letzten expire sec gehabt, dann igornieren?
   for ($i = 1; $i < sizeof($c_file); $i++)
   {
      list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
	  $counter_time = trim($counter_time);
	  
	  if ($counter_ip == $current_ip && $current_time-$counter_expire < $counter_time)
	  {
	     // besucher wurde bereits gezählt, daher hier abbruch
		 $ignore = true;
		 break;
	  }
   }
   
   // counter hochzählen
   if ($ignore == false)
   {
      if (sizeof($c_file) == 0)
      {
	     // wenn counter leer, dann füllen      
		 $add_line1 = date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time . "\n";
		 $add_line2 = $current_ip . "||" . $current_time . "\n";
		 
		 // daten schreiben
		 $fp = fopen($counter_filename,"w+");
		 if ($fp)
         {
		    flock($fp, LOCK_EX);
			fwrite($fp, $add_line1);
		    fwrite($fp, $add_line2);
			flock($fp, LOCK_UN);
		    fclose($fp);
		 }
		 
		 // werte zur verfügung stellen
		 $day = $yesterday = $week = $month = $year = $all = $record = 1;
		 $record_time = $current_time;
		 $online = 1;
	  }
      else
	  {
	     // counter hochzählen
		 list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
		 
		 $day_data = explode(":", $day_arr);
		 $yesterday_data = explode(":", $yesterday_arr);
		 		 
		 // yesterday
		 $yesterday = $yesterday_data[1];
		 if ($day_data[0] == (date("z")-1)) 
	     {
	        $yesterday = $day_data[1]; 
	     }
	     else
	     {
	        if ($yesterday_data[0] != (date("z")-1))
		    {
		       $yesterday = 0; 
		    }
	     }
		 
		 // day
		 $day = $day_data[1];
		 if ($day_data[0] == date("z")) $day++; else $day = 1;
		 
		 // week
		 $week_data = explode(":", $week_arr);
		 $week = $week_data[1];
		 if ($week_data[0] == date("W")) $week++; else $week = 1;
		 
		 // month
		 $month_data = explode(":", $month_arr);
		 $month = $month_data[1];
		 if ($month_data[0] == date("n")) $month++; else $month = 1;
		 
		 // year
		 $year_data = explode(":", $year_arr);
		 $year = $year_data[1];
		 if ($year_data[0] == date("Y")) $year++; else $year = 1;
		  
		 // all
		 $all++;
		 
		 // neuer record?
		 $record_time = trim($record_time);
		 if ($day > $record)
		 {
		    $record = $day;
			$record_time = $current_time;
		 }
		 
		 // speichern und aufräumen und anzahl der online leute bestimmten
		 
		 $online = 1;
		 
		 // daten schreiben
		 $fp = fopen($counter_filename,"w+");
		 if ($fp)
         {
		    flock($fp, LOCK_EX);
			$add_line1 = date("z") . ":" . $day . "||" . (date("z")-1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";		 
		    fwrite($fp, $add_line1);
		 
		    for ($i = 1; $i < sizeof($c_file); $i++)
            {
               list($counter_ip, $counter_time) = explode("||", $c_file[$i]);
	  
	           // übernehmen
		   	   if ($current_time-$counter_expire < $counter_time)
	           {
	              $counter_time = trim($counter_time);
				  $add_line = $counter_ip . "||" . $counter_time . "\n";
			      fwrite($fp, $add_line);
			      $online++;
	           }
            }
		    $add_line = $current_ip . "||" . $current_time . "\n";
		    fwrite($fp, $add_line);
		    flock($fp, LOCK_UN);
		    fclose($fp);
	     }
	  }
   }
   else
   {
      // nur zum anzeigen lesen
	  if (sizeof($c_file) > 0)
	     list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
	  else
		 list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" .  date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $current_time);
	  
	  // day
	  $day_data = explode(":", $day_arr);
      $day = $day_data[1];
	  
	  // yesterday
	  $yesterday_data = explode(":", $yesterday_arr);
      $yesterday = $yesterday_data[1];
	  
	  // week
	  $week_data = explode(":", $week_arr);
	  $week = $week_data[1];
	
	  // month
	  $month_data = explode(":", $month_arr);
	  $month = $month_data[1];
	  
	  // year
	  $year_data = explode(":", $year_arr);
	  $year = $year_data[1];
	  
	  $record_time = trim($record_time);
	  
	  $online = sizeof($c_file) - 1;
   }
?>
<table cellpadding="1" cellspacing="0" style="border:1px solid #000000">
  <tr> 
    <td width="150" bgcolor="#323030"><img src="images/counter.gif" alt="Ad" width="16" height="16" border="0" /></a><span style="color:#FFF">ผู้เยี่ยมชม</span></b>
    </td>
  </tr>
  <tr> 
    <td style="border-top:1px solid #000000"> 
      <font face="Arial, Helvetica, sans-serif" size="1">
      &raquo; <? echo $online; ?> คน ขณะนี้<br />
      &raquo; <? echo $day; ?> คน ในวันนี้<br />
      &raquo; <? echo $yesterday; ?> คน เมื่อวานนี้<br />
	  &raquo; <? echo $week; ?> คน ในสัปดาห์นี้<br />
	  &raquo; <? echo $month; ?> คน ในเดือนนี้<br />
	  &raquo; <? echo $year; ?> คน ในปีนี้<br />
      &raquo; <? echo $all; ?> คน รวมทั้งหมด
      </font>
    </td>
  </tr> 
  <tr> 
    <td style="border-top:1px solid #000000" width="150" align="center">
      <font face="Arial, Helvetica, sans-serif" size="1">
      Record: <? echo $record; ?> (<? echo date("d.m.Y", $record_time) ?>)<br />
      </font>
    </td>
  </tr> 
</table>
<?
}
?>
