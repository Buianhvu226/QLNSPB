<?php
include_once("../Model/M_NV.php");

class C_NV {
    public function ListNhanvien(){
        $modelNV = new M_NV();
        $NVList = $modelNV->getAllNV();
        return $NVList;
    }

    public function invoke() {
        $modelNV = new M_NV();
            $NVList = $modelNV->getAllNV();
            include_once("../View/ViewNhanVien.html");
    }

    public function getAllIDPB(){
        $modelNV = new M_NV();
        $officeID = $modelNV->getAllIDPB();
        include_once("../View/AddNhanVien.html");
    }
}

if (isset($_GET['IDPB'])){
    $modelNV = new M_NV();
    $NVList = $modelNV->getEmployeesByDepartment($_GET['IDPB']);
    include_once("../View/ViewNhanVien.html");
}

else if (isset($_GET['mod5']) && $_GET['mod5']==1){
    if (isset($_GET['IDNV'])){
        $modelNV = new M_NV();
        $modelNV->DeleteNV($_GET['IDNV']);
        header("location: http://localhost/MVC-QLNSPB/Controller/C_NV.php?mod5=1");
    } else {
        $modelNV = new M_NV();
        $NVList = $modelNV->getAllNV();
        include_once("../View/NVListForDel.html");
    }
}

else if(isset($_GET['mod6']) && $_GET['mod6']==1){
    if (isset($_POST['ok'])) {
        $modelNV = new M_NV();
        $search_key = $_POST['search_Key'];
        $search_value = $_POST['search_Value'];
    
        $NV_Search = $modelNV->searchDataFromDatabase($search_key, $search_value);
    
        if ($NV_Search) {
            include_once("../View/NVListForSearch.html");
        } else {
            echo "Error searching for NV data.";
        }
    } else {
        include_once("../View/NVSearchForm.html");
    }
}

else if (isset($_GET['mod7']) && $_GET['mod7']==1){
    if (isset($_POST['ok'])){
        $modelNV = new M_NV();
        $modelNV->AddNV($_POST['IDNV'], $_POST['Hoten'], $_POST['IDPB'], $_POST['Diachi']);
        header("location: http://localhost/MVC-QLNSPB/Controller/C_NV.php?mod7=1");
    } else {
        $controller = new C_NV();
        $controller->getAllIDPB();
    }
}
else{
        $controller = new C_NV();
        $controller->invoke();
}
        

?>
