<?php 

class Entreprises_model extends CI_Model{

	//Création d'une méthode magique constructeur
	public function __construct(){
		$this->load->database();
	}

	//Méthode pour obtenir les informations d'une entreprise
	public function get_company($id){
		$query = $this->db->get_where('companies', array('id' => $id));
		return $query->row_array();
	}

	//Méthode pour afficher toutes les entreprises
	public function get_all_companies(){
		$this->db->order_by('date_created', 'DESC');
		$query = $this->db->get_where('companies');
		return $query->result_array();
	}

	//Méthode pour obtenir la totalité des entreprises non contactées
	public function get_uncontacted_companies(){
		$query = $this->db->where('contacted', '0');
		$query = $this->db->order_by('date_created', 'DESC');
		$query = $this->db->get('companies');
		return $query->result_array();
	}

	//Méthode de création d'entreprise
	public function create_company(){
		$data = array(
			'company_name' => $this->input->post('company_name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'mail' => $this->input->post('mail'),
			'postalCode' => $this->input->post('postalCode'),
			'phone' => $this->input->post('phoneNumber'),
			'url' => $this->input->post('url'),
			'contacted' => '0',
			'date_contact' => NULL,
			'date_changed' => NULL,
			'date_created' => date('Y-m-d H:i:s'),
		);

		return $this->db->insert('companies', $data);
	}

	//Méthode d'édition d'une entreprise
	public function change_company($id){
		$data = array(
			'company_name' => $this->input->post('company_name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'mail' => $this->input->post('mail'),
			'postalCode' => $this->input->post('postalCode'),
			'phone' => $this->input->post('phoneNumber'),
			'date_changed' => date('Y-m-d H:i:s'),
			'url' => $this->input->post('url'),
		);	
		$this->db->where('id', $id);
		return $this->db->update('companies', $data);
	}

	//Méthode de suppression d'entreprise
	public function delete_company($id){
		$this->db->where('id', $id);
		$this->db->delete('companies');
		return true;
	}

	//Méthode d'envoi de mail
	public function send_mail($id){
		
	}
}