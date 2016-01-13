<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
        <script src="jquery-1.8.3.min.js" type="text/javascript"></script>
        <style type="text/css">
            /*${demo.css}*/
        </style>
        <script type="text/javascript">
            var link = "8.8.8.8";
//            var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?eq[host]="+link+"&lte[timestamp]=2016-01-12T16:30:32.156Z&gte[timestamp]=2016-01-11T00:00:32.003Z";
            var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?limit=200";
            $(function () {
                $('#container2').highcharts({
                    title: {
                        text: 'Ping test'
                    },
                    xAxis: {
//                        type: 'datetime'
                        text: "time"
                    },
                    yAxis: {
                        title: {
                            text: "ping(ms)"
                        }
                    },
                    tooltip: {
//                        crosshairs: true,
//                        shared: true,
//                        valueSuffix: '°C'
                    },
                    legend: {
                    },
                    series: [{
                            name: 'avg ping'
//                            data: averages,

                        }
                        , {
                            name: 'Range ping',
//                            data: ranges,
                            type: 'arearange',
                            lineWidth: 0,
                            linkedTo: ':previous',
                            color: Highcharts.getOptions().colors[0],
                            fillOpacity: 0.3,
                            zIndex: 0
                        }
                    ]
                });
            });

            var data_x = [];
            var data_rttt = [];
//            var chart = $('#container2').highcharts();
            $.getJSON(jsonPingLink, {
//                var chart = $('#container2').highcharts();
//                chart.showLoading();
            }).done(function (json) {

                var chart = $('#container2').highcharts();
                chart.showLoading();
//                console.log(chart.series);
                var data_x = [];
                var data_ranges = [];
                var data_avg = [];
                var data_range = [];
                var count = 0;
                for (var i = 0; i < json.length; i++) {
                    if (json[i].host === "8.8.8.8") {
                        var d = new Date(Date.UTC(json[i].timestamp.substr(0, 4), parseInt(json[i].timestamp.substr(5, 2)) - 1, json[i].timestamp.substr(8, 2), json[i].timestamp.substr(11, 2), json[i].timestamp.substr(14, 2), json[i].timestamp.substr(17, 2)));
//                        var year = json[i].timestamp.substr(0, 4);
//                        var mount = json[i].timestamp.substr(5, 2);
//                        var day = json[i].timestamp.substr(8, 2);
//                        console.log(json[i].timestamp.substr(5, 2));
//                        console.log(d);
//                        var hour = parseInt(json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 1, 2)) + 7;
                        data_x[count] = d.getDay() + '-' + d.getMonth()+1 + '/' + d.getHours() + ':' + d.getMinutes();
//                        data_x[count] = json[i].timestamp.substr(5, 5) + "/" + hour + ":" + json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 2);
//                        console.log(json[i].rtt_avg);
//                        data_x[data_x.length] = data_x.length + 1;

                        data_avg[0] = 0.0;
                        data_avg[1] = parseFloat(json[i].rtt_avg);

                        data_range[0] = count;
                        data_range[1] = parseFloat(json[i].rtt_min);
                        data_range[2] = parseFloat(json[i].rtt_max);

//                        chart.series[0].addPoint(data_avg);
//                        chart.series[1].addPoint(data_range);
//                        data_avgs[count] = data_avg;
                        data_ranges[count] = data_range;
                        count++;
//                        data_y.push(data_rtt);
//                        console.log(chart.series[0]);
//                        console.log(data_range);
                        chart.series[0].addPoint(data_avg[1]);
                        chart.series[1].addPoint(data_range);
                    }
                }
//                console.log(data_ranges);
                chart.xAxis[0].setCategories(data_x);
                chart.hideLoading();
            });
            
            function removeChart() {
                var chart = $('#container2').highcharts();
                if (chart.series.length) {
                    chart.series[0].remove();
                    chart.series[1].remove();
                }
            }
            function changeData(url, str, id) {
//                var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?eq[host]=" + url + "&lte[timestamp]=2016-01-12T16:30:32.156Z&gte[timestamp]=2016-01-12T00:00:32.003Z";
//                jsonPingLink
                console.log(document.getElementById(id).alt);
                if(document.getElementById(id).alt === '1'){
                    document.getElementById(id).style.filter = 'grayscale(0)';
                    document.getElementById(id).style.webkitFilter = 'grayscale(0)'; 
//                    console.log(document.getElementById(id).style);
                    document.getElementById(id).alt = 0;
                }else if(document.getElementById(id).alt === '0'){
                    document.getElementById(id).style.filter = 'grayscale(1)';
                    document.getElementById(id).style.webkitFilter = 'grayscale(1)'; 
//                    console.log(document.getElementById(id).style);
                    document.getElementById(id).alt = 1;
                }
                $.getJSON(jsonPingLink, {
//                var chart = $('#container2').highcharts();
//                chart.showLoading();
                }).done(function (json) {

//                    removeChart();
                    var chart = $('#container2').highcharts();
                    chart.showLoading();
                    chart.series[0].setData([]);
                    chart.series[1].setData([]);
                    chart.setTitle({text: "ping test " + str});

//                console.log(chart.series);
                    var data_x = [];
                    var data_ranges = [];
                    var data_avg = [];
                    var data_range = [];
                    var count = 0;
                    for (var i = 0; i < json.length; i++) {
                        if (json[i].host === url) {
//                        console.log(json[i].timestamp);
                            var hour = parseInt(json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 1, 2)) + 7;
                            data_x[count] = json[i].timestamp.substr(5, 5) + "/" + hour + ":" + json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 2);
//                        console.log(json[i].rtt_avg);
//                        data_x[data_x.length] = data_x.length + 1;

                            data_avg[0] = 0.0;
                            data_avg[1] = parseFloat(json[i].rtt_avg);

                            data_range[0] = count;
                            data_range[1] = parseFloat(json[i].rtt_min);
                            data_range[2] = parseFloat(json[i].rtt_max);

//                        chart.series[0].addPoint(data_avg);
//                        chart.series[1].addPoint(data_range);
//                        data_avgs[count] = data_avg;
                            data_ranges[count] = data_range;
                            count++;
//                        data_y.push(data_rtt);
//                        console.log(chart.series[0]);
//                        console.log(data_range);
                            chart.series[0].addPoint(data_avg[1]);
                            chart.series[1].addPoint(data_range);
                        }
                    }
//                console.log(data_ranges);
                    chart.xAxis[0].setCategories(data_x);
                    chart.hideLoading();
                });
            }
        </script>
    </head>
    <body>
<!--        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>-->
        <script src="chart/Highcharts-4.2.1/js/highcharts.js" type="text/javascript"></script>
        <script src="chart/Highcharts-4.2.1/js/highcharts-more.js" type="text/javascript"></script>
        <script src="chart/Highcharts-4.2.1/js/modules/exporting.js" type="text/javascript"></script>
        <div id="container2" style=" margin: auto; min-width: 310px; max-width: 90%"></div>
    <center>
        <img src="img/google.jpg" id="google" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="changeData('8.8.8.8', 'google', 'google')"/>
        <img src="img/facebook.png" id="facebook" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="changeData('31.13.95.36', 'facebook', 'facebook')"/>
        <img src="img/eng.jpg" id="eng" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="changeData('202.44.37.51', 'Eng KMUTNB', 'eng')"/>
        <img src="img/klogic.png" id="klogic" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="changeData('202.44.32.118', 'Klogic KMUTNB', 'klogic')"/>
        <img src="img/dg.png" id="dg" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="changeData('192.168.10.254', 'Default GateWay', 'dg')"/>
        <!--<img src="../../img/thumbnails/picjumbo.com_IMG_3241.jpg" >-->
    </center>
</body>
</html>
