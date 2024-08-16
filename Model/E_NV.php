<?php
class E_NV {
    private $IDNV;
    private $Hoten;
    private $IDPB;
    private $Diachi;

public function __construct($IDNV, $Hoten, $IDPB, $Diachi) {
    $this->IDNV = $IDNV;
    $this->Hoten = $Hoten;
    $this->IDPB = $IDPB;
    $this->Diachi = $Diachi;
}

public function getIDNV() {
    return $this->IDNV;
}

public function getHoten() {
    return $this->Hoten;
}

public function getIDPB() {
    return $this->IDPB;
}

public function getDiachi() {
    return $this->Diachi;
}
}
?>