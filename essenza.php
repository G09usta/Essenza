<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "Essenza";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);



if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
$conexao->set_charset("utf8mb4");

$resultado = null;
$relacionados = null;

// Mostrar todos os produtos cadastrados
if (isset($_GET['mostrarTodos'])) {
    $sql = "SELECT cosImagem, cosNome, cosMarca, tipoCos, valorAmb, cosLink 
            FROM testando 
            ORDER BY cosNome ASC";
    $resultado = $conexao->query($sql);
}

// 
elseif (isset($_GET['buscar']) && isset($_GET['campos'])) {
    $busca = $_GET['buscar'];
    $campos = $_GET['campos'];

    $condicoes = [];

    foreach ($campos as $campo) {
        if (in_array($campo, ['cosNome','cosMarca','tipoCos','cosRecicla','cosAnimal','cosVegano','pratiSusten','embalagemSusten','valorAmb','cosLink','cosImagem'])) {
            $condicoes[] = "$campo LIKE ?";
        }
    }

    if (!empty($condicoes)) {
        $sql = "SELECT cosImagem, cosNome, cosMarca, tipoCos, cosRecicla, cosAnimal, cosVegano, pratiSusten, embalagemSusten, cosLink, valorAmb 
                FROM testando 
                WHERE " . implode(" OR ", $condicoes);

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

// essa parte é a que pega os produtos de mesmo tipo e maior valor ambiental, é a segunda tabela que aparece quandoa gente seleciona um produto.
if (isset($_GET['tipoSelecionado']) && isset($_GET['valorSelecionado'])) {
    $tipoSelecionado = $_GET['tipoSelecionado'];
    $valorSelecionado = (int)$_GET['valorSelecionado'];

    $sqlRel = "SELECT cosImagem, cosNome, cosMarca, tipoCos, valorAmb, cosLink 
               FROM testando 
               WHERE tipoCos = ? AND valorAmb > ? 
               ORDER BY valorAmb DESC";

    $stmtRel = $conexao->prepare($sqlRel);
    $stmtRel->bind_param("si", $tipoSelecionado, $valorSelecionado);
    $stmtRel->execute();
    $relacionados = $stmtRel->get_result();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Busca de Cosméticos</title>
</head>
<body>
<div class="container">

    <h1>Busca de Cosméticos</h1>

    <form method="GET">
        <div class="grupo">
            <label class="grupo-titulo">Digite sua busca:</label>
            <input type="text" name="buscar"
                   value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
        </div>

        <div class="grupo">
            <span class="grupo-titulo">Escolha os campos da busca:</span>
            <div class="radio-area">
                <label><input type="radio" name="campos[]" value="cosNome"> Nome</label>
                <label><input type="radio" name="campos[]" value="cosMarca"> Marca</label>
                <label><input type="radio" name="campos[]" value="tipoCos"> Tipo</label>
                <label><input type="radio" name="campos[]" value="cosRecicla"> Reciclável</label>
                <label><input type="radio" name="campos[]" value="cosAnimal"> Testado em animal</label>
                <label><input type="radio" name="campos[]" value="cosVegano"> Vegano</label>
                <label><input type="radio" name="campos[]" value="embalagemSusten"> Embalagem Sustentável</label>
                <label><input type="radio" name="campos[]" value="pratiSusten"> Práticas Sustentáveis</label>
            </div>
        </div>

        <div class="botoes">
            <button type="submit">Buscar</button>
            <button type="submit" name="mostrarTodos" value="1">Mostrar Todos</button>
        </div>
    </form>

    <?php if($resultado !== null){ ?>
        <?php if($resultado->num_rows > 0){ ?>
            <div class="tabela-container">
                <table border="1">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Valor Ambiental</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($linha = $resultado->fetch_assoc()){ ?>
                            <tr onclick="window.location.href='?tipoSelecionado=<?php echo urlencode($linha['tipoCos']); ?>&valorSelecionado=<?php echo urlencode($linha['valorAmb']); ?>'">
                                <td><?php if(!empty($linha['cosImagem'])){ ?><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="80"><?php } ?></td>
                                <td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
                                <td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
                                <td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
                                <td><?php echo htmlspecialchars($linha['valorAmb']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="mensagem">Nenhum resultado encontrado.</div>
        <?php } ?>
    <?php } ?>

    <?php if($relacionados !== null){ ?>
        <h2>Produtos do mesmo tipo com maior valor ambiental:</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Valor Ambiental</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                <?php while($linha = $relacionados->fetch_assoc()){ ?>
                    <tr>
                        <td><?php if(!empty($linha['cosImagem'])){ ?><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="60"><?php } ?></td>
                        <td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
                        <td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
                        <td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
                        <td><?php echo htmlspecialchars($linha['valorAmb']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($linha['cosLink']); ?>" target="_blank">Ver Produto</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

</div>
</body>
</html>
<?php
$conexao->close();

?>
