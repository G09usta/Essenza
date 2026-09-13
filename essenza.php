<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "Essenza";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$resultado = null;

if (isset($_GET['buscar']) && isset($_GET['campos'])) {
    $busca = $_GET['buscar'];
    $campos = $_GET['campos'];

    $condicoes = [];

    foreach ($campos as $campo) {
        if (in_array($campo, ['cosNome','cosMarca','tipoCos','cosRecicla','cosAnimal','cosVegano','pratiSusten','embalagemSusten','valorAmb','cosLink','cosImagem'])) {
            $condicoes[] = "$campo LIKE ?";
        }
    }

    if (!empty($condicoes)) {
        $sql = "SELECT cosImagem, cosNome, cosMarca, tipoCos, cosRecicla, cosAnimal, cosVegano, pratiSusten, embalagemSusten, cosLink, valorAmb FROM ultima WHERE " . implode(" OR ", $condicoes);

        $stmt = $conexao->prepare($sql);

        $parametros = [];
        $tipos = "";

        foreach ($condicoes as $condicao) {
            $parametros[] = "%" . $busca . "%";
            $tipos .= "s";
        }

        $stmt->bind_param($tipos, ...$parametros);
        $stmt->execute();

        $resultado = $stmt->get_result();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Busca de Cosméticos</title>

</head>

<body>

<div class="container">

    <h1>Busca de Cosméticos</h1>

    <form method="GET">

        <div class="grupo">

            <label class="grupo-titulo">
                Digite sua busca:
            </label>

            <input
                type="text"
                name="buscar"
                required
                value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>"
            >

        </div>

        <div class="grupo">

            <span class="grupo-titulo">
                Escolha os campos da busca:
            </span>

            <div class="radio-area">

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="cosNome"
                        <?php if (isset($_GET['campos']) && in_array("cosNome", $_GET['campos'])) echo "checked"; ?>>
                    Nome
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="cosMarca"
                        <?php if (isset($_GET['campos']) && in_array("cosMarca", $_GET['campos'])) echo "checked"; ?>>
                    Marca
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="tipoCos"
                        <?php if (isset($_GET['campos']) && in_array("tipoCos", $_GET['campos'])) echo "checked"; ?>>
                    Tipo
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="cosRecicla"
                        <?php if (isset($_GET['campos']) && in_array("cosRecicla", $_GET['campos'])) echo "checked"; ?>>
                    Reciclável
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="cosAnimal"
                        <?php if (isset($_GET['campos']) && in_array("cosAnimal", $_GET['campos'])) echo "checked"; ?>>
                    Testado em animal
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="cosVegano"
                        <?php if (isset($_GET['campos']) && in_array("cosVegano", $_GET['campos'])) echo "checked"; ?>>
                    Vegano
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="embalagemSusten"
                        <?php if (isset($_GET['campos']) && in_array("embalagemSusten", $_GET['campos'])) echo "checked"; ?>>
                    Embalagem Sustentável
                </label>

                <label>
                    <input
                        type="radio"
                        name="campos[]"
                        value="pratiSusten"
                        <?php if (isset($_GET['campos']) && in_array("pratiSusten", $_GET['campos'])) echo "checked"; ?>>
                    Práticas Sustentáveis
                </label>

            </div>

        </div>

        <div class="botoes">

            <button type="submit">
                Buscar
            </button>

        </div>

    </form>

    <?php if($resultado !== null){ ?>

        <?php if($resultado->num_rows > 0){ ?>

            <div class="tabela-container">

               <table>
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Marca</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php while($linha = $resultado->fetch_assoc()){ ?>
            <tr onclick="marcarLinha(this)">
                <td><?php if(!empty($linha['cosImagem'])){ ?><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="80"><?php } ?></td>
                <td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
                <td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
                <td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


                    <tbody>

                    <?php while($linha = $resultado->fetch_assoc()){ ?>

                        <tr>
                            <td><?php if(!empty($linha['cosImagem'])){ ?><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="80"><?php } ?></td>
                            <td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
                            <td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
                            <td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        <?php }else{ ?>

            <div class="mensagem">
                Nenhum resultado encontrado.
            </div>

        <?php } ?>

    <?php } ?>

</div>


</body>

</html>

<?php
$conexao->close();
?>
