<?php
function sendsms($sender, $message, $subject, $boolcopy = 0)
{
    $to = "olivier.serre@polytechnique.edu";

    $headers = "From: user <$sender>\r\n";
    $headers .= "Content-type: text/html>\r\n";
    if ($boolcopy == 1) {
        mail($to, $subject, $message, $headers);
        mail($sender, $subject, $message, $headers);
    } else {
        mail($to, $subject, $message, $headers);
    }
}
function sendregist($to)
{
    $sender = "Binet-Inter@polytechnique.edu";
    $subject = "Registration successful!";
    $message = '<h1 >Welcome to Binet Inter!</h1></br>';
    $message .= '<p>Your Longin is what comes before @ in your polytechnique email</br>';

    $headers = "From: Inter <$sender>\r\n";
    $headers .= "Content-type: text/html>\r\n";

    mail($to, $subject, $message, $headers);
}
function sendemailtomembre($sender, $to, $message, $subject)
{
    $headers = "From: user <$sender>\r\n";
    $headers .= "Content-type: text/html>\r\n";
    mail($to, $subject, $message, $headers);
}
