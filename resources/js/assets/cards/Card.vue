<template>
    <div class="col-12 col-lg-6 col-xl-4" v-if="type === 'chart'">
        <div class="card">
            <div class="card-header">
                <div :class="[color, chart_data.chart_type + `-diagram` ]">
                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                         class="ct-chart-line" style="width: 100%; height: 100%;"
                         v-if="chart_data.chart_type === 'line'">
                        <g class="ct-grids">
                            <line x1="40" x2="40" y1="0" y2="120" class="ct-grid ct-horizontal"></line>
                            <line x1="80.52232142857143" x2="80.52232142857143" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line x1="121.04464285714286" x2="121.04464285714286" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line x1="161.56696428571428" x2="161.56696428571428" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line x1="202.08928571428572" x2="202.08928571428572" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line x1="242.61160714285717" x2="242.61160714285717" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line x1="283.13392857142856" x2="283.13392857142856" y1="0" y2="120"
                                  class="ct-grid ct-horizontal"></line>
                            <line y1="120" y2="120" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                            <line y1="96" y2="96" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                            <line y1="72" y2="72" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                            <line y1="48" y2="48" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                            <line y1="24" y2="24" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                            <line y1="0" y2="0" x1="40" x2="323.65625" class="ct-grid ct-vertical"></line>
                        </g>
                        <g>
                            <g class="ct-series ct-series-a">
                                <path
                                    d="M40,91.2C80.522,79.2,80.522,79.2,80.522,79.2C121.045,103.2,121.045,103.2,121.045,103.2C161.567,79.2,161.567,79.2,161.567,79.2C202.089,64.8,202.089,64.8,202.089,64.8C242.612,76.8,242.612,76.8,242.612,76.8C283.134,28.8,283.134,28.8,283.134,28.8"
                                    class="ct-line"></path>
                                <line x1="40" y1="91.2" x2="40.01" y2="91.2" class="ct-point"
                                      ct:value="12"></line>
                                <line x1="80.52232142857143" y1="79.2" x2="80.53232142857144" y2="79.2"
                                      class="ct-point" ct:value="17"></line>
                                <line x1="121.04464285714286" y1="103.2" x2="121.05464285714287" y2="103.2"
                                      class="ct-point" ct:value="7"></line>
                                <line x1="161.56696428571428" y1="79.2" x2="161.57696428571427" y2="79.2"
                                      class="ct-point" ct:value="17"></line>
                                <line x1="202.08928571428572" y1="64.8" x2="202.0992857142857" y2="64.8"
                                      class="ct-point" ct:value="23"></line>
                                <line x1="242.61160714285717" y1="76.8" x2="242.62160714285716" y2="76.8"
                                      class="ct-point" ct:value="18"></line>
                                <line x1="283.13392857142856" y1="28.799999999999997" x2="283.14392857142855"
                                      y2="28.799999999999997" class="ct-point" ct:value="38"></line>
                            </g>
                        </g>
                        <g class="ct-labels">
                            <foreignObject style="overflow: visible;" x="40" y="125" width="40.52232142857143"
                                           height="20"><span class="ct-label ct-horizontal ct-end"
                                                             xmlns="http://www.w3.org/2000/xmlns/"
                                                             style="width: 41px; height: 20px;">M</span>
                            </foreignObject>
                            <foreignObject style="overflow: visible;" x="80.52232142857143" y="125"
                                           width="40.52232142857143" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">T</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="121.04464285714286" y="125"
                                           width="40.52232142857143" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">W</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="161.56696428571428" y="125"
                                           width="40.52232142857143" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">T</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="202.08928571428572" y="125"
                                           width="40.522321428571445" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">F</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="242.61160714285717" y="125"
                                           width="40.522321428571416" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">S</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="283.13392857142856" y="125"
                                           width="40.522321428571416" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 41px; height: 20px;">S</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">0</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">10</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">20</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">30</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">40</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 30px; width: 30px;">50</span></foreignObject>
                        </g>
                    </svg>
                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                         class="ct-chart-bar" style="width: 100%; height: 100%;"
                         v-if="chart_data.chart_type === 'column'">
                        <g class="ct-grids">
                            <line y1="120" y2="120" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                            <line y1="96" y2="96" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                            <line y1="72" y2="72" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                            <line y1="48" y2="48" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                            <line y1="24" y2="24" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                            <line y1="0" y2="0" x1="40" x2="318.65625" class="ct-grid ct-vertical"></line>
                        </g>
                        <g>
                            <g class="ct-series ct-series-a">
                                <line x1="51.610677083333336" x2="51.610677083333336" y1="120"
                                      y2="54.959999999999994" class="ct-bar" ct:value="542"></line>
                                <line x1="74.83203125" x2="74.83203125" y1="120" y2="66.84" class="ct-bar"
                                      ct:value="443"></line>
                                <line x1="98.05338541666667" x2="98.05338541666667" y1="120" y2="81.6"
                                      class="ct-bar" ct:value="320"></line>
                                <line x1="121.27473958333333" x2="121.27473958333333" y1="120"
                                      y2="26.400000000000006" class="ct-bar" ct:value="780"></line>
                                <line x1="144.49609375000003" x2="144.49609375000003" y1="120" y2="53.64"
                                      class="ct-bar" ct:value="553"></line>
                                <line x1="167.71744791666669" x2="167.71744791666669" y1="120" y2="65.64"
                                      class="ct-bar" ct:value="453"></line>
                                <line x1="190.93880208333334" x2="190.93880208333334" y1="120" y2="80.88"
                                      class="ct-bar" ct:value="326"></line>
                                <line x1="214.16015625000003" x2="214.16015625000003" y1="120" y2="67.92"
                                      class="ct-bar" ct:value="434"></line>
                                <line x1="237.38151041666669" x2="237.38151041666669" y1="120" y2="51.84"
                                      class="ct-bar" ct:value="568"></line>
                                <line x1="260.6028645833333" x2="260.6028645833333" y1="120" y2="46.8"
                                      class="ct-bar" ct:value="610"></line>
                                <line x1="283.82421875" x2="283.82421875" y1="120" y2="29.28" class="ct-bar"
                                      ct:value="756"></line>
                                <line x1="307.0455729166667" x2="307.0455729166667" y1="120"
                                      y2="12.599999999999994" class="ct-bar" ct:value="895"></line>
                            </g>
                        </g>
                        <g class="ct-labels">
                            <foreignObject style="overflow: visible;" x="40" y="125" width="23.221354166666668"
                                           height="20"><span class="ct-label ct-horizontal ct-end"
                                                             xmlns="http://www.w3.org/2000/xmlns/"
                                                             style="width: 23px; height: 20px;">Ja</span>
                            </foreignObject>
                            <foreignObject style="overflow: visible;" x="63.22135416666667" y="125"
                                           width="23.221354166666668" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Fe</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="86.44270833333334" y="125"
                                           width="23.221354166666664" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Ma</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="109.6640625" y="125"
                                           width="23.22135416666667" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Ap</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="132.88541666666669" y="125"
                                           width="23.22135416666667" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Mai</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="156.10677083333334" y="125"
                                           width="23.221354166666657" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Ju</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="179.328125" y="125"
                                           width="23.221354166666686" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Jul</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="202.54947916666669" y="125"
                                           width="23.221354166666657" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Au</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="225.77083333333334" y="125"
                                           width="23.221354166666657" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Se</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="248.9921875" y="125"
                                           width="23.221354166666686" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">Oc</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="272.2135416666667" y="125"
                                           width="23.221354166666657" height="20"><span
                                class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                style="width: 23px; height: 20px;">No</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="295.43489583333337" y="125" width="30"
                                           height="20"><span class="ct-label ct-horizontal ct-end"
                                                             xmlns="http://www.w3.org/2000/xmlns/"
                                                             style="width: 30px; height: 20px;">De</span>
                            </foreignObject>
                            <foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">0</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">200</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">400</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">600</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 24px; width: 30px;">800</span></foreignObject>
                            <foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span
                                class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/"
                                style="height: 30px; width: 30px;">1000</span></foreignObject>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <h5>{{ chart_data.text_header }}</h5>
                </div>
                <div>
                    <span
                        :class="{'text-success' : chart_data.percent > 0, 'text-danger' : chart_data.percent < 0, 'text-warning' : chart_data.percent === 0}">
                        <i class="fa-solid fa-up-long" v-if="chart_data.percent > 0"></i>
                        <i class="fa-solid fa-down-long me-2" v-if="chart_data.percent < 0"></i>
                        {{ chart_data.percent }} %
                    </span>
                    <span>
                        <span v-if="chart_data.percent >= 0">więcej</span>
                        <span v-if="chart_data.percent < 0">mniej</span>
                        niż miesiąc temu
                    </span>
                </div>
            </div>
            <div class="card-footer">
                <i class="fa-regular fa-clock me-2"></i>
                Zaktualizowane {{ chart_data.last_updated }}
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-3" v-if="type === 'information'">
        <div class="card">
            <div class="card-body">
                <div class="card__small--top">
                    <div class="image" :class="color">
                        <i :class="information_data.header_icon"></i>
                    </div>
                    <div class="text">
                                <span>
                                    {{ information_data.header_text }}
                                </span>
                        <h5>
                            {{ information_data.value }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <i class="me-2" :class="information_data.footer_icon"></i>
                {{ information_data.footer_content }}
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-6" v-if="type === 'list'">
        <div class="card">
            <div class="card-header mb-3">
                <div class="table__top" :class="color">
                    <h5>
                        {{ table_data.header_text }}

                        <button>{{ table_data.add_text }}</button>
                    </h5>
                    <span>
                                {{ table_data.header_span }}
                            </span>
                </div>
            </div>
            <div class="card-body">
                <div class="table__body">
                    <table class="w-100">
                        <tr>
                            <th v-for="header in table_data.columns">{{ header }}</th>
                        </tr>
                        <tr v-for="(number, index) in table_data.data.length">
                            <td v-for="item in table_data.data[index]">
                                {{ item }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-6" v-if="type === 'task_list'">
        <div class="card">
            <div class="card-header mb-3">
                <div class="table__top" :class="color">
                    <h5>
                        {{ task_list_data.header_text }}

                        <button>{{ task_list_data.add_text }}</button>
                    </h5>
                    <span>
                        {{ task_list_data.header_span }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="table__task">
                    <task-list :tasks="task_list_data.data"></task-list>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TaskList from "../task_list/TaskList";

export default {
    name: "Card",
    components: {TaskList},
    props: {
        // red | orange | blue | green
        color: {
            type: String,
            default: () => 'blue'
        },
        // chart | information | table | task_list
        type: {
            type: String,
            default: () => 'chart'
        },
        // data for charts
        chart_data: {
            type: [Object, Array],
            default: () => {
            }
        },
        information_data: {
            type: [Object, Array],
            default: () => {
            }
        },
        table_data: {
            type: [Object, Array],
            default: () => {
            }
        },
        task_list_data: {
            type: [Object, Array],
            default: () => {
            }
        }
    }
}
</script>
