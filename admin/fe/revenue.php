<?php

    require_once dirname(dirname(__DIR__)) . '/db/base.php';

    $db = new Database();

    // Lấy dữ liệu doanh thu từ database
    $revenue = $db->findAll('t_revenue');

    // Tính tổng doanh thu
    $totalPrice = 0;
    foreach($revenue as $r) {
        $totalPrice += $r['price'];
    }

?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h3 {
        text-align: center;
        color: #2c3e50;
        margin-top: 30px;
    }

    .revenue-container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin: 0 auto;
        margin-top: 30px;
    }

    .revenue-container p {
        font-size: 18px;
        color: #34495e;
        text-align: center;
        font-weight: bold;
    }

    .total-revenue {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
    }

    .total-revenue span {
        color: #e74c3c;
        font-size: 22px;
    }
</style>

<h3>Doanh thu</h3>

<div class="revenue-container">
    <p>Tổng doanh thu: <span><?php echo number_format($totalPrice, 0, ',', '.'); ?> VNĐ</span></p>
</div>
