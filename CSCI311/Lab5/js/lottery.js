// Created by Sami Al-Qusus
// Originally created by Sami Al-Qusus February 12, 2018
// Modified February 18, 2018
// lottery.js required for Lab5

"use strict";



function gen() {
    
    document.getElementById("n1").style.backgroundColor="transparent";
    document.getElementById("r1").style.backgroundColor="transparent";
    document.getElementById("n2").style.backgroundColor="transparent";
    document.getElementById("r2").style.backgroundColor="transparent";
    document.getElementById("n3").style.backgroundColor="transparent";
    document.getElementById("r3").style.backgroundColor="transparent";
    document.getElementById("n4").style.backgroundColor="transparent";
    document.getElementById("r4").style.backgroundColor="transparent";
    document.getElementById("n5").style.backgroundColor="transparent";
    document.getElementById("r5").style.backgroundColor="transparent";
    
    var num1 = document.getElementById("input1").value;
    var num2 = document.getElementById("input2").value;
    var num3 = document.getElementById("input3").value;
    var num4 = document.getElementById("input4").value;
    var num5 = document.getElementById("input5").value;
    document.getElementById("rand1").value = Math.floor(Math.random() * 9);
    document.getElementById("rand2").value = Math.floor(Math.random() * 9);
    document.getElementById("rand3").value = Math.floor(Math.random() * 9);
    document.getElementById("rand4").value = Math.floor(Math.random() * 9);
    document.getElementById("rand5").value = Math.floor(Math.random() * 9);
    var r1 = document.getElementById("rand1").value;
    var r2 = document.getElementById("rand2").value;
    var r3 = document.getElementById("rand3").value;
    var r4 = document.getElementById("rand4").value;
    var r5 = document.getElementById("rand5").value;
    document.getElementById("n1").innerHTML = num1;
    document.getElementById("n2").innerHTML = num2;
    document.getElementById("n3").innerHTML = num3;
    document.getElementById("n4").innerHTML = num4;
    document.getElementById("n5").innerHTML = num5;
    document.getElementById("r1").innerHTML = r1;
    document.getElementById("r2").innerHTML = r2;
    document.getElementById("r3").innerHTML = r3;
    document.getElementById("r4").innerHTML = r4;
    document.getElementById("r5").innerHTML = r5;
    var count = 0;
    if (num1 == r1){
        count ++;
        document.getElementById("n1").style.backgroundColor="yellow";
        document.getElementById("r1").style.backgroundColor="yellow";
    }
    if (num2 == r2){
        count ++;
        document.getElementById("n2").style.backgroundColor="green";
        document.getElementById("r2").style.backgroundColor="green";
    }
    if (num3 == r3){
        count ++;
        document.getElementById("n3").style.backgroundColor="gray";
        document.getElementById("r3").style.backgroundColor="gray";
    }
    if (num4 == r4){
        count ++;
        document.getElementById("n4").style.backgroundColor="Aqua";
        document.getElementById("r4").style.backgroundColor="Aqua";
    }
    if (num5 == r5){
        count ++;
        document.getElementById("n5").style.backgroundColor="Lavender";
        document.getElementById("r5").style.backgroundColor="Lavender";
    }
    document.getElementById("picks").innerHTML = "yours picks";
    document.getElementById("results").innerHTML = "lottery results";
    document.getElementById("result").innerHTML = count + " match";
}