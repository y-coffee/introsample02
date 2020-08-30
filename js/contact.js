'use strict'

{
  const twitter = document.getElementById("twitter");

  twitter.addEventListener('mousedown', () => {
    twitter.classList.add('clicked');
    const circle = document.getElementById('circle-twitter');
    circle.classList.remove('circle-shadow');
    circle.classList.add('circle-shadow-clicked');
  });  

  twitter.addEventListener('mouseup', () => {
    twitter.classList.remove('clicked');
    const circle = document.getElementById('circle-twitter');
    circle.classList.add('circle-shadow');
    circle.classList.remove('circle-shadow-clicked');    
  });






  const instagram = document.getElementById("instagram");

  instagram.addEventListener('mousedown', () => {
    instagram.classList.add('clicked');
    const circle = document.getElementById('circle-instagram');
    circle.classList.remove('circle-shadow');
    circle.classList.add('circle-shadow-clicked');
  });  

  instagram.addEventListener('mouseup', () => {
    instagram.classList.remove('clicked');
    const circle = document.getElementById('circle-instagram');
    circle.classList.add('circle-shadow');
    circle.classList.remove('circle-shadow-clicked');    
  });






  const email = document.getElementById("email");

  email.addEventListener('mousedown', () => {
    email.classList.add('clicked');
    const circle = document.getElementById('circle-email');
    circle.classList.remove('circle-shadow');
    circle.classList.add('circle-shadow-clicked');
    
  });    

  email.addEventListener('mouseup', () => {
    email.classList.remove('clicked');
    const circle = document.getElementById('circle-email');
    circle.classList.add('circle-shadow');
    circle.classList.remove('circle-shadow-clicked');    
  });

    
    
  







}

