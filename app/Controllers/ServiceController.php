<?php
// app/Controllers/ServiceController.php

class ServiceController extends Controller {
    
    public function baggageBuy() {
        $data = [
            'title' => 'Mua thêm hành lý ký gửi - Skyline Ticket'
        ];
        
        $this->view('service/baggage_buy', $data);
    }
    
    public function baggageInfo() {
        $data = [
            'title' => 'Tra cứu thông tin hành lý - Skyline Ticket'
        ];
        
        $this->view('service/baggage_info', $data);
    }
    
    public function seatSelection() {
        $data = [
            'title' => 'Chọn trước chỗ ngồi - Skyline Ticket'
        ];
        
        $this->view('service/seat_selection', $data);
    }

    public function skySofa() {
        $data = [
            'title' => 'Dịch vụ Sky Sofa - Skyline Ticket'
        ];
        
        $this->view('service/sky_sofa', $data);
    }

    public function classUpgrade() {
        $data = [
            'title' => 'Nâng hạng vé - Skyline Ticket'
        ];
        
        $this->view('service/class_upgrade', $data);
    }

    public function upgradeAdvance() {
        $data = [
            'title' => 'Nâng hạng mua trước - Skyline Ticket'
        ];
        $this->view('service/class_upgrade_advance', $data);
    }

    public function upgradeLastMinute() {
        $data = [
            'title' => 'Nâng hạng giờ chót - Skyline Ticket'
        ];
        $this->view('service/class_upgrade_lastminute', $data);
    }

    public function upgradeMiles() {
        $data = [
            'title' => 'Đổi dặm nâng hạng - Skyline Ticket'
        ];
        $this->view('service/class_upgrade_miles', $data);
    }

    public function processSeatSelection() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pnr = $_POST['pnr'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $seatPrice = (int)($_POST['seat_type'] ?? 0);
            
            // Mock Validation: Ensure PNR has exactly 6 chars
            if (strlen($pnr) === 6) {
                // If it's a free seat (0 VND), simulate direct success
                if ($seatPrice === 0) {
                    header("Location: " . BASEURL . "/service/seatSuccess?pnr=$pnr&status=free");
                    exit();
                }
                
                // Store seat booking intent in session
                $_SESSION['seat_upgrade'] = [
                    'pnr' => strtoupper($pnr),
                    'last_name' => $lastName,
                    'departure' => $_POST['departure'] ?? '',
                    'destination' => $_POST['destination'] ?? '',
                    'departure_date' => $_POST['departure_date'] ?? '',
                    'price' => $seatPrice
                ];
                
                // Redirect to Seat Payment page
                header("Location: " . BASEURL . "/service/seatPayment");
                exit();
            } else {
                // Mock Error
                echo "<script>alert('Mã đặt chỗ (PNR) không hợp lệ. Vui lòng kiểm tra lại!'); window.history.back();</script>";
            }
        }
    }

    public function seatPayment() {
        if (!isset($_SESSION['seat_upgrade'])) {
            header("Location: " . BASEURL . "/service/seatSelection");
            exit();
        }
        
        $data = [
            'title' => 'Thanh toán chỗ ngồi - Skyline Ticket',
            'seat_info' => $_SESSION['seat_upgrade']
        ];
        
        $this->view('service/seat_payment', $data);
    }

    public function confirmSeatPayment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['seat_upgrade'])) {
            $pnr = $_SESSION['seat_upgrade']['pnr'];
            unset($_SESSION['seat_upgrade']); // Clear session after success
            
            header("Location: " . BASEURL . "/service/seatSuccess?pnr=$pnr&status=paid");
            exit();
        }
    }
    
    public function seatSuccess() {
        $pnr = $_GET['pnr'] ?? 'UNKNOWN';
        $status = $_GET['status'] ?? 'paid';
        
        $data = [
            'title' => 'Nâng hạng ghế thành công - Skyline Ticket',
            'pnr' => strtoupper($pnr),
            'status' => $status
        ];
        
        $this->view('service/seat_success', $data);
    }

    public function hotelTour() {
        $data = [
            'title' => 'Khách Sạn & Tour Du Lịch - Skyline Ticket'
        ];
        $this->view('service/hotel_tour', $data);
    }

    public function shopping() {
        $data = [
            'title' => 'Skyline Travel Shop - Mua Sắm Du Lịch'
        ];
        $this->view('service/shopping', $data);
    }

    public function insurance() {
        $data = [
            'title' => 'Bảo Hiểm Du Lịch - Skyline Ticket'
        ];
        $this->view('service/insurance', $data);
    }

    public function processInsurance() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pnr = $_POST['pnr'] ?? '';
            $fullname = $_POST['fullname'] ?? '';
            $planName = $_POST['plan_name'] ?? 'Chưa xác định';
            $planPrice = (int)($_POST['plan_price'] ?? 0);

            if (strlen($pnr) === 6) {
                $_SESSION['insurance_upgrade'] = [
                    'pnr' => strtoupper($pnr),
                    'fullname' => strtoupper($fullname),
                    'plan_name' => $planName,
                    'price' => $planPrice
                ];
                header("Location: " . BASEURL . "/service/insurancePayment");
                exit();
            } else {
                echo "<script>alert('Mã đặt chỗ (PNR) không hợp lệ. Vui lòng kiểm tra lại!'); window.history.back();</script>";
            }
        }
    }

    public function insurancePayment() {
        if (!isset($_SESSION['insurance_upgrade'])) {
            header("Location: " . BASEURL . "/service/insurance");
            exit();
        }
        
        $data = [
            'title' => 'Thanh toán Bảo Hiểm - Skyline Ticket',
            'insurance_info' => $_SESSION['insurance_upgrade']
        ];
        
        $this->view('service/insurance_payment', $data);
    }

    public function confirmInsurancePayment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['insurance_upgrade'])) {
            $pnr = $_SESSION['insurance_upgrade']['pnr'];
            
            // Save to invoice history in session
            if (!isset($_SESSION['invoices'])) {
                $_SESSION['invoices'] = [];
            }
            $_SESSION['invoices'][] = [
                'id' => 'INV-' . time() . '-' . rand(1000, 9999),
                'pnr' => $pnr,
                'fullname' => $_SESSION['insurance_upgrade']['fullname'],
                'service' => 'Bảo Hiểm Du Lịch',
                'plan' => $_SESSION['insurance_upgrade']['plan_name'],
                'amount' => $_SESSION['insurance_upgrade']['price'],
                'date' => date('Y-m-d H:i:s'),
                'status' => 'Đã thanh toán'
            ];
            
            unset($_SESSION['insurance_upgrade']);
            header("Location: " . BASEURL . "/service/insuranceSuccess?pnr=$pnr");
            exit();
        }
    }

    public function insuranceSuccess() {
        $pnr = $_GET['pnr'] ?? 'UNKNOWN';
        
        // Find the latest invoice for this PNR
        $latestInvoice = null;
        if (isset($_SESSION['invoices'])) {
            $invoices = array_reverse($_SESSION['invoices']);
            foreach ($invoices as $inv) {
                if ($inv['pnr'] == $pnr && $inv['service'] == 'Bảo Hiểm Du Lịch') {
                    $latestInvoice = $inv;
                    break;
                }
            }
        }
        
        $data = [
            'title' => 'Mua Bảo Hiểm thành công - Skyline Ticket',
            'pnr' => strtoupper($pnr),
            'invoice' => $latestInvoice
        ];
        $this->view('service/insurance_success', $data);
    }
    
    public function history() {
        $data = [
            'title' => 'Lịch Sử Mua Dịch Vụ - Skyline Ticket',
            'invoices' => $_SESSION['invoices'] ?? []
        ];
        $this->view('service/history', $data);
    }
}
?>
