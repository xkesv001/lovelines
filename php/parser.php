<?php 
// header('Content-Type:application/json');

$url = "";
$from = "";
$to = "";
$date = "";
$time = "";
$objs = array();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['link_search'])) {
  $from = $_POST["from"];
  $from = str_replace('á','%C3%A1', $from);
  $from = str_replace('é','%C3%A9', $from);
  $from = str_replace('ě','%C4%9B', $from);
  $from = str_replace('í','%C3%AD', $from);
  $from = str_replace('ú','%C3%BA', $from);
  $from = str_replace('ů','%C5%AF', $from);
  $from = str_replace('ý','%C3%BD', $from);
  $from = str_replace('č','%C4%8D', $from);
  $from = str_replace('ď','%C4%8F', $from);
  $from = str_replace('ľ','%C4%BE', $from);
  $from = str_replace('ň','%C5%88', $from);
  $from = str_replace('ř','%C5%99', $from);
  $from = str_replace('š','%C5%A1', $from);
  $from = str_replace('ť','%C5%A5', $from);
  $from = str_replace('ž','%C5%BE', $from);
  $from = str_replace(' ','%20', $from);

  $to = $_POST["to"];
  $to = str_replace('á','%C3%A1', $to);
  $to = str_replace('é','%C3%A9', $to);
  $to = str_replace('ě','%C4%9B', $to);
  $to = str_replace('í','%C3%AD', $to);
  $to = str_replace('ú','%C3%BA', $to);
  $to = str_replace('ů','%C5%AF', $to);
  $to = str_replace('ý','%C3%BD', $to);
  $to = str_replace('č','%C4%8D', $to);
  $to = str_replace('ď','%C4%8F', $to);
  $to = str_replace('ľ','%C4%BE', $to);
  $to = str_replace('ň','%C5%88', $to);
  $to = str_replace('ř','%C5%99', $to);
  $to = str_replace('š','%C5%A1', $to);
  $to = str_replace('ť','%C5%A5', $to);
  $to = str_replace('ž','%C5%BE', $to);
  $to = str_replace(' ','%20', $to);

  $date = $_POST["date"];
  $date = str_replace('-','.', $date);
  $date = explode(".", $date);
  $date = $date[2] . '.' . $date[1] . '.' . $date[0];

  $time = $_POST["time"];

  $url = 'https://idos.idnes.cz/pid/spojeni/vysledky/?date='.$date.'&time='.$time.'&f='.$from.'&fc=1&t='.$to.'&tc=1&direct=true';

  if (! empty($url)) {
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);

    $dom = new DOMDocument();
    @ $dom->loadHTML($res);
    
    $matches = array();
    $stations = array();
    $times = array();
    $lines = array();
    
    $n = 0;
    foreach($dom->getElementsByTagName('div') as $div) {
        if ( ! $div->hasAttribute('class')) {
           continue;
        }

        $class = explode(' ', $div->getAttribute('class'));

        if (in_array('detail-box', $class)) {
           $matches[] = $div;
           foreach ($div->getElementsByTagName('p') as $time) {
              if ( ! $time->hasAttribute('class')) {
                continue;
              }

              $class = explode(' ', $time->getAttribute('class'));
              if (in_array('time', $class)) {
                  $times[] = $time->textContent;
              }
            }
            foreach ($div->getElementsByTagName('strong') as $strong) {
              if ( ! $strong->hasAttribute('class')) {
                continue;
              }

              $class = explode(' ', $strong->getAttribute('class'));
              if (in_array('name', $class)) {
                  $stations[] = $strong->textContent;
              }
            }

            foreach ($div->getElementsByTagName('h3') as $h3) {
              foreach ($h3->getElementsByTagName('span') as $span) {
                $lines[] = $span->textContent;
              }
            }

            $objs[] = array(
              'line' => $n,
              'links' => reset($lines),
              'time_start' => reset($times),
              'time_end' => end($times),
              'source_station' => reset($stations),
              'target_station' => end($stations)
                 );

	          if (isset($_SESSION['username'])){
	
		
              $line = (string)reset($lines);
              $from = reset($stations);
              $to = end($stations);
              $username = $_SESSION['username'];

              if (!$mysqli -> query( "INSERT INTO `lines` (line_name) VALUES ('$line')")){
                if ($mysqli->errno == 1062) {
                }
                else{
                  echo("Error description: " . $mysqli -> error);  
                }
                
              }
              if (!$mysqli -> query("INSERT INTO `history` (username, source_station, target_station, line_name) VALUES ('$username', '$from', '$to', '$line')")){
                if ($mysqli->errno == 1062) {
                }
                else{
                  echo("Error description: " . $mysqli -> error);  
                }
                
              }
            }

            $n = $n+1 ;
            $stations = array();
            $times = array();
            $lines = array();
        }

    }
  }
}


?>