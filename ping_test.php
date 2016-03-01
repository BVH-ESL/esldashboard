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
            var list_graph = new Array();
            var limit = 50;
            var link = "8.8.8.8";
            var dayNow = new Date();
            var dayThen = new Date();
            dayThen.setDate(dayNow.getDate() - 1);

//            chart.showLoading();
            var dataJSON;
//            console.log(dayNow.toJSON());
//            var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?eq[host]="+link+"&lte[timestamp]=2016-01-12T16:30:32.156Z&gte[timestamp]=2016-01-11T00:00:32.003Z";
//            var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?lte[timestamp]=" + dayNow.toJSON() + "&gte[timestamp]=" + dayThen.toJSON();

            function readJSON(url, str) {
                jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?limit=" + limit + "&lte[timestamp]=" + dayNow.toJSON() + "&gte[timestamp]=" + dayThen.toJSON() + "&eq[host]=" + url;
                var chart = $('#container2').highcharts();
                chart.showLoading();
//                console.log(jsonPingLink);
                $.getJSON(jsonPingLink, {
                })
                        .done(function (json) {
                            dataJSON = json;
                            drawGraph(str);
                        })

                        ;
            }

            function drawGraph(str) {
                var chart = $('#container2').highcharts();
                var index = list_graph.indexOf(str);
                var index_avg = 2 * index;
                var index_range = 2 * index + 1;
                console.log(chart.series.length);
                var data_x = [];
                var data_ranges = [];
                var data_avg = [];
                var data_range = [];
                var count = 0;
                for (var i = dataJSON.length - 1; i >= 0; i--) {
                    var d = new Date(Date.UTC(dataJSON[i].timestamp.substr(0, 4), parseInt(dataJSON[i].timestamp.substr(5, 2)) - 1, dataJSON[i].timestamp.substr(8, 2), dataJSON[i].timestamp.substr(11, 2), dataJSON[i].timestamp.substr(14, 2), dataJSON[i].timestamp.substr(17, 2)));
                    data_x[count] = d.getDay() + '-' + d.getMonth() + 1 + '/' + d.getHours() + ':' + d.getMinutes();
                    data_avg[0] = 0.0;
                    data_avg[1] = parseFloat(dataJSON[i].rtt_avg);

                    data_range[0] = count;
                    data_range[1] = parseFloat(dataJSON[i].rtt_min);
                    data_range[2] = parseFloat(dataJSON[i].rtt_max);

//                        chart.series[0].addPoint(data_avg);
//                        chart.series[1].addPoint(data_range);
//                        data_avgs[count] = data_avg;
                    data_ranges[count] = data_range;
                    count++;
//                        data_y.push(data_rtt);
//                        console.log(chart.series[0]);
//                        console.log(data_range);
                    chart.series[index_avg].addPoint(data_avg[1]);
                    chart.series[index_range].addPoint(data_range);
                }
                chart.series[index_avg].name = str;
                chart.xAxis[0].setCategories(data_x);
                chart.hideLoading();
            }

            function graph(url, str, id) {
                //show graph
                if (document.getElementById(id).alt === '1') {
                    if (list_graph.indexOf(str) === -1) {
                        list_graph.push(str);
                        var index = list_graph.indexOf(str);
                        var index_avg = 2 * index;
                        var chart = $('#container2').highcharts();
                        chart.addSeries({
                            name: str
                        });
                        chart.addSeries({
                            name: 'range' + str,
                            type: 'arearange',
                            lineWidth: 0,
                            linkedTo: ':previous',
                            color: Highcharts.getOptions().colors[index_avg],
                            fillOpacity: 0.3,
                            zIndex: 0
                        });
                        readJSON(url, str);
                    } else {
                        var chart = $('#container2').highcharts();
                        var index = list_graph.indexOf(str);
                        var index_avg = 2 * index;
                        var index_range = 2 * index + 1;
                        if (chart.series.length) {
                            chart.series[index_range].show();
                            chart.series[index_avg].show();
                        }
                    }
//                    console.log(list_graph);
                    document.getElementById(id).style.filter = 'grayscale(0)';
                    document.getElementById(id).style.webkitFilter = 'grayscale(0)';
                    document.getElementById(id).alt = 0;

                } else if (document.getElementById(id).alt === '0') {
                    document.getElementById(id).style.filter = 'grayscale(1)';
                    document.getElementById(id).style.webkitFilter = 'grayscale(1)';
                    document.getElementById(id).alt = 1;
                    removeChart(str);
                }
            }
            function removeChart(str) {
                var chart = $('#container2').highcharts();
                var index = list_graph.indexOf(str);
                var index_avg = 2 * index;
                var index_range = 2 * index + 1;
                if (chart.series.length) {
                    chart.series[index_range].hide();
                    chart.series[index_avg].hide();
                }
            }
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
//                    series:
//                            [{
//                            name: 'avg ping'
////                            data: averages,
//
//                        }
//                        , {
//                            name: 'Range ping',
////                            data: ranges,
//                            type: 'arearange',
//                            lineWidth: 0,
//                            linkedTo: ':previous',
//                            color: Highcharts.getOptions().colors[0],
//                            fillOpacity: 0.3,
//                            zIndex: 0
//                        }
//                    ]
                });
            });</script>
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
        <img src="img/google.jpg" id="google" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="graph('8.8.8.8', 'google', 'google')"/>
        <img src="img/facebook.png" id="facebook" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="graph('31.13.95.36', 'facebook', 'facebook')"/>
        <img src="img/eng.jpg" id="eng" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="graph('202.44.37.51', 'Eng KMUTNB', 'eng')"/>
        <img src="img/klogic.png" id="klogic" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="graph('202.44.32.118', 'Klogic KMUTNB', 'klogic')"/>
        <img src="img/dg.png" id="dg" width="100px;" height="100px" style=" filter: grayscale(1); -webkit-filter: grayscale(1);" alt="1" onclick="graph('192.168.10.254', 'Default GateWay', 'dg')"/>
        <!--<img src="../../img/thumbnails/picjumbo.com_IMG_3241.jpg" >-->
    </center>
</body>
</html>
