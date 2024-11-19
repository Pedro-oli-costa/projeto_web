<?php
        // Configuração inicial para conectar ao banco de dados
        $servidor = "localhost";
        $banco = "bancoDosite_db";
        $usuario = "root";
        $senha_db = "";

        try {
            // Criar a conexão com o banco
            $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha_db);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            die("Erro ao conectar ao banco de dados: " . $erro->getMessage());
        }

        // Variáveis para exibir mensagens no formulário
        $mensagem_login = "";
        $mensagem_fale = "";

        // Quando o formulário de login é enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_submit'])) {
            // Captura os valores enviados pelo formulário
            $nome = htmlspecialchars($_POST['Nome']);
            $sobrenome = htmlspecialchars($_POST['Sobrenome']);
            $email = htmlspecialchars($_POST['email']);
            $data_nascimento = htmlspecialchars($_POST['date']);
            $senha = password_hash(htmlspecialchars($_POST['senha']), PASSWORD_BCRYPT); // Criptografa a senha

            try {
                // Insere os dados na tabela usuarios
                $sql = "INSERT INTO usuarios (nome, sobrenome, email, data_nascimento, senha) 
                        VALUES (:nome, :sobrenome, :email, :data_nascimento, :senha)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([
                    ':nome' => $nome,
                    ':sobrenome' => $sobrenome,
                    ':email' => $email,
                    ':data_nascimento' => $data_nascimento,
                    ':senha' => $senha
                ]);
                $mensagem_login = "Usuário cadastrado com sucesso!";
            } catch (PDOException $erro) {
                $mensagem_login = "Erro ao salvar os dados: " . $erro->getMessage();
            }
        }

        // Quando o formulário "Fale Conosco" é enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fale_submit'])) {
            $mensagem = htmlspecialchars($_POST['Fale']);

            try {
                // Insere a mensagem na tabela mensagens
                $sql = "INSERT INTO mensagens (mensagem) VALUES (:mensagem)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([':mensagem' => $mensagem]);
                $mensagem_fale = "Mensagem enviada com sucesso!";
            } catch (PDOException $erro) {
                $mensagem_fale = "Erro ao enviar mensagem: " . $erro->getMessage();
            }
        }
    ?>




<?php if ($mensagem_login): ?>
        <div class="response">
            <p><strong><?php echo $mensagem_login; ?></strong></p>
        </div>
    <?php endif; ?>

 <?php
