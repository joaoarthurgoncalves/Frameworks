<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .div1 {
            color: crimson;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa; /* Cor de fundo clara para contraste */
        }
    </style>
</head>
<body>
    <div class="form-container card mx-auto mt-5" style="width: 400px; height: 700px;">
        <form action="conexao.php" method="post">
            <div class="mb-3 div1">
                <input type="hidden" name="criar" value="1">
                <label for="servidor">Servidor:</label>
                <input type="text" name="servidor" class="form-control"><br>
            </div>

            <div class="mb-3 div1">
                <label for="banco">Banco de Dados:</label>
                <input type="text" name="banco" class="form-control"><br>
            </div>

            <div class="mb-3 div1">
                <label for="usuario">Usuário do Banco de Dados:</label>
                <input type="text" name="usuario" class="form-control"><br>
            </div>

            <div class="mb-3 div1">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" class="form-control"><br><br>
                <input type="submit" value="Criar" class="btn btn-primary">
            </div>
            <label class="">
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
        </form>
    </div>
    
</body>
</html>
