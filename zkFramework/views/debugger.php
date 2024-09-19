<style>
/* Botão escondido na lateral */
.debugger-button {
    position: fixed;
    right: -130px;
    bottom: 20px;
    background-color: #333;
    color: #f2e4dc;
    border: none;
    padding: 12px 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: right 0.4s ease, background-color 0.3s, transform 0.3s, opacity 0.3s;
    z-index: 1000;
    opacity: 0.8;
}

.debugger-button:hover {
    right: 0;
    background-color: #444;
    color: #f2e4dc;
    opacity: 1;
    transform: scale(1.1);
}

/* Painel de debug */
.debugger-panel {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8); /* Fundo escuro com opacidade */
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 20px;
    box-sizing: border-box;
    transform: translateY(-100%); /* Começa fora da tela */
    transition: transform 0.4s ease; /* Transição suave */
}

/* Texto do painel */
.debugger-panel.active {
    transform: translateY(0); /* Move para a tela */
}

/* Botão de fechar */
.close-button {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    font-size: 36px;
    color: white;
    cursor: pointer;
    transition: color 0.3s; /* Transição suave */
}

.close-button:hover {
    color: #ff6f6f; /* Cor vermelha ao passar o mouse */
}

/* Área de texto do debug */
.debugger-textarea {
    width: 100%;
    max-width: 800px;
    height: 80%;
    background-color: #2c2c2c; /* Cinza escuro */
    color: #f0f0f0; /* Cor clara para o texto */
    border: 1px solid #444;
    border-radius: 8px;
    padding: 15px;
    font-family: monospace;
    font-size: 14px;
    resize: none;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3); /* Sombra interna */
}
</style>

<button id="debugger-button" class="debugger-button">🛠️ Open Debugger</button>

<div id="debugger-panel" class="debugger-panel">
    <button id="close-button" class="close-button">&times;</button>
    <h1>Debugger Panel</h1>
    <textarea id="debugger-textarea" class="debugger-textarea"><?php echo $json; ?></textarea>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const debuggerButton = document.getElementById('debugger-button');
    const debuggerPanel = document.getElementById('debugger-panel');
    const closeButton = document.getElementById('close-button');

    debuggerButton.addEventListener('click', () => {
        debuggerPanel.classList.add('active');
    });

    closeButton.addEventListener('click', () => {
        debuggerPanel.classList.remove('active');
    });
});
</script>