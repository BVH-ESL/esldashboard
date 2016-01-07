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
                console.log(data_rttt);
                $('#container2').highcharts({
                    chart: {
                        type: 'boxplot',
                        width: 800,
                        height: 500
//                        marginLeft:
                    },
                    tooltip: {
//                        animation : false
                    },
                    loading: {
                        hideDuration: 1000,
                        showDuration: 5000
                    },
                    title: {
                        text: '8.8.8.8 ping test'
                    },
                    xAxis: {
                        title: {
                            text: 'Experiment No.'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'ping(ms)'
                        }
                    },
                    plotOptions: {
            boxplot: {
                fillColor: '#F0F0E0',
                lineWidth: 2,
                medianColor: '#0C5DA5',
                medianWidth: 3,
                stemColor: '#A63400',
                stemDashStyle: 'dot',
                stemWidth: 1,
                whiskerColor: '#3D9200',
                whiskerLength: '20%',
                whiskerWidth: 3
            }
        },
                    series: [{
                            name: 'google',
                            data: [],
                            tooltip: {
                                headerFormat: '<em>Experiment No {point.key}</em><br/>'
                            }
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
                chart.showLoading();
                var data_x = [];
                var data_rtt = [];
                var count = 0;
                for (var i = 0; i < json.length; i++) {
                    if (json[i].host === "8.8.8.8") {
                        console.log(json[i].timestamp);
                        data_x[count] = json[i].timestamp.substring(11);
//                        console.log(json[i].rtt_avg);
                        data_x[data_x.length] = data_x.length + 1;
                        data_rtt[0] = parseFloat(json[i].rtt_min);
                        data_rtt[1] = parseFloat(json[i].rtt_min);
                        data_rtt[2] = parseFloat(json[i].rtt_avg);
                        data_rtt[3] = parseFloat(json[i].rtt_max);
                        data_rtt[4] = parseFloat(json[i].rtt_max);
//                        console.log(data_rtt);
                        chart.series[0].addPoint(data_rtt);
                        count++;
//                        data_y.push(data_rtt);
//                        console.log(data_y);
                    }
                }

                console.log(data_x);
//                data_show = data_x;
//                data_rttt = data_y;
//                var chart = $('#container2').highcharts();
//                chart.series[0].setData(data_y);
                chart.xAxis[0].setCategories(data_x);
                chart.hideLoading();
//                console.log(chart);
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
