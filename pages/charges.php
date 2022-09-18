<?php
if (isset($_POST['ajouter'])) {
       
        $employe = trim($_POST['employe_id']);
        $nom_prenom= trim($_POST['nom_prenom']);
        $relation = trim($_POST['relation']);
        $date = trim($_POST['date_naissance']);
        $telephone = trim($_POST['telephone']);
        $sql = "insert into charge(employe_id,nom_prenom, relation, date_naissance,telephone) values('$employe','$nom_prenom','$relation','$date','$telephone')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=charges&message=AddOk'; </script>";

        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from charge where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=charges&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['nom_prenom']) && ($_POST['nom_prenom'] != "")) {
                
                $employe = trim($_POST['employe_id']);
                $nom_prenom= trim($_POST['nom_prenom']);
                $prenom_prenom= trim($_POST['prenom_prenom']);
                $relation = trim($_POST['relation']);
                $date = trim($_POST['date_naissance']);
                $telephone = trim($_POST['telephone']);
                $sql = "update charge  set employe_id='$employe', nom_prenom='$nom_prenom',date_naissance='$date', relation='$relation', telephone='$telephone' where id =" . trim($_POST['code_charge']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=charges&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from charge where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }

$requete = mysqli_query($connection, "select * from employe");
$employes = mysqli_fetch_all($requete);


?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">charge</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">charge</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_charge"><i class="fa fa-plus"></i> Ajouter</a>
                                                </div>
                                        </div>
                                </div>
                                <!-- /Page Header -->
                                
    <div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped custom-table datatable">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Nom complet</th>
                      <th>Employé</th>
                      <th>Relation</th>
                      <th>telephone</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from charge inner join employe where employe.id=charge.employe_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $charge) {
                                echo "
                                <tr>
                                        <td>" . $charge['0'] . "</td>
                                        <td>" . $charge['1'] . "</td>
                                        <td>" . $charge['8'] . "</td>
                                        <td>" . $charge['3'] . "</td>
                                        <td>" . $charge['4'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' nom='".$charge['1']."'  naissance='".$charge['2']."' relation='".$charge['3']."' lieu='".$charge['7']."' relation='".$charge['8']."' telephone='".$charge['9']."' employe='".$charge['8']."' code='".$charge['0']."' data-bs-toggle='modal' data-bs-target='#edit_charge'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_charge'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        </div>
        <!-- /Page Content -->
        
        <!-- Add charge Modal -->
        <div id="add_charge" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter employé</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=charges" method="post">
                <div class="row">           
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>employe <span class="text-danger">*</span></label>
                                                <select class="select" name="employe_id" id="" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($employes as $employe) {
                                                                    echo '<option value="' . $employe[0] . '">' . $employe[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Nom<span class="text-danger">*</span></label>
                                                <input type="text" name="nom_prenom" class="form-control" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le nom">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date de naissance </label>
                                                <input type="date" name="date_naissance" class="form-control" required max="2002-12-31">
                                            </div>
                                        </div>
                                 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Relation <span class="text-danger">*</span></label>
                                                <select id="relation" name="relation" class="select">
                                                    <option value="">Choisir le genre</option>
                                                    <option value="Epoux(se)">Epoux(se)</option>
                                                    <option value="Enfant">Enfant</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero de telephone: (227-99-99-99-99)</label>
                                                <input type="telephone" name="telephoneelephone" class="form-control" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}">
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
        <!-- /Add charge Modal -->
        
        <!-- Edit charge Modal -->
        <div id="edit_charge" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier employé</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=charges">
                <div class="row">
                                       
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>employe <span class="text-danger">*</span></label>
                                                <select class="select" name="employe_id" id="edit_employe" required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($employes as $employe) {
                                                                    echo '<option value="' . $employe[0] . '">' . $employe[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Nom<span class="text-danger">*</span></label>
                                                <input type="text" name="nom_prenom" class="form-control" id="edit_nom" required pattern="[a-zA-Z\s]+" placeholder="Veuillez saisir le nom">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date de naissance </label>
                                                <input type="date" name="date_naissance" class="form-control" id="edit_naissance" required max="2002-12-31">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Relation <span class="text-danger">*</span></label>
                                                <select id="relation" name="relation" id="edit_relation" class="select">
                                                    <option value="">Choisir le genre</option>
                                                    <option value="Epoux(se)">Epoux(se)</option>
                                                    <option value="Enfant">Enfant</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Numero de telephone: (227-99-99-99-99)</label>
                                                <input type="telephone" name="telephoneelephone" class="form-control" id="edit_telephone" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}">
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
        <!-- /Edit charge Modal -->

        <!-- Delete charge Modal -->
        <div class="modal custom-modal fade" id="delete_charge" role="dialog">
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
							<a href='<?php echo"./?page=charges&delete=" . $charge['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete charge Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_nom").val( $(this).attr("nom"));
     $("#edit_naissance").val( $(this).attr("naissance"));
     $("#edit_relation").val( $(this).attr("relation"));
     $("#edit_telephone").val( $(this).attr("telephone"));
     $("#edit_employe").val( $(this).attr("employe"));
    
  });
});

</script>