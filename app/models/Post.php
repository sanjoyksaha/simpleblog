<?php

    class Post {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllPost()
        {
            $this->db->query('SELECT *, 
                                    posts.id as PostId, 
                                    users.id as UserId,
                                    posts.created_at as postCreated,
                                    users.created_at as userCreated
                                    FROM posts
                                    INNER JOIN users
                                    On posts.user_id = users.id
                                    ORDER BY posts.created_at DESC
                                    ');

            $result = $this->db->findAll();

            return $result;
        }

        public function createPost($data)
        {
            $this->db->query('INSERT INTO posts(user_id, title, body, image) VALUES (:user_id, :title, :body, :image)');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':image', $data['image_unique_name']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id)
        {
            $this->db->query('SELECT * FROM posts WHERE id = :id');

            $this->db->bind(':id', $id);
            $result = $this->db->single();

            return $result;
        }

        public function updatePost($data)
        {
            $this->db->query('Update posts SET title = :title, body = :body, image = :image WHERE id = :id');

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':image', $data['image_unique_name']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deletePost($id)
        {
            $this->db->query('DELETE FROM posts WHERE id = :id');

            $this->db->bind(':id', $id);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function postByUser($id)
        {
            $this->db->query('SELECT * FROM posts WHERE user_id = :id ORDER BY created_at DESC');

            $this->db->bind(':id', $id);
            $result = $this->db->findAll();

            return $result;

//            if($this->db->rowCount() > 0) {
//                return $result;
//            } else {
//                return false;
//            }
        }

    }