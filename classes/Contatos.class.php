<?php
    class Contatos{
        private $cont_id;
        private $cont_tipo;
        private $cont_descricao;
        private $cont_pf_id;

        
        public function __construct($id, $tipo, $desc, $pfid){
            
            $this->setId($id);
            $this->setTipo($tipo);
            $this->setDescricao($desc);
            $this->setPFId($pfid);
        }

        public function getId(){ return $this->cont_id; }
        public function setId($id){ return $this->cont_id = $id; }

        public function getTipo(){ return $this->cont_tipo; }
        public function setTipo($tipo){ return $this->cont_tipo = $tipo; }

        public function getDescricao(){ return $this->cont_descricao; }
        public function setDescricao($desc){ return $this->cont_descricao = $desc; }

        public function getPFId(){return $this->cont_pf_id; }
        public function setPFId($pfid){ return $this->cont_pf_id = $pfid; } 
        
        public function insere(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO contatos (cont_tipo, cont_descricao, cont_pf_id) 
            VALUES(:cont_tipo, :cont_descricao, :cont_pf_id)');

            $stmt->bindValue(':cont_tipo', $this->getTipo());
            $stmt->bindValue(':cont_descricao', $this->getDescricao());
            $stmt->bindValue(':cont_pf_id', $this->getPFId());

    
            return $stmt->execute();
            
        }

        public function editar($cont_id){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE contatos SET cont_tipo = :cont_tipo, cont_descricao = :cont_descricao, cont_pf_id = :cont_pf_id 
                WHERE cont_id = :cont_id');

                $stmt->bindValue(':cont_id', $this->setId($this->cont_id));
                $stmt->bindValue(':cont_tipo', $this->setTipo($this->cont_tipo));
                $stmt->bindValue(':cont_descricao', $this->setDescricao($this->cont_descricao));
                $stmt->bindValue(':cont_pf_id', $this->setPFId($this->cont_pf_id));

                return $stmt->execute();
            }

        function excluir($cont_id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM contatos WHERE cont_id = :cont_id');
            $stmt->bindValue(':cont_id', $cont_id);
            
            return $stmt->execute();
        }
    }
?>