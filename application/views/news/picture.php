<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
</head>

<body>
    <div id="main" style="height:400px"></div>
    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
    <script type="text/javascript">
        require.config({
            paths:{
                echarts:'http://echarts.baidu.com/build/dist'
            }
        })


        //使用
        require(
            [
                'echarts',
                'echarts/chart/bar'
            ],
            function(ec){
                //初始化
                var myChart = ec.init(document.getElementById("main"));

                var option = {
                    tooltip:{
                        show:true,
                    },
                    legend:{
                        data:['销量']
                    },
                    xAxis:[
                        {
                            type:'category',
                            data:["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"],
                        }
                    ],
                    yAxis:[
                        {
                            type:'value',
                        }
                    ],
                    series:[
                        {
                            "name":"销量",
                            "type":"bar",
                            "data":[5,20,40,10,10,20],
                        }
                    ],
                }
                //为charts对象加载数据
                myChart.setOption(option);

            }
        );
    </script>
</body>