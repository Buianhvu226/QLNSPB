<?php
include_once("../Model/M_PB.php");

class C_PB {
    public function invoke() {
        $modelPB = new M_PB();
        $pbList = $modelPB->getAllPB();

        // Pass the data to the view
        include_once("../View/PhongBanDetail.html");
    }

    

}

if (isset($_GET['mod2']) && $_GET['mod2']==1){
    include_once("../View/AddPhongBan.html");
    if (isset($_POST['ok'])){
        $modelPB = new M_PB();
        $modelPB->AddPB($_POST['IDPB'], $_POST['Tenpb'], $_POST['Mota']);
        header("location: http://localhost/MVC-QLNSPB/Controller/C_PB.php?mod2=1");
    }
}

else if (isset($_GET['mod4']) && $_GET['mod4']==1){
    if (isset($_GET['IDPB'])){
    $modelpb = new M_PB();
    $pb = $modelpb->fillCompleteData($_GET['IDPB']);
    include_once("../View/UpdatePB.html");
    } else {
        $modelpb = new M_PB();
        $pbList = $modelpb->getAllpb();
        include_once("../View/PBListForUpt.html");
    }

    if (isset($_POST['ok'])){
        $modelpb = new M_PB();
        $modelpb->UpdatePB($_POST['IDPB'] ,$_POST['Tenpb'], $_POST['Mota']);
        header("location: http://localhost/MVC-QLNSPB/Controller/C_PB.php?mod4=1");
    }
}
else{
    $controller = new C_PB();
    $controller->invoke();
}

?>
