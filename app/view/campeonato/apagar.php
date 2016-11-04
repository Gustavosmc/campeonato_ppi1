

 <?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>


<div class="corpo" id="apagarArbitro">
	 <?php 
	    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';  
	    $arbitroCtr = new ArbitroController();
		$ret = $arbitroCtr->apagar($_POST);
		
		if($ret == 1){
			echo "<p>Excluido com sucesso!</p>";
		}else{
			echo "<p>Não foi possivel excluir!</p>";
		}
	 ?>
</div>


<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>

