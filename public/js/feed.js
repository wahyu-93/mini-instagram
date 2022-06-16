// infinite scroll

let postTime = ''
let lastPostTime = ''
let lastFetch = '0'

window.onscroll = function(){
    const BODYHEIGHT = document.body.scrollHeight
    const SCROLLPOINT = window.scrollY + window.innerHeight

    // nangkap nilai time terakhir
    postTime = document.getElementsByClassName('post-time')
    lastPostTime = postTime[postTime.length - 1].value
    
    if (SCROLLPOINT >= BODYHEIGHT){
    
        // fetch data dengan mengirim params time
        console.log(lastFetch)
        console.log(lastPostTime)
        if(lastFetch != lastPostTime){
            fetch('loadmore/'+lastPostTime)
            .then(response => response.json())
            .then(data => {
                console.log('load more')
                console.log(data.post)

                lastFetch = lastPostTime
                console.log(lastFetch)
        
                for(let i = 0; i < data.post.length; i++){
                    let newPost = renderPost(data.post[i])
                    document.getElementById('post-wrapper').insertAdjacentHTML('beforeend', newPost)
                }

            })
            .catch(err => console.log(err))
        }
    }
}

function renderPost(post)
{
    return `<div>
                <img src="/images/post/${post.image}" width="100%" height="512px" alt="${post.caption}" ondblclick="like(${post.id})" class="mb-3">
                <p>${(post.caption!=null) ? post.caption : ""}</p>
            </div>`
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