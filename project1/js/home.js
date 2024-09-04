let menubar = document.getElementById('menubar');
let updateprofile = document.getElementById('updatep');
let editprofile = document.getElementById('editp');
let propic = document.getElementById('propic');
let sidebar = document.querySelector('.sidebar');
let model = document.querySelector('.model');
let close = document.querySelector('.close');

menubar.addEventListener('click', () => {
    sidebar.classList.add('show');
});

close.addEventListener('click', () => {
    sidebar.classList.remove('show');
});

editprofile.addEventListener('click', () => {
    model.style.display = 'none';
});

updateprofile.addEventListener('click', () => {
    model.style.display = 'block';
});

let lists = document.querySelectorAll('.list-group-item');
let sections = document.querySelectorAll('section');

propic.addEventListener('click', () => {
    sections.forEach(section => {
        section.style.display = 'none';
        if (section.getAttribute('data-filter') === '2') {
            section.style.display = 'block';
        }
    });
});

lists.forEach(listItem => {
    listItem.addEventListener('click', () => {
        sidebar.classList.remove('show');
        sections.forEach(section => {
            if (listItem.getAttribute('data-item') === section.getAttribute('data-filter')) {
                section.style.display="block"
            } else {
                section.style.display="none"
            }
        });
    });
});

