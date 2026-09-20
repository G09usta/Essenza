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
elseif (isset($_GET['buscar'])) {
    $busca = $_GET['buscar'];
    $buscaLike = "%" . $busca . "%";

    // Verifica se o usuário escolheu um campo específico
    if (isset($_GET['campoUnico']) && in_array($_GET['campoUnico'], ['cosNome','cosMarca','tipoCos'])) {
        $campo = $_GET['campoUnico'];
        $sql = "SELECT cosImagem, cosNome, cosMarca, tipoCos, cosRecicla, cosAnimal, cosVegano, pratiSusten, embalagemSusten, cosLink, valorAmb 
                FROM testando 
                WHERE $campo LIKE ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $buscaLike);
    } else {
        // Busca automática nos três campos
        $sql = "SELECT cosImagem, cosNome, cosMarca, tipoCos, cosRecicla, cosAnimal, cosVegano, pratiSusten, embalagemSusten, cosLink, valorAmb 
                FROM testando 
                WHERE (cosNome LIKE ? OR cosMarca LIKE ? OR tipoCos LIKE ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sss", $buscaLike, $buscaLike, $buscaLike);
    }

    // Filtros adicionais
    $filtros = [];
    if (isset($_GET['recicla'])) {
        $filtros[] = "cosRecicla = 1";
    }
    if (isset($_GET['vegano'])) {
        $filtros[] = "cosVegano = 1";
    }
    if (isset($_GET['animal'])) {
        $filtros[] = "cosAnimal = 0"; // supondo que 0 = não testado
    }
    if (isset($_GET['embalagem'])) {
        $filtros[] = "embalagemSusten = 1";
    }
    if (isset($_GET['praticas'])) {
        $filtros[] = "pratiSusten = 1";
    }

    if (!empty($filtros)) {
        $sql .= " AND " . implode(" AND ", $filtros);
        $stmt = $conexao->prepare($sql);
        // Reaplica os parâmetros da busca
        if (isset($campo)) {
            $stmt->bind_param("s", $buscaLike);
        } else {
            $stmt->bind_param("sss", $buscaLike, $buscaLike, $buscaLike);
        }
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
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
               placeholder="Digite nome, marca ou tipo..."
               value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
    </div>

    <div class="grupo">
        <span class="grupo-titulo">Filtrar por campo específico:</span>
        <div class="radio-area">
            <label><input type="radio" name="campoUnico" value="cosNome" <?php if(isset($_GET['campoUnico']) && $_GET['campoUnico']=='cosNome') echo 'checked'; ?>> Nome</label>
            <label><input type="radio" name="campoUnico" value="cosMarca" <?php if(isset($_GET['campoUnico']) && $_GET['campoUnico']=='cosMarca') echo 'checked'; ?>> Marca</label>
            <label><input type="radio" name="campoUnico" value="tipoCos" <?php if(isset($_GET['campoUnico']) && $_GET['campoUnico']=='tipoCos') echo 'checked'; ?>> Tipo</label>
        </div>
    </div>

    <div class="grupo">
        <span class="grupo-titulo">Filtros adicionais:</span>
        <div class="checkbox-area">
            <label><input type="checkbox" name="recicla" value="Sim" <?php if(isset($_GET['recicla'])) echo 'checked'; ?>> Reciclável</label>
            <label><input type="checkbox" name="animal" value="Sim" <?php if(isset($_GET['animal'])) echo 'checked'; ?>> Testado em animais</label>
            <label><input type="checkbox" name="vegano" value="Sim" <?php if(isset($_GET['vegano'])) echo 'checked'; ?>> Vegano</label>
            <label><input type="checkbox" name="embalagem" value="Sim" <?php if(isset($_GET['embalagem'])) echo 'checked'; ?>> Embalagem Sustentável</label>
            <label><input type="checkbox" name="praticas" value="Sim" <?php if(isset($_GET['praticas'])) echo 'checked'; ?>> Práticas Sustentáveis</label>
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
