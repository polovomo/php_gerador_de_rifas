# Gerador de Rifas Premium

Um gerador de rifas profissional e fácil de usar, permitindo criar rifas personalizadas para eventos beneficentes, sorteios e arrecadações.

## 🚀 Funcionalidades

- ✅ **Geração rápida** - Crie rifas em segundos
- ✅ **Design profissional** - Layout limpo e organizado
- ✅ **Personalização completa** - Título, prêmio, valores e datas
- ✅ **Numeração automática** - Sequência numérica de 001 a 999
- ✅ **Impressão otimizada** - Layout perfeito para impressão
- ✅ **Responsivo** - Funciona em desktop e mobile
- ✅ **Template SVG** - Design vetorial de alta qualidade

## 🛠️ Tecnologias Utilizadas

- **HTML5** - Estrutura semântica
- **CSS3** - Estilos modernos e responsivos
- **PHP** - Processamento do backend
- **SVG** - Gráficos vetoriais escaláveis
- **JavaScript** - Interatividade e funcionalidades

## 📦 Instalação

1. **Clone o repositório:**
```bash
git clone https://github.com/seu-usuario/gerador-rifas.git

Configure o servidor web:

Coloque os arquivos em um servidor com suporte a PHP (Apache, Nginx, etc.)

Certifique-se de que a extensão PHP está habilitada

Acesse no navegador:

text
http://localhost/gerador-rifas
🎯 Como Usar
1. Preencha o Formulário
Título da Rifa: Nome principal da rifa

Subtítulo: Descrição adicional (opcional)

Valor: Preço de cada bilhete (ex: R$ 5,00)

Quantidade: Número de bilhetes a gerar (1-999)

Prêmio: Descrição do prêmio principal

Itens: Itens adicionais (opcional)

Data do Sorteio: Data do evento

Local do Sorteio: Onde ocorrerá o sorteio

Observações: Informações adicionais

2. Gere as Rifas
Clique em "Gerar Rifas"

Visualize a prévia na tela

3. Imprima
Use o botão "Imprimir Rifas"

As rifas são otimizadas para folha A4

Layout: 6 rifas por página (configurável)

🎨 Personalização
Modificando o Template SVG
O template das rifas está no arquivo HTML. Para personalizar:

html
<svg class="bilhete-svg" viewBox="0 0 200 50">
    <!-- Estrutura do bilhete -->
</svg>
Ajustando o Layout de Impressão
No CSS, modifique a seção @media print:

css
@media print {
    .rifas-container {
        grid-template-columns: repeat(2, 1fr); /* Colunas */
        grid-template-rows: repeat(3, 1fr);    /* Linhas */
    }
    .bilhete-svg {
        height: 7.5cm; /* Altura das rifas */
    }
}
📄 Estrutura do Projeto
text
gerador-rifas/
├── index.html                 # Página principal
├── assets/
│   └── style.css             # Estilos principais
├── img/                      # Imagens (se houver)
└── README.md                 # Este arquivo
⚙️ Configurações
Quantidade de Rifas por Página
Padrão: 6 rifas por folha A4

Para alterar:

4 rifas por página: Aumente a altura das rifas

2 rifas por página: Use 1 coluna e 2 linhas

12 rifas por página: Use 3 colunas e 4 linhas

Cores e Estilos
Modifique as variáveis CSS no início do arquivo style.css:

css
:root {
    --primary: #3498db;
    --secondary: #2c3e50;
    --accent: #e74c3c;
}
🐛 Solução de Problemas
Rifas não aparecem
Verifique se o servidor suporta PHP

Confirme que o método POST está funcionando

Cheque o console do navegador por erros

Problemas na Impressão
Use o modo de visualização de impressão do navegador

Verifique as margens da impressora

Ajuste o zoom para 100%

Layout quebrado
Certifique-se de que o CSS está carregando

Verifique a compatibilidade do navegador

🤝 Contribuindo
Faça um Fork do projeto

Crie uma Branch para sua Feature (git checkout -b feature/AmazingFeature)

Commit suas mudanças (git commit -m 'Add some AmazingFeature')

Push para a Branch (git push origin feature/AmazingFeature)

Abra um Pull Request
