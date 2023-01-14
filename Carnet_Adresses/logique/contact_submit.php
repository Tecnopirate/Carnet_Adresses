<!doctype html>
<html lang="fr">

  <?php
           try
           {
             // On se connecte à MySQL
             $mysqlClient = new PDO('mysql:host=localhost;dbname=contacts;charset=utf8', 'root', '');
           }
           catch(Exception $e)
           {
             // En cas d'erreur, on affiche un message et on arrête tout
                   die('Erreur : '.$e->getMessage());
           }
      
           // Ecriture de la requête
$sqlQuery = 'INSERT INTO contact(nom,prenom,telephone) VALUES (:nom, :prenom, :telephone)';

// Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'nom' => $_POST["nom"],
    'prenom' => $_POST["prenom"],
    'telephone' => $_POST["numero"],
    
]);

$sqlQuery = 'SELECT * FROM contact';
$contactsStatement = $mysqlClient->prepare($sqlQuery);
$contactsStatement->execute();
$contacts = $contactsStatement->fetchAll();
   

  ?>
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../style/style.css"  rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
    <title>Hello, world!</title>
  </head>
  <body>
    <header class="h-40">
    
      <nav class="navbar bg-light navbar-light  ">
        <div class="container ">

            <div class="bg-info w-100 py-4 rounded-3 d-flex">
                <div class="fw-bold text-center text-light i text-uppercase fs-2">Contacts </div>  
                <div class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">

                  <span class="material-icons v ">
                    search
                    </span>
                </diV>   
                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                  <div class="offcanvas-header">
                    <h5 class="fs-2" id="offcanvasTopLabel">Recherchez un contact</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body fs-2">
                  <form method="post" action="../logique/contact_submit_recherche.php">
                    <input class="form-control form-control-sm w-50 fs-2" type="text" placeholder="Entrez un nom" maxlength="30" aria-label=".form-control-sm example" name="r">
                    <button type="submit" class="btn btn-info text-white mt-4 fs-2">Recherche</button>
                  </div>
                </div>  
                
                  
                
                
               
            </div>
        </div>

    </nav>
    
  </header>

    <main class="mt-8 py-8 h">
   
      <div class="container">
   
<?php
foreach ($contacts as $contact) {
?>
<div class="btn btn-light text-dark w-100 my-2  fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target=<?php echo "#offcanvasBottom".$contact['nom']; ?> aria-controls="offcanvasBottom"><div class="w-10 mx-4"><span class="material-icons fs-1">
          account_box
          </span></div> <div class="w-30 mx-2"><?php echo $contact['nom']; ?></div></div>


    

        

<div class="offcanvas offcanvas-bottom " tabindex="-1" id=<?php echo "offcanvasBottom".$contact['nom'];?> aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fs-2" id="offcanvasBottomLabel">Contact</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small fs-2">
        <div><span class="fw-bold my-2">Nom:</span> <?php echo $contact['nom']; ?>         </div>
        <div><span class="fw-bold my-2">Prénom:</span>  <?php  echo $contact['prenom']; ?>   </div>
        <form method="post" action="../logique/contact_submit_supprimer.php">
        <div><span class="fw-bold my-2">Tél: </span> <input type="text" name="num" value=<?php echo $contact['telephone'] ;?>></div>
        <button class="btn btn-info my-4 text-white fs-2" type="submit"> Supprimer le contact </button>
         </form>
    </div>
    
</div>
<?php } ?>


</div>







<div id="vivi"  class="btn text-dark " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
    <img src="../images/ro.png">
   </div>
   <div class="offcanvas offcanvas-bottom h-50" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fs-2" id="offcanvasBottomLabel">Ajouter un contact</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
      <form method="post"  action="../logique/contact_submit.php">

      <input class="form-control form-control-sm my-2 fs-2 w-50" type="text" placeholder="Nom" aria-label=".form-control-sm example" maxlength="30" name="nom">
      <input class="form-control form-control-sm my-2 fs-2 w-50" type="text" placeholder="Prénom" aria-label=".form-control-sm example" maxlength="30" name="prenom">
      <input type="email" class="form-control fs-2 w-50" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="e-mail" name="mail" maxlength="40">
      <input class="form-control form-control-sm my-2 fs-2 w-50" type="text" placeholder="numéro de téléphone" aria-label=".form-control-sm example" maxlength="9" name="numero">
      <button class="btn btn-info text-white my-2 fs-2 w-50" type="submit">Enregistrer le contact</button>

     </form>
    </div>
</div>


      
      
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  

   
    
  </body>
</html>