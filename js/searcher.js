var list ;
const searchbar = document.forms['filter-search'].querySelector('input');
searchbar.addEventListener('keyup',function(e){
    if ($('li').hasClass('active')) {
        var text_li= $("li.active").text();
        console.log(text_li.substring(5));
        list = document.querySelector('#'+text_li.substring(5));
    }
    const frase = e.target.value.toLowerCase();
    const plato = list.getElementsByTagName('li');
    Array.from(plato).forEach(function(platito){
        const aux = platito.firstElementChild.textContent;
        if(aux.toLowerCase().indexOf(frase) != -1){
            platito.style.display = 'block';
        }else{
            platito.style.display = 'none';
        }
    })
})

