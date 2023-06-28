
function randomizer(minVal, maxVal) {
    var randVal = minVal + (Math.random() * (maxVal - minVal));
    return typeof floatVal == 'undefined' ? Math.round(randVal) : randVal.toFixed();
}

var timer = setTimeout(function () { temp_ecoule(); }, 100000)

function show_quizz(index) {
    //clearTimeout(timer);
    timer = setTimeout(function () { temp_ecoule(); }, 5000);
    current_index = index;
}