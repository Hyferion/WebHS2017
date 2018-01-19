<?php



class Product {

	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var string
	 */
	private $brand;
	/**
	 * @var string
	 */
	private $model;
	/**
	 * @var string
	 */
	private $description;
	/**
	 * @var int
	 */
	private $price;
	/**
	 * @var string
	 */
	private $type;
	/**
	 * @var string
	 */
	private $imgRef;
	/**
	 * @var string
	 */
	private $color;
	/**
	 * @var int
	 */
	private $productgroupid;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function getBrand() {
		return $this->brand;
	}


	/**
	 * @return string
	 */
	public function getModel() {
		return $this->model;
	}


	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}


	/**
	 * @return int
	 */
	public function getPrice() {
		return $this->price;
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}


	/**
	 * @return string
	 */
	public function getImgRef() {
		return $this->imgRef;
	}


	/**
	 * @return string
	 */
	public function getColor() {
		return $this->color;
	}


	/**
	 * @return int
	 */
	public function getProductgroupid() {
		return $this->productgroupid;
	}

	static public function getProducts() {
		$products = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE color = ''");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}
	static public function getALLProducts() {
		$products = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.products");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}

	static public function getProductsbyIds($ids) {
		$products = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE id IN (" . implode(',', $ids) . ")");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}



	static public function getProductsbyBrand($brand) {
		$products = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE color = '' and brand = '$brand'");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}

	static public function getProductsbyType($type) {
		$products = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE color = '' and type = '$type'");
		if ($res) {
			while ($product = $res->fetch_object(get_class())) {
				$products[] = $product;
			}
		}
		return $products;
	}


	static public function getProductbyModel($model) {
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE color = '' and model = '$model'");
		if ($res) {
			if ($product = $res->fetch_object(get_class())) {
				return $product;
			}
		}
		return null;
	}


	static public function getProductById($id) {
		$id = (int) $id;
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE id = $id");
		if ($res) {
			if ($product = $res->fetch_object(get_class())) {
				return $product;
			}
		}
		return null;
	}


	static public function getProductByGroupIdAndColor($groupid,$color) {
		$groupid = (int) $groupid;
		$res = DB::doQuery("SELECT * FROM CARSCARS.products WHERE productgroupid = '" . $groupid . "' and color = '" . $color . "'");
		if ($res) {
			if ($product = $res->fetch_object(get_class())) {
				return $product;
			}
		}
		return null;
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery("DELETE FROM CARSCARS.products WHERE id = $id");
		return $res != null;
	}







}