<?php defined('C5_EXECUTE') or die("Access Denied.");
abstract class Concrete5_Library_Response {

	public $error = false;
	public $errors = array();
	public $time;
	public $message;
	public $redirectURL;

	public function setRedirectURL($url) {
		$this->redirectURL = $url;
	}

	public function getRedirectURL() {
		return $this->redirectURL;
	}

	public function __construct($e = false) {
		if ($e instanceof ValidationErrorHelper && $e->has()) {
			$this->error = $e;
			$this->errors = $e->getList();
		}
		$this->time = date('F d, Y g:i A');
	}

	public function setMessage($message) {
		$this->message = $message; 
	}

	public function getMessage() {
		return $this->message;
	}

	public function outputJSON() {
		if ($this->error && $this->error->has()) {
			Loader::helper('ajax')->sendError($this->error);
		} else {
			Loader::helper('ajax')->sendResult($this);
		}
	}

}