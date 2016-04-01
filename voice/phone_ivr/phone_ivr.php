<?php
    require '../../vendor/autoload.php';
    use Plivo\Response;

    # This file will be played when a caller presses 2.
    $PLIVO_SONG = "https://s3.amazonaws.com/plivocloud/music.mp3";

    # This is the message that Plivo reads when the caller dials in
    $IVR_MESSAGE1 = "Welcome to the Plivo IVR Demo App. Press 1 to listen to a pre recorded text in different languages. Press 2 to listen to a song.";

    $IVR_MESSAGE2 = "Press 1 for English. Press 2 for French. Press 3 for Russian";
    # This is the message that Plivo reads when the caller does nothing at all
    $NO_INPUT_MESSAGE = "Sorry, I didn't catch that. Please hangup and try again later.";

    # This is the message that Plivo reads when the caller inputs a wrong number.
    $WRONG_INPUT_MESSAGE = "Sorry, wrong input.";


    $r = new Response();

    switch($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $getdigits_action_url = "https://example.com/phone_ivr.php";
            $params = array(
            'action' => $getdigits_action_url,
            'method' => 'POST',
            'timeout' => '7',
            'numDigits' =>  '1',
            'retries' => '1'
            );

            $getDigits = $r->addGetDigits($params);

            $getDigits->addSpeak($IVR_MESSAGE1);


            $r->addSpeak($NO_INPUT_MESSAGE);

            Header('Content-type: text/xml');
            echo($r->toXML());

            break;
        case "POST":

            $digit = $_REQUEST['Digits'];
            if ($digit == '1'){
                $getdigits_action_url = "https://example.com/phone_tree.php";
                $params = array(
                    'action' => $getdigits_action_url,
                    'method' => 'GET',
                    'timeout' => '7',
                    'numDigits' =>  '1',
                    'retries' => '1'
                );

            $getDigits = $r->addGetDigits($params);
            $getDigits->addSpeak($IVR_MESSAGE2);


            $r->addSpeak($NO_INPUT_MESSAGE);

            }

            else if ($digit == '2'){
                $r->addPlay($PLIVO_SONG);
            }

            else {
                $r->addSpeak($WRONG_INPUT_MESSAGE);
            }

            Header('Content-type: text/xml');
            echo($r->toXML());

            break;
    }
?>