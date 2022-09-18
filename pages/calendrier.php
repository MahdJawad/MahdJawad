<?php
if (isset($_POST['ajouter'])) {
        $libelle = trim($_POST['libelle_annee']);
        $date = trim($_POST['date_edition_salaire']);
        $base = trim($_POST['base_mois']);
        $debut = trim($_POST['debut_periode']);
        $fin = trim($_POST['fin_periode']);
        $mois = trim($_POST['mois_id']);
        $sql = "insert into calendrier(libelle_annee,date_edition_salaire,base_mois,debut_periode,fin_periode,mois_id) values('$libelle','$date','$base','$debut','$fin','$mois')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=calendrier&message=AddOk'; </script>";

        }
        
}

if (isset($_GET['delete'])) {
        $sql = "delete from calendrier where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=calendrier&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['libelle_annee']) && ($_POST['libelle_annee'] != "")) {
                $libelle = trim($_POST['libelle_annee']);
                $date = trim($_POST['date_edition_salaire']);
                $base = trim($_POST['base_mois']);
                $debut = trim($_POST['debut_periode']);
                $fin = trim($_POST['fin_periode']);
                $mois = trim($_POST['mois_id']);
                $sql = "update calendrier set  libelle_annee='$libelle',date_edition_salaire='$date',base_mois='$base',debut_periode='$debut',fin_periode='$fin',mois_id='$mois' where id =" . trim($_POST['code_annee']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=calendrier&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from calendrier where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
    $requete = mysqli_query($connection, "select * from mois");
    $mois = mysqli_fetch_all($requete);
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">calendrier</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">calendrier</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_annee"><i class="fa fa-plus"></i> Ajouter</a>
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
                      <th>Début periode salaire</th>
                      <th>Fin periode salaire</th>
                      <th>Base du mois</th>
                      <th>Mois de salaire</th>
                      <th>Année de salaire</th>
                      <th>Date d'édition salaire</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from calendrier inner join mois on mois.id=calendrier.mois_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $calendrier) {
                                echo "
                                <tr>
                                        <td>" . $calendrier['0'] . "</td>
                                        <td>" . $calendrier['4'] . "</td>
                                        <td>" . $calendrier['5'] . "</td>
                                        <td>" . $calendrier['3'] . "</td>
                                        <td>" . $calendrier['8'] . "</td>
                                        <td>" . $calendrier['1'] . "</td>
                                        <td>" . $calendrier['2'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' libelle='".$calendrier['1']."' date='".$calendrier['2']."' base='".$calendrier['3']."' debut='".$calendrier['4']."' fin='".$calendrier['5']."' mois='".$calendrier['8']."' code='".$calendrier['0']."' data-bs-toggle='modal' data-bs-target='#edit_annee'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_annee'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add calendrier Modal -->
        <div id="add_annee" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Configurer calendrier</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=calendrier" method="post">
                    <div class="form-group">
                        <label>Le Mois de salaire<span class="text-danger">*</span></label>
                            <select class="select select2-hidden-accessible" name="mois_id" id="" required >
                                <option value="">Selectionnez</option>
                                    <?php
                                        foreach ($mois as $moi) 
                                        {
                                            echo '<option value="' . $moi[0] . '">' . $moi[1] . '</option>';
                                                            }
                                                            ?>
                            </select>
                    </div>
                    <div class="form-group">
                    <label>Libellé de l'année <span class="text-danger">*</span></label>
                    <input type='text' class='form-control'  name='libelle_annee' value=''>
                    </div>
                    <div class="form-group">
                    <label>Début période salaire<span class="text-danger">*</span></label>
                    <input type='date' class='form-control'  name='debut_periode' value=''>
                    </div>
                    <div class="form-group">
                    <label>Fin période salaire  <span class="text-danger">*</span></label>
                    <input type='date' class='form-control' name='fin_periode' value=''>
                    </div>
                    <div class="form-group">
                    <label>Base du mois<span class="text-danger">*</span></label>
                    <input type='number' class='form-control'  name='base_mois' min='0' max='30' value=''>
                    </div>
                    <div class="form-group">
                    <label>Date édition salaire<span class="text-danger">*</span></label>
                    <input type='date' class='form-control'  name='date_edition_salaire_salaire' value=''>
                    </div>
          
                <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add calendrier Modal -->
        
        <!-- Edit calendrier Modal -->
        <div id="edit_annee" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier calendrier</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=calendrier">
                  <div class="form-group">
                        <label>Le Mois de salaire<span class="text-danger">*</span></label>
                            <select class="select select2-hidden-accessible" name="employe_id" id="edit_mois" required >
                                <option value="">Selectionnez</option>
                                    <?php
                                        foreach ($mois as $moi) 
                                        {
                                            echo '<option value="' . $moi[0] . '">' . $moi[1] . '</option>';
                                                            }
                                                            ?>
                            </select>
                    </div>
                    <div class="form-group">
                    <label>Libellé de l'année <span class="text-danger">*</span></label>
                    <input type='text' class='form-control' id='edit_libelle' name='libelle_annee' value=''>
                    <input class="form-control" id="edit_code" type="hidden" name="code_annee" value="">
                    </div>
                    <div class="form-group">
                    <label>Début période salaire<span class="text-danger">*</span></label>
                    <input type='date' class='form-control' id='edit_debut' name='debut_periode' value=''>
                    </div>
                    <div class="form-group">
                    <label>Fin période salaire  <span class="text-danger">*</span></label>
                    <input type='date' class='form-control' id='edit_fin' name='fin_periode' value=''>
                    </div>
                    <div class="form-group">
                    <label>Base du mois<span class="text-danger">*</span></label>
                    <input type='number' class='form-control' id='edit_base' name='base_mois' min='0' max='30' value=''>
                    </div>
                    <div class="form-group">
                    <label>Date édition salaire<span class="text-danger">*</span></label>
                    <input type='date' class='form-control' id='edit_date' name='date_edition_salaire_salaire' value=''>
                    </div>
             
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit calendrier Modal -->

        <!-- Delete calendrier Modal -->
        <div class="modal custom-modal fade" id="delete_annee" role="dialog">
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
							<a href='<?php echo"./?page=calendrier&delete=" . $calendrier['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete calendrier Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_libelle").val( $(this).attr("libelle"));
     $("#edit_date").val( $(this).attr("date"));
     $("#edit_base").val( $(this).attr("base"));
     $("#edit_debut").val( $(this).attr("debut"));
     $("#edit_fin").val( $(this).attr("fin"));
     $("#edit_mois").val( $(this).attr("mois"));
  });
});

</script>