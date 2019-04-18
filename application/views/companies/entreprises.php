<h2><?php echo $title; ?></h2>
<ul class="d-flex list-unstyled">
	<li id="showDefault"><a href="<?php echo base_url();?>entreprises" class="btn btn-primary m-1">Affichage Standard</a></li>
	<li id="showList"><a href="<?php echo base_url();?>listshow" class="btn btn-primary m-1">Affichage Liste</a></li>
	<li id="addCompany"><a href="<?php echo base_url();?>newcompany" class="btn btn-primary m-1">Ajouter une entreprise</a></li>
</ul>
<br>
<div>
	<p>Voici une présentation des entreprises que vous n'avez pas encore contacté</p>
</div>
<div class="offset-3 col-6 mb-3">
	<?php echo form_open(current_url(), array('id' => 'researchBar')) ?>
		<div class="input-group">
		    <input type="text" name="result" id="research" class="form-control" placeholder="Entrez un nom de ville ou d'entreprise" />
		    <div class="input-group-append">
		      <button class="btn btn-secondary" id="submit_research" type="submit">
		        <i class="fa fa-search"></i>
		      </button>
		    </div>
	  	</div>
	<?php echo form_close();?>
</div>
<?php
//Condition pour afficher un message adapté si toutes les entreprises ont toutes déjà été contactées
if(is_null($companies)) { ?>
	<p>Vous n'avez plus d'entreprises à contacter</p>
<?php } else { ?>
<div><?php echo $pagination;?></div>
	<!--Affichage standard des entreprises-->
	<div class="container" id="defaultCompanies">
		<!--Création d'une boucle pour afficher toutes les entreprises-->
		<?php foreach ($companies as $company) : ?>
			<div class="border border-dark p-5 row">
				<div class="col-6">
					<!--Nom de l'entreprise avec un lien cliquable-->
					<h3>
						<!--target="_blank" pour ouvrir un nouvel onglet navigateur au click de ce lien-->
						<a  class="text-primary" href="<?php echo $company['url'] ?>" target="_blank">
							<?php echo $company['company_name']; ?>
						</a>
					</h3>
					<small>Ajouté le <?php echo $company['date_created']; ?></small>
					<!--Liste d'informations de l'entreprise-->
					<ul class="list-inline">
						<!--Numéro de téléphone-->
						<li>
							<i class="fas fa-mobile-alt"></i> : <?php echo ($company['phone'] != '0') ? '0' . $company['phone'] : '<span class="text-danger">Aucun de numéro de téléphone enregistré</span>'; ?>
						</li>
						<!--Addresse postale-->
						<li>
							<i class="far fa-envelope"></i> : <?php echo $company['address'] . ' ' . ((strlen($company['postalCode']) === 4)? '0' . $company['postalCode'] : $company['postalCode']) . ' <b>' . $company['city'] . '</b>'; ?>
						</li>
						<!--Adresse E-mail-->
						<li>
							<i class="fas fa-at"></i> : <?php echo ($company['mail'] != '')? $company['mail'] : '<span class="text-danger">Aucune addresse E-mail enregistrées</span>';?>
						</li>
					</ul>
				</div>
				<div class="col-6 text-right">
					<ul class="list-unstyled">
						<li class="mb-1"><a href="<?php echo base_url();?>changecompany/<?php echo $company['id'];?>" class="btn btn-primary">Editer</a></li>
						<li class="mb-1"><a href="<?php echo base_url();?>" class="btn btn-info">Envoyer candidature</a></li>
						<?php echo form_open(base_url() . 'entreprises/delete/' . $company['id']); ?>
							<li class="mb-1"><input type="submit" value="Supprimer" class="btn btn-danger" /></li>
						<?php echo form_close();?>
					</ul>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php } ?>
<div class="mt-3"><?php echo $pagination;?></div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#researchBar").submit(function(e){
			e.preventDefault();
			var form = $(this);
			var research = $('#research').val();
			$.post(form.attr('action'), form.serialize(), function(data){research:research}, 'json');
		});
	});
</script>