<?php
include_once("E_NV.php");

class M_NV {
    private $link;

    public function __construct() {
        $this->link = mysqli_connect("localhost", "root", "") or die("Không thể kết nối đến CSDL MySQL");
        mysqli_select_db($this->link, "qlnspb");
    }

    public function getAllNV() {
        $sql = "SELECT * FROM nhanvien";
        $rs = mysqli_query($this->link, $sql);

        $nvs = array();

        while ($row = mysqli_fetch_array($rs)) {
            $idnv = $row['IDNV'];
            $Hoten = $row['Hoten'];
            $idpb = $row['IDPB'];
            $diachi = $row['Diachi'];

            $nvs[] = new E_NV($idnv, $Hoten, $idpb, $diachi);
        }

        return $nvs;
    }

    public function getAllIDPB() {
        $sql = "SELECT IDPB FROM phongban";
        $rs = mysqli_query($this->link, $sql);

        $officeID = [];
        $i = 0;
        while ($row = mysqli_fetch_array($rs)) {
             $officeID[$i++] = $row['IDPB'];
        }

        return $officeID;
    }

    // Hàm lấy danh sách nhân viên theo IDPB
    public function getEmployeesByDepartment($IDPB) {
        $sql = "SELECT * FROM nhanvien WHERE IDPB = '$IDPB'";
        $rs = mysqli_query($this->link, $sql);

        $nvs = array();

        while ($row = mysqli_fetch_array($rs)) {
            $idnv = $row['IDNV'];
            $Hoten = $row['Hoten'];
            $idpb = $row['IDPB'];
            $diachi = $row['Diachi'];

            $nvs[] = new E_NV($idnv, $Hoten, $idpb, $diachi);
        }

        return $nvs;
    }

    public function DeleteNV($IDNV){
        $link = mysqli_connect("localhost", "root", "", "qlnspb") or die("Không thể kết nối đến CSDL MySQL");
        
        $sql = "DELETE FROM nhanvien  WHERE IDNV = '$IDNV'";
        
        $rs = mysqli_query($link, $sql);
        if($rs){
            return true;
        } else{
            die("Lỗi thêm dữ liệu vào cơ sở dữ liệu: ");
        }
    } 

    public function searchDataFromDatabase($key, $value) {
        $link = mysqli_connect("localhost", "root", "", "qlnspb") or die("Không thể kết nối đến CSDL MySQL");

        $allowedColumns = ['IDNV', 'Hoten', 'IDPB', 'Diachi']; 
    
        if (in_array($key, $allowedColumns)) {
            
    
            $sql = "SELECT * FROM nhanvien WHERE $key = ?";
            $stmt = mysqli_prepare($link, $sql);
    
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $value);
    
                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    $resultsArray = [];
    
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Append each row to the results array
                        $resultsArray[] = $row;
                    }
    
                    mysqli_stmt_close($stmt);
                    return $resultsArray;
                } else {
                    // Handle query execution error
                    mysqli_stmt_close($stmt);
                    die("Lỗi tìm kiếm dữ liệu: " . mysqli_error($link));
                }
            } else {
                // Handle statement preparation error
                die("Lỗi tạo câu truy vấn: " . mysqli_error($link));
            }
        } else {
            // Handle the case where the provided key is not allowed
            echo "Invalid column name.";
        }
    
        return []; // Return an empty array if the search is not successful or no results are found
    }

    public function AddNV($IDNV, $Hoten, $IDPB, $Diachi) {
        // Escape and sanitize user inputs
        $IDNV = mysqli_real_escape_string($this->link, $IDNV);
        $Hoten = mysqli_real_escape_string($this->link, $Hoten);
        $IDPB = mysqli_real_escape_string($this->link, $IDPB);
        $Diachi = mysqli_real_escape_string($this->link, $Diachi);

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($this->link, $sql);

        if (!$stmt) {

            die("Prepared statement failed: " . mysqli_error($this->link));
        }

        mysqli_stmt_bind_param($stmt, "ssss", $IDNV, $Hoten, $IDPB, $Diachi);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }
}
?>
