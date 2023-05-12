<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/sidebar', $data);	
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				New menu added!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu');
		}
		
	}

	public function submenu()
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/sidebar', $data);	
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				New Submenu added!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu/submenu');
		}
	}
	public function delete_menu($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('user_menu');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Menu Berhasil Dihapus!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu');
	}

	public function delete_sub_menu($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('user_sub_menu');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Submenu Berhasil Dihapus!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu/submenu');
	}

	public function update_menu()
	{
		$data['title'] = 'Menu Management';		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/sidebar', $data);	
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$id	= $this->input->post('id');
			$where = array('id' => $id);
			$data = array(
				'menu' => $this->input->post('menu')
			);
			$this->db->update('user_menu', $data, $where);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Menu was edited!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu');
		}
		
	}

	public function update_sub_menu()
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/sidebar', $data);	
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$id	= $this->input->post('id');
			$where = array('id' => $id);
			$data = array(
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			);
			$this->db->update('user_sub_menu', $data, $where);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Submenu was edited!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('menu/submenu');
		}
		
	}
}
?>