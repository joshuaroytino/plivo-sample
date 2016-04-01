<?php
require '../../vendor/autoload.php';
use Plivo\Response;

$WRONG_INPUT_MESSAGE = "Sorry, it's a wrong input." ;

$r = new Response();

$digit = $_REQUEST['Digits'];
if ($digit == '1'){
    $body = "This message is being read out in English";
    $params = array(
        'language' => "en-GB"
    );
    $r->addSpeak($body,$params);

}
else if ($digit == '2'){
    $body = "Ce message est lu en français";
    $params = array(
        'language' => "fr-FR"
    );
    $r->addSpeak($body,$params);

}
else if ($digit == '3'){
    $body = "??? ????????? ???? ????????? ? ??????";
    $params = array(
        'language' => "ru-RU"
    );
    $r->addSpeak($body,$params);

}
else {
    $r->addSpeak($WRONG_INPUT_MESSAGE);
}

Header('Content-type: text/xml');
echo($r->toXML());


/*
Sample output
<Response>
    <GetDigits action="https://glacial-harbor-8656.herokuapp.com/testing.php/response/ivr" method="POST" numDigits="1" retries="1" timeout="7">
        <Speak>Welcome to the Plivo IVR Demo App. Press 1 to listen to a pre recorded text in different languages. Press 2 to listen to a song.</Speak>
    </GetDigits>
    <Speak>Sorry, I didn't catch that. Please hangup and try again later.</Speak>
</Response>

If 1 is pressed, another menu is read out. Following is the generated Speak XML.
<Response>
    <GetDigits action="http://glacial-harbor-8656.herokuapp.com/testing.php/response/tree/" method="POST" numDigits="1" retries="1" timeout="7">
        <Speak>Press 1 for English. Press 2 for French. Press 3 for Russian</Speak>
    </GetDigits>
    <Speak>Sorry, I didn't catch that. Please hangup and try again later.</Speak>
</Response>

If 1 is pressed, the English text is read out. Following is the generated Speak XML.
<Response>
   <Speak language="en-GB">This message is being read out in English</Speak>
</Response>

If 2 is pressed, the French text is read out. Following is the generated Speak XML.
<Response>
   <Speak language="fr-FR">Ce message est lu en fran&amp;#231;ais</Speak>
</Response>

If 3 is pressed, the Russian text is read out. Following is the generated Speak XML.
<Response>
   <Speak language="ru-RU">&amp;#1069;&amp;#1090;&amp;#1086; &amp;#1089;&amp;#1086;&amp;#1086;&amp;#1073;&amp;#1097;&amp;#1077;&amp;#1085;&amp;#1080;&amp;#1077; 
        &amp;#1073;&amp;#1099;&amp;#1083;&amp;#1086; &amp;#1087;&amp;#1088;&amp;#1086;&amp;#1095;&amp;#1080;&amp;#1090;&amp;#1072;&amp;#1085;&amp;#1086; &amp;#1074; 
        &amp;#1056;&amp;#1086;&amp;#1089;&amp;#1089;&amp;#1080;&amp;#1080;
   </Speak>
</Response>

If 2 is pressed, a music is played. Following is the generated Play XML.
<Response>
   <Play>https://s3.amazonaws.com/plivocloud/music.mp3</Play>
</Response>
*/