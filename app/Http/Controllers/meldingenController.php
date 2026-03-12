<?php

//Variabelen vullen
$attractie    = isset($_POST['attractie']) ? trim($_POST['attractie']) : '';
$type         = isset($_POST['type']) ? trim($_POST['type']) : '';
$capaciteit   = isset($_POST['capaciteit']) ? $_POST['capaciteit'] : '';
$prioriteit   = isset($_POST['prioriteit']) ? 1 : 0;
$melder       = isset($_POST['melder']) ? trim($_POST['melder']) : '';
$overige_info = isset($_POST['overige_info']) ? trim($_POST['overige_info']) : '';

// eenvoudige validatie
$errors = [];
if($attractie === '') {
    $errors[] = 'Attractie mag niet leeg zijn';
}
if($type === '') {
    $errors[] = 'Type mag niet leeg zijn';
}
if($melder === '') {
    $errors[] = 'Melder mag niet leeg zijn';
}
if($capaciteit !== '' && !is_numeric($capaciteit)) {
    $errors[] = 'Capaciteit moet een getal zijn';
}

// als er fouten zijn, terugsturen naar formulier met foutmelding en ingevulde waarden
if(!empty($errors)) {
    $msg = urlencode(implode(' | ', $errors));
    $params = [
        'msg'=>$msg,
        'attractie'=>urlencode($attractie),
        'type'=>urlencode($type),
        'capaciteit'=>urlencode($capaciteit),
        'overige_info'=>urlencode($overige_info),
        'melder'=>urlencode($melder)
    ];
    if($prioriteit) {
        $params['prioriteit'] = '1';
    }
    $query = http_build_query($params);
    require_once '../../../config/conn.php';
    header("Location: $base_url/resources/views/meldingen/create.php?$query");
    exit;
}

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) 
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit !== '' ? $capaciteit : null,
    ':prioriteit' => $prioriteit,
    ':melder' => $melder,
    ':overige_info' => $overige_info
]);
