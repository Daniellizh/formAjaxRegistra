<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $users = array(
    array('id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'password' => 'password123'),
    array('id' => 2, 'name' => 'Jane', 'email' => 'jane@example.com', 'password' => 'password456'),
    array('id' => 3, 'name' => 'Bob', 'email' => 'bob@example.com', 'password' => 'password789')
  );

  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid email'));
    exit;
  }

  if ($password !== $confirmPassword) {
    echo json_encode(array('status' => 'error', 'message' => 'Passwords do not match'));
    exit;
  }

  foreach ($users as $user) {
    if ($user['email'] === $email) {
      echo json_encode(array('status' => 'error', 'message' => 'Email already exists'));
      exit;
    }
  }

  $new_user = array(
    'id' => count($users) + 1,
    'name' => $name,
    'surname' => $surname,
    'email' => $email,
    'password' => $password
  );
  array_push($users, $new_user);

  $log = fopen('register_log.txt', 'a');
  fwrite($log, 'New user registered: ' . json_encode($new_user) . PHP_EOL);
  fclose($log);

  echo json_encode(array('status' => 'success', 'message' => 'Registration successful'));
  exit;
}
