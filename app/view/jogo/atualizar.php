<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="atualizarJogo">
	<?php 
		include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
		$jogoCtr = new JogoController();
		$ret = $jogoCtr->atualizar($_POST);
		if($ret == 1){
			$id = $jogoCtr->jogo->id;
			header("Location: mostrar.php?num=$id&edicao");
			exit;
		}elseif($ret == -1){
			echo "<p>Erro ao atualizar!</p>";
		}else{
			echo "<p>Não atualizado!</p>";
		}
	
	 ?>
 </div>
 
	<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>

