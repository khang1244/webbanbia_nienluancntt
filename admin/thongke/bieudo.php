<div class="container my-4">
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <h4 class="text-center mb-4">Biểu đồ thống kê sản phẩm theo danh mục</h4>

            <div class="row justify-content-center">
                <div id="piechart" style="max-width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Danh mục', 'Số lượng sản phẩm'],
            <?php
            $tongdm = count($listthongke);
            $i = 1;
            foreach ($listthongke as $thongke) {
                extract($thongke);
                $dauphay = ($i == $tongdm) ? '' : ',';
                echo "['" . $tendm . "', " . $countsp . "]" . $dauphay . "\n";
                $i++;
            }
            ?>
        ]);

        var options = {
            title: 'Thống kê sản phẩm theo danh mục',
            is3D: true,
            pieSliceText: 'percentage',
            legend: {
                position: 'right',
                textStyle: {
                    color: '#333',
                    fontSize: 16,
                    fontName: 'Poppins',
                    bold: true
                }
            },
            chartArea: {
                width: '85%',
                height: '80%'
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>