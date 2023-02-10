<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/img/2000522.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données</title>

</head>
<style>
    .div{

        display: flex;
        justify-content: center;
        margin-top: 25%;
        flex-direction: row;
        
    }
    div{
        padding: 5px;
    }
</style>
<body>

    <div class="div">
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


            <div class="div1">
        
                <?php
                foreach ($tabpcloc as $pcloc) {

                    if(isset($_GET["id"]) && $_GET["id"]==$pcloc["id"]){
                        echo '<label>'. $pcloc["Marque"] . " " . $pcloc["Model"].'</label>';
                        echo '<input type="hidden" value ="' . $pcloc["id"] . '" name="idpcloc">';
                
                    }else{
                       // echo '<option value ="' . $pcloc["id"] . '">' . $pcloc["Marque"] . " " . $pcloc["Model"] . "</option>";
                        //echo "titi";
                    }
                    
                }
            ?>
            </div>
            <?php


                if(!isset($_GET["id"])){
                  ?>
                    refaire un champ select avec tous les forfait

                    <?php
                }

                ?>

                
            


            <?php
            $requetes = "select * from client";
            $resultats = $GLOBALS["pdo"]->query($requetes);
            $tabclient = $resultats->fetchALL();
            ?>
            <div class="div2">

            <select name="idClient">

                <?php
                foreach ($tabclient as $client) {

                    echo '<option value ="' . $client["id"] . '">' . $client["nom"] . " " . $client["prenom"] . "</option>";
                }
                ?>

            </select>
            </div>



            <div class="div3"><input type="date" name="laDate"></div>
            <div class="div4"><input type="submit" value="Confirmer une location" name="Valider"></div>
        </form>
    <?php
        if (isset($_POST["Valider"])) {
            echo "Tu as choisi le " . $_POST["idpcloc"] . " id client = " . $_POST["idClient"] . " date = " . $_POST["laDate"];
            $requetesConsulatation = "INSERT INTO `location`(`dateheure`, `idpcloc`, `idclient`) VALUES ('" . $_POST["laDate"] . "','" . $_POST["idpcloc"] . "','" . $_POST["idClient"] . "')";
            $resultconsultation = $GLOBALS["pdo"]->query($requetesConsulatation);
        }
    } catch (Exception  $error) {
        echo "error est : " . $error->getMessage();
    }
    ?>
    </div>
</body>

</html>