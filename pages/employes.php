<?php
if (isset($_POST['ajouter'])) {
        $matricule = trim($_POST['matricule']);
        $echelon = trim($_POST['echelon_id']);
        $categorie = trim($_POST['categorie_id']);
        $classe = trim($_POST['classe_id']);
        $departement = trim($_POST['departement_id']);
        $nom_emp = trim($_POST['nom_employe']);
        $prenom_emp = trim($_POST['prenom_employe']);
        $adresse = trim($_POST['adresse']);
        $date = trim($_POST['date_naissance']);
        $lieu = trim($_POST['lieu_naissance']);
        $sexe = trim($_POST['sexe']);
        $telephone = trim($_POST['tel']);
        $mail = trim($_POST['mail']);
        $cnss = trim($_POST['num_cnss']);
        $sql = "insert into employe(matricule,echelon_id,categorie_id,classe_id,departement_id,nom_employe, prenom_employe, adresse, date_naissance,lieu_naissance, sexe, telephone, mail,num_cnss) values('$matricule','$echelon','$categorie','$classe','$departement','$nom_emp','$prenom_emp','$adresse','$date','$lieu','$sexe','$telephone','$mail','$num_cnss')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=employes&message=AddOk'; </script>";

        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from employe where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=employes&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['libelle_employe']) && ($_POST['libelle_employe'] != "")) {
                $matricule = trim($_POST['matricule']);
                $echelon = trim($_POST['echelon_id']);
                $categorie = trim($_POST['categorie_id']);
                $classe = trim($_POST['classe_id']);
                $departement = trim($_POST['departement_id']);
                $nom_emp = trim($_POST['nom_employe']);
                $prenom_emp = trim($_POST['prenom_employe']);
                $adress = trim($_POST['adresse']);
                $date = trim($_POST['date_naissance']);
                $lieu = trim($_POST['lieu_naissance']);
                $sexe = trim($_POST['sexe']);
                $telephone = trim($_POST['tel']);
                $mail = trim($_POST['mail']);
                $cnss = trim($_POST['num_cnss']);
                $sql = "update employe  set matricule='$matricule',echelon_id='$echelon',categorie_id='$categorie',classe_id='$classe',departement_id='$departement',nom_employe='$nom_emp', prenom_employe='$prenom_emp', adresse='$adresse', lieu_naissance='$lieu',date_naissance='$date', sexe='$sexe', telephone='$telephone', mail='$email', num_cnss='$cnss' where id =" . trim($_POST['code_employe']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=employes&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from employe where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
$requete = mysqli_query($connection, "select * from classe");
$classes = mysqli_fetch_all($requete);
$requete = mysqli_query($connection, "select * from categorie");
$categories = mysqli_fetch_all($requete);
$requete = mysqli_query($connection, "select * from echelon");
$echelons = mysqli_fetch_all($requete);

$requete = mysqli_query($connection, "select * from departement");
$departements = mysqli_fetch_all($requete);
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">employe</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">employe</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employe"><i class="fa fa-plus"></i> Ajouter</a>
                                                </div>
                                        </div>
                                </div>
                                <!-- /Page Header -->
                                
    <div class="row">
		<div class="col-md-12">
				<table class="table table-striped custom-table mb-0 datatable">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Matricule</th>
                      <th>Fonction</th>
                      <th>Adresse</th>
                      <th>Email</th>
                      <th>Telephone</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from employe inner join classe,categorie,echelon,departement where classe.id=employe.classe_id and categorie.id=employe.categorie_id and echelon.id=employe.echelon_id and departement.id=employe.departement_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $employe) {
                                echo "
                                <tr>
                                        <td>" . $employe['0'] . "</td>
                                        <td>" . $employe['2'] . "</td>
                                        <td>" . $employe['3'] . "</td>
                                        <td>" . $employe['1'] . "</td>
                                        <td>" . $employe['6'] . "</td>
                                        <td>" . $employe['5'] . "</td>
                                        <td>" . $employe['10'] . "</td>
                                        <td>" . $employe['9'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item' href='./?page=vueEmploye&id=" . $employe['0'] . "' data-bs-toggle='' data-bs-target='' ><i class='fa fa-eye'></i>Voir plus</a>
                                                <a class='dropdown-item btn-modifier' href='#' matricule='".$employe['1']."' nom='".$employe['2']."' prenom='".$employe['3']."' naissance='".$employe['4']."' adresse='".$employe['5']."' fonction='".$employe['6']."' lieu='".$employe['7']."' sexe='".$employe['8']."' telephone='".$employe['9']."' mail='".$employe['10']."' cnss='".$employe['11']."' classe='".$employe['17']."' categorie='".$employe['19']."' echelon='".$employe['21']."' departement='".$employe['23']."' code='".$employe['0']."' data-bs-toggle='modal' data-bs-target='#edit_employe'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_employe'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
                                            </div>
                                            </div>
                                        </td>
                     </tr>";
                        } ?>
                    </tbody>
                </table>
              </div>
          </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Add employe Modal -->
        
        <div id="add_employe" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter employé</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=employes" method="post">
                <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Matricule <span class="text-danger">*</span></label>
                                                <input type="number" name="matricule" class="form-control" required placeholder="Veuillez reseigner le matricule" min="0">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Nom<span class="text-danger">*</span></label>
                                                <input type="text" name="nom_employe" class="form-control" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le nom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Prénom <span class="text-danger">*</span></label>
                                                <input type="text" name="prenom_employe" class="form-control" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le prenom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date de naissance </label>
                                                <input type="date" name="date_naissance" class="form-control" required max="2002-12-31">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Lieu de naissance </label>
                                                <input type="text" name="lieu_naissance" class="form-control" required pattern="[a-zA-Z\s]+" placeholder="Veuillez entrer le lieu de naissance">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Adresse <span class="text-danger">*</span></label>
                                                <input type="text" name="adresse" class="form-control" required="adresse" placeholder="Veuillez reseigner un adresse">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="mail" class="form-control" required="" placeholder="(exa@gmail.com)">
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Fonction <span class="text-danger">*</span></label>
                                                <input type="text" name="fonction" class="form-control" required>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Classe <span class="text-danger">*</span></label>
                                                <select class="select" name="classe_id" id="" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($classes as $classe) {
                                                                    echo '<option value="' . $classe[0] . '">' . $classe[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Echelon <span class="text-danger">*</span></label>
                                                <select class="select" name="echelon_id" id="" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($echelons as $echelon) {
                                                                    echo '<option value="' . $echelon[0] . '">' . $echelon[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Categorie <span class="text-danger">*</span></label>
                                                <select class="select" name="categorie_id" id="" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($categories as $categorie) {
                                                                    echo '<option value="' . $categorie[0] . '">' . $categorie[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Département <span class="text-danger">*</span></label>
                                                <select class="select" name="departement_id" id="" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($departements as $departement) {
                                                                    echo '<option value="' . $departement[0] . '">' . $departement[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero de telephone: (227-99-99-99-99)</label>
                                                <input type="number" name="telephone" class="form-control" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                                            </div>
                                        </div>
                                      
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Sexe <span class="text-danger">*</span></label>
                                                <select id="sexe" name="sexe" class="select">
                                                    <option selected>Choisir le genre</option>
                                                    <option value="Masculin">masculin</option>
                                                    <option value="Feminin">feminin</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero CNSS </label>
                                                <input type="number" name="num_cnss" class="form-control" required min="0"  placeholder="Numéro CNSS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="submit-section">
                            <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                        </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add employe Modal -->
        
        <!-- Edit employe Modal -->
        <div id="edit_employe" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier employé</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=employes">
                <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Matricule <span class="text-danger">*</span></label>
                                                <input type="number" name="matricule" class="form-control" id="edit_matricule" required placeholder="Veuillez reseigner le matricule" min="0">
                                                <input class="form-control" id="edit_code" type="hidden" name="code_employe" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Nom<span class="text-danger">*</span></label>
                                                <input type="text" name="nom_employe" class="form-control" id="edit_nom" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le nom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Prénom <span class="text-danger">*</span></label>
                                                <input type="text" name="prenom_employe" class="form-control" id="edit_prenom" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le prenom">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date de naissance </label>
                                                <input type="date" name="date_naissance" class="form-control" id="edit_naissance" required max="2002-12-31">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Lieu de naissance </label>
                                                <input type="text" name="lieu_naissance" class="form-control" id="edit_lieu" required pattern="[a-zA-Z\s]+" placeholder="Veuillez entrer le lieu de naissance">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Adresse <span class="text-danger">*</span></label>
                                                <input type="text" name="adresse" class="form-control" id="edit_adresse" required="adresse" placeholder="Veuillez reseigner un adresse">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="mail" class="form-control" id="edit_mail" required placeholder="(exa@gmail.com)">
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label class="col-form-label">Fonction <span class="text-danger">*</span></label>
                                                <input type="text" name="fonction" class="form-control" id="edit_fonction" required>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Classe <span class="text-danger">*</span></label>
                                                <select class="select"  name="classe_id" id="edit_classe" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($classes as $classe) {
                                                                    echo '<option value="' . $classe[0] . '">' . $classe[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Echelon <span class="text-danger">*</span></label>
                                                <select class="select" name="echelon_id" id="edit_echelon" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($echelons as $echelon) {
                                                                    echo '<option value="' . $echelon[0] . '">' . $echelon[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Categorie <span class="text-danger">*</span></label>
                                                <select class="select" name="categorie_id" id="edit_categorie" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($categories as $categorie) {
                                                                    echo '<option value="' . $categorie[0] . '">' . $categorie[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Département <span class="text-danger">*</span></label>
                                                <select class="select" name="departement_id" id="edit_department" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($departements as $departement) {
                                                                    echo '<option value="' . $departement[0] . '">' . $departement[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero de telephone: (227-99-99-99-99)</label>
                                                <input type="tel" name="telelephone" class="form-control" id="edit_telephone" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                                            </div>
                                        </div>
                                      
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                
                                                <select id="edit_sexe" name="sexe" class="select">
                                                    <option selected>Choisir le genre</option>
                                                    <option value="Masculin">masculin</option>
                                                    <option value="Feminin">feminin</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero CNSS </label>
                                                <input type="number" name="num_cnss" class="form-control" required min="0" id="edit_cnss">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit employe Modal -->

        <!-- Delete employe Modal -->
        <div class="modal custom-modal fade" id="delete_employe" role="dialog">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <div class="form-header">
                  <h3>Suppression</h3>
                  <p>Voulez-vous vraiment supprimer?</p>
                </div>
                <div class="modal-btn delete-action">
					<div class="row">
						<div class="col-6">
							<a href='<?php echo"./?page=employes&delete=" . $employe['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
						</div>
										
                    <div class="col-6">
                      <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Retour</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
        <!-- /Delete employe Modal -- -->
   
      
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_matricule").val( $(this).attr("matricule"));
     $("#edit_nom").val( $(this).attr("nom"));
     $("#edit_prenom").val( $(this).attr("prenom"));
     $("#edit_naissance").val( $(this).attr("naissance"));
     $("#edit_adresse").val( $(this).attr("adresse"));
     $("#edit_fonction").val( $(this).attr("fonction"));
     $("#edit_lieu").val( $(this).attr("lieu"));
     $("#edit_sexe").val( $(this).attr("sexe"));
     $("#edit_libelle").val( $(this).attr("libelle"));
     $("#edit_telephone").val( $(this).attr("telephone"));
     $("#edit_mail").val( $(this).attr("mail"));
     $("#edit_cnss").val( $(this).attr("cnss"));
     $("#edit_categorie").val( $(this).attr("categorie"));
     $("#edit_classe").val( $(this).attr("classe"));
     $("#edit_echelon").val( $(this).attr("echelon"));
     $("#edit_departement").val( $(this).attr("departement"));
  });
});

</script>