<?php if($_SESSION['role'] == "admin") {?>

    <?php 
                         $id = 1;
                         $datas = mysqli_query($koneksi, "SELECT * FROM tb_user");
                         if(mysqli_num_rows($datas) != 0){
                         ?>
<section class="bg-gray-50  p-3 sm:p-5 h-full min-h-screen ">
    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center" method="GET">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" >
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                   <a href="dashboard.php?page=register">
                   <button type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah User
                    </button>
                   </a>
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter
                            <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-x text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 ">ID</th>
                            <th scope="col" class="px-4 py-3 ">Nama</th>
                            <th scope="col" class="px-4 py-3 ">Username</th>
                            <th scope="col" class="px-4 py-3 ">Role </th>
                            <th scope="col" class="px-4 py-3 text-center <?php if($_SESSION['role'] != "admin" ){ echo "hidden";}?>">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                         <?php 
                         while($data = mysqli_fetch_assoc($datas)){ 

                    $idUser = $data['id'];
                    $checkQuery = "SELECT * 
                    FROM tb_user
                    INNER JOIN tb_transaksi ON tb_user.id = tb_transaksi.id_user
                    WHERE tb_user.id = '$idUser'";
                      $hideDelete = mysqli_query($koneksi, $checkQuery);
                      $hasConnections = mysqli_num_rows($hideDelete) > 0;
        ?>
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?=$id++?></th>
                            <td class="px-4 py-3 "><?= $data['nama'] ?></td>
                            <td class="px-4 py-3 "><?= $data['username'] ?></td>
                            <td class="px-4 py-3 "><?= strtoupper($data['role']) ?></td>

                        
                            <td class="px-3 py-3 flex  gap-2 items-center justify-center <?php if($_SESSION['role'] != "admin" ){ echo "hidden";}?>">
                            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <a href="dashboard.php?page=editOutlet&id=<?=$data['id'] ?>">Edit</a>
                         </button>
                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800  
                            <?php if($hasConnections) { echo "disabled aria-disabled='true' onclick='return false;'"; } ?>
                            ">
                <a href="<?php if(!$hasConnections) { echo 'dashboard.php?page=deleteUser&id=' . $data['id']; } ?>" class="<?php if($_SESSION['id_user'] == $data['id']){ echo "disabled aria-disabled='true' cursor-not-allowed w-full h-auto";} if($hasConnections) { echo "disabled aria-disabled='true'  cursor-not-allowed w-full h-auto  "; } ?>">Delete</a>
                         </button>
                        </td>
                        </tr>
                            
                      <?php }  ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
<?php 
 }
    else {
?>
<center class="w-[200px] h-auto">

<h1 class="text-[40px]">Sorry, no data have been found</h1>
<a href="" class="no-underline text-[14px] text-blue-700 px-4 py-2">Add one</a>

</center>

<?php } ?>

 

    <?php } else { ?>
        <center>
   <h1 class="text-[40px] text-red-700">You aren't an Admin</h1>
   </center>
   <?php }?>