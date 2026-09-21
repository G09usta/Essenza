<?php
$servidor="localhost";
$usuario="root";
$senha="";
$banco="Essenza";

$conexao=new mysqli($servidor,$usuario,$senha,$banco);

if($conexao->connect_error){
    die("Erro na conexão: ".$conexao->connect_error);
}

$conexao->set_charset("utf8mb4");

function mostrarDetalhes($produto,$id){
?>
<table border="1" id="<?php echo $id; ?>" style="display:none;">
<tr><th>Nome</th><td><?php echo htmlspecialchars($produto['cosNome']); ?></td></tr>
<tr><th>Marca</th><td><?php echo htmlspecialchars($produto['cosMarca']); ?></td></tr>
<tr><th>Tipo</th><td><?php echo htmlspecialchars($produto['tipoCos']); ?></td></tr>
<tr><th>Imagem</th><td><img src="<?php echo htmlspecialchars($produto['cosImagem']); ?>" width="150"></td></tr>
<tr><th>Embalagem Sustentável</th><td><?php echo htmlspecialchars($produto['embalagemSusten']); ?></td></tr>
<tr><th>Vegano</th><td><?php echo htmlspecialchars($produto['cosVegano']); ?></td></tr>
<tr><th>Testado em animais</th><td><?php echo $produto['cosAnimal']=="Nao" ? "Não" : "Sim"; ?></td></tr>
<tr><th>Reciclável</th><td><?php echo htmlspecialchars($produto['cosRecicla']); ?></td></tr>
<tr><th>Práticas Sustentáveis</th><td><?php echo htmlspecialchars($produto['pratiSusten']); ?></td></tr>
<tr><th>Valor Ambiental</th><td><?php echo htmlspecialchars($produto['valorAmb']); ?></td></tr>
</table>
<?php
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Essenza</title>

<script>
function detalhes(id){
    let tabela=document.getElementById(id);
    let mostrar=document.getElementById("mostrar_"+id);
    let minimizar=document.getElementById("minimizar_"+id);

    if(tabela.style.display==="none"){
        tabela.style.display="table";
        mostrar.style.display="none";
        minimizar.style.display="inline";
    }else{
        tabela.style.display="none";
        mostrar.style.display="inline";
        minimizar.style.display="none";
    }
}

function escolherProduto(url,mensagem){
    if(confirm(mensagem)){
        window.location.href=url;
    }
}

function abrirProduto(url,mensagem){
    if(confirm(mensagem)){
        window.open(url,"_blank");
    }
}
</script>

</head>

<body>

<h1>Essenza</h1>

<form method="get">

<input type="text" name="buscar" value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">

<select name="campo">
<option value="todos" <?php if(!isset($_GET['campo']) || $_GET['campo']=="todos") echo "selected"; ?>>Todos</option>
<option value="nome" <?php if(isset($_GET['campo']) && $_GET['campo']=="nome") echo "selected"; ?>>Nome</option>
<option value="marca" <?php if(isset($_GET['campo']) && $_GET['campo']=="marca") echo "selected"; ?>>Marca</option>
<option value="tipo" <?php if(isset($_GET['campo']) && $_GET['campo']=="tipo") echo "selected"; ?>>Tipo</option>
</select>

<button type="submit">Buscar</button>

<br><br>

<label>Reciclável:
<select name="recicla">
<option value="">Qualquer</option>
<option value="Sim" <?php if(isset($_GET['recicla']) && $_GET['recicla']=="Sim") echo "selected"; ?>>Sim</option>
<option value="Nao" <?php if(isset($_GET['recicla']) && $_GET['recicla']=="Nao") echo "selected"; ?>>Não</option>
</select>
</label>

<label>Vegano:
<select name="vegano">
<option value="">Qualquer</option>
<option value="Sim" <?php if(isset($_GET['vegano']) && $_GET['vegano']=="Sim") echo "selected"; ?>>Sim</option>
<option value="Nao" <?php if(isset($_GET['vegano']) && $_GET['vegano']=="Nao") echo "selected"; ?>>Não</option>
</select>
</label>

<label>Testado em animais:
<select name="animal">
<option value="">Qualquer</option>
<option value="Sim" <?php if(isset($_GET['animal']) && $_GET['animal']=="Sim") echo "selected"; ?>>Sim</option>
<option value="Nao" <?php if(isset($_GET['animal']) && $_GET['animal']=="Nao") echo "selected"; ?>>Não</option>
</select>
</label>

<label>Embalagem sustentável:
<select name="embalagem">
<option value="">Qualquer</option>
<option value="Sim" <?php if(isset($_GET['embalagem']) && $_GET['embalagem']=="Sim") echo "selected"; ?>>Sim</option>
<option value="Nao" <?php if(isset($_GET['embalagem']) && $_GET['embalagem']=="Nao") echo "selected"; ?>>Não</option>
</select>
</label>

<label>Práticas sustentáveis:
<select name="praticas">
<option value="">Qualquer</option>
<option value="Sim" <?php if(isset($_GET['praticas']) && $_GET['praticas']=="Sim") echo "selected"; ?>>Sim</option>
<option value="Nao" <?php if(isset($_GET['praticas']) && $_GET['praticas']=="Nao") echo "selected"; ?>>Não</option>
</select>
</label>

<br><br>

<button type="submit" name="verTodos" value="1">Ver todos</button>

</form>

<br>

<?php
$buscar=isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
$campo=isset($_GET['campo']) ? $_GET['campo'] : "todos";

$filtros=[];

if(isset($_GET['recicla']) && $_GET['recicla']!=""){
    $filtros[]="cosRecicla='".$conexao->real_escape_string($_GET['recicla'])."'";
}

if(isset($_GET['vegano']) && $_GET['vegano']!=""){
    $filtros[]="cosVegano='".$conexao->real_escape_string($_GET['vegano'])."'";
}

if(isset($_GET['animal']) && $_GET['animal']!=""){
    $filtros[]="cosAnimal='".$conexao->real_escape_string($_GET['animal'])."'";
}

if(isset($_GET['embalagem']) && $_GET['embalagem']!=""){
    $filtros[]="embalagemSusten='".$conexao->real_escape_string($_GET['embalagem'])."'";
}

if(isset($_GET['praticas']) && $_GET['praticas']!=""){
    $filtros[]="pratiSusten='".$conexao->real_escape_string($_GET['praticas'])."'";
}

$sql="SELECT cosImagem,cosNome,cosMarca,tipoCos FROM testando";
$parametros=[];
$tipos="";

if($buscar!=""){
    if($campo=="nome"){
        $sql.=" WHERE cosNome LIKE ?";
        $parametros[]="%".$buscar."%";
        $tipos="s";
    }elseif($campo=="marca"){
        $sql.=" WHERE cosMarca LIKE ?";
        $parametros[]="%".$buscar."%";
        $tipos="s";
    }elseif($campo=="tipo"){
        $sql.=" WHERE tipoCos LIKE ?";
        $parametros[]="%".$buscar."%";
        $tipos="s";
    }else{
        $sql.=" WHERE (cosNome LIKE ? OR cosMarca LIKE ? OR tipoCos LIKE ?)";
        $parametros[]="%".$buscar."%";
        $parametros[]="%".$buscar."%";
        $parametros[]="%".$buscar."%";
        $tipos="sss";
    }
}

if(count($filtros)>0){
    $sql.=($buscar!="" ? " AND " : " WHERE ").implode(" AND ",$filtros);
}

$sql.=" ORDER BY cosNome ASC";

$stmt=$conexao->prepare($sql);

if(count($parametros)>0){
    $stmt->bind_param($tipos,...$parametros);
}

$stmt->execute();
$resultado=$stmt->get_result();

$mostrarResultados=$buscar!="" || count($filtros)>0 || isset($_GET['verTodos']);

if($mostrarResultados){
?>

<h2>Produtos</h2>

<table border="1">
<tr>
<th>Imagem</th>
<th>Nome</th>
<th>Marca</th>
<th>Tipo</th>
</tr>

<?php
if($resultado->num_rows>0){
    while($linha=$resultado->fetch_assoc()){
?>
<tr onclick="window.location.href='?produtoSelecionado=<?php echo urlencode($linha['cosNome']); ?>'">
<td><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="100"></td>
<td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
<td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
<td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
</tr>
<?php
    }
}else{
?>
<tr>
<td colspan="4">Nenhum produto encontrado.</td>
</tr>
<?php
}
?>

</table>

<?php
}

if(isset($_GET['produtoSelecionado'])){
    $nomeSelecionado=$_GET['produtoSelecionado'];

    $stmt=$conexao->prepare("SELECT * FROM testando WHERE cosNome=?");
    $stmt->bind_param("s",$nomeSelecionado);
    $stmt->execute();
    $resultado=$stmt->get_result();

    if($resultado->num_rows>0){
        $produto=$resultado->fetch_assoc();

        $stmtMaiorSelecionado=$conexao->prepare("SELECT cosNome FROM testando WHERE tipoCos=? AND valorAmb>? AND cosNome<>?");
        $stmtMaiorSelecionado->bind_param("sis",$produto['tipoCos'],$produto['valorAmb'],$produto['cosNome']);
        $stmtMaiorSelecionado->execute();
        $resultadoMaiorSelecionado=$stmtMaiorSelecionado->get_result();

        if($resultadoMaiorSelecionado->num_rows>0){
            $mensagemSelecionado="Este produto possui um valor ambiental menor que outro produto do mesmo tipo. Existem produtos com maior valor ambiental. Deseja realmente ir para este produto?";
        }else{
            $mensagemSelecionado="Deseja realmente ir para este produto?";
        }

        $stmt=$conexao->prepare("SELECT * FROM testando WHERE tipoCos=? AND valorAmb>? AND cosNome<>? ORDER BY valorAmb DESC");
        $stmt->bind_param("sis",$produto['tipoCos'],$produto['valorAmb'],$produto['cosNome']);
        $stmt->execute();
        $alternativas=$stmt->get_result();

        $temAlternativas=$alternativas->num_rows>0;
?>

<hr>

<h2>Produto selecionado</h2>

<table border="1">
<tr>
<th>Imagem</th>
<th>Nome</th>
<th>Marca</th>
<th>Tipo</th>
<th>Detalhes</th>
</tr>

<tr onclick="abrirProduto('<?php echo htmlspecialchars($produto['cosLink'],ENT_QUOTES); ?>','<?php echo htmlspecialchars($mensagemSelecionado,ENT_QUOTES); ?>')" style="cursor:pointer;">
<td><img src="<?php echo htmlspecialchars($produto['cosImagem']); ?>" width="100"></td>
<td><?php echo htmlspecialchars($produto['cosNome']); ?></td>
<td><?php echo htmlspecialchars($produto['cosMarca']); ?></td>
<td><?php echo htmlspecialchars($produto['tipoCos']); ?></td>
<td onclick="event.stopPropagation();">
<button type="button" id="mostrar_detalhes_selecionado" onclick="detalhes('detalhes_selecionado')">Ver detalhes</button>
<button type="button" id="minimizar_detalhes_selecionado" onclick="detalhes('detalhes_selecionado')" style="display:none;">Minimizar detalhes</button>
</td>
</tr>
</table>

<?php
mostrarDetalhes($produto,"detalhes_selecionado");

if($temAlternativas){
?>

<h2>Produtos do mesmo tipo com maior valor ambiental</h2>

<table border="1">
<tr>
<th>Imagem</th>
<th>Nome</th>
<th>Marca</th>
<th>Tipo</th>
<th>Detalhes</th>
</tr>

<?php
$i=0;

while($linha=$alternativas->fetch_assoc()){
    $i++;

    $id="alternativa_".$i;

    $stmtMaior=$conexao->prepare("SELECT cosNome FROM testando WHERE tipoCos=? AND valorAmb>? AND cosNome<>?");
    $stmtMaior->bind_param("sis",$linha['tipoCos'],$linha['valorAmb'],$linha['cosNome']);
    $stmtMaior->execute();
    $resultadoMaior=$stmtMaior->get_result();

    if($resultadoMaior->num_rows>0){
        $mensagem="Este produto possui um valor ambiental menor que outro produto do mesmo tipo. Existem produtos com maior valor ambiental. Deseja realmente escolher este produto?";
    }else{
        $mensagem="Deseja realmente escolher este produto?";
    }

    $url="?produtoSelecionado=".urlencode($linha['cosNome']);
?>

<tr onclick="escolherProduto('<?php echo htmlspecialchars($url,ENT_QUOTES); ?>','<?php echo htmlspecialchars($mensagem,ENT_QUOTES); ?>')" style="cursor:pointer;">
<td><img src="<?php echo htmlspecialchars($linha['cosImagem']); ?>" width="100"></td>
<td><?php echo htmlspecialchars($linha['cosNome']); ?></td>
<td><?php echo htmlspecialchars($linha['cosMarca']); ?></td>
<td><?php echo htmlspecialchars($linha['tipoCos']); ?></td>
<td onclick="event.stopPropagation();">
<button type="button" id="mostrar_detalhes_<?php echo $id; ?>" onclick="detalhes('detalhes_<?php echo $id; ?>')">Ver detalhes</button>
<button type="button" id="minimizar_detalhes_<?php echo $id; ?>" onclick="detalhes('detalhes_<?php echo $id; ?>')" style="display:none;">Minimizar detalhes</button>
</td>
</tr>

<tr>
<td colspan="5">
<?php mostrarDetalhes($linha,"detalhes_".$id); ?>
</td>
</tr>

<?php
}
?>

</table>

<?php
}else{
    echo "<p>Não existem produtos do mesmo tipo com valor ambiental maior.</p>";
}
}
}
?>

</body>
</html>

