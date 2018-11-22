<?php
    require '../conection/conection.php';

    if(!empty($_POST)){
        $cmp_nombre = $_POST['cmp_nombre'];
        $cmp_pat = $_POST['cmp_pat'];
        $cmp_mat = $_POST['cmp_mat'];

        $valid = true;

        if($valid){
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Tbl_test1 (cmp_nombre, cmp_pat, cmp_mat) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($cmp_nombre, $cmp_pat, $cmp_mat));
            Database::disconnect();
            header("Location: ../views/index.php");
        }
    }

?>