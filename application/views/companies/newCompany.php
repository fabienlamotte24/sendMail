<h2><?php echo $title; ?></h2>
<ul class="d-flex list-unstyled">
	<li id="showDefault"><a href="<?php echo base_url();?>entreprises" class="btn btn-primary m-1">Affichage Standard</a></li>
	<li id="showList"><a href="<?php echo base_url();?>listshow" class="btn btn-primary m-1">Affichage Liste</a></li>
	<li id="addCompany"><a href="<?php echo base_url();?>newcompany" class="btn btn-primary m-1">Ajouter une entreprise</a></li>
</ul>
<br><br>
	<?php echo validation_errors(); ?>
	<!--Affichage d'un formulaire d'ajout d'entreprise-->
	<?php echo form_open('newcompany') ?>
	<div class="form-group text-center border border-dark bg-secondary offset-3 col-6 p-5">
		<h3>Ajout d'une entreprise</h3>
		<p class="text-danger">* mentions obligatoires<br />
			<span class="text-primary">Le téléphone et l'adresse email peuvent être ajoutés plus tard</span></p>
		<br>
			<!--Nom de l'entreprise-->
		<div class="form-group text-center">
			<label for="company_name">Nom de l'entreprise <span class="text-danger">*</span>:</label>
			<input type="text" name="company_name" id="company_name" class="form-control" />
		</div>
		<!--Adresse postale-->
		<div class="form-group text-center">			
			<label for="address">Adresse postale <span class="text-danger">*</span>:</label>
			<input type="text" name="address" id="address" class="form-control" />
		</div>
		<!--Code postal-->
		<div class="form-group text-center">
			<label for="postalCode">Code postal <span class="text-danger">*</span>:</label>
			<input type="text" name="postalCode" id="postalCode" maxlength="5" class="form-control" />
		</div>
		<!--Ville-->
		<div class="form-group text-center">
			<label for="city">Ville <span class="text-danger">*</span>:</label>
			<input type="text" name="city" id="city" class="form-control" />
		</div>
		<!--mail-->
		<div class="form-group text-center">
			<label for="mail">Adresse de messagerie:</label>
			<input type="mail" name="mail" id="mail" class="form-control" />
		</div>
		<!--Numéro de téléphone-->
		<div class="form-group text-center">
			<label for="phoneNumber">Numéro de téléphone:</label>
			<input type="text" name="phoneNumber" id="phoneNumber" maxlength="10" class="form-control" />
		</div>
		<!--url-->
		<div class="form-group text-center">
			<label for="url">Adresse Url <span class="text-danger">*</span>:</label>
			<input type="text" name="url" id="url" class="form-control" />
		</div>
		<!--Boutton de validation-->
		<div class="form-group text-center">
			<input type="submit" name="addNewCompany" class="form-control bt btn-primary mt-2" />
		</div>
	</div>
	</form>