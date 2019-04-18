<h2><?php echo $title;?></h2>
<p><a href="<?php echo base_url();?>newmail" class="btn btn-primary">Nouveau mail</a></p>
<?php if(empty($mails)){ ?>
	<p>Vous n'avez aucun mail préparé</p>
<?php } else { ?>
<table class="table table-bordered table-hover bg-secondary table-sm">
	<thead class="bg-primary text-white">
		<tr>
			<th class="text-center">titre</th>
			<th class="text-center">Objet</th>
			<th class="text-center">Créé le...</th>
			<th class="text-center">Modifié le...</th>
			<th class="text-center">Etat</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
		 <?php foreach($mails as $mail): ?>
			<tr>
				<td class="text-center"><a class="text-primary" href="<?php echo base_url();?>editmail/<?php echo $mail['id'];?>"><?php echo $mail['title'] ?></a></td>
				<td class="text-center"><?php echo $mail['object'] ?></td>
				<td class="text-center"><?php echo $mail['created_at'] ?></td>
				<td class="text-center"><?php echo (is_null($mail['modified_at']))? 'non modifié' : $mail['modified_at'] ?></td>
				<td class="text-center"><?php 
				if($mail['activated'] === 0 || is_null($mail['activated'])){ ?>
					<?php form_open(base_url() . 'mails/acivate_mail/' . $mail['id']);?>
					<input type="submit" class="btn btn-primary" value="Sélectioner" />
					</form>
				<?php } else { ?>
					<button class="btn btn-info">Activé</button>
				<?php } ?></td>
				<td class="text-center">
					<?php echo form_open(base_url() . 'mails/delete/' . $mail['id']); ?>
						<input type="submit" value="Supprimer" class="btn btn-primary" />
					</form>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot class="bg-primary text-white">
		<tr>
			<th class="text-center">titre</th>
			<th class="text-center">Objet</th>
			<th class="text-center">Créé le...</th>
			<th class="text-center">Modifié le...</th>
			<th class="text-center">Etat</th>
			<th class="text-center">Actions</th>
		</tr>
	</tfoot>
</table>
<?php } ?>