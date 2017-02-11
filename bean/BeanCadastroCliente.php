<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../painel/bootstrap/css/default.css" />
    </head>
    <body>
        <?php
        require_once ("../dao/ClienteDAO.php");
        require_once ("../model/Clientes.php");
        $cliente = new Clientes();
        $dao = new ClienteDAO();
        $cliente->setNome($_POST['nome']);
        $cliente->setApelido($_POST['apelido']);
        $cliente->setDataCadastro('now()');
        $cliente->setDataInicial('2017-00-00');
        $cliente->setDataFinal('2017-00-00');
        $cliente->setEmail($_POST['email']);
        
        $resultEmail = $dao->validaEmail($cliente->getEmail());
        if($resultEmail > 0){
            echo "<script>alert('E-mail já cadastrado, Por favor utilize outro E-mail.');</script>";
            echo ("<div class='divLoading' id='topo'>");
            echo ("<img src='../imagens/carregando.gif' width='250' height='250'/> ");
            echo ("</div>");
            echo "<meta http-equiv='refresh' content='1;url=../cadastro/index.html'>";
            die();
        }
       
        $cliente->setInteresses($_POST['interesses']);
        $cliente->setAreaAtuacao($_POST['area']);
        $cliente->setTempoTrader($_POST['tempo_trader']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setEmail($_POST['email']);
        $cliente->setSenha($_POST['password']);
        $cliente->setFacebook($_POST['facebook']);
        $cliente->setNivel(2);

        $resultado = $dao->inserirClientes($cliente);

        if ($resultado == 0) {
            echo "<script>alert('Cadastrado com Sucesso.');</script>";
            echo ("<div class='divLoading' id='topo'>");
            echo ("<img src='../imagens/carregando.gif' width='250' height='250'/> ");
            echo ("</div>");
            echo "<meta http-equiv='refresh' content='1;url=../painel/index.php'>";
        } else {
            echo "<script>alert('Erro ao efetuar o cadastro.');</script>";
            echo ("<div class='divLoading' id='topo'>");
            echo ("<img src='../imagens/carregando.gif' width='250' height='250'/> ");
            echo ("</div>");
            echo "<meta http-equiv='refresh' content='1;url=../cadastro/index.html'>";
            die();
        }
        ?>
    </body>
</html>



