<?php
function validateUserName ($username)
{
    $err = [];

    if($username === ''){
        $err[] = 'username пустий';
    }

    if (strlen($username) <= 2) {
        $err[] = 'username мало';
    }
    return $err;
}
function validateUserMessages ($userMessages)
{
    {
        $err = [];

        if($userMessages === ''){
            $err[] = '$userMessages пустий';
        }

        if (strlen($userMessages) <= 2) {
            $err[] = '$userMessages мало';
        }
        return $err;
    }
}
function validateheader ($header)
{
    $err = [];

    if($header === ''){
        $err[] = 'header пустий';
    }

    if (strlen($header) <= 2) {
        $err[] = 'header мало';
    }
    return $err;
}



