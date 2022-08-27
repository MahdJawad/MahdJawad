<?php
if (isset($_POST['login']) && ($_POST['login'] != "")) {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $profil_id = trim($_POST['profil_id']);
        
        $sql = "insert into user(login, password, profil_id) values('$login',md5('$password'),'$profil_id')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<span> Enregistrement effectué avec succès </span>";
        }
}

$requete = mysqli_query($connection, "select * from profil");
$profils = mysqli_fetch_all($requete);

if (isset($_GET['delete'])) {
        $sql = "delete from user where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<span> Suppression effectuée avec succès </span>";
        }
}
?>
<h1> Gestion des utilisatteurs </h1>
<div class="row">
        <div class="col-12">
                <form method="post" action="./?page=users">
                        
                        <label for="floatingInput">Login</label>
                        <input type="text" class="form-control" name="login" placeholder="Prénom" autocomplete="off" />

                        <label for="floatingInput">Mot de passe</label>
                        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Mot de passe" />

                        <label for="floatingInput">Profil</label>
                        <select class="form-control" name="profil_id" id="" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($profils as $profil) {
                                        echo '<option value="' . $profil[0] . '">' . $profil[1] . '</option>';
                                }
                                ?>
                        </select>
                        <button type="submit" class="btn mt-3 btn-primary">Enregistrer</button>
                </form>
        </div>
</div>
<div class="row">
        <table class="table">

                <thead>
                        <tr>
                                <td>Login</td>
                                <td>Profil</td>
                                <td>Action</td>
                        </tr>
                </thead>
                <tbody>
                        <?php
                        $sql = "select * from user inner join profil on profil.id = user.profil_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $categorie) {
                                echo "
                                <tr>
                                        <td>" . $categorie['1'] . "</td>
                                        <td>" . $categorie['2'] . "</td>
                                        <td>" . $categorie['7'] . "</td>
                                        <td><a class='btn btn-primary' href='./?page=ModifierCategorie&id=" . $categorie['0'] . "' > Modifier <i class='fa fa-edit'></i></a><a onclick=\"return confirm('Voulez-vous vraiment supprimer')\" class='btn btn-danger' href='./?page=categories&delete=" . $categorie['0'] . "' > Supprimer <i class='fa fa-delete'></i></a></td>
                                </tr>";
                        } ?>
                </tbody>
        </table>

</div>