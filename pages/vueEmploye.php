<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['employe_id']) && ($_POST['employe_id'] != "")) {
                
                $employe = trim($_POST['employe_id']);
                $indemnite= trim($_POST['indemnite_id']);
                $valeur = trim($_POST['valeur']);
                $sql = "update employe_has_indemnite  set employe_id='$employe', indemnite_id='$indemnite', valeur='$valeur' where employe_id =" . trim($_POST['code_employe']);
                $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($requete) {

                        echo "<script type='text/javascript'>document.location.href='./?page=vueEmploye&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from employe_has_indemnite where employe_id=" . trim($_GET['employe_id']));
        $resultat = mysqli_fetch_array($requete);
    }

$requete = mysqli_query($connection, "select * from employe");
$employes = mysqli_fetch_all($requete);
$requete = mysqli_query($connection, "select * from indemnite");
$indemnites = mysqli_fetch_all($requete);
?>
<?php
if (isset($_POST['Charge'])) {
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

                        echo "<script type='text/javascript'>document.location.href='./?page=vueEmploye&message=ModifOk'; </script>";
                }
        }
        $requete = mysqli_query($connection, "select * from charge where id=" . trim($_GET['id']));
        $resultat = mysqli_fetch_array($requete);
    }

$requete = mysqli_query($connection, "select * from employe");
$employes = mysqli_fetch_all($requete);


?>
<!-- Page Header -->
<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Détails de l'employé</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Acceuil</a></li>
									<li class="breadcrumb-item active">Employé</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
                                                    <?php
                        $sql = "select * from employe inner join classe,categorie,echelon,departement where classe.id=employe.classe_id and categorie.id=employe.categorie_id and echelon.id=employe.echelon_id and departement.id=employe.departement_id";
                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                        $donnees = mysqli_fetch_all($requete);
                        foreach ($donnees as $employe) {
                                echo "
														<h3 class='user-name m-t-0 mb-0'>" . $employe['2'] . " " . $employe['3'] . "</h3>
														<h6 class='text-muted'>" . $employe['23'] ." </h6>
														<small class='text-muted'>" . $employe['6'] ."</small>
														<div class='staff-id'>Matricule : " . $employe['1'] ."</div>";
                                                    } ?>
														<div class="small doj text-muted">Date de début : 
                                                        <?php
														
                                                        $sql = "select * from contrat inner join type_contrat,employe,statut_contrat,type_traitement_salaire where type_contrat.id = contrat.type_contrat_id and employe.id=contrat.employe_id and statut_contrat.id=contrat.statut_contrat_id and type_traitement_salaire.id=contrat.type_traitement_salaire_id ";
                                                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                                                        $donnees = mysqli_fetch_all($requete);
                                                         foreach ($donnees as $resultat) {
														 echo" 
                                                         " . $resultat['1'] ."  
                                                         ";}?></div>
														<div class="staff-msg">
                                                        <?php
														 echo
														  $employe['17']. " " . $employe['21']. " " . $employe['19'] ;?></div>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Telephone:</div>
															<div class="text"><?php echo $employe['9'] ;?></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><?php echo  $employe['10'] ;?></div>
														</li>
														<li>
															<div class="title">Date de naissance:</div>
															<div class="text"><?php echo $employe['4'] ;?></div>
														</li>
														<li>
															<div class="title">Adresse:</div>
															<div class="text"><?php echo $employe['5'] ;?></div>
														</li>
														<li>
															<div class="title">Genre:</div>
															<div class="text"><?php echo $employe['8'] ; ?></div>
														</li>
														
                        
													</ul>
												</div>
											</div>
										</div>
										
								</div>
							</div>
						</div>
					</div>
                    <div class="card tab-box">
						<div class="row user-tabs">
							<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
								<ul class="nav nav-tabs nav-tabs-bottom">
									<li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Détails</a></li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-content">
					
						<!-- Profile Info Tab -->
						<div id="emp_profile" class="pro-overview tab-pane fade show active">
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class='card-title'>Configuration de l'indemnité 
                                            <?php
														
                                                        $sql = "select * from employe_has_indemnite inner join employe,indemnite where employe.id = employe_has_indemnite.employe_id and indemnite.id=employe_has_indemnite.indemnite_id ";
                                                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                                                        $donnees = mysqli_fetch_all($requete);
                                                         foreach ($donnees as $resultat) {
														 echo" 
                                                         <a href='#' class='dropdown-item' <?php echo indemnite='".$indemnite['4']."',employe='".$employe['0']."',valeur='".$valeur['2']."' ;?> data-bs-toggle='modal' data-bs-target='#edit_indemnite'><i class='fa fa-pencil'></i></a></h3>
											<ul class='personal-info'>
                                           
												<li>
													<div class='title'>Employé</div>
													<div class='text'> " . $resultat['8']. " " . $resultat['9'] ."</div>
												</li>
												<li>
													<div class='title'>Indemnité</div>
													<div class='text'>" . $resultat['2'] ."</div>
												</li>
												<li>
													<div class='title'>Le montant de l'indemnité</div>
													<div class='text'>" . $resultat['4'] ."</div>
												</li>
                                                ";
                                            }?>
											</ul>
										</div>
									</div>
								</div>

								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title">Charge familiale <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
											<div class="table-responsive">
												<table class="table table-nowrap">
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
							</div>
							
			<!-- /Profile Info Tab -->
            <!-- Edit charge Modal -->
        <div id="edit_charge" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier employé</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=vueEmploye">
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
                                                    <input class="form-control" id="edit_code" type="hidden" name="code_charge" value="">
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
                                                <input type="telephone" name="telephone" class="form-control" id="edit_telephone" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}">
                                            </div>
                                        </div>
                                      
                                        
                                        
                                </div>
                  <div class="submit-section">
                    <button name="charge" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit charge Modal -->
        <!-- Edit indemnite Modal -->
        <div id="edit_indemnite" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier indemnite</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                <form method="post" action="./?page=vueEmploye">
                  <div class="form-group">
                    <label>Montant de l'indemnité <span class="text-danger">*</span></label>
                    <span class="input-group-text">FCFA</span>
                    <input class="form-control" step="any" id="edit_valeur" type="text" name="valeur_indemnite" value="">
					          <span class="input-group-text">.00</span>
                    <input class="form-control" id="edit_employe" type="hidden" name="employe" value="">
                    <input class="form-control" id="edit_indemnite" type="hidden" name="indemnite" value="">
                  </div>
                  <div class="submit-section">
                    <button name="modifier" class="btn btn-primary submit-btn"  type="submit">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit indemnite Modal --> 
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
<script> 
$(document).ready(function(){
  $('.btn-modif').click(function(){
     $("#edit_employe").val( $(this).attr("employe"));
     $("#edit_indemnite").val( $(this).attr("indemnite"));
     $("#edit_valeur").val( $(this).attr("valeur"));
     
    
  });
});

</script>