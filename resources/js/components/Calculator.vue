<template>
    <div class="offcanvas offcanvas-bottom h-auto" tabindex="-1" @click="handleClick" @keydown="handleKeyDown" id="calculatorOffcanvas" ref="CalculatorOffcanvas">
        <div class="offcanvas-body d-flex justify-content-center">
            <div class="calculator border border-3 border-secondary rounded p-3">
                <div class="border border-1 border-secondary mb-3 p-2">
                    <div class="row">
                        <div class="col-1 text-start ms-1 d-flex flex-nowrap">{{ sign }}&nbsp;</div>
                    </div>
                    <div class="row d-flex flex-nowrap" :class="{ 'invisible' : !isOverflow }">
                        <div class="col text-start ms-1">E</div>
                    </div>
                    <div class="row h2 m-auto d-flex flex-nowrap">
                        <div class="col text-end m-auto">&nbsp;{{ showing }}</div>
                    </div>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col p-1"><button type="button" class="btn btn-outline-danger w-100" value="c">C</button></div>
                        <div class="col p-1"><button type="button" class="btn btn-outline-primary w-100" value="÷">÷</button></div>
                        <div class="col p-1"><button type="button" class="btn btn-outline-primary w-100" value="×">×</button></div>
                        <div class="col p-1"><button type="button" class="btn btn-outline-primary w-100" value="-">-</button></div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="7">7</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="8">8</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="9">9</button></div>
                            </div>
                            <div class="row">
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="4">4</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="5">5</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="6">6</button></div>
                            </div>
                        </div>
                        <div class="col-3 p-1">
                            <button type="button" class="btn btn-outline-primary w-100 h-100" value="+">+</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="1">1</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="2">2</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-secondary w-100" value="3">3</button></div>
                            </div>
                            <div class="row">
                                <div class="col-8 p-1"><button type="button" class="btn btn-outline-secondary w-100" value="0">0</button></div>
                                <div class="col p-1"><button type="button" class="btn btn-outline-warning w-100" value=".">.</button></div>
                            </div>
                        </div>
                        <div class="col-3 p-1">
                            <button type="button" class="btn btn-outline-primary w-100 h-100" value="=">=</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .calculator {
        max-width: 350px;
        min-width: 300px;
    }
    .screen {
        height: 100px;
        display: flex;
        flex-direction: column;
    }
</style>

<script setup>
    import { ref, watch, onMounted } from 'vue';


    const CalculatorOffcanvas = ref(null);

    let isOverflow = false;
    let showing = ref(0);
    let sign = ref('');
    let number = ['', ''];
    let lastAction = '';   // 上一個點擊的按鈕 (避免重複點擊運算符而進行多次運算)
    let countFlag = false; // 是否運算過 (剛按完 "=" 接著按運算符)
    let dotFlag = false;   // 是否點過小數點
    let digitLimit = 10;   // 位數限制
    let digitLimit_with_thousand = digitLimit + parseInt(digitLimit / 3) - 1; // 含千分為的總位數

    // 千分位顯示
    watch(() => showing.value,
        () => {
            showing.value = showing.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    );

    onMounted(() => {
        // 監聽 Offcanvas 隱藏事件
        CalculatorOffcanvas.value.addEventListener("hidden.bs.offcanvas", () => {
            calculateEvent("c");
        });
    });

    function handleClick(e) {
        calculateEvent(e.target.value);
    }

    function handleKeyDown(e) {
        calculateEvent(e.key);
    }

    // 計算機邏輯
    function calculateEvent(value) {
        // 溢位只能歸零
        if (isOverflow === true && value != "c")
            return;

        switch(value) {
            case "0": case "1": case "2": case "3": case "4":
            case "5": case "6": case "7": case "8": case "9":
                // 限制十位數
                if (lastAction == "number" && showing.value.length >= digitLimit_with_thousand)
                    break;

                // 避免 "0X" 的情況
                if (showing.value == "0") 
                    number[1] = value;
                else
                    number[1] = `${number[1]}${value}`;
                showing.value = number[1];
                lastAction = "number";
                break;

            case "+": case "-": case "×": case "÷": case "*": case "/":
                if (value == "*") value = "×";
                if (value == "/") value = "÷";
                sign.value = value;

                // 重複點擊運算符
                if (lastAction == "sign")
                    break;

                // 一開始就直接點運算符
                if (!lastAction)
                    number[0] = 0;

                // 點過小數點且沒有小數位數
                if (dotFlag && number[1].charAt(number[1].length - 1) == ".")
                    number[1] = number[1].slice(0, -1);

                // 初次點數字
                if (number[0] === '') {
                    number[0] = number[1];
                    number[1] = '';
                    countFlag = true;
                } else if(countFlag) {
                    // 一般運算邏輯
                    number[0] = calculate(number, value);
                    number[1] = '';
                } else {
                    // "=" 之後又點運算符
                    countFlag = true;
                }

                lastAction = "sign";
                dotFlag = false;
                break;

            case "=":
                lastAction = 'equals';

                // 有輸入第二個數則計算
                if (number[1] !== '') {
                    number[0] = calculate(number, sign.value);
                    number[1] = '';
                }

                // 保留前十位數
                if (number[0].toString().length >= digitLimit_with_thousand) {
                    number[0] = number[0].toString().slice(0, digitLimit);
                    isOverflow = true;
                }

                // 顯示
                showing.value = number[0];
                sign.value = value;
                countFlag = false;
                break;

            case "c":
                reset();
                break;

            case ".":
                if (!dotFlag) {
                    dotFlag = true;

                    // 避免出現 ".X"
                    if (number[1] == '')
                        number[1] = "0.";
                    else
                        number[1] = `${number[1]}.`;
                    showing.value = number[1];
                }
                break;
        }
    }

    // 計算
    function calculate(numberArray, signValue) {
        numberArray[0] = parseFloat(numberArray[0]);
        numberArray[1] = parseFloat(numberArray[1]);
        //console.log(numberArray);
        switch(signValue) {
            case "+":
                return numberArray[0] + numberArray[1];
            case "-":
                return numberArray[0] - numberArray[1];
            case "×":
                return numberArray[0] * numberArray[1];
            case "÷":
                // 除以 0 則直接顯示 0
                if (numberArray[1] == 0) {
                    isOverflow = true;
                    return 0;
                }
                return numberArray[0] / numberArray[1];
        }
    }

    // 歸零
    function reset() {
        isOverflow = false;
        showing.value = 0;
        sign.value = '';
        number = ['', ''];
        lastAction = '';
        countFlag = false;
        dotFlag = false;
    }
</script>
