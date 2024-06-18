<?php
session_start();
require './config/config.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="flex justify-center items-center h-screen">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 space-y-8">

            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">Listagem de adminitradores</h1>
            <div class=" mt-4 w-auto relative shadow-md sm:rounded-lg flex">
    <?php

    $sql = $pdo->prepare("select * from users");
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_ASSOC);
    if ($sql->rowCount()> 0) {


    ?>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Senha
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) {

                ?>
                    <tr class="odd:bg-white">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= $user['idUsers']; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $user['nome']; ?>
                        </td>
                        <th class="px-6 py-3">
                            <?= $user['email']; ?>
                        </th>
                        <th class="px-6 py-3">
                            <?= $user['senha']; ?>
                        </th>
</div>

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


            <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50">
                <div class="flex justify-center items-center h-full w-full">
                    <div class="bg-white rounded-lg p-8 w1/2 fade-in modal-content">
                        <div class="mb-4">
                            <h2 class="text-xl font-bold">Modal Title</h2>
                        </div>
                        <div>
                            <p>Você gostaria de excluir o(a) administrador(a) <?php echo $_SESSION['nome']?> ? Com total responsabilidade que o(a) mesmo(a) não estará mais no sistema!</p>
                        </div>
                        <div class="mt-8">
                            <button id="closeModal" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">Cancelar</button>
                            <!-- <button id="closeModal" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">Excluir</button> -->
                             <form action="./Verify/excluir.php" method="POST">
                                <input type="hidden" name="id" value='". $_SESSION['idUsers'] ."'>
                                <input id="closeModal" type="submit" value="Deletar" name="btnDelete" class="bg-purple-400 text-white px-4 py-2 rounded font-bold">
                             </form>

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

        </table>
    </div>
</body>

</html>