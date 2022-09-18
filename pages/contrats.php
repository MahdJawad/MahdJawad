<?php
if (isset($_POST['ajouter'])) {
        $debut = trim($_POST['date_debut']);
        $date_fin_prevue= trim($_POST['date_fin_prevue']);
        $predate_fin_prevue= trim($_POST['predate_fin_prevue']);
        $date_fin_reel = trim($_POST['date_fin_reel']);
        $fichier= trim($_POST['fichier']);
        $salaire_base = trim($_POST['salaire_base']);
        $employe = trim($_POST['employe_id']);
        $contrat = trim($_POST['type_contrat_id']);
        $statut = trim($_POST['statut_contrat_id']);
        $traitement = trim($_POST['type_traitement_salaire_id']);
        $sql = "insert into contrat(date_debut,date_fin_prevue, date_fin_reel,fichier, salaire_base, employe_id, type_contrat_id,statut_contrat_id,type_traitement_salaire_id) values('$debut','$date_fin_prevue','$date_fin_reel','$fichier','$salaire_base','$employe','$contrat','$statut','$traitement')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=contrats&message=AddOk'; </script>";

        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from contrat where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=contrats&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['date_fin_prevue']) && ($_POST['date_fin_prevue'] != "")) {
                
                $debut = trim($_POST['date_debut']);
                $date_fin_prevue= trim($_POST['date_fin_prevue']);
                $predate_fin_prevue= trim($_POST['predate_fin_prevue']);
                $date_fin_reel = trim($_POST['date_fin_reel']);
                $fichier= trim($_POST['fichier']);
                $salaire_base = trim($_POST['salaire_base']);
                $employe = trim($_POST['employe_id']);
                $contrat = trim($_POST['type_contrat_id']);
                $statut = trim($_POST['statut_contrat_id']);
                $traitement = trim($_POST['type_traitement_salaire_id']);
                $sql = "update contrat  set date_debut='$debut', date_fin_prevue='$date_fin_prevue',fichier='$fichier', date_fin_reel='$date_fin_reel', salaire_base='$salaire_base',employe_id='$employe',type_contrat_id='$contrat',statut_contrat_id='$statut',type_traitement_salaire='$traitement' where id =" . trim($_POST['code_contrat']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=contrats&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from contrat where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }

$requete = mysqli_query($connection, "select * from employe");
$employes = mysqli_fetch_all($requete);

$requete = mysqli_query($connection, "select * from type_contrat");
$types = mysqli_fetch_all($requete);

$requete = mysqli_query($connection, "select * from statut_contrat");
$statuts = mysqli_fetch_all($requete);

$requete = mysqli_query($connection, "select * from type_traitement_salaire");
$traitements = mysqli_fetch_all($requete);


?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">contrat</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">contrat</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_contrat"><i class="fa fa-plus"></i> Ajouter</a>
                                                </div>
                                        </div>
                                </div>
                                <!-- /Page Header -->
                                
    <div class="row">
		<div class="col-md-12">
				<table class="table table-striped custom-table datatable">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Employé</th>
                      <th>Type de contrat</th>
                      <th>date fin de contrat</th>
                      <th>salaire_base</th>
                      <th>Statut du contrat</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from contrat inner join employe,type_contrat,statut_contrat,type_traitement_salaire where employe.id=contrat.employe_id and type_contrat.id=contrat.type_contrat_id and type_traitement_salaire.id=contrat.type_traitement_salaire_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $contrat) {
                                echo "
                                <tr>
                                        <td>" . $contrat['0'] . "</td>
                                        <td>" . $contrat['12'] . " " . $contrat['13'] . "</td>
                                        <td>" . $contrat['27'] . "</td>
                                        <td>" . $contrat['3'] . "</td>
                                        <td>" . $contrat['5'] . "</td>
                                        <td>" . $contrat['29'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' debut='".$contrat['1']."'  prevue='".$contrat['2']."' reel='".$contrat['3']."' fichier='".$contrat['4']."'  salaire='".$contrat['5']."' employe='".$contrat['12']." ".$contrat['13']."' type='".$contrat['27']."' statut='".$contrat['29']."' traitement='".$contrat['31']."' code='".$contrat['0']."' data-bs-toggle='modal' data-bs-target='#edit_contrat'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_contrat'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add contrat Modal -->
        <div id="add_contrat" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter un contrat</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=contrats" method="post">
                <div class="row">           
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Employé<span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="employe_id" id="" required >
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($employes as $employe) {
                                                                    echo '<option value="' . $employe[0] . '">' . $employe[2] . ' ' . $employe[3] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Type de contrat <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="type_contrat_id"  required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($types as $type) {
                                                                    echo '<option value="' . $type[0] . '">' . $type[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date début contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_debut" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date fin prevue du contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_fin_prevue" class="form-control" min="<?php echo $donnees['date_debut'] ; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date fin réel du contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_fin_reel" class="form-control" min="<?php echo $donnees['date_fin_prevue'] ; ?>">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">fichier</label>
                                                <input type="file" name="fichier" class="form-control" required >
                                            </div>
                                        </div>
                                 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Salaire de base</label>
                                                <span class="input-group-text">FCFA <input class="form-control" step="any" min="0" type="number" name="salaire_base" value=""></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Type traitement du salaire <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="type_traitement_salaire_id"  required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($traitements as $traitement) {
                                                                    echo '<option value="' . $traitement[0] . '">' . $traitement[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Statut contrat <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="statut_contrat_id"  required>
                                                            <option value="">Selectionnez</option>
                                                            <?php
                                                            foreach ($statuts as $statut) {
                                                                    echo '<option value="' . $statut[0] . '">' . $statut[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
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
        <!-- /Add contrat Modal -->
        
        <!-- Edit contrat Modal -->
        <div id="edit_contrat" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier contrat</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=contrats">
                <div class="row">
                                                      <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Employe<span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="employe_id" id="edit_employe" required>
                                                            <?php
                                                            foreach ($employes as $employe) {
                                                                    echo '<option value="' . $employe[0] . '">' . $employe[2] . ' ' . $employe[3] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Type de contrat <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="type_contrat_id" id="edit_type" required>
                                                            <?php
                                                            foreach ($types as $type) {
                                                                    echo '<option value="' . $type[0] . '">' . $type[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date début contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_debut" id="edit_debut" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date fin prevue du contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_fin_prevue" id="edit_prevue" class="form-control" min="<?php echo $donnees['date_debut'] ; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Date fin réel du contrat<span class="text-danger">*</span></label>
                                                <input type="date" name="date_fin_reel" id="edit_reel" class="form-control" min="<?php echo $donnees['date_fin_prevue'] ; ?>">
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">fichier</label>
                                                <input type="text" name="fichier" id="edit_fichier" class="form-control" required >
                                            </div>
                                        </div>
                                 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Salaire de base</label>
                                                <span class="input-group-text">FCFA<input class="form-control" step="any" min="0" type="number" name="salaire_base" id="edit_salaire" value=""></span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Type traitement du salaire <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="type_traitement_salaire_id" id="edit_traitement" required>
                                                            <?php
                                                            foreach ($traitements as $traitement) {
                                                                    echo '<option value="' . $traitement[0] . '">' . $traitement[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-group">
                                                <label>Statut contrat <span class="text-danger">*</span></label>
                                                <select class="select select2-hidden-accessible" name="statut_contrat_id" id="edit_statut" required>
                                                            <?php
                                                            foreach ($statuts as $statut) {
                                                                    echo '<option value="' . $statut[0] . '">' . $statut[1] . '</option>';
                                                            }
                                                            ?>
                                                    </select>
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
        <!-- /Edit contrat Modal -->

        <!-- Delete contrat Modal -->
        <div class="modal custom-modal fade" id="delete_contrat" role="dialog">
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
							<a href='<?php echo"./?page=contrats&delete=" . $contrat['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete contrat Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_debut").val( $(this).attr("debut"));
     $("#edit_prevue").val( $(this).attr("prevue"));
     $("#edit_reel").val( $(this).attr("reel"));
     $("#edit_fichier").val( $(this).attr("fichier"));
     $("#edit_salaire").val( $(this).attr("salaire"));
     $("#edit_employe").val( $(this).attr("employe"));
     $("#edit_type").val( $(this).attr("type"));
     $("#edit_traitement").val( $(this).attr("traitement"));
     $("#edit_statut").val( $(this).attr("statut"));
    
  });
});

</script>