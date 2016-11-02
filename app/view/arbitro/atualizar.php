<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<?php 
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	$arbitroCtr = new ArbitroController();
	$ret = $arbitroCtr->atualizar($_POST);
	if($ret == 1){
		$id = $arbitroCtr->arbitro->id;
		header("Location: mostrar.php?num=$id&edicao");
		exit;
	}elseif($ret == -1){
		echo "<p>Erro ao atualizar!</p>";
	}else{
		echo "<p>Não atualizado!</p>";
	}

 ?>
 
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>