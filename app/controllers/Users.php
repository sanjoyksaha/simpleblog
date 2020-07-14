<?php
    class Users extends Controller {
        private $userModel;

        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function register()
        {
            // Check for the post
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Process Form

                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'name'                  => trim($_POST['name']),
                    'email'                 => trim($_POST['email']),
                    'password'              => trim($_POST['password']),
                    'confirm_password'      => trim($_POST['confirm_password']),
                    'err_name'              => '',
                    'err_email'             => '',
                    'err_password'          => '',
                    'err_confirm_password'  => '',
                ];

                // Validate name
                if(empty($data['name'])) {
                    $data['err_name'] = "Please enter name";
                }

                // Validate email
                if(empty($data['email'])) {
                    $data['err_email'] = "Please enter email";
                } else {
                    if($this->userModel->findUserByEmail($data['email'])) {
                        $data['err_email'] = "This email is already be taken";
                    }
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['err_password'] = "Please enter password";
                } elseif (strlen($data['password']) < 6) {
                    $data['err_password'] = "Password must be at least 6 character";
                }

                // Validate confirm password
                if(empty($data['confirm_password'])) {
                    $data['err_confirm_password'] = "Please enter confirm password";
                } else {
                    if($data['password'] != $data['confirm_password']) {
                        $data['err_confirm_password'] = "Password don't match";
                    }
                }

                // Check if the errors are empty
                if(empty($data['err_name']) && empty($data['err_email']) && empty($data['err_password']) && empty($data['err_confirm_password'])) {
                    // Make Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)) {
                        flash('register_success', 'Your registration successfully completed.');
                        redirect('users/login');
                    } else {
                        die ('Something went wrong');
                    }

                } else {
                    // Load view with errors
                    $this->view('users/register', $data);
                }

            } else {
                // Init Data
                $data = [
                    'name'                  => '',
                    'email'                 => '',
                    'password'              => '',
                    'confirm_password'      => '',
                    'err_name'              => '',
                    'err_email'             => '',
                    'err_password'          => '',
                    'err_confirm_password'  => '',
                ];

                // Load View
                $this->view('users/register', $data);
            }
        }

        public function login()
        {
            // Check for the post
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Process Form

                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'email'                 => trim($_POST['email']),
                    'password'              => trim($_POST['password']),
                    'err_email'             => '',
                    'err_password'          => '',
                ];
                
                // Validate email
                if(empty($data['email'])) {
                    $data['err_email'] = "Please enter email";
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['err_password'] = "Please enter password";
                }

                // Check if user email is exists or not
                if(!$this->userModel->findUserByEmail($data['email'])) {
                    $data['err_email'] = "This email is not found in our storage";
                }

                // Check if the errors are empty
                if(empty($data['err_email']) && empty($data['err_password'])) {

                    //check and set logged in user
                    $loggedIn = $this->userModel->login($data['email'], $data['password']);

                    if($loggedIn) {
                        // Create Session For Logged In User
                        $this->createSession($loggedIn);
                    } else {
                        $data['err_password'] = "Wrong password";
                        $this->view('users/login', $data);
                    }

                } else {
                    $this->view('users/login', $data);
                }

            } else {
                // Init Data
                $data = [
                    'email'                 => '',
                    'password'              => '',
                    'err_email'             => '',
                    'err_password'          => '',
                ];

                // Load View
                $this->view('users/login', $data);
            }
        }

        public function createSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;

            redirect('posts/index');
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset( $_SESSION['user_email']);

            redirect('users/login');
        }

        public function profile($id)
        {
            $user = $this->userModel->findUserById($id);

            if($user->id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'user' => $user
            ];
            return $this->view('users/profile', $data);
        }

        public function edit($id)
        {
            if($_SERVER['REQUEST_METHOD'] == "POST") {

                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'id'         => $id,
                    'name'       => trim($_POST['name']),
                    'email'      => trim($_POST['email']),
                    'err_name'   => '',
                    'err_email'  => '',
                ];

                // Validate name
                if(empty($data['name'])) {
                    $data['err_name'] = "Please enter name";
                }

                // Validate email
                if(empty($data['email'])) {
                    $data['err_email'] = "Please enter email";
                }

                // Check if the errors are empty
                if(empty($data['err_name']) && empty($data['err_email'])) {
                    if($this->userModel->updateProfile($data)) {
                        flash('success', 'Profile updated');
                        return $this->profile($id);
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('users/edit_profile', $data);
                }

            } else {
                // Check this user is logged in or not
                $user = $this->userModel->findUserById($id);

                if($user->id != $_SESSION['user_id']) {
                    redirect('posts');
                }

                $data = [
                    'id'    => $id,
                    'name'  => $user->name,
                    'email' => $user->email
                ];

                return $this->view('users/edit_profile', $data);
            }
        }

        public function change_password($id)
        {
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'id'                        => $id,
                    'password'                  => trim($_POST['password']),
                    'confirm_password'      => trim($_POST['confirm_password']),
                    'err_password'          => '',
                    'err_confirm_password'  => '',
                ];

                // Validate password
                if(empty($data['password'])) {
                    $data['err_password'] = "Please enter password";
                } elseif (strlen($data['password']) < 6) {
                    $data['err_password'] = "Password must be at least 6 character";
                }

                // Validate confirm password
                if(empty($data['confirm_password'])) {
                    $data['err_confirm_password'] = "Please enter confirm password";
                } else {
                    if($data['password'] != $data['confirm_password']) {
                        $data['err_confirm_password'] = "Password don't match";
                    }
                }

                if(empty($data['err_password']) && empty($data['err_confirm_password'])) {
                    // Make Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Update Password
                    if($this->userModel->updatePassword($data)) {
                        flash('success', 'Password Updated.');
                        return $this->profile($id);
                    } else {
                        die ('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    return $this->view('users/change_password', $data);
                }

            } else {
                // Check this user is logged in or not
                $user = $this->userModel->findUserById($id);

                if($user->id != $_SESSION['user_id']) {
                    redirect('posts');
                }

                $data = [
                    'id'                    => $id,
                    'new_password'          => '',
                    'confirm_new_password'  => ''
                ];

                return $this->view('users/change_password', $data);
            }
        }

    }