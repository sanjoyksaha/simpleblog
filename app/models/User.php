<?php

    class User {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        // Register User
        public function register($data)
        {
            $this->db->query('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)');
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Log in user
        public function login($email, $password)
        {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hash_password = $row->password;
            if(password_verify($password, $hash_password)) {
                return $row;
            } else {
                return false;
            }
        }

        // Find User By Email
        public function findUserByEmail($email)
        {
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Find User By User Id
        public function findUserById($id)
        {
            $this->db->query("SELECT * FROM users WHERE id = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        // Update Own Profile
        public function updateProfile($data)
        {
            $this->db->query('UPDATE users SET name = :name, email = :email WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Update New Password
        public function updatePassword($data)
        {
            $this->db->query('UPDATE users SET password = :password WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':password', $data['password']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }



    }
