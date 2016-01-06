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
            var finishReadJSON = false;
            var data_show = [];
            var data_rttt = [];
            $.getJSON("jsonfile/ping.json", function (json) {
                var data_x = [];
                var data_y = [];
                var data_rtt = [];
                for (var i = 0; i < json.length; i++) {
//                    console.log(json[i]);
                    if (json[i].host === "8.8.8.8") {

                        data_x[data_x.length] = data_x.length + 1;
                        data_rtt[0] = parseFloat(json[i].rtt_min);
//                        data_rtt[1] = parseFloat(json[i].rtt_avg-0.1);
                        data_rtt[2] = parseFloat(json[i].rtt_avg);
//                        data_rtt[3] = parseFloat(json[i].rtt_avg+0.1);
                        data_rtt[4] = parseFloat(json[i].rtt_max);
                        data_y[data_y.length] = data_rtt;
//                            data_y.length++;
//                        console.log(data_x);
//                        count++;
//                        console.log(json[i].host);
                    }
                }
                finishReadJSON = true;

                data_show = data_x;
                data_rttt = data_y;
            });

            $(function () {
//                console.log(data_show);
//                $('#container2').highcharts({
//                    chart: {
//                        type: 'boxplot'
//                    },
//                    title: {
//                        text: '8.8.8.8 ping test'
//                    },
//                    legend: {
////                        enabled: false
//                    },
//                    xAxis: {
////                        categories: ['1', '2', '3', '4', '5'],
////                        categories: data_show,
//                        title: {
//                            text: 'Experiment No.'
//                        }
//                    },
//                    yAxis: {
//                        title: {
//                            text: 'Observations'
//                        },
//                        plotLines: [{
//                                value: 932,
//                                color: 'red',
//                                width: 1,
//                                label: {
//                                    text: 'Theoretical mean: 932',
//                                    align: 'center',
//                                    style: {
//                                        color: 'gray'
//                                    }
//                                }
//                            }]
//                    },
//                    series: [{
//                            name: 'Observations',
//                            data: [
////                                [760, 801, 848, 895, 965],
////                                [733, 853, 939, 980, 1080],
////                                [714, 762, 817, 870, 918],
////                                [724, 802, 806, 871, 950],
////                                [834, 836, 864, 882, 910]
//                            ],
//                            tooltip: {
//                                headerFormat: '<em>Experiment No {point.key}</em><br/>'
//                            }
//                        }
////                        , {
////                            name: 'Outlier',
////                            color: Highcharts.getOptions().colors[0],
////                            type: 'scatter',
////                            data: [// x, y positions where 0 is the first category
////                                [0, 644],
////                                [4, 718],
////                                [4, 951],
////                                [4, 969]
////                            ],
////                            marker: {
////                                fillColor: 'white',
////                                lineWidth: 1,
////                                lineColor: Highcharts.getOptions().colors[0]
////                            },
////                            tooltip: {
////                                pointFormat: 'Observation: {point.y}'
////                            }
////                        }
//                    ]
//                });
                setInterval(function () {
                    if (finishReadJSON) {
                        console.log(data_rttt);
                        $('#container2').highcharts({
                            chart: {
                                type: 'boxplot'
                            },
                            title: {
                                text: '8.8.8.8 ping test'
                            },
                            legend: {
//                        enabled: false
                            },
                            xAxis: {
//                        categories: ['1', '2', '3', '4', '5'],
                                categories: data_show,
                                title: {
                                    text: 'Experiment No.'
                                }
                            },
                            yAxis: {
                                title: {
                                    text: 'google'
                                },
                                plotLines: [{
//                                        value: 932,
//                                        color: 'red',
//                                        width: 1,
//                                        label: {
//                                            text: 'Theoretical mean: 932',
//                                            align: 'center',
//                                            style: {
//                                                color: 'gray'
//                                            }
//                                        }
                                    }]
                            },
                            series: [{
                                    name: 'google',
                                    data: data_rttt,
                                    tooltip: {
                                        headerFormat: '<em>Experiment No {point.key}</em><br/>'
                                    }
                                }
//                        , {
//                            name: 'Outlier',
//                            color: Highcharts.getOptions().colors[0],
//                            type: 'scatter',
//                            data: [// x, y positions where 0 is the first category
//                                [0, 644],
//                                [4, 718],
//                                [4, 951],
//                                [4, 969]
//                            ],
//                            marker: {
//                                fillColor: 'white',
//                                lineWidth: 1,
//                                lineColor: Highcharts.getOptions().colors[0]
//                            },
//                            tooltip: {
//                                pointFormat: 'Observation: {point.y}'
//                            }
//                        }
                            ]
                        });
                        finishReadJSON = false;
                    }
                }, 1000);

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
        <div id="container2" style="height: 400px; margin: auto; min-width: 310px; max-width: 600px"></div>
    </body>
</html>
