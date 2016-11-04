<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="atualizarEstadio">
	<?php 
		include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/estadio_controller.php';
		$estadioCtr = new EstadioController();
		$ret = $estadioCtr->atualizar($_POST);
		if($ret == 1){
			$id = $estadioCtr->estadio->id;
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

