<?php
	class Account {

		private $errorArray;
        private $con;

		public function __construct($con) {
			$this->errorArray = array();
            $this->con = $con;
		}

		public function register($un , $fn, $ln, $em, $em2, $pw, $pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)){
				//Insert into database
				return $this->insertUserDetails($un, $fn, $ln, $em, $pw); 
				
			} else {
				return "Error in executing query";
			}
		}

        public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
			$encryptedPw = md5($pw);
			$profilePic = "assets/images/profile-pics/head_emerald.png";
			$date = date("Y-m-d");
			$result = mysqli_query($this->con, "INSERT INTO users VALUES (NULL, '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
            echo $result;
			return $result;
		}

		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, "Your username must be between 5 and 25 characters");
				return;
			}
		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, "Your first name must be between 2 and 25 characters");
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
				return;
			}
		}

		private function validateEmails($em, $em2) {
            if($em != $em2) {
				array_push($this->errorArray, "Your emails don't match");
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, "Email is invalid");
				return;
			}
		}

		private function validatePasswords($pw, $pw2) {
			if($pw != $pw2) {
				array_push($this->errorArray, "Your passwords don't match");
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, "Your password can only contain numbers and letters");
				return;
			}

			if(strlen($pw) > 30 || strlen($pw) < 5) {
				array_push($this->errorArray, "Your password must be between 5 and 30 characters");
				return;
			}
		}


	}
?>