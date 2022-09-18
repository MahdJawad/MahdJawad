<?php
if (isset($_POST['ajouter'])) {
        $numero = trim($_POST['numero_arrete_affectation']);
        $lieu = trim($_POST['lieu_affectation']);
        $affectation = trim($_POST['date_affectation']);
        $effet= trim($_POST['date_prise_effet']);
        $employe = trim($_POST['employe_id']);
        $sql = "insert into affectation(numero_arrete_affectation,lieu_affectation,date_affectation,date_prise_effet,employe_id,) values('$numero','$lieu','$affectation','$effet','$employe')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=affectations&message=AddOk'; </script>";
        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from affectation where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=affectations&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['numero_arrete_affectation']) && ($_POST['numero_arrete_affectation'] != "")) {
                $numero= trim($_POST['numero_arrete_affectation']);
                $lieu = trim($_POST['lieu_affectation']);
                $affectation = trim($_POST['date_affectation']);
                $effet= trim($_POST['date_prise_effet']);
                $employe = trim($_POST['employe_id']);
                 
                $sql = "update affectation set  numero_arrete_affectation='$numero',lieu_affectation='$lieu',date_affectation='$affectation',date_prise_effet='$effet',employe_id='$employe' where id =" . trim($_POST['code_affectation']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=affectations&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from affectation where id=" . trim($_GET['id']));
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
                                                        <h3 class="page-title">Affectation</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">affectation</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_affectation"><i class="fa fa-plus"></i> Ajouter</a>
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
                      <th>Date Affectation</th>
                      <th>Date prise effet</th>
                      <th>Lieu d'affectation</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from affectation inner join employe,departement where employe.id=affectation.employe_id and departement.id=affectation.";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $affectation) {
                                echo "
                                <tr>
                                        <td>" . $affectation['0'] . "</td>
                                        <td>" . $affectation['9'] . " " . $affectation['10'] . "</td>
                                        <td>" . $affectation['3'] . "</td>
                                        <td>" . $affectation['4'] . "</td>
                                        <td>" . $affectation['2'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' numero='".$affectation['1']."' lieu='".$affectation['2']."' affectation='".$affectation['3']."' effet='".$affectation['4']."' employe='".$affectation['9']." ".$affectation['10']."' code='".$affectation['0']."' data-bs-toggle='modal' data-bs-target='#edit_affectation'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_affectation'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add affectation Modal -->
        <div id="add_affectation" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter affectation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=affectations" method="post">
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
                <div class="form-group">
                    <label>Numéro arrété affectation<span class="text-danger">*</span></label>
                    <input type='text' class='form-control'  name='numero_arrete_affectation' value=''>
                    </div>
                    <div class="form-group">
                    <label>lieu affectation  <span class="text-danger">*</span></label>
                    <input type='text' class='form-control' name='lieu_affectation' value=''>
                    </div>
                  <div class="form-group">
                    <label>date_affectation <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_affectation" id="" cols="30" rows="10">
                  </div>
                  <div class="form-group">
                    <label>date_affectation <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_prise_effet" id="" cols="30" rows="10">
                  </div>
                  <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add affectation Modal -->
        
        <!-- Edit affectation Modal -->
        <div id="edit_affectation" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier affectation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=affectations">
                  
                  <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>Employe<span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_code" type="hidden" name="code_affectation" value="">
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
                    <label>Numéro arrété affectation<span class="text-danger">*</span></label>
                    <input type='text' class='form-control' id="edit_numero"  name='numero_arrete_affectation' value=''>
                    </div>
                    <div class="form-group">
                    <label>lieu affectation  <span class="text-danger">*</span></label>
                    <input type='text' class='form-control' id="edit_lieu" name='lieu_affectation' value=''>
                    </div>
                  <div class="form-group">
                    <label>date_affectation <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_affectation" id="edit_affectation" required>
                  </div>
                  <div class="form-group">
                    <label>date_affectation <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" name="date_prise_effet" id="edit_effet">
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit affectation Modal -->

        <!-- Delete affectation Modal -->
        <div class="modal custom-modal fade" id="delete_affectation" role="dialog">
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
							<a href='<?php echo"./?page=affectations&delete=" . $affectation['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete affectation Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_numero").val( $(this).attr("numero"));
     $("#edit_lieu").val( $(this).attr("lieu"));
     $("#edit_affectation").val( $(this).attr("affectation"));
     $("#edit_effet").val( $(this).attr("effet"));
     $("#edit_employe").val( $(this).attr("employe"));
  });
});

</script>