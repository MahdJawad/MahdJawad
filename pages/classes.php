<?php
if (isset($_POST['ajouter'])) {
        $libelle = trim($_POST['libelle_classe']);
        $sql = "insert into classe(libelle_classe) values('$libelle')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=classes&message=AddOk'; </script>";

        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from classe where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
          echo "<script type='text/javascript'>document.location.href='./?page=classes&message=DeleteOk'; </script>";

        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['libelle_classe']) && ($_POST['libelle_classe'] != "")) {
        $libelle = trim($_POST['libelle_classe']);
                $sql = "update classe set  libelle_classe='$libelle' where id =" . trim($_POST['code_classe']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=classes&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from classe where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">Classe</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">classe</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_classe"><i class="fa fa-plus"></i> Ajouter</a>
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
                      <th>Libellé de la classe</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        $sql = "select * from classe";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $classe) {
                                echo "
                                <tr>
                                        <td>" . $classe['0'] . "</td>
                                        <td>" . $classe['1'] . "</td>
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' libelle='".$classe['1']."' code='".$classe['0']."' data-bs-toggle='modal' data-bs-target='#edit_classe'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_classe'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add classe Modal -->
        <div id="add_classe" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter classe</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=classes" method="post">
                  <div class="form-group">
                    <label>Libellé de la classe <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="libelle_classe" required>
                  </div>
                  <div class="submit-section">
                    <button name="ajouter" type="submit" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add classe Modal -->
        
        <!-- Edit classe Modal -->
        <div id="edit_classe" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier classe</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=classes">
                  <div class="form-group">
                    <label>Libellé de la classe <span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_libelle" type="text" name="libelle_classe" value="">
                    <input class="form-control" id="edit_code" type="hidden" name="code_classe" value="">
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit classe Modal -->

        <!-- Delete classe Modal -->
        <div class="modal custom-modal fade" id="delete_classe" role="dialog">
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
							<a href='<?php echo"./?page=classes&delete=" . $classe['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete classe Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_libelle").val( $(this).attr("libelle"));
  });
});

</script>