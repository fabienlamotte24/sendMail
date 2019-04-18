<h2><?php echo $title; ?></h2>
<ul class="d-flex list-unstyled">
	<li id="showDefault"><a href="<?php echo base_url();?>entreprises" class="btn btn-primary m-1">Affichage Standard</a></li>
	<li id="showList"><a href="<?php echo base_url();?>listshow" class="btn btn-primary m-1">Affichage Liste</a></li>
	<li id="addCompany"><a href="<?php echo base_url();?>newcompany" class="btn btn-primary m-1">Ajouter une entreprise</a></li>
</ul>
<br><br>
<?php 
//Condition pour afficher un message adapté si toutes les entreprises ont toutes déjà été contactées
if(is_null($companies)) { ?>
	<p>Aucune entreprise n'est enregistrée</p>
<?php } else { ?>
	<!--Création d'un tableau pour exposer les différentes entreprises-->
	<table class="table table-bordered table-hover bg-secondary table-sm" >
		<thead class="bg-primary text-white">
			<tr>
				<th class="text-center">Nom</th>
				<th class="text-center">Adresse</th>
				<th class="text-center">City</th>
				<th class="text-center">Mail</th>
				<th class="text-center">Téléphone</th>
				<th class="text-center">Contacté</th>
				<th class="text-center">Contacté le</th>
				<th class="text-center">Ajouté le</th>
				<th class="text-center">Modifié le</th>
				<th colspan="3" class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
			<!--Utilisation de la boucle comme utilisée plus haut pour afficher les entreprises-->
				<?php foreach($companies as $company) : ?>
					<tr>
						<td class="text-center">
							<a class="text-primary" href="<?php echo $company['url'] ?>" target="_blank">
								<b><?php echo $company['company_name']; ?></b>
							</a>
						</td>
						<td class="text-center"><?php echo $company['address'] . ' ' . ((strlen($company['postalCode']) === 4)? '0' . $company['postalCode'] : $company['postalCode']);?></td>
						<td class="text-center"><?php echo '<b>' . $company['city'] . '</b>';?></td>
						<td class="text-center"><?php echo ($company['mail'] != '')? $company['mail'] : '<span class="text-danger">Pas d\'E-mail</span>';?></td>
						<td class="text-center"><?php echo ($company['phone'] != '0') ? '0' . $company['phone'] : '<span class="text-danger">Pas de téléphone</span>';?></td>
						<td class="text-center"><?php echo ($company['contacted'] === '0')? 'Non' : 'Oui';?></td>
						<td class="text-center"><?php echo ($company['date_contact'] != '')? $company['date_contact'] : 'Non contacté';?></td>
						<td class="text-center"><?php echo $company['date_created'];?></td>
						<td class="text-center"><?php echo ($company['date_changed'] != '')? $company['date_changed'] : 'Non modifié';?></td>
						<td class="text-center"><?php 
							if($company['contacted'] === '0'){?>
								<!--Boutton d'envoi de candidature-->
								<?php form_open(base_url() . 'entreprises/send_mail/' . $company['id']); ?>
									<input type="hidden" value="<?php echo $company['id'] ?>" />
									<input type="submit" value="Candidater" class="btn btn-primary" />
								</form>
							<?php } else {?>
								<button class="btn btn-info">Envoyé</button>
							<?php } ?></td>
						<td class="text-center"><a href="<?php echo base_url();?>changecompany/<?php echo $company['id'];?>" class="btn btn-primary">Editer</a></td>
						<td class="text-center">
							<?php echo form_open(base_url() . 'entreprises/delete_in_list/' . $company['id']); ?>
								<input type="submit" value="Supprimer" class="btn btn-primary" />
							</form>
					</td>
					</tr>
				<?php endforeach ?>
		</tbody>
		<tfoot class="bg-primary text-white">
			<tr>
				<th class="text-center">Nom</th>
				<th class="text-center">Adresse</th>
				<th class="text-center">City</th>
				<th class="text-center">Mail</th>
				<th class="text-center">Téléphone</th>
				<th class="text-center">Contacté</th>
				<th class="text-center">Contacté le</th>
				<th class="text-center">Ajouté le</th>
				<th class="text-center">Modifié le</th>
				<th colspan="3" class="text-center">Actions</th>
			</tr>
		</tfoot>
	</table>
<?php } ?>