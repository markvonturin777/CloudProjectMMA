<?php
    SESSION_start();

    require 'connection.php';
    if ($_POST['email']=='' || $_POST['pass']=='') {
        header("location: /index.php");
        return;
    }
    $_SESSION['resultLogin'] = 0;
    $email = $_POST['email'];
    $psw = $_POST['pass'];

    $query1="SELECT nome, password,id FROM users WHERE email='".$email."'";
    $sth2 = $pdo->prepare($query1);
    $sth2->execute();
    $resultEmail = $sth2->fetch();

    if($resultEmail['password']==$psw){
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $resultEmail['nome'];
        $_SESSION['id'] = $resultEmail['id'];

        $queryContainer="SELECT Cognome FROM users WHERE email='".$email."'";
        $sth1 = $pdo->prepare($queryContainer);
        $sth1->execute();

        $resultContainer = $sth1->fetch(\PDO::FETCH_ASSOC);
        
        $_SESSION['userContainer'] = $resultContainer['Cognome'];

        header("location: /homepage.php");
    }
    else {
        header("location: /index.php");
        $_SESSION['resultLogin'] = 1;
    }