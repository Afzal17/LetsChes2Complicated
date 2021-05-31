<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Uitslag</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>

    <?php
        include 'menu.php';
        require_once 'database.php';
        require_once 'table-generator.php';

        $geenDataBeschikbaar = true;

        $db = new database();

        $sql = '
            SELECT 
                w.id,
                w.ronde, 
                CONCAT(s.voornaam, " ", s.tussenvoegsel, " ", s.achternaam) as speler1,
                CONCAT(s1.voornaam, " ", s1.tussenvoegsel, " ", s1.achternaam) as speler2,
                w.punten1, 
                w.punten2,
                w.winnaarID
            FROM wedstrijd w
            INNER JOIN speler s
            ON s.id = w.speler1ID
            INNER JOIN speler s1
            ON s1.id = w.speler2ID';

        $wedstrijden = $db->select($sql);

        if(is_array($wedstrijden) && !empty($wedstrijden)){
            $geenDataBeschikbaar = false;
            create_table($wedstrijden, 'uitslag', $enableAction=TRUE, $enableEdit=TRUE, $enableDelete=FALSE);
        }else if($geenDataBeschikbaar){ ?>
            <p class='no-data'>Geen wedstrijd data beschikbaar</p>
        <?php } 
        
        ?>  

        
    </body>
</html>