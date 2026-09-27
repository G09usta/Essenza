-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/09/2026 às 03:40
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `essenza`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `segundo`
--
-- Erro ao ler a estrutura para a tabela essenza.segundo: #1932 - Table &#039;essenza.segundo&#039; doesn&#039;t exist in engine
-- Erro ao ler dados para tabela essenza.segundo: #1064 - Você tem um erro de sintaxe no seu SQL próximo a &#039;FROM `essenza`.`segundo`&#039; na linha 1

-- --------------------------------------------------------

--
-- Estrutura para tabela `terceira`
--
-- Erro ao ler a estrutura para a tabela essenza.terceira: #1932 - Table &#039;essenza.terceira&#039; doesn&#039;t exist in engine
-- Erro ao ler dados para tabela essenza.terceira: #1064 - Você tem um erro de sintaxe no seu SQL próximo a &#039;FROM `essenza`.`terceira`&#039; na linha 1

-- --------------------------------------------------------

--
-- Estrutura para tabela `testando`
--

CREATE TABLE `testando` (
  `cosNome` varchar(100) NOT NULL,
  `cosMarca` varchar(100) NOT NULL,
  `tipoCos` varchar(100) NOT NULL,
  `cosImagem` varchar(255) DEFAULT NULL,
  `cosLink` varchar(255) DEFAULT NULL,
  `embalagemSusten` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosVegano` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosAnimal` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosRecicla` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `pratiSusten` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `valorAmb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `testando`
--

INSERT INTO `testando` (`cosNome`, `cosMarca`, `tipoCos`, `cosImagem`, `cosLink`, `embalagemSusten`, `cosVegano`, `cosAnimal`, `cosRecicla`, `pratiSusten`, `valorAmb`) VALUES
('Água Micelar', 'Sallve', 'Água micelar', 'https://www.sallve.com.br/cdn/shop/products/agua-micelar_1_d75cc1f2-ce9e-4ce0-b8b5-38a8f54bae27.png?v=1667239805&width=900', 'https://www.sallve.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Água Micelar Simple + Nilma', 'Simple Organic', 'Água micelar', 'https://lojasfranquias.simpleorganic.com.br/cdn/shop/files/gif.gif?v=1712088698&width=1946', 'https://simpleorganic.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Antitranspirante em Creme Cuide-se Bem Rosa e Algodão 80g', 'O Boticário / Cuide-se Bem', 'Antitranspirante em creme', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B51164/ae0a2c0e-f15b-4697-8ea5-3920d66b7605-bot-51164-cuide-se-bem-rosa-algodao-antitranspirante-frontal-01.jpg', 'https://www.boticario.com.br/antitranspirante-em-creme-cuidese-bem-rosa-e-algodao-80g-v3', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Baby Lips', 'Maybelline', 'Lip balm', 'https://www.maybelline.com/-/media/project/loreal/brand-sites/mny/americas/us/lips-makeup/lip-balm/update-august-2024/baby-lips-dr-rescue-medicated-lip-balm/maybelline-baby-lips-coral-crave-c.jpg?ch=1138&cw=760&cx=0.48&cy=0.41&hash=6914F616BF8DFE5AC18EC0A', 'https://www.maybelline.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Bálsamo Labial Karité', 'L’Occitane', 'Lip balm', 'https://static.sweetcare.pt/img/prd/max/v-638326132349883439/loccitane-019629lo-1.jpg', 'https://br.loccitane.com/pt-br/balsamo-labial-karite', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Base Aliada', 'Dailus', 'Base para unhas', 'https://www.dailus.com.br/cdn/shop/files/7894222027494_2_24df524b-f148-449e-989e-e2499ec7c8a0.webp?v=1776547885&width=533', 'https://www.dailus.com.br/products/base-aliada-base-incolor', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Base Colorama', 'Colorama', 'Base para unhas', 'https://www.coloramaesmaltes.com.br/-/media/Project/Loreal/Brand-Sites/Essie/MASTER/DMI/hero_images/missing-images/Campanha-Base-Setim.jpg?h=500&hash=C782385DE957C7B99B68136FD94C3D97805BD5E2&la=en&w=888', 'https://www.coloramaesmaltes.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 40),
('Base em Pó Mineral Make B. 55g', 'O Boticário / Make B.', 'Pó/base mineral', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B75765/75765_ABERTO.jpg', 'https://www.boticario.com.br/base-em-po-mineral-cor-40-make-b-55g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Base Fit Me!', 'Maybelline', 'Base', 'https://www.maybelline.com.br/-/media/project/loreal/brand-sites/mny/americas/br/produtos/2024/rosto/base/fit-me-fps/110/imagem-fit-me-fps-110-0.jpg?ch=1130&cw=760&cx=0&cy=0&hash=CFE5D58B64E3BD5BA903FF758A4CE491&rev=5a711a12e0434d499c7bb22973280b7e', 'https://www.maybelline.com.br/', 'Nao', 'Nao', 'Nao', 'Nao', 'Sim', 40),
('Base Mate Camuflagem Intense Pop! 20ml', 'O Boticário / Intense', 'Base facial', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B02239/6cc6c001-230f-4e3f-a558-e3034f3ead65-02239-intense-pop-base-cor-100-frontal-01.jpg', 'https://www.boticario.com.br/base-mate-camuflagem-cor-100-intense-pop-20ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Base Risqué Care', 'Risqué', 'Base para unhas', 'https://cdn1.staticpanvel.com.br/produtos/15/400017-15.jpg?ims=424x', 'https://www.risque.com.br/cores/base/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Batom Cremoso Nude 120 3,8g', 'O Boticário / Intense', 'Batom ', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B52155/d650a9f1-6d68-45f8-9efc-0ad1da18f06e-bt-intense-batom-cremoso-nude-120-v4-52155-frontal-1.jpg', 'https://www.boticario.com.br/intense/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Batom Mate Rosa Telha Intense Pop! 3,6g', 'O Boticário / Intense', 'Batom', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B02215/INTENSE-BATOM-MATE-POP-ROSA-TELHA_B02215.jpg', 'https://www.boticario.com.br/batom-mate-rosa-telha-intense-pop-36g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Batom Matte Intransferível Una 8ml', 'Natura', 'Batom', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw999dd2d0/produto-joia/background/desktop/167329.jpg', 'https://www.natura.com.br/p/batom-matte-intransferivel-una/NATBRA-167329', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Body Splash Cuide-se Bem Deleite 200ml', 'O Boticário / Cuide-se Bem', 'Body splash', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B50881/8dcbe259-0a29-4005-997d-379272aa3797-bot-50881-cuide-se-bem-de-leite-body-splash-segredinho-02.jpg', 'https://www.boticario.com.br/body-splash-cuidese-bem-deleite-200ml-v3/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Body Splash Nativa SPA Jasmim Sambac 200ml', 'O Boticário', 'Body splash', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B82052/82046-a.jpg', 'https://www.boticario.com.br/body-splash-desodorante-colonia-nativa-spa-jasmim-sambac-200ml', 'Nao', 'Sim', 'Nao', 'Nao', 'Sim', 60),
('Body Splash Noz Pecã e Cacau Tododia 200ml', 'Natura', 'Body splash', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw94bdcb19/produto-joia/background/desktop/15666.jpg', 'https://www.natura.com.br/p/body-splash-desodorante-colonia-tododia-noz-peca-e-cacau-200-ml/NATBRA-15666', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Bubble Bath', 'OPI', 'Esmalte', 'https://cdn.shopify.com/s/files/1/0649/4879/7673/products/bubble-bath-nls86-nail-lacquer-22001014085_fcdd1b92-e288-4052-843e-c77cd3b88188.jpg?v=1668559271&width=3840', 'https://www.opi.com/products/nail-lacquer-bubble-bath', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Capture Youth Sérum', 'Dior', 'Sérum facial', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dw1a76d207/Y0996008/Y0996008_C099600076_E01_GHC.jpg?sw=800', 'https://www.dior.com/pt_br/beauty/products/capture-youth-Y0996008.html', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Cera Hidrossolúvel Natural Depil Bella 600g', 'Depil Bella', 'Cera depilatória', 'https://tfdijk.vtexassets.com/arquivos/ids/155527-3840-0/PF030596-1.jpg.jpg?v=639207640906130000', 'https://www.depilbella.com.br/cera-quente-depilatoria-hidrossoluvel-natural-depil-bella-1300g-1/p', 'Nao', 'Sim', 'Nao', 'Nao', 'Sim', 60),
('Chic Pele', 'Colorama', 'Esmalte', 'https://uploads.consultaremedios.com.br/product_variation_images/full/d80c1b8c67a5d46bb96b9d4d1e515a26a5d43476.jpg?1697807998=', 'https://www.coloramaesmaltes.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Cobertura Brilhante', 'Risqué', 'Extra brilho', 'https://cdn.ultrafarma.com.br/static/produtos/824522/large-638550310588677681-824522_1.jpg', 'https://www.risque.com.br/cores/base/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Colônia Giovanna Baby Classic 100ml', 'Giovanna Baby', 'Colônia', 'https://giovannababy.vteximg.com.br/arquivos/ids/158621-400-400/1200xMockupSwarovski-Classic.jpg?v=638290159194700000', 'https://www.giovannababy.com.br/colonia-giovanna-baby-classic-100ml/p', 'Nao', 'Nao', 'Nao', 'Nao', 'Nao', 20),
('Condicionador Hair Food Banana', 'Garnier', 'Condicionador', 'https://media.douglas.pt/media/image/f7/b8/f2/3600542340960.jpg', 'https://www.garnier.com.br/', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 80),
('Condicionador Nutrição Tri-Óleos', 'Dove', 'Condicionador', 'https://assets.unileversolutions.com/v1/137218025.png', 'https://www.dove.com/br/p/condicionador-nutricao-tri-oleos-190ml.html/07891150102361', 'Nao', 'Sim', 'Sim', 'Sim', 'Sim', 60),
('Condicionador Purificante Aromacologia', 'L’Occitane', 'Condicionador', 'https://br.loccitane.com/dw/image/v2/BGNF_PRD/on/demandware.static/-/Sites-occ-br-master-catalog/default/dw64944deb/PDP%20Content/Produtos/Aromacologia/11AS250P23.png?sfrm=png', 'https://br.loccitane.com/pt-br/condicionador-purificante-aromacologia-250ml/11AS250P23.html', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Corretivo Instant Age Rewind', 'Maybelline', 'Corretivo', 'https://www.maybelline.com.br/-/media/project/loreal/brand-sites/mny/americas/br/produtos/2024/rosto/corretivo/instagen-age-rewind/light/imagem-corretivo-eraser-light-01.jpg?ch=1130&cw=760&cx=0&cy=0&hash=6789F667789F47E9F5D4AD2BE015E162&rev=9274e92260434a', 'https://www.maybelline.com.br/', 'Nao', 'Sim', 'Nao', 'Nao', 'Sim', 60),
('Corretivo Líquido Cor 30 Intense 8ml', 'O Boticário / Intense', 'Corretivo líquido', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B79909/a54d88f6-4ab1-4394-8142-7a0ae4530608-b79909.jpg', 'https://www.boticario.com.br/b75606-corretivo-liquido-cor-30-intense-8ml/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Corretivo Niina Secrets Perfect Match', 'Eudora', 'Corretivo', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_auto%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/E09496/NIINA_SECRET_PERFECT_MATCH_CORRETIVO_E09496.jpg', 'https://www.eudora.com.br/corretivo-niina-secrets-perfect-match-cor-85-10ml', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Creme Calmante Alfazulen Depil Bella 50g', 'Depil Bella', 'Creme calmante pós-depilação', 'https://cdn.awsli.com.br/600x1000/2119/2119876/produto/1457119254ae1949a8f.jpg', 'https://www.beautybellastore.com.br/produto/creme-calmante-alfazulen-depil-bella-deo-50-g.html', 'Nao', 'Nao', 'Nao', 'Nao', 'Sim', 40),
('Creme de Pentear de Definição para Cabelos Cacheados Lumina 300 ml', 'Natura', 'Creme para pentear', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw5ef4941f/NATBRA-148437_1.jpg?q=80&sw=150', 'https://www.natura.com.br/p/creme-de-pentear-de-definicao-para-cabelos-cacheados-lumina-300-ml/NATBRA-148437', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Creme Esfoliante Corporal Cuide-se Bem Deleite Chocolatudo 150ml', 'O Boticário / Cuide-se Bem', 'Esfoliante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B58229/b4eec6e5-bec6-4d7a-82c5-7d90cd37310d-bot-58229-cuide-se-bem-chocolatudo-creme-esfoliante-frontal-01.jpg', 'https://www.boticario.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Creme Esfoliante Intenso Cuide-se Bem Doçura na Pessegura 200g', 'O Boticário / Cuide-se Bem', 'Esfoliante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B57046/a4d8108f-ab49-4f13-8580-67d29b61ab89-bot-57046-cuide-se-bem-docura-na-pessegura-esfoliante-frontal-01.jpg', 'https://www.boticario.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Creme para Pentear Hidratação', 'Pantene', 'Creme para pentear', 'https://images.ctfassets.net/27loxu94eo0x/bwmjeuu0n1om_yOEOVkMF6zybUf2ekNNw6/1ca2e0a8bc41c4708568a458419b7a4b/Hidratacao-Creme-Pentear.png?fm=webp&w=750', 'https://pantene.com.br/pt-br/produtos/creme-para-pentear/hidratacao', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Curl Manifesto Crème de Jour Fondamentale', 'Kérastase', 'Creme para pentear / leave-in', 'https://www.kerastase.com.br/dw/image/v2/AAFM_PRD/on/demandware.static/-/Sites-kerastase-master-catalog/pt_BR/dwb5452917/2022/KER_00102/3474636968756-creme-de-jour_alt1.webp?q=80&sfrm=jpg&sh=320&sm=cut&sw=320', 'https://www.kerastase.com.br/produtos/colecoes/curl-manifesto/leave-in-creme-de-jour-fondamentale/KRBR00102.html', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Daily Drops FPS 30', 'Simple Organic', 'Protetor solar', 'https://simpleorganic.com.br/cdn/shop/files/daily-drops-fps-30_600x.jpg', 'https://simpleorganic.com.br/pages/daily-drops-serum-com-fps-30', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Desodorante Colônia Insensatez 100ml', 'O Boticário', 'Desodorante colônia', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_297%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_80/v1/imagens/products/B48144/Insensatez-Desodorante-Colonia-100ml-V3_B48144.jpg', 'https://www.boticario.com.br/insensatez-desodorante-colonia-100ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Dior Addict Lip Glow', 'Dior', 'Lip balm', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dw6761ab6e/Y0457000/Y0457000_C045700001_E01_RHC.jpg?sw=800', 'https://www.dior.com/pt_br/beauty/products/dior-addict-lip-glow', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Dior Addict Lip Tint', 'Dior', 'Lip tint', 'https://diorchile.vtexassets.com/arquivos/ids/161118-1200-800/dior-addict-lip-tint-251-02.jpg?v=638823148694830000', 'https://www.dior.com/pt_br/beauty/products/dior-addict-lip-tint', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Dior Lip Sugar Scrub', 'Dior', 'Esfoliante labial', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dw578820f6/Y0028880/Y0028880_F002888002_E01_RHC.jpg?sw=800', 'https://www.dior.com/pt_br/beauty/products/dior-lip-sugar-scrub', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Dior Solar La Crème Protectrice Visage FPS 50', 'Dior', 'Protetor solar', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dwe66b8b9a/Y0997061/Y0997061_C099700260_E01_RHC.jpg?sw=800', 'https://shop.dior.com.br/dior-solar-la-creme-protectrice-visage-spf-50-ifc1306/p', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 80),
('Dior Top Coat', 'Dior', 'Extra brilho', 'https://www.faces.ae/dw/image/v2/BJSM_PRD/on/demandware.static/-/Sites-faces-master-catalog/default/dwf37334a3/009116099220_1.jpg?sh=800&sw=800', 'https://www.dior.com/pt_br/beauty/products/dior-vernis', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Dior Vernis', 'Dior', 'Esmalte', 'https://www.dior.com/on/demandware.static/-/Sites-master_dior/default/dw7b2ee077/Y0381009/Y0381009_C038100849_cs.jpg', 'https://www.dior.com/pt_br/beauty/products/dior-vernis', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Dream Cream', 'Lola Cosmetics', 'Máscara capilar', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_297%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_80/v1/imagens/products/56441/56441.png', 'https://www.lolacosmetics.com.br/dream-cream-200g-ps-19629-12-p45701', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Egeo Choc Desodorante Colônia 90ml', 'O Boticário / Egeo', 'Desodorante colônia', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B82689/Egeo-Des-Col-Choc-C-Car-90Ml-B82689_cartucho.jpg', 'https://www.boticario.com.br/egeo-choc-desodorante-colonia-90ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Egeo Dolce Desodorante Colônia 90ml', 'O Boticário', 'Desodorante colônia', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B82688/Egeo-Des-Col-Dolce-C-Car-90Ml-B82688_.jpg', 'https://www.boticario.com.br/egeo-dolce-desodorante-colonia-90ml-v2', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Elseve Óleo Extraordinário Nutrição 100ml', 'L’Oréal Paris Elseve', 'Óleo capilar', 'https://www.loreal-paris.com.br/-/media/project/loreal/brand-sites/oap/americas/br/products/hair/hair-care/elseve/2026/oleo-extraordinario/oleo/imagem-oleo-extraordinario-oleo-packshot-v2.png', 'https://www.loreal-paris.com.br/elseve/oleo-extraordinario/oleo-extraordinario', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Esfoliante Corporal Natura Tododia Acerola e Hibisco 190g', 'Natura', 'Esfoliante corporal', 'https://production.na01.natura.com/on/demandware.static/-/Sites-natura-cl-storefront-catalog/default/dw6f967383/produtos/NATCHL-117687_1.jpg?q=80&sw=300', 'https://www.natura.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Expert Touch Lacquer Remover', 'OPI', 'Removedor de esmalte', 'https://cdn.shopify.com/s/files/1/0656/5547/2343/files/expert-touch-lacquer-remover-al414-nail-polish-removers-22001138000_0b1ccf09-7149-4332-bebb-3b08346ba52f.jpg?v=1704979228&width=3840', 'https://www.opi.com/products/nail-care-expert-touch-lacquer-remover', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Extra Brilho', 'Colorama', 'Extra brilho', 'https://cdn.ultrafarma.com.br/static/produtos/831546/large-638957207411477483-831546.jpg', 'https://www.coloramaesmaltes.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Fit Me! Pó Compacto', 'Maybelline', 'Pó compacto', 'https://www.maybelline.com.br/-/media/project/loreal/brand-sites/mny/americas/br/produtos/2024/rosto/po/fit-me-po-compacto/translucido/fitme_po_10g_transp.jpg?ch=1130&cw=760&cx=0&cy=0&hash=8964632C68DE5A1DC467B8A7A879984C&rev=0e11fcbbebd840e19c5e43e4bb5dc', 'https://www.maybelline.com.br/', 'Nao', 'Sim', 'Nao', 'Nao', 'Sim', 60),
('Gel de Limpeza Facial', 'CeraVe', 'Sabonete facial', 'https://www.cerave.com.br/-/media/project/loreal/brand-sites/cerave/americas/br/scx/2026/allproducts/gel-de-limpeza/gel-de-limpeza-webp/gel-del-limpeza-454g-one-lg.webp?hash=76D3FEE95E4C356C2D9AEEA19FB2C084&rev=-1%3Fw%3D667', 'https://www.cerave.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Gel de Limpeza Facial Garnier', 'Garnier', 'Sabonete facial', 'https://epocacosmeticos.vteximg.com.br/arquivos/ids/691231-120-120/sabonete-liquido-facial-garnier-skin-uniform-and-matte--2-.jpg.jpg?v=638944005979070000', 'https://www.garnier.com.br/', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 80),
('Gel de Limpeza Suave', 'Simple Organic', 'Sabonete facial', 'https://simpleorganic.com.br/cdn/shop/files/faq_5ed1a3ac-5e60-47a8-bcfb-e55e690eaca7.png?v=1772557996', 'https://simpleorganic.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Gel de Limpeza Suave Simple Organic', 'Simple Organic', 'Sabonete facial', 'https://simpleorganic.com.br/cdn/shop/files/gel-de-limpeza-suave_600x.jpg?v=1785337256', 'https://simpleorganic.com.br/products/gel-de-limpeza-suave', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Gel Esfoliante Corporal Nativa SPA Ginseng e Cafeína 200g', 'O Boticário / Nativa SPA', 'Esfoliante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_auto%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B82992/GEL-ESF-CPO-NSPA-GINS-CAF_B82992_FECHADO_.jpg', 'https://www.boticario.com.br/gel-esfoliante-corporal-nativa-spa-ginseng-e-cafeina-200g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Gel Hidratante Aloe Vera 100ml', 'Depilart', 'Gel hidratante', 'https://www.depilart.com.br/images/2025/12/11/gel-hidratante-aloe-vera-depilacao-depilart.png', 'https://www.depilart.com.br/produtos/linha-tradicional/tr-prepos/gelhidratante-aloevera.html', 'Nao', 'Nao', 'Nao', 'Nao', 'Nao', 20),
('Gelatina #todecacho Super Volume 550g', 'Salon Line', 'Gelatina capilar', 'https://lojaslivia.fbitsstatic.net/img/p/gelatina-capilar-salon-line-todecacho-550-gr-super-volume-70992/256114-5.jpg?h=800&v=202501231556&w=800', 'https://gelatinas.salonline.com.br/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Gloss Labial Glossy Plastic Lips Intense Melissa 5,5ml', 'O Boticário / Intense', 'Gloss labial', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B51460/9c641c29-3418-49f2-ac2f-c20b9bc80559-bot-51460-intense-melissa-gloss-labial-transparente-frontal-01.jpg', 'https://www.boticario.com.br/gloss-labial-glossy-plastic-lips-intense-melissa-55ml/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Gloss Labial Incolor Intense 5ml', 'O Boticário', 'Gloss', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_auto%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B52816/d843d51c-f8e3-4f80-ad72-115c0d0528d8-bot-52816-intense-brilho-labial-vinil-frontal-01.jpg', 'https://www.boticario.com.br/gloss-labial-incolor-intense-5ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Hair Food Banana', 'Garnier', 'Máscara capilar', 'https://cdn.contentspeed.ro/slir/w1200/magazinitalian.websales.ro/cs-content/cs-photos/products/original//balsam-garnier-fructis-hair-food-banana-_7614_1_1648813490303.jpg.webp', 'https://www.garnier.com.br/', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 80),
('Hidratante Corporal Renovador 180g', 'Sallve', 'Hidratante', 'https://www.sallve.com.br/cdn/shop/files/hidratante-renovador-corporal-1.png?v=1788288713&width=900', 'https://www.sallve.com.br/products/hidratante-renovador-corporal', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Hidratante Facial', 'Sallve', 'Hidratante facial', 'https://www.sallve.com.br/cdn/shop/files/hidratante-facial-1.png?v=1787957755&width=900', 'https://www.sallve.com.br/products/hidratante-facial', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Hidratante Facial Hydro Boost Water Gel', 'Neutrogena', 'Hidratante facial', 'https://images.ctfassets.net/3zfcttr0ztpr/1SBponv8J9AfNK9othSgHP/ccdab359693164c2abe339e1fbfa7055/hb_water_gel_menor-pt-br?fm=jpg&q=80&w=1920', 'https://www.neutrogena.com.br/cuidado-facial/hidratantes/water-gel-hydro-boost', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Hidratante Multifuncional', 'Simple Organic', 'Hidratante facial', 'https://simpleorganic.com.br/cdn/shop/files/hidratante-multifuncional_004ba9c6_600x.jpg?v=1739976776', 'https://simpleorganic.com.br/products/hidratante-multifuncional', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Hydra Life Creme Sorbet', 'Dior', 'Hidratante facial', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dw87ca87b0/Y0996436/Y0996436_C099600951_E01_RHC.jpg?sw=800', 'https://www.dior.com/pt_br/beauty/products/dior-hydra-life-cr%C3%A8me-sorbet-fra%C3%AEcheur-Y0996436.html', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Lip Balm com Vitamina C', 'Océane', 'Lip balm', 'https://down-br.img.susercontent.com/file/sg-11134201-820lm-mnyfkjqu4mbkd9', 'https://www.oceane.com.br/hidratante-labial-com-vitamina-c-lip-balm-ap2000845co048f/p', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Lip Oil Dailus', 'Dailus', 'Óleo labial', 'https://www.dailus.com.br/cdn/shop/files/800x915-LIP-OIL-UVA-01.jpg?v=1756216340&width=1445', 'https://www.dailus.com.br/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Lip Oil Océane Edition', 'Océane', 'Óleo labial', 'https://oceane.vtexassets.com/arquivos/ids/210926/AP2001063C0306F_hidratante_labial_rosa_lip_oil_blossom_oceane_edition_1.jpg?v=638658052082470000', 'https://www.oceane.com.br/kit-completo-linha-oceane-edition-k807/p', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Lip Oil Vult', 'Vult', 'Óleo labial', 'https://promofarma.vtexassets.com/arquivos/ids/161682/7899852004167.jpg?v=637951215225330000', 'https://www.vult.com.br/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Lip Scrub', 'Océane', 'Esfoliante labial', 'https://oceane.vtexassets.com/arquivos/ids/194899-150-150?aspect=true&height=150&v=638846629182970000&width=150', 'https://www.oceane.com.br/esfoliante-labial-hidratante---lip-scrub-15g-ap2000725cuni/p', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Lip Tint', 'Vult', 'Lip tint', 'https://down-br.img.susercontent.com/file/br-11134207-7r98o-ltyob1mer4o003', 'https://www.vult.com.br/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Lip Tinted Pink', 'Océane', 'Lip tint', 'https://oceane.vtexassets.com/arquivos/ids/202686-150-150?aspect=true&height=150&v=638183040040570000&width=150', 'https://www.oceane.com.br/brilho-labial-rosa-lip-tinted-pink-oceane-edition-ap2001061c0634t/p', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Loção Corporal Anti-stress Nativa SPA Jasmim Sambac 400ml', 'O Boticário / Nativa SPA', 'Hidratante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B82045/Locao-Hid-Anti-stress-Nativa-SPA-Jasmim-Sambac-400ml-B82045_.jpg', 'https://www.boticario.com.br/locao-hidratante-desodorante-corporal-antistress-nativa-spa-jasmim-sambac-400ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Loção Facial Hidratante', 'CeraVe', 'Hidratante facial', 'https://www.cerave.com.br/-/media/project/loreal/brand-sites/cerave/americas/br/scx/2026/allproducts/locao-facial-hidratante/locao-facial-hidratante-webp/locao-facial-hidratante-52ml-front-lg.webp?hash=18CCE41582A9B5CCC758BF65E00A821A&rev=-1%3Fw%3D667', 'https://www.cerave.com.br/todos-os-produtos/locao-facial-hidratante', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Loção Facial Hidratante FPS 50', 'CeraVe', 'Protetor solar', 'https://www.cerave.com.br/-/media/project/loreal/brand-sites/cerave/americas/br/scx/2026/allproducts/locao-facial-hidratante-fps50/locao-facial-hidratante-fps50-webp/spf-50-1-lg.webp?hash=26F03DEC631F75C10DA8E062DF386CA0&rev=-1%3Fw%3D667', 'https://www.cerave.com.br/todos-os-produtos/locao-facial-hidratante-fps50', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 40),
('Loção Hidratante Desodorante Corporal Nativa SPA Ameixa 400ml', 'O Boticário / Nativa SPA', 'Hidratante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B88077/28c5ab48-16dc-41df-8a1e-f73416306c01-b88077-1.png', 'https://www.boticario.com.br/locao-hidratante-desodorante-corporal-nativa-spa-ameixa-400ml-v7/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Máscara 10 em 1 Nutrição + Fusão de Óleos', 'Dove', 'Máscara capilar', 'https://assets.unileversolutions.com/v1/113823163.png', 'https://www.dove.com/br/cuidado-para-os-cabelos.html', 'Nao', 'Sim', 'Sim', 'Sim', 'Sim', 60),
('Máscara Capilar Aromacologia Reparação Intensiva', 'L’Occitane', 'Máscara capilar', 'https://br.loccitane.com/dw/image/v2/BGNF_PRD/on/demandware.static/-/Sites-occ-br-master-catalog/default/dwadb4ba6b/PDP%20Content/Produtos/Aromacologia/11MC200G24.png?sfrm=png', 'https://br.loccitane.com/pt-br/mascara-capilar-aromacologia-reparacao-intensiva%E2%80%8B-200ml/11MC200G24.html', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Máscara Para Cílios Preta Intense Pop! 10g', 'O Boticário / Intense', 'Máscara de cílios', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/products/B51953/Intense_MASCARA-DE-CILIOS-VOLUME-POP_B51953.jpg', 'https://www.boticario.com.br/mascara-para-cilios-preta-intense-pop-10g/', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Meu Cacho Minha Vida - Creme para Pentear 500g', 'Lola Cosmetics', 'Creme para pentear', 'https://cdn.awsli.com.br/600x450/1874/1874530/produto/231805258f01ec95deb.jpg', 'https://www.lolacosmetics.com.br/meu-cacho-minha-vida-creme-pentear-500g-ps-19629-73-p45409', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Meu Cacho Minha Vida Condicionador', 'Lola Cosmetics', 'Condicionador', 'https://i.promobit.com.br/200/684024835017773332986723175255.jpg', 'https://www.lolacosmetics.com.br/meu-cacho-minha-vida-condicionador-500g-ps-19629-21-p45542', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Nail Envy', 'OPI', 'Base para unhas', 'https://masternailsupply.com.au/cdn/shop/files/triflex.webp?v=1738979216', 'https://www.opi.com/products/nail-strengtheners-nail-envy', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Nail Polish Remover', 'Dior', 'Removedor de esmalte', 'https://www.dior.com/dw/image/v2/BGXS_PRD/on/demandware.static/-/Sites-master_dior/default/dw8a4f74d9/Y0997122/Y0997122_C099700552_E01_RHC.jpg?sw=800', 'https://www.dior.com/en_int/beauty/products/dissolvant-douceur-Y0997122.html', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Oil Reflections - Óleo Capilar 100ml', 'Wella Professionals', 'Óleo capilar', 'https://wella.vtexassets.com/arquivos/ids/170640-800-800?aspect=true&height=800&v=639077925251970000&width=800', 'https://loja.wella.com.br/oil-reflections-oleo-capilar-oroil/p', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Óleo Corporal Castanha do Brasil 120ml', 'Granado', 'Óleo corporal', 'https://loja.granado.com.br/media/catalog/product/e/a/ean7896512911568_5221_2.jpg?fit=bounds&height=501&optimize=high&width=390', 'https://www.granado.com.br/granado/oleo-corporal-castanha-do-brasil-120ml', 'Nao', 'Sim', 'Nao', 'Nao', 'Sim', 80),
('Óleo Corporal Paixão Irresistível Flor de Lis 200ml', 'Paixão', 'Óleo corporal', 'https://cdn.ultrafarma.com.br/static/produtos/78170/large-638107681339917332-78170_4.jpg', 'https://www.ultrafarma.com.br/oleo-para-banho-paixao-irresistivel-com-200ml', 'Nao', 'Nao', 'Nao', 'Nao', 'Nao', 20),
('Óleo Corporal Sève Amêndoas Doces 200ml', 'Natura', 'Óleo corporal', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw4b9c63af/produto-joia/background/desktop/19081.jpg?q=80&sw=600', 'https://www.natura.com.br/p/oleo-desodorante-corporal-seve-amendoas-doces--200-ml/NATBRA-19081', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Óleo Corporal Sève Rosas e Amêndoas 200ml', 'Natura', 'Óleo corporal', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw88034756/NATBRA-28724_1.jpg?q=80&sw=600', 'https://www.natura.com.br/p/oleo-desodorante-corporal-rosas-e-amendoas-seve-200ml/NATBRA-28724', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Óleo Desodorante Corporal Sève Pimenta Rosa 200ml', 'Natura / Sève', 'Óleo corporal', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dwac1b7c0c/produto-joia/background/desktop/20214.jpg', 'https://www.natura.com.br/p/oleo-corporal-natura-seve/NATBRA-20214', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Óleo Glorioso Hidratante Desodorante Corporal Nativa SPA Ameixa 200ml', 'O Boticário', 'Óleo corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B85096/f5a136ea-5562-4138-b862-4c898f8603aa-bot-85096-nativa-spa-ameixa-oleo-glorioso-01.jpg', 'https://www.boticario.com.br/oleo-glorioso-hidratante-desodorante-corporal-nativa-spa-ameixa-200ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Óleo Kérastase Elixir Ultime L’Huile Originale', 'Kérastase', 'Óleo capilar', 'https://www.kerastase.com.br/dw/image/v2/AAFM_PRD/on/demandware.static/-/Sites-kerastase-master-catalog/pt_BR/dw4b34ac6e/2024/KRBR00260/KRBR3474637215170/oleo-kerastase-elixir-ultime-lhuile-originale-30ml.webp?q=80&sfrm=jpg&sh=320&sm=cut&sw=320', 'https://www.kerastase.com.br/produtos/colecoes/elixir-ultime/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Óleo Removedor Pós-Depilatório Depimiel 60ml', 'Depimiel', 'Óleo pós-depilação', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/91789/dd42520a-d905-467b-9a86-2e5a45d47990-91789-depimiel-oleo-removedor-hidratante-60ml.png', 'https://www.belezanaweb.com.br/depimiel-hidratante-oleo-removedor-posdepilatorio-60ml/', 'Nao', 'Nao', 'Nao', 'Nao', 'Nao', 20),
('Perfume Essencial Feminino 100ml', 'Natura', 'Perfume', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dwa15663ff/produto-joia/background/desktop/76421.jpg', 'https://www.natura.com.br/p/essencial-feminino-100-ml/NATBRA-76421', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('PhytoManga Gelatina Ativadora Ultra Nutritiva', 'Widi Care', 'Gelatina capilar', 'https://epocacosmeticos.vteximg.com.br/arquivos/ids/895825-250-250/gelatina-ativadora-ultra-nutritiva-widi-care-phytomanga--1-.jpg?v=638870645718830000', 'https://widicare.com.br/produto/phytomanga-gelatina-ativadora-ultra-nutritiva-2/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Pinga! Patauá e Moringa 50ml', 'Lola Cosmetics', 'Óleo capilar', 'https://static.riachuelo.com.br/RCHLO/13098357001/portrait/72a0093b6d49840fbc3e8b0057a4b053cd6c84d6.jpg?imwidth=600', 'https://www.lolacosmetics.com.br/pinga-novo-pataua-e-moringa-50ml-ps-19629-20-p45402', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Removedor de Esmalte', 'Avon', 'Removedor de esmalte', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-avon-br-storefront-catalog/default/dwfeb0185d/produtosjoia/background/desktop/AVNBRA-135721_bannerJoia_desktop.jpg', 'https://www.avon.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Removedor de Esmaltes', 'Dailus', 'Removedor de esmalte', 'https://www.dailus.com.br/cdn/shop/files/7894222030968_1_1.png?v=1754147237&width=1946', 'https://www.dailus.com.br/products/removedor-de-esmaltes', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Removedor Impala', 'Impala', 'Removedor de esmalte', 'https://cdn1.staticpanvel.com.br/produtos/15/505510-15.jpg?ims=424x', 'https://www.impala.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Removedor Risqué Care', 'Risqué', 'Removedor de esmalte', 'https://paguemenos.vtexassets.com/arquivos/ids/786721-150-auto?aspect=true&height=auto&v=638399015275870000&width=150', 'https://www.risque.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Sabonete em Barra Natura Ekos Andiroba 100g', 'Natura', 'Sabonete em barra', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw48186895/Produtos/NATBRA-217739_1.jpg?q=80&sw=150', 'https://www.natura.com.br/p/sabonete-em-barra-ekos-puro-vegetal-andiroba/NATBRA-217739', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Sabonete em Barra Puro Vegetal Cremoso Ekos Cupuaçu 4x100g', 'Natura', 'Sabonete em barra', 'https://production.na01.natura.com/dw/image/v2/BFKR_PRD/on/demandware.static/-/Sites-natura-br-storefront-catalog/default/dw2598faf8/produto-joia/background/desktop/206217.jpg', 'https://www.natura.com.br/p/sabonete-em-barra-puro-vegetal-cremoso-ekos-cupuacu-4-un-de-100-g/NATBRA-206217', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Sabonete Esfoliante Bumbum de Pêssego 230g', 'O Boticário', 'Esfoliante corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B51237/9e39a6e5-6ccf-4950-b949-ff4e32785eeb-bot-51237-cuide-se-bem-pessegura-esfoliante-bumbum-frontal-01.jpg', 'https://www.boticario.com.br/creme-esfoliante-de-bumbum-cuidese-bem-bumbum-de-pessego-230g-v2/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('Sabonete Líquido Corporal Cuide-se Bem Bob Esponja Patrick Estrela 250ml', 'O Boticário / Cuide-se Bem', 'Sabonete líquido corporal', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B56447/ba5b7499-97e5-4cd9-955e-eb9398d548a6-bot-56447-cuide-se-bem-bob-esponja-sabonete-liquido-frontal-01.jpg', 'https://www.boticario.com.br/sabonete-liquido-corporal-cuidese-bem-bob-esponja-patrick-estrela-250ml', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Sabonetes em Barra Cuide-se Bem Boa Noite 4x80g', 'O Boticário / Cuide-se Bem', 'Sabonete corporal em barra', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_auto%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B50882/2309e53c-8bb6-4902-95a8-2fe3896bd5ed-bot-50882-cuide-se-bem-boa-noite-sabonete-frontal-01.jpg', 'https://www.boticario.com.br/sabonetes-em-barra-cuidese-boa-noite-4x80g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Sabonetes em Barra Cuide-se Bem Deleite 2x90g', 'O Boticário / Cuide-se Bem', 'Sabonete corporal em barra', 'https://res.cloudinary.com/beleza-na-web/image/upload/w_1500%2Cf_avif%2Cfl_progressive%2Cq_auto%3Aeco%2Cw_800/v1/imagens/product/B89663/4795a22a-b1fa-44dd-966c-30b2e74c9ae2-bt-89663-cbem-sab-barra-del-espec-2x90g-1.jpg', 'https://www.boticario.com.br/sabonetes-em-barra-cuide-se-bem-deleite-2x90g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Sensibio Gel Moussant', 'Bioderma', 'Sabonete facial', 'https://www.farmasoler.com/media/catalog/product/b/i/bioderma_sensibio_gel_moussant_200ml_190123-3701129800843.jpg', 'https://www.bioderma.com.br/', 'Nao', 'Nao', 'Nao', 'Sim', 'Sim', 60),
('Shampoo Anticaspa e Anticoceira', 'Head & Shoulders', 'Shampoo', 'https://cdn.ultrafarma.com.br/static/produtos/799262/large-637057984555695913-799262_5.jpg', 'https://www.headandshoulders.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Shampoo em Barra Cachos\r\n', 'Lola Cosmetics', 'Shampoo', 'https://d2l4mdyojly1ma.cloudfront.net/Custom/Content/Products/45/56/45569_shampoo-em-barra-cachos-90g-ps-19629-94_z5_638736715072244227.webp', 'https://www.lolacosmetics.com.br/shampoo-em-barra-cachos-90g-ps-19629-94-p45569', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Shampoo Nutrição Tri-Óleos', 'Dove', 'Shampoo', 'https://assets.unileversolutions.com/v1/137399219.png', 'https://www.dove.com/br/p/shampoo-nutricao-tri-oleos-370ml.html/07891150102613', 'Nao', 'Sim', 'Sim', 'Sim', 'Sim', 60),
('Shampoo Purificante Aromacologia', 'L’Occitane', 'Shampoo', 'https://br.loccitane.com/dw/image/v2/BGNF_PRD/on/demandware.static/-/Sites-occ-br-master-catalog/default/dw68a5d47a/PDP%20Content/Produtos/Aromacologia/11SH300P23.png?sfrm=png', 'https://br.loccitane.com/pt-br/shampoo-purificante-aromacologia-300ml/11SH300P23.html', 'Sim', 'Nao', 'Sim', 'Sim', 'Sim', 60),
('Soft Pinch Tinted Lip Oil', 'Rare Beauty', 'Óleo labial', 'https://media.ulta.com/i/ulta/2647848', 'https://www.rarebeauty.com/', 'Nao', 'Sim', 'Nao', 'Sim', 'Sim', 80),
('SuperStay Teddy Tint', 'Maybelline', 'Lip tint', 'https://www.maybelline.com/-/media/project/loreal/brand-sites/mny/americas/us/products/lip-makeup/lip-color/super-stay-teddy-tint/alt-pics/maybelline-superstay-teddy-tint-55-kneehigh-041554089059-primary_760x1138.jpg?rev=061f893db63943a19d349ab899e25d12', 'https://www.maybelline.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Sweet Pots Sugar Scrub', 'Clinique', 'Esfoliante labial', 'https://www.perfumenz.co.nz/cdn/shop/files/clinique-sweet-pots-sugar-scrub_674x674.png?v=1687757170', 'https://www.clinique.com.br/', 'Nao', 'Nao', 'Sim', 'Sim', 'Nao', 20),
('Top Glass', 'Dailus', 'Extra brilho', 'https://www.dailus.com.br/cdn/shop/files/800x915-TOP-GLASS-02.jpg?v=1776545214&width=416', 'https://www.dailus.com.br/products/esmalte-top-coat-glass', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 100),
('Veet Cera Fria Corporal Peles Delicadas', 'Veet', 'Cera fria', 'https://www.veet.com.br/static/0dd5e48354904a5623818d668e3786a9/7b187/12351.png', 'https://www.veet.com.br/produtos/cera-fria/veet-cera-fria-corporal-peles-delicadas/', 'Nao', 'Nao', 'Nao', 'Nao', 'Nao', 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste`
--
-- Erro ao ler a estrutura para a tabela essenza.teste: #1932 - Table &#039;essenza.teste&#039; doesn&#039;t exist in engine
-- Erro ao ler dados para tabela essenza.teste: #1064 - Você tem um erro de sintaxe no seu SQL próximo a &#039;FROM `essenza`.`teste`&#039; na linha 1

-- --------------------------------------------------------

--
-- Estrutura para tabela `ultima`
--

CREATE TABLE `ultima` (
  `cosNome` varchar(100) NOT NULL,
  `cosMarca` varchar(100) NOT NULL,
  `tipoCos` varchar(100) NOT NULL,
  `cosImagem` varchar(255) DEFAULT NULL,
  `cosLink` varchar(255) DEFAULT NULL,
  `embalagemSusten` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosVegano` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosAnimal` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `cosRecicla` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `pratiSusten` enum('Sim','Nao') NOT NULL DEFAULT 'Nao',
  `valorAmb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ultima`
--

INSERT INTO `ultima` (`cosNome`, `cosMarca`, `tipoCos`, `cosImagem`, `cosLink`, `embalagemSusten`, `cosVegano`, `cosAnimal`, `cosRecicla`, `pratiSusten`, `valorAmb`) VALUES
('Antitranspirante em Creme Cuide-se Bem Rosa e Algodão 80g', 'Cuide-se Bem', 'Antitranspirante', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'https://www.boticario.com.br/antitranspirante-em-creme-cuidese-bem-rosa-e-algodao-80g-v3', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125),
('Base Mate Camuflagem Intense Pop! 20ml', 'Intense', 'Base ', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'https://www.boticario.com.br/base-mate-camuflagem-cor-100-intense-pop-20m', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125),
('Corretivo Líquido Longa Duração Cor 10 4ml', 'Quem Disse, Berenice?', 'Corretivo ', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125),
('Loção Hidratante Desodorante Corporal Nativa SPA Ameixa 400ml', 'Nativa SPA', 'Hidratante ', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125),
('Máscara Para Cílios Preta Intense Pop! 10g', 'Intense', 'Máscara de cílios', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'https://www.boticario.com.br/mascara-para-cilios-preta-intense-pop-10g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125),
('Sabonetes em Barra Cuide-se Bem Boa Noite 4x80g', 'Cuide-se Bem', 'Sabonete', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', 'https://www.boticario.com.br/sabonetes-em-barra-cuidese-boa-noite-4x80g', 'Sim', 'Sim', 'Nao', 'Sim', 'Sim', 125);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `testando`
--
ALTER TABLE `testando`
  ADD PRIMARY KEY (`cosNome`);

--
-- Índices de tabela `ultima`
--
ALTER TABLE `ultima`
  ADD PRIMARY KEY (`cosNome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
