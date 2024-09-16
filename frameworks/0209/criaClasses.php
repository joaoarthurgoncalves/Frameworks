<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class criaClasses{
    static function criar($conn,$banco,$usuario,$senha)
    {
      	$tBanco="Tables_in_".$banco;
       	$query = $conn->query("show tables");
        $tabelas = $query->fetchALL(PDO::FETCH_OBJ);
        $conteudo = "";
        umask(000);
        if (!file_exists("sistema")){
            mkdir("sistema");
        }

        if(!file_exists("sistema/model"))
            mkdir("sistema/model");
        if(!file_exists("sistema/view"))
            mkdir("sistema/view");
        if(!file_exists("sistema/control"))
            mkdir("sistema/control");
        if(!file_exists("sistema/dao"))
            mkdir("sistema/dao");
        file_put_contents("sistema/index.php", "");
        foreach ($tabelas as $tabela) {
            $conteudo .= "<?php\nclass " . ucfirst($tabela->$tBanco) . "{\n";
            $queryAttr = $conn->query("show columns from " . $tabela->$tBanco);
            $atributos = $queryAttr->fetchAll(PDO::FETCH_OBJ);
            foreach ($atributos as $atributo) {
                $conteudo .= "private $" . $atributo->Field . ";\n";
            }

            foreach ($atributos as $atributo) {
            $conteudo .= "function get" . ucfirst($atributo->Field) . "(){
              return $" . "this->" . $atributo->Field . ";\n}\n";
            $conteudo .= "function set" . ucfirst($atributo->Field) . "($" . $atributo->Field . "){
             $" . "this->" . $atributo->Field . "=" . $atributo->Field . ";
         }\n?>";
            }
            file_put_contents("sistema/model/" . $tabela->$tBanco . ".php", $conteudo);
            $conteudo = "";
        }

        //Criação de classes - camada DAO
        foreach ($tabelas as $tabela) {
            $conteudo = "<?php\ninclude 'conexao.php';\n\n";
            $conteudo .= "class " . ucfirst($tabela->$tBanco) . "DAO {\n";
            $conteudo .= "\tprivate \$con;\n\n";
            $conteudo .= "\tpublic function __construct() {\n";
            $conteudo .= "\t\t\$this->con = Conexao::conectar();\n";
            $conteudo .= "\t}\n\n";

            $conteudo .= "\tpublic function inserir(" . '$obj' . ") {\n";
            $conteudo .= "\t\t\$sql = \"INSERT INTO " . $tabela->$tBanco . " (";

            $queryAttr = $conn->query("show columns from " . $tabela->$tBanco);
            $atributos = $queryAttr->fetchAll(PDO::FETCH_OBJ);
            $atributos_sql = [];
            foreach ($atributos as $atributo) {
                if (strpos($atributo->Extra, 'auto_increment') === false) {
                    $atributos_sql[] = $atributo->Field;
                }
            }
            $conteudo .= implode(", ", $atributos_sql) . ") VALUES (";
            
        //Loop para adicionar os placeholders
            $placeholders = array_fill(0, count($atributos)-1, "?");
            $conteudo .= implode(", ", $placeholders) . ")\";\n";
            
            $conteudo .= "\t\t\$stmt = \$this->con->prepare(\$sql);\n";
            $conteudo .= "\t\t\$stmt->execute([\n";
            
            $valores = [];
            foreach ($atributos as $atributo) {
                if (strpos($atributo->Extra, 'auto_increment') === false) {
                    $valores[] = '$obj->get' . ucfirst($atributo->Field) . '()';
                }
            }
            $conteudo .= "\t\t\t" . implode(",\n\t\t\t", $valores) . "\n";
            $conteudo .= "\t\t]);\n";
            $conteudo .= "\t}\n\n";
            
            $conteudo .= "\tpublic function excluir() {\n\t\t// Método Excluir\n\t}\n\n";
            $conteudo .= "\tpublic function buscar() {\n\t\t// Método Buscar\n\t}\n\n";
            $conteudo .= "\tpublic function alterar() {\n\t\t// Método Alterar\n\t}\n";
            $conteudo .= "}\n?>";
            
            file_put_contents("sistema/dao/" . $tabela->$tBanco . "DAO.php", $conteudo);
        }

		//Arquivo de conexão
		    $conteudo="<?php\nclass Conexao{\n";
            $conteudo .= "\tprivate static $". "con;\n";
            $conteudo .= "\tstatic function conectar() {\n";
		    $conteudo .= "\t\ttry{\n";
		    $conn='self::$con';
		    $e='$e';
		    $conteudo .= "\t\t\t$conn = new PDO('mysql:host=localhost;dbname=$banco','$usuario','$senha');\n";
            $conteudo .= "\t\treturn $conn;\n";
		    $conteudo .= "\t\t}catch(PDOException $e){\n";
		    $conteudo .= "\t\t\techo $e"."->getMessage();";
		    $conteudo .= "\n\t\t}\n\t}\n}\n?>";
		file_put_contents("sistema/dao/" . "conexao.php", $conteudo);

		//Criação de Classes - camada control
        $conteudo = "";
        foreach ($tabelas as $tabela) {
            $conteudo = "include '../dao/" . $tabela->$tBanco . "DAO.php';\n";
            $conteudo .= "class " . ucfirst($tabela->$tBanco) . "Control{\n";
            file_put_contents("sistema/control/" . $tabela->$tBanco . "Control.php", $conteudo);
        }
        return 1;
    }
}
?>
