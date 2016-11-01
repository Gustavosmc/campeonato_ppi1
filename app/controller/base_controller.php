<?php 
	
	/**
	 * 
	 */
	abstract class BaseController {
		
		/**
		 * Exibir todos os objetos em uma tabela
		 * Metodo GET
		 */
		protected abstract function index();
		
		/**
		 * Exibi um objeto selecionado
		 * Metodo GET/id
		 */
		protected abstract function mostrar();
		
		/**
		 * Renderizar formulario novo objeto
		 * Metodo Get
		 */
		protected abstract function novo();
		
		/**
		 * Renderizar formulario novo objeto
		 * Metodo POST
		 */
		protected abstract function salvar();
		
		/**
		 * Editar um objeto
		 * Metodo UPDATE
		 */
		protected abstract function editar();
		
		/**
		 * Apagar um objeto
		 * Metodo DELETE
		 */
		protected abstract function apagar();
		
		/**
		 * Filtrar atributos vindo do formulário
		 */
		protected abstract function filtrar();
	
	}
	

 ?>