<canvas id="myChart" width="200" height="100"></canvas>
<script>
<?php
$client = curl_init("https://duduhuoyun.cn/api/profile/dashboard");
$body = array(
    "ms_token" => "2R4UENkbreoQWgaNjfGKseGR89i3wirqG3kKXnP4B7vvpwUqCCpn4AiZfeEB9UDd"  // 固定值
);
curl_setopt($client, CURLOPT_HEADER, false);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($client, CURLOPT_POST, true);
curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($body));
$resp = curl_exec($client);
curl_close($client);
$ret = json_decode($resp,true)['res'];
$retF = json_encode(array($ret['bossCount'],$ret['driverCount'],$ret['driverOrderCount'],$ret['profit']));
echo "var arr=" . "'$retF'";
?>
</script>
<script>
$(function () {
    var ctx = document.getElementById("myChart").getContext('2d');
    var dt=eval(arr)
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["用户总量", "司机总量", "订单总量", "平台流水"],
            datasets: [{
                label: '货运统计',
                data: dt,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
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
});
</script>
