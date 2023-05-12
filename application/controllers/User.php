<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Beranda';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function profil()
	{
		$data['title'] = 'Profilku';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/profil', $data);
		$this->load->view('templates/footer');
	}

	public function pemesanan()
	{
		$data['title'] = 'Pemesanan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['token'] = $this->db->get('token')->result_array();

		$this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'required|trim|min_length[12]|numeric', [
			'numeric' => 'ID Pelanggan harus diisi angka',
			'min_length' => 'ID Pelanggan terlalu pendek'

		]);
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');
		$this->form_validation->set_rules('email_user', 'User', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/pemesanan', $data);
			$this->load->view('templates/footer');
		} else {
			$total = 0;
			$harga = htmlspecialchars($this->input->post('harga', true));
			$jumlah = htmlspecialchars($this->input->post('jumlah', true));
			$total = $harga * $jumlah + 3000;
			$data = [
				'id_pelanggan'		=> htmlspecialchars($this->input->post('id_pelanggan', true)),
				'jumlah'			=> $jumlah,
				'harga'				=> $harga,
				'total'				=> $total,
				'tanggal'			=> time(),
				'email_user'		=> htmlspecialchars($this->input->post('email_user', true)),
				'status'			=> 1,

			];
			$this->db->insert('pemesanan', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Anda telah berhasil melakukan pemesanan! Silakan selesaikan pembayaran Anda!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('user/riwayat');
		}
	}

	public function riwayat()
	{
		$data['title'] = 'Riwayat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model', 'all');
		$email = $this->session->userdata('email');

		$data['pemesanan'] = $this->all->getPemesanan($email);

		$this->form_validation->set_rules('metode', 'Metode', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/riwayat', $data);
			$this->load->view('templates/footer');
		} else {

			// cek jika ada gambar yang akan diupload
			$upload_image	= $_FILES['bukti_bayar']['name'];

			if ($upload_image) {
				$config['upload_path'] = '.\assets\img\bayar';
				$config['allowed_types']	= 'jpg|jpeg|png|tiff';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('bukti_bayar')) {
					$bukti_bayar = $this->upload->data('file_name');
					$this->db->set('bukti_bayar', $bukti_bayar);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger pb-0" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('user/riwayat');
				}
			}

			$data = [
				'status'				=> 2,
				'tanggal_bayar'			=> time(),
				'metode'				=> htmlspecialchars($this->input->post('metode', true)),
			];

			$id = $this->input->post('id_pemesanan');
			$this->db->set($data);
			$this->db->where('id_pemesanan', $id);
			$this->db->update('pemesanan');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Pembayaran telah selesai! Mohon tunggu untuk konfirmasi pembayaran!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('user/riwayat');
		}
	}

	public function edit_profil()
	{
		$data['title'] = 'Edit Profil';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar yang akan diupload
			$upload_image	= $_FILES['image']['name'];

			if ($upload_image) {
				$config['upload_path'] = '.\assets\img\profile';
				$config['allowed_types']	= 'jpg|jpeg|png|tiff';


				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('image')) {
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger pb-0" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('user');
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Your profil has been updated!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
			redirect('user');
		}
	}

	public function changePassword()
	{
		$data['title'] = 'Ubah Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Wrong current password!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
				redirect('user/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				New password cannot be the same as current password!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
					redirect('user/changepassword');
				} else {
					// password OK
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Password changed!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
					redirect('user/changepassword');
				}
			}
		}
	}
}
