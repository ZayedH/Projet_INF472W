<?php
function estConnecte()
{
    return (array_key_exists(
        'loggedIn',
        $_SESSION
    ) && $_SESSION['loggedIn']
        == true);
}
