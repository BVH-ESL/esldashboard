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
            $(function () {

                var ranges = [
                    [1246406400000, 14.3, 27.7],
                    [1246492800000, 14.5, 27.8],
                    [1246579200000, 15.5, 29.6],
                    [1246665600000, 16.7, 30.7],
                    [1246752000000, 16.5, 25.0],
                    [1246838400000, 17.8, 25.7],
                    [1246924800000, 13.5, 24.8],
                    [1247011200000, 10.5, 21.4],
                    [1247097600000, 9.2, 23.8],
                    [1247184000000, 11.6, 21.8],
                    [1247270400000, 10.7, 23.7],
                    [1247356800000, 11.0, 23.3],
                    [1247443200000, 11.6, 23.7],
                    [1247529600000, 11.8, 20.7],
                    [1247616000000, 12.6, 22.4],
                    [1247702400000, 13.6, 19.6],
                    [1247788800000, 11.4, 22.6],
                    [1247875200000, 13.2, 25.0],
                    [1247961600000, 14.2, 21.6],
                    [1248048000000, 13.1, 17.1],
                    [1248134400000, 12.2, 15.5],
                    [1248220800000, 12.0, 20.8],
                    [1248307200000, 12.0, 17.1],
                    [1248393600000, 12.7, 18.3],
                    [1248480000000, 12.4, 19.4],
                    [1248566400000, 12.6, 19.9],
                    [1248652800000, 11.9, 20.2],
                    [1248739200000, 11.0, 19.3],
                    [1248825600000, 10.8, 17.8],
                    [1248912000000, 11.8, 18.5],
                    [1248998400000, 10.8, 16.1]
                ],
                        averages = [
                            [1246406400000, 21.5],
                            [1246492800000, 22.1],
                            [1246579200000, 23],
                            [1246665600000, 23.8],
                            [1246752000000, 21.4],
                            [1246838400000, 21.3],
                            [1246924800000, 18.3],
                            [1247011200000, 15.4],
                            [1247097600000, 16.4],
                            [1247184000000, 17.7],
                            [1247270400000, 17.5],
                            [1247356800000, 17.6],
                            [1247443200000, 17.7],
                            [1247529600000, 16.8],
                            [1247616000000, 17.7],
                            [1247702400000, 16.3],
                            [1247788800000, 17.8],
                            [1247875200000, 18.1],
                            [1247961600000, 17.2],
                            [1248048000000, 14.4],
                            [1248134400000, 13.7],
                            [1248220800000, 15.7],
                            [1248307200000, 14.6],
                            [1248393600000, 15.3],
                            [1248480000000, 15.3],
                            [1248566400000, 15.8],
                            [1248652800000, 15.2],
                            [1248739200000, 14.8],
                            [1248825600000, 14.4],
                            [1248912000000, 15],
                            [1248998400000, 13.6]
                        ];


                $('#container2').highcharts({
                    title: {
                        text: 'July temperatures'
                    },
                    xAxis: {
//                        type: 'datetime'
                    },
                    yAxis: {
                        title: {
//                            text: null
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

            var data_show = [];
            var data_rttt = [];
//            var chart = $('#container2').highcharts();
            $.getJSON("jsonfile/ping.json", {
//                var chart = $('#container2').highcharts();
//                chart.showLoading();
            }).done(function (json) {
                var chart = $('#container2').highcharts();
//                console.log(chart.series);
                var data_x = [];
                var data_ranges = [];
                var data_avg = [];
                var data_range = [];
                var count = 0;
                for (var i = 0; i < json.length; i++) {
                    if (json[i].host === "8.8.8.8") {
//                        console.log(json[i].timestamp);
                        data_x[count] = json[i].timestamp.substring(11);
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
                console.log(data_ranges);
            });


        </script>
    </head>
    <body>
<!--        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>-->
        <script src="chart/Highcharts-4.2.1/js/highcharts.js" type="text/javascript"></script>
        <script src="chart/Highcharts-4.2.1/js/highcharts-more.js" type="text/javascript"></script>
        <script src="chart/Highcharts-4.2.1/js/modules/exporting.js" type="text/javascript"></script>
        <div id="container2" style=" margin: auto; min-width: 310px; max-width: 600px"></div>
    </body>
</html>
