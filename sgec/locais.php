<?php
require 'config/config.php';

$list = [];
$sql = $pdo->query("SELECT * FROM espacos ORDER BY idEspacos ASC");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locais</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
    <style>
        @keyframes fadeln {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeln 0.2s ease-out forwards;
        }
    </style>

</head>

<body>
    <header class="fixed bg-gray-200 container max-w-full px-5 mx-auto h-20 flex items-center justify-between">
        <div class="text-2xl font-bold pr-2">
            LOGO
        </div>
        <div class="bg-gray-100 container max-w-full mx-auto flex items-center px-5 rounded-3xl">

            <ul class="flex items-center ml-auto space-x-8 font-semibold justify-start">

                <li>
                    <a class="no-underline hover:underline underline-offset-2 sm:" href="">Cadastrar Locais</a>
                </li>
                <li>
                    <a class="no-underline hover:underline underline-offset-2" href="">Locais</a>
                </li>

                <li>
                    <a class="no-underline hover:underline underline-offset-2" href="">Painel inicial</a>
                </li>

            </ul>
            <div>
                <img class="p-1.5 h-10 w-10 rounded-full ml-6" src="./Images/perfil.jpg" alt="perfil">
            </div>

        </div>
    </header>




    <section class="relative flex flex-col items-center justify-center space-y-8 h-screen">
        <div class="bg-white p-4 rounded-lg shadow-md h-96 w-10/12 relative overflow-y-auto sm:rounded-lg">
            <?php
            // require 'config/config.php';

            $sql = $pdo->prepare("SELECT * FROM categoria");
            if (!$sql) {
                die('Erro na preparação da consulta: ' . $pdo->errorInfo());
            }
            $sql->execute();
            if (!$sql) {
                die('Erro na execução da consulta: ' . $pdo->errorInfo());
            }
            $categorias = $sql->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <div class="flex justify-between items-center mb-4 ">
                <div class="fixed flex justify-between items-center mb-6 ">
                    <h1 class="text-2xl font-bold text-gray-600">Locais</h1>
                    <div class="flex justify-center items-center">
                        <button id="openModal" class="bg-purple-400 text-white px-4 py-2 rounded font-bold ">Cadastrar Local</button>
                    </div>
                </div>
                <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50 h- ">
                    <div class="flex justify-center items-center h-full ">
                        <div class="bg-white rounded-lg p-8 w-1/2 fade-in modal-content">
                            <div class="mb-4 space-y-3">
                                <h2 class="text-xl font-bold">Cadastre um novo local</h2>
                                <hr>
                            </div>
                            <div class="w-full h-full">
                                <form class="flex flex-col justify-center w-full space-y-3" action="./config/insert.php" method="post">
                                    <div class="flex flex-col justify-center">
                                        <input type="hidden" name="id">
                                        <label for="nome">Nome</label>
                                        <input class="p-2 mt-2 rounded-xl border" type="text" name="nome">
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex flex-col w-6/12">
                                            <label for="endereço">Endereço</label>
                                            <input class="p-2 mt-2 rounded-xl border" type="text" name="endereco">
                                        </div>
                                        <div class="flex flex-col w-6/12 ml-2">
                                            <label for="capacidade">Capacidade</label>
                                            <input class="p-2 mt-2 rounded-xl border" type="number" name="capacidade" min="1">
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex flex-col w-6/12">
                                            <label for="preco">Preço</label>
                                            <input class="p-2 mt-2 rounded-xl border" type="text" name="preco">
                                        </div>
                                        <input type="hidden" name="descricao">

                                        <div class="flex flex-col w-6/12 ml-2">

                                            <label for="categoria">Categoria</label>
                                            <select name="idCategoria" id="idCategoria">
                                                <?php foreach ($categorias as $categoria) {

                                                    echo '<option value="' . $categoria['idCategoria'] . '">' . $categoria['nomeCategoria'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <input type="hidden" name="usuarios_id">

                                    <label for="descrição">Descrição</label>
                                    <input class="p-2 mt-2 rounded-xl border" name="descricao" id="descricao"></input>
                                    <div>
                                        <input type="submit" name="btnInsert" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">
                                    </div>
                                </form>
                            </div>
                            <div class="mt-8">
                                <button id="closeModal" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">Close</button>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const openModalBtn = document.getElementById('openModal');
                        const closeModalBtn = document.getElementById('closeModal');
                        const modal = document.getElementById('modal');

                        openModal.addEventListener('click', () => {
                            modal.classList.remove('hidden');
                        });

                        closeModalBtn.addEventListener('click', () => {
                            modal.classList.add('hidden');

                        });
                    });
                </script>

            </div>

            <?php
            if (isset($_GET['delete'])) {
                $nomeProduto = $_GET['nomeProduto'];
            ?>
                <div class="bg-sky-200 p-4 rounded-lg shadow-md overflow-hidden h-10 justify-center border border-sky-400 flex items-center w-full ">
                    <h1 class="font-bold text-xl text-sky-400">deletado com sucesso</h1>
                </div>
            <?php
            }
            ?>
            <?php
            if (isset($_GET['sucesso'])) {
                $nomeProduto = $_GET['nomeProduto'];

            ?>
                <div class="bg-sky-200 p-4 rounded-lg shadow-md overflow-hidden h-10 justify-center border border-sky-400 flex items-center w-full ">
                    <h1 class="font-bold text-xl text-sky-400">produto cadastrado com sucesso</h1>
                </div>
            <?php }
            ?>

            <div class=" mt-4 w-full relative overflow-x-auto shadow-md sm:rounded-lg">
                <?php
                $sql = $pdo->prepare("SELECT e.*, c.nomeCategoria 
                          FROM espacos as e
                          INNER JOIN categoria as c ON e.idCategoria = c.idCategoria
                          ORDER BY e.idEspacos ASC");
                $sql->execute();
                $espacos = $sql->fetchAll(PDO::FETCH_ASSOC);

                if (count($espacos) > 0) {

                ?>
                    <table class="relative w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Endereço
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descrição
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Capacidade
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Preço
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($espacos as $espaco) {

                            ?>

                                <tr class="odd:bg-white">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?= $espaco['nome']; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?= $espaco['endereco']; ?>
                                    </td>
                                    <th class="px-6 py-3">
                                        <?= $espaco['descricao']; ?>

                                    </th>
                                    <td class="px-6 py-4">
                                        <?= $espaco['capacidade']; ?>

                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $espaco['nomeCategoria']; ?>

                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $espaco['preco']; ?>

                                    </td>
                                    <td class="px-6 py-4">
                                        <div id="modalDelete" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50 h- ">
                                            <div class="flex justify-center items-center h-full ">
                                                <div class="bg-white rounded-lg p-8 w-1/2 fade-in modal-content">
                                                    <div class="mb-4 space-y-3">
                                                        <h2 class="text-xl font-bold">Tem certeza que deseja deletar o local?</h2>
                                                        <hr>
                                                    </div>
                                                    <div class="w-full h-full flex flex-col justify-center items-center">
                                                        <img src="images/icons8-atenção-100.png" alt="">
                                                        <form class="flex flex-col justify-center w-full space-y-3" action="./config/delete.php" method="post">
                                                            <input type="hidden" name="id" value="<?= $espaco['idEspacos'] ?>">
                                                            <input type="hidden" name="nome" value="<?= $espaco['nome'] ?>">
                                                            <input type="submit" name="btnDelete" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">

                                                        </form>
                                                    </div>
                                                    <div class="mt-8">
                                                        <button id="closeDelete" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex justify-center items-center">
                                            <button id="openDelete" class="bg-purple-400 text-white px-4 py-2 rounded font-bold ">Delete</button>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', () => {
                                                const openDeleteBtn = document.getElementById('openDelete');
                                                const closeDeleteBtn = document.getElementById('closeDelete');
                                                const modalDelete = document.getElementById('modalDelete');

                                                openDelete.addEventListener('click', () => {
                                                    modalDelete.classList.remove('hidden');
                                                });

                                                closeDeleteBtn.addEventListener('click', () => {
                                                    modalDelete.classList.add('hidden');

                                                });
                                            });
                                        </script>
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
    </section>
</body>


</html>