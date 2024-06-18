<?php
session_start();
require 'config/config.php';

// var_dump($_SESSION['id']);
if (!isset($_SESSION['idUsers'])) {
    header('Location: login/login.php');
    exit();
}

// echo $_SESSION['nome'];
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Relátorio</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            blue: '#002D74',
                            clifford: '#da373d ',
                            darkGreen: '#245501',
                            lightGreen: '#aad576',
                            red: '#bf0603',
                            lightRed: '#ffccd5',
                            green: '#55a630',
                        }
                    }
                }
            }
        </script>
        <style>
            #imgConfig {
                height: 23px;
                width: 23px;
            }
        </style>
    </head>

    <body class="bg-gray-200 text-gray-600">
        <header class=" bg-gray-200 container max-w-full px-5 mx-auto h-20 flex items-center justify-end md: flex justify-end">
            <div class="text-2xl font-bold text-blue pr-2">
                SGEC
            </div>
            <div class="bg-gray-100 container max-w-full mx-auto flex items-center px-5 rounded-3xl">

                <ul class="flex items-center ml-auto space-x-8 font-semibold justify-start text-blue ">
                    <li>
                        <a class="no-underline hover:underline underline-offset-2" href="home.php">Painel inicial</a>
                    </li>

                    <li>
                        <a class="no-underline hover:underline underline-offset-2" href="configuracao.php">Configuração</a>
                    </li>

                </ul>
                <!-- <div id="myLinks" class="text-blue font-semibold hidden z-50">
                    <a href="">Painel inicial</a>
                    <a href="">Configuração</a>
                </div>
                <div class="block md:hidden lg:hidden">
                    <a href="javascript:void(0);" onclick="myFunction()"><img src="images/hamburger.png" alt=""></a>
                </div>
                <script>
                    function myFunction() {
                        var x = document.getElementById("myLinks");
                        if (x.style.display === "block") {
                            x.style.display = "none";
                        } else {
                            x.style.display = "block";
                        }
                    }
                </script> -->

                <div>
                    <img class="p-1.5 h-10 w-10 rounded-full ml-6" src="./Images/git.png" alt="perfil">
                </div>

            </div>
        </header>

        <section class="h-screen flex  flex-col items-center">

            <div class="inline-flex items-center w-full px-5">
                <hr class="w-full h-px my-8 bg-blue border-0">
                <span class="absolute px-3 font-medium text-blue bg-gray-200 border border-gray-500 rounded-3xl left-36 md:block hidden">relatório</span>


                <script type="text/javascript">
                    function redirectConfig() {
                        window.location.href = 'http://localhost/sgec/configuracao.php';
                    }
                </script>
                <div>
                    <button onclick="redirectConfig()" class="md:block hidden w-full hover:scale-105 duration-300"><img id="imgConfig" src="Images/setting-lines.png" alt="imagem settingLines"></button>
                </div>
            </div>


            <div class="bg-white px-4 rounded-lg shadow-md h-4/6 w-10/12 relative overflow-x-auto sm:rounded-lg">

                <div class=" flex justify-between items-center mb-6 mt-4">
                    <h1 class="text-2xl font-bold text-blue">Relatório de quantos locais tem a mesma categoria</h1>
                </div>

                <div class=" mt-4 w-full relative shadow-md sm:rounded-lg flex">
                    <?php
                    
                    $sql = $pdo->prepare("
                SELECT e.nome, c.nomeCategoria as categoria 
                FROM espacos e 
                JOIN categoria c ON e.idCategoria = c.idCategoria 
                WHERE e.idCategoria = (
                    SELECT e.idCategoria 
                    FROM espacos e 
                    GROUP BY e.idCategoria 
                    ORDER BY COUNT(e.idEspacos) DESC 
                    LIMIT 1
                )
            ");
                    $sql->execute();
                    $relatorios = $sql->fetchAll(PDO::FETCH_ASSOC);
                    if (count($relatorios) > 0) {


                    ?>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3">
                                    id da Categoria
                                </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        Nome da categoria
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($relatorios as $relatorio) {

                                ?>

                                    <tr class="odd:bg-white">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <?= $relatorio['nome']; ?>
                                        </th>
                                        <!-- <td class="px-6 py-4">
                                        <?= $relatorio['idCategoria']; ?>
                                    </td> -->
                                        <th class="px-6 py-3">
                                            <?= $relatorio['categoria']; ?>
                                        </th>
                </div>
                </td>
                </tr>
            <?php
                                }
            ?>

            </tbody>
            </table>
        <?php
                    } else {
                        echo "<h1>Você não tem nenhum local cadastrado</h1>";
                    } ?>


            </div>

            </div>

        </section>
        <footer class="footer footer-center p-4 bg-gray-300 text-base-content w-full">
            <aside class="flex items-center justify-center">
                <p class="text-blue">Copyright © 2024 - Todos os direitos reservados pela SGEC</p>
            </aside>
        </footer>
    </body>

    </html>