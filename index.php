<?php
   function chargerClass($classe)
   {
       require_once ('class/'. $classe. '.class.php');
   }spl_autoload_register('chargerClass');
   session_start();

   $manager = new ContactManager(Dao::getDb());
   $nombreLigne = $manager->countNombrePage();

   $limitLignesPage = 3;
   $totalPage = ceil($nombreLigne / $limitLignesPage);

   $aPartir = 0;
 
    if(isset($_GET['page']) && !empty($_GET['page'])){
        $page = (int) strip_tags($_GET['page']);
            $aPartir = $page;
            if($_GET['page'] == 1){
                $aPartir = 0;
            }
            $prec = $page-1;
            $suiv = $page+1;
    }
    $contacts = $manager->selectAll($aPartir, $limitLignesPage);

    // a chaque 10mn envoyer un email par hassard
    
    $min = date('i');
    // if($min % 10 == 0){
        $idAléatoire = rand(1, $nombreLigne);
        $dest = /*$manager->selectById($idAléatoire)->getEmail(); */ "alypetitsylla@gmail.com"; 
        $sujet;
        echo "<strong>".   $sujet. "</strong>";
        echo "<p>". $msg. "</p>";
        if(mail($dest, $sujet, $msg, )){
            echo "message envoyer avec succès";
        }
    // }

    
 
  
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carnet</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <style>
        body {
            margin-top: 80px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="">Carnet</a>
    </nav>
    <div class="container">
    <div id="countdown"></div>


        <div class="card">
            <img src="" alt="">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <form action="controller/fController.php" method="post">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nom_complet" placeholder="nom complet" required>
                       
                    </div>
                    <div class="form-group">
                        <input type="tel" pattern="[0-9]{9}" name="telephone" placeholder="Téléphone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="adresse" type="text" placeholder="adresse" required>
                    </div>
                    <input type="submit" name="enregistrer" class="btn btn-primary pull-right" value="Enrégistrer">
                </form>
            </div>
        </div>
        <!--   affichage des contacts -->
        <div class="mt-4">
            <ul class="list-group">
                <?php
                    foreach($contacts as $contact){
                ?>            
                    <li class="list-group-item disabled">
                        <h4><?=$contact->getNom_complet()?></h4>
                       <span class="alert">Email: </span> <span class=""><?=$contact->getEmail()?></span><br> 
                       <span class="alert">Téléphone: </span> <span class=""><?=$contact->getTelephone()?></span><br>
                        <span class="alert">Adresse: </span> <span class=""><?=$contact->getAdresse()?></span>
                        <span class="float-right"><?=$contact->getDate_enregistrer()?></span>
                    </li>
                <?php
                    }
                ?>            
            </ul>
        </div>

      
        
        <!-- paginattion -->
       <div class="mt-4 d-flex justify-content-center">
       <nav aria-label="" class="">
            <ul class="pagination">

                <li class="page-item <?php if($page <= 1){echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($page <=1) {echo "#"; }else{echo '?page='. $prec;}?>" aria-label="Previous"> 
                        Précédent
                    </a>
                </li>

                <?php
                    for($i = 1; $i <= $totalPage; $i++){
                 ?>
                        <li class="page-item <?php if($page == $i) {echo 'active'; }?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i ?></a>
                        </li>
                <?php
                    }
                 ?>
                 
                    <li class="page-item <?php if($page >= $totalPage) {echo 'disabled'; }?>">
                        <a class="page-link" href="<?php if($page >= $totalPage){echo '#';} else echo "?page=". $suiv; ?>">Suivant</a>
                    </li>
            </ul>
        </nav>
       </div>
        <div>

        </div>
    </div>
    <script src="style/jquery.js"></script>
    <script src="">
    
    </script>
</body>



</html>