$(function () {
        $('#container1').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Average Monthly Temperature and Rainfall in Tokyo'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Rainfall',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} mm',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}°C',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Temperature',
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
                name: 'Rainfall',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 14.0, 176.0],
                tooltip: {
                    valueSuffix: ' mm'
                }
    
            }, {
                name: 'Temperature',
                type: 'spline',
                data: [17.0, 6.9, 20.5, 14.5, 0.2, 21.5],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container2').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Average Monthly Temperature and Rainfall in Tokyo'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Rainfall',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} mm',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}°C',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Temperature',
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
                name: 'Rainfall',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 14.0, 176.0],
                tooltip: {
                    valueSuffix: ' mm'
                }
    
            }, {
                name: 'Temperature',
                type: 'spline',
                data: [17.0, 6.9, 20.5, 14.5, 0.2, 21.5],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container3').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Average Monthly Temperature and Rainfall in Tokyo'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            }],
            yAxis: [{ // Primary yAxis
                title: {
                    text: 'Rainfall',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} mm',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                }
            }, { // Secondary yAxis
                labels: {
                    format: '{value}°C',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                title: {
                    text: 'Temperature',
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
                name: 'Rainfall',
                type: 'column',
                yAxis: 1,
                data: [49.9, 71.5, 106.4, 129.2, 14.0, 176.0],
                tooltip: {
                    valueSuffix: ' mm'
                }
    
            }, {
                name: 'Temperature',
                type: 'spline',
                data: [17.0, 6.9, 20.5, 14.5, 0.2, 21.5],
                tooltip: {
                    valueSuffix: '°C'
                }
            }]
        });
    });

$(function () {
        $('#container4').highcharts({
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
        $('#container5').highcharts({
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
        $('#container6').highcharts({
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
    

