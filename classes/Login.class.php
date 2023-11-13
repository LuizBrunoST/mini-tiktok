<?php
	
	class Login extends DB{
		
		private $tabela = 'usuarios';
		private $prefix = 'socialbigui_';
		private $cookie = true;
		public $erro = '';

		private function crip($senha){
			return sha1($senha);
		}
		
		private function validar($usuario,$senha){
			$senha = $this->crip($senha);//Compara a senha criptografada
			
			try{
			$validar = self::getConn()->prepare('SELECT `id` FROM `'.$this->tabela.'` WHERE `email`=? AND `senha`=? LIMIT 1');
			$validar->execute(array($usuario,$senha));

			if($validar->rowCount()==1){

				//$agora = date('Y-m-d H:i:s');
				//$limite = date('Y-m-d H:i:s', strtotime('+2 min'));
				//$update = self::getConn()->prepare("UPDATE `".$this->tabela."` SET `horario` = ?, `limite` = ? WHERE `email` = ?");
				//$update->execute(array($agora, $limite, $usuario));
			
				$asValidar = $validar->fetch(PDO::FETCH_ASSOC);
				
				$_SESSION[$this->prefix.'uid'] = $asValidar['id'];
				return true;
			}else{
				return false;
			}
			
			
			}catch(PDOException $e){
				die($e->getMessage());
				//$this->erro = 'Sistema indisponível';
				$this->erro = '<div class="w3-panel w3-padding w3-yellow w3-round"><strong>Info!</strong> Sistema indisponível!</div>';
				logErros($e);
				return false;
			}
		}
		
		function logar($usuario,$senha,$lembrar=false){
			if($this->validar($usuario,$senha)){
				
				if(!isset($_SESSION)){
					session_start();
				}
				
				$_SESSION[$this->prefix.'usuario'] = $usuario;
				$_SESSION[$this->prefix.'logado'] = true;
				
				if($this->cookie){
					$valor = join('#',array($usuario,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
					$valor = sha1($valor);
					setcookie($this->prefix.'token',$valor,0,'/');
				}
				
				if($lembrar){
					$this->lembrardados($usuario,$senha);
				}
				return true;
			}else{
				$this->erro=  '<div class="w3-red w3-padding w3-display-middle w3-panel w3-round"><strong>Ops!</strong> Usuario invalido!</div>';
				return false;
			}
		}
		
		function logado($cookei=true){
			if(!isset($_SESSION)){
				session_start();
			}
			
			if(!isset($_SESSION[$this->prefix.'logado'])){
				if($cookei){
					return $this->dadosLembrados();
				}else{
					$this->erro = '<div class="w3-red w3-padding w3-panel w3-round"><strong>Alerta!</strong> Você não esta logado</div>';
					return false;
				}
			}
			
			if($this->cookie){
				if(!isset($_COOKIE[$this->prefix.'token'])){
					$this->erro = '<div class="alert w3-padding" id="alert-danger"><strong>Alerta!</strong> Você não esta logado</div>';
					return false;
				}else{
					$valor = join('#',array($_SESSION[$this->prefix.'usuario'],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
					$valor = sha1($valor);
					
					if($_COOKIE[$this->prefix.'token'] !== $valor){
						$this->erro = '<div class="alert w3-padding" id="alert-danger"><strong>Alerta!</strong> Você não esta logado</div>';
						return false;
					}
				}
			}
			return true;			
		}		
		
		function sair($cookie=true){
			if(!isset($_SESSION)){
				session_start();
			}
			
			unset($_SESSION[$this->prefix.'usuario']);
			unset($_SESSION[$this->prefix.'uid']);
			$_SESSION[$this->prefix.'logado'] = false;
			
			if($this->cookie AND isset($_COOKIE[$this->prefix.'token'])){
				setcookie($this->prefix.'token',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'token']);
			}
			
			if($cookie){
				$this->limparLembrados();
			}
			
			return !$this->logado(false);
		}
		
		function getDados($uid,$colunas='*'){
			if($this->logado()){
				
				$dados = self::getConn()->prepare('SELECT '.$colunas.' FROM `'.$this->tabela.'` WHERE `id`=?');
				$dados->execute(array($uid));

				return $dados->fetch(PDO::FETCH_ASSOC);
			}
		}
		
		private function limparLembrados(){
			if(isset($_COOKIE[$this->prefix.'login_user'])){
				setcookie($this->prefix.'login_user',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_user']);
			}
			
			if(isset($_COOKIE[$this->prefix.'login_pass'])){
				setcookie($this->prefix.'login_pass',false,(time()-3600),'/');
				unset($_COOKIE[$this->prefix.'login_pass']);
			}
		}
		
		private function dadosLembrados(){
			if(isset($_COOKIE[$this->prefix.'login_user']) AND isset($_COOKIE[$this->prefix.'login_pass'])){
				$usuario = base64_decode(substr($_COOKIE[$this->prefix.'login_user'],1));
				$senha = base64_decode(substr($_COOKIE[$this->prefix.'login_pass'],1));
				
				return $this->logar($usuario,$senha,true);
			}
			return false;
		}
		
		private function lembrardados($usuario,$senha){
			$tempo = strtotime('+7 day',time());
			
			$usuario = rand(1,9).base64_encode($usuario);
			$senha = rand(1,9).base64_encode($senha);
			
			setcookie($this->prefix.'login_user',$usuario,$tempo,'/');
			setcookie($this->prefix.'login_pass',$senha,$tempo,'/');
		}
		
	}