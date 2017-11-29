<?php

class Controller {

	private $data = array();
	private $sessionState = false;
	private $title = '';


	// A C T I O N S

	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
		$this->title = "Home";
	}

	public function list_students(Request $request) {
		//$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$sort = $request->getParameter('sort', 'id');
		$this->data["students"] = Student::getStudents($sort);
		$this->title = "Students";
	}

	public function edit_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "To edit please login in first!";
			return "login";
		}

		$id = $request->getParameter("id", 0);
		$student = Student::getStudentById($id);

		if (!$student) {
			return $this->page404();
		}

		$this->data["student"] = $student;
		$this->data["projects"] = Project::getProjects('id');
	}

	public function update_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "To edit please login in first!";
			return "login";
		}
		$values = $request->getParameter('student', array());
		$student = Student::getStudentById($values['id']);
		if (!$student) {
			return $this->page404();
		}
		$student->update($values);
		$student->save();
		$this->data["message"] = "Student has been updated successfully!";

		return $this->internalRedirect("list_students", $request);
	}

	public function delete_student(Request $request) {
		$this->redirect("home");
	}

	public function contact(Request $request) {
		//
	}

	public function login(Request $request) {
		$login = $request->getParameter('login', '');
		$pw = $request->getParameter('pw', '');
		if (!User::checkCredentials($login, $pw)){
			$this->data["message"] = "Wrong password or login!";
			return;
		}
		$this->startSession();
		$_SESSION['user'] = $login;
		$this->data["message"] = "You just logged in;-)";
		return "home";
	}

	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		$_SESSION = array();

		$this->data["message"] = "You just logged out!";
		return "home";
	}


	// H E L P E R S

	public function &getData() {
		return $this->data;
	}

	public function __call($function, $args) {
		throw new Exception("Not yet implemented ('$function')");
	}

	public function isLoggedIn(){
		$this->startSession();
		return isset($_SESSION['user']);
	}

	public function getTitle() {
		return $this->title;
	}



	// P R I V A T E  H E L P E R S

	private function page404() {
		header("HTTP/ 404 Not Found");
		return "page404";
	}

	private function internalRedirect($action, $request){
		$tpl = $this->$action($request);
		return $tpl ? $tpl : $action;
	}

	private function redirect($action) {
		header("Location: index.php?action=$action");
		exit();
	}

	private function startSession(){
		if (!$this->sessionState){
			$this->sessionState = session_start();
		}
  	}

}
