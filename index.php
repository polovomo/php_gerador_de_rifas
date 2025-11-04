<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <title>Gerador de Rifa Premium</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-image">
                        <img src="img/image.png" alt="Logo Gerador de Rifa">
                    </div>
                    <div class="logo-text">
                        <h1>RifaPremium</h1>
                        <div class="tagline">Crie rifas profissionais em segundos</div>
                    </div>
                </div>
                <div>
                    <a href="#gerador" class="btn btn-primary">Criar Rifa Agora</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="hero fade-in-up">
            <h2>Rifas Profissionais Feitas para Você</h2>
            <p>Crie rifas numeradas e personalizadas para qualquer ocasião. Perfeito para arrecadações, eventos beneficentes e sorteios.</p>
            
            <div class="features-grid">
                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4>Rápido e Fácil</h4>
                    <p>Crie rifas em menos de 2 minutos com nosso gerador intuitivo</p>
                </div>
                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h4>Design Profissional</h4>
                    <p>Rifas com layout moderno e pronto para impressão</p>
                </div>
                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>100% Seguro</h4>
                    <p>Seus dados protegidos com criptografia de ponta</p>
                </div>
            </div>
        </section>

        <section class="form-card fade-in-up" id="gerador">
            <h3><i class="fas fa-magic"></i> Criar Nova Rifa</h3>
            <form method="POST" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="titulo">Título da Rifa</label>
                        <input type="text" id="titulo" name="titulo" class="form-input" required 
                               placeholder="Ex: Rifa Beneficente da Escola" 
                               value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="valor">Valor (R$)</label>
                        <input type="text" id="valor" name="valor" class="form-input" required 
                               placeholder="Ex: 5,00" 
                               value="<?php echo isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : ''; ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="premio">Prêmio(s)</label>
                        <input type="text" id="premio" name="premio" class="form-input" required 
                               placeholder="Ex: 1º Prêmio: Smartphone, 2º Prêmio: Cesta de Natal" 
                               value="<?php echo isset($_POST['premio']) ? htmlspecialchars($_POST['premio']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidade">Quantidade de Bilhetes</label>
                        <input type="number" id="quantidade" name="quantidade" class="form-input" min="1" max="999" required 
                               value="<?php echo isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '50'; ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">
                    <i class="fas fa-ticket-alt"></i> Gerar Rifas
                </button>
            </form>
        </section>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST['titulo'];
            $premio = $_POST['premio'];
            $valor = $_POST['valor'];
            $quantidade = intval($_POST['quantidade']);
            
            // Salvar dados para JavaScript
            echo '<script>';
            echo 'const rifaData = {';
            echo 'titulo: "' . addslashes($titulo) . '",';
            echo 'premio: "' . addslashes($premio) . '",';
            echo 'valor: "' . addslashes($valor) . '",';
            echo 'quantidade: ' . $quantidade;
            echo '};';
            echo '</script>';
            
            echo '<section class="rifas-section">';
            echo '<div class="rifas-container" id="rifas-container">';
            
            for ($i = 1; $i <= $quantidade; $i++) {
                $numeroFormatado = str_pad($i, 3, "0", STR_PAD_LEFT);
                
                echo '<div class="bilhete fade-in-up" data-numero="' . $numeroFormatado . '">';
                echo '<div class="bilhete-header">';
                echo '<div class="titulo-rifa">' . htmlspecialchars($titulo) . '</div>';
                echo '<div class="numero-bilhete">' . $numeroFormatado . '</div>';
                echo '</div>';
                echo '<div class="bilhete-content">';
                echo '<div class="premio"><strong>Prêmio:</strong> ' . htmlspecialchars($premio) . '</div>';
                echo '<div class="dados-comprador">';
                echo '<div class="campo-linha">Nome: ________________________________</div>';
                echo '<div class="campo-linha">Telefone: ___________________________</div>';
                echo '<div class="campo-linha">Endereço: __________________________</div>';
                echo '</div>';
                echo '<div class="valor"><strong>Valor:</strong> R$ ' . htmlspecialchars($valor) . '</div>';
                echo '</div>';
                echo '<div class="bilhete-footer">';
                echo '<div class="recorte">';
                echo '<div class="recorte-titulo">' . htmlspecialchars($titulo) . '</div>';
                echo '<div class="recorte-numero">' . $numeroFormatado . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>';
            
            echo '<div class="actions">';
            echo '<button onclick="window.print()" class="btn btn-primary">';
            echo '<i class="fas fa-print"></i> Imprimir Rifas';
            echo '</button>';
            echo '<button onclick="gerarPDF()" class="btn btn-success" id="btn-pdf">';
            echo '<i class="fas fa-file-pdf"></i> Baixar PDF';
            echo '</button>';
            echo '</div>';
            echo '</section>';
        }
        ?>
        
        <section class="download-section fade-in-up">
            <div class="download-content">
                <h3>Baixe em PDF Premium</h3>
                <p>Obtenha todas as suas rifas em um arquivo PDF de alta qualidade, perfeito para impressão profissional e distribuição.</p>
                
                <a href="#" class="download-btn" onclick="gerarPDF()" id="download-main-btn">
                    <i class="fas fa-download"></i>
                    Baixar PDF das Rifas
                </a>
            </div>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>RifaPremium &copy; 2025</p>
                <p>Gerador de rifas online profissional</p>
            </div>
        </div>
    </footer>

    <script>
        // Função principal para gerar PDF
        async function gerarPDF() {
            const btn = event?.target?.closest('button, a') || document.getElementById('btn-pdf') || document.getElementById('download-main-btn');
            const originalHTML = btn.innerHTML;
            
            try {
                // Mostrar loading
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gerando PDF...';
                btn.disabled = true;
                
                // Verificar se existem rifas geradas
                if (!window.rifaData) {
                    throw new Error('Por favor, gere as rifas primeiro usando o formulário acima.');
                }
                
                // Criar PDF em orientação paisagem para caber mais bilhetes
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const margin = 10;
                
                // Configurações para os bilhetes compactos
                const bilheteWidth = 85; // mm
                const bilheteHeight = 55; // mm (aumentado para caber os novos campos)
                const bilhetesPorLinha = 2;
                const bilhetesPorColuna = 4;
                const bilhetesPorPagina = bilhetesPorLinha * bilhetesPorColuna;
                
                const espacamentoX = (pageWidth - (bilhetesPorLinha * bilheteWidth) - (2 * margin)) / (bilhetesPorLinha + 1);
                const espacamentoY = (pageHeight - (bilhetesPorColuna * bilheteHeight) - (2 * margin)) / (bilhetesPorColuna + 1);
                
                let currentPage = 1;
                let bilheteIndex = 0;
                
                // Gerar todas as páginas necessárias
                while (bilheteIndex < rifaData.quantidade) {
                    if (bilheteIndex > 0) {
                        pdf.addPage();
                        currentPage++;
                    }
                    
                    let currentY = margin + espacamentoY;
                    
                    // Adicionar cabeçalho da página
                    pdf.setFontSize(14);
                    pdf.setFont('helvetica', 'bold');
                    pdf.setTextColor(37, 99, 235);
                    pdf.text('RIFAS - ' + rifaData.titulo.toUpperCase(), pageWidth / 2, margin + 8, { align: 'center' });
                    
                    // Gerar bilhetes para esta página
                    for (let linha = 0; linha < bilhetesPorColuna; linha++) {
                        let currentX = margin + espacamentoX;
                        
                        for (let coluna = 0; coluna < bilhetesPorLinha; coluna++) {
                            if (bilheteIndex >= rifaData.quantidade) break;
                            
                            const numeroBilhete = bilheteIndex + 1;
                            const numeroFormatado = String(numeroBilhete).padStart(3, '0');
                            
                            // Desenhar bilhete
                            pdf.setDrawColor(37, 99, 235);
                            pdf.setLineWidth(0.3);
                            pdf.rect(currentX, currentY, bilheteWidth, bilheteHeight);
                            
                            // Cabeçalho do bilhete
                            pdf.setFillColor(37, 99, 235);
                            pdf.rect(currentX, currentY, bilheteWidth, 8, 'F');
                            
                            // Número do bilhete (no cabeçalho)
                            pdf.setFontSize(10);
                            pdf.setFont('helvetica', 'bold');
                            pdf.setTextColor(255, 255, 255);
                            pdf.text('BILHETE ' + numeroFormatado, currentX + bilheteWidth / 2, currentY + 5, { align: 'center' });
                            
                            // Título
                            pdf.setFontSize(7);
                            pdf.setTextColor(0, 0, 0);
                            const tituloAbreviado = rifaData.titulo.length > 30 ? 
                                rifaData.titulo.substring(0, 30) + '...' : rifaData.titulo;
                            pdf.text(tituloAbreviado, currentX + 2, currentY + 12);
                            
                            // Prêmio
                            pdf.setFontSize(6);
                            const premioAbreviado = rifaData.premio.length > 45 ? 
                                rifaData.premio.substring(0, 45) + '...' : rifaData.premio;
                            pdf.text('Prêmio: ' + premioAbreviado, currentX + 2, currentY + 16);
                            
                            // Campos para preenchimento
                            pdf.setFontSize(6);
                            pdf.text('Nome: _________________________', currentX + 2, currentY + 21);
                            pdf.text('Telefone: ______________________', currentX + 2, currentY + 25);
                            pdf.text('Endereço: _____________________', currentX + 2, currentY + 29);
                            
                            // Valor
                            pdf.setFontSize(9);
                            pdf.setFont('helvetica', 'bold');
                            pdf.setTextColor(16, 185, 129);
                            pdf.text('R$ ' + rifaData.valor, currentX + bilheteWidth / 2, currentY + 36, { align: 'center' });
                            
                            // Linha de recorte
                            pdf.setDrawColor(150, 150, 150);
                            pdf.setLineWidth(0.1);
                            pdf.line(currentX, currentY + 40, currentX + bilheteWidth, currentY + 40);
                            
                            // Parte do recorte
                            pdf.setFontSize(6);
                            pdf.setTextColor(100, 100, 100);
                            pdf.text('RECORTE AQUI', currentX + bilheteWidth / 2, currentY + 43, { align: 'center' });
                            
                            // Informações do recorte
                            const recorteTitulo = rifaData.titulo.length > 20 ? 
                                rifaData.titulo.substring(0, 20) + '...' : rifaData.titulo;
                            pdf.text(recorteTitulo, currentX + 2, currentY + 48);
                            pdf.text('Nº: ' + numeroFormatado, currentX + bilheteWidth - 3, currentY + 48, { align: 'right' });
                            
                            // Valor no recorte
                            pdf.text('R$ ' + rifaData.valor, currentX + bilheteWidth / 2, currentY + 52, { align: 'center' });
                            
                            currentX += bilheteWidth + espacamentoX;
                            bilheteIndex++;
                        }
                        
                        currentY += bilheteHeight + espacamentoY;
                    }
                    
                    // Rodapé da página
                    pdf.setFontSize(8);
                    pdf.setTextColor(100, 100, 100);
                    const dataGeracao = new Date().toLocaleDateString('pt-BR');
                    pdf.text(`Página ${currentPage} - Gerado por RifaPremium em ${dataGeracao}`, 
                            pageWidth / 2, pageHeight - 5, { align: 'center' });
                }
                
                // Nome do arquivo
                const nomeArquivo = `rifas-${rifaData.titulo.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase()}.pdf`;
                
                // Salvar PDF
                pdf.save(nomeArquivo);
                
                // Restaurar botão
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                
            } catch (error) {
                console.error('Erro ao gerar PDF:', error);
                
                // Restaurar botão
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                
                // Mostrar mensagem de erro
                if (error.message.includes('rifas primeiro')) {
                    alert('Por favor, preencha o formulário e clique em "Gerar Rifas" antes de baixar o PDF.');
                } else {
                    alert('Erro ao gerar PDF: ' + error.message);
                }
            }
        }

        // Fallback para quando não há rifas geradas
        function handlePDFWithoutRifas() {
            alert('Por favor, preencha o formulário acima e gere as rifas antes de baixar o PDF.');
        }

        // Animação de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Verificar se há rifaData (se as rifas foram geradas)
            if (!window.rifaData) {
                const pdfButtons = document.querySelectorAll('[onclick*="gerarPDF"]');
                pdfButtons.forEach(btn => {
                    btn.onclick = handlePDFWithoutRifas;
                });
            }
        });
    </script>
</body>
</html>