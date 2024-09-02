<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class criaClasses
    {
    static function criar($conn,$banco,$usuario,$senha)
    {
       $tBanco="Tables_in_".$banco;
       $query = $conn->query("show tables");
        $tabelas = $query->fetchALL(PDO::FETCH_OBJ);
        $conteudo = "";
        umask(000);
        if (!file_exists("sistema")) {
            mkdir("sistema");
        }
        if (!file_exists("sistema/model"))
            mkdir("sistema/model");
        if (!file_exists("sistema/view"))
            mkdir("sistema/view");
        if (!file_exists("sistema/control"))
            mkdir("sistema/control");
        if (!file_exists("sistema/dao"))
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
        //Criação de classes da camada DAO
         foreach ($tabelas as $tabela) {
             $conteudo = "<?php\nclass " . ucfirst($tabela->$tBanco) . "DAO{\n";
             $conteudo .= "\tpublic __construct() {\n}\n";
             $conteudo .= "\tfunction inserir() {\n}\n";
             $conteudo .= "\tfunction excluir() {\n}\n";
             $conteudo .= "\tfunction buscar() {\n}\n";
             $conteudo .= "\tfunction alterar() {\n}\n}\n?>";
             file_put_contents("sistema/dao/" . $tabela->$tBanco . "DAO.php", $conteudo);
             $conteudo = "";
         }
         //Criação do arquivo de conexao
         $conteudo="<?php\nclass Conexao{\n";
        $conteudo .= "\tstatic function conectar() {\n";
         $conteudo .= "\t\ttry{\n";
         $conn='$conn';
         $e='$e';
         $conteudo .= "\t\t\t$conn = new PDO('mysql:host=localhost;dbname=$banco','$usuario','$senha');\n";
         $conteudo.= "\t\t}catch(PDOException $e){\n";
         $conteudo.= "\t\t\techo $e"."->getMessage();";
         $conteudo .= "\n\t\t}\n\treturn $conn;\n\t}\n}\n?>";
         file_put_contents("sistema/dao/" . "conexao.php", $conteudo);
         //Criação de Classes da camada control
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
 
