<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="atualizarTime">
	<?php 
		include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/time_controller.php';
		$timeCtr = new TimeController();
		$ret = $timeCtr->atualizar($_POST);
		if($ret == 1){
			$id = $timeCtr->time->id;
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

