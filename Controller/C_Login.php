<?php
include_once("../Model/M_Login.php");

class C_Login {
    public function LoginForm() {
        if (isset($_POST['ok'])) {
            $modelAdmin = new M_Login();
            $resultArray = $modelAdmin->accept($_POST['username'], $_POST['password']);

            if ($resultArray !== null) {
                include_once("../index.php");
                exit();
            } else {
                $warn = "Yêu cầu nhập đúng thông tin";
                include_once("../login.php");
                exit();
            }
        }

        if (isset($_POST['reset'])) {
            // Redirect to the login page
            header("Location: ../login.php");
            exit();
        }
    }
}

        $controller = new C_Login();
        $controller->LoginForm();

?>
