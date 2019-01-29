<?php
/*
* @author Douglas Pierre
* @company BaseTech TI Soluções e Tecnologias
* @mail basetechti@gmail.com
* @packageName Conexão com Banco de Dados
* @package v1.0
*/
//  Constances de Configuração com o SQL //
abstract class connection extends PDO {

    private $PDOHOST = "localhost";
    private $PDOUSER = "root";
    private $PDOPASS = "123456";
    private $PDODTBS = "provaonehost";
    private $PDODRIV = "mysql";
    private $PDODSN;
    public $condicao = NULL;
    public $having   = NULL;
    public $campos, $tabela, $execute, $registros, $count, $dados;

    public function __construct() {

        $this->PDODSN = $this->PDODRIV . ":host=" . $this->PDOHOST . ";dbname=" . $this->PDODTBS;
        try {
            parent::__construct($this->PDODSN, $this->PDOUSER, $this->PDOPASS, array("PDO::ATTR_ERRMODE" => "PDO::ERRMODE_EXCEPTION"));
            $this->query("SET NAMES 'utf8'");
            $this->query("SET character_set_connection=utf8");
            $this->query("SET character_set_client=utf8");
            $this->query("SET character_set_results=utf8");
        } catch (PDOException $e) {
            echo "<script>alert('" . $e->getMessage() . "')</script>";
        }
    }

    public function __destruct() {
        
    }

    public function cntRegistro() {
        try {
            if(!is_array($this->campos))return false;
            $SQL = "SELECT ";
            if(sizeof($this->campos) < 1){
                $SQL .= "* FROM ";
            }else{
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $SQL .= key($this->campos) . ", ";
                next($this->campos);
            }reset($this->campos);
            $SQL = substr_replace($SQL, " FROM ", -2, 6);
            }
            $SQL .= $this->tabela;
            if ($this->condicao != NULL) {
                $SQL .= " WHERE " . $this->condicao;
            }else{
                $SQL .= $this->having;
            }
            $SQL = $this->prepare($SQL);
            if ($SQL->execute()) {
                $this->registros = (array)$SQL->fetch(PDO::FETCH_BOTH);
                $this->count = $SQL->rowCount();
                $this->execute = true;
                return true;
            } else {
                $this->execute = false;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->execute = false;
            return false;
        }
    }

    public function insRegistro() {
        try {
            $SQL = "INSERT INTO " . $this->tabela . " (";
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $SQL .= key($this->campos) . ", ";
                next($this->campos);
            }reset($this->campos);
            $SQL = substr_replace($SQL, ") ", -2, 2);
            $SQL .= "VALUES (";
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $SQL .= "?, ";
                next($this->campos);
            }reset($this->campos);
            $SQL = substr_replace($SQL, ") ", -2, 2);
            $SQL = $this->prepare($SQL);
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $valor = $this->campos[key($this->campos)];
                $valor = (is_float($valor) || is_double($valor) ? strval($valor) : $valor);
                $parametro = PDO::PARAM_STR;
                $SQL->bindValue($i, $valor, $parametro);
                next($this->campos);
            }reset($this->campos);
            if ($SQL->execute()) {
                $this->execute = true;
                return true;
            } else {
                $this->execute = false;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->execute = false;
            return false;
        }
    }

    public function updRegistro() {
        try {
            $SQL = "UPDATE " . $this->tabela . " SET ";
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $SQL .= key($this->campos) . " = ?, ";
                next($this->campos);
            }reset($this->campos);
            $SQL = substr_replace($SQL, "", -2, 2);
            if ($this->condicao != NULL) {
                $SQL .= " WHERE " . $this->condicao;
            }
            $SQL = $this->prepare($SQL);
            for ($i = 1; $i <= sizeof($this->campos); ++$i) {
                $valor = $this->campos[key($this->campos)];
                $valor = (is_float($valor) || is_double($valor) ? strval($valor) : $valor);
                $parametro = PDO::PARAM_STR;
                $SQL->bindValue($i, $valor, $parametro);
                next($this->campos);
            }reset($this->campos);
            if ($SQL->execute()) {
                $this->execute = true;
                return true;
            } else {
                $this->execute = false;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->execute = false;
            return false;
        }
    }

    public function delRegistro() {
        try {
            $SQL = "DELETE FROM " . $this->tabela;
            if ($this->condicao != NULL) {
                $SQL .= " WHERE " . $this->condicao;
            }
            $SQL = $this->prepare($SQL);
            if ($SQL->execute()) {
                $this->execute = true;
                return true;
            } else {
                $this->execute = false;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->execute = false;
            return false;
            ;
        }
    }

    public function keyDir($keyDir) {
        $x = explode("/", dirname(__FILE__));
        for ($i = 0; $i <= ($keyDir <= sizeof($x) ? $keyDir : sizeof($x)); ++$i) {
            $directory .= $x[$i] . DIRECTORY_SEPARATOR;
        }
        return $directory;
    }

    public function keyDirM($keyDir) {
        $x = explode("/", dirname(__FILE__));
        return $x[$keyDir] . DIRECTORY_SEPARATOR;
    }

    public function getConn() {
        return self::getInstance();
    }

    public function set($tabela = NULL, $where = NULL) {
        $this->SQLTable = $tabela;
        $this->SQLWhere = $where;
        return $this;
    }

    public function countRows($tabela = NULL, $where = NULL) {
        //$conn = self::getInstance();
        if ($where != NULL)
            $where = "WHERE " . $where;
        $prepare = $this->prepare("SELECT * FROM " . $tabela . " " . $where);
        $prepare->execute();
        if ($prepare->rowCount() <= 0) {
            return false;
        } else {
            if ($prepare->rowCount() > 0) {
                return $prepare->rowCount();
            } else {
                return '0';
            }
        }
    }

    public function fetchSQL($tabela = NULL, $where = NULL) {
      //  $conn = self::getInstance();
        if ($where != NULL)
            $where = "WHERE " . $where;
        $prepare = $this->prepare("SELECT * FROM " . $tabela . " " . $where);
        $prepare->execute();
        if ($prepare->rowCount() <= 0) {
            return false;
        } else {
            return $prepare->fetch(PDO::FETCH_OBJ);
        }
    }

    public function InserirSQL($tabela = NULL, $array = NULL, $modo = ":", $error = FALSE, $msgSuccess = NULL, $msgError = NULL) {
        try {
            //$conn = self::getInstance();
            $SQL = "INSERT INTO " . $tabela . " ( ";
            foreach ($array as $k => $v) {
                $SQL .= $k . ", ";
            }
            $SQL = substr_replace($SQL, ' ) ', -2, 2);
            $SQL .= " VALUES ( ";
            if ($modo == "?") {
                foreach ($array as $k => $v) {
                    $SQL .= "?, ";
                }
            } elseif ($modo == ":") {
                foreach ($array as $k => $v) {
                    $SQL .= ":" . $k . ", ";
                }
            }
            $SQL = substr_replace($SQL, ' ) ', -2, 2);
            $prepare = $this->prepare($SQL);
            if ($modo == ":") {
                foreach ($array as $k => $v) {
                    $prepare->bindValue(':' . $k . '', $v, PDO::PARAM_STR);
                }
            } elseif ($modo == "?") {
                foreach ($array as $k => $v) {
                    ++$k2;
                    $prepare->bindValue($k2, $v, PDO::PARAM_STR);
                }
            }
            $executa = $prepare->execute();
            if ($executa) {
                if (strtolower($error) == true) {
                    if ($msgSuccess == NULL) {
                        self::msgjava('Dados inseridos com sucesso');
                    } else {
                        self::msgjava($msgSuccess);
                    }
                }
                return true;
            } else {
                if (strtolower($error) == true) {
                    if ($msgError == NULL) {
                        self::msgjava('Erro ao inserir os dados');
                    } else {
                        self::msgjava($msgError);
                    }
                }
                return false;
            }
        } catch (PDOException $erro) {
            self::msgjava($erro->getMessage());
            $f = fopen('logs/Sistema/SQL/INSERT/INSERT-' . date("d-m-Y") . '.log', 'a');
            fwrite($f, "" . date("d/m/Y H:i:s") . " -> Informações de erro(INSERT): " . $erro->getMessage() . " 
						\n
						");
            fclose($f);
            return false;
        }
    }

    public function UpdateSQL($tabela = NULL, $array = NULL, $where = NULL, $modo = ":", $error = FALSE, $msgSuccess = NULL, $msgError = NULL) {
        try {
           // $conn = self::getInstance();
            $SQL = "UPDATE " . $tabela . " SET ";
            foreach ($array as $k => $v) {
                switch ($modo) {
                    case ":" : $SQL .= $k . "=:" . $k . ", ";
                        break;
                    case "?" : $SQL .= $k . "=?, ";
                        break;
                    default : $SQL .= $k . "=:" . $k . ", ";
                        break;
                }
            }$SQL = substr_replace($SQL, " ", -2, 2);

            if ($where != NULL) {
                $SQL .= " WHERE " . $where;
            }
            $prepare = $this->prepare($SQL);
            foreach ($array as $k => $v) {
                switch ($modo) {
                    case ":" :
                        $prepare->bindValue(':' . $k . '', $v, PDO::PARAM_STR);
                        break;
                    case "?" : ++$k2;
                        $prepare->bindValue($k2, $v, PDO::PARAM_STR);
                        break;
                    default :
                        $prepare->bindValue(':' . $k . '', $v, PDO::PARAM_STR);
                        break;
                }
            }
            $executa = $prepare->execute();

            if ($executa) {
                if (strtolower($error) == true) {
                    if ($msgSuccess == NULL) {
                        self::msgjava('Dados Alterados com sucesso');
                    } else {
                        self::msgjava($msgSuccess);
                    }
                }
                return true;
            } else {
                if (strtolower($error) == true) {
                    if ($msgError == NULL) {
                        self::msgjava('Erro ao Alterar os dados');
                    } else {
                        self::msgjava($msgError);
                    }
                }
                return false;
            }
        } catch (PDOException $erro) {
            self::msgjava($erro->getMessage());
            $f = fopen('logs/Sistema/SQL/UPDATE/UPDATE-' . date("d-m-Y") . '.log', 'a');
            fwrite($f, "" . date("d/m/Y H:i:s") . " -> Informações de erro(INSERT): " . $erro->getMessage() . " 
						\n
						");
            fclose($f);
            return false;
        }
    }

    public function Message($text = NULL) {
        echo "<script type=\"text/javascript\">alert('" . $text . "');</script>";
    }

}


?>