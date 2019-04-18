<h2><?php echo $title;?></h2>
<?php echo form_open('editmail/' . $mail['id']) ?>
	<div class="form-group border border-dark bg-secondary p-5">
		<!--Champs titre du template-->
		<div>
			<input type="text" name="title" id="title" class="form-control" value="<?php echo $mail['title'] ?>" placeholder="Titre de votre template" />
		</div>
		<!--Champs objet-->
		<div>
			<input type="text" name="object" id="object" class="form-control mt-1" value="<?php echo $mail['object'] ?>" placeholder="L\'objet de votre mail" />
		</div>
		<!--Champs corps du mail-->
		<div>
			<textarea name="body" class="form-control mt-1" id="body" cols="80" rows="6" placeholder="Votre mail"><?php echo $mail['body'] ?></textarea>
		</div>
		<div>
			<input type="submit" name="body" id="body" value="Modifier le template" class="btn btn-primary mt-2 text-right" />
		</div>
	</div>
	<?php echo validation_errors(); ?>
</form>