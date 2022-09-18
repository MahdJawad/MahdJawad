<?php
if (isset($_POST['ajouter'])) {
        $numero= trim($_POST['numero_arrete_avancement']);
        $fonction = trim($_POST['nouvelle_fonction']);
        $avancement = trim($_POST['date_avancement']);
        $employe = trim($_POST['employe_id']);
        $departement = trim($_POST['departement_id']);
        $sql = "insert into avancement(numero_arrete_avancement,nouvelle_fonction,date_avancement,employe_id,departement_id) values('$numero','$fonction','$avancement','$employe','$departement')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=avancements&message=AddOk'; </script>";
        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from avancement where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=avancements&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['numero_arrete_avancement']) && ($_POST['numero_arrete_avancement'] != "")) {
                $numero= trim($_POST['numero_arrete_avancement']);
                $fonction = trim($_POST['nouvelle_fonction']);
                $avancement = trim($_POST['date_avancement']);
                $employe = trim($_POST['employe_id']);
                $departement = trim($_POST['departement_id']);
                $sql = "update avancement set  numero_arrete_avancement='$numero',nouvelle_fonction='$fonction',date_avancement='$avancement',='',employe_id='$employe',departement_id='$departement' where id =" . trim($_POST['code_avancement']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=avancements&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from avancement where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
    $requete = mysqli_query($connection, "select * from employe");
    $employes = mysqli_fetch_all($requete);
    $requete = mysqli_query($connection, "select * from departement");
    $departements = mysqli_fetch_all($requete);
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">Avancement</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">avancement</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_avancement"><i class="fa fa-plus"></i> Ajouter</a>
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
                      <th>Département</th>
                      <th>Date avancement</th>
                      <th>Nouvelle fonction</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from avancement inner join employe,departement where employe.id=avancement.employe_id and departement.id=avancement.departement_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $avancement) {
                                echo "
                                <tr>
                                        <td>" . $avancement['0'] . "</td>
                                        <td>" . $avancement['8'] . " " . $avancement['9'] . "</td>
                                        <td>" . $avancement['23'] . "</td>
                                        <td>" . $avancement['2'] . "</td>
                                        <td>" . $avancement['3'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' numero='".$avancement['1']."' numero='".$avancement['1']."' fonction='".$avancement['3']."' avancement='".$avancement['2']."' employe='".$avancement['8']." ".$avancement['9']."' departement='".$avancement['23']."' code='".$avancement['0']."' data-bs-toggle='modal' data-bs-target='#edit_avancement'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_avancement'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add avancement Modal -->
        <div id="add_avancement" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter avancement</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=avancements" method="post">
                <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Employe<span class="text-danger">*</span></label>
                      <select class="select" name="employe_id" id="" required >
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
                  <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Département<span class="text-danger">*</span></label>
                      <select class="select" name="departement_id"  required >
                        <option value="">Selectionnez</option>
                          <?php
                            foreach ($departements as $departement) 
                            {
                              echo '<option value="' . $departement[0] . '">' . $departement[1] . '</option>';
                            }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label>Numéro arrété avancement<span class="text-danger">*</span></label>
                    <input type='text' class='form-control'  name='numero_arrete_avancement' value=''>
                </div>
                    <div class="form-group">
                    <label>Nouvelle fonction  <span class="text-danger">*</span></label>
                    <input type='text' class='form-control' name='nouvelle_fonction' value=''>
                    </div>
                  <div class="form-group">
                    <label>Date avancement <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_avancement" id="" required>
                  </div>
                  <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add avancement Modal -->
        
        <!-- Edit avancement Modal -->
        <div id="edit_avancement" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier avancement</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=avancements">
                  
                  <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Employe<span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_code" type="hidden" name="code_avancement" value="">
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
                  <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Département<span class="text-danger">*</span></label>
                      <select class="select" name="departement_id" id="edit_departement" required >
                        <option value="">Selectionnez</option>
                          <?php
                            foreach ($departements as $departement) 
                            {
                              echo '<option value="' . $departement[0] . '">' . $departement[1] . '</option>';
                            }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label>Numéro arrété avancement<span class="text-danger">*</span></label>
                    <input type='text' class='form-control'  name='numero_arrete_avancement' id="numero" value=''>
                    </div>
                    <div class="form-group">
                    <label>Nouvelle fonction  <span class="text-danger">*</span></label>
                    <input type='text' class='form-control' name='nouvelle_fonction' id="edit_fonction" value=''>
                    </div>
                  <div class="form-group">
                    <label>Date avancement <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_avancement" id="edit_avancement" required>
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit avancement Modal -->

        <!-- Delete avancement Modal -->
        <div class="modal custom-modal fade" id="delete_avancement" role="dialog">
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
							<a href='<?php echo"./?page=avancements&delete=" . $avancement['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete avancement Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_numero").val( $(this).attr("numero"));
     $("#edit_fonction").val( $(this).attr("fonction"));
     $("#edit_avancement").val( $(this).attr("avancement"));
     $("#edit_employe").val( $(this).attr("employe"));
     $("#edit_departement").val( $(this).attr("departement"));
  });
});

</script>