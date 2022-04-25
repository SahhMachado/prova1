<?php

        class ContaCorrente {
            private $cc_numero;
            private $cc_saldo;
            private $cc_pf_id;
            private $cc_dt_ultima_alteracao;
            public $saque;
            public $deposito;


            public function __construct($numero,$saldo,$pf_id,$data){
                $this->setNumero($numero);
                $this->setSaldo($saldo);
                $this->setPf($pf_id);
                $this->setDtUltimaAlteracao($data);
        
            }

            public function getNumero(){ return $this->cc_numero;}
            public function setNumero($numero){ return $this->cc_numero = $numero;}

            public function getSaldo(){ return $this->cc_saldo;}
            public function setSaldo($saldo){ return $this->cc_saldo = $saldo;}

            public function getPf(){ return $this->cc_pf_id;}
            public function setPf($pf_id){ return $this->cc_pf_id = $pf_id;}

            public function getDtUltimaAlteracao(){ return $this->cc_dt_ultima_alteracao;}
            public function setDtUltimaAlteracao($data){ return $this->cc_dt_ultima_alteracao = $data;}


            public function insere(){     
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO conta_corrent (cc_saldo, cc_pf_id, cc_dt_ultima_alteracao) 
                VALUES(:cc_saldo, :cc_pf_id, :cc_dt_ultima_alteracao)');
                
                $stmt->bindValue(':cc_saldo', $this->getSaldo());
                $stmt->bindValue(':cc_pf_id', $this->getPf());
                $stmt->bindValue(':cc_dt_ultima_alteracao', $this->getDtUltimaAlteracao());
                
                return $stmt->execute();
            }

            public function editar($cc_numero) {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('UPDATE conta_corrent SET cc_saldo = :cc_saldo, cc_pf_id = :cc_pf_id, cc_dt_ultima_alteracao = :cc_dt_ultima_alteracao 
                WHERE (cc_numero = :cc_numero);');

                $stmt->bindValue(':cc_numero', $this->setNumero($this->cc_numero));
                $stmt->bindValue(':cc_saldo', $this->setSaldo($this->cc_saldo));
                $stmt->bindValue(':cc_pf_id', $this->setPf($this->cc_pf_id));
                $stmt->bindValue(':cc_dt_ultima_alteracao', $this->setDtUltimaAlteracao($this->cc_dt_ultima_alteracao));

                return $stmt->execute();
            }

            function excluir($cc_numero){
                $pdo = Conexao::getInstance();
                $stmt = $pdo ->prepare('DELETE FROM conta_corrent WHERE cc_numero = :cc_numero');
                $stmt->bindValue(':cc_numero', $cc_numero);
                
                return $stmt->execute();
            }

            public function buscar($numero){
                require_once("conf/Conexao.php");
    
                $conexao = Conexao::getInstance();
    
                $query = 'SELECT * FROM conta_corrent';
                if($id > 0){
                    $query .= ' WHERE cc_pf_id = :Id';
                    $stmt->bindParam(':Id', $id);
                }
                    $stmt = $conexao->prepare($query);
                    if($stmt->execute())
                        return $stmt->fetchAll();
            
                    return false;
            }
        }
    ?>
    </div>
</body>
</html>
