<?php
session_start();

$host     = 'localhost';
$dbname   = 'sanothimicollege';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'Database connection failed';
    header("Location: login_form.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Please enter both email and password';
        header("Location: login_form.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Password is correct, login success
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['status']    = 'success';
            $_SESSION['message']   = 'Login successful';

            // header("Location: dashboard.php"); // Redirect to your dashboard
            header("Location: index.php"); // Redirect to your dashboard
            exit;
        } else {
            $_SESSION['status']  = 'error';
            $_SESSION['message'] = 'Invalid email or password';
            header("Location: login_form.php");
            exit;
        }

    } catch (PDOException $e) {
        error_log($e->getMessage(), 3, 'errors.log');
        $_SESSION['status']  = 'error';
        $_SESSION['message'] = 'Login failed due to a server error';
        header("Location: login_form.php");
        exit;
    }
}
?>
