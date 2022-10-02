<?php



function sendlink($userEmail, $url)
{
    $to = $userEmail; //send emailwithlink

    $subject = "reset your password for Binet_Inter";

    $message = '<p>we received a password reset request.The link to reset your passwrd, 
            if you did not make this request, you can simply ignore this email</p>';
    $message .= '<p>Here is your password reset link. copy and paste the following link into your browser</br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Inter <Inter.binet@polytechnique.edu>\r\n";
    $headers .= "Reply-To: zayed.herma@polytechnique.edu\r\n";
    $headers .= "Content-type: text/html>\r\n";

    mail($to, $subject, $message, $headers);
}


function sendregisterlink($userEmail, $url)
{
    $to = $userEmail; //send emailwithlink

    $subject = "Registration for Binet_Inter";

    $message = '<p>we received a password reset request.The link to register , 
            if you did not make this request, you can simply ignore this email</p>';
    $message .= '<p>Here is your register link. copy and paste the following link into your browser</br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Inter <Inter.binet@polytechnique.edu>\r\n";
    $headers .= "Reply-To: zayed.herma@polytechnique.edu\r\n";
    $headers .= "Content-type: text/html>\r\n";

    mail($to, $subject, $message, $headers);
}
