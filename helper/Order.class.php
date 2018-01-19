<?php

class Order {

	/**
	 * @var int
	 */
	protected $id;
	/**
	 * @var int
	 */
	protected $usrid;
	/**
	 * @var int
	 */
	protected $total;
	protected $created_at;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}


	/**
	 * @return int
	 */
	public function getUsrid() {
		return $this->usrid;
	}


	/**
	 * @return int
	 */
	public function getTotal() {
		return $this->total;
	}


	/**
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}


	static public function getOrders() {
		$orders = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.orders");
		if ($res) {
			while ($order = $res->fetch_object(get_class())) {
				$orders[] = $order;
			}
		}

		return $orders;
	}


	static public function getLastOrder($usrid) {
		$orders = array();
		$res = DB::doQuery("Select * from CARSCARS.orders where usrid = " . $usrid . " order by created_at desc limit 1");
		if ($res) {
			while ($order = $res->fetch_object(get_class())) {
				$orders[] = $order;
			}
		}

		return $orders;
	}
}