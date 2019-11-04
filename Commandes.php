<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commandes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('clients_model','Produits_model','Commandes_model'));
	}

	public function index(){
		$data['commandes'] = $this->Commandes_model->getAllCommandes();
		$this->load->view('commandes/commandes_list.php', $data);
	}

	public function addnew(){
		$data['clients'] = $this->clients_model->getAllClients();
		$data['produits'] = $this->Produits_model->getAllProduits();
		$this->load->view('commandes/addform.php', $data);
	}

	public function insert(){
		$commande['client_id'] = $this->input->post('client_id');
		$commande['produit_id'] = $this->input->post('produit_id');
		$commande['qtecmd'] = $this->input->post('qtecmd');
		$commande['datecmd'] = $this->input->post('datecmd');		
		$query = $this->Commandes_model->insertCommande($commande);

		if($query){
			header('location:'.base_url('index.php/cmd/index'));
		}

	}

	public function edit($id_cmd){
		$data['clients'] = $this->clients_model->getAllClients();
		$data['produits'] = $this->Produits_model->getAllProduits();
		$data['commande'] = $this->Commandes_model->getCommande($id_cmd);
		$this->load->view('commandes/editform.php', $data);
	}

	public function update($id_cmd){
		$commande['client_id'] = $this->input->post('client_id');
		$commande['produit_id'] = $this->input->post('produit_id');
		$commande['qtecmd'] = $this->input->post('qtecmd');
		$commande['datecmd'] = $this->input->post('datecmd');

		$query = $this->Commandes_model->updateCommande($commande, $id_cmd);

		if($query){
			header('location:'.base_url('index.php/cmd/index'));
		}
	}

	public function delete($id_cmd){
		$query = $this->Commandes_model->deleteCommande($id_cmd);

		if($query){
			header('location:'.base_url('index.php/cmd/index'));
		}
	}
}


?>