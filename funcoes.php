<?php

	function listar($id) {

		$lista = array();

		global $pdo;


		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id_pai = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){

			$lista = $sql->fetchAll();

			foreach ($lista as $chave => $usuario) {
				$lista[$chave]['filhos'] = listar($usuario['id']);
			}
		}


		return $lista;

	}

?>