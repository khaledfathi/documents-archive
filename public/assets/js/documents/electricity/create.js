/* #### constants #### */
const monthesDiv = document.querySelector('#monthes-div'); 
const selectedMonthes = document.querySelector('#selected-monthes'); 
var data=[]; 
/* #### end constants #### */


/* #### General #### */
/* #### end General #### */

/* #### Functions #### */
/* #### End Functions #### */

/* #### Event Actions #### */
function setSelectedMonthes (event){
    if(event.target.nodeName == 'INPUT'){
        if(event.target.checked){
            data.push(event.target.value); 
        }else{
            let index = data.indexOf(event.target.value); 
            data.splice(index,1);             
        }
        selectedMonthes.value=JSON.stringify(data); 
    }
    console.log(selectedMonthes.value); 
}
/* #### end Event Actions #### */


/* #### Events #### */  
monthesDiv.addEventListener('click', setSelectedMonthes); 

/* #### end Events #### */  

