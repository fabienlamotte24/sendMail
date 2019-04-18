<h2><?php echo $title; ?></h2>
<ul class="d-flex list-unstyled">
	<li id="showDefault"><a href="<?php echo base_url();?>entreprises" class="btn btn-primary m-1">Affichage Standard</a></li>
	<li id="showList"><a href="<?php echo base_url();?>listshow" class="btn btn-primary m-1">Affichage Liste</a></li>
	<li id="addCompany"><a href="<?php echo base_url();?>newcompany" class="btn btn-primary m-1">Ajouter une entreprise</a></li>
</ul>
<br><br>
	<small class="text-center"><b><?php echo validation_errors(); ?></b></small>
	<!--Affichage d'un formulaire d'ajout d'entreprise-->
	<?php echo form_open('changecompany/' . $company['id']) ?>
	<div class="form-group text-center border border-dark bg-secondary offset-3 col-6 p-5">
		<h3>Informations de l'entreprise</h3>
		<p class="text-danger">* mentions obligatoires<br />
			<span class="text-primary">Le téléphone et l'adresse E-mail pourront être ajoutés plus tard</span></p>
		<br>
		<!--Nom de l'entreprise-->
		<div class="form-group text-center">
			<label for="company_name">Nom de l'entreprise</label>
			<input type="text" name="company_name" id="company_name" class="text-center form-control" value="<?php echo $company['company_name'];?>" />
		</div>
		<!--Adresse postale-->
		<div class="form-group text-center">
			<label for="address">Adresse postale <span class="text-danger">*</span>:</label>
			<input type="text" name="address" id="address" class="form-control text-center" value="<?php echo $company['address'];?>" />
		</div>
		<!--Code postal-->
		<div class="form-group text-center">
			<label for="postalCode">Code postal <span class="text-danger">*</span>:</label>
			<input type="text" name="postalCode" id="postalCode" maxlength="5" class="form-control text-center" value="<?php echo (strlen($company['postalCode']) === 4 )? '0' . $company['postalCode'] : $company['postalCode'];?>" />
		</div>
		<!--Ville-->
		<div class="form-group text-center">
			<label for="city">Ville <span class="text-danger">*</span>:</label>
			<input type="text" name="city" id="city" class="form-control text-center" value="<?php echo $company['city'];?>" />
		</div>
		<!--mail-->
		<div class="form-group text-center">
			<label for="mail">Adresse de messagerie:</label>
			<input type="mail" name="mail" id="mail" class="form-control text-center" value="<?php echo $company['mail'];?>" />
		</div>
		<!--Numéro de téléphone-->
		<div class="form-group text-center">
			<label for="phoneNumber">Numéro de téléphone:</label>
			<input type="text" name="phoneNumber" id="phoneNumber" maxlength="10" class="form-control text-center" value="<?php echo (strlen($company['phone']) === 9 )? '0' . $company['phone'] : $company['phone'];?>" />
		</div>
		<!--url-->
		<div class="form-group text-center">
			<label for="url">Adresse Url <span class="text-danger">*</span>:</label>
			<input type="text" name="url" id="url" class="form-control text-center" value="<?php echo $company['url']; ?>" />
		</div>
		<div>
			<input type="hidden" name="id" value="<?php echo $company['id'];?>" />
		</div>
		<!--Boutton de validation-->
		<div class="form-group text-center">
			<input type="submit" name="changeCompany" class="form-control bt btn-primary mt-2" />
		</div>
	</div>
	</form>