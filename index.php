<?php

	session_start();
	require 'config.php';
	require 'funcoes.php';

	if(empty($_SESSION['mmnlogin'])){

		header("Location: login.php");
		exit;
	}

	$id = $_SESSION['mmnlogin'];

	$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
	$sql->bindValue(":id", $id);
	$sql->execute();

	if($sql->rowCount() > 0) {
		$sql = $sql->fetch();
		$nome = $sql['nome'];


	}else{

		header("Location: login.php");
		exit;
		
	}

	$lista = listar($id);

?>

<h1>Sistema de Markenting Multinivel </h1>

<h2>Usuario Logado: <?php echo $nome; ?></h2>

<a href="cadastrar.php">Cadastrar novo usuario</a>

<a href="sair.php">Sair</a>


<hr/>
<ul>
	<?php foreach ($lista as $usuarios): ?>
		<li><?php echo $usuarios['nome']; ?></li>
	<?php endforeach; ?>
</ul>