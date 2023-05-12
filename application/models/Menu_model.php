<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function getSubMenu()
	{
		$query = "SELECT user_sub_menu.*, user_menu.menu FROM user_sub_menu JOIN user_menu ON user_sub_menu.menu_id = user_menu.id";
		return $this->db->query($query)->result_array();
	}

	public function getAllUser()
	{
		$query = "SELECT user.*, user_role.role FROM user JOIN user_role ON user.role_id = user_role.id";
		return $this->db->query($query)->result_array();
	}


	// Dashboard ===============

	public function getTotalUser()
	{
		$query = "SELECT count(email) as total FROM user";
		return $this->db->query($query)->row()->total;
	}

	public function getTotalAdmin()
	{
		$query = "SELECT count(email) as total FROM user WHERE role_id = 1";
		return $this->db->query($query)->row()->total;
	}

	public function getTotalMember()
	{
		$query = "SELECT count(email) as total FROM user WHERE role_id = 2";
		return $this->db->query($query)->row()->total;
	}

	// pemesanan status
	public function getPemesanan($id)
	{
		$query = "SELECT * FROM pemesanan JOIN tabel_status ON pemesanan.status = tabel_status.id_status WHERE pemesanan.email_user = '$id'";
		return $this->db->query($query)->result_array();
	}
	public function getAllPemesanan()
	{
		$query = "SELECT * FROM pemesanan JOIN tabel_status ON pemesanan.status = tabel_status.id_status JOIN user ON pemesanan.email_user = user.email";
		return $this->db->query($query)->result_array();
	}
}
