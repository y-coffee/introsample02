'use strict'

{

  // ハンバーガーメニューのスクリプト
  const humberger = document.getElementById("humberger");

  const menu = document.getElementById("menu");

  humberger.addEventListener('click', () => {
    menu.classList.toggle('show')
    
  });

}