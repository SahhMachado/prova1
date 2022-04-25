<?php
    class Pessoa{
        private $pf_id;
        private $pf_cpf;
        private $pf_nome;
        private $pf_dt_nascimento;

        
        public function __construct($id, $cpf, $nome, $data){
            
            $this->setId($id);
            $this->setCPF($cpf);
            $this->setNome($nome);
            $this->setData($data);
        }

        public function getId(){ return $this->pf_id; }
        public function setId($id){ return $this->pf_id = $id; }

        public function getCPF(){ return $this->pf_cpf; }
        public function setCPF($cpf){ return $this->pf_cpf = $cpf; }

        public function getNome(){ return $this->pf_nome; }
        public function setNome($nome){ return $this->pf_nome = $nome; }

        public function getData(){return $this->pf_dt_nascimento; }
        public function setData($data){ return $this->pf_dt_nascimento = $data; } 
       
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO pessoa_fisica (pf_cpf, pf_nome, pf_dt_nascimento) 
            VALUES(:pf_cpf, :pf_nome, :pf_dt_nascimento)');

            $stmt->bindValue(':pf_cpf', $this->getCPF());
            $stmt->bindValue(':pf_nome', $this->getNome());
            $stmt->bindValue(':pf_dt_nascimento', $this->getData());
    
            return $stmt->execute();
            
        }
        
        public function editar($pf_id){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE prova1.pessoa_fisica
                SET pf_cpf = :pf_cpf, pf_nome = :pf_nome, pf_dt_nascimento = :pf_dt_nascimento 
                WHERE (pf_id = :pf_id);');

                $stmt->bindValue(':pf_id', $this->setId($this->pf_id));
                $stmt->bindValue(':pf_cpf', $this->setCPF($this->pf_cpf));
                $stmt->bindValue(':pf_nome', $this->setNome($this->pf_nome));
                $stmt->bindValue(':pf_dt_nascimento', $this->setData($this->pf_dt_nascimento));
                
                return $stmt->execute();
            }
         
        function excluir($pf_id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM pessoa_fisica WHERE pf_id = :pf_id');
            $stmt->bindValue(':pf_id', $pf_id);
            
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM pessoa_fisica';
            if($id > 0){
                $query .= ' WHERE pf_id = :Id';
                $stmt->bindParam(':Id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function __toString(){
                    $str = "ID da conta: ".$this->pf_id.
                    "<br>Cpf da conta: ".$this->pf_cpf.
                    "<br>Nome do cliente: ".$this->pf_nome;
                    "<br>Data de nascimento do cliente: ".$this->pf_dt_nascimento;
                    return $str;
                }
        
        }

     

        
    

?>