<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <title>Gerador de Rifa Premium</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.4;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 1rem 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo h1 {
            font-size: 1.5rem;
        }

        .form-card {
            background: white;
            padding: 2rem;
            margin: 2rem auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            padding: 1rem 2rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background: #2980b9;
        }

        /* CONTAINER DE RIFAS MAIOR */
        .rifas-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .bilhete-svg-container {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .bilhete-svg {
            width: 100%;
            height: 120px; /* Aumentei a altura */
            border: 1px solid #ddd;
        }

        .actions {
            text-align: center;
            margin: 2rem 0;
        }

        /* Para telas maiores, mostrar mais colunas */
        @media (min-width: 1200px) {
            .rifas-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1600px) {
            .rifas-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media print {
            header, .form-card, .actions, footer {
                display: none !important;
            }
            
            .bilhete-svg-container {
                box-shadow: none;
                border: 1px solid #000;
                page-break-inside: avoid;
                padding: 10px;
            }
            
            .rifas-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
            
            .bilhete-svg {
                height: 140px; /* Ainda maior na impressão */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1>Gerador de Rifas</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="form-card" id="gerador">
            <h3>Criar Nova Rifa</h3>
            <form method="POST" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="titulo">Título da Rifa</label>
                        <input type="text" id="titulo" name="titulo" class="form-input" required 
                               placeholder="Ex: Rifa Beneficente" 
                               value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="subtitulo">Subtítulo</label>
                        <input type="text" id="subtitulo" name="subtitulo" class="form-input" 
                               placeholder="Ex: Ajude nossa causa" 
                               value="<?php echo isset($_POST['subtitulo']) ? htmlspecialchars($_POST['subtitulo']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="valor">Valor (R$)</label>
                        <input type="text" id="valor" name="valor" class="form-input" required 
                               placeholder="Ex: 5,00" 
                               value="<?php echo isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidade">Quantidade de Bilhetes</label>
                        <input type="number" id="quantidade" name="quantidade" class="form-input" min="1" max="999" required 
                               value="<?php echo isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '50'; ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="premio">Prêmio</label>
                        <input type="text" id="premio" name="premio" class="form-input" required 
                               placeholder="Ex: 1º Prêmio: Smartphone" 
                               value="<?php echo isset($_POST['premio']) ? htmlspecialchars($_POST['premio']) : ''; ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="itens">Itens</label>
                        <input type="text" id="itens" name="itens" class="form-input" 
                               placeholder="Ex: Cesta de produtos" 
                               value="<?php echo isset($_POST['itens']) ? htmlspecialchars($_POST['itens']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="data_sorteio">Data do Sorteio</label>
                        <input type="text" id="data_sorteio" name="data_sorteio" class="form-input" 
                               placeholder="Ex: 15/12/2024" 
                               value="<?php echo isset($_POST['data_sorteio']) ? htmlspecialchars($_POST['data_sorteio']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="local_sorteio">Local do Sorteio</label>
                        <input type="text" id="local_sorteio" name="local_sorteio" class="form-input" 
                               placeholder="Ex: Sede da Associação" 
                               value="<?php echo isset($_POST['local_sorteio']) ? htmlspecialchars($_POST['local_sorteio']) : ''; ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="observacoes">Observações</label>
                        <input type="text" id="observacoes" name="observacoes" class="form-input" 
                               placeholder="Ex: Levar este bilhete no dia do sorteio" 
                               value="<?php echo isset($_POST['observacoes']) ? htmlspecialchars($_POST['observacoes']) : ''; ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn">
                    Gerar Rifas
                </button>
            </form>
        </section>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'] ?? '';
            $premio = $_POST['premio'];
            $itens = $_POST['itens'] ?? '';
            $valor = $_POST['valor'];
            $quantidade = intval($_POST['quantidade']);
            $data_sorteio = $_POST['data_sorteio'] ?? '00/00/00';
            $local_sorteio = $_POST['local_sorteio'] ?? '';
            $observacoes = $_POST['observacoes'] ?? '';
            
            echo '<script>';
            echo 'const rifaData = {';
            echo 'titulo: "' . addslashes($titulo) . '",';
            echo 'subtitulo: "' . addslashes($subtitulo) . '",';
            echo 'premio: "' . addslashes($premio) . '",';
            echo 'itens: "' . addslashes($itens) . '",';
            echo 'valor: "' . addslashes($valor) . '",';
            echo 'quantidade: ' . $quantidade . ',';
            echo 'data_sorteio: "' . addslashes($data_sorteio) . '",';
            echo 'local_sorteio: "' . addslashes($local_sorteio) . '",';
            echo 'observacoes: "' . addslashes($observacoes) . '"';
            echo '};';
            echo '</script>';
            
            echo '<section class="rifas-section">';
            echo '<div class="rifas-container" id="rifas-container">';
            
            for ($i = 1; $i <= $quantidade; $i++) {
                $numeroFormatado = str_pad($i, 3, "0", STR_PAD_LEFT);
                
                echo '<div class="bilhete-svg-container">';
                echo '<svg class="bilhete-svg" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">';
                echo '<style>
                    .linhas,.regioes{stroke-width:.3px;stroke:#000;stroke-miterlimit:4;stroke-dasharray:none}
                    .regioes{stroke-width:.4px;fill-opacity:0}
                    .titulo{font:8px sans-serif}
                    .numero{font:11px sans-serif}
                    .dados,.premio-destaque{font:5px sans-serif}
                    .premio-destaque{font-weight:700}
                </style>';
                
                // Estrutura base do SVG
                echo '<rect width="141" height="49.6" x="58.8" y=".2" class="regioes"></rect>';
                echo '<rect width="58.6" height="49.6" x=".2" y=".2" class="regioes"></rect>';
                echo '<rect width="39.6" height="13" x="160.2" y="24.8" class="regioes"></rect>';
                echo '<path d="M30 27.85h27M19 13.85h38M12 20.85h45M2 34.85h55" class="linhas"></path>';
                
                // Números
                echo '<text class="numero" x="161.52" y="35.25">Nº</text>';
                echo '<text class="numero" x="187.281" y="35.094" text-anchor="middle">' . $numeroFormatado . '</text>';
                echo '<text class="numero" x="11.388" y="44.634" transform="scale(.96506 1.03621)" stroke-width=".965">Nº</text>';
                echo '<text class="numero" x="35.776" y="46.099" text-anchor="middle">' . $numeroFormatado . '</text>';
                
                // Títulos
                echo '<text x="23.692" y="6.818" class="titulo" style="line-height:normal" transform="scale(.98693 1.01325)" font-weight="400" font-size="6" font-family="sans-serif" stroke-width=".956">Rifa</text>';
                
                // Campos de dados (esquerda)
                echo '<text style="line-height:normal" class="dados" y="19.924" x="2.016" font-weight="400" font-size="5" font-family="sans-serif">Tel:</text>';
                echo '<text style="line-height:normal" class="dados" y="26.94" x="1.479" transform="scale(.9989 1.0011)" font-weight="400" font-size="5" font-family="sans-serif" stroke-width=".999">Endereço:</text>';
                echo '<text style="line-height:normal" class="dados" x="1.477" y="12.924" font-weight="400" font-size="5" font-family="sans-serif">Nome:</text>';
                
                // Cabeçalho (direita)
                echo '<text x="125.411" y="15.915" class="titulo" style="line-height:normal" font-weight="400" font-family="sans-serif" font-size="6">Rifa</text>';
                echo '<text style="line-height:normal;text-align:center;font:3px sans-serif" x="128.945" y="3.792" font-stretch="normal" text-anchor="middle">' . htmlspecialchars($titulo) . '</text>';
                
                if (!empty($subtitulo)) {
                    echo '<text style="line-height:normal;text-align:center;font:4px sans-serif" x="129.363" y="8.175" font-stretch="normal" text-anchor="middle">' . htmlspecialchars($subtitulo) . '</text>';
                }
                
                // Prêmio
                echo '<text style="line-height:normal" class="premio-destaque" x="60.141" y="22.929" font-weight="700" font-size="5" font-family="sans-serif">Prêmio:</text>';
                
                $premioLinhas = str_split($premio, 25);
                echo '<text style="line-height:normal" class="premio-destaque" y="22.821" x="83.839" font-style="normal" font-variant="normal" font-weight="700" font-stretch="normal" font-size="5" font-family="sans-serif">' . htmlspecialchars($premioLinhas[0] ?? '') . '</text>';
                
                if (isset($premioLinhas[1])) {
                    echo '<text style="line-height:normal" class="premio-destaque" y="28.821" x="83.839" font-style="normal" font-variant="normal" font-weight="700" font-stretch="normal" font-size="5" font-family="sans-serif">' . htmlspecialchars($premioLinhas[1]) . '</text>';
                }
                
                // Data e Local
                echo '<text style="line-height:normal" class="dados" y="35.929" x="60.109" font-weight="400" font-size="5" font-family="sans-serif">Data:</text>';
                echo '<text style="line-height:normal" class="dados" y="35.821" x="75.724" font-style="normal" font-variant="normal" font-weight="400" font-stretch="normal" font-size="5" font-family="sans-serif">' . htmlspecialchars($data_sorteio) . '</text>';
                
                echo '<text style="line-height:normal" class="dados" y="41.929" x="60.109" font-weight="400" font-size="5" font-family="sans-serif">Local:</text>';
                echo '<text style="line-height:normal" class="dados" y="41.821" x="75.724" font-style="normal" font-variant="normal" font-weight="400" font-stretch="normal" font-size="5" font-family="sans-serif">' . htmlspecialchars($local_sorteio) . '</text>';
                
                // Observações
                echo '<text x="128.396" y="48.057" style="line-height:normal;text-align:center;font:4px sans-serif" font-stretch="normal" text-anchor="middle">' . htmlspecialchars($observacoes) . '</text>';
                
                echo '</svg>';
                echo '</div>';
            }
            
            echo '</div>';
            
            echo '<div class="actions">';
            echo '<button onclick="window.print()" class="btn">';
            echo 'Imprimir Rifas';
            echo '</button>';
            echo '<button onclick="gerarPDF()" class="btn">';
            echo 'Baixar PDF';
            echo '</button>';
            echo '</div>';
            echo '</section>';
        }
        ?>
    </div>
    
    <footer style="text-align: center; padding: 2rem; background: #34495e; color: white; margin-top: 2rem;">
        <p>Gerador de Rifas &copy; 2024</p>
    </footer>

    <script>
        function gerarPDF() {
            if (!window.rifaData) {
                alert('Por favor, gere as rifas primeiro usando o formulário acima.');
                return;
            }
            
            alert('Funcionalidade PDF em desenvolvimento - Use a opção de impressão por enquanto.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (!window.rifaData) {
                const pdfButtons = document.querySelectorAll('[onclick*="gerarPDF"]');
                pdfButtons.forEach(btn => {
                    btn.onclick = function() {
                        alert('Por favor, preencha o formulário e gere as rifas primeiro.');
                    };
                });
            }
        });
    </script>
</body>
</html>