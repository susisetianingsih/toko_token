<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['te'] = $this->menu_model->getTotalUser();
		$data['tt'] = $this->menu_model->getTotalAdmin();
		$data['tu'] = $this->menu_model->getTotalMember();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function all_user()
	{
		$data['title'] = 'All User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'all');

		$data['list'] = $this->all->getAllUser();
		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique'	=> 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'

		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('role_id', 'Role id', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/all_user', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name'			=> htmlspecialchars($this->input->post('name', true)),
				'email'			=> htmlspecialchars($this->input->post('email', true)),
				'image'			=> 'default.jpg',
				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id'		=> htmlspecialchars($this->input->post('role_id', true)),
				'is_active'		=> 1,
				'date_created'	=> time()

			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				New account added!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('admin/all_user');
		}
	}

	public function task()
	{
		$data['title'] = 'Task';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model', 'all');

		$data['pemesanan'] = $this->all->getAllPemesanan();

		$this->form_validation->set_rules('token', 'Token', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/task', $data);
			$this->load->view('templates/footer');
		} else {

			$data = [
				'status'				=> 3,
				'token'					=> htmlspecialchars($this->input->post('token', true)),
			];

			$id = $this->input->post('id_pemesanan');
			$this->db->set($data);
			$this->db->where('id_pemesanan', $id);
			$this->db->update('pemesanan');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Token berhasil diberikan!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('admin/task');
		}
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				New role added!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('admin/role');
		}
	}

	public function roleAccess($role_id)
	{

		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role_access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id'	=> $role_id,
			'menu_id'	=> $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Access changed!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
	}

	public function delete_role($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Role Berhasil Dihapus!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
		redirect('admin/role');
	}

	public function delete_user($id)
	{
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->delete('user');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Data Role Berhasil Dihapus!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
		redirect('admin/all_user');
	}

	public function update_role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$id	= $this->input->post('id');
			$where = array('id' => $id);
			$data = array(
				'role' => $this->input->post('role')
			);
			$this->db->update('user_role', $data, $where);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Role was edited!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('admin/role');
		}
	}

	public function update_user()
	{
		$data['title'] = 'All User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model', 'menu');

		$data['list'] = $this->menu->getAllUser();
		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]', [
			'min_length' => 'password too short!'

		]);
		$this->form_validation->set_rules('role_id', 'Role id', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/all_user', $data);
			$this->load->view('templates/footer');
		} else {
			$id	= $this->input->post('id');
			$where = array('id' => $id);
			$data = array(
				'name'			=> htmlspecialchars($this->input->post('name', true)),
				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id'		=> htmlspecialchars($this->input->post('role_id', true))

			);
			$this->db->set($data);
			$this->db->where($where);
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Role was edited!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('admin/all_user');
		}
	}
}
