<?php 

//Création class Pages qui est un controller
 class Pages extends CI_Controller{
 	//Méthode d'affichage de la vue
 	public function view($page = 'accueil'){
 		//Condition qui autorise l'affichage uniquement si le fichier existe
 		if(!file_exists(APPPATH . 'views/pages/' . $page . '.php')){
 			show_404();
 		}

 		//Paramètrage du titre de la page Home
 		$data['title'] = ucfirst($page);

 		//Chargement des vues
 		$this->load->view('templates/header');
 		$this->load->view('pages/' . $page, $data);
 		$this->load->view('templates/footer');
 	}
 }