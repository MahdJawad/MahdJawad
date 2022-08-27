<?php
if (isset($_POST['ajouter'])) {
        $libelle = trim($_POST['libelle_mois']);
        $sql = "insert into mois(libelle_mois) values('$libelle')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<span> Enregistrement effectué avec succès </span>";
                echo "<script type='text/javascript'>document.location.href='./?page=mois'; </script>";
        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from mois where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<span> Suppression effectuée avec succès </span>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['libelle_mois']) && ($_POST['libelle_mois'] != "")) {
        $libelle = trim($_POST['libelle_mois']);
                $sql = "update mois set  libelle_mois='$libelle' where id =" . trim($_POST['code_mois']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=mois&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from mois where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">Mois</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">mois</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_mois"><i class="fa fa-plus"></i> Ajouter</a>
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
                      <th>Libellé du mois</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from mois";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $mois) {
                                echo "
                                <tr>
                                        <td>" . $mois['0'] . "</td>
                                        <td>" . $mois['1'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' libelle='".$mois['1']."' code='".$mois['0']."' data-bs-toggle='modal' data-bs-target='#edit_mois'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_mois'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add mois Modal -->
        <div id="add_mois" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter mois</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=mois" method="post">
                  <div class="form-group">
                    <label>Libellé du mois <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="libelle_mois">
                  </div>
                  <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add mois Modal -->
        
        <!-- Edit mois Modal -->
        <div id="edit_mois" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier mois</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=mois">
                  <div class="form-group">
                    <label>Libellé du mois <span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_libelle" type="text" name="libelle_mois" value="">
                    <input class="form-control" id="edit_code" type="hidden" name="code_mois" value="">
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit mois Modal -->

        <!-- Delete mois Modal -->
        <div class="modal custom-modal fade" id="delete_mois" role="dialog">
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
							<a href='<?php echo"./?page=mois&delete=" . $mois['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete mois Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_libelle").val( $(this).attr("libelle"));
  });
});

</script>