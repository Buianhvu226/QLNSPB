<?php
include_once("E_PB.php");

class M_PB {
    private $link;

    // Constructor to establish the database connection
    public function __construct() {
        $this->link = mysqli_connect("localhost", "root", "", "qlnspb") or die("Không thể kết nối đến CSDL MySQL");
    }

    // Get all phòng ban from the database
    public function getAllPB() {
        $sql = "SELECT * FROM phongban";
        $rs = mysqli_query($this->link, $sql);

        $pbs = array();

        while ($row = mysqli_fetch_array($rs)) {
            $idpb = $row['IDPB'];
            $Tenpb = $row['Tenpb'];
            $Mota = $row['Mota'];

            $pbs[] = new E_PB($idpb, $Tenpb, $Mota);
        }

        return $pbs;
    }

    // Add a new phòng ban to the database
    public function AddPB($IDPB, $Tenpb, $Mota) {
        // Escape and sanitize user inputs
        $IDPB = mysqli_real_escape_string($this->link, $IDPB);
        $Tenpb = mysqli_real_escape_string($this->link, $Tenpb);
        $Mota = mysqli_real_escape_string($this->link, $Mota);

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO phongban (IDPB, Tenpb, Mota) VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($this->link, $sql);

        if (!$stmt) {

            die("Prepared statement failed: " . mysqli_error($this->link));
        }

        mysqli_stmt_bind_param($stmt, "sss", $IDPB, $Tenpb, $Mota);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Get phòng ban details by ID from the database
    public function fillCompleteData($id) {
        $sql = "SELECT * FROM phongban WHERE IDPB = ?";
        $stmt = mysqli_prepare($this->link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $IDPB = $row['IDPB'];
                $Tenpb = $row['Tenpb'];
                $Mota = $row['Mota'];

                $pb = new E_PB($IDPB, $Tenpb, $Mota);
            } else {
                $pb = null;
            }

            mysqli_stmt_close($stmt);
        } else {
            $pb = null;
        }

        return $pb;
    }

    public function UpdatePB($IDPB, $Tenpb, $Mota) {
        // Use prepared statement to prevent SQL injection
        $sql = "UPDATE phongban SET Tenpb = ?, Mota = ? WHERE IDPB = ?";
        $stmt = mysqli_prepare($this->link, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $Tenpb, $Mota, $IDPB);

        $result = mysqli_stmt_execute($stmt);

        // Check for success or failure
        if ($result) {
            // Update successful
            mysqli_stmt_close($stmt);
            return true;
        } else {
            // Update failed
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        mysqli_close($this->link);
    }
}
?>
