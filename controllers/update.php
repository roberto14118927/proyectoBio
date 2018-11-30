<?php
    require '../conection/conection.php';

    $id = null;

    if(!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }

    if(null == $id){
        header("Location: ../views/index.php");
    }

    if(!empty($_POST)){
        $cmp_nombre = $_POST['cmp_nombre'];
        $cmp_pat = $_POST['cmp_pat'];
        $cmp_mat = $_POST['cmp_mat'];

        $valid = true;

        if($valid){
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Tbl_test1 set cmp_nombre = ?, cmp_pat = ?, cmp_mat = ? WHERE id=?";
            $q = $pdo->prepare($sql);
            $q->execute(array($cmp_nombre, $cmp_pat, $cmp_mat, $id));
            Database::disconnect();
            header("Location: ../views/index.php");
        }
    }
     else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Tbl_test1 Where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $cmp_nombre = $data['cmp_nombre'];
    $cmp_pat = $data['cmp_pat'];
    $cmp_mat = $data['cmp_mat'];
    Database::disconnect();
    // header("Location: ../views/index.php");
}
?>