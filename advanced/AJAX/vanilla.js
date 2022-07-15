function eventList(events){
    let title=document.querySelector(".title")
    title.innerHTML=events.title
    //console.log(data)
    let ul=document.querySelector('ul')
    let li='';
    for(let i=0;i<events.entry.length;i++){
        li=li+`<li class='card col-3'>
                <div class='card-body'>
                    ${events.entry[i].title}
                <div class="name">${events.entry[i].author.name}</div>
                <div class="summary">${events.entry[i].summary}</div>
            
                </div>
               </li>`;
    }
    ul.innerHTML=li
} 