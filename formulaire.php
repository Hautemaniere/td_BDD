<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données</title>

</head>

<body>


    <?php
   
 
    try {
        $ipserver = "192.168.64.140";
        $nomBase = "td_BDD";
        $loginPrivilege = "root";
        $passPrivilege = "root";
        $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);

    ?>
        <?php
        $requete = "select * from pcloc";
        $resultat = $GLOBALS["pdo"]->query($requete);


        $tabpcloc = $resultat->fetchALL();
        ?>
        <form action="" method="post">

            <select name="idpcloc">
                <?php
                foreach ($tabpcloc as $pcloc) {

                    echo '<option value ="' . $pcloc["id"] . '">' . $pcloc["Marque"] . "" . $pcloc["Model"] . "</option>";
                }
                ?>
            </select>


            <?php
            $requetes = "select * from client";
            $resultats = $GLOBALS["pdo"]->query($requetes);
            $tabclient = $resultats->fetchALL();
            ?>

            <!--<select name="id">
                <?php
                foreach ($tabclient as $client) {

                    echo '<option value ="' . $client["id"] . '">' . $client["nom"] . "" . $client["prenom"] . "</option>";
                }
                ?>

            </select>-->
            <input type="text" name="id">
            <input type="datetime-local" name="laDate">
            <input type="submit" value="Saisir une consultation" name="Valider">
        </form>
    <?php
    if (isset($_POST["Valider"])) {
        echo "Idpcloc = " . $_POST["Marque"] . " id client = " . $_POST["idclient"] . " date = " . $_POST["laDate"];
        /*$requetesConsulatation = "INSERT INTO `Consultation`(`Dateheure`, `idMedecin`, `idPatient`) VALUES ('" . $_POST["laDate"] . "','" . $_POST["idmedecin"] . "','" . $_POST["idpatient"] . "')";
        $resultconsultation = $GLOBALS["pdo"]->query($requetesConsulatation);*/
    }
        
    }   
    catch (Exception  $error) {
        echo "error est : " . $error->getMessage();
    }
    ?>
</body>

</html>