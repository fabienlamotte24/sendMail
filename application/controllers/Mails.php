<?php 

class Mails extends CI_Controller{
	//Méthode permettant l'affichage des mails
	public function index(){
		$data['title'] = 'Liste de vos mails préparés';
		$data['mails'] = $this->mails_model->get_all_mails();
		$this->load->view('templates/header');
		$this->load->view('mails/mails', $data);
		$this->load->view('templates/footer');
	}

	//Méthode de création de mail
	public function new_mail(){
		$data['title'] = 'Nouveau mail';
		//On autoload le security helper pour pouvoir profiter de la fonction xss_clean, qui protège contre les attaques de type xss
		$this->load->helper('security');

					/**
					*	Nous utilisont la fonction set_rules, qui définie aux champs les règles à respecter lors de la validation du formulaire
					*	Il fonctionne ainsi
					*	set_rules('champsEnBaseDeDonnée', 'champsDuFormulaire', 'regle1|regle2|regle3', [array('regle1') => 'message d'erreur personnalisé']);
					*/

		//Règle de vérification du champs title
		$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s]+$/]', 
			array(
				'required' => 'Veuillez écrire un <b>titre</b> pour votre template.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);
		//Règle de vérification du champs object
		$this->form_validation->set_rules('object', 'Object', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s]+$/]', 
			array(
				'required' => 'Veuillez écrire un <b>objet</b>.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);
		//Règle de vérification du champs body
		$this->form_validation->set_rules('body', 'Body', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s\!\:\;\,\.]+$/]', 
			array(
				'required' => 'Votre <b>mail</b> ne peut pas être vide.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);

		$config['upload'] = './uploads';
		$config['allowed_types'] = 'pdf';
        $config['max_size'] = 250;
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors() );
		} else {
			$data = array('upload_data' => $this->upload->data() );
		}
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('mails/newmail', $data);
			$this->load->view('templates/footer');
		} else {
			$this->mails_model->create_mail();
			redirect('mails');
		}
	}

	//Méthode d'édition d'un mail
	public function edit_mail($id){
		$data['title'] = 'Modification de votre template';
		$data['mail'] = $this->mails_model->get_one_mail($id);

		$this->load->helper('security');
		//Règle de vérification du champs title
		$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s]+$/]', 
			array(
				'required' => 'Veuillez écrire un <b>titre</b> pour votre template.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);
		//Règle de vérification du champs object
		$this->form_validation->set_rules('object', 'Object', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s]+$/]', 
			array(
				'required' => 'Veuillez écrire un <b>objet</b>.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);
		//Règle de vérification du champs body
		$this->form_validation->set_rules('body', 'Body', 'required|trim|xss_clean|regex_match[/^[a-zA-Zàçèéêâûîôù&\-\_\'\s\!\:\;\,\.]+$/]', 
			array(
				'required' => 'Votre <b>mail</b> ne peut pas être vide.',
				'xss_clean' => 'Le champs "{field}" contient des caractères non autorisé par xss_clean.',
				'regex_match' => 'Le champs "{field}" contient des caractères non autorisés.'
			)
		);
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('mails/editmail', $data);
			$this->load->view('templates/footer');
		} else {
			$this->mails_model->edit_mail($id);
			redirect('mails');
		}
	}

	//Méthode de suppression de mail
	public function delete($id){
		$this->mails_model->delete_mail($id);
		redirect('mails');
	}

	//Méthode d'activation de mail
	public function acivate_mail($id){
		$this->mails_model->acivate_mail($id);
		redirect('mails');
	}
}