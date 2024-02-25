<?php
ob_start();
session_start();
include "koneksi.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @media print {
             .no-print {
                 display: none !important;
                 }
                 button {
                    display :none;
                 }
                 .headGrid{
                    grid-template-columns: auto !important;
                    gap: 10px;
                 }
                 .childGridOne{
                    margin: 0 !important;
                    padding: 0 !important;
                 }
                 .childGridTwo{
                    margin: 0 !important;
                    padding: 0 !important;
                 }
                }
        </style>
    </head>
    <body>
     <?php include("components/navbar.php");
     @$page = $_GET["page"];
     switch ($page) {
        case 'landing':
            include "components/landingPage.php";
            break;
        
        case 'outlet':
            include "view/viewOutlet.php";
            break;
        case 'tambahOutlet':
            include "tambah/tambahOutlet.php";
            break;
        case 'editOutlet':
            include "edit/editOutlet.php";
            break;
        case 'deleteOutlet':
            include "delete/deleteOutlet.php";
            break;

        case 'member':
            include "view/viewMember.php";
            break;
        case 'tambahMember':
            include "tambah/tambahMember.php";
            break;
        case 'editMember':
            include "edit/editMember.php";
            break;
        case 'deleteMember':
            include "delete/deleteMember.php";
            break;

        case 'user':
            include "view/viewUser.php";
            break;
        case 'register':
            include "register.php";
            break;
        case 'editUser':
            include "edit/editUser.php";
            break;
        case 'deleteUser':
            include "delete/deleteUser.php";
            break;
            
        case 'paket':
            include "view/viewPaket.php";
            break;
        case 'tambahPaket':
            include "tambah/tambahPaket.php";
            break;
        case 'editPaket':
            include "edit/editPaket.php";
            break;
        case 'deletePaket':
            include "delete/deletePaket.php";
            break;

        case 'transaksi':
            include "view/viewTransaksi.php";
            break;
        case 'tambahTransaksi':
            include "tambah/tambahTransaksi.php";
            break;
        case 'editTransaksi':
            include "edit/editTransaksi.php";
            break;
        case 'detailTransaksi':
            include "tambah/detailTransaksi.php";
            break;
       
        case 'laporan':
            include "view/laporan.php";
            break;
       
        case 'prosesStatusTransaksi':
            include "tambah/prosesStatusTransaksi.php";
            break;
        

        case 'logout':
            include "logout.php";
            break;
    

        
        default:
        include "components/landingPage.php";
        break;
     }
     ?>
     
     <script>
 function showDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("hidden");
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Profile Dropdown
        var profileBtn = document.getElementById('btnProfile');
        var profileDropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', function() {
            showDropdown('profileDropdown');
        });

        // Navbar Dropdown
        var navbarBtn = document.getElementById('dropdownNavbarLink');
        var navbarDropdown = document.getElementById('dropdownNavbar');

        navbarBtn.addEventListener('click', function() {
            showDropdown('dropdownNavbar');
        });
    });


    let icon1 = document.getElementById("icon1");
let menu1 = document.getElementById("menu1");
const showMenu1 = (flag) => {
  if (flag) {
    icon1.classList.toggle("rotate-180");
    menu1.classList.toggle("hidden");
  }
};
let icon2 = document.getElementById("icon2");

const showMenu2 = (flag) => {
  if (flag) {
    icon2.classList.toggle("rotate-180");
  }
};
let icon3 = document.getElementById("icon3");

const showMenu3 = (flag) => {
  if (flag) {
    icon3.classList.toggle("rotate-180");
  }
};

let Main = document.getElementById("Main");
let open = document.getElementById("open");
let close = document.getElementById("close");

const showNav = (flag) => {
  if (flag) {
    Main.classList.toggle("-translate-x-full");
    Main.classList.toggle("translate-x-0");
    open.classList.toggle("hidden");
    close.classList.toggle("hidden");
  }
};

// function printReport() {
//     var reportContent = document.getElementById("report-content").outerHTML;
//     var printWindow = window.open("", "", "height=600,width=800");
//     printWindow.document.write("<html><head><title>Report</title><style>" +
//         document.getElementById('report-style').innerHTML +
//         "</style></head><body>");
//     printWindow.document.write(reportContent);
//     printWindow.document.write("</body></html>");
//     printWindow.document.close();
//     printWindow.focus();
//     printWindow.print();
//     printWindow.close();
// }

// document.addEventListener('DOMContentLoaded', function () {
//     const modalButtons = document.querySelectorAll('[data-modal-toggle]');
//     const modalHideButtons = document.querySelectorAll('[data-modal-hide]');
    
//     modalButtons.forEach(function (modalButton) {
//         modalButton.addEventListener('click', function () {
//             const modalId = modalButton.getAttribute('data-modal-target');
//             const modal = document.getElementById(modalId);
//             if (modal) {
//                 modal.classList.toggle('hidden');
//             }
//         });
//     });

//     modalHideButtons.forEach(function (button) {
//         button.addEventListener('click', function () {
//             const modalId = button.getAttribute('data-modal-target');
//             const modal = document.getElementById(modalId);
//             if (modal) {
//                 modal.classList.add('hidden');
//             }
//         });
//     });
// });

</script>
    </body>
</html>
<?php
ob_end_flush(); // Flush the output buffer and send the content to the browser
?>