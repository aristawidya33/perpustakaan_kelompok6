<style>
/* Tombol print */
.print-btn{
    background: #1e5eff;
    color: white;
    padding: 10px 14px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.print-btn:hover{
    background: #003ecc;
}

/* STYLE KHUSUS SAAT PRINT */
@media print{

    body{
        background: white !important;
        margin: 0;
    }

    .no-print{
        display: none !important;
    }

    table{
        width: 100%;
        border-collapse: collapse;
    }

    th{
        background: #1e5eff !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    td, th{
        border: 1px solid #000;
        padding: 8px;
    }

}
</style>

<!-- Tombol print -->
<a href="export_excel.php" class="excel-btn">
📊 Export Excel
</a>

.excel-btn{
    background:#28a745;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

.excel-btn:hover{
    background:#218838;
}