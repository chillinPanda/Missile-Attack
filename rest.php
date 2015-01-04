<?php
    /**
     * This is a REST api for the attack.py script. 
     * 
     * usage: rest.php?cmd=right&val=500
     */
?>

<!DOCTYPE html>
  <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    
      
<?php
if (!empty($_GET['cmd']) && !empty($_GET['val'])) {
  $cmd = 'sudo python ' . $_SERVER['DOCUMENT_ROOT'] . '/attack.py ' . $_GET['cmd'] . ' ' . $_GET['val'];
  $fire = shell_exec($cmd);
  echo '<h1>Send command: ' . $cmd . '</h1>';
} else {
  echo '<h1>not enough parameter</h1>';
  echo '<p>usage: rest.php?cmd=right&val=500</p>';
}
?>
	
      <h2>PHP REST API</h2>
      <p>jQuery.get() is used to fire a get request to the api</p>
      <p>Call this site with url parameter like "?cmd=right&val=500"</p> 
      <ul>
        <li onclick="$.get( '?cmd=right&val=500');">go right 500 ms</li>
        <li onclick="$.get( '?cmd=left&val=500');">go left 500 ms</li>
        <li onclick="$.get( '?cmd=up&val=500');">go up 500 ms</li>
        <li onclick="$.get( '?cmd=down&val=500');">go down 500 ms</li>
        <li onclick="$.get( '?cmd=zero&val=1');">go to zero</li>
        <li onclick="$.get( '?cmd=fire&val=1');">FIRE!</li>
      </ul>
      
      <p>for continuous movement press and hold the mouse button.</p>
      
      <ul>
        <li onmousedown="$.get( '?cmd=right&amp;val=-1');" onmouseup="$.get( '?cmd=stop&amp;val=1');">continous right</li>
        <li onmousedown="$.get( '?cmd=left&amp;val=-1');" onmouseup="$.get( '?cmd=stop&amp;val=1');">continous left</li>
        <li onmousedown="$.get( '?cmd=up&amp;val=-1');" onmouseup="$.get( '?cmd=stop&amp;val=1');">continous up</li>
        <li onmousedown="$.get( '?cmd=down&amp;val=-1');" onmouseup="$.get( '?cmd=stop&amp;val=1');">continous down</li>
        <li onmousedown="$.get( '?cmd=stop&amp;val=1');" onmouseup="$.get( '?cmd=stop&amp;val=1');">emergency stop</li>
      </ul>
  </body>
</html>