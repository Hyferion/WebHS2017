<?php



class User{

	/**
	 * @var int
	 */
	 protected $id;
	/**
	 * @var string
	 */
	 protected $email;
	/**
	 * @var string
	 */
	 protected $passwort;
	/**
	 * @var string
	 */
	 protected $vorname;
	/**
	 * @var string
	 */
	 protected $nachname;

	 protected $created_at;
	/**
	 * @var int
	 */
	 protected $zip;
	/**
	 * @var string
	 */
	 protected $city;
	/**
	 * @var string
	 */
	 protected $adress;
	/**
	 * @var bool
	 */
	 protected $admin;


	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}


	/**
	 * @return string
	 */
	public function getPasswort() {
		return $this->passwort;
	}


	/**
	 * @return string
	 */
	public function getVorname() {
		return $this->vorname;
	}


	/**
	 * @return string
	 */
	public function getNachname() {
		return $this->nachname;
	}


	/**
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}


	/**
	 * @return int
	 */
	public function getZip() {
		return $this->zip;
	}


	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}


	/**
	 * @return string
	 */
	public function getAdress() {
		return $this->adress;
	}


	/**
	 * @return bool
	 */
	public function isAdmin() {
		return $this->admin;
	}

	static public function getUsers() {
		$users = array();
		$res = DB::doQuery("SELECT * FROM CARSCARS.users");
		if ($res) {
			while ($user = $res->fetch_object(get_class())) {
				$users[] = $user;
			}
		}
		return $users;
	}

	static public function getUserbyId($id) {
		$id = (int) $id;
		$res = DB::doQuery("SELECT * FROM CARSCARS.users WHERE id = $id");
		if ($res) {
			if ($user = $res->fetch_object(get_class())) {
				return $user;
			}
		}
		return null;
	}

}