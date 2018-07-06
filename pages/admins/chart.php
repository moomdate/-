<?php
include_once("configs/config.db.php");
$test = 10;

$query1 = "SELECT * FROM lists WHERE list_main = 'อุปกรณ์ไฟฟ้า'";
$data1 = mysqli_query($con__,$query1);
$elec = $data1->num_rows;

$query2 = "SELECT * FROM lists WHERE list_main = 'อุปกรณ์ประปา'";
$data2 = mysqli_query($con__,$query2);
$wat = $data2->num_rows;

$query3 = "SELECT * FROM lists WHERE list_main = 'อื่นๆ'";
$data3 = mysqli_query($con__,$query3);
$oth = $data3->num_rows;        
?>
<style type="text/css">
@media print {

    #non-printable {
        display:none
    }
    /* ... the rest of the rules ... */
}
</style>
<p><h3 class="ui header blue">รายการแจ้งซ่อมทั้งหมด</h3></p>
<div class="ui grid">
  <div class="four wide column"><button id="non-printable" class="ui blue button left floated aligned" onclick="print()"><i class="ui print icon"></i>พิมพ์</button></div>
  <div class="four wide column"></div>
   <div class="four wide column"></div>
  <div class="four wide column "></div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<canvas id="myChart"></canvas>
<script type="text/javascript">

    var ctx = document.getElementById('myChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
              label: 'อุปกรณ์ไฟฟ้า',
              data: [<?=$elec?>],
              backgroundColor: 'rgba(247, 76, 54, 0.2)',
              borderColor:'rgba(255,99,132,1)',
              borderWidth: 2
          }, {
              label: 'อุปกรณ์ประปา',
              data: [<?=$wat?>],
              backgroundColor: 'rgba(53, 211, 247, 0.2)',
              borderColor:'rgba(39, 161, 188,1)',
              borderWidth: 2
          },{
              label: 'อื่นๆ',
              data: [<?=$oth?>],
              backgroundColor: 'rgba(225, 61, 255, 0.2)',
              borderColor:'rgba(139, 54, 155,1)',
              borderWidth: 2
          }],

      },
      options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>