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
            var jsonPingLink = "http://192.168.1.10:8080/output/VKN8BojQgytyAddKMoJJSlqelz3.json?limit=100";
            var jsonWifiLink = "http://192.168.1.10:8080/output/9X1kENQZkzfqvxxDYJ66F6zE63p.json?limit=50";
            $.getJSON(jsonWifiLink, {})
                    .done(function (json) {
                        var chart = $('#container2').highcharts();
//                        console.log(json[0].timestamp);
                        var minTrick = 0;
                        var count2_4GHz = 0;
                        var dataRSSI = [];
                        for (var i = 0; i < json.length; i++) {
                            if (json[i].freq.substr(0, json[i].freq.indexOf(" ")) < 3.0) {
                                if (minTrick === 0) {
                                    minTrick = json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 2);
                                }
                                if (json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 2) - minTrick >= 0 && 
                                        json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 2) - minTrick < 5 ) {
                                    count2_4GHz++;
                                    console.log(json[i].channel);
//                                    console.log( json[i].timestamp.substr(json[i].timestamp.indexOf("T") + 4, 10));
                                    var pointChannel = parseInt(json[i].channel) + 1;
                                    for (var j = 0; j < pointChannel - 2; j++) {
                                        dataRSSI[j] = null;
                                    }
                                    dataRSSI[pointChannel - 2] = 0;
                                    dataRSSI[pointChannel - 1] = (100 + parseInt(json[i].rssi.substr(0, json[i].rssi.indexOf(" ")))) / 4 * 3;
//                                    dataRSSI[pointChannel - 1] = 0;
                                    dataRSSI[pointChannel] = 100 + parseInt(json[i].rssi.substr(0, json[i].rssi.indexOf(" ")));
//                                    dataRSSI[pointChannel + 1] = 0;
                                    dataRSSI[pointChannel + 1] = (100 + parseInt(json[i].rssi.substr(0, json[i].rssi.indexOf(" ")))) / 4 * 3;
                                    dataRSSI[pointChannel + 2] = 0;
//                                    console.log(pointChannel);
//                                    console.log(dataRSSI);
                                    chart.addSeries({
                                        name: json[i].essid,
                                        data: dataRSSI
                                    });
                                    dataRSSI = [];
                                }
                            }
//                   else{
//                       if(listMac5GHz.indexOf(json[i].mac) === -1){
//                           listMac5GHz.push(json[i].mac);
//                           count5GHz++;
//                       }else{
//                           console.log(count5GHz);
//                           break;
//                       }
//                   }
                        }
                        console.log(count2_4GHz);
                    });

            $(function () {
                $('#container2').highcharts({
                    chart: {
                        type: 'areaspline'
                    },
                    title: {
                        text: 'Wifi Scanner'
                    },
//                    subtitle: {
//                        text: 'Source: <a href="http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf">' +
//                                'thebulletin.metapress.com</a>'
//                    },
                    xAxis: {
                        title: {
                            text: 'Channel'
                        },
                        categories: ['', '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14']
                    },
                    yAxis: {
                        title: {
                            text: 'RSSI'
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
                    },
                    plotOptions: {
                        areaspline: {
//                            pointStart: ,
                            marker: {
                                enabled: false,
//                                symbol: 'circle',
                                radius: 4,
//                                states: {
//                                    hover: {
//                                        enabled: true
//                                    }
//                                }
                            },
                            fillOpacity: 0.5
                        }
                    },
                    series: []
                });
            });

        </script>
    </head>
    <body>
<!--        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>-->
        <script src="chart/Highcharts-4.2.1/js/highcharts.js" type="text/javascript"></script>
        <!--<script src="chart/Highcharts-4.2.1/js/highcharts-more.js" type="text/javascript"></script>-->
        <script src="chart/Highcharts-4.2.1/js/modules/exporting.js" type="text/javascript"></script>
        <div id="container2" style=" margin: auto; min-width: 310px; max-width: 80%"></div>
    </body>
</html>
