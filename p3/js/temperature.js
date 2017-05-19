function reportError()
{
    document.getElementById("result").innerHTML = "Please enter a number.";
}

//-----Conversion between feet and meters---------
var reportDistance = function(distChoice, feet, meters)
{
    if(distChoice === "m_to_ft")
    {
        document.getElementById("result").innerHTML = 
        meters + " m" + " = " + parseFloat(feet).toFixed(4) + " ft";
    }
    else if(distChoice === "ft_to_m")
    {
        document.getElementById("result").innerHTML =
        feet + " ft" + " = " + parseFloat(meters).toFixed(4) + " m";
    }
    
};


document.getElementById("ft_to_m").onclick = function()
{
    var f = document.getElementById("measurement").value;
  
    if(!isNaN(f))
    {
        reportDistance("ft_to_m", f, ft_to_m(f));
    }
    else
        reportError();
    
};

document.getElementById("m_to_ft").onclick = function()
{
    var m = document.getElementById("measurement").value;
    
    if(!isNaN(m))
    {
        reportDistance("m_to_ft", m_to_ft(m), m);
    }
    else
        reportError();
};


function m_to_ft(numMeters)
{
    return (3.2808 * numMeters); //formula for meters to feet conversion
}

function ft_to_m(numFeet)
{
    return(.3048 * numFeet);  //formula for feet to meters conversion
}
//---------------------------------------------------


//---------Conversion between pounds and kilograms--------------
var reportWeight = function(weightChoice, pounds, kilograms)
{
    if(weightChoice === "lb_to_kg")
    {
        document.getElementById("result").innerHTML =
        pounds + " lbs" + " = " + parseFloat(kilograms).toFixed(4) + " kg";
    }
    else if(weightChoice === "kg_to_lb")
    {
        document.getElementById("result").innerHTML =
        kilograms + " kg" + " = " + parseFloat(pounds).toFixed(4) + " lbs";
    }
};

document.getElementById("lb_to_kg").onclick = function()
{
    var lb = document.getElementById("measurement").value;
    
    if(!isNaN(lb))
    {
        reportWeight("lb_to_kg", lb, lb_to_kg(lb));
    }
    else
        reportError();
};

document.getElementById("kg_to_lb").onclick = function()
{
    var kg = document.getElementById("measurement").value;
    
    if(!isNaN(kg))
    {
        reportWeight("kg_to_lb", kg_to_lb(kg), kg);
    }
    else
        reportError();
};



function lb_to_kg(numPounds)
{
    return (.4536 * numPounds); //formula for pounds to kilograms conversion
}

function kg_to_lb(numKilograms)
{
    return(2.2046 * numKilograms);  //formula for kilograms to pounds conversion
}
//---------------------------------------------------------------           


//----------------------Conversion between farenheit and celsius---------------------------
var reportTemp = function(tempChoice, farenheit, celsius)
{
    if(tempChoice === "f_to_c")
    {
        document.getElementById("result").innerHTML = 
        farenheit + "\xb0F = " + parseFloat(celsius).toFixed(4) + "\xb0C";
    }
    else if(tempChoice === "c_to_f")
    {
        document.getElementById("result").innerHTML =
        celsius + "\xb0C = " + parseFloat(farenheit).toFixed(4) + "\xb0F";
    }
}

document.getElementById("f_to_c").onclick = function()
{
    var f = document.getElementById("measurement").value;
    
    if(!isNaN(f))
    {
        reportTemp("f_to_c", f, f_to_c(f));
    }
    else
        reportError();
}

document.getElementById("c_to_f").onclick = function()
{
    var c = document.getElementById("measurement").value;
    
    if(!isNaN(c))
    {
        reportTemp("c_to_f", c_to_f(c), c);
    }
    else
        reportError();
}



function f_to_c(numFarenheit)
{
    return((numFarenheit - 32) * 1.8);
}

function c_to_f(numCelsius)
{
    return(numCelsius * 1.8 + 32);
}
//------------------------------------------------------------------
