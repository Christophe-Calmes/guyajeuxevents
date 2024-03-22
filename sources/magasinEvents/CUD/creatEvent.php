<?php 
//encodeRoutage(34)
require('../functions/functionToken.php');
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, $checkId->controleInteger($_POST['numberMax']));
array_push($controlePostData, $checkId->controleInteger($_POST['contribution']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['description'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['numberMax'], 25));
array_push($controlePostData, borneSelect($_POST['contribution'], 50));
$mark = [1,1,1,0,0,0,0,0];
$idTable = array();
$idUser = $checkId->idUser($_SESSION);
$checkDateShedulingShop = new SQLAcessReserTables();
$dateTime = new DateTime(filter($_POST['dateEvent']));
$date = $dateTime->format('Y-m-d');
$dateTime->modify(filter($_POST['endOfReserve']));
$_POST['endOfReserve']=$dateTime->format('Y-m-d\TH:i');
foreach ($_POST as $key => $value) {
    if(str_contains($key, 'idTable')) {
        array_push($idTable, ['idTable'=>substr($key, 7), 'start'=>filter($_POST['dateEvent']), 'end'=>$_POST['endOfReserve']]);
    }
}
foreach($idTable as $value) {
    $checkDateShedulingShop->delReservedTableInEventCase ($value['start'], $value['end'], $value['idTable']);
    // sendEmail
    $param = [['prep'=>':idUser', 'variable'=>$idUser],
            ['prep'=>':idTable', 'variable'=>$value['idTable']],
            ['prep'=>':numberPeople', 'variable'=>$checkDateShedulingShop->numberOfChairOfOneTable($value['idTable']) ],
            ['prep'=>':comment', 'variable'=>filter($_POST['title'])],
            ['prep'=>':dateReserve', 'variable'=>$value['start']],
            ['prep'=>':endOfReserve', 'variable'=>$value['end']],
            ['prep'=>':idActivity', 'variable'=>filter($_POST['idActivity'])],
            ['prep'=>':idConsommation', 'variable'=>filter($_POST['idConsommation'])],];
        $checkDateShedulingShop->addReservedTableByUser($param);
        unset($_POST['idTable'.$value['idTable']]);
}

if($mark == $controlePostData && controlePicture($_FILES, 75000)) {
    unset($_POST['idActivity']);
    unset($_POST['idConsommation']);
    unset($_POST['endOfReserve']);
    unset($_POST['endOfReserve']);
    $_POST['idAuthor'] = $idUser;
    $namePicture = genToken (6).date('Y').filter($_FILES['picture']['name']);
    $_POST['picture'] = $namePicture;
    $sqlInsert = new InsertRequest();
    $insert = $sqlInsert->requestInsert($_POST, 5, 'internalEvents', 1);
    $parametre = new Preparation();
    $param = $parametre->creationPrep($_POST);
    if (file_exists('../sources/pictures/picturesEvents')) {
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesEvents/'.$namePicture)) {
            chmod($f, 0644);
            ActionDB::access($insert, $param, 1);
            $select = "SELECT `id` FROM `internalEvents` ORDER BY `id` DESC LIMIT 1;";
            $data = ActionDB::select($select, [], 1);
            $idEvent = $data[0]['id'];
            print_r($idEvent);
            foreach($idTable as $value) {
                // Affecter les réservations à l'ID de l'événement.
                $param = [['prep'=>':idUser', 'variable'=>$idUser],
                ['prep'=>':idTable', 'variable'=>$value['idTable']],
                ['prep'=>':dateReserve', 'variable'=>$value['start']],
                ['prep'=>':endOfReserve', 'variable'=>$value['end']],
                ['prep'=>':idEvent', 'variable'=>$idEvent]];
                $checkDateShedulingShop->affectedIdEvent($param);
            }
            return header('location:../index.php?message=Nouvel événement enregistré');
        } 
    } else {
        return header('location:../index.php?message=Le fichier destination n\'existe pas');
    }
} else {
    return header('location:../index.php?message=Soucis d\'enregistrement');
}
