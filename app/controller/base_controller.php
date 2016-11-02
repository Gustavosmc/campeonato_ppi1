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
		 * Metodo GET
		 */
		protected abstract function novo();
		
		/**
		 * Renderizar formulario novo objeto
		 * Metodo POST
		 */
		protected abstract function salvar($post);
		
		/**
		 * Renderizar tela de edição
		 * Metodo GET
		 */
		protected abstract function editar();
		
		
		/**
		 * Atualizar um objeto, update
		 * Metodo UPDATE
		 */
		protected abstract function atualizar($post);
		

		/**
		 * Apagar um objeto
		 * Metodo DELETE
		 */
		protected abstract function apagar($post);
		
		/**
		 * Filtrar atributos vindo do formulário
		 */
		protected abstract function filtrar();
	
	}
	

 ?>