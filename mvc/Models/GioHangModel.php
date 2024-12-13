<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class GioHangModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm increaseCart - thực hiện chức năng chính của hàm increaseCart
        function increaseCart($IDKH, $IDSP, $amount, $size, $dateIncrease, $status)
        {
            $queryProduct = "SELECT * FROM sanpham as sp 
                             JOIN giamgia as gg ON gg.IDSP = sp.ID 
                             WHERE sp.ID = '".$IDSP."' 
                             GROUP BY sp.ID";
            
            $result = mysqli_query($this->getConnection(), $queryProduct);
            $total = 0;

            while ($row = mysqli_fetch_array($result))
            {
                $reduce = $row["giaSP"] - ($row["giaSP"] * ($row["giaGiam"] * 0.01));
                $total = $amount * $reduce;
            }
            
            $checkProduct = $this->checkProductInCart($IDKH, $IDSP);

            if(!empty($checkProduct) && $checkProduct["status"] == 1)
            {
                $total = ($checkProduct["soLuong"] + $amount) * $reduce;

                $query = "UPDATE giohang SET soLuong = '".($checkProduct["soLuong"] + $amount)."', tongTien = '".$total."' 
                          WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";
            }
            else 
            {
                $query = "INSERT INTO `giohang`(`IDKH`, `IDSP`, `soLuong`, `size`, `tongTien`, `thoiGian`,`status`) 
                          VALUES ('".$IDKH."','".$IDSP."','".$amount."', '".$size."' ,'".$total."','".$dateIncrease->format('Y-m-d H:i:s')."','".$status."')";
            }

            mysqli_query($this->getConnection(), $query);
        }

// Hàm checkProductInCart - thực hiện chức năng chính của hàm checkProductInCart
        function checkProductInCart($IDKH, $IDSP)
        {   
            $query = "SELECT * FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' ORDER BY id DESC LIMIT 1";

            $result = mysqli_query($this->getConnection(), $query);
            $numRow = mysqli_fetch_assoc($result);

            return $numRow;
        }

// Hàm loadCart - thực hiện chức năng chính của hàm loadCart
        function loadCart($IDKH)
        {
            $query = "SELECT gh.ID, gh.IDKH, gh.IDSP, sp.IDLoai, br.tenBrand, sp.image, sp.tenSP,
                             gh.tongTien as total, gg.giaGiam, sp.giaSP, gh.size, gh.thoiGian,
                             SUM(gh.soLuong) as soLuong, SUM(gh.tongTien) as tongTien 
                      FROM giohang as gh 
                      JOIN sanpham as sp ON gh.IDSP = sp.ID 
                      JOIN giamgia as gg ON gg.IDSP = sp.ID
                      JOIN brand as br ON sp.IDBrand = br.ID
                      WHERE IDKH = '".$IDKH."' && gh.status = 1
                      GROUP BY gh.IDSP";

            $result = mysqli_query($this->getConnection(), $query);
            $arr = array();

            while($rows = mysqli_fetch_array($result))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

// Hàm updateCart - thực hiện chức năng chính của hàm updateCart
        function updateCart($IDCart, $amount, $IDKH, $IDSP)
        {
            $querySP = "SELECT * FROM `giohang` as gh 
                        JOIN sanpham as sp ON gh.IDSP = sp.ID 
                        JOIN giamgia as gg ON gg.IDSP = sp.ID
                        WHERE gg.IDSP = '".$IDSP."'
                        GROUP BY gh.IDSP";

            $result = mysqli_query($this->getConnection(), $querySP);
            $total = "";

            while ($row = mysqli_fetch_array($result))
            {
                $reduce = $row["giaSP"] - ($row["giaSP"] * ($row["giaGiam"] * 0.01));
                $total = $amount * $reduce;
            }

            $query = "UPDATE giohang SET soLuong = '".$amount."', tongTien = '".$total."' 
                      WHERE ID = '".$IDCart."' AND IDKH = '".$IDKH."'";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm deleteCart - thực hiện chức năng chính của hàm deleteCart
        function deleteCart($IDSP, $IDKH, $status)
        {
            $query = "UPDATE giohang SET status = '".$status."' WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."'";
            mysqli_query($this->getConnection(), $query);
        }

// Hàm undoItem - thực hiện chức năng chính của hàm undoItem
        function undoItem($IDKH)
        {
            $sumQuantity = 0;
            $maxSumQuantity = 0;
            $IDProducts = $this->getIDProducts($IDKH);

            foreach ($IDProducts as $IDSP) {
                $queryQuantity = "SELECT SUM(soluong) as sumSoLuong FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";
                $resultQuantity = mysqli_query($this->getConnection(), $queryQuantity);
                $rowQuantity = mysqli_fetch_assoc($resultQuantity);
                $sumQuantity = $rowQuantity['sumSoLuong'];
                $checkStatusItem = $this->checkStatusItem($IDKH, $IDSP);

                $queryProduct = "SELECT soluong FROM giohang WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";
                $resultProduct = mysqli_query($this->getConnection(), $queryProduct);
                $rowProduct = mysqli_fetch_assoc($resultProduct);

                $maxSumQuantity = $sumQuantity + (isset($rowProduct['soluong']) ? $rowProduct['soluong'] : 0);
                
                if (empty($checkStatusItem)) {
                    $updateQuery = "UPDATE giohang SET soluong = '".$sumQuantity."', status = 1 WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0 LIMIT 1";
                    $deleteQuery = "DELETE FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";
                } else {
                    $updateQuery = "UPDATE giohang SET soluong = '".$maxSumQuantity."' WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 1 LIMIT 1";
                    $deleteQuery = "DELETE FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";               
                }
                mysqli_query($this->getConnection(), $updateQuery);
                mysqli_query($this->getConnection(), $deleteQuery);

                $sumQuantity = 0;
                $maxSumQuantity = 0;
            }
        }

// Hàm checkStatusItem - thực hiện chức năng chính của hàm checkStatusItem
        function checkStatusItem($IDKH, $IDSP)
        {
            $query = "SELECT * FROM giohang WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";
            $result = mysqli_query($this->getConnection(), $query);
            $numRow = mysqli_fetch_assoc($result);

            return $numRow;
        }

// Hàm getIDProducts - thực hiện chức năng chính của hàm getIDProducts
        function getIDProducts($IDKH)
        {
            $query = "SELECT IDSP FROM giohang WHERE status = 0 AND IDKH = '".$IDKH."'";
            $result = mysqli_query($this->getConnection(), $query);
            $idArray = array();

            while ($row = mysqli_fetch_assoc($result))
            {
                $idArray[] = $row['IDSP'];
            }

            return $idArray;
        }

// Hàm placeAnOrder - thực hiện chức năng chính của hàm placeAnOrder
        function placeAnOrder($IDKH, $methodPay, $name, $address, $phone, $email, $noted, $IDSP, $reduce, $totalPrice)
        {
            $dateOrder = new DateTime();

            $insertDH = "INSERT INTO `donhang`(`IDKH`, `ngayDat`, `tinhTrang`, `phiGD`, `giamGia` , `tongTien`) 
                        VALUES ('".$IDKH."','".$dateOrder->format('Y-m-d H:i:s')."','Đang xử lý', 29000, '".$reduce."', '".$totalPrice."')";
            mysqli_query($this->getConnection(), $insertDH);

            $selectDH = "SELECT max(dh.ID) as ID from donhang as dh WHERE dh.IDKH = '".$IDKH."'";
            $resultInsertDH = mysqli_query($this->getConnection(), $selectDH);
            $rowInsertDH = mysqli_fetch_array($resultInsertDH);

            $IDDH = $rowInsertDH["ID"];

            $selectCart = "SELECT gh.ID, gh.IDKH, gh.IDSP, sp.IDLoai, br.tenBrand, sp.image, sp.tenSP, gh.tongTien as total, gg.giaGiam, sp.giaSP, gh.size, gh.thoiGian, SUM(gh.soLuong) as soLuong, SUM(gh.tongTien) as tongTien 
                           FROM `giohang` as gh 
                           JOIN sanpham as sp ON gh.IDSP = sp.ID 
                           JOIN giamgia as gg ON gg.IDSP = sp.ID
                           JOIN brand as br ON sp.IDBrand = br.ID
                           WHERE IDKH = '".$IDKH."' AND gh.status = 1 GROUP BY gh.IDSP";

            $resultCart = mysqli_query($this->getConnection(), $selectCart);

            $arrDH = array();

            while($rowCart = mysqli_fetch_array($resultCart))
            {
                $IDSP = $rowCart["IDSP"];
                $amount = $rowCart["soLuong"];
                $Size = $rowCart["size"];
                $totalDetailPrice = $rowCart["tongTien"];

                $insertDetailDH = "INSERT INTO `chitietdonhang`(`IDDH`, `IDSP`, `soLuong`, `Size`, `tongTien`, `cachThanhToan`, `ten`, `diaChi`, `sdt`, `email`, `ghiChu`) 
                                  VALUES ('".$IDDH."','".$IDSP."','".$amount."','".$Size."','".$totalDetailPrice."','".$methodPay."','".$name."','".$address."','".$phone."','".$email."','".$noted."')";
                mysqli_query($this->getConnection(), $insertDetailDH);

                $arrDH[] = $rowCart;
            }

            $query = "DELETE FROM `giohang` WHERE IDKH = '".$IDKH."' AND status = 1";
            mysqli_query($this->getConnection(), $query);

            return json_encode($arrDH);
        }

// Hàm sendMail - thực hiện chức năng chính của hàm sendMail
        function sendMail($email, $hoTen)
        {
            require "./Public/package/PHPMailer-master/src/PHPMailer.php"; 
            require "./Public/package/PHPMailer-master/src/SMTP.php"; 
            require './Public/package/PHPMailer-master/src/Exception.php'; 

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $date = date('d/m/Y H:i:s');
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP(); 
                $mail->CharSet = "utf-8";
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'myphamskincares@gmail.com';
                $mail->Password = 'ifyhydkcxtdgwazl';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('myphamskincares@gmail.com', 'NQASkincare');
                $mail->addAddress($email, $hoTen); 
                $mail->isHTML(true);
                $mail->Subject = "[NQA--SkinCare] - Xác Nhận Đơn Hàng";
                $noidungthu = "<div class='Main__Mailer'
                                    style='background: #f3f3f3; width: 700px; height: 500px; border-radius: 10px; color: #252a2b;'>
                                    <img style='width: 150px; height: 150px; margin: 10px 40%; border-radius: 50%;' src='https://adtimin.vn/wp-content/uploads/2017/09/Logo-1.jpg'>  
                                    <h2 style='text-align: center'>Cảm ơn bạn đã đặt hàng</h2>
                                    <div style='margin: 0 87px;'>
                                        <h3>Xin chào:$hoTen</h3>
                                        <p><b>Ngày:</b>$date</p>
                                        <p style='color: rgb(119,119,119)'>Đơn Hàng Của Bạn đang được xử lý!!!<hr>
                                        <p style='color: rgb(119,119,119); line-height: 1.7;'>
                                            Bạn vui lòng để ý Mail để nhận được thông tin chi tiết đơn hàng.<br>
                                            Các thông tin đơn hàng sẽ được thông báo qua gmail của bạn.
                                        </p>
                                    </div>                   
                                </div>"; 
                $mail->Body = $noidungthu;
                $mail->smtpConnect( array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
            } catch (Exception $e) {
            }
        }
    }
?>
