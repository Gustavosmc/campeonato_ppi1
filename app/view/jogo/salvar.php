<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="salvarJogo">

<?php 
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
	$jogoCtr = new JogoController();
	$ret = $jogoCtr->salvar($_POST);
	$id = $jogoCtr->jogo->id;
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