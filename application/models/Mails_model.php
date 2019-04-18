<?php 

class Mails_model extends CI_Model{
	//Création d'une méthode magique constructeur
	public function __construct(){
		$this->load->database();
	}

	//Méthode pour afficher un seul mail
	public function get_one_mail($id){
		$query = $this->db->get_where('mail', array('id' => $id));
		return $query->row_array();
	}

	//Méthode pour afficher le mail activé
	public function get_activated_mail(){
		$query = $this->db->get_where('mail', array('activated' => 1));
		return $query->row_array();
	}

	//Méthode pour afficher tout les mails
	public function get_all_mails(){
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get_where('mail');
		return $query->result_array();
	}

	//Méthode de création d'entreprise
	public function create_mail(){
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('body'),
			'object' => $this->input->post('object'),
			'created_at' => date('Y-m-d H:i:s'),
			'cv' => $this->input->post('cv'),
			'activated' => 0,
		);
		return $this->db->insert('mail', $data);
	}

	//Méthode d'édition d'un mail
	public function edit_mail($id){
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('body'),
			'object' => $this->input->post('object'),
			'modified_at' => date('Y-m-d H:i:s'),
		);
		$this->db->where('id', $id);
		return $this->db->update('mail', $data);
	}

	//Méthode de suppression de mail
	public function delete_mail($id){
		$this->db->where('id', $id);
		$this->db->delete('mail');
		return true;
	}

	//Méthode d'activation de mail 
	public function acivate_mail($id){
		$this->db->where('id', $id);
		$this->db->update('mail');
	}
}