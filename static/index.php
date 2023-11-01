<!DOCTYPE html>
<html>
<head>
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>

    <button onclick="criarTarefa()">Criar Tarefa</button>

    <div id="formularioCriarTarefa" style="display: none;">
        <h2>Criar Nova Tarefa</h2>
        <form>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required><br><br>

            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao"><br><br>

            <label for="data_limite">Data Limite:</label>
            <input type="date" id="data_limite" name="data_limite"><br><br>

            <button type="button" onclick="enviarTarefa()">Enviar</button>
        </form>
    </div>

    <button onclick="listarTarefas()">Listar Tarefas</button>

    <div id="listaTarefas"></div>

    <script>
        function criarTarefa() {
            const formularioCriarTarefa = document.getElementById("formularioCriarTarefa");
            formularioCriarTarefa.style.display = formularioCriarTarefa.style.display === "none" ? "block" : "none";
        }

        function enviarTarefa() {
            const titulo = document.getElementById("titulo").value;
            const descricao = document.getElementById("descricao").value;
            const dataLimite = document.getElementById("data_limite").value;

            fetch('http://localhost:8080/api/cadastro.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    titulo: titulo,
                    descricao: descricao,
                    data_limite: dataLimite
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                listarTarefas();
            })
            .catch(error => console.error('Erro:', error));
        }

        function listarTarefas() {
            fetch('http://localhost:8080/api/list.php')
            .then(response => response.json())
            .then(data => {
                const listaTarefas = document.getElementById("listaTarefas");
                listaTarefas.innerHTML = "<h2>Lista de Tarefas</h2>";

                if (data.length === 0) {
                    listaTarefas.innerHTML += "Nenhuma tarefa encontrada.";
                } else {
                    listaTarefas.innerHTML += "<ul>";
                    data.forEach(tarefa => {
                        listaTarefas.innerHTML += `<li>${tarefa.titulo} - ${tarefa.descricao} - ${tarefa.data_limite}</li>`;
                    });
                    listaTarefas.innerHTML += "</ul>";
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>
</body>
</html>
