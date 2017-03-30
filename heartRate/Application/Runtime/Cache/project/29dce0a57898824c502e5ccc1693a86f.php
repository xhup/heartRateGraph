<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" media="screen" href="/heartRate/Public/css/heartRate.css">
    <meta charset="UTF-8">
    <title>心率图显示</title>
</head>
<body>
    <div class="top">
         <div class="mecg">母体心电值:<input value="80"></div>
         <div class="fecg">胎儿心电值:<input></div>
    </div>
    <div class="middle">
        <select class="tog">
            <option value="blend">混合心率</option>
            <option value="separate">分离心率</option>
        </select>
    </div>
    <div class="show" id="heartRateGraph">

    </div>
<script src="/heartRate/Public/js/jquery-2.1.1.min.js"></script>
<script src="/heartRate/Public/js/echarts.common.min.js"></script>
    <script>
        //建立折线图
        function drawGraph(number,parm){
            var url="<?php echo U('Data/setData');?>";
            $.post(url,{"parm":parm},function(data) {
                var length = data.length;//总数据长度
                if(parm=="blend"){
                    var max=2500;
                    var min=-1500;
                }else {
                    max=10.0;
                    min=-10;
                }
                var size=[];//坐标点个数
                for(var i=1;i<number;i++){
                    size.push(i)
                }
                var chart =echarts.init(document.getElementById('heartRateGraph')); //新建一个echars
                //配置图表
                var option = {
                    title: {
                        text: '母体和婴儿心率曲线图',
                        textStyle: {
                            fontStyle: 'italic',
                            color:'#ff7f50'
                        },
                        top:'20',
                        left:'100'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['一', '二', '三', '四', '五','六','七','八']
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    toolbox: {
                        feature : {
                            mark : { show: true},
                            dataZoom: {
                                yAxisIndex: 'none'
                            },
                            dataView : {show: true},
                            magicType : {show: true, type: ['line', 'bar']},
                            restore : {show: true},
                            saveAsImage : {show: true},
                            left: 'center'
                        }
                    },
                    calculable : true,
                    dataZoom:[{
                        startValue:1},
                        {show:true},
                         {type:'inside'

                    }],
                    xAxis: {
                        type: 'category',
                        min:1,
                        max:1250,
//                        splitNumber:'1250',
//                        Interval:'1',
                        boundaryGap: false,
                        name:'采样点',
                        axisLabel: {
                            formatter: '{value}'
                        },
                          data:size
                    },

                    yAxis: {
                        type: 'value',
                        max:max,
                        min:min,
                        name:'采样值',
                        axisLabel: {
                            formatter: '{value}'
                        }
                    },
                    series: [
                        {
                            symbolSize:5,
                            symbol:"circle",
                            name: '一',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#CD2626"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#CD2626'
                                }
                            },
                            data:data[0]
                        },
                        {
                            symbolSize:5,
                            symbol:"circle",
                            name: '二',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#191970"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#191970'
                                }
                            },
                            data:data[1]
                        },
                        {
                            symbolSize:5,
                            symbol:"circle",
                            name: '三',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#388E8E"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#388E8E'
                                }
                            },
                            data:data[2]
                        },  {
                            symbolSize:5,
                            symbol:"circle",
                            name: '四',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#CD950C"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#CD950C'
                                }
                            },
                            data:data[3]
                        },  {
                            symbolSize:5,
                            symbol:"circle",
                            name: '五',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#EEEE00"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#EEEE00'
                                }
                            },
                            data:data[4]
                        },  {
                            symbolSize:5,
                            symbol:"circle",
                            name: '六',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#9A32CD"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#9A32CD'
                                }
                            },
                            data:data[5]
                        },  {
                            symbolSize:5,
                            symbol:"circle",
                            name: '七',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#8B795E"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#8B795E'
                                }
                            },
                            data:data[6]
                        },
                        {
                            symbolSize:5,
                            symbol:"circle",
                            name: '八',
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: "#006400"
                                }
                            },
                            lineStyle: {
                                normal:{
                                    width: 1,
                                    color: '#006400'
                                }
                            },
                            data:data[7]
                        }
                    ]
                };
                //使用刚指定的配置项和数据显示图表
                chart.setOption(option,true);
            })
        }

        //监听心率类型的切换
        $(".tog").on("change",function(e){
            var chioce= e.target.value;
            drawGraph(1251,chioce);
        })
        $(function(){
//            var childHeart=$(".fecg input").val();
            var fileUrl="/heartRate/lastFecg.json";
            $.getJSON(fileUrl,function(data){
                $(".fecg input").attr("value",data);//读取对应json文件的Fecg的值并赋给input框
            })
             drawGraph(1251,"blend");//页面加载完成后默认先显示混合的心率
        })
    </script>
</body>
</html>