<?php
	if (isset($_POST['key'])) {

		$conbd = new mysqli('localhost', 'root', '', 'tabelasemFormatacao');

		if ($_POST['key'] == 'getRowData') {
			$rowID = $conbd->real_escape_string($_POST['rowID']);
			$sql = $conbd->query("SELECT nomeMedico, crm, especialidade FROM medico WHERE id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArray = array(
				'nomeMedico' => $data['nomeMedico'],
				'crm' => $data['crm'],
				'especialidade' => $data['especialidade'],
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') {
			$start = $conbd->real_escape_string($_POST['start']);
			$limit = $conbd->real_escape_string($_POST['limit']);

			$sql = $conbd->query("SELECT id, nomeMedico FROM medico LIMIT $start, $limit");
			if ($sql->num_rows > 0) {
				$response = "";
				while($data = $sql->fetch_array()) {
					$response .= '
						<tr>
							<td>'.$data["id"].'</td>
							<td id="medico'.$data["id"].'">'.$data["nomeMedico"].'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data["id"].', \'edit\')" value="Editar" class="btn btn-primary">
								<input type="button" onclick="viewORedit('.$data["id"].', \'view\')" value="Visualizar" class="btn">
								<input type="button" onclick="deleteRow('.$data["id"].')" value="Deletar" class="btn btn-danger">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $conbd->real_escape_string($_POST['rowID']);

		if ($_POST['key'] == 'deleteRow') {
			$conbd->query("DELETE FROM medico WHERE id='$rowID'");
			exit('O Médico foi deletado!');
		}

		$nome = $conbd->real_escape_string($_POST['nome']);
		$crm = $conbd->real_escape_string($_POST['crm']);
		$especialidade = $conbd->real_escape_string($_POST['especialidade']);

		if ($_POST['key'] == 'updateRow') {
			$conbd->query("UPDATE medico SET nomeMedico='$nome', crm='$crm', especialidade='$especialidade' WHERE id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'addNew') {
			$sql = $conbd->query("SELECT id FROM medico WHERE nomeMedico = '$nome'");
			if ($sql->num_rows > 0)
				exit("Médico com esse nome já existe!");
			else {
				$conbd->query("INSERT INTO medico (nomeMedico, crm, especialidade) 
							VALUES ('$nome', '$crm', '$especialidade')");
				exit('O Médico foi inserido com sucesso!');
			}
		}
	}
?>