<?php


session_start();
require 'Verify/config.php';

if (isset($_POST['submit'])) {
  $erros = [];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  if (empty($email) || empty($senha)) {
    $erros[] = '<li class="li">Os campos precisam ser preenchidos</li>';
  } else {
    $sql = "SELECT email FROM usuarios WHERE email = :email";
    $result = $pdo->prepare($sql);
    $result->bindParam(':email', $email);
    $result->execute();

    if ($result->rowCount() > 0) {
      $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
      $result = $pdo->prepare($sql);
      $result->bindParam(':email', $email);
      $result->bindParam(':senha', $senha);
      $result->execute();

      if ($result->rowCount() == 1) {
        $dados = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['logado'] = true;
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        
        header('Location: index.php');
        exit;
      } else {
        $erros[] = '<li class="li">Usuário e senha não conferem</li>';
      }
    } else {
      $erros[] = '<li class="li">Usuário inexistente</li>';
    }
  }
}


?>






</html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Login</title>
  
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .li{
      list-style-type: none;

    }
  </style>

</head>

<body>

  

  <section class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">


      <div class="md:w-1/2 px-8 md:px-16">
        <h2 class="font-bold text-2xl text-[#002D74]">Login</h2>
        <p class="text-xs mt-4 text-[#002D74]">Se você já é membro, conecte-se facilmente</p>
        <?php
        if (!empty($erros)) {
          foreach ($erros as $erro) {
            echo '<h4 style="color: red;">' . $erro . '</h4>';
          }
        } ?>

        <form action="login.php" method="POST" class="flex flex-col gap-4">
          <input class="p-2 mt-8 rounded-xl border" type="email" name="email" placeholder="Email*">
          <div class="relative">
            <input class="p-2 rounded-xl border w-full" type="password" name="senha" placeholder="Senha*">
            
          </div>
          <input type="submit" name="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">
        </form>

       

        <div class="mt-5 text-xs border-b border-[#002D74] py-4 text-[#002D74]">
          
        </div>

        <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
          <p>Não tem uma conta?</p>
          <button class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300"><a href="cadastro.php">Cadastre-se</a></button>
        </div>
      </div>


      <div class="md:block hidden w-1/2">
        <img class="rounded-2xl" src="Images/helena-lopes-Pd8tLVGx2O4-unsplash.jpg">
      </div>
    </div>
  </section>



</body>

</html>