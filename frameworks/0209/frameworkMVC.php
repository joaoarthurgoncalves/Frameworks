
<html lang="pt">
<head>
    <title>Framework MVC</title>
</head>
<body>
  <form action="conexao.php" method="post">
      <input type="hidden" name="criar" value="1">
      <label for="servidor">Servidor: </label>
      <input type="text" name="servidor" value="localhost"><br>
      <label for="banco">Banco de Dados: </label>
      <input type="text" name="banco" value="alunos"><br>
      <label for="usuario">Usuário do Banco de Dados: </label>
      <input type="text" name="usuario" value="joao"><br>
      <label for="senha">Senha: </label>
      <input type="password" name="senha" value=""> <br>
      <input type="submit" value="Criar">
  </form>
<label>
    <?php
       if (isset($_GET['msg'])) {
           switch ($_GET['msg']) {
               case 0:
                   echo "Arquitetura do sistema criada com sucesso!";
                   break;
               case 1:
                   echo "ERRO: Problema ao conectar com o Banco de Dados!";
                   break;

            }
       }
    ?>
</label>
</body>
</html>
