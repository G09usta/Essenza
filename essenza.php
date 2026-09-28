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
$produtoSelecionado=$_GET["produtoSelecionado"] ?? "";
$busca=$_GET["busca"] ?? "";
$campo=$_GET["campo"] ?? "Todos";
$embalagem=$_GET["embalagem"] ?? "";
$vegano=$_GET["vegano"] ?? "";
$animal=$_GET["animal"] ?? "";
$recicla=$_GET["recicla"] ?? "";
$pratica=$_GET["pratica"] ?? "";
function montarUrl($produto){
$parametros=$_GET;
$parametros["produtoSelecionado"]=$produto;
return "?".http_build_query($parametros);
}
function valorSimNao($valor){
return $valor==="Sim" ? "Sim" : "Não";
}
$produto=null;
$alternativas=[];
if($produtoSelecionado!==""){
$sqlProduto="SELECT * FROM testando WHERE cosNome=?";
$stmt=$conexao->prepare($sqlProduto);
$stmt->bind_param("s",$produtoSelecionado);
$stmt->execute();
$resultadoProduto=$stmt->get_result();
if($resultadoProduto->num_rows>0){
$produto=$resultadoProduto->fetch_assoc();
$sqlMaior="SELECT * FROM testando WHERE tipoCos=? AND valorAmb>? AND cosNome<>? ORDER BY valorAmb DESC";
$stmtMaior=$conexao->prepare($sqlMaior);
$stmtMaior->bind_param(
"sis",
$produto["tipoCos"],
$produto["valorAmb"],
$produto["cosNome"]
);
$stmtMaior->execute();
$resultadoMaior=$stmtMaior->get_result();
while($linha=$resultadoMaior->fetch_assoc()){
$alternativas[]=$linha;
}
}
}
$sql="SELECT cosImagem,cosNome,cosMarca,tipoCos FROM testando";
$condicoes=[];
$parametros=[];
$tipos="";
if($busca!==""){
if($campo==="Nome"){
$condicoes[]="cosNome LIKE ?";
$parametros[]="%".$busca."%";
$tipos.="s";
}elseif($campo==="Marca"){
$condicoes[]="cosMarca LIKE ?";
$parametros[]="%".$busca."%";
$tipos.="s";
}elseif($campo==="Tipo"){
$condicoes[]="tipoCos LIKE ?";
$parametros[]="%".$busca."%";
$tipos.="s";
}else{
$condicoes[]="(cosNome LIKE ? OR cosMarca LIKE ? OR tipoCos LIKE ?)";
$parametros[]="%".$busca."%";
$parametros[]="%".$busca."%";
$parametros[]="%".$busca."%";
$tipos.="sss";
}
}
if($embalagem!==""){
$condicoes[]="embalagemSusten=?";
$parametros[]=$embalagem;
$tipos.="s";
}
if($vegano!==""){
$condicoes[]="cosVegano=?";
$parametros[]=$vegano;
$tipos.="s";
}
if($animal!==""){
$valorAnimal=$animal==="Sim" ? "Nao" : "Sim";
$condicoes[]="cosAnimal=?";
$parametros[]=$valorAnimal;
$tipos.="s";
}
if($recicla!==""){
$condicoes[]="cosRecicla=?";
$parametros[]=$recicla;
$tipos.="s";
}
if($pratica!==""){
$condicoes[]="pratiSusten=?";
$parametros[]=$pratica;
$tipos.="s";
}
if(count($condicoes)>0){
$sql.=" WHERE ".implode(" AND ",$condicoes);
}
$sql.=" ORDER BY cosNome ASC";
$stmtLista=$conexao->prepare($sql);
if(count($parametros)>0){
$stmtLista->bind_param($tipos,...$parametros);
}
$stmtLista->execute();
$resultado=$stmtLista->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Essenza</title>
<style>
*{
box-sizing:border-box;
}
body{
margin:0;
background:#f1f6f1;
color:#30483a;
font-family:Arial,Helvetica,sans-serif;
}
header{
width:100%;
padding:30px 20px 24px;
text-align:center;
}
.logo{
margin:0;
color:#2f5d45;
font-size:40px;
font-weight:600;
letter-spacing:7px;
}
main{
width:86%;
max-width:1400px;
margin:0 auto 50px;
}
.search-box{
background:#fff;
padding:27px 30px;
border-radius:22px;
box-shadow:0 5px 20px rgba(47,93,69,.08);
margin-bottom:38px;
}
.search-row{
display:flex;
align-items:center;
gap:11px;
}
.search-row input,
.search-row select,
.search-row button,
.filter-item select{
height:43px;
border:1px solid #c8d8ce;
border-radius:11px;
background:#fff;
color:#30483a;
font-size:14px;
outline:none;
}
.search-row input{
flex:1;
min-width:0;
padding:0 15px;
}
.search-row select{
padding:0 12px;
}
.search-row button{
border:none;
padding:0 20px;
background:#2f5d45;
color:#fff;
cursor:pointer;
transition:.2s;
}
.search-row button:hover{
background:#244936;
}
.filters-row{
display:flex;
flex-wrap:wrap;
align-items:center;
gap:12px 17px;
margin-top:23px;
}
.filter-item{
display:flex;
align-items:center;
gap:7px;
}
.filter-item label{
font-size:13px;
color:#5d6f63;
}
.filter-item select{
height:37px;
padding:0 10px;
font-size:13px;
}
.filter-buttons{
display:flex;
align-items:center;
justify-content:space-between;
gap:12px;
margin-top:19px;
}
.filter-buttons button{
border:0;
border-radius:10px;
padding:10px 17px;
cursor:pointer;
font-size:13px;
transition:.2s;
}
.btn-filtrar{
background:#5d8a6f;
color:#fff;
}
.btn-filtrar:hover{
background:#466d58;
}
.btn-todos{
background:#e4eee8;
color:#2f5d45;
}
.btn-todos:hover{
background:#d5e4db;
}
h2{
margin:0 0 19px;
color:#2f5d45;
font-size:22px;
}
/* CARDS DOS PRODUTOS */
.produtos-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
gap:20px;
}
.produto-card{
position:relative;
background:#fff;
border-radius:20px;
overflow:hidden;
box-shadow:0 4px 16px rgba(47,93,69,.07);
transition:transform .22s,box-shadow .22s;
}
.produto-card::before{
content:"";
position:absolute;
top:0;
left:25px;
right:25px;
height:3px;
border-radius:0 0 10px 10px;
background:#5d8a6f;
opacity:.7;
z-index:2;
transition:.22s;
}
.produto-card::after{
content:"";
position:absolute;
width:8px;
height:8px;
right:16px;
top:15px;
border-radius:50%;
background:#5d8a6f;
opacity:.45;
transition:.22s;
}
.produto-card:hover{
transform:translateY(-4px);
box-shadow:0 9px 24px rgba(47,93,69,.13);
}
.produto-card:hover::before{
left:18px;
right:18px;
opacity:1;
}
.produto-card:hover::after{
transform:scale(1.5);
opacity:.75;
}
.produto-link{
display:block;
color:inherit;
text-decoration:none;
cursor:pointer;
}
.produto-imagem{
height:205px;
background:#eef4f0;
display:flex;
align-items:center;
justify-content:center;
padding:17px;
}
.produto-imagem img{
width:100%;
height:100%;
object-fit:contain;
transition:transform .25s;
}
.produto-card:hover .produto-imagem img{
transform:scale(1.035);
}
.produto-info{
padding:16px 17px 18px;
}
.produto-info h3{
position:relative;
margin:0 0 12px;
padding-bottom:10px;
color:#30483a;
font-size:17px;
line-height:1.3;
}
.produto-info h3::after{
content:"";
position:absolute;
left:0;
bottom:0;
width:32px;
height:2px;
background:#9fbaa9;
border-radius:5px;
}
/* LINHAS DE INFORMAÇÃO */
.info-linha{
display:flex;
align-items:center;
gap:8px;
margin-top:7px;
color:#667b6d;
font-size:13px;
}
.info-marcador{
position:relative;
width:7px;
height:7px;
flex:none;
border-radius:50%;
background:#5d8a6f;
}
.info-linha.marca .info-marcador{
width:12px;
height:2px;
border-radius:4px;
background:#8aa998;
}
.info-linha.tipo{
margin-top:9px;
}
.info-linha.tipo .info-marcador{
width:8px;
height:8px;
background:#2f5d45;
}
.info-linha strong{
color:#426050;
font-weight:600;
}
/* PRODUTO SELECIONADO */
.selecao{
background:#fff;
border-radius:25px;
padding:27px;
box-shadow:0 5px 20px rgba(47,93,69,.08);
}
.selecao-titulo{
display:flex;
align-items:center;
justify-content:space-between;
gap:15px;
margin-bottom:23px;
}
.selecao-titulo h2{
position:relative;
margin:0;
padding-bottom:8px;
}
.selecao-titulo h2::after{
content:"";
position:absolute;
left:0;
bottom:0;
width:42px;
height:2px;
border-radius:4px;
background:#93b5a2;
}
.valor-badge{
position:relative;
padding:8px 13px 8px 25px;
border-radius:20px;
background:#e3eee7;
color:#476655;
font-size:13px;
white-space:nowrap;
}
.valor-badge::before{
content:"";
position:absolute;
left:11px;
top:50%;
width:6px;
height:6px;
border-radius:50%;
background:#5d8a6f;
transform:translateY(-50%);
}
.feature{
display:grid;
grid-template-columns:210px 1fr;
gap:24px;
align-items:start;
padding-bottom:25px;
border-bottom:1px solid #dbe8e0;
}
.feature-image{
position:relative;
height:210px;
padding:17px;
border-radius:18px;
background:#eef4f0;
display:flex;
align-items:center;
justify-content:center;
}
.feature-image::after{
content:"";
position:absolute;
left:14px;
bottom:13px;
width:28px;
height:3px;
border-radius:5px;
background:#5d8a6f;
opacity:.65;
}
.feature-image img{
width:100%;
height:100%;
object-fit:contain;
}
.feature-info{
min-width:0;
}
.feature-info h3{
position:relative;
margin:2px 0 13px;
padding-bottom:10px;
color:#30483a;
font-size:24px;
line-height:1.25;
}
.feature-info h3::after{
content:"";
position:absolute;
left:0;
bottom:0;
width:45px;
height:2px;
border-radius:5px;
background:#8aa998;
}
.feature-info p{
display:flex;
align-items:center;
gap:8px;
margin:7px 0;
color:#765f51;
font-size:14px;
}
.feature-info p::before{
content:"";
width:6px;
height:6px;
flex:none;
border-radius:50%;
background:#5d8a6f;
}
.feature-info p strong{
color:#426050;
}
.feature-buttons{
display:flex;
flex-wrap:wrap;
gap:9px;
margin-top:18px;
}
.feature-buttons button{
min-height:41px;
border:0;
border-radius:10px;
padding:9px 15px;
cursor:pointer;
font-size:13px;
transition:.2s;
}
.btn-produto{
background:#2f5d45;
color:#fff;
}
.btn-produto:hover{
background:#244936;
transform:translateY(-1px);
}
.btn-detalhes{
background:#e4eee8;
color:#2f5d45;
}
.btn-detalhes:hover{
background:#d5e4db;
}
.btn-escolher{
background:#5d8a6f;
color:#fff;
}
.btn-escolher:hover{
background:#466d58;
transform:translateY(-1px);
}
.detalhes{
display:none;
grid-template-columns:repeat(3,1fr);
gap:9px;
margin-top:18px;
padding:16px;
background:#f1f6f2;
border-radius:14px;
}
.detalhe-item{
position:relative;
padding:10px 10px 10px 22px;
background:#fff;
border-radius:9px;
font-size:13px;
}
.detalhe-item::before{
content:"";
position:absolute;
left:10px;
top:15px;
width:6px;
height:6px;
border-radius:50%;
background:#5d8a6f;
}
.detalhe-item strong{
display:block;
color:#2f5d45;
margin-bottom:3px;
}
/* RECOMENDADOS */
.alternativas-titulo{
display:flex;
align-items:center;
gap:10px;
margin-top:28px;
margin-bottom:17px;
}
.alternativas-titulo::before{
content:"";
width:5px;
height:25px;
border-radius:5px;
background:#5d8a6f;
}
.alternativas{
display:grid;
grid-template-columns:repeat(3,minmax(0,1fr));
gap:20px;
align-items:start;
}
.alternativa-card{
position:relative;
background:#fff;
border:1px solid #dfeae3;
border-radius:18px;
min-width:0;
box-shadow:0 3px 12px rgba(47,93,69,.04);
transition:transform .22s,box-shadow .22s,border-color .22s;
}
.alternativa-card::before{
content:"";
position:absolute;
top:12px;
right:13px;
width:8px;
height:8px;
border:2px solid #789c88;
border-radius:50%;
background:#fff;
z-index:4;
}
.alternativa-card:hover{
transform:translateY(-3px);
box-shadow:0 8px 20px rgba(47,93,69,.10);
border-color:#c9dbd0;
}
.alternativa-imagem{
height:155px;
padding:15px;
background:#eef4f0;
border-radius:18px 18px 0 0;
display:flex;
align-items:center;
justify-content:center;
}
.alternativa-imagem img{
width:100%;
height:100%;
object-fit:contain;
transition:transform .25s;
}
.alternativa-card:hover .alternativa-imagem img{
transform:scale(1.03);
}
.alternativa-info{
padding:14px 14px 15px;
}
.alternativa-info h3{
position:relative;
margin:0 0 11px;
padding-bottom:9px;
color:#30483a;
font-size:16px;
line-height:1.3;
}
.alternativa-info h3::after{
content:"";
position:absolute;
left:0;
bottom:0;
width:26px;
height:2px;
border-radius:5px;
background:#9fbaa9;
}
.alternativa-info p{
display:flex;
align-items:center;
gap:7px;
margin:6px 0;
color:#667b6d;
font-size:13px;
}
.alternativa-info p::before{
content:"";
width:6px;
height:6px;
flex:none;
border-radius:50%;
background:#5d8a6f;
}
.alternativa-info p strong{
color:#426050;
}
.alternativa-botoes{
display:flex;
flex-wrap:wrap;
gap:7px;
margin-top:13px;
}
.alternativa-botoes button{
border:0;
border-radius:9px;
padding:8px 11px;
cursor:pointer;
font-size:12px;
transition:.2s;
}
.alternativa-botoes button:hover{
transform:translateY(-1px);
}
.alternativa-card .detalhes{
position:absolute;
z-index:20;
left:10px;
right:10px;
top:calc(100% - 1px);
margin-top:0;
box-shadow:0 8px 20px rgba(47,93,69,.13);
}
.sem-produto{
background:#fff;
border-radius:20px;
padding:35px;
text-align:center;
color:#667b6d;
}
@media(max-width:950px){
.alternativas{
grid-template-columns:repeat(2,minmax(0,1fr));
}
.detalhes{
grid-template-columns:repeat(2,1fr);
}
}
@media(max-width:850px){
main{
width:92%;
}
.search-row{
flex-wrap:wrap;
}
.search-row input{
width:100%;
flex:none;
}
.feature{
grid-template-columns:180px 1fr;
gap:18px;
}
.feature-image{
height:195px;
}
.feature-info h3{
font-size:22px;
}
}
@media(max-width:600px){
.alternativas{
grid-template-columns:1fr;
}
.alternativa-card .detalhes{
position:static;
margin-top:14px;
box-shadow:none;
}
}
@media(max-width:500px){
header{
padding-top:24px;
}
.logo{
font-size:31px;
letter-spacing:5px;
}
main{
width:94%;
}
.search-box{
padding:20px;
border-radius:18px;
}
.search-row{
display:grid;
grid-template-columns:1fr;
}
.search-row input,
.search-row select,
.search-row button{
width:100%;
}
.filters-row{
display:grid;
grid-template-columns:1fr;
gap:9px;
}
.filter-item{
justify-content:space-between;
}
.filter-item select{
min-width:105px;
}
.filter-buttons{
flex-direction:column;
align-items:stretch;
}
.filter-buttons button{
width:100%;
}
.selecao{
padding:20px;
border-radius:20px;
}
.selecao-titulo{
flex-direction:column;
align-items:flex-start;
gap:9px;
}
.feature{
grid-template-columns:1fr;
gap:17px;
}
.feature-image{
height:195px;
}
.feature-info h3{
font-size:21px;
}
.feature-buttons{
display:grid;
grid-template-columns:1fr;
}
.feature-buttons button{
width:100%;
}
.detalhes{
grid-template-columns:1fr;
}
.alternativas{
grid-template-columns:1fr;
}
}
</style>
</head>
<body>
<header>
<h1 class="logo">ESSENZA</h1>
</header>
<main>
<div class="search-box">
<form method="GET">
<?php if($produtoSelecionado!==""): ?>
<input type="hidden" name="produtoSelecionado" value="<?=htmlspecialchars($produtoSelecionado)?>">
<?php endif; ?>
<div class="search-row">
<input
type="text"
name="busca"
placeholder="Buscar produto..."
value="<?=htmlspecialchars($busca)?>"
>
<select name="campo">
<option value="Todos" <?=$campo==="Todos"?"selected":""?>>Todos</option>
<option value="Nome" <?=$campo==="Nome"?"selected":""?>>Nome</option>
<option value="Marca" <?=$campo==="Marca"?"selected":""?>>Marca</option>
<option value="Tipo" <?=$campo==="Tipo"?"selected":""?>>Tipo</option>
</select>
<button type="submit">Buscar</button>
</div>
<div class="filters-row">
<div class="filter-item">
<label>Reciclável</label>
<select name="recicla">
<option value="">Todos</option>
<option value="Sim" <?=$recicla==="Sim"?"selected":""?>>Sim</option>
<option value="Nao" <?=$recicla==="Nao"?"selected":""?>>Não</option>
</select>
</div>
<div class="filter-item">
<label>Vegano</label>
<select name="vegano">
<option value="">Todos</option>
<option value="Sim" <?=$vegano==="Sim"?"selected":""?>>Sim</option>
<option value="Nao" <?=$vegano==="Nao"?"selected":""?>>Não</option>
</select>
</div>
<div class="filter-item">
<label>Testado em animais</label>
<select name="animal">
<option value="">Todos</option>
<option value="Sim" <?=$animal==="Sim"?"selected":""?>>Sim</option>
<option value="Nao" <?=$animal==="Nao"?"selected":""?>>Não</option>
</select>
</div>
<div class="filter-item">
<label>Embalagem sustentável</label>
<select name="embalagem">
<option value="">Todos</option>
<option value="Sim" <?=$embalagem==="Sim"?"selected":""?>>Sim</option>
<option value="Nao" <?=$embalagem==="Nao"?"selected":""?>>Não</option>
</select>
</div>
<div class="filter-item">
<label>Práticas sustentáveis</label>
<select name="pratica">
<option value="">Todos</option>
<option value="Sim" <?=$pratica==="Sim"?"selected":""?>>Sim</option>
<option value="Nao" <?=$pratica==="Nao"?"selected":""?>>Não</option>
</select>
</div>
</div>
<div class="filter-buttons">
<button type="submit" class="btn-filtrar">
Aplicar filtros
</button>
<button
type="button"
class="btn-todos"
onclick="window.location.href='<?=htmlspecialchars($_SERVER["PHP_SELF"])?>'"
>
Ver todos
</button>
</div>
</form>
</div>
<?php if($produto!==null): ?>
<div class="selecao">
<div class="selecao-titulo">
<h2>Produto selecionado</h2>
<span class="valor-badge">
Valor ambiental: <?=htmlspecialchars($produto["valorAmb"])?>
</span>
</div>
<div class="feature">
<div class="feature-image">
<?php if(!empty($produto["cosImagem"])): ?>
<img
src="<?=htmlspecialchars($produto["cosImagem"])?>"
alt="<?=htmlspecialchars($produto["cosNome"])?>"
>
<?php endif; ?>
</div>
<div class="feature-info">
<h3><?=htmlspecialchars($produto["cosNome"])?></h3>
<p>
<strong>Marca:</strong>
<?=htmlspecialchars($produto["cosMarca"])?>
</p>
<p>
<strong>Tipo:</strong>
<?=htmlspecialchars($produto["tipoCos"])?>
</p>
<div class="feature-buttons">
<?php
if(count($alternativas)>0){
$mensagemProduto="Este produto possui um valor ambiental menor que outro produto do mesmo tipo. Existem produtos com maior valor ambiental. Deseja realmente ir para este produto?";
}else{
$mensagemProduto="Deseja realmente ir para este produto?";
}
$linkProduto=$produto["cosLink"] ?? "";
?>
<button
type="button"
class="btn-produto"
onclick='abrirProduto(<?=json_encode($linkProduto)?>,<?=json_encode($mensagemProduto)?>)'
>
Ir para o produto
</button>
<button
type="button"
class="btn-detalhes"
id="mostrar_produto"
onclick="detalhes('detalhes_produto')"
>
Ver detalhes
</button>
<button
type="button"
class="btn-detalhes"
id="minimizar_produto"
onclick="detalhes('detalhes_produto')"
style="display:none"
>
Minimizar detalhes
</button>
</div>
<div class="detalhes" id="detalhes_produto">
<div class="detalhe-item">
<strong>Nome</strong>
<?=htmlspecialchars($produto["cosNome"])?>
</div>
<div class="detalhe-item">
<strong>Marca</strong>
<?=htmlspecialchars($produto["cosMarca"])?>
</div>
<div class="detalhe-item">
<strong>Tipo</strong>
<?=htmlspecialchars($produto["tipoCos"])?>
</div>
<div class="detalhe-item">
<strong>Embalagem sustentável</strong>
<?=valorSimNao($produto["embalagemSusten"])?>
</div>
<div class="detalhe-item">
<strong>Vegano</strong>
<?=valorSimNao($produto["cosVegano"])?>
</div>
<div class="detalhe-item">
<strong>Testado em animais</strong>
<?=$produto["cosAnimal"]==="Nao"?"Não":"Sim"?>
</div>
<div class="detalhe-item">
<strong>Reciclável</strong>
<?=valorSimNao($produto["cosRecicla"])?>
</div>
<div class="detalhe-item">
<strong>Práticas sustentáveis</strong>
<?=valorSimNao($produto["pratiSusten"])?>
</div>
<div class="detalhe-item">
<strong>Valor ambiental</strong>
<?=htmlspecialchars($produto["valorAmb"])?>
</div>
</div>
</div>
</div>
<?php if(count($alternativas)>0): ?>
<div class="alternativas-titulo">
<h2>Produtos do mesmo tipo com maior valor ambiental</h2>
</div>
<div class="alternativas">
<?php foreach($alternativas as $indice=>$alternativa): ?>
<?php
$idAlternativa="alternativa_".$indice;
$linkAlternativa=$alternativa["cosLink"] ?? "";
$mensagemAlternativa="Deseja realmente ir para este produto?";
?>
<div class="alternativa-card">
<div class="alternativa-imagem">
<?php if(!empty($alternativa["cosImagem"])): ?>
<img
src="<?=htmlspecialchars($alternativa["cosImagem"])?>"
alt="<?=htmlspecialchars($alternativa["cosNome"])?>"
>
<?php endif; ?>
</div>
<div class="alternativa-info">
<h3><?=htmlspecialchars($alternativa["cosNome"])?></h3>
<p>
<strong>Marca:</strong>
<?=htmlspecialchars($alternativa["cosMarca"])?>
</p>
<p>
<strong>Valor ambiental:</strong>
<?=htmlspecialchars($alternativa["valorAmb"])?>
</p>
<div class="alternativa-botoes">
<button
type="button"
class="btn-escolher"
onclick='abrirProduto(<?=json_encode($linkAlternativa)?>,<?=json_encode($mensagemAlternativa)?>)'
>
Escolher produto
</button>
<button
type="button"
class="btn-detalhes"
id="mostrar_<?=$idAlternativa?>"
onclick="detalhes('<?=$idAlternativa?>')"
>
Ver detalhes
</button>
<button
type="button"
class="btn-detalhes"
id="minimizar_<?=$idAlternativa?>"
onclick="detalhes('<?=$idAlternativa?>')"
style="display:none"
>
Minimizar
</button>
</div>
<div class="detalhes" id="<?=$idAlternativa?>">
<div class="detalhe-item">
<strong>Nome</strong>
<?=htmlspecialchars($alternativa["cosNome"])?>
</div>
<div class="detalhe-item">
<strong>Marca</strong>
<?=htmlspecialchars($alternativa["cosMarca"])?>
</div>
<div class="detalhe-item">
<strong>Tipo</strong>
<?=htmlspecialchars($alternativa["tipoCos"])?>
</div>
<div class="detalhe-item">
<strong>Embalagem sustentável</strong>
<?=valorSimNao($alternativa["embalagemSusten"])?>
</div>
<div class="detalhe-item">
<strong>Vegano</strong>
<?=valorSimNao($alternativa["cosVegano"])?>
</div>
<div class="detalhe-item">
<strong>Testado em animais</strong>
<?=$alternativa["cosAnimal"]==="Nao"?"Não":"Sim"?>
</div>
<div class="detalhe-item">
<strong>Reciclável</strong>
<?=valorSimNao($alternativa["cosRecicla"])?>
</div>
<div class="detalhe-item">
<strong>Práticas sustentáveis</strong>
<?=valorSimNao($alternativa["pratiSusten"])?>
</div>
<div class="detalhe-item">
<strong>Valor ambiental</strong>
<?=htmlspecialchars($alternativa["valorAmb"])?>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
<?php else: ?>
<h2>Produtos</h2>
<?php if($resultado->num_rows>0): ?>
<div class="produtos-grid">
<?php while($linha=$resultado->fetch_assoc()): ?>
<div class="produto-card">
<a
class="produto-link"
href="<?=htmlspecialchars(montarUrl($linha["cosNome"]))?>"
>
<div class="produto-imagem">
<?php if(!empty($linha["cosImagem"])): ?>
<img
src="<?=htmlspecialchars($linha["cosImagem"])?>"
alt="<?=htmlspecialchars($linha["cosNome"])?>"
>
<?php endif; ?>
</div>
<div class="produto-info">
<h3><?=htmlspecialchars($linha["cosNome"])?></h3>
<div class="info-linha marca">
<span class="info-marcador"></span>
<span>
<strong>Marca:</strong>
<?=htmlspecialchars($linha["cosMarca"])?>
</span>
</div>
<div class="info-linha tipo">
<span class="info-marcador"></span>
<span>
<strong>Tipo:</strong>
<?=htmlspecialchars($linha["tipoCos"])?>
</span>
</div>
</div>
</a>
</div>
<?php endwhile; ?>
</div>
<?php else: ?>
<div class="sem-produto">
Nenhum produto encontrado.
</div>
<?php endif; ?>
<?php endif; ?>
</main>
<script>
function detalhes(id){
let tabela=document.getElementById(id);
let mostrar=document.getElementById("mostrar_"+id);
let minimizar=document.getElementById("minimizar_"+id);
if(!tabela){
return;
}
if(tabela.style.display==="grid"){
tabela.style.display="none";
if(mostrar){
mostrar.style.display="inline-block";
}
if(minimizar){
minimizar.style.display="none";
}
}else{
tabela.style.display="grid";
if(mostrar){
mostrar.style.display="none";
}
if(minimizar){
minimizar.style.display="inline-block";
}
}
}
function abrirProduto(url,mensagem){
if(!url){
alert("O link deste produto não está disponível.");
return;
}
if(confirm(mensagem)){
window.open(url,"_blank");
}
}
</script>
</body>
</html>