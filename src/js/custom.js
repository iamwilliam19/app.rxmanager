

function init(){
  
}

//handle head drop display
const headDrop = (e) => {
  //SELECT the element
  let dropBox = document.getElementsByClassName('head-drop')[0];
  //check if it is visible
  if(dropBox.classList.contains('hide')){
    //show
    dropBox.classList.remove('hide');
    dropBox.classList.add('show');
  }else{
    //hide
    dropBox.classList.remove('show');
    dropBox.classList.add('hide');
  }
}

/*

let sidePane = document.getElementsByClassName('side-pane')[0];
let menu1 = document.getElementsByClassName('menu1')[0];
let menu2 = document.getElementsByClassName('menu2')[0];

const paneHandle = (e) => {
  if(!sidePane.classList.contains('hideFull') && !sidePane.classList.contains('showFull') ){
    sidePane.classList.add('hideFull');
    menu1.classList.remove('showFull');
    menu1.classList.add('hideFull');
    menu2.classList.remove('hideFull');
    menu2.classList.add('showFull');
  }else if(sidePane.classList.contains('showFull')){
    sidePane.classList.remove('showFull');
    sidePane.classList.add('hideFull');
    menu1.classList.remove('showFull');
    menu1.classList.add('hideFull');
    menu2.classList.remove('hideFull');
    menu2.classList.add('showFull');
  }
}

/*const secPaneHandle = (e) => {
  if(!sidePane.classList.contains('hideFull') && !sidePane.classList.contains('showFull') ){
    sidePane.classList.add('showFull');
    menu1.classList.remove('hideFull');
    menu1.classList.add('showFull');
    menu2.classList.remove('showFull');
    menu2.classList.add('hideFull');

  }else if(sidePane.classList.contains('hideFull')){
    sidePane.classList.remove('hideFull');
    sidePane.classList.add('showFull');
    menu1.classList.remove('hideFull');
    menu1.classList.add('showFull');
    menu2.classList.remove('showFull');
    menu2.classList.add('hideFull');

  }
}
*/


const  stockError = (data) => {
  document.getElementsByClassName('rec_top')[0].textContent= data;
}

let recOk = document.getElementsByClassName('rec_ok')[0];
recOk.addEventListener('click',(e) => {
  let errorBox = document.getElementsByClassName("stockRecErrorBox")[0]
   errorBox.style.display = "none";
   hideModal();
});


const hideModal = () => {
  let modal = document.getElementsByClassName('modal')[0];
  if(modal.classList.contains('show_block')){
    modal.classList.remove('show_block');
    modal.classList.add('hide_block');
  }
  
}

const showModal = () => {
  let modal = document.getElementsByClassName('modal')[0];
  if(modal.classList.contains('hide_block')){
    modal.classList.remove('hide_block');
    modal.classList.add('show_block');
  }
  
}

