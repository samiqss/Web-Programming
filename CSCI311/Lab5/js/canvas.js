// Created by Sami Al-Qusus
// Originally created by Sami Al-Qusus February 12, 2018
// Modified February 18, 2018
// canvas.js required for Lab5

"use strict";

function update() {
    var shape = document.getElementById("shape").value;
    if (shape==="rectangle"){
        document.getElementById("ht").style.display="block";
        document.getElementById("wth").style.display="block";
        document.getElementById("lnX").style.display="none";
        document.getElementById("lnY").style.display="none";
        document.getElementById("rds").style.display="none";
        
    }else if(shape==="circle"){
        document.getElementById("ht").style.display="none";
        document.getElementById("wth").style.display="none";
        document.getElementById("lnX").style.display="none";
        document.getElementById("lnY").style.display="none";
        document.getElementById("rds").style.display="block";
    }else{
        document.getElementById("lnX").style.display="block";
        document.getElementById("lnY").style.display="block";
        document.getElementById("ht").style.display="none";
        document.getElementById("wth").style.display="none";
        document.getElementById("rds").style.display="none";
    }
    return 0;
}

var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");


function addShape() {
    
    var x= document.getElementById("inputx").value;
    var y= document.getElementById("inputy").value;
    var color= document.getElementById("color").value;
    ctx.strokeStyle=color;
    var shape = document.getElementById("shape").value;
    if (shape==="rectangle"){
        var height = document.getElementById("height").value;
        var width = document.getElementById("width").value;
        ctx.beginPath();
        ctx.rect(x,y,width,height);
        ctx.stroke();
        ctx.closePath();
    }else if(shape==="circle"){
        var radius = document.getElementById("radius").value;
        ctx.beginPath();
        ctx.arc(x,y,radius,0,2*Math.PI);
        ctx.stroke();
        ctx.closePath();
    }else{
        var lineX = document.getElementById("lineX").value;
        var lineY = document.getElementById("lineY").value;
        ctx.beginPath();
        ctx.moveTo(x,y);
        ctx.lineTo(lineX,lineY);
        ctx.stroke();
        ctx.closePath();
    }
    return 0;

}

var r;
var g;
var b;

function randomColor()
{
    r= Math.floor(Math.random() * 255);
    g= Math.floor(Math.random() * 255);
    b= Math.floor(Math.random() * 255);
    
}

function createRandomShape(){
    randomColor();
    var randomSelect=(Math.floor(Math.random() * 3)+1);
    if (1 ==randomSelect){
        document.getElementById("shape").value="circle";
        document.getElementById("ht").style.display="none";
        document.getElementById("wth").style.display="none";
        document.getElementById("lnX").style.display="none";
        document.getElementById("lnY").style.display="none";
        document.getElementById("rds").style.display="block";
        
    }else if(2 == randomSelect){
        document.getElementById("shape").value="line";
        document.getElementById("ht").style.display="none";
        document.getElementById("wth").style.display="none";
        document.getElementById("lnX").style.display="block";
        document.getElementById("lnY").style.display="block";
        document.getElementById("rds").style.display="none";
    }else{
        document.getElementById("shape").value="rectangle";
        document.getElementById("ht").style.display="block";
        document.getElementById("wth").style.display="block";
        document.getElementById("lnX").style.display="none";
        document.getElementById("lnY").style.display="none";
        document.getElementById("rds").style.display="none";
    }
    document.getElementById("inputx").value= Math.floor(Math.random() * 599);
    document.getElementById("inputy").value= Math.floor(Math.random() * 599);
    document.getElementById("height").value= Math.floor(Math.random() * 599);
    document.getElementById("width").value= Math.floor(Math.random() * 599);
    document.getElementById("radius").value= Math.floor(Math.random() * 300);
    document.getElementById("lineX").value= Math.floor(Math.random() * 599);
    document.getElementById("lineY").value= Math.floor(Math.random() * 599);
    document.getElementById("color").value= 'rgb('+r+','+g+','+b+')';
    addShape();
    
}

function reset(){
    ctx.clearRect(0, 0,  600, 600);
    return 0;
    
}