<script type="text/javascript">
	$(function () {
        $('#container1').highcharts({
            title: {
                text: 'Cumulative: Number of Infants tested for HIV',
                x: -20 //center
            },
            subtitle: {
                text: 'Positivity: 7.1%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Infants tested',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'HIV +ve',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container2').highcharts({
            title: {
                text: 'Cumulative: Number of Children Tested for HIV',
                x: -20 //center
            },
            subtitle: {
                text: 'Positivity: 0.5%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: <?php echo json_encode($chart['cumulative_test_positive']['child_tspos']);?>
        });
    });

$(function () {
        $('#container3').highcharts({
            title: {
                text: 'Cumulative: Number of Children Tested for HIV',
                x: -20 //center
            },
            subtitle: {
                text: 'Positivity: 1.6%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Adults tested',
                data: [7.0, 14.0, 19.5, 21.5, 25.2, 28.5, 32.2, 36.5, 39.3, 42.3, 45.9, 49.6]
            }, {
                name: 'HIV +ve',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container4').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV Positive Infants'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Infants Positive',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: 'v'
                }
    
            }, {
                name: 'Infant Positivity',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });
    

$(function () {
        $('#container5').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV Positive Children'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Children Positive',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: 'v'
                }
    
            }, {
                name: 'Children Positivity',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });
    

$(function () {
        $('#container6').highcharts({
           chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV Positive Adults'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Adults Positive',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: 'v'
                }
    
            }, {
                name: 'Adults Positivity',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });
    

$(function () {
        $('#container7').highcharts({
            title: {
                text: 'Cumulative: Children Enrolled in Care',
                x: -20 //center
            },
            subtitle: {
                text: 'Est. Gap: 25%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Children HIV +ve',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Children Enrolled in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container8').highcharts({
            title: {
                text: 'Cumulative: Adults Enrolled in Care',
                x: -20 //center
            },
            subtitle: {
                text: 'Est. Gap: 37%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'HIV +ve Adults',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Adults Enrolled in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container9').highcharts({
            title: {
                text: 'Cumulative: Total Enrolled in Care',
                x: -20 //center
            },
            subtitle: {
                text: 'Est. Gap: 35%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Total HIV +ve',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Total Enrolled in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container10').highcharts({
            title: {
                text: '1st 90: Estimated Children in need for Identification',
                x: -20 //center
            },
            subtitle: {
                text: '1st 90-Gap: 25%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '1st 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Children Currently in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container11').highcharts({
            title: {
                text: '1st 90: Estimated Adults in need for identification',
                x: -20 //center
            },
            subtitle: {
                text: '1st 90-Gap: 37%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '1st 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Adults Currently in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container12').highcharts({
            title: {
                text: 'Cumulative: Total Enrolled in Care',
                x: -20 //center
            },
            subtitle: {
                text: '1st 90-Gap: 23%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '1st 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Total Currently in Care',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container13').highcharts({
            title: {
                text: 'Cumulative: Infants started on ART',
                x: -20 //center
            },
            subtitle: {
                text: 'Gap: 19%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'HIV +ve Infants',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Infants Started on ART',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container14').highcharts({
            title: {
                text: 'Cumulative: Children started on ART',
                x: -20 //center
            },
            subtitle: {
                text: 'Gap 26%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Started on ART',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Enrolled in Care',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container15').highcharts({
            title: {
                text: 'Cumulative: Adults started on ART',
                x: -20 //center
            },
            subtitle: {
                text: 'Gap: 5%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Started on ART',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Enrolled in Care',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });

$(function () {
        $('#container16').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV +ve Positive TB Patients'
            },
            subtitle: {
                text: 'Gap: -'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'HIV +ve TB Cases',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: 'Cases started on ART',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0,49.9, 71.5, 106.4, 129.2, 144.0, 176.0],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: '% started on ART',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });
    

$(function () {
        $('#container17').highcharts({
            title: {
                text: 'PMTCT Clients on HAART',
                x: -20 //center
            },
            subtitle: {
                text: 'PMTCT Gap: 40%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Need',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'HIV +ve',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Proph`xis',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }]
        });
    });
    

$(function () {
        $('#container18').highcharts({
           chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'PMTCT Missed Opportunities'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Missed Opp`s',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
    
            }, {
                name: 'Exposed Infant Positivity',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });
    

$(function () {
        $('#container19').highcharts({
            title: {
                text: '2nd 90: Children in need for Treatment',
                x: -20 //center
            },
            subtitle: {
                text: '2nd 90-Gap: 27%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Percentage (%)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '2nd 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Curr` on ART',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Curr` in Care',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }]
        });
    });

$(function () {
        $('#container20').highcharts({
            title: {
                text: '2nd 90: Adults in need of Treatment',
                x: -20 //center
            },
            subtitle: {
                text: '2nd 90-Gap: 24%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '2nd 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Curr` on ART',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Curr` in Care',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }]
        });
    });

$(function () {
        $('#container21').highcharts({
            title: {
                text: '2nd 90: Total in need of Treatment',
                x: -20 //center
            },
            subtitle: {
                text: '2nd 90-Gap: 25%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Values (v)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'v'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '2nd 90 Target Line',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Curr` on ART',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Curr` in Care',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }]
        });
    });

$(function () {
        $('#container22').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV +ve Positive TB Patients'
            },
            subtitle: {
                text: 'Gap: -'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'HIV +ve TB Cases',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: 'Cases started on ART',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0,49.9, 71.5, 106.4, 129.2, 144.0, 176.0],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: '% started on ART',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container23').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV +ve Positive TB Patients'
            },
            subtitle: {
                text: 'Gap: -'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'HIV +ve TB Cases',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: 'Cases started on ART',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0,49.9, 71.5, 106.4, 129.2, 144.0, 176.0],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: '% started on ART',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container24').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'HIV +ve Positive TB Patients'
            },
            subtitle: {
                text: 'Gap: -'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Values',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} v',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}%',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'HIV +ve TB Cases',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: 'Cases started on ART',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0,49.9, 71.5, 106.4, 129.2, 144.0, 176.0],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: '% started on ART',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container25').highcharts({
           title: {
                text: '3rd 90: Children Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 39%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 24%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    

$(function () {
        $('#container26').highcharts({
            title: {
                text: '3rd 90: Adults Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 77%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 73%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    

$(function () {
        $('#container27').highcharts({
           title: {
                text: '3rd 90: Total Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 77%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 73%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
           series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    

$(function () {
        $('#container22').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Trend: Survival and Retention on ART (12 Months)'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'ART Net Cohort (12M)',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' '
                }
            },
            {
                name: 'Alive and on ART (12M)',
                type: 'column',
                yAxis: 1,
                data: [40.9, 70.5, 100.4, 120.2, 140.0, 170.0,40.9, 70.5, 100.4, 120.2, 140.0, 170.0],
                tooltip: {
                    valueSuffix: ' '
                }
            },
            {
                name: 'Prop. A&ART',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color: Highcharts.getOptions().colors[3],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });

$(function () {
        $('#container23').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Pediatric Viral Load Testing'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Pediatric VL Tests',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: ' v'
                }
            },
            {
                name: 'VLs Suppressed',
                type: 'column',
                yAxis: 1,
                data: [40.9, 70.5, 100.4, 120.2, 140.0, 170.0,40.9, 70.5, 100.4, 120.2, 140.0, 170.0],
                tooltip: {
                    valueSuffix: 'v'
                }
            },
            {
                name: 'Prop. Suppressed',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color: Highcharts.getOptions().colors[3],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });

$(function () {
        $('#container24').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Adult Viral Load Testing'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Percentage',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Adult VL Tests',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                tooltip: {
                    valueSuffix: 'v'
                }
            },
            {
                name: 'VLs Suppressed',
                type: 'column',
                yAxis: 1,
                data: [40.9, 70.5, 100.4, 120.2, 140.0, 170.0,40.9, 70.5, 100.4, 120.2, 140.0, 170.0],
                tooltip: {
                    valueSuffix: 'v'
                }
            },
            {
                name: 'Prop. Suppressed',
                type: 'spline',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color: Highcharts.getOptions().colors[3],
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });

$(function () {
        $('#container25').highcharts({
           title: {
                text: '3rd 90: Children Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 39%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 24%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    

$(function () {
        $('#container26').highcharts({
            title: {
                text: '3rd 90: Adults Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 77%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 73%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    

$(function () {
        $('#container27').highcharts({
           title: {
                text: '3rd 90: Total Virally Suppressed',
                x: -20 //center
            },
            subtitle: {
                text: '3rd 90- Gap: 77%',
                x: -20
            },
            subtitle: {
                text: 'Curr` Gap: 73%',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yAxis: {
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
           series: [{
                name: 'T-3rd 90',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
            }, {
                name: 'Supp`d',
                data: [0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
            }, {
                name: 'C.on ART',
                data: [0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
            }, {
                name: 'VL Tests',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2]
            }]
        });
    });
    
</script>