<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
	protected $table = 'products';
	protected $primary_key = 'id';
	protected $fillable = ['product_name', 'description', 'price', 'quantity'];
	protected $guarded = ['id'];
	protected $timestamps = true;

	// In-memory storage for demonstration when database is not available
	private static $mockData = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function all()
	{
		try {
			return $this->db->table($this->table)->get_all();
		} catch (Exception $e) {
			// Return mock data if database is not available
			return array_values(self::$mockData);
		}
	}

	public function find($id)
	{
		try {
			return $this->db->table($this->table)
							->where('id', $id)
							->get();
		} catch (Exception $e) {
			// Return mock data if database is not available
			return self::$mockData[$id] ?? null;
		}
	}

	public function insert($data)
	{
		try {
			return $this->db->table($this->table)->insert($data);
		} catch (Exception $e) {
			// Insert into mock data if database is not available
			$id = count(self::$mockData) + 1;
			$data['id'] = $id;
			$data['created_at'] = date('Y-m-d H:i:s');
			self::$mockData[$id] = $data;
			return $id;
		}
	}

	public function update($id, $data)
	{
		try {
			return $this->db->table($this->table)
							->where('id', $id)
							->update($data);
		} catch (Exception $e) {
			// Update mock data if database is not available
			if (isset(self::$mockData[$id])) {
				self::$mockData[$id] = array_merge(self::$mockData[$id], $data);
				return true;
			}
			return false;
		}
	}

	public function delete($id)
	{
		try {
			return $this->db->table($this->table)
							->where('id', $id)
							->delete();
		} catch (Exception $e) {
			// Delete from mock data if database is not available
			if (isset(self::$mockData[$id])) {
				unset(self::$mockData[$id]);
				return true;
			}
			return false;
		}
	}
}
