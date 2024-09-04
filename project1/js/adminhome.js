let menubar1=document.getElementById('menubar')
let updateprofile=document.getElementById('updatep')
let admineditprofile=document.getElementById('admineditp')
let propic=document.getElementById('propic')
let sidebar=document.querySelector('.sidebar')
let adminmodel=document.querySelector('.admin-model')

let close1=document.querySelector('.close')
menubar1.addEventListener('click',()=>{
    sidebar.classList.add('show')
})
close1.addEventListener('click',()=>{
    sidebar.classList.remove('show')
})
admineditprofile.addEventListener('click',()=>{
    adminmodel.style.display="none";
})
updateprofile.addEventListener('click',()=>{
    adminmodel.style.display="block";
})

let lists=document.querySelectorAll('.list-group-item')
let sections=document.querySelectorAll('section')
propic.addEventListener('click',()=>{
    sections.forEach(j=>{
        j.style.display="none"
        if(j.attributes['data-filter'].value==2){
            j.style.display="block"
        }
    })
    
})
lists.forEach(i => {
    i.addEventListener('click',()=>{
        sidebar.classList.remove('show')
        sections.forEach(j=>{
            if(i.attributes['data-item'].value==j.attributes['data-filter'].value){
                j.style.display="block"
                
            }
            else{
                j.style.display="none";
            }
        })
      
    })
    
});