<!DOCTYPE html>
<html>
<body>

<h1>Meetup Featured Event:</h1>

<?php

// Based on: http://adrane.com/phpapi/meetup_1.php

// ---------
// Variables
// ---------

$key = 'INSERT MEETUP API KEY HERE';         // Step 1
$group_ID = 0;                               // Step 2
//$group_urlname = "";                       // Step 3
$entries = 20;

// List upcoming group events
$link  = 'https://api.meetup.com/2/events?';
$link .= 'key='.$key;
$link .= '&group_id='.$group_ID;
//$link .= '&group_urlname='.$group_urlname; // Step 3
$link .= '&status=upcoming';
$link .= '&order=time';
$link .= '&limited_events=False';
$link .= '&desc=false';
$link .= '&offset=0';
$link .= '&photo-host=public';
$link .= '&format=json';
$link .= '&only=id%2Cfeatured';
$link .= '&page='.$entries;
$link .= '&fields=featured';
$link .= '&sign=true';

//echo $link."<br><br>";

// --------------
// Events request
// --------------

// Get request from web using file_get_contents
$resp = file_get_contents( $link );

//Remove non ascii chars - JSON will break because Meetup allows non-ascii characters
//hack from http://www.stemkoski.com/php-remove-non-ascii-characters-from-a-string/
$resp = str_replace("\n","[NEWLINE]",$resp);
$resp = preg_replace('/[^(\x20-\x7F)]*/','', $resp);
$resp = str_replace("[NEWLINE]","\n",$resp);

//echo $resp."<br><br>";

// Decode the returned JSON into a PHP array
$events = json_decode( $resp, true );

// -------------------
// Parse events result
// -------------------

//echo "<pre>" . print_r($events, true) . "</pre><br><br>";

// Initialize "featured ID" to first entry, if no featured events
$featured_ID = $events['results'][0]['id'];

// Loop to find featured event
for ($i = 0; $i < $entries; $i++)
{
	if ($events['results'][$i]['featured'])
	{
		$featured_ID = $events['results'][$i]['id'];
	}
}

// ----------------
// Featured request
// ----------------

// Request more information for featured event
$link  = 'https://api.meetup.com/2/events?';
$link .= 'key='.$key;
$link .= '&group_id='.$group_ID;
$link .= '&event_id='.$featured_ID;
$link .= '&status=upcoming';
$link .= '&order=time';
$link .= '&limited_events=False';
$link .= '&desc=false';
$link .= '&offset=0';
$link .= '&photo-host=public';
$link .= '&format=json';
$link .= '&page=1';
$link .= '&sign=true';

$resp = file_get_contents( $link );

//Remove non ascii chars - JSON will break because Meetup allows non-ascii characters
//hack from http://www.stemkoski.com/php-remove-non-ascii-characters-from-a-string/
$resp = str_replace("\n","[NEWLINE]",$resp);
$resp = preg_replace('/[^(\x20-\x7F)]*/','', $resp);
$resp = str_replace("[NEWLINE]","\n",$resp);

//echo $resp."<br><br>";

// Decode the returned JSON into a PHP array
$featured = json_decode( $resp, true );

//echo "<pre>" . print_r($featured, true) . "</pre><br><br>";

// ---------------------
// Print featured result                     // Step 4
// ---------------------

$f_name = $featured['results'][0]['name'];
$f_venue = $featured['results'][0]['venue']['name'];
$f_rsvps = $featured['results'][0]['yes_rsvp_count'];
$f_url = $featured['results'][0]['event_url'];

echo "<p>";
echo "<b>".$f_name."</b><br>";
echo $f_venue."<br>";
echo "<a href='".$f_url."' target='_blank'>Join us on Meetup</a>!";
echo " (".$f_rsvps." RSVPed)";
echo "</p>";

?>

</body>
</html> 
