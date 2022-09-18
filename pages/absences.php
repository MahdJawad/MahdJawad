<?php
if (isset($_POST['ajouter'])) {
        $debut= trim($_POST['date_debut_absence']);
        $fin = trim($_POST['date_fin_absence']);
        $motif = trim($_POST['motif']);
        $employe = trim($_POST['employe_id']);
        $sql = "insert into absence(date_debut_absence,date_debut_absence,date_fin_absence,motif_absence,employe_id) values('$date_debut_absence','$date_fin_absence','$motif','$employe')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=absences&message=AddOk'; </script>";
        }
}

$requete = mysqli_query($connection, "select * from employe");
$employes = mysqli_fetch_all($requete);

if (isset($_GET['delete'])) {
        $sql = "delete from absence where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=absences&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['date_debut_absence']) && ($_POST['date_debut_absence'] != "")) {
                $debut= trim($_POST['date_debut_absence']);
                $fin = trim($_POST['date_fin_absence']);
                $motif = trim($_POST['motif']);
                $employe = trim($_POST['employe_id']);
                $sql = "update absence set  date_debut_absence='$date_debut_absence',date_fin_absence='$date_fin_absence',motif='$motif',employe_id='$employe' where id =" . trim($_POST['code_absence']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=absences&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from absence where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
   
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">absence</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">absence</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_absence"><i class="fa fa-plus"></i> Ajouter</a>
                                                </div>
                                        </div>
                                </div>
                                <!-- /Page Header -->
                                
<div class="row">
            <div class="col-md-12">
              <div>
                <table class="table table-striped custom-table mb-0 datatable">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Employe</th>
                      <th>Du</th>
                      <th>AU</th>
                      <th>Motif</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from absence inner join employe on employe.id=absence.employe_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $absence) {
                                echo "
                                <tr>
                                        <td>" . $absence['0'] . "</td>
                                        <td>" . $absence['6'] . "</td>
                                        <td>" . $absence['1'] . "</td>
                                        <td>" . $absence['2'] . "</td>
                                        <td>" . $absence['3'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' debut='".$absence['1']."' fin='".$absence['2']."' motif='".$absence['3']."' employe='".$absence['6']."' code='".$absence['0']."' data-bs-toggle='modal' data-bs-target='#edit_absence'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_absence'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add absence Modal -->
        <div id="add_absence" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter absence</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=absences" method="post">
                <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Employe<span class="text-danger">*</span></label>
                      <select class="select select2-hidden-accessible" name="employe_id" id="" required >
                        <option value="">Selectionnez</option>
                          <?php
                            foreach ($employes as $employe) 
                            {
                              echo '<option value="' . $employe[0] . '">' . $employe[2] . ' ' . $employe[3] . '</option>';
                            }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label>Début absence<span class="text-danger">*</span></label>
                    <input type='date' class='form-control'  name='date_debut_absence' value=''>
                    </div>
                    <div class="form-group">
                    <label>Fin absence  <span class="text-danger">*</span></label>
                    <input type='date' class='form-control' name='date_fin_absence' value=''>
                    </div>
                  <div class="form-group">
                    <label>Motif <span class="text-danger">*</span></label>
                    <textarea class="form-control" type="text" name="motif" id="" cols="30" rows="10"></textarea>
                  </div>
                  <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add absence Modal -->
        
        <!-- Edit absence Modal -->
        <div id="edit_absence" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier absence</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=absences">
                  
                  <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Employe<span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_code" type="hidden" name="code_absence" value="">
                      <select class="select select2-hidden-accessible" name="employe_id" id="edit-employe" required >
                        <option value="">Selectionnez</option>
                          <?php
                            foreach ($employes as $employe) 
                            {
                              echo '<option value="' . $employe[0] . '">' . $employe[2] . ' ' . $employe[3] . '</option>';
                            }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label>Début absence<span class="text-danger">*</span></label>
                    <input type='date' class='form-control' id="edit-debut"  name='debut_periode' value=''>
                    </div>
                    <div class="form-group">
                    <label>Fin absence  <span class="text-danger">*</span></label>
                    <input type='date' class='form-control' id="edit-fin" name='fin_periode' value=''>
                    </div>
                  <div class="form-group">
                    <label>Motif <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="edit-motif" type="text" name="motif" id="" cols="30" rows="10"></textarea>
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit absence Modal -->

        <!-- Delete absence Modal -->
        <div class="modal custom-modal fade" id="delete_absence" role="dialog">
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
							<a href='<?php echo"./?page=absences&delete=" . $absence['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete absence Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_debut").val( $(this).attr("debut"));
     $("#edit_fin").val( $(this).attr("fin"));
     $("#edit_motif").val( $(this).attr("motif"));
     $("#edit_employe").val( $(this).attr("employe"));
  });
});

</script>