<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Entreprises extends CI_Controller{

	//Méthode permettant l'affichage des entreprises en vue classique
	public function index(){

		//Titre de la page
		$data['title'] = 'Les entreprises à contacter';

		//On charge la librairie pagination
		$this->load->library('pagination');
		if($this->input->is_ajax_request()){
			echo $this->input->post($result);
			//On exécute la requête limitant la rechercher à 2
			/*$query = $this->db->order_by('date_created', 'DESC');
			$query = $this->db->where('contacted', '0');
			$query = $this->db->like($this->input->post('result'));
			$query = $this->db->get('companies', '2', $this->uri->segment(2));
			$data['companies'] = $query->result_array();*/
		} else {
			//On exécute la requête limitant la rechercher à 2
			$query = $this->db->order_by('date_created', 'DESC');
			$query = $this->db->where('contacted', '0');
			$query = $this->db->get('companies', '2', $this->uri->segment(2));
			$data['companies'] = $query->result_array();
			//Nombre total de ligne pour la pagination
			$config['total_rows'] =  count($this->entreprises_model->get_uncontacted_companies());
		}

		//On paramètre le système de pagination
		$config['base_url'] = base_url() . 'entreprises';
		//Nombre de résultat à afficher 
		$config['per_page'] = 2;

		//Paramétrage bootstrap de la liste numérotée de la pagination
		$config['full_tag_open'] 	= '<div class="pagging text-center"><nav class=""><ul class="pagination justify-content-center text-white">';
		$config['full_tag_close'] 	= '</ul></nav></div>';
		
		$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link text-white bg-primary">';
		$config['num_tag_close'] 	= '</span></li>';
		
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link text-white bg-primary">';
		$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
		
		$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link text-white bg-primary">';
		$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
		
		$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link text-white bg-primary">';
		$config['prev_tagl_close'] 	= '</span></li>';
		
		$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link text-white bg-primary">';
		$config['first_tagl_close'] = '</span></li>';
		
		$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link text-white bg-primary">';
		$config['last_tagl_close'] 	= '</span></li>';

		//On initialise la pagination une fois configurée
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		//On charge les vues pour afficher le rendu final de la page
		$this->load->view('templates/header');
		$this->load->view('companies/entreprises', $data);
		$this->load->view('templates/footer');
	}

	//Méthode permettant l'affichage des entreprises sous forme de liste
	public function listShow(){
		$data['title'] = 'Liste de toutes les entreprises';
		$data['companies'] = $this->entreprises_model->get_all_companies();
		$this->load->view('templates/header');
		$this->load->view('companies/listshow', $data);
		$this->load->view('templates/footer');
	}

	//Méthode permettant l'affichage du formulaire d'inscription d'une entreprise
	public function newCompany(){
		$data['title'] = 'Formulaire';
		//On autoload le security helper pour pouvoir profiter de la fonction xss_clean, qui protège contre les attaques de type xss
		$this->load->helper('security');

					/**
					*	Nous utilisont la fonction set_rules, qui définie aux champs les règles à respecter lors de la validation du formulaire
					*	Il fonctionne ainsi
					*	set_rules('champsEnBaseDeDonnée', 'champsDuFormulaire', 'regle1|regle2|regle3', [array('regle1') => 'message d'erreur personnalisé']);
					*/

		//Vérification du champs nameCompany
		$this->form_validation->set_rules('company_name', 'Company_name', 'required|is_unique[companies.company_name]|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\s\']+$/]',
			array(
				'is_unique' => 'Cette entreprise existe déjà',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			));

		//Vérification du champs address
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean|regex_match[/^[a-zA-Z0-9àçèéêâûîôù&\-\_\s\']+$/]', 
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			));

		//Vérification du champs city
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\']+$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs postalCode
		$this->form_validation->set_rules('postalCode', 'PostalCode', 'trim|required|xss_clean|regex_match[/^[0-9]{5}$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs url
		$this->form_validation->set_rules('url', 'Url', 'trim|required|xss_clean|regex_match[/^[a-z0-9\.\/\ç\:\-\_]+$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs mail
		$this->form_validation->set_rules('mail', 'Mail', 'trim|xss_clean|regex_match[/^[a-zA-Z0-9\.\/\ç\:\-\_\@àçèéùôîûêâ&]+$/]|valid_email',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.',
				'valid_email' => 'Votre adresse de messagerie n\'est pas valide'
			)
		);

		//Vérification du champs phone
		$this->form_validation->set_rules('phone', 'PhoneNumber', 'trim|xss_clean|regex_match[/^[0]{1}[6,7]{1}[0-9]{8}$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.',
			)
		);

		//Gestion d'affichage des erreurs ou des réussites
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('companies/newcompany', $data);
			$this->load->view('templates/footer');
		} else {
			//Si tout est bon on affiche la liste des entreprises en vue classique
			$this->entreprises_model->create_company();
			redirect('entreprises');
		}
	}

	//Méthode permettant l'édition d'une entreprise
	public function changecompany($id){
		$data['title'] = "Changement des informations";
		$data['company'] = $this->entreprises_model->get_company($id);
		//On autoload le security helper pour pouvoir profiter de la fonction xss_clean, qui protège contre les attaques de type xss
		$this->load->helper('security');
					/**
					*	Nous utilisont la fonction set_rules, qui définie aux champs les règles à respecter lors de la validation du formulaire
					*	Il fonctionne ainsi
					*	set_rules('champsEnBaseDeDonnée', 'champsDuFormulaire', 'regle1|regle2|regle3', [array('regle1') => 'message d'erreur personnalisé']);
					*/
		//Cette vérification a pour but de permettre la modification du nom de l'entreprise si une erreur a été faite lors de la première saisie en base de données
		//On traduis cela comme 'si le nom en base de données est la même que celle de l'input'
		if(strtolower($data['company']['company_name']) == strtolower($this->input->post('company_name'))){
			//On vérifie en ignorant le "is_unique"
			$this->form_validation->set_rules('company_name', 'Company_name', 'trim|required|xss_clean|regex_match[/^[A-Za-zàçèéêâûîôù&\-\_\s\']+$/]',
				array(
					'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
					'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
				));
		} else {
			//Autrement, on active le "is_unique" pour éviter les doublons
			$this->form_validation->set_rules('company_name', 'Company_name', 'is_unique[companies.company_name]|trim|required|xss_clean|regex_match[/^[A-Za-zàçèéêâûîôù&\-\_\s\']+$/]',
				array(
					'is_unique' => 'Cette entreprise existe déjà !',
					'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
					'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
				));
		}


		//Vérification du champs address
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean|regex_match[/^[a-zA-Z0-9àçèéêâûîôù&\-\_\s\']+$/]', 
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			));

		//Vérification du champs city
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\']+$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs postalCode
		$this->form_validation->set_rules('postalCode', 'PostalCode', 'trim|required|xss_clean|regex_match[/^[0-9]{5}$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs url
		$this->form_validation->set_rules('url', 'Url', 'trim|required|xss_clean|regex_match[/^[a-z0-9\.\/\ç\:\-\_]+$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.'
			)
		);

		//Vérification du champs mail
		$this->form_validation->set_rules('mail', 'Mail', 'trim|xss_clean|valid_email|regex_match[/^[a-zA-Z0-9\.\/\ç\:\-\_\@àçèéùôîûêâ&]+$/]|valid_email',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.',
				'valid_email' => 'Votre adresse de messagerie n\'est pas valide'
			)
		);

		//Vérification du champs phone
		$this->form_validation->set_rules('phone', 'PhoneNumber', 'trim|xss_clean|regex_match[/^[0]{1}[6,7]{1}[0-9]{8}$/]',
			array(
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères interdits.',
			)
		);

		//Gestion d'affichage des erreurs ou des réussites
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('companies/changecompany', $data);
			$this->load->view('templates/footer');
		} else {
			//Si tout est bon on affiche la liste des entreprises en vue classique
			$this->entreprises_model->change_company($id);
			redirect('entreprises');
		}
	}

	//Méthode de suppression d'entreprise avec redirection sur vue classique
	public function delete($id){
		$this->entreprises_model->delete_company($id);
		redirect('entreprises');
	}
	//Méthode de suppression d'entreprise avec redirection sur vue liste
	public function delete_in_list($id){
		$this->entreprises_model->delete_company($id);
		redirect('listshow');
	}
	public function send_mail($id){
		
	}
}