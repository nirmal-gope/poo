<!-- Un navigateur web peut contacter un serveur selon 2 méthodes : GET ou POST 
    L'attribut action définie l'url ciblé par le formulaire, c'est-à-dire à quel fichier PHP
    vont être envoyées les informations tapées par l'utilisateur

    Dans un formulaire, les valeurs envoyées au serveur sont celles des inputs qui
    ont un attribut "name" non nul

    En méthode GET, les informations envoyées sont passées dans l'URL après le nom du fichier
    dans ce qu'on appelle le "Query String" 
       ex: nomfichier.php?indice1=valeur1&indice2=valeur2&...
    Les indices correspondent aux "name" des inputs et les valeurs correspondent aux
        valeurs tapées par l'utilisateur 
    Dans le fichier PHP, les indices correspondront aux indices de $_GET
-->
<h1>CONNEXION</h1>

<form method="POST">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" class="form-control" required="true">
    </div>

    <div class="form-group">
        <label for="">MDP</label>
        <input type="text" name="mdp" class="form-control" required="true">
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

