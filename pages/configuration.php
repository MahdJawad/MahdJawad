<?php
if (isset($_POST['ajouter'])) {
        $societe= trim($_POST['nom_societe']);
        $nif = trim($_POST['nif']);
        $rccm= trim($_POST['rccm']);
        $adresse = trim($_POST['adresse']);
        $telephone = trim($_POST['telephone']);
        $logo= trim($_POST['logo']);
        $pourcentage_charge_patronale_cnss = trim($_POST['pourcentage_charge_patronale_cnss']);
        $valeur_indiciaire = trim($_POST['valeur_indiciaire']);
        $sql = "insert into donnees_configuration(nom_societe,nif,rccm,adresse,valeur_indiciaire, telephone, logo,num_pourcentage_charge_patronale_cnss) values('$nom_societe','$nif','$rccm','$adresse','$valeur_indiciaire','$telephone','$logo','$num_pourcentage_charge_patronale_cnss')";
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=configuration&message=AddOk'; </script>";

        }
}

if (isset($_GET['delete'])) {
        $sql = "delete from donnees_configuration where id=" . $_GET['delete'];
        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if ($requete) {
            echo "<script type='text/javascript'>document.location.href='./?page=configuration&message=DeleteOk'; </script>";
        }
}
?>
<?php
if (isset($_POST['modifier'])) {
    if (isset($_POST['nom_societe']) && ($_POST['nom_societe'] != "")) {
            $societe= trim($_POST['nom_societe']);
            $nif = trim($_POST['nif']);
            $rccm= trim($_POST['rccm']);
            $adresse = trim($_POST['adresse']);
            $telephone = trim($_POST['telephone']);
            $logo= trim($_POST['logo']);
            $pourcentage_charge_patronale_cnss = trim($_POST['pourcentage_charge_patronale_cnss']);
            $valeur_indiciaire = trim($_POST['valeur_indiciaire']);
            $sql = "update donnees_configuration set nom_societe='$nom_societe',nif='$nif',rccm='$rccm',adresse='$adresse',valeur_indiciaire='$valeur_indiciaire', telephone='$telephone', logo='$logo',pourcentage_charge_patronale_cnss='$pourcentage_charge_patronale_cnss where id =" . trim($_GET['id']);;
            $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            if ($requete) {
                echo "<script type='text/javascript'>document.location.href='./?page=configuration&message=AddOk'; </script>";

            }
            
    }
    $requete = mysqli_query($connection, "select * from donnees_configuration where id=" . trim($_GET['id']));
    $resultat = mysqli_fetch_array($requete);
}

?>

<!-- Page Content -->
<div class="content container-fluid">
					<div class="row" >
						<div class="col-md-8 offset-md-2" id="leave_annual">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title with-switch">Les données de configuration</h3>
									</div>
								</div>
                            
							<!-- Annual Leave -->
							<div  id="leave_annual"class="leave-box" >
								<div>
									<div class="h3 card-title with-switch"> 											
										<div class="onoffswitch">
											<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_annual" checked>
											<label class="onoffswitch-label" for="switch_annual">
												<span class="onoffswitch-inner"></span>
												<span class="onoffswitch-switch"></span>
											</label>
										</div>
									</div>
									<div class="leave-item">
									
										<!-- Donnees de configuration -->
								    <div class="leave-row">
										<div class="leave-left">
                                                
                                            <div class="leave-right" >
                                    <?php
                                        $sql = "select * from donnees_configuration";
                                        $requete = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                                        $donnees = mysqli_fetch_all($requete);
                                        foreach ($donnees as $configuration) {
                                                echo "
                                        <button class='leave-edit-btn' societe='".$configuration['1']."' adresse='".$configuration['4']."' nif='".$configuration['2']."' rccm='".$configuration['3']."' telephone='".$configuration['5']."' logo='".$configuration['6']."' charge='".$configuration['7']."' valeur='".$configuration['8']."'  code='".$configuration['0']."'>Modifier</button>
                                        ";
                                    } ?>
								</div>
                            <form method="post" action="./?page=configuration">
								<div class="row">
									<div class="input-box">
										<div class="form-group">
											<label>Nom de la société <span class="text-danger">*</span></label>
											<input class="form-control" id="edit_nom_societe" type="text" name="nom_societe" value disabled>
										</div>
									</div>
									<div class="input-box">
										<div class="form-group">
											<label>Adresse de la société</label>
											<input class="form-control" id="edit_adresse" name="adresse" value type="text" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="input-box">
										<div class="form-group">
											<label>Telephone</label>
											<input type="text" id="edit_telephone" name="telephone" class="form-control" required  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" disabled>
										</div>
									</div>
                                </div>    
                                    <div class="settings-widget">
									<div class="h3 card-title with-switch">
										NIF & RCCM											
									</div>
									<div class="row">
										<div class="input-box">
											<div class="form-group">
												<label>NIF</label>
												<input type="number" id="edit_nif" class="form-control" min="0" name="nif" disabled>
											</div>
										</div>
										<div class="input-box">
											<div class="form-group">
												<label>RCCM</label>
												<input class="form-control" id="edit_rccm" type="number" min="0" name="rccm" disabled>
											</div>
										</div>
									</div>
								</div>
                                <div class="settings-widget">
									<div class="h3 card-title with-switch">
										Valeur indiciaire & Charge patronale										
									</div>
									<div class="row">
										<div class="input-box">
											<div class="form-group">
												<label>Valeur indiciaire</label>
												<input type="number" id="edit_valeur_indiciaire" class="form-control" name='valeur_indiciaire' min="0" disabled>
											</div>
										</div>
										<div class="input-box">
											<div class="form-group">
												<label>Charge patronale CNSS (%)</label>
												<input class="form-control" id="edit_charge" type="number" min="0" max="100" name="pourcentage_charge_patronale_cnss" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-7">
                                    <label class="col-lg-3 col-form-label">Logo de la société</label>
										<input type="file" name="logo" id="edit_logo" class="form-control" disabled>
										<span class="form-text text-muted">La taille recommandé est 40px x 40px</span>
									</div>
								</div>
							<!--	<div class="submit-section">
                                    <div class="leave-action">
									    <button class="btn btn-primary submit-btn" type="submit" name="ajouter">Enregistrer</button>
                                    </div>
								</div> 
                             -->
							</form>
										
							</div>
										<!-- /Donnees de configuration -->
						</div>
					</div>
                </div>
				<!-- /Page Content -->
<script> 
$(document).ready(function(){
  $('.leave-edit-btn').click(function(){
     $("#edit_code").val( $(this).attr("code"));
     $("#edit_nom_societe").val( $(this).attr("societe"));
     $("#edit_adresse").val( $(this).attr("adresse"));
     $("#edit_nif").val( $(this).attr("nif"));
     $("#edit_rccm").val( $(this).attr("rccm"));
     $("#edit_telephone").val( $(this).attr("telephone"));
     $("#edit_charge").val( $(this).attr("charge"));
     $("#edit_valeur_indiciaire").val( $(this).attr("valeur"));
     $("#edit_logo").val( $(this).attr("logo"));
     
  });
});
$(document).on('click', '.leave-edit-btn', function() {
		$(this).removeClass('leave-edit-btn').addClass('btn btn-white leave-cancel-btn').text('Cancel');
		$(this).closest("div.configuration-right").append('<button class="btn btn-primary leave-save-btn" name="modifier" type="submit">Save</button>');
		$(this).parent().parent().find("input").prop('disabled', false);
		return false;
    });
	$(document).on('click', '.leave-cancel-btn', function() {
		$(this).removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Modifier');
		$(this).closest("div.configuration-right").find(".leave-save-btn").remove();
		$(this).parent().parent().find("input").prop('disabled', true);
		return false;
	});
    $(document).on('change', '.leave-box .onoffswitch-checkbox', function() {
		var id = $(this).attr('id').split('_')[1];
		if ($(this).prop("checked") == true) {
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', false);
			$("#leave_"+id+" .leave-action .btn").prop('disabled', false);
		}
	    else {
			$("#leave_"+id+" .leave-action .btn").prop('disabled', true);	
			$("#leave_"+id+" .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
			$("#leave_"+id+" .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
			$("#leave_"+id+" .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', true);
		}
	});
    $('.leave-box .onoffswitch-checkbox').each(function() {
		var id = $(this).attr('id').split('_')[1];
		if ($(this).prop("checked") == true) {
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', false);
			$("#leave_"+id+" .leave-action .btn").prop('disabled', false);
		}
	    else {
			$("#leave_"+id+" .leave-action .btn").prop('disabled', true);	
			$("#leave_"+id+" .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
			$("#leave_"+id+" .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
			$("#leave_"+id+" .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
			$("#leave_"+id+" .leave-edit-btn").prop('disabled', true);
		}
	});
</script>