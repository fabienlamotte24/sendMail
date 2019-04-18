<h2><?php echo $title ?></h2>
<a href="<?php echo base_url();?>mails" class="btn btn-primary mb-5">Retour à la liste</a>
<!--Mail d'entré d'un nouveau mail-->
<?php echo form_open_multipart('newmail');?>
	<div class="form-group border border-dark bg-secondary p-5">
		<!--Titre du template de mail-->
		<div>
			<input type="text" name="title" id="title" class="form-control col-4" value="<?php echo (isset($_POST['title']))? $_POST['title'] : '' ?>" placeholder="Titre de votre template" />
		</div>
		<div>
			<input type="text" name="object" id="object" class="form-control col-4 mt-1" size="20" value="<?php echo (isset($_POST['object']))? $_POST['object'] : '' ?>" placeholder="Objet du mail" />
		</div>
		<div>
			<textarea name="body" class="form-control mt-1" id="body" cols="80" rows="6" placeholder="Votre mail"><?php echo (isset($_POST['body']))? $_POST['body'] : '' ?></textarea>
		</div>
		<div>
			<input type="file" name="cv" id="cv" class="form-control-file col-4 mt-1" size="20" />
		</div>
		<div>
			<input type="submit" name="createMail" value="Je crée mon template" class="btn btn-primary mt-2 text-right" />
		</div>
	</div>
	<?php echo validation_errors(); ?>
</form>