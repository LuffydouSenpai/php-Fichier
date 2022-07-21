<?php
/* var_dump($_FILES);
var_dump($_FILES["fichier"]['name']);
$file = $_FILES['fichier'];
var_dump($file['name']); */

if (isset($_POST['send'])) {
    $file = $_FILES['fichier'];
    $fileName = $file["name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];
    $fileType = $file["type"];
    $fileTmp = $file["tmp_name"];
    $dossierDL = "upload";
    $tabExtention=["png",'pdf','jpeg','jpg'];

    $fileExt= explode(".",$fileName);
    //toto.png => ["toto"."png"];
    $extention = strtolower(end($fileExt)); // ff.PNG dd.JPG
    
    if(in_array($extention,$tabExtention)){

        if (empty($fileError)){
            if($fileSize<=5000000){
                $fileNewName=uniqid("monFichier-").".".$extention; //monFichier-(un id).(une extention);
                $fileDestination= $dossierDL."/".$fileNewName;
                move_uploaded_file($fileTmp,$fileDestination);
            }else{
                $error.="le fichier ne doit pas depasser les 5Mo";
            }
        }else {
            $error.="erreur dans le fichier";
        }

    }else{
        $error.="l'extention ".$extention." n'est pas accepté veillez choisir un fichier (png, pdf, jpeg, jpg)";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="fichier" id="">
        <button type="submit" name="send">Envoyer</button> 
    </form>
    
</body>
</html>