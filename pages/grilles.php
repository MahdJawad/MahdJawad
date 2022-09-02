<?php
if (isset($_POST['ajouter'])) {
        $valeur = trim($_POST['valeur']);
        $echelon = trim($_POST['echelon_id']);
        $categorie = trim($_POST['categorie_id']);
        $classe = trim($_POST['classe_id']);
        $sql = "insert into grille(valeur,echelon_id,categorie_id,classe_id) values('$valeur','$echelon','$categorie','$classe')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<script type='text/javascript'>document.location.href='./?page=grilles'; </script>";
        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from grille where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
                echo "<span> Suppression effectuée avec succès </span>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['valeur']) && ($_POST['valeur'] != "")) {
        $valeur = trim($_POST['valeur']);
        $echelon = trim($_POST['echelon_id']);
        $categorie = trim($_POST['categorie_id']);
        $classe = trim($_POST['classe_id']);
                $sql = "update grille set  valeur='$valeur',echelon_id='$echelon',categorie_id='$categorie',classe_id='$classe' where id =" . trim($_POST['code_grille']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=grilles&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from grille where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }
$requete = mysqli_query($connection, "select * from classe");
$classes = mysqli_fetch_all($requete);
$requete = mysqli_query($connection, "select * from categorie");
$categories = mysqli_fetch_all($requete);
$requete = mysqli_query($connection, "select * from echelon");
$echelons = mysqli_fetch_all($requete);

?>
<!-- Page Content -->
<div class="content container-fluid">
				
                                <!-- Page Header -->
                                <div class="page-header">
                                        <div class="row align-items-center">
                                                <div class="col">
                                                        <h3 class="page-title">grille</h3>
                                                        <ul class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="">Acceuil</a></li>
                                                                <li class="breadcrumb-item active">grille</li>
                                                        </ul>
                                                </div>
                                                <div class="col-auto float-end ms-auto">
                                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_grille"><i class="fa fa-plus"></i> Ajouter</a>
                                                </div>
                                        </div>
                                </div>
                                <!-- /Page Header -->
                                
<div class="row">
            <div class="col-md-12">
              <div>
                <table class="table table-striped custom-table mb-0 datatable">
                  <thead>
                  <tr style="height: 1cm;">
                    <th style="width: 53.95pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="72"><b><span style="font-size: 12pt;"></span></b></td>
                    <th colspan="4" style="width: 184.75pt; border-top-width: 1pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-top-color: windowtext; border-left: none; padding: 0cm 5.4pt; height: 1cm; text-align: center;" width="246"><b><span style="font-size: 12pt;">2&egrave;me CLASSE</span></b></th>
                    <th colspan="3" style="width: 138.3pt; border-top-width: 1pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-top-color: windowtext; border-left: none; padding: 0cm 5.4pt; height: 1cm; text-align: center;" width="184"><b><span style="font-size: 12pt;">1&egrave;re CLASSE</span></b></th>
                    <th colspan="3" style="width: 138.3pt; border-top-width: 1pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-top-color: windowtext; border-left: none; padding: 0cm 5.4pt; height: 1cm; text-align: center;" width="184"><b><span style="font-size: 12pt;">CLASSE PRINCIPALE</span></b></th>
                    <th colspan="4" style="width: 184.4pt; border-top-width: 1pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-top-color: windowtext; border-left: none; padding: 0cm 5.4pt; height: 1cm; text-align: center;" width="246"><b><span style="font-size: 12pt;">CLASSE EXCEPTIONNELLE</span></b></th>
                    <th>Action</th>
                </tr>
                   
                  </thead>
                  <tbody>
                    
                  <tr style="height: 1cm;">
                    <td style="width: 53.95pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-top: none; padding: 0cm 5.4pt; height: 1cm;" width="72"><b>CATEGORIE</b></td>
                    <td style="width: 46.45pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="62">1<sup>er</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">2<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">3<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">4<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">1<sup>er</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">2<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">3<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">1<sup>er</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">2<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">3<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">1<sup>er</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">2<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">3<sup>e</sup> Ech</td>
                    <td style="width: 46.1pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;" width="61">4<sup>e</sup> Ech</td>
                    </tr>
                 
                     <?php
                        $sql = "select * from grille inner join echelon,categorie,classe where echelon.id=grille.echelon_id and categorie.id=grille.categorie_id and classe.id=grille.classe_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $grille) {
                                echo "
                                <tr style='height: 1cm;'>
                                        <th style='width: 53.95pt; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-top: none; padding: 0cm 5.4pt; height: 1cm;' width='72'><b>" . $grille['8'] . "</b></td>
                                        <td style='width: 46.45pt; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 1cm;' width='62'>" . $grille['1'] . "</td>
                                        
                                        <td class='text-end'>
                                        <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                            <div class='dropdown-menu dropdown-menu-right'>
                                                <a class='dropdown-item btn-modifier' href='#' categorie='".$grille['8']."' classe='".$grille['10']."' echelon='".$grille['6']."' valeur='".$grille['1']."' code='".$grille['0']."' data-bs-toggle='modal' data-bs-target='#edit_grille'><i class='fa fa-pencil m-r-5'></i> Modifier</a>
                                                <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_grille'><i class='fa fa-trash-o m-r-5'></i> supprimer</a>
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
        
        <!-- Add grille Modal -->
        <div id="add_grille" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajouter grille</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./?page=grilles" method="post">
                  <div class="form-group">
                    <label>Classe <span class="text-danger">*</span></label>
                    <select class="form-control" name="classe_id" id="" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($classes as $classe) {
                                        echo '<option value="' . $classe[0] . '">' . $classe[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Echelon <span class="text-danger">*</span></label>
                    <select class="form-control" name="echelon_id" id="" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($echelons as $echelon) {
                                        echo '<option value="' . $echelon[0] . '">' . $echelon[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Categorie <span class="text-danger">*</span></label>
                    <select class="form-control" name="categorie_id" id="" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($categories as $categorie) {
                                        echo '<option value="' . $categorie[0] . '">' . $categorie[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Valeur indiciére <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="valeur">
                  </div>
                  <div class="submit-section">
                    <button type="submit" name="ajouter" class="btn btn-primary submit-btn">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add grille Modal -->
        
        <!-- Edit grille Modal -->
        <div id="edit_grille" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier grille</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=grilles">
                  
                  <div class="form-group">
                    <label>Classe <span class="text-danger">*</span></label>
                    <select class="form-control" name="classe_id" id="edit_classe" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($classes as $classe) {
                                        echo '<option value="' . $classe[0] . '">' . $classe[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Echelon <span class="text-danger">*</span></label>
                    <select class="form-control" name="echelon_id" id="edit_echelon" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($echelons as $echelon) {
                                        echo '<option value="' . $echelon[0] . '">' . $echelon[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Categorie <span class="text-danger">*</span></label>
                    <select class="form-control" name="categorie_id" id="edit_categorie" required>
                                <option value="">Selectionnez</option>
                                <?php
                                foreach ($categories as $categorie) {
                                        echo '<option value="' . $categorie[0] . '">' . $categorie[1] . '</option>';
                                }
                                ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Valeur indiciére <span class="text-danger">*</span></label>
                    <input class="form-control" id="edit_valeur" type="text" name="valeur">
                    <input class="form-control" id="edit_code" type="hidden" name="code_grille" value="">

                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit grille Modal -->

        <!-- Delete grille Modal -->
        <div class="modal custom-modal fade" id="delete_grille" role="dialog">
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
							<a href='<?php echo"./?page=grilles&delete=" . $grille['0'] . "";?>' class="btn btn-primary continue-btn">supprimer</a>
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
        <!-- /Delete grille Modal -- -->
<script> 
$(document).ready(function(){
  $('.btn-modifier').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_valeur").val( $(this).attr("valeur"));
     $("#edit_categorie").val( $(this).attr("categorie"));
     $("#edit_echelon").val( $(this).attr("echelon"));
     $("#edit_classe").val( $(this).attr("classe"));
  });
});

</script>