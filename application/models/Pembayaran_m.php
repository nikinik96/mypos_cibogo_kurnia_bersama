<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Pembayaran_m extends CI_Model
{
	public function invoice_no()
	{
		$sql    = "SELECT MAX(MID(invoice,9,4)) as invoice_no 
                   FROM pembayaran 
                   WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n   = ((int)$row->invoice_no) + 1;
			$no  = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "MP" . date('ymd') . $no;
		return $invoice;
	}

	public function down_payment()
	{
		$sql    = "SELECT MAX(MID(down_payment,9,4)) as down_payment_no 
                   FROM pembayaran 
                   WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n   = ((int)$row->down_payment_no) + 1;
			$no  = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "DP" . date('ymd') . $no;
		return $invoice;
	}

	public function get_cart($id = null)
	{
		$this->db->select('*, items.name_items as name_items, cart.harga_items as cart_price');
		$this->db->from('cart');
		$this->db->join('items', 'items.items_id = cart.items_id');
		if ($id != NULL) {
			$this->db->where($id);
		}

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		return $query;
	}

	public function add_cart($post)
	{
		$query = $this->db->query("SELECT MAX(cart_id) as cart_no FROM cart");
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$cart_no = ((int)$row->cart_no) + 1;
		} else {
			$cart_no = 1;
		}

		$params = array(
			'cart_id'   		=> $cart_no,
			'items_id'   		=> $post['items_id'],
			'harga_items'     	=> $post['harga_items'],
			'discount_item'   	=> 0,
			'qty'       		=> $post['qty'],
			'total'     		=> ($post['harga_items'] * $post['qty']),
			'user_id'   		=> $this->session->userdata('user_id')
		);

		$this->db->insert('cart', $params);
	}

	public function update_cart_qty($post)
	{
		$sql = "UPDATE cart SET harga_items = '$post[harga_items]',
                qty = qty + '$post[qty]',
                total = '$post[harga_items]' * qty
                WHERE items_id = '$post[items_id]'";

		$this->db->query($sql);
	}

	public function del_cart($post = null)
	{
		if ($post != null) {
			$this->db->where($post);
		}

		$this->db->delete('cart');
	}

	public function add_sale($post)
	{
		$params = array(
			'invoice' => $this->invoice_no(),
			'customers_id' => $post['customers_id'],
			'total_price' => $post['subtotal'],
			'discount' => $post['discount'],
			'final_price' => $post['grandtotal'],
			'cash' => $post['cash'],
			'remaining' => $post['change'],
			'note' => $post['note'],
			'date' => $post['date'],
			'user_id' => $this->session->userdata('user_id')
		);

		$this->db->insert('sales', $params);
		return $this->db->insert_id();
	}

	function add_sale_detail($params)
	{
		$this->db->insert_batch('sales_detail', $params);
	}

	public function get_sale($id = null)
	{
		$this->db->select('*, customers.name_customers as customers_name, user.name as user_name, sales.create as sales_created, sales.customers_id as customers_sales');
		$this->db->from('sales');
		$this->db->join('customers', 'customers.customers_id = sales.customers_id', 'LEFT');
		$this->db->join('user', 'user.user_id = sales.user_id');
		if ($id != NULL) {
			$this->db->where('sales.sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_sale_detail($id = null)
	{
		$this->db->from('sales_detail');
		$this->db->join('item', 'item.item_id = sales_detail.item_id');
		if ($id != NULL) {
			$this->db->where('sales_detail.sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}