<?php

class User {
	
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $purl;
	private $company;
	
	function __construct($args) {
		
		$this->id = isset($args['id']) ? $args['id'] : 1;
		$this->first_name = isset($args['first_name']) ? $args['first_name'] : "";
		$this->last_name = isset($args['last_name']) ? $args['last_name'] : "";
		$this->email = isset($args['email']) ? $args['email'] : "";
		$this->purl = isset($args['purl']) ? $args['purl'] : "";
		$this->company = isset($args['company']) ? $args['company'] : "";
		
	}
	
	public function get($key) {
		return in_array($key,array("id","first_name","last_name","email","purl","company")) ? $this->$key : false;
	}
	
}