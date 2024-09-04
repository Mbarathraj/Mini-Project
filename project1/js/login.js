let loginbtn=document.getElementById('login')
let pic=document.querySelector('.pic')
let details=document.querySelector('.details')
loginbtn.addEventListener('click',()=>{
      pic.classList.add('slidep')
      details.classList.add('slidel')
})