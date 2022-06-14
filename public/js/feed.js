// infinite scroll

let postTime = ''
let lastPostTime = ''
let lastFetch = ''

window.onscroll = function(){
    const BODYHEIGHT = document.body.scrollHeight
    const SCROLLPOINT = window.scrollY + window.innerHeight

    if (SCROLLPOINT >= (BODYHEIGHT - 100)){
    

        // nangkap nilai time terakhir
        postTime = document.getElementsByClassName('post-time')
        lastPostTime = postTime[postTime.length - 1].value

        // fetch data dengan mengirim params time
        if(lastFetch != lastPostTime){
            fetch('loadmore/'+lastPostTime)
            .then(response => response.json())
            .then(data => {
                console.log('load more')
                console.log(data)

                lastFetch = lastPostTime
            })
            .catch(err => console.log(err))
        }
    }
}


function like(post_id, type="post")
{
    let btnLike = document.getElementById(type+'-like-' + post_id) 
    let count = document.getElementById(type+'-count-'+post_id)
    
    fetch('/like/' +type+ '/' + post_id)
    .then(response => response.json())
    .then(data => {
        console.log(data.message)

        let btnText = (data.message == 'like') ? 'Unlike' : 'Like'
        let classText  = (data.message == 'like') ? 'btn btn-danger btn-sm mt-2' : 'btn btn-primary btn-sm mt-2' 
        btnLike.innerText = btnText
        
        if(type=="post"){
            btnLike.className = classText
        }

        let currentCount = 0
        if(data.message == 'like'){
            currentCount = parseInt(count.innerText) + 1
        }
        else {
            currentCount = parseInt(count.innerText) - 1
        }

        console.log(currentCount)
        if(type=="post"){
            count.innerText = currentCount + ' Menyukai'
        }
        else {
            count.innerText = currentCount
        }
    });
}

// cari # dari caption
document.querySelectorAll('.caption').forEach(function(el){
    let renderText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>")
    el.innerHTML = renderText
})