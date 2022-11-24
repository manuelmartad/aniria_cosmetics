<?php
// mensajes de error

// function alertMessage($alert, $message)
// {
//     '<div class="alert alert-' . $alert . ' alert-dismissible fade show text-center" role="alert">
//     <small>' . $message . '</small>
//     </div>';

// }

// Sanitizado 

function sanitizeData($inputData)
{
    $inputData = trim($inputData);
    $inputData = stripslashes($inputData);
    $inputData = htmlspecialchars($inputData);

    return $inputData;
}
