<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="salvarProfissional">

<?php 
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/profissional_controller.php';
	$profissionalCtr = new ProfissionalController();
	$ret = $profissionalCtr->salvar($_POST);
	$id = $profissionalCtr->profissional->id;
	if($ret == 1){
		header("Location: mostrar.php?num=$id&novo");
		exit;
	}elseif($ret == -1){
		echo "<p>Ocorreu um erro ao tentar salvar!</p>";
	}else{
		echo "<p>Não foi possivel salvar!</p>";
	}

 ?>
</div>


 <?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>